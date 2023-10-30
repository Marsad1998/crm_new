@php
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="inner-body">
            <h3 class="mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">Price Manager</h3>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover table-bordered align-middle" id="logTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Log Name</th>
                                    <th>Event</th>
                                    <th>Done By</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> {{-- body --}}
            </div> {{-- card --}}
        </div>
    </div>

    <div class="modal fade" id="priceManagerModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Add a Price</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div style="border: 1px solid black; padding: 20px; border-radius: 5px">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="make_id">Make</label>
                                    <select class="form-control form-control-c" name="make_id" id="make_id">
                                        <option>~~ Select ~~</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="model_id">Model</label>
                                    <select class="form-control form-control-c" name="model_id" id="model_id">
                                        <option>~~ Select ~~</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="year_from">Year From</label>
                                    <input type="text" class="form-control form-control-c" name="year_from" id="year_from">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="year_to">Year To</label>
                                    <input type="text" class="form-control form-control-c" name="year_to" id="year_to">
                                </div>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-c btn-primary"><i class="fas fa-plus"></i> Add</button>
                            </div>
                        </div> {{-- row --}}
                    </div> {{-- main div --}}

                    <div class="mt-2" style="border: 1px solid black; padding: 20px; border-radius: 5px">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="service_id">Service</label>
                                    <select class="form-control form-control-c" name="service_id" id="service_id">
                                        <option>~~ Select ~~</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="key_type">Key Type</label>
                                    <select class="form-control form-control-c" name="key_type" id="key_type">
                                        <option>~~ Select ~~</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-center align-items-center">
                                <strong>Which Key Manufacturer</strong>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-center align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="OEMRadio" name="key_manu">
                                    <label class="form-check-label" for="OEMRadio">OEM</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="afterRadio" name="key_manu">
                                    <label class="form-check-label" for="afterRadio">Aftermarket</label>
                                </div>
                            </div>
                        </div> {{-- row --}}

                        <div class="row mt-4">
                            <div class="col-sm-8">
                                <div class="row">
                                    <label for="comfort_access" class="col-sm-4">Comfort Access?</label>
                                    <div class="col-sm-2 d-flex justify-content-center form-check form-switch">
                                        <input class="form-check-input switch-c" type="checkbox" id="comfort_access" name="comfort_access">
                                    </div>
                                    <label for="akl" class="col-sm-4">Set 'All Keys Lost' Price?</label>
                                    <div class="col-sm-2 d-flex justify-content-center form-check form-switch">
                                        <input class="form-check-input switch-c" type="checkbox" id="akl" name="akl">
                                    </div>
                                </div> {{-- inner row --}}
                                <div class="row">
                                    <div class="col-sm-3 mt-3">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control form-control-c" name="amount" id="amount" placeholder="00.00">
                                    </div>
                                    <div class="col-sm-9 mt-3">
                                        <label for="notes">Notes</label>
                                        <input type="text" class="form-control form-control-c" name="notes" id="notes" placeholder="Notes">
                                    </div>
                                </div> {{-- inner row --}}
                            </div> {{-- outer col --}}
                            <div class="col-sm-2">
                                <div class="form-group justify-content-end">
                                    <label for="imgInput">Select Image</label><br>
                                    <div class="image-container">
                                        <div class="icon-button-top">
                                            <i class="fas fa-pencil-alt"></i>
                                        </div>
                                        <div class="icon-button-bottom">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <img src="{{ global_asset('storage/common/camera_preview.jpg') }}" id="imagePreview">
                                    </div>

                                    <input type="file" name="file" class="d-none" id="imgInput" onchange="readURL(this)">
                                </div>
                            </div> {{-- outer col --}}
                            <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-c btn-primary"><i class="fas fa-plus"></i> Add</button>
                            </div>
                        </div> {{-- outer row --}}
                    </div> {{-- main div --}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $("#priceManagerModal").modal('show');

                var logTable = $("#logTable").DataTable({
                    dom: '<"row"<"col-sm-4"l><"col-sm-4"B><"col-sm-4"f>>rt<"row"<"col-sm-4"i><"col-sm-4"><"col-sm-4"p>>',
                    stateSave: true,
                    "ajax": {
                        url: "/load_logs", // json datasource
                        type: 'post', // method  , by default get
                    },
                    'order': [],
                    buttons: [
                        {
                            className: "mx-2 btn-c",
                            text: '<i class="fas fa-plus-circle"></i> Add Price',
                            action: function (e, dt, node, config) {
                                $("#priceManagerModal").modal('show')
                            }
                        },
                        {
                            className: "mx-2 btn-c",
                            text: '<i class="fas fa-filter"></i> Filters',
                            action: function (e, dt, node, config) {
                                alert();
                            }
                        },
                        {
                            className: "mx-2 btn-c",
                            text: 'Bulk Discount',
                            action: function (e, dt, node, config) {
                                alert();
                            }
                        },
                    ],
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'subject_type'
                        },
                        {
                            data: 'event'
                        },
                        {
                            data: 'causer_id'
                        },
                        {
                            data: 'created_at'
                        },
                    ]
                });

                $(document).on('click', '.icon-button-top', function () {  
                    $("#imgInput").click();
                });

                $(document).on('click', '.icon-button-bottom', function () {  
                    $('#imagePreview').attr('src', "{{ global_asset('storage/common/camera_preview.jpg') }}");
                    $('#imgInput').val('');
                });
            }); // ready

            //File Input With Preview and Validation
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var fileExtension = ['jpeg', 'jpg', 'png'];
                    var fileSize = input.files[0].size;
                    var reader = new FileReader(); // Add parentheses here
                    reader.onload = function () { // file is loaded
                        // check image extensions
                        if ($.inArray($(input).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                            swal('Opss', 'Only formats are allowed: ' + fileExtension.join(', '), 'error')
                            $(".icon-button-bottom").trigger('click')
                        } else {
                            // check image size
                            if (fileSize > 2000000) {
                                swal('Opss', 'Image Size Can Not be more than 2MB', 'error')
                                $(".icon-button-bottom").trigger('click')
                            } else {
                                var img = new Image();
                                img.src = reader.result;
                                img.onload = function() {
                                    $('#imagePreview').attr('src', reader.result);
                                }
                            }
                        }
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection