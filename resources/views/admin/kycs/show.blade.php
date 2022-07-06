@extends('layouts.main')
@section('title', 'KYCs')
@section('content')
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">KYCs / <strong class="text-primary small">{{ $kyc->name }}</strong></h3>
                <div class="nk-block-des text-soft">
                    <ul class="list-inline">
                        {{-- <li>Application ID: <span class="text-base">KID000844</span></li> --}}
                        <li>Submited At: <span class="text-base">{{ $kyc->info->submitted_at }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="nk-block-head-content">
                <a href="{{ route('admin.kycs.index') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                <a href="{{ route('admin.kycs.index') }}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row gy-5">
            <div class="col-lg-5">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Application Info</h5>
                        <p>Submission date, approve date, status etc.</p>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Submitted At</div>
                                <div class="data-value">{{ $kyc->info->submitted_at }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Status</div>
                                <div class="data-value"><span class="badge badge-dim badge-sm bg-outline-{{ $kyc->info->status->colour }}">{{ ucfirst($kyc->info->status->title) }}</span></div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Last Checked</div>
                                <div class="data-value">
                                    <div class="user-card">
                                        <div class="user-name">
                                            <div class="data-value">{{ $kyc->info->checkedByUser ? $kyc->info->checkedByUser->name : "Not Yet" }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Last Checked At</div>
                                <div class="data-value">{{ $kyc->info->updated_at->format('d M Y, h:i A') }}</div>
                            </div>
                        </li>
                    </ul>
                </div><!-- .card -->
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Uploaded Documents</h5>
                        <p>Here is user uploaded documents.</p>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Document Type</div>
                                <div class="data-value">National ID Card</div>
                            </div>
                        </li>
                    </ul>
                </div><!-- .card -->
            </div><!-- .col -->
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
                                <div class="data-value">{{ $kyc->first_name }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Last Name</div>
                                <div class="data-value">{{ $kyc->last_name }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Email Address</div>
                                <div class="data-value">{{ $kyc->email }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Phone Number</div>
                                <div class="data-value">{{ $kyc->phone }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Date of Birth</div>
                                <div class="data-value">{{ $kyc->info->dob }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Full Address</div>
                                <div class="data-value">{{ $kyc->info->address1 }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">City</div>
                                <div class="data-value">{{ $kyc->info->city }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">State</div>
                                <div class="data-value">{{ $kyc->info->state }}</div>
                            </div>
                        </li>
                        {{-- <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Country of Residence</div>
                                <div class="data-value">Kenya</div>
                            </div>
                        </li> --}}
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">NIN</div>
                                <div class="data-value">{{ $kyc->idVerification ? $kyc->idVerification->hidden_id_number : "N/A" }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->
</div>
@endsection
