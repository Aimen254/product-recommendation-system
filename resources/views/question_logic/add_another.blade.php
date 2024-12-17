<div class="my-3 field">
    <div class="row answer">
        <div class="col-lg-3">
            <div class="form-group">
                <label class="form-label">If answer is</label>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="form-group">
                <div class="form-control-wrap ">
                    <select class="form-select" data-placeholder="Select answer"  name="answer[]" >
                        <option></option>
                        @foreach ($answers as $answer)
                            <option value="{{ $answer->id }}">{{ $answer->answer }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row question py-2">
        <div class="col-lg-3">
            <div class="form-group">
                <label class="form-label">Next Question</label>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="d-flex justify-content-between">
                <div class="form-group">
                    <div class="form-control-wrap ">
                        <select class="form-select"  name="question[]"
                            data-placeholder="Select question">
                            <option></option>
                            @foreach ($questions as $question)
                            @if($currentQuestion->id != $question->id)
                                <option value="{{ $question->id }}">{{ $question->secondary_title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
