@extends('superadmin.layout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage SuperAdmin </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('superadmin.addSuper')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>




    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <div class="card">
                        <div class="menu-title navbar">
                            <h2 class="ml-2 menu-title"> Super Admin</h2>
                            <div>
                                @if (@session('success'))
                                <div class="alert alert-success bg-success h3 text-white rounded">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                            <div>
                                @if (@session('error'))
                                <div class="alert alert-danger bg-danger h3 text-white rounded">
                                    {{ session('error') }}
                                </div>
                                @endif
                            </div>
                            <div class="navbar d-flex justify-content-end">
                                <button type="button" data-toggle="modal" class="btn btn-success"
                                    data-target="#addNewSuper">Add New</button>
                            </div>
                        </div>
                        <div class="modal" id="addNewSuper">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header btn-primary">
                                        <h4 class="modal-title">New Super Admin</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>


                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewSuper') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="name">Name:</label>
                                                <input type="text" id="name" name="name" placeholder="Name:"
                                                    class="form-control mb-2">
                                            </div>
                                            <div class="mb-3">
                                                <label for="companyName">Company Name:</label>
                                                <input type="text" id="companyName" name="companyName"
                                                    placeholder="Company Name:" class="form-control mb-2">
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone">Phone No:</label>
                                                <input type="number" id="phone" name="phone" placeholder="Phone Number:"
                                                    class="form-control mb-2">
                                            </div>
                                            <div class="mb-3">
                                                <label for="address">Address:</label>
                                                <input type="text" id="address" name="address" placeholder="Address:"
                                                    class="form-control mb-2">
                                            </div>


                                            <div class="mb-3">
                                                <label for="email">Email:</label>
                                                <input type="email" id="email" name="email" placeholder="Email Address"
                                                    class="form-control mb-2">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password">Password:</label>
                                                <input type="text" id="password" name="password" placeholder="Password"
                                                    class="form-control mb-2">
                                            </div>
                                            <div class="mb-3">
                                                <label for="role_id">Role:</label>
                                                <select class="form-control" name="role_id" id="role_id">
                                                    <option value="" selected>Role</option>
                                                    <option value="superadmin">SuperAdmin</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="staff">Staff</option>
                                                </select>
                                            </div>
                                            {{-- henu parxa yeslai
                                            --}}

                                            {{-- Dependent Dropdown
                                            <div class="mb-3">
                                                <h4>Product Information</h4>
                                                <div id="dynamic-variants">
                                                    <!-- Default Attribute and Options -->

                                                    <div class="variant-group mb-3">
                                                        <label for="attributes" class="form-label">Attributes</label>
                                                        <select class="form-select form-control" name="attributes[]"
                                                            onchange="fetchOptions(this)">
                                                            <option value="" selected>Select Attributes
                                                            </option>
                                                            <!-- Attributes will be loaded dynamically from the database -->
                                                            @foreach ($attributes as $attribute)
                                                            <option value="{{ $attribute->name }}">{{
                                                                ucfirst($attribute->name) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            --}}
                                            <input type="submit" name="save" class="btn btn-success"
                                                value="Save Changes" m-5 />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>Role</th>
                                        <th>EMAIL</th>
                                        <th>PASSWORD</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($superadmin as $item)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>

                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->password }}</td>


                                        <td class="font-weight-medium">
                                            <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                data-target="#updateModel{{ $i }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>

                                            <button type="button" class="btn" title="View" data-toggle="modal"
                                                data-target="#viewModel{{ $item->id }}">
                                                <i class="fas fa-eye fa-lg"></i>
                                            </button>


                                            <!-- View Modal -->
                                            <div class="modal fade" id="viewModel{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="viewModelLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="viewModelLabel{{ $item->id }}">
                                                                Super Admin Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-header bg-dark text-white">
                                                                    <h5 class="card-title mb-0">Super Admin Information
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>ID</strong></h6>
                                                                            <p>{{ $item->id }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong> Name:</strong></h6>
                                                                            <p>{{ $item->name }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Company :</strong></h6>
                                                                            <p>{{ $item->companyName }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Address:</strong></h6>
                                                                            <p>{{ $item->address }}
                                                                            </p>
                                                                        </div>


                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Phone Number:</strong></h6>
                                                                            <p>{{ $item->phone }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Email Address</strong></h6>
                                                                            <p>{{ $item->email }}
                                                                            </p>
                                                                        </div>


                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-md-6">
                                                                            <h6><strong>Role:</strong></h6>
                                                                            <p>{{ $item->role }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Password:</strong></h6>
                                                                            <p>{{ $item->password }}
                                                                            </p>
                                                                        </div>


                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Update Model --}}

                                            <div class="modal" id="updateModel{{ $i }}" tabindex="-1">
                                                <div class="dialog" aria-labelledby="updateModelLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h4 class="modal-title" id="updateModelLabel">Update
                                                                    Super Admin</h4>
                                                                <button type="button" class="close text-white"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ url('UpdateSuper') }}" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')


                                                                    <label for="id">ID:</label>
                                                                    <input type="number" id="id" name="id" disabled
                                                                        value="{{ $item->id }}" placeholder="ID"
                                                                        class="form-control mb-2">

                                                                    <label for="name"> Name:</label>
                                                                    <input type="text" id="name" name="name"
                                                                        value="{{ $item->name }}" placeholder="Name:"
                                                                        class="form-control mb-2">


                                                                    <div class="mb-3">
                                                                        <label for="companyName">Company Name:</label>
                                                                        <input type="text" id="companyName"
                                                                            value="{{$item->companyName}}"
                                                                            name="companyName"
                                                                            placeholder="Company Name:"
                                                                            class="form-control mb-2">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="phone">Phone No:</label>
                                                                        <input type="number" id="phone" name="phone"
                                                                            placeholder="Phone Number:"
                                                                            value="{{$item->phone}}"
                                                                            class="form-control mb-2">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="address">Address:</label>
                                                                        <input type="text" id="address"
                                                                            value="{{$item->address}}" name="address"
                                                                            placeholder="Address:"
                                                                            class="form-control mb-2">
                                                                    </div>


                                                                    <label for="email"> Email Address:</label>
                                                                    <input type="text" id="email" name="email"
                                                                        value="{{ $item->email }}" placeholder="email:"
                                                                        class="form-control mb-2">

                                                                    <label for="password"> Password:</label>
                                                                    <input type="text" id="password" name="password"
                                                                        value="{{ $item->password }}"
                                                                        class="form-control mb-2">

                                                                    <div class="mb-3">
                                                                        <label for="role">Role:</label>
                                                                        <select class="form-control" name="role"
                                                                            id="role">
                                                                            <option value="" selected>Role</option>
                                                                            <option value="1">SuperAdmin</option>
                                                                            <option value="2">Admin</option>
                                                                            <option value="3">Staff</option>
                                                                        </select>
                                                                    </div>

                                                                    <input type="hidden" name="id"
                                                                        value="{{ $item->id }}">
                                                                    <input type="submit" name="save"
                                                                        class="btn btn-success" value="Save Changes" />
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('superadmin.destroy', $item->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm w-10" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this?')">
                                                    <i class="fas fa-lg fa-trash-alt"></i>
                                                </button>
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

        </div>

    </section>
</div>



@endsection