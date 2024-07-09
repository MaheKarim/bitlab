@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="col-xl-9">

        <div class="mb-4">
            <div class="row g-4">
                <div class="col-md-8">
                    <select name="wallet" id="wallet" class="form--control select">
                        <option value="">@lang('Short by Wallet')</option>
                        @foreach($wallets as $singleWallet)
                            <option value="{{ $singleWallet->id }}" {{ $walletId == $singleWallet->id ? 'selected' : null }}>
                                {{ $singleWallet->name }} {{ $singleWallet->name ? '-' : null }} {{ $singleWallet->wallet_address }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="shortBy" id="shortBy" class="form--control select">
                        <option value="">@lang('Short by')</option>
                        <option value="Debit" {{ $shortBy == 'Debit' ? 'selected' : null }}>@lang('Debit')</option>
                        <option value="Credit" {{ $shortBy == 'Credit' ? 'selected' : null }}>@lang('Credit')</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="transaction__warpper">
            <table class="table cmn--table transaction--table">
                <thead>
                <tr>
                    <th>@lang('Date')</th>
                    <th>@lang('Wallet')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Charge')</th>
                    <th>@lang('Post Balance')</th>
                    <th>@lang('Details')</th>
                </tr>
                <tr class="d-block"><td class="d-none"></td></tr>
                </thead>
                <tbody>
                @forelse($logs as $data)
                    <tr>
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
                        <td >
                            {{ showAmount($data->charge, 8) }}
                        </td>
                        <td >
                            <strong>
                                {{ showAmount($data->post_balance, 8) }}
                            </strong>
                        </td>
                        <td class="text-break">{{ __($data->details) }}</td>
                    </tr>
                    <tr class="d-block"><td class="d-none"></td></tr>
                @empty
                    <tr>
                        <td colspan="100%">@lang('Data Not Found')!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $logs->appends(request()->all())->links() }}

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            "use strict";

            $("#shortBy").on("change", function() {
                if(!$(this).val()){
                    return;
                }
                window.location.href = "?shortBy="+$(this).val()+'&wallet='+$('#wallet').val();
            });

            $("#wallet").on("change", function() {
                if(!$(this).val()){
                    return;
                }
                window.location.href = "?shortBy="+$('#shortBy').val()+'&wallet='+$(this).val();
            });

            $('.see-more-less').on('click', function(){
                $(this).toggleClass('active')
            });

        });
    </script>
@endpush
