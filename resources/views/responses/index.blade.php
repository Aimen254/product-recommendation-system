@extends('layouts.app')
@section('content')
    <!-- content @s -->
    <div class="nk-content nk-content-lg nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    @include('layouts.includes.survey_builder_tabs')

                    <div class="nk-block pt-0">


                        <div class="card card-bordered card-full" id="questions-form">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Survey Responses</h6>
                                    </div>
                                    <div class="card-tools">

                                        <ul class="row" style="width:500px">
                                            <li class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select name="advice"
                                                            class="form-select form-control form-control-lg"
                                                            data-search="on" data-placeholder="Filter by advice">
                                                            <option></option>
                                                            <option value="0">All</option>
                                                            @foreach ($advices as $advice)
                                                                <option class="advice"
                                                                    value="{{ $advice->id }}">
                                                                    {{ $advice->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left"><em
                                                                class="icon ni ni-search"></em>
                                                        </div><input type="text" class="form-control" id="searchBar"
                                                            placeholder="Search">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <table class="nk-tb-list nk-tb-ulist" id="response-table">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">

                                        <th class="nk-tb-col py-2"><span class="sub-text">Id</span></th>
                                        <th class="nk-tb-col py-2"><span class="sub-text">Advice</span></th>
                                        <th class="nk-tb-col py-2 text-center"><span class="sub-text">Date Time</span>
                                        </th>
                                        <th class="nk-tb-col py-2 text-right"><span class="sub-text">View</span></th>
                                    </tr><!-- .nk-tb-item -->
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- .card-inner -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- content @e -->
@push('scripts')
    <script>
        $(document).ready(function() {
            // Fetch data using datatable start
            $currentAccount = '{{ currentAccount() }}';
            $(function() {
                var advice = '';
                // Filter
                $('select').on('select2:select', function() {
                    advice = $(this).val();
                    table.draw();
                });
                var table = $('#response-table').DataTable({
                    ajax: {
                        url: "{{ route('get_response', [currentAccount(), currentProject()]) }}",
                        'data': function(d) {
                            d.advice = advice
                        },
                    },
                    processing: false,
                    serverSide: true,
                    scrollX: false,
                    autoWidth: false,
                    stateSave: false,
                    lengthChange: false,
                    bAutoWidth: false,
                    dom: 'ltpr',
                    language: {
                        paginate: {
                            previous: "Prev",
                            next: "Next",
                        },
                        info: "",
                        emptyTable: "No Response Available",
                        infoFiltered: "",
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
                            data: 'advice',
                            name: 'advice',
                            sClass: "nk-tb-col",
                            orderable: false
                        },
                        {
                            data: 'date',
                            name: 'date',
                            sClass: "nk-tb-col text-center",
                            orderable: false
                        },
                        {
                            data: 'view',
                            name: 'view',
                            sClass: "nk-tb-col text-right",
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
                $('#searchBar').on('keyup', function() {
                    table.search($('#searchBar').val()).draw();
                });

            });
            // datatable fetch end
        });
    </script>
@endpush
