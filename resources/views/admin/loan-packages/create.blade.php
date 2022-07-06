@extends('layouts.main')
@section('title', 'Create Loan Packages')
@section('content')
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">@yield('title')</h3>
            </div>
            <div class="nk-block-head-content">
                <a href="{{ route('admin.loan-packages.index') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                <a href="{{ route('admin.loan-packages.index') }}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner">
                <form action="{{ route('admin.loan-packages.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="package-name">Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control @error('name') invalid @enderror" name="name" value="{{ old('name') }}" id="package-name">
                                    @error('name')
                                        <span  class="invalid" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="package-loan-score">Loan Score</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="package-loan-score" name="loan_score" value="{{ old('loan_score') }}">
                                    @error('loan_score')
                                        <span  class="invalid" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="package-amount">Amount</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="package-amount" name="amount" value="{{ old('amount') }}">
                                    @error('amount')
                                        <span  class="invalid" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="package-duration">Duration (Days)</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="package-duration" name="duration" value="{{ old('duration') }}">
                                    @error('duration')
                                        <span  class="invalid" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="package-percentage">Percentage</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="package-percentage" name="percentage" value="{{ old('percentage') }}">
                                    @error('percentage')
                                        <span  class="invalid" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>
@endsection
