@extends('layouts.main')
@section('title', 'Loan Packages')
@section('content')
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">@yield('title')</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total <span class="text-base">{{ $packages->count() }}</span> loan packages.</p>
                </div>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Name</span></div>
                            <div class="nk-tb-col"><span>Loan Score</span></div>
                            <div class="nk-tb-col"><span>Amount</span></div>
                            <div class="nk-tb-col"><span>Percentage</span></div>
                            <div class="nk-tb-col"><span>Duration</span></div>
                            <div class="nk-tb-col"><span>Interest</span></div>
                            <div class="nk-tb-col"><span>Status</span></div>
                            <div class="nk-tb-col nk-tb-col-tools">Action</div>
                        </div><!-- .nk-tb-item -->
                        @foreach($packages as $package)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <span class="tb-lead">{{ $package->name }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-lead">{{ $package->loan_score }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-lead">{{ $package->amount_string }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-lead">{{ $package->percentage_string }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-lead">{{ $package->duration_string }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-lead">{{ $package->interest_string }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-status text-{{ $package->status->colour }}">{{ ucfirst($package->status->title) }}</span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                                <a href="{{ route('admin.loan-packages.edit', $package->id) }}" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                    <em class="icon ni ni-edit-alt-fill"></em>
                                                </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.loan-packages.delete', $package->id) }}" method="POST">
                                                @method('DELETE') @csrf
                                                <button href="{{ route('admin.loan-packages.delete', $package->id) }}" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                    <em class="icon ni ni-trash"></em>
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .nk-tb-item -->
                        @endforeach
                    </div>
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>
@endsection

