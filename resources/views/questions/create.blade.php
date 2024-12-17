<div class="nk-block-head nk-block-head-lg pb-3">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Add Question</h4>
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
                <form action="{{ route('questions.store', [currentAccount(), currentProject()]) }}"
                    class="gy-3" method="POST" enctype="multipart/form-data" data-form="ajax-form"
                    data-callback="fetchData" data-editForm="editFormCallback">
                    @csrf
                    <div class="row g-3 align-center">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="title">Question Type</label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select name="answer_type"
                                            class="form-select form-control select-answer-type"
                                            data-search="off" data-placeholder="Select Type">
                                            <option></option>
                                            <option value="Images">MCQs with Images</option>
                                            <option value="MCQS" selected>MCQs</option>
                                            <option value="Email">Email</option>
                                            <option value="Numeric">Numeric</option>
                                            <option value="Text">Text</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="title">Title</label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="title" id="title" required
                                        placeholder="Enter Title...">
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
                                    <input type="text" class="form-control" name="secondary_title"
                                        id="secondary_title" required placeholder="Secondary Title">
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
                                    <textarea class="form-control" name="description" aria-label="With textarea" spellcheck="false" required></textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">

                        <div id="question_type" style="width: 100%">
                            @include('questions.mcqs_type')
                        </div>
                        {{-- <div class="row g-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Multiple choice questions</label>

                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div id="sortable-answers" class="h-100">
                                <div
                                    class="answer py-3 bg-white border-bottom border-light d-flex justify-content-between">
                                    <span class="handle align-self-center"><em class="icon ni ni-move"></em></span>
                                    <span class="w-100">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="answer[]"
                                                    value="" placeholder="Enter answer..." maxlength="40" >
                                            </div>
                                        </div>
                                    </span>
                                    <div class="user-action align-self-center d-flex ml-2">
                                        <a href="#" class="py-1 add-answer-field"><em
                                                class="icon ni ni-plus-circle-fill text-teal"></em></a>
                                        <a href="#" class="py-1 pl-1 remove-answer-field"><em
                                                class="icon ni ni-cross-circle-fill text-danger"></em></a>
                                    </div>
                                </div>
                                <div
                                    class="answer py-3 bg-white border-bottom border-light d-flex justify-content-between">
                                    <span class="handle align-self-center"><em class="icon ni ni-move"></em></span>
                                    <span class="w-100">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="answer[]"
                                                    value="" placeholder="Enter answer..." maxlength="40">
                                            </div>
                                        </div>
                                    </span>
                                    <div class="user-action align-self-center d-flex ml-2">
                                        <a href="#" class="py-1 add-answer-field"><em
                                                class="icon ni ni-plus-circle-fill text-teal"></em></a>
                                        <a href="#" class="py-1 pl-1 remove-answer-field"><em
                                                class="icon ni ni-cross-circle-fill text-danger"></em></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-9 offset-lg-3">
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-lg btn-primary" data-button="submit">Add</button>
                            </div>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div><!-- .card-inner-group -->
    </div><!-- .card -->
</div><!-- .nk-block -->
