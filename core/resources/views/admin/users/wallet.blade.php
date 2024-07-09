@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('SL')</th>
                                <th>@lang('Wallet Name')</th>
                                <th>@lang('Wallet Address')</th>
                                <th>@lang('Balance')</th>
                                <th>@lang('Copy')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($wallets as $data)
                                <tr>
                                    <td>
                                        <span class="font-weight-bold">{{ $loop->index + 1 }}</span>
                                    </td>

                                    <td>
                                        {{ __($data->name) ?? 'N/A' }}
                                    </td>

                                    <td>
                                        <strong id="{{$data->id}}">{{ $data->wallet_address }}</strong>
                                    </td>

                                    <td>
                                        <span class="font-weight-bold">
                                            {{showAmount($data->balance, 8)}}
                                        </span>
                                    </td>

                                    <td data-label="@lang('Copy')">
                                        <a href="javascript:void(0)" class="icon-btn copytext" data-toggle="tooltip" title="" data-original-title="@lang('Copy')" data-id="{{$data->id}}">
                                            <i class="las la-copy text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($wallets->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($wallets) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

@endsection

@push('script')
    <script>

        (function ($) {

            "use strict";

            $('.copytext').on('click', function(){
                var $temp = $("<input>");
                var id = $(this).data('id');

                console.log(id);
                $("body").append($temp);
                $temp.val($('#'+id).text()).select();
                document.execCommand("copy");
                $temp.remove();

                notify('success', 'Copied: '+$('#'+id).text());
            });

        })(jQuery);
    </script>
@endpush
