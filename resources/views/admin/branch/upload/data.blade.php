@extends('layouts.nav-admin')

@section('title', 'Upload Photo')
<link rel="stylesheet" href="{{ asset('assets/css/dropify.min.css') }}">
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/dropify.min.js') }}"></script>
@section('content')
    <div class="page-wrapper">

        <div class="content container-fluid">
            <div class="page-header mb-3">
                <div class="card p-4 mb-4 flex-row justify-content-md-between flex-column flex-md-row align-items-center">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-dot mb-0">
                                <li class="breadcrumb-item" aria-current="page"><a
                                        href="{{ route('admin.hired-students.index') }}">Branches</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Upload Data</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card p-3">
                <form action="{{ route('admin.branches.import.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <label for="upload-file" class="form-label">Upload UT branches below (.xlsx) <br> Only 1 sheet
                                allowed</label>
                            <a href="{{ asset('assets/sample/Cabang-Cabang UT.xlsx') }}" class="btn btn-outline-success px-3 py-1" style="height: max-content">Download sample</a>
                        </div>
                        <input class="dropify" type="file" id="upload-file"
                            name="file_excel">
                        @error('file_excel')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Upload <i class="fe fe-upload"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('.dropify').dropify();
    </script>
@endsection
