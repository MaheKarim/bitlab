@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('Trx')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Post Balance')</th>
                                <th>@lang('Details')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td><strong>{{ $log->trx }}</strong></td>
                                    <td>
                                        {{ showDateTime($log->created_at) }} <br> {{ diffForHumans($log->created_at) }}
                                    </td>

                                    <td>
                                        <span class="font-weight-bold @if($log->trx_type == '+')text-success @else text-danger @endif">
                                            {{ $log->trx_type }} {{showAmount($log->amount, 8)}}
                                        </span>
                                        <br>
                                        <span class="font-weight-bold" data-toggle="tooltip" data-original-title="@lang('Wallet Address')">
                                            {{ $log->wallet->wallet_address }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="font-weight-bold">
                                            {{ showAmount($log->post_balance, 8) }}
                                        </span>
                                    </td>
                                    <td>{{ __($log->details) }}</td>
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
                @if($logs->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($logs) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

@endsection

