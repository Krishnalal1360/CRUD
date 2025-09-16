@extends('layouts.app')

@section('content')

    <div class="row py-5 px-4">
        <div class="col-md-5 mx-auto"> <!-- Profile widget -->
            <a href="{{ route('customers.index') }}" class="btn mb-3" style="background-color: #4643d3; color: white;"><i class="fas fa-chevron-left"></i> Back</a>
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head d-flex">
                        <div class="profile mr-3">
                            <img
                                src="{{ asset('default_image/'.$customer->image) }}"
                                alt="..." width="130" class="rounded mb-2 img-thumbnail">
                        </div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="mt-0 mb-0">{{ $customer->first_name." " }}{{ $customer->last_name }}</h4>
                            <p class="small mb-4">{{ $customer->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-3">
                    <div class="p-4 rounded shadow-sm bg-light">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 250px;">First Name</td>
                                    <td>{{ $customer->first_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 250px;">Last Name</td>
                                    <td>{{ $customer->last_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 250px;">Email</td>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 250px;">Phone</td>
                                    <td>{{ $customer->phone }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 250px;">Account Number</td>
                                    <td>{{ $customer->bank_account_number }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 250px;">About</td>
                                    <td>{{ $customer->about }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.bundle.js"></script>
    <script src="./assets/js/fontawesome.js"></script>

@endsection