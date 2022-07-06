@extends('layouts.main')
@section('title', 'Transactions')
@section('content')
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Transactions</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total <span class="text-base">{{ $transactions->count() }}</span> transactions.</p>
                </div>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-tnx">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Details</span></div>
                            <div class="nk-tb-col tb-col-lg"><span>Reference No.</span></div>
                            <div class="nk-tb-col text-end"><span>Amount</span></div>
                            <div class="nk-tb-col nk-tb-col-status"><span class="sub-text d-none d-md-block">Status</span></div>
                            <div class="nk-tb-col nk-tb-col-tools">Action</div>
                        </div><!-- .nk-tb-item -->
                        @foreach($transactions as $transaction)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <div class="nk-tnx-type">
                                    <div class="nk-tnx-type-text">
                                        <span class="tb-lead">{{ ucwords($transaction->type_text) }}</span>
                                        <span class="tb-date">{{ $transaction->created_at->format('d M Y, h:i A') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span class="tb-lead">{{ $transaction->reference }}</span>
                            </div>
                            <div class="nk-tb-col text-end">
                                <span class="tb-amount">{{ $transaction->amount_string }}</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-status">
                                <div class="dot dot-{{ $transaction->status->colour }} d-md-none"></div>
                                <span class="badge badge-sm badge-dim bg-outline-{{ $transaction->status->colour }} d-none d-md-inline-flex">{{ ucfirst($transaction->status->title) }}</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-2">
                                    <li>
                                        <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
                                            <em class="icon ni ni-eye-fill"></em>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-tb-item -->
                        @endforeach
                    </div><!-- .nk-tb-list -->
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>
@endsection
