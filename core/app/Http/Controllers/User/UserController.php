<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\Chainso\Chainso;
use App\Lib\FormProcessor;
use App\Lib\GoogleAuthenticator;
use App\Models\AdminNotification;
use App\Models\DeviceToken;
use App\Models\GeneralSetting;
use App\Models\Send;
use App\Models\Transaction;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function home()
    {
        $pageTitle = 'Dashboard';
        $user = Auth::user();
        $latestTrxs = Transaction::where('user_id', $user->id)->with('wallet')->latest()->limit(10)->get();
        $totalTrx = Transaction::where('user_id', $user->id)->count();
        $btcBalance = UserWallet::where('user_id', $user->id)->sum('balance');
        $totalWallet = UserWallet::where('user_id', $user->id)->count();
        $totalSend = Send::where('user_id', $user->id)->where('status', Status::ENABLE)->sum('amount');
        $totalReceive = Transaction::where('user_id', $user->id)->where('trx_type', '+')->sum('amount');

        return view('Template::user.dashboard', compact('pageTitle', 'latestTrxs', 'totalTrx', 'btcBalance', 'totalWallet', 'totalSend', 'totalReceive'));
    }

    public function show2faForm()
    {
        $ga = new GoogleAuthenticator();
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . gs('site_name'), $secret);
        $pageTitle = '2FA Security';
        return view('Template::user.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'key' => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user,$request->code,$request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts = Status::ENABLE;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator activated successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }

    public function disable2fa(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $user = auth()->user();
        $response = verifyG2fa($user,$request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts = Status::DISABLE;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator deactivated successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

    public function transactions(Request $request)
    {
        $shortBy = $request->shortBy;
        $walletId = $request->wallet;

        $trxType = $shortBy == 'Debit' ? '-' : '+';

        $logs = Transaction::where('user_id', Auth::user()->id)
            ->when(isset($shortBy), function($query) use ($trxType) {
                $query->where('trx_type', $trxType);
            })
            ->when(isset($walletId), function($query2) use ($walletId) {
                $query2->where('wallet_id', $walletId);
            })
            ->latest()
            ->with('wallet')
            ->paginate(getPaginate());

        $wallets = UserWallet::where('user_id', Auth::user()->id)->latest()->get();
        $pageTitle = 'Transactions';
        return view('Template::user.transactions', compact('pageTitle','logs','wallets','walletId','shortBy'));
    }

    public function userData()
    {
        $user = auth()->user();

        if ($user->profile_complete == Status::YES) {
            return to_route('user.home');
        }

        $pageTitle  = 'User Data';
        $info       = json_decode(json_encode(getIpInfo()), true);
        $mobileCode = @implode(',', $info['code']);
        $countries  = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        return view('Template::user.user_data', compact('pageTitle', 'user', 'countries', 'mobileCode'));
    }

    public function userDataSubmit(Request $request)
    {

        $user = auth()->user();

        if ($user->profile_complete == Status::YES) {
            return to_route('user.home');
        }

        $countryData  = (array)json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryCodes = implode(',', array_keys($countryData));
        $mobileCodes  = implode(',', array_column($countryData, 'dial_code'));
        $countries    = implode(',', array_column($countryData, 'country'));

        $request->validate([
            'country_code' => 'required|in:' . $countryCodes,
            'country'      => 'required|in:' . $countries,
            'mobile_code'  => 'required|in:' . $mobileCodes,
            'username'     => 'required|unique:users|min:6',
            'mobile'       => ['required','regex:/^([0-9]*)$/',Rule::unique('users')->where('dial_code',$request->mobile_code)],
        ]);


        if (preg_match("/[^a-z0-9_]/", trim($request->username))) {
            $notify[] = ['info', 'Username can contain only small letters, numbers and underscore.'];
            $notify[] = ['error', 'No special character, space or capital letters in username.'];
            return back()->withNotify($notify)->withInput($request->all());
        }

        $user->country_code = $request->country_code;
        $user->mobile       = $request->mobile;
        $user->username     = $request->username;


        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip = $request->zip;
        $user->country_name = @$request->country;
        $user->dial_code = $request->mobile_code;

        $user->profile_complete = Status::YES;
        $user->save();

        return to_route('user.home');
    }

    public function addDeviceToken(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()->all()];
        }

        $deviceToken = DeviceToken::where('token', $request->token)->first();

        if ($deviceToken) {
            return ['success' => true, 'message' => 'Already exists'];
        }

        $deviceToken          = new DeviceToken();
        $deviceToken->user_id = auth()->user()->id;
        $deviceToken->token   = $request->token;
        $deviceToken->is_app  = Status::NO;
        $deviceToken->save();

        return ['success' => true, 'message' => 'Token saved successfully'];
    }

    public function downloadAttachment($fileHash)
    {
        $filePath = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $title = slug(gs('site_name')).'- attachments.'.$extension;
        try {
            $mimetype = mime_content_type($filePath);
        } catch (\Exception $e) {
            $notify[] = ['error','File does not exists'];
            return back()->withNotify($notify);
        }
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }

    public function wallet()
    {
        $pageTitle = 'Wallet';
        $user = Auth::user();
        $wallets  = UserWallet::where('user_id', $user->id)->latest()->paginate(getPaginate());

        return view('Template::user.wallet', compact('pageTitle', 'wallets'));
    }

    public function sendPage(){
        $pageTitle = 'Send Balance';
        $user = Auth::user();
        $wallets  = UserWallet::where('user_id', $user->id)->latest()->paginate(getPaginate());
        return view('Template::user.send', compact('pageTitle', 'wallets'));
    }

    public function send(Request $request){

        $request->validate([
            'send_wallet'=> 'required|max:255|not-in:'.$request->wallet_address,
            'btc_amount'=> 'required|numeric|gt:0',
            'wallet_address' => [     // From Wallet Address
                Rule::exists('user_wallets')->where(function ($query) use ($request) {
                    return $query->where('wallet_address', $request->wallet_address)
                        ->where('user_id', Auth::user()->id);
                }),
            ]
        ]);

        $general = GeneralSetting::first();

        $charge = $general->fixed_charge + ($request->btc_amount * $general->percent_charge / 100);
        $requiredBalance = $request->btc_amount + $charge;

        $user = Auth::user();
        $findWallet = UserWallet::where('user_id', $user->id)->where('wallet_address', $request->wallet_address)->first();

        if($findWallet->balance < $requiredBalance){
            $notify[] = ['error', 'Sorry, Insufficient Balance'];
            return back()->withNotify($notify);
        }

        if ($user->ts) {
            $response = verifyG2fa($user, $request->authenticator_code);
            if (!$response) {
                $notify[] = ['error', 'Wrong verification code'];
                return back()->withNotify($notify);
            }
        }

        $send = new Send();
        $send->user_id = $user->id;
        $send->wallet_id = $findWallet->id; // Send Wallet Address
        $send->receive_wallet = $request->send_wallet;
        $send->amount = $request->btc_amount;
        $send->charge = $charge;
        $send->status = 0;
        $send->trx = getTrx();
        $send->save();

        $findWallet->balance -= $requiredBalance;
        $findWallet->save();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->wallet_id = $findWallet->id;
        $transaction->amount = $request->btc_amount;
        $transaction->post_balance = $findWallet->balance;
        $transaction->charge = $charge;
        $transaction->trx_type = '-';
        $transaction->details = 'Send '.$request->btc_amount.' '.gs('cur_text').' To '.$request->send_wallet;
        $transaction->trx = $send->trx;
        $transaction->save();

        notify($user, 'BAL_SEND', [

            'trx' => $transaction->trx,
            'amount' => showAmount($request->btc_amount, 8),
            'currency' => $general->cur_text,
            'post_balance' => showAmount($findWallet->balance, 8),
            'wallet' => $findWallet->wallet_address,
            'wallet_name' => $findWallet->name ?? 'N/A'
        ]);

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = $user->username.' has sent '.$request->btc_amount.' '.gs('cur_text').' To '.$request->send_wallet;
        $adminNotification->click_url = urlPath('admin.users.send.history',$user->id);
        $adminNotification->save();

        $notify[] = ['success', $request->btc_amount.' '.$general->cur_text.' will send within few minutes'];
        return redirect()->route('user.send.history')->withNotify($notify);
    }

    public function sendHistory()
    {
        $pageTitle = 'Send History';
        $logs  = Send::where('user_id', Auth::user()->id)->latest()->with('wallet')->paginate(getPaginate());

        return view('Template::user.send_history', compact('pageTitle', 'logs'));
    }

    public function receiveHistory(Request $request){

        $walletId = $request->wallet;

        $logs = Transaction::where('user_id', Auth::user()->id)
            ->when(isset($walletId), function($query2) use ($walletId) {
                $query2->where('wallet_id', $walletId);
            })
            ->where('trx_type', '+')
            ->latest()
            ->with('wallet')
            ->paginate(getPaginate());

        $wallets = UserWallet::where('user_id', Auth::user()->id)->latest()->get();

        $pageTitle = 'Transaction History';
        return view('Template::user.receive_history', compact('pageTitle', 'logs', 'wallets', 'walletId'));
    }

    public function addWallet(Request $request){

        $request->validate([
            'name' => [
                'sometimes',
                Rule::unique('user_wallets')->where(function ($query) use($request) {
                    return $query->where('user_id', Auth::user()->id)
                        ->where('name', $request->name);
                }),
            ]
        ]);

        $user = Auth::user();
        $general = GeneralSetting::first();
        $wallet = UserWallet::where('user_id', $user->id)->count();

        if($wallet >= gs('wallet_limit')){
            $notify[] = ['error', 'Sorry, you can not add more than '.gs('wallet_limit').' wallet'];
            return back()->withNotify($notify);
        }

        try{
            $apiKey = $general->api;
            $version = $general->api_version;
            $pin =  $general->pin;
            $block_io = new Chainso($apiKey, $pin, $version);
            $response = $block_io->get_new_address();
        }catch(\Exception $ex){
            $notify[] = ['error', $ex->getMessage()];
            return back()->withNotify($notify);
        }

        $wallet = new UserWallet();
        $wallet->user_id = $user->id;
        $wallet->name = $request->name;
        $wallet->coin_code = 'BTC';
        $wallet->wallet_address = $response->data->address;
        $wallet->save();

        $notify[] = ['success', 'New wallet added successfully'];
        return back()->withNotify($notify);
    }

}
