@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="col-xl-9">
        <div class="widget__ticket">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h6 class="widget__ticket-title mb-4 me-2">
                    <span>@lang('Send') {{ __(gs('cur_text')) }}</span>
                </h6>
                <a href="{{ route('user.send.history') }}" class="btn btn--primary mb-4">@lang('Send History')</a>
            </div>
            <div class="message__chatbox__body">
                <form class="message__chatbox__form row" action="{{ route('user.send') }}" method="post">
                    @csrf
                    <div class="form--group col-sm-12">
                        <label for="fname" class="form--label">@lang('Send From Wallet')</label>
                        <select name="wallet_address" class="form-control form--control" required>
                            <option value="">@lang('Please Select One')</option>
                            @foreach($wallets as $wallet)
                                <option value="{{ $wallet->wallet_address }}">
                                    {{ __($wallet->name) }} {{ $wallet->name ? '-' : null }} {{ __($wallet->wallet_address) }} ({{ gs('cur_sym') }} {{ showAmount($wallet->balance, 8) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form--group col-sm-12">
                        <label for="send_wallet" class="form--label">@lang('Send To Wallet')</label>
                        <input type="text" id="send_wallet" name="send_wallet" class="form-control form--control bg--body" placeholder="@lang('Send Wallet Address')" required>
                    </div>
                    <div class="form--group col-sm-6">
                        <label for="btc_amount" class="form--label">@lang('BTC Amount')</label>
                        <div class="input-group">
                            <input type="text" id="btc_amount" name="btc_amount" class="form-control form--control bg--body" required>
                            <span class="input-group-text bg--primary">
                            {{ __(gs('cur_text')) }}
                        </span>
                        </div>
                    </div>
                    <div class="form--group col-sm-1 com-md-12 text-center exchange mt-sm-5">
                        <i class="las la-exchange-alt"></i>
                    </div>
                    <div class="form--group col-sm-5">
                        <label for="usd_amount" class="form--label">@lang('USD Amount')</label>
                        <div class="input-group">
                            <input type="text" id="usd_amount" name="usd_amount" class="form-control form--control bg--body" required>
                            <span class="input-group-text bg--primary">
                            @lang('USD')
                        </span>
                        </div>
                    </div>
                    <div class="form--group com-md-12">
                        <div>
                            1 {{ __(gs('cur_text')) }} = <span class="fw-bold">{{ showAmount(gs('usd_rate'), 2) }}</span> @lang('USD'),
                            @lang('Fixed Charge') <span class="fw-bold">{{ showAmount(gs('fixed_charge'), 8) }}</span> ,
                            @lang('Percent Charge') <span class="fw-bold">{{ showAmount(gs('percent_charge'), 2) }}%</span>
                        </div>
                    </div>
                    @if(Auth::user()->ts)
                        <div class="form--group col-sm-12">
                            <label for="send_wallet" class="form--label">@lang('2FA Verification Code')</label>
                            <input type="text" id="send_wallet" name="authenticator_code" class="form-control form--control bg--body" placeholder="@lang('Verification Code')" required>
                        </div>
                    @endif
                    <div class="form--group col-sm-12 mb-0 justify-content-between d-flex flex-wrap">
                        <div class="cal" style="margin: auto 0"></div>
                        <button type="submit" class="cmn--btn">@lang('Send Balance')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>

        (function ($) {

            "use strict";

            var currency = @json(gs('cur_text'));

            $('#btc_amount').on('input', function(){
                var btc = parseFloat($(this).val());
                var usdField = $('#usd_amount');

                if(!btc){
                    $('.cal').html('');
                    return usdField.val('');
                }

                var oneBtcRateInUSD = parseFloat(@json(gs('usd_rate')));
                var totalRateInUSD = btc*oneBtcRateInUSD;
                usdField.val(totalRateInUSD.toFixed(2));

                var charge = parseFloat(@json(gs('fixed_charge'))) + (btc * parseFloat(@json(gs('percent_charge'))) / 100);
                var requiredBalance = parseFloat(btc + charge);

                var result = `<span class='fw-bold'>@lang('Total Amount') ${requiredBalance.toFixed(8)} ${currency} </span>`;
                $('.cal').html(result);
            });

            $('#usd_amount').on('input', function(){
                var input = parseFloat($(this).val());
                var btcField = $('#btc_amount');

                if(!input){
                    $('.cal').html('');
                    return btcField.val('');
                }

                var oneUSDRateInBTC = 1/parseFloat(@json(gs('usd_rate')));
                var totalRateInBTC = input*oneUSDRateInBTC;

                btcField.val(totalRateInBTC.toFixed(8));

                var charge = parseFloat(@json(gs('fixed_charge'))) + (totalRateInBTC * parseFloat(@json(gs('percent_charge'))) / 100);
                var requiredBalance = parseFloat(totalRateInBTC + charge);

                var result = `<span class='fw-bold'>@lang('Total Amount') ${requiredBalance.toFixed(8)} ${currency} </span>`;
                $('.cal').html(result);
            });

        })(jQuery);
    </script>
@endpush

