@extends('admin.admin_master')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Edit Slider</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane pt-4" id="profile_setting" role="tabpanel">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="card border mb-0">
                                                <form action="{{ route('post.slider') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">title</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" name="title" type="text"
                                                                    @error('title') is-invalid @enderror
                                                                    value="{{ $slider->title }}">
                                                                @error('title')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">description</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-account"></i></span>
                                                                    <input class="form-control" type="text"
                                                                        aria-describedby="basic-addon1" name="description"
                                                                        value="{{ $slider->description }}" placeholder=""
                                                                        @error('description') is-invalid @enderror>

                                                                </div>
                                                                @error('description')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Image Photo</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="file" name="photo"
                                                                    @error('photo') is-invalid @enderror>
                                                                @error('photo')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">link</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-message"></i></span>
                                                                    <input class="form-control" type="text"
                                                                        aria-describedby="basic-addon1" name="link"
                                                                        value="{{ $slider->link }}" placeholder=""
                                                                        @error('link') is-invalid @enderror>
                                                                </div>
                                                                @error('link')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Update Slider</button>
                                                    </div><!--end card-body-->
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>
@endsection
