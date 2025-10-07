@extends('admin.admin_master')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Profile</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Components</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-items-center">

                                <div class="d-flex align-items-center">
                                    <img src="{{ !empty($profileData->photo) ? asset('backend/assets/upload/' . $profileData->photo) : asset('backend/assets/images/no_image.jpg')  }}"
                                        class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile">

                                    <div class="overflow-hidden ms-4">
                                        <h4 class="m-0 text-dark fs-20">{{ $profileData->name }}</h4>
                                        <p class="my-1 text-muted fs-16">Passionate Software Engineer Crafting Innovative
                                            Solutions</p>
                                        <span class="fs-15"><i class="mdi mdi-message me-2 align-middle"></i>Speaks:
                                            <span>English <span
                                                    class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">native</span>
                                                , Bitish, Turkish </span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pt-4" id="profile_setting" role="tabpanel">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="card border mb-0">

                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h4 class="card-title mb-0">Personal Information</h4>
                                                        </div><!--end col-->
                                                    </div>
                                                </div>

                                                <form action="{{ route('profile.store') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Name</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" name="name" type="text"
                                                                    value="{{ $profileData->name }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Contact Phone</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-phone-outline"></i></span>
                                                                    <input class="form-control" type="text"
                                                                        aria-describedby="basic-addon1" name="phone"
                                                                        value="{{ !empty($profileData->phone) ? $profileData->phone : '' }}"
                                                                        placeholder="{{ !empty($profileData->phone) ? $profileData->phone : 'No phone provided' }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Email Address</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-email"></i></span>
                                                                    <input type="text" class="form-control" name="email"
                                                                        value="{{ $profileData->email }}"
                                                                        placeholder="Email" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">City Address</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="text" name="address"
                                                                    value="{{ !empty($profileData->address) ? $profileData->address : '' }}"
                                                                    placeholder="{{ !empty($profileData->address) ? $profileData->address : 'No address provided' }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Profile Photo</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="file" name="photo">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update
                                                            profile</button>
                                                    </div><!--end card-body-->
                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-xl-6">
                                            <div class="card border mb-0">

                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h4 class="card-title mb-0">Change Password</h4>
                                                        </div><!--end col-->
                                                    </div>
                                                </div>

                                                <form action="{{ route('update.profile') }}" method="POST">
                                                    @csrf

                                                    <div class="card-body mb-0">
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Old Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="password"
                                                                    @error('old_password') is-invalid @enderror
                                                                    placeholder="Old Password" name="old_password">
                                                                @error('old_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">New Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="password"
                                                                    @error('new_password') is-invalid @enderror
                                                                    placeholder="New Password" name="new_password">
                                                                @error('new_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Confirm Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="password"
                                                                    placeholder="Confirm Password"
                                                                    name="new_password_confirmation">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <button type="submit" class="btn btn-primary">Change
                                                                    Password</button>

                                                            </div>
                                                        </div>

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
