@extends('layouts.main')
@section('title', 'Loan Applications')
@section('content')
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Loan Applications</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total <span class="text-base">{{ $loans->count() }}</span> loan applications.</p>
                </div>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner p-0">
                    <table class="table table-tranx">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th class="tb-tnx-info">
                                    <span class="tb-tnx-desc">
                                        <span>Loan Type</span>
                                    </span>
                                    <span class="tb-tnx-date d-md-inline-block d-none">
                                        <span class="d-md-none">Date</span>
                                        <span class="d-none d-md-block">
                                            <span>Issue Date</span>
                                            <span>Due Date</span>
                                        </span>
                                    </span>
                                </th>
                                <th class="tb-tnx-amount is-alt">
                                    <span class="tb-tnx-total">Total</span>
                                    <span class="tb-tnx-status d-none d-md-inline-block">Status</span>
                                </th>
                                <th class="tb-tnx-action">
                                    <span>&nbsp;</span>
                                </th>
                            </tr><!-- tb-tnx-item -->
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                                <tr class="tb-tnx-item">
                                    <td class="tb-tnx-info">
                                        <div class="tb-tnx-desc">
                                            <span class="title">{{ $loan->title ?? "N/A" }}</span>
                                        </div>
                                        <div class="tb-tnx-date">
                                            <span class="date">{{ $loan->start_at ? $loan->start_at->format('d-M-Y') : "Not available" }}</span>
                                            <span class="date">{{ $loan->due_at ? $loan->due_at->format('d-M-Y') : "Not available" }}</span>
                                        </div>
                                    </td>
                                    <td class="tb-tnx-amount is-alt">
                                        <div class="tb-tnx-total">
                                            <span class="amount">{{ $loan->total_amount_due_string }}</span>
                                        </div>
                                        <div class="tb-tnx-status"><span class="badge badge-dot bg-{{ $loan->status->colour }}">{{ ucfirst($loan->status->title) }}</span></div>
                                    </td>
                                    <td class="tb-tnx-action">
                                        <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li><a href="{{ route('admin.loans.show', $loan->id) }}">View</a></li>
                                                    @if($loan->status_id == status_pending_id())
                                                        <li><a href="{{ route('admin.loans.approve', $loan->id) }}">Approve</a></li>
                                                        <li><a href="{{ route('admin.loans.reject', $loan->id) }}">Reject</a></li>
                                                    @endif
                                                    @if($loan->status_id == status_active_id())<li><a href="{{ route('admin.loans.complete', $loan->id) }}">Mark as Complete</a></li>@endif
                                                    @if($loan->status_id != status_pending_id())<li><a href="{{ route('admin.loans.revert', $loan->id) }}" class="text-revert">Revert</a></li>@endif
                                                    {{-- <li><a href="{{ route('admin.loans.delete', $loan->id) }}" class="text-danger">Delete</a></li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr><!-- tb-tnx-item -->
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .nk-block-head -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>
@endsection
