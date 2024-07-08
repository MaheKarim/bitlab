@extends('admin.layouts.app')
@section('panel')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Transaction')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Post Balance')</th>
                                <th>@lang('Details')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $log->user->fullname }}</span>
                                        <br>
                                        <span class="small">
                                            <a href="{{ appendQuery('search',@$log->user->username) }}"><span>@</span>{{ $log->user->username }}</a>
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $log->trx }}</strong>
                                    </td>

                                    <td>
                                    <span class="font-weight-bold @if($log->trx_type == '+')text-success @else text-danger @endif">
                                        {{ $log->trx_type }} {{showAmount($log->amount, 8)}}
                                    </span>
                                        <br>
                                        <span class="font-weight-bold" data-toggle="tooltip" data-original-title="@lang('Wallet Address')">{{ $log->wallet->wallet_address }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ showAmount($log->post_balance, 8) }} </strong>
                                    </td>
                                    <td>
                                        {{ __($log->details) }}
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
                @if($logs->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($logs) @endphp
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <x-search-form  placeholder='Username / TRX' />
@endpush
