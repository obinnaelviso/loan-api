@extends('layouts.main')
@section('title', 'Transactions / '.$transaction->reference)
@section('content')
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Transactions / <strong class="text-primary small">{{ $transaction->reference }}</strong></h3>
                <div class="nk-block-des text-soft">
                    <ul class="list-inline">
                        <li>Date: <span class="text-base">{{ $transaction->created_at->format('d M Y, h:i A') }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="nk-block-head-content">
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row gy-5">
            <div class="col-lg-5">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Transactions Details</h5>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Date</div>
                                <div class="data-value">{{ $transaction->created_at->format('d M Y, h:i A') }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Status</div>
                                <div class="data-value"><span class="badge badge-dim badge-sm bg-outline-{{ $transaction->status->colour }}">{{ ucfirst($transaction->status->title) }}</span></div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Reference Number</div>
                                <div class="data-value">
                                    {{ $transaction->reference }}
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Amount</div>
                                <div class="data-value">
                                    {{ $transaction->amount_string }}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-lg-7">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">User Information</h5>
                    </div>
                </div>
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">First Name</div>
                                <div class="data-value">{{ $transaction->user->first_name }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Last Name</div>
                                <div class="data-value">{{ $transaction->user->last_name }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Email Address</div>
                                <div class="data-value">{{ $transaction->user->email }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Phone Number</div>
                                <div class="data-value">{{ $transaction->user->phone }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->
</div>
@endsection
