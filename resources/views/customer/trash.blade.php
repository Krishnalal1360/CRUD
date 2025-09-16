@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-10 col-md-12 mx-auto">
        <h3>Trash Records</h3>
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <!-- Create Button -->
                    <div class="col-md-2">
                        <a href="{{ route('customers.index') }}" class="btn w-100" style="background-color: #4643d3; color: white;">
                            <i class="fas fa-chevron-left"></i> Back
                        </a>
                    </div>

                    <!-- Search Form -->
                    <div class="col-md-4">
                        <form action="{{ route('customers.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search anything..." name="search" value="{{ request()->search }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Order Form -->
                    <div class="col-md-3">
                        <form action="{{ route('customers.index') }}" method="GET" class="form-order">
                            <div class="input-group">
                                <select class="form-select" name="order" onchange="this.form.submit()">
                                    <option @selected(request()->order == 'desc') value="desc">Newest to Old</option>
                                    <option @selected(request()->order == 'asc') value="asc">Old to Newest</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>BAN</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $customer->first_name }}</td>
                            <td>{{ $customer->last_name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->bank_account_number }}</td>
                            <td>
                                <a href="{{ route('customers.restore', $customer->id) }}" class="ms-1 me-1 text-dark"><i class="fas fa-undo"></i></a>
                                <a href="javascript:;" onclick="if(confirm('Are you sure to delete this record permanently?')) { document.querySelector('.form-{{ $customer->id }}').submit(); }" class="ms-1 me-1 text-dark">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form class="form-{{ $customer->id }}" action="{{ route('customers.forceDestroy', $customer->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
