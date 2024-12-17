<div class="nk-block-head nk-block-head-lg pb-0">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            {{-- <h4 class="nk-block-title">Add Question</h4> --}}
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
                <form action="{{ route('advice-logic.store', [currentAccount(), currentProject()]) }}" class="gy-3" method="POST" enctype="multipart/form-data" data-form="ajax-form" data-callback="fetchData" data-editForm="editFormCallback">
                    @csrf
                    <div class="row g-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Advice</label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <div class="form-control-wrap ">
                                    <select class="form-select" data-placeholder="Select adivce" data-search="on" name="advice">
                                        <option></option>
                                        @foreach ($advices as $advice)
                                        <option value="{{ $advice->id }}">{{ $advice->secondary_title }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="conditions">
                        <div class="condition my-3">
                            <div class="row g-3 question">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label">Question</label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="d-flex justify-content-between">

                                        <div class="form-group">
                                            <div class="form-control-wrap ">
                                                <select class="form-select select-question" data-search="on" name="question[]" data-placeholder="Select question">
                                                    <option></option>
                                                    @foreach ($questions as $question)
                                                    <option data-id="{{$question->uuid}}" value="{{ $question->uuid }}">{{ $question->secondary_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 options">
                                <div class="col-lg-3">
                                    <div class="form-group labels">
                                        {{-- <label class="form-label">Selected options</label><br>
                                        <label class="form-label mt-4">Value</label> --}}
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="d-flex justify-content-between">
                                        <span class="w-100">
                                            <div class="form-group">
                                                <div class="form-control-wrap answers-select">

                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </span>
                    <a href="#" class="new-condition"> <em class="icon ni ni-plus-circle-fill mr-1"></em>Add another condition</a>


                    <div class="row g-3">
                        <div class="col-lg-9 offset-lg-3">
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-lg btn-primary" data-button="submit">Add </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- .card-inner-group -->
    </div><!-- .card -->
</div><!-- .nk-block -->