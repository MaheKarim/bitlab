@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="col-xl-9">
        <div class="row justify-content-center g-4">
            <div class="col-lg-6">
                <div class="dashboard-item">
                <span class="dashboard-icon">
                    <i class="lab la-btc"></i>
                </span>
                    <div class="cont">
                        <div class="dashboard-header">
                            <h2 class="title">{{ showAmount($btcBalance, 8) }}</h2>
                        </div>
                        <a href="{{ route('user.transactions') }}">@lang('Balance In') {{ __(gs('cur_text')) }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dashboard-item">
                <span class="dashboard-icon">
                    <i class="las la-dollar-sign"></i>
                </span>
                    <div class="cont">
                        <div class="dashboard-header">
                            <h2 class="title">{{ showAmount($btcBalance*$btcRate, 2) }}</h2>
                        </div>
                        <a href="{{ route('user.transactions') }}">@lang('Balance In') @lang('USD')</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="dashboard-item">
                <span class="dashboard-icon">
                    <i class="las la-money-bill-alt"></i>
                </span>
                    <div class="cont">
                        <div class="dashboard-header">
                            <h2 class="title">
                                {{ showAmount($totalSend , 8)}}
                            </h2>
                        </div>
                        <a href="{{ route('user.send.history') }}">@lang('Send')</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="dashboard-item">
                <span class="dashboard-icon">
                    <i class="las la-exchange-alt"></i>
                </span>
                    <div class="cont">
                        <div class="dashboard-header">
                            <h2 class="title">{{ showAmount($totalReceive, 8) }}</h2>
                        </div>
                        <a href="{{ route('user.receive.history') }}">@lang('Receive')</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="dashboard-item">
                <span class="dashboard-icon">
                    <i class="las la-exchange-alt"></i>
                </span>
                    <div class="cont">
                        <div class="dashboard-header">
                            <h2 class="title">{{ __($totalTrx) }}</h2>
                        </div>
                        <a href="{{ route('user.transactions') }}">@lang('Transaction')</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="dashboard-item">
                <span class="dashboard-icon">
                    <i class="las la-wallet"></i>
                </span>
                    <div class="cont">
                        <div class="dashboard-header">
                            <h2 class="title">{{ $totalWallet }}</h2>
                        </div>
                        <a href="{{ route('user.wallet') }}">@lang('Wallet')</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="notice"></div>
        <!-- Table -->
        <div class="pt-60">
            <h5 class="d-title">@lang('Latest Transaction')</h5>
            <table class="table cmn--table">
                <thead>
                <tr>
                    <th>@lang('Date')</th>
                    <th>@lang('Wallet')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Charge')</th>
                    <th>@lang('Post Balance')</th>
                    <th>@lang('Details')</th>
                </tr>
                <tr class="d-block"></tr>
                </thead>
                <tbody>
                @forelse($latestTrxs as $data)
                    <tr>
                        <td>
                            {{ showDateTime($data->created_at) }}
                            <br>
                            {{ $data->trx }}
                        </td>
                        <td>
                            <span>{{ $data->wallet->wallet_address }}</span>
                        </td>
                        <td>
                            <strong>
                                {{ $data->trx_type }}
                                {{ showAmount($data->amount, 8) }}
                            </strong>
                        </td>
                        <td>
                            {{ showAmount($data->charge, 8) }}
                        </td>
                        <td>
                            <strong>
                                {{ showAmount($data->post_balance, 8) }}
                            </strong>
                        </td>
                        <td>{{ __($data->details) }}</td>
                    </tr>
                    <tr><td class="d-none"></td></tr>
                @empty
                    <tr>
                        <td colspan="100%">@lang('Data Not Found')!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection


@push('script')
    <script>
        (function($){
            "use strict";
            $('.see-more-less').on('click', function(){
                $(this).toggleClass('active')
            });
        })(jQuery);
    </script>
@endpush
