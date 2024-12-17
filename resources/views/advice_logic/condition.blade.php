<div class="condition my-3">
    <div class="row g-3 condition-logic">
        <div class="col-lg-4 offset-lg-5">
            <div class="d-flex justify-content-between">
                <span class="w-100">
                    <div class="form-control-wrap ">
                        <div class="form-control-select">
                            <select class="form-control condition-select" name="advice" required>
                                <option value="">Select condition</option>
                                <option value="or">OR</option>
                                <option value="and">AND</option>
                            </select>
                        </div>
                    </div>
                </span>
            </div>
        </div>
    </div>
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
                        <select class="form-select select-question"  name="question[]"
                            data-placeholder="Select question">
                            <option></option>
                            @foreach ($questions as $question)
                                <option value="{{ $question->uuid }}">{{ $question->secondary_title }}</option>
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