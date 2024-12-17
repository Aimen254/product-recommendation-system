<div class="nk-block-head nk-block-head-lg pb-3">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Edit Question</h4>
            <div class="nk-block-des">
                {{-- <p>These settings are helps you keep your account secure.</p> --}}
            </div>
        </div>
        <div class="nk-block-head-content align-self-start d-lg-none">
            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em
                    class="icon ni ni-menu-alt-r"></em></a>
        </div>
    </div>
</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="card ">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <form action = "{{ route('questions.update', [currentAccount(), currentProject(), $question->uuid]) }}" class="gy-3" method="POST"
                    enctype = "multipart/form-data" data-form="ajax-form" data-callback="fetchData">
                    @csrf
                    @method('PUT')
                    <div class="row g-3 align-center">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="title">Title</label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="hidden" class="answer-type" value="Numeric">
                                    <input type="text" class="form-control" name="title" id="title" value="{{$question->title}}"
                                        placeholder="Enter title..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="title">Secondary Title</label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="secondary_title" id="secondary_title" required
                                    value="{{$question->secondary_title}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Description</label>

                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <textarea class="form-control" name="description" aria-label="With textarea"
                                        spellcheck="false" required >{{$question->description}}</textarea>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row g-3 align-center">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="site-off">Optional
                                    </label>
                    
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" {{$question->choice == "required" ? "checked" : ''}} class="custom-control-input" value="required" name="option" id="site-off">
                                    <label class="custom-control-label" for="site-off"></label>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row g-3">
                        <div class="col-lg-9 offset-lg-3">
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-lg btn-primary" data-button="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- .card-inner-group -->
    </div><!-- .card -->
</div><!-- .nk-block -->
