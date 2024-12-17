<form action="{{route('send-feedback')}}" method="POST" id="feedback-form" enctype="multipart/form-data"
    data-form="ajax-form"  data-modal="#ajax_model">
    @csrf
    <div class="modal-header align-center">
        <div class="nk-file-title">

            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Share Feedback</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{$user->first_name.' '.$user->last_name}}" readonly style="cursor: not-allowed;">
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly style="cursor: not-allowed;">
        </div>
        <div class="form-group">
            <label for="name">Message</label>
            <textarea class="form-control" name="message" aria-label="With textarea" spellcheck="false" required></textarea>
        </div>
        

    </div><!-- .modal-body -->
    <div class="modal-footer bg-white">
        <ul class="btn-toolbar g-3">
            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
            <li><button href="#" type="submit" class="btn btn-primary">Submit</button></li>
        </ul>
    </div><!-- .modal-footer -->
</form>
<script>
</script>
