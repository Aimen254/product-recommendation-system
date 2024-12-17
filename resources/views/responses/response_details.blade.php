@extends('layouts.app')
@section('content')
    <!-- content @s -->
    <div class="nk-content nk-content-lg nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    @include('layouts.includes.survey_builder_tabs')
                    
                    <div class="nk-block pt-0">
                        <div class="card card-bordered card-full">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Survey Responses</h6>
                                    </div>
                                    <div class="card-tools"><div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left"><em
                                                    class="icon ni ni-search"></em></div><input type="text"
                                                class="form-control" id="searchBar" placeholder="Search">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                               
                            <table class="nk-tb-list nk-tb-ulist" id="response-table">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                            
                                        <th class="nk-tb-col py-2"><span class="sub-text">Id</span></th>
                                        <th class="nk-tb-col py-2"><span class="sub-text">Question</span></th>
                                        <th class="nk-tb-col py-2"><span class="sub-text">Answer</span></th>
                                    </tr><!-- .nk-tb-item -->
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            

                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
    $(document).ready(function() {
        // Fetch data using datatable start
        $currentAccount = '{{ currentAccount() }}';
        $response_id = '{{$response_id}}';
        $(function() {
            var table = $('#response-table').DataTable({
                ajax: {
                    url: "{{ route('get_response_answer', [currentAccount(), currentProject(),$response_id]) }}",
                },
                processing: false,
                serverSide: true,
                scrollX: false,
                autoWidth: false,
                stateSave: false,
                lengthChange: false,
                bAutoWidth: false,
                dom:'ltpr',
                language: {
                    paginate: {
                        previous: "Prev",
                        next: "Next",
                    },
                    info: "",
                    emptyTable: "No Response Available",
                    infoFiltered:"",
                    select: {
                        rows: {
                            _: " (%d rows selected)",
                            0: "",
                            1: " (1 row selected)",
                        }
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        sClass: "nk-tb-col",
                        orderable: false
                    },
                    {
                        data: 'question',
                        name: 'question',
                        sClass: "nk-tb-col",
                        orderable: false
                    },
                    {
                        data: 'answer',
                        name: 'answer',
                        sClass: "nk-tb-col",
                        orderable: false
                    },

                ],
                "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');

                },
                "drawCallback": function(settings) {
                    
                    $('#response-table_paginate').css({
                        'padding': '10px 25px'
                    });
                }
            });
            $('#searchBar').on( 'keyup', function () {
                table.search($('#searchBar').val()).draw();
            });
        });
        // datatable fetch end
    });
</script>
@endpush
