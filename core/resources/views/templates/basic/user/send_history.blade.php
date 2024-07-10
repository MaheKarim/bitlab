@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="col-xl-9">
        <div class="transaction__warpper">
            <table class="table cmn--table transaction--table">
                <thead>
                <tr>
                    <th>@lang('Date')</th>
                    <th>@lang('Trx')</th>
                    <th>@lang('From Wallet')</th>
                    <th>@lang('To Wallet')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Charge')</th>
                    <th>@lang('Status')</th>
                </tr>
                <tr class="d-block"><td class="d-none"></td></tr>
                </thead>
                <tbody>
                @forelse($logs as $data)
                    <tr>
                    <tr>
                        <td data-label="@lang('Date')">
                            {{ showDateTime($data->created_at) }}
                        </td>
                        <td>{{ $data->trx }}</td>

                        <td><span>{{ $data->wallet->wallet_address }}</span></td>
                        <td><span>{{ $data->receive_wallet }}</span></td>

                        <td>
                            <strong>
                                {{ showAmount($data->amount, 8) }}
                                {{ __($general->cur_text) }}
                            </strong>
                        </td>
                        <td>
                            <strong>
                                {{ showAmount($data->charge, 8) }}
                                {{ __($general->cur_text) }}
                            </strong>
                        </td>
                        <td>
                            @php echo $data->badgeStatus @endphp
                        </td>
                    </tr>
                    <tr><td class="d-none"></td></tr>
                @empty
                    <tr>
                        <td colspan="100%">@lang('Data Not Found')!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$logs->links()}}
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
