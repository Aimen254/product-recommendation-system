@extends('layouts.app')
@section('styles')
<style>
    .note-editable ul {
        list-style: disc !important;
        list-style-position: inside !important;
    }

    .note-editable ol {
        list-style: decimal !important;
        list-style-position: inside !important;
    }
</style>
@endsection
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
                            <h3 class="nk-block-title page-title">Products - {{ getActiveAccount()->name }}</h3>

                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left"><em class="icon ni ni-search"></em></div><input type="text" class="form-control" id="searchBar" placeholder="Search">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <ul class="nk-tb-actions gx-1">
                                                <li>
                                                    <div class="drodown show">
                                                        <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="true"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right" x-placement="top-end" style="position: absolute; transform: translate3d(-154px, -76px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a class="btn" href="{{ asset('images/template.csv') }}">Download Template</a></li>
                                                                <li><a class="btn" data-toggle="modal" href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('load-import-products-modal', currentAccount()) }}">Import</a></li>
                                                                <li><a href="javascript:void(0);" class="btn" data-href="{{ route('export-products', currentAccount()) }}" id="export" onclick="exportProducts(event.target);">Export</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nk-block-tools-opt"><a class="btn btn-primary" data-toggle="modal" href="" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('products.create', currentAccount()) }}"><em class="icon ni ni-plus"></em><span>Add Product</span></a></li>

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
                                <table class="nk-tb-list nk-tb-ulist" id="products-table">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col py-2"><span class="sub-text">Name</span></th>
                                            <th class="nk-tb-col py-2"><span class="sub-text">Code</span></th>
                                            <th class="nk-tb-col py-2 tb-col-lg"><span class="sub-text">Description</span></th>
                                            <th class="nk-tb-col py-2 tb-col-lg"><span class="sub-text">URL</span></th>
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
    var field_type = null;
    $(document).ready(function() {
        // Fetch data using datatable start
        $currentAccount = '{{ currentAccount() }}';
        $(function() {
            var table = $('#products-table').DataTable({
                ajax: {
                    url: "{{ route('products.datatable', currentAccount()) }}",
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
                    emptyTable: "No Products Available",
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
                        data: 'title',
                        name: 'title',
                        sClass: "nk-tb-col",
                        orderable: true
                    },
                    {
                        data: 'code',
                        name: 'code',
                        sClass: "nk-tb-col",
                        orderable: false
                    },
                    {
                        data: 'description',
                        name: 'description',
                        sClass: "nk-tb-col",
                        orderable: false
                    },
                    {
                        data: 'url',
                        name: 'url',
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

                    $('#products-table_paginate').css({
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

    // Export Products
    function exportProducts(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
    }
    $("body").on("change", '.custom-file-input', function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endpush
