@extends('layouts.app')
@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Projects</h3>

                        </div><!-- .nk-block-head-content -->

                        <div class="nk-block-head-content @if(!$projects->count()) d-none @endif search-add-product">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left"><em class="icon ni ni-search"></em></div><input type="text" class="form-control" id="search" placeholder="Search">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt"><a class="btn btn-primary" data-toggle="modal" href="" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('projects.create', currentAccount()) }}"><em class="icon ni ni-plus" data-callback="fetchData"></em><span>Add
                                                    Project</span></a></li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->

                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block" id="project">
                    <!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    fetch_all_projects()
    // add data-callback="fetchData" in <form> to call this function after form submit
    $(document).ready(function() {
        localStorage.clear();
        // fetchData();
        // AJAX Search Start
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajaxSetup({
                headers: {
                    'csrftoken': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ route('search', currentAccount()) }}",
                data: {
                    'search': $value
                },
                success: function(response) {
                    $('#project').html(response);
                },
                error: function(request, status, error) {
                    console.log("Not found");
                }
            });
        });
        // AJAX Search End
    });
    // pagination section
    $(document).on('click', '#paginate nav a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        localStorage.setItem("url", page);
        var search = $("#search").val();
        $value = $("#search").val();
        if (search != '') {
            route = "{{ route('search', currentAccount()) }}";
            request_type = "GET";
        } else {
            route = "{{ route('fetch_projects', currentAccount()) }}";
            request_type = "POST";
        }
        fetchData(page, route, request_type, $value);
    });

    function fetchData(page, route, request_type, $value) {
        if (page == undefined) {
            page = localStorage.getItem('url');
        }
        if (route == undefined) {
            route = "{{ route('fetch_projects', currentAccount()) }}";
        }
        if (request_type == undefined) {
            request_type = "POST";
        }
        var _token = $("input[name=_token]").val();
        $.ajax({
            url: route,
            method: request_type,
            data: {
                'search': $value,
                _token: _token,
                page: page
            },
            success: function(data) {
                $('#project').html(data);
                console.log($("#project").children().length);
                if ($("#project").children().length > 0) {
                    $('.search-add-product').removeClass('d-none');
                } else {
                    $('.search-add-product').addClass('d-none');
                }
            }
        });
    }


    // Generic fetch data Method
    function fetch_all_projects() {
        var _token = $("input[name=_token]").val();
        $.ajax({
            url: "{{ route('fetch_projects', currentAccount()) }}",
            method: "post",
            data: {
                _token: _token,
            },
            success: function(data) {
                $('#project').html(data);
                console.log($("#project").children().length);
                if ($("#project").children().length > 0) {
                    $('.search-add-product').removeClass('d-none');
                } else {
                    $('.search-add-product').addClass('d-none');
                }
            }
        });
    }
</script>
<script>
    $(document).on('click', '.action-button', function() {
        var preview = $(this).data('preview');
        var inputfile = $(this).data('fileinput');
        // $(inputfile).click();
        $(inputfile).on('change', function(e) {
            var input = e.target;
            if (input.files && input.files[0]) {
                var file = input.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e) {
                    $(preview).attr('src', reader.result).addClass('hasImage');
                }
            }
        })
    });
</script>
@endpush