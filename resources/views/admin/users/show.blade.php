@extends('layouts.main')
@section('title', 'Users / '.$user->name)
@section('content')
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Users Management / <strong class="text-primary small">{{ $user->name }}</strong></h3>
                <div class="nk-block-des text-soft">
                    <ul class="list-inline">
                        <li>Registered On: <span class="text-base">{{ $user->created_at->format('d M Y, h:i A')}}</span></li>
                    </ul>
                </div>
            </div>
            <div class="nk-block-head-content">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row gy-5">
            <div class="col-lg-7">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Applicant Information</h5>
                        <p>Basic info, like name, phone, address, country etc.</p>
                    </div>
                </div>
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">First Name</div>
                                <div class="data-value">{{ $user->first_name }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Last Name</div>
                                <div class="data-value">{{ $user->last_name }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Email Address</div>
                                <div class="data-value">{{ $user->email }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Phone Number</div>
                                <div class="data-value">{{ $user->phone }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Date of Birth</div>
                                <div class="data-value">{{ $user->info->dob ?? "N/A" }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Full Address</div>
                                <div class="data-value">{{ $user->info->address1 ?? "N/A" }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">City</div>
                                <div class="data-value">{{ $user->info->city ?? "N/A" }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">State</div>
                                <div class="data-value">{{ $user->info->state ?? "N/A" }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">NIN</div>
                                <div class="data-value">{{ $user->idVerification ? $user->idVerification->hidden_id_number : "N/A" }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Status</div>
                                <div class="data-value"><span class="badge badge-dim badge-sm bg-outline-{{ $user->status->colour }}">{{ ucfirst($user->status->title) }}</span></div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Last Logged In</div>
                                <div class="data-value">{{ $user->last_login_at ? $user->last_login_at->format('d M Y') : 'N/A' }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- .col -->
            <div class="col-lg-5">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Wallet Info</h5>
                        <p>Main Balance and Loan Balance.</p>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Main Balance</div>
                                <div class="data-value">{{ $user->wallet->balance_string }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Loan Balance</div>
                                <div class="data-value">{{ $user->wallet->loan_balance_string }}</div>
                            </div>
                        </li>
                    </ul>
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->
</div>
@endsection
