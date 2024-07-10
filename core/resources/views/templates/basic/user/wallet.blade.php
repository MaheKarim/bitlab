@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="col-xl-9">

        <div class="mb-4 text-end">
            <button
                class="btn btn--primary {{ $wallets->count() < gs('wallet_limit') ? 'confirm' : 'sorry' }} h-auto">
                @lang('Add New Wallet')
            </button>
        </div>

        <div class="transaction__warpper">
            <table class="table cmn--table transaction--table">
                <thead>
                <tr>
                    <th>@lang('SL')</th>
                    <th>@lang('Name')</th>
                    <th>@lang('Wallet Address')</th>
                    <th>@lang('Balance')</th>
                    <th>@lang('Action')</th>
                </tr>
                <tr class="d-block"><td class="d-none"></td></tr>
                </thead>
                <tbody>
                @forelse($wallets as $data)
                    <tr>
                    <tr>
                        <td data-label="@lang('SL')">{{ $loop->index + 1 }}</td>
                        <td data-label="@lang('Name')">{{ $data->name ? __($data->name) : __('N/A') }}</td>
                        <td data-label="@lang('Wallet Address')"><span id="{{$data->id}}">{{ $data->wallet_address }}</span> <a href="javascript:void(0)" class="badge text-white badge--primary copytext" data-id="{{$data->id}}">copy </a></td>
                        <td data-label="@lang('Balance')">{{ showAmount($data->balance, 8) }} {{ __(gs('cur_text')) }}</td>
                        <td data-label="@lang('Action')">
                            <button class="btn btn-sm btn--primary qrcode h-auto" data-wallet="{{$data->wallet_address}}">@lang('Receive')</button>
                        </td>
                    </tr>
                    <tr class="d-block"><td class="d-none"></td></tr>
                @empty
                    <tr>
                        <td colspan="100%">@lang('Wallet Not Found')!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{$wallets->links()}}

        </div>
    </div>

    <div class="modal fade" id="qrcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="">
                    @csrf
                    <div class="modal-header">
                        <h6 class="modal-title">@lang('Receive') {{ __(gs('cur_text')) }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <strong class="text-dark qrcodeTarget text-break"></strong>
                        <div class="target"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('user.add.wallet') }}">
                    @csrf
                    <div class="modal-header">
                        <h6 class="modal-title"> @lang('Confirmation')!</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <strong class="text-dark">@lang('Do you want to give your wallet name')?</strong>
                        <input type="text" name="name" class="form-control mt-2">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger cmn--btn btn--sm" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success cmn--btn btn--sm">@lang("Confirm")
                        </button>
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

            $('.qrcode').on('click', function(){
                var modal = $('#qrcode');
                var code = $(this).data('wallet');
                modal.find('.qrcodeTarget').text(code);
                var qrcode = `https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=${code}&choe=UTF-8`;
                modal.find('.target').html(`<img src="${qrcode}" alt="@lang('images')">`);
                modal.modal('show');
            });

            $('.copytext').on('click', function(){
                var $temp = $("<input>");
                var id = $(this).data('id');
                $("body").append($temp);
                $temp.val($('#'+id).text()).select();
                document.execCommand("copy");
                $temp.remove();

                notify('success', 'Copied: '+$('#'+id).text());
            });

            $('.sorry').on('click', function(){
                notify('error', 'Sorry, you can not add more than '+@json(gs('wallet_limit'))+' wallet');
            });

            $('.confirm').on('click', function(){
                $('#confirm').modal('show');
            });

        })(jQuery);
    </script>
@endpush


@push('style')
    <style>
        .target img {
            max-width: 100%
        }
    </style>
@endpush
