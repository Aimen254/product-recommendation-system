<div class="nk-block-head nk-block-head-lg pb-3">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Edit Question</h4>
            <div class="nk-block-des">
                {{-- <p>These settings are helps you keep your account secure.</p> --}}
            </div>
        </div>
        <div class="nk-block-head-content align-self-start d-lg-none">
            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
        </div>
    </div>
</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="card ">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <form action="{{ route('questions.update', [currentAccount(), currentProject(), $question->uuid]) }}" class="gy-3" method="POST"
                    enctype="multipart/form-data" data-form="ajax-form" data-callback="fetchData">
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
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $question->title }}" placeholder="Enter title..."
                                        required>
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
                                    <input type="hidden" class="answer-type" value="Images">
                                    <input type="text" class="form-control" name="secondary_title" id="secondary_title" required value="{{ $question->secondary_title }}">
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
                                    <textarea class="form-control" name="description" aria-label="With textarea" spellcheck="false" required>{{ $question->description }}</textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="site-off">Multiple answers
                                </label>

                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" {{ $question->is_multiple == 1 ? 'checked' : '' }} class="custom-control-input" value="1" name="is_multiple"
                                        id="site-off">
                                    <label class="custom-control-label" for="site-off"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Meerkeuze vragen</label>

                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div id="sortable-answers" class="h-100">
                                @if ($question->answers->count())
                                    @foreach ($question->answers as $answer)
                                        <div class="answer py-3 bg-white border-bottom border-light d-flex justify-content-between">
                                            <span class="handle align-self-center"><em class="icon ni ni-move"></em></span>
                                            <span class="w-100">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="custom-file">
                                                            <input type="hidden" name="type" value="image">
                                                            <input type="file" class="custom-file-input upload-image"
                                                                value="{{ isset($answer->answer) ? $answer->answer : 'Choose file' }}" id="image_file"
                                                                name="answer[{{ $answer->id }}]">
                                                            <label class="custom-file-label" for="customFile">
                                                                {{ isset($answer->answer) ? $answer->answer : 'Choose file' }}</label>
                                                        </div>
                                                        <input type="text" class="form-control mt-2" placeholder="Enter text here" required
                                                            name="image_description[{{ $answer->id }}]" value="{{ $answer->image_description }}">
                                                    </div>
                                                </div>
                                            </span>
                                            <div class="user-action align-self-center d-flex ml-2">
                                                <a href="#" class="py-1 add-answer-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                                                <a href="#" class="py-1 pl-1 remove-answer-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="answer py-3 bg-white border-bottom border-light d-flex justify-content-between">
                                        <span class="handle align-self-center"><em class="icon ni ni-move"></em></span>
                                        <span class="w-100">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input upload-image" required id="image_file" name="answer[]">
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            file</label>
                                                    </div>
                                                    <input type="text" class="form-control mt-2" name="image_description[]" required value="">
                                                </div>
                                            </div>
                                        </span>
                                        <div class="user-action align-self-center d-flex ml-2">
                                            <a href="#" class="py-1 add-answer-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                                            <a href="#" class="py-1 pl-1 remove-answer-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
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
