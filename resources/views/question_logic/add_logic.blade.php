<div  class="condition-remove back_ground pt-5" style="background-color:#ffffff">
        
<div class="condition-remove row question py-2">
    <div class="col-lg-2">
        <div class="form-group">
            <label class="form-label">Operator</label>
        </div>
    </div>
    <div class="col-lg-9">
        <div class=" d-flex justify-content-between">
            <div class="form-group">
                <div class="form-control-wrap ">
                    <div class="append-select">
                    </div>
                    <select id="test" class="form-select operator-select" data-search="off" name="data[details][1][logic]"
                    data-placeholder="Select Logic">
                    <option></option>
                    <option value=""  disabled>Options</option>
                    <option class="default" value="default"> Default </option>
                    <option class="equal to" value="equal to"> Equal to </option>
                    <option class="not equal to" value="not equal to"> Not Equal to </option>
                    <option class="greater than" value="greater than"> Greater than </option>
                    <option class="less than" value="less than"> Less than </option>
                </select>
                </div>
            </div>
        </div>
    </div>
    <div class="condition-remove col-lg-1">
        <a href="#" class="py-1 pl-1 remove-condition-fields"><em
            class="icon ni ni-cross-circle-fill text-danger" style="font-size: 16px;"></em></a>
    </div>
</div>

<div class="condition-remove row">
    <div class="col-lg-2">
        <div class="form-group">
            <label class="form-label">If answer is</label>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="form-group">
            <input type="number" class="form-control" name="data[details][1][value]" placeholder="value">
        </div>
    </div>
</div>


<div class="condition-remove row question py-2">
    <div class="col-lg-2">
        <div class="form-group">
            <label class="form-label">Next Question</label>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="d-flex justify-content-between">
            <div class="form-group">
                <div class="form-control-wrap ">
                    <div class="append-select">
                    </div>
                    <select class="form-select select-question" data-search="on" name="data[details][1][question]"
                        data-placeholder="Select question">
                        <option></option>
                        @foreach ($questions as $question)
                                <option value="{{ $question->id }}">
                                    {{ $question->secondary_title }}
                                </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
     $('.form-select').select2({
        placeholder: $(this).attr('data-placeholder')
    });
</script>