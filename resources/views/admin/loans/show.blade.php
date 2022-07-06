@extends('layouts.main')
@section('title', 'Loan Applications / '.$loan->title ?? "N/A")
@section('content')
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Loan Applications / <strong class="text-primary small">{{ $loan->title }}</strong></h3>
                <div class="nk-block-des text-soft">
                    <ul class="list-inline">
                        <li>Date: <span class="text-base">{{ $loan->created_at->format('d M Y, h:i A') }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="nk-block-head-content">
                <a href="{{ route('admin.loans.index') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                <a href="{{ route('admin.loans.index') }}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row gy-5">
            <div class="col-lg-5">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Loan Details</h5>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Title</div>
                                <div class="data-value">{{ $loan->title }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Amount</div>
                                <div class="data-value">{{ $loan->amount_string }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Interest</div>
                                <div class="data-value">{{ $loan->interest_string }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Total Amount Due</div>
                                <div class="data-value">{{ $loan->total_amount_due_string }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Start Date</div>
                                <div class="data-value">{{ $loan->start_at ? $loan->start_at->format('d-M-Y') : "Not available"  }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">End Date</div>
                                <div class="data-value">{{ $loan->due_at ? $loan->due_at->format('d-M-Y') : "Not available"  }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Status</div>
                                <div class="data-value"><span class="badge badge-dim badge-sm bg-outline-{{ $loan->status->colour }}">{{ ucfirst($loan->status->title) }}</span></div>
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
                                <div class="data-value">{{ $loan->user->first_name }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Last Name</div>
                                <div class="data-value">{{ $loan->user->last_name }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Email Address</div>
                                <div class="data-value">{{ $loan->user->email }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Phone Number</div>
                                <div class="data-value">{{ $loan->user->phone }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">User Bank Account Details</h5>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Bank Name</div>
                                <div class="data-value">{{ $loan->bankAccount->bank_name }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Account Name</div>
                                <div class="data-value">{{ $loan->bankAccount->account_name }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Account Number</div>
                                <div class="data-value">{{ $loan->bankAccount->account_number }}</div>
                            </div>
                        </li>
                    </ul>
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->
</div>
@endsection
