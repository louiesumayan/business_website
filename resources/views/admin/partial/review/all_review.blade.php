@extends('admin.admin_master')

@section('content')
    <div class="content">
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Reviews</h4>
                </div>
            </div>

            <!-- Datatables  -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Datatable</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Photo</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($review))
                                        @foreach ($review as $rev)
                                            <tr>
                                                <td>{{ $rev->id }}</td>
                                                <td>{{ $rev->name }}</td>
                                                <td>{{ $rev->position }}</td>
                                                <td><img src="{{ asset('backend/assets/upload/' . $rev->photo)  }}"
                                                        style="width: 100%; height: 110px;" alt="picture of a person"></td>
                                                <td>
                                                    <textarea name="message" rows="4" cols="50" id=""
                                                        disabled>{{ $rev->review }}</textarea>
                                                </td>
                                                <td>
                                                    <a href="{{ route('view.update.review', $rev->id) }}"
                                                        class="btn btn-success btn-sm">Edit</a>
                                                    <a href="{{ route('delete.review', $rev->id) }}"
                                                        class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else

                                        <h4>NO DATA FOUND</h4>

                                    @endif

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
