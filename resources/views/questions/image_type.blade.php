<div class="row my-3">
    <div class="col-lg-3">
        <div class="form-group">
            <label class="form-label" for="site-off">Multiple answers
            </label>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" value="1" name="is_multiple" id="site-off">
                <label class="custom-control-label" for="site-off"></label>
            </div>
        </div>
    </div>
</div>
<div class="row g-3">
    <div class="col-lg-3">
        <div class="form-group">
            <label class="form-label">Multiple choice questions</label>

        </div>
    </div>
    <div class="col-lg-9">
        <div id="sortable-answers" class="h-100">
            <div class="answer py-3 bg-white border-bottom border-light d-flex justify-content-between">
                <span class="handle align-self-center"><em class="icon ni ni-move"></em></span>
                <span class="w-100">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="hidden" name="type" value="image">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input upload-image" required id="image_file" name="answer[]">
                                <label class="custom-file-label update-image-label" for="customFile">Choose file</label>
                            </div>
                            <input type="text" class="form-control mt-2" name="image_description[]" value="" placeholder="Enter text here">
                        </div>
                    </div>
                </span>
                <div class="user-action align-self-center d-flex ml-2">
                    <a href="#" class="py-1 add-answer-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                    <a href="#" class="py-1 pl-1 remove-answer-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
                </div>
            </div>
            <div class="answer py-3 bg-white border-bottom border-light d-flex justify-content-between">
                <span class="handle align-self-center"><em class="icon ni ni-move"></em></span>
                <span class="w-100">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input upload-image" required id="image_file" name="answer[]">
                                <label class="custom-file-label update-image-label" for="customFile">Choose file</label>
                            </div>
                            <input type="text" class="form-control mt-2" name="image_description[]" value="" placeholder="Enter text here">
                        </div>
                    </div>
                </span>
                <div class="user-action align-self-center d-flex ml-2">
                    <a href="#" class="py-1 add-answer-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                    <a href="#" class="py-1 pl-1 remove-answer-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
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
</div>