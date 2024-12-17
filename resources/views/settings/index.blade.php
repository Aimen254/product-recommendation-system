@extends('layouts.app')
@section('content')
<style>
    .copy-url{position:absolute;left:-1000px}
</style>
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                                    data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="user-info">

                                                    <span class="lead-text">{{ getActiveAccount()->name }}
                                                        Settings</span>

                                                </div>
                                            </div><!-- .user-card -->
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                            <ul class="link-list-menu">
                                                <li><a href="{{ route('settings.index', currentAccount()) }}"
                                                        class="active"><em
                                                            class="icon ni ni-setting"></em></em><span>General
                                                            settings</span></a></li>
                                                <li><a href="{{ route('users.index', currentAccount()) }}"><em
                                                            class="icon ni ni-account-setting-alt"></em><span>Account
                                                            users</span></a></li>
                                                <li><a href="{{ route('products_setup.index', currentAccount()) }}"><em
                                                            class="icon ni ni-list"></em><span>Products
                                                            </span></a></li>

                                            </ul>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card-aside -->
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg pb-3">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">General Settings</h4>
                                                <div class="nk-block-des">
                                                    {{-- <p>These settings are helps you keep your account secure.</p> --}}
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="card ">
                                            <div class="card-inner-group">
                                                <div class="card-inner p-0">

                                                    <form action="{{ route('settings.save', currentAccount()) }}"
                                                        class="gy-3" method="POST" enctype="multipart/form-data"
                                                        data-form="ajax-form">
                                                        @csrf
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="company-name">Company
                                                                        Name</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="company_name" id="company-name"
                                                                            value="{{ $setting->company_name ?? '' }}"
                                                                            placeholder="Enter company name here">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label"
                                                                        for="site-off">Logo</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <div class="profile-picture-upload">
                                                                            <img src="{{ $setting ? asset("storage/images/".$setting->logo) : asset("images/default.png")}}" alt=""
                                                                                class="imagePreviewLogo imagePreview">
                                                                            <a class="action-button mode-upload"
                                                                                data-preview=".imagePreviewLogo"
                                                                                data-fileinput=".fileinputlogo"> <em class="icon ni ni-upload"></em> Upload</a>
                                                                            <input type="file" class="hidden fileinputlogo"
                                                                                name="logo" accept="image/*" />
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label"
                                                                        for="site-off">Favicon</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <div class="profile-picture-upload">
                                                                            <img src="{{ $setting ? asset("storage/images/".$setting->favicon) : asset("images/default.png")}}" alt=""
                                                                                class="imagePreviewfavicon imagePreview">
                                                                            <a class="action-button mode-upload"
                                                                                data-preview=".imagePreviewfavicon"
                                                                                data-fileinput=".fileinputfavicon"> <em class="icon ni ni-upload"></em> Upload</a>
                                                                            <input type="file" class="hidden fileinputfavicon"
                                                                                name="favicon" accept="image/*" />
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label">Custom Domain</label>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="custom_domain"
                                                                            value="{{ $setting->custom_domain ?? '' }}"
                                                                            placeholder="We recommend adding a subdomain, for example survey.companyname.nl.">
                                                                            <span class="text-info instructions" style="cursor: help;" data-toggle="modal" data-target="#instructions">Instructions</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="site-off">Domain
                                                                        Status</label>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox" class="custom-control-input"
                                                                            name="domain_status" id="site-off" {{ $setting && $setting->status =="active" ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="site-off"></label>
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
                                            </div><!-- .card-inner-group -->
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->
                                </div><!-- .card-inner -->

                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="instructions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Instructions</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <span><b>Step 1</b></span>
            <p class="domain-text">Log in to your domain administration panel and find DNS records management panel for the domain: {{ $setting->custom_domain ?? 'Unknown' }}</p>
            
            <span><b>Step 2</b></span>
            <p>Add new record to your DNS</p>
            
            <span><b>Type = CNAME</b></span>
            <span id="copy-link">cname.surveyrocks.io</span>
            <p>Adress = cname.surveyrocks.io
            <span class="clipboard-init ml-2" data-clipboard-target="#copy-link" data-success="Copied"
                data-text="Copy Link"><em class="clipboard-icon icon ni ni-copy"></em> <span
                    class="clipboard-text">Copy link</span></span>
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
      <script>
          $('body').on('click' , '.instructions' , function(){
              $.ajax({
                  type: "get",
                  url: "{{ route('settings.get-domain-info', currentAccount()) }}",
                  success: function(response){
                      $('.domain-text').text(response.domain);
                  }
              });
          });
      </script>
  @endpush
