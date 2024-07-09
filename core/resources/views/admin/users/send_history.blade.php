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
                                <th>@lang('Wallet Address')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Charge')</th>
                                <th>@lang('Status')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>
                                        <strong>{{ $log->trx }}</strong>
                                    </td>

                                    <td>
                                        {{ showDateTime($log->created_at) }} <br> {{ diffForHumans($log->created_at) }}
                                    </td>

                                    <td>
                                        <span class="font-weight-bold text-danger" data-toggle="tooltip" data-original-title="@lang('From Wallet')"> - {{ $log->wallet->wallet_address }}</span>
                                        <br>
                                        <span class="font-weight-bold text-success" data-toggle="tooltip" data-original-title="@lang('To Address')"> + {{ $log->receive_wallet }}</span>
                                    </td>

                                    <td>
                                        <span class="font-weight-bold">
                                            {{showAmount($log->amount, 8)}}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="font-weight-bold text--danger">
                                            {{showAmount($log->charge, 8)}}
                                        </span>
                                    </td>

                                    <td> @php echo $log->statusBadge @endphp </td>
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

