<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label class="form-label" for="site-off">Optional
                </label>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox"  class="custom-control-input" value="required" name="option" id="site-off">
                <label class="custom-control-label" for="site-off"></label>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-9 offset-lg-3">
        <div class="form-group mt-2">
            <button type="" class="btn btn-lg btn-primary" data-button="submit">Add</button>
        </div>
    </div>
</div>
<script>
      $('.form-select').select2({
        placeholder: $(this).attr('data-placeholder')
    });
</script>