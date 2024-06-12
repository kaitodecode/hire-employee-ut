@extends('layouts.nav-admin')

@section('title', 'Hire Stutends')
<link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">
@section('content')
    <div class="page-wrapper">

        <div class="content container-fluid">
            <div class="page-header mb-3">
                <div class="card px-3 py-3 mb-4 flex-md-row justify-content-between align-items-center">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-dot mb-0">
                                <li class="breadcrumb-item active" aria-current="page">Customers data</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex flex-column flex-md-row align-items-md-center">
                        <div class="d-flex justify-content-center">
                            <form method="get" class="form-inline d-flex flex-row gap-1 m-0">
                                <input class="form-control mr-sm-2 py-0" type="search" name="query" placeholder="Search"
                                    aria-label="Search" value="{{ request('query') }}">
                                <button class="btn btn-outline-primary py-0 my-sm-0" type="submit"><i
                                        class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('admin.customer.create') }}" class="btn btn-outline-primary">Add Customer</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Telephone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $i => $user)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->no_telp }}</td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.customer.edit', $user->id) }}"><i
                                                            class="fa-solid fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <form nameData="{{ $user->name }}"
                                                        action="{{ route('admin.customer.destroy', $user->id) }}"
                                                        method="POST" class="customer">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn dropdown-item"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <p class="mt-3 mb-3 text-center fw-bold">Data is empty...</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3 align-items-center">
                            {{ $customers->links('pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/handle-searching.js') }}"></script>
    <script>
        showConfirmDeleteModal('.customer');
    </script>
@endsection
