@extends('layouts.main')
@section('title', 'Users Management')
@section('content')
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">@yield('title')</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total <span class="text-base">{{ $users->count() }}</span> registered users.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="JavaScript:void(0)"><span>Add User</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid">
                                    <label class="custom-control-label" for="uid"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col"><span class="sub-text">User</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Loan</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Verified</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Last Login</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                            <div class="nk-tb-col nk-tb-col-tools text-end">
                                &nbsp;
                            </div>
                        </div><!-- .nk-tb-item -->
                        @foreach($users as $user)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid1">
                                        <label class="custom-control-label" for="uid1"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col">
                                    <a href="user-details.html">
                                        <div class="user-card">
                                            <div class="user-avatar bg-{{ $user->status->colour }}">
                                                <span>{{ $user->user_avatar_text }}</span>
                                            </div>
                                            <div class="user-info">
                                                <span class="tb-lead">{{ $user->name }} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                <span>{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount">{{ getLoanBalance($user->id) }}</span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span>{{ $user->phone }}</span>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <ul class="list-status">
                                        <li><em class="icon {{ $user->idVerification ? "text-success" : "" }} ni ni-{{ $user->idVerification ? "check" : "alert" }}-circle"></em> <span>NIN</span></li>
                                        <li><em class="icon text-{{ $user->info->status->colour }} ni ni-{{ ($user->info->status_id == status_approved_id()) ? "check" : "alert" }}-circle"></em> <span>KYC</span></li>
                                    </ul>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <span>{{ $user->last_login_at ? $user->last_login_at->format('d M Y') : 'N/A' }}</span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-status text-{{ $user->status->colour }}">{{ ucfirst($user->status->title) }}</span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        {{-- <li class="nk-tb-action-hidden">
                                            <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Transaction">
                                                <em class="icon ni ni-wallet-fill"></em>
                                            </a>
                                        </li>
                                        <li class="nk-tb-action-hidden">
                                            <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                <em class="icon ni ni-mail-fill"></em>
                                            </a>
                                        </li>
                                        <li class="nk-tb-action-hidden">
                                            <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Suspend">
                                                <em class="icon ni ni-user-cross-fill"></em>
                                            </a>
                                        </li> --}}
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="{{ route('admin.users.show', $user->id) }}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                        {{-- <li><a href="#"><em class="icon ni ni-repeat"></em><span>Transaction</span></a></li> --}}
                                                        {{-- <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li> --}}
                                                        <li class="divider"></li>
                                                        <li><a href="{{ route('admin.users.reset-password', $user->id) }}"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                                        @if($user->status_id == status_active_id())
                                                            @if($user->is_user)
                                                                <li><a href="{{ route('admin.users.suspend', $user->id) }}"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>
                                                            @endif
                                                        @else
                                                            <li><a href="{{ route('admin.users.active', $user->id) }}"><em class="icon ni ni-check-circle"></em><span>Activate User</span></a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
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
