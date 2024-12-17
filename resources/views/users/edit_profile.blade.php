@extends('layouts.app')
@section('content')
    <!-- content @s -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Personal Information</h4>
                                                <div class="nk-block-des">
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                   
                                       
                                    <form method="post" action="{{ route('update_personal_info') }}"
                                        class="gy-3" enctype="multipart/form-data" data-form="ajax-form"
                                        data-reload="true">
                                        @method('post')
                                        @csrf
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="company-name">Avatar</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="profile-picture-upload">
                                                            <img src="{{ Auth::user()->profile_photo_path ?  asset("storage/images/".Auth::user()->profile_photo_path) : asset("images/avatar.png/")}}"  alt=""
                                                                class="imagePreviewLogo imagePreview mb-3">
                                                            <a class="action-button mode-upload"
                                                                data-preview=".imagePreviewLogo"
                                                                data-fileinput=".fileinputlogo"> <em class="icon ni ni-upload"></em> Upload</a>
                                                            <input type="file" class="hidden fileinputlogo"
                                                            name="image" accept="image/*" />
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="company-name">First Name</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="first_name"
                                                            placeholder="Enter First Name"
                                                            value="{{ Auth::user()->first_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="company-name">Last Name</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="last_name"
                                                            placeholder="Enter Last Name"
                                                            value="{{ Auth::user()->last_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="company-name">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="email" class="form-control" name="email" disabled
                                                            placeholder="Enter Email" value="{{ Auth::user()->email }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row g-3">
                                            <div class="col-lg-9 offset-lg-3">
                                                <div class="form-group mt-2">
                                                    <button type="submit"
                                                        class="btn btn-lg btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </form>
                                </div>
                                @include('users.partials.sidebar')
                                
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection
