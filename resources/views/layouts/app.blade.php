<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
    <meta name="description" content="Survey Rocks helps e-commerce managers to increase webshop conversion with digital shop assistance software which helps clients to finds the right product that fits the needs.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}">
    <!-- Page Title  -->
    <title>Survey Rocks</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/css/select2.min.css" integrity="sha512-uJC/N2rIguBqX/ZyQwrBLX7/FJXNAMZTfT2VnOIPSk/XxoGPECxkxR/rNejxXkrdMGo9DjPdJNb4Cp2644fg4Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/css/backend/dashlite_style.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    @toastr_css
    @yield('styles')
</head>

<body class="nk-body npc-invest bg-lighter">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            @include('layouts.includes.header')
            <!-- main header @e -->
            <!-- content @s -->

            @yield('content')


            <!-- content @e -->
            <!-- footer @s -->
            @include('layouts.includes.footer')
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
    <!-- generic modal -->
    <div class="modal fade" id="ajax_model" role="dialog" data-backdrop="static">

        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" id="ajax_model_content">
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.9.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/js/select2.min.js" integrity="sha512-5S2V0dJXgfiQwkB+TdWClGaka5GClnSSkU96Hr0Os5+IEqkEdQ50OUfum5XIQfdSJmiFa8P0u7+cdWkVSuWl0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('/js/backend/theme.js') }}"></script>
    <script src="{{ asset('/js/backend/FontPicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete', function() {
                let url = $(this).data('url');
                let reload = $(this).data('reload');
                let tableId = '#' + $(this).data('table');
                let redirect = $(this).data('redirect');
                let callback = $(this).data('callback');
                let triggerred = $(this).data('triggerred');
                deleteConfirmation(url, tableId, reload, redirect, callback, triggerred);
            });

            function deleteConfirmation(url, tableId, reload = false, redirect = false, callback = false, triggerred = false) {
                window.swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this record",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.value) {
                        window.swal.fire({
                            title: "",
                            text: "Please wait...",
                            showConfirmButton: false,
                            backdrop: true
                        });

                        window.axios.delete(url).then(response => {
                            if (response.status === 200) {
                                window.swal.close();
                                // Show toast message
                                Toast.fire({
                                    icon: 'success',
                                    title: response.data.message
                                });
                                if (triggerred) {
                                    $(document).trigger(triggerred);
                                }
                                if (reload == true) {
                                    window.location.reload();
                                }

                                if (redirect) {
                                    window.location.href = redirect;
                                }

                                if (callback) {
                                    window[callback]();
                                }

                                $(tableId).DataTable().ajax.reload();


                            }
                        }).catch(error => {
                            window.swal.close();
                            // Show toast message
                            Toast.fire({
                                icon: 'error',
                                title: error.response.data.message
                            });
                        });
                    }
                });
            }
        });
    </script>
    <!-- page scripts -->
    @stack('scripts')
</body>
@toastr_js
@toastr_render

</html>