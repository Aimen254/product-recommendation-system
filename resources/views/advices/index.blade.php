@extends('layouts.app')
@section('content')
    <!-- content @s
        -->
        <div class="nk-content nk-content-fluid">
            <div class="container-xl wide-xl">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h3 class="nk-block-title page-title">Advices - {{ getActiveAccount()->name }}</h3>

                                </div><!-- .nk-block-head-content -->
                                <div class="nk-block-head-content">
                                    <div class="toggle-wrap nk-block-tools-toggle">
                                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                            data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                        <div class="toggle-expand-content" data-content="pageMenu">
                                            <ul class="nk-block-tools g-3">
                                                <li>
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left"><em
                                                                    class="icon ni ni-search"></em></div><input type="text"
                                                                class="form-control" id="searchBar" placeholder="Search">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nk-block-tools-opt"><a class="btn btn-primary" data-toggle="modal"
                                                        href="" data-act="ajax-modal" data-complete-location="true"
                                                        data-method="get"
                                                        data-action-url="{{ route('load-import-advices-modal', currentAccount()) }}"><em
                                                            class="icon ni ni-up"></em><span>Import</span></a></li>
                                                <li>
                                                <li>
                                                    <span data-href="{{ route('export-advices', currentAccount()) }}"
                                                        id="export" class="btn btn-primary"
                                                        onclick="exportAdvices(event.target);">Export</span>
                                                </li>
                                                <li class="nk-block-tools-opt"><a class="btn btn-primary" data-toggle="modal"
                                                        href="" data-act="ajax-modal" data-complete-location="true"
                                                        data-method="get"
                                                        data-action-url="{{ route('advices.create', currentAccount()) }}"><em
                                                            class="icon ni ni-plus"></em><span>Add advice</span></a></li>
                                            </ul>
                                        </div>
                                    </div><!-- .toggle-wrap -->
                                </div><!-- .nk-block-head-content -->
                            </div><!-- .nk-block-between -->
                        </div><!-- .nk-block-head -->
                        <div class="nk-block">
                            <div class="card card-bordered card-stretch">
                                <div class="card-inner-group">
                                    <div class="card-inner p-0">
                                        <table class="nk-tb-list nk-tb-ulist" id="advices-table">
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">

                                                    <th class="nk-tb-col py-2"><span class="sub-text">Id</span></th>
                                                    <th class="nk-tb-col py-2"><span class="sub-text">Title</span></th>
                                                    <th class="nk-tb-col py-2"><span class="sub-text">Secondary Title</span>
                                                    </th>
                                                    <th class="nk-tb-col py-2 tb-col-lg"><span
                                                            class="sub-text">Categories</span></th>
                                                    <th class="nk-tb-col py-2 tb-col-lg"><span class="sub-text">Products</span>
                                                    </th>
                                                    <th class="nk-tb-col py-2"><span class="sub-text">Impressions</span>
                                                    </th>
                                                    <th class="nk-tb-col py-2 text-right"><span class="sub-text">Action</span>
                                                    </th>

                                                </tr><!-- .nk-tb-item -->
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table><!-- .nk-tb-list -->
                                    </div><!-- .card-inner -->
                                </div><!-- .card-inner-group -->
                            </div><!-- .card -->
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
        <!-- content @e -->
    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                // Fetch data using datatable start
                $currentAccount = '{{ currentAccount() }}';
                $(function() {
                    var table = $('#advices-table').DataTable({
                        ajax: {
                            url: "{{ route('advices.datatable', currentAccount()) }}",
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
                            emptyTable: "No Advices Available",
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
                                orderable: true
                            },
                            {
                                data: 'title',
                                name: 'title',
                                sClass: "nk-tb-col",
                                orderable: false
                            },
                            {
                                data: 'secondary_title',
                                name: 'secondary_title',
                                sClass: "nk-tb-col",
                                orderable: false
                            },
                            {
                                data: 'categories',
                                name: 'categories',
                                sClass: "nk-tb-col",
                                orderable: false
                            },
                            {
                                data: 'products',
                                name: 'products',
                                sClass: "nk-tb-col",
                                orderable: false
                            },
                            {
                                data: 'impressions',
                                name: 'impressions',
                                sClass: "nk-tb-col",
                                orderable: false
                            },
                            {
                                data: 'action',
                                name: 'action',
                                sClass: "nk-tb-col",
                                orderable: false,
                                searchable: false
                            },
                        ],
                        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                            $(nRow).addClass('nk-tb-item');

                        },
                        "drawCallback": function(settings) {

                            $('#advices-table_paginate').css({
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
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(document).on('click', '.add-sortable-item-field', function(e) {
                btn1 = $(this).parents('.sortable-item');
                e.preventDefault();
                $.ajax({
                    url: "{{ route('advices.get_categories', [currentAccount()]) }}",
                    data: {},
                    success: function(data) {
                        $(data).insertAfter(btn1);
                        $('.js-example-basic-multiple').select2({
                            // minimumResultsForSearch: Infinity,
                            placeholder: "Select a category"
                        });
                    }
                });
            });
            $(document).on('click', '.remove-sortable-item-field', function(e) {
                e.preventDefault();
                btn = $(this).parents('.sortable-item');
                if ($("#sortable").children().length > 1) {
                    btn.remove();
                } else {
                    toastMessage('Minimum 1 category is required', 'error');
                }
            });

            // Export Advices
            function exportAdvices(_this) {
                let _url = $(_this).data('href');
                window.location.href = _url;
            }
            $("body").on("change", '.custom-file-input', function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

        </script>
    @endpush
