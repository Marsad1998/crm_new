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

    <div class="modal animate__animated animate__zoomIn animate__fasters" id="priceManagerModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Add a Price</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('price.create') }}" id="prcieForm" method="post">
                    <div style="border: 1px solid black; padding: 20px; border-radius: 5px;">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="make_id_1">Make</label>
                                    <select class="form-control form-control-c" name="make_id[0]" id="make_id_1">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="model_id_1">Model</label>
                                    <select class="form-control form-control-c" name="model_id[0]" id="model_id_1">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="year_from_1">Year From</label>
                                    <input type="text" class="form-control form-control-c" name="year_from[0]" id="year_from_1">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="year_to_1">Year To</label>
                                    <input type="text" class="form-control form-control-c" name="year_to[0]" id="year_to_1">
                                </div>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                                <button type="button" onclick="addRow()" class="btn m-2 btn-c btn-primary"><i class="fas fa-plus"></i> Add</button>
                            </div>
                        </div>
                        <div id="vehicle_inform"></div>
                    </div>

                    <div class="mt-2" style="border: 1px solid black; padding: 20px; border-radius: 5px">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="service_id_1">Service</label>
                                    <select class="form-control form-control-c" name="service_id[0]" id="service_id_1">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 non_vehicle_1">
                                <div class="form-group">
                                    <label for="key_type_1">Key Type</label>
                                    <select class="form-control form-control-c" name="key_type[0]" id="key_type_1">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-center align-items-center">
                                <strong class="non_vehicle_1">Which Key Manufacturer</strong>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-center align-items-center">
                                <div class="non_vehicle_1 form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="OEMRadio_1" name="key_manu[0]" value="1">
                                    <label class="form-check-label" for="OEMRadio_1">OEM</label>
                                </div>
                                <div class="non_vehicle_1 form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="afterRadio_1" name="key_manu[0]" value="0">
                                    <label class="form-check-label" for="afterRadio_1">Aftermarket</label>
                                </div>
                            </div>
                        </div> {{-- row --}}

                        <div class="row mt-4">
                            <div class="col-sm-8">
                                <div class="row non_vehicle_1">
                                    <label for="comfort_access_1" class="col-sm-4">Comfort Access?</label>
                                    <div class="col-sm-2 d-flex justify-content-center form-check form-switch">
                                        <input class="form-check-input switch-c" type="checkbox" id="comfort_access_1" name="comfort_access[0]" value="1">
                                    </div>
                                    <label for="akl_1" class="col-sm-4">Set 'All Keys Lost' Price?</label>
                                    <div class="col-sm-2 d-flex justify-content-center form-check form-switch">
                                        <input class="form-check-input switch-c" type="checkbox" id="akl_1" name="akl[0]" value="1">
                                    </div>
                                </div> {{-- inner row --}}
                                <div class="row">
                                    <div class="col-sm-3 mt-3">
                                        <label for="amount_1">Amount</label>
                                        <input type="text" class="form-control form-control-c" name="amount[0]" id="amount_1" placeholder="00.00">
                                    </div>
                                    <div class="col-sm-9 mt-3">
                                        <label for="notes_1">Notes</label>
                                        <input type="text" class="form-control form-control-c" name="notes[0]" id="notes_1" placeholder="Notes">
                                    </div>
                                </div> {{-- inner row --}}
                            </div> {{-- outer col --}}
                            <div class="col-sm-2">
                                <div class="form-group justify-content-end">
                                    <label for="imgInput">Select Image</label><br>
                                    <div class="image-container">
                                        <div class="icon-button-top" id="1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </div>
                                        <div class="icon-button-bottom" id="1">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <img src="{{ global_asset('storage/common/camera_preview.jpg') }}" class="imagePreview" id="img_preveiw_1">
                                    </div>

                                    <input type="file" name="file[0]" class="d-none" onchange="readURL(this, '1')" id="imgInput_1">
                                </div>
                            </div> {{-- outer col --}}
                            <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                <button type="button" onclick="addRew()" class="btn btn-c btn-primary"><i class="fas fa-plus"></i> Add</button>
                            </div>
                        </div> {{-- outer row --}}
                        
                        <div id="detail_inform"></div>
                    </div> {{-- main div --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="saveData" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $("#priceManagerModal").modal('show');

                initSelect(1);
                initDetail(1);

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

                $("#prcieForm").on('submit', function (e) {
                    e.preventDefault();
                    var form = $(this);
                    $("#saveOptions").prop('disabled', true)
                    $.ajax({
                        type: 'POST',
                        url: form.attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            $("#saveData").prop("disabled", false).text('Save').addClass('btn-primary').removeClass('btn-danger');
                            $('.formData').each(function() {
                                this.reset();
                            });
                            optionTable.ajax.reload(null, false);
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                        }, 
                        error: function (jqXhr) {
                            $("#saveData").prop("disabled", false);
                            var errorResponse = $.parseJSON(jqXhr.responseText);
                            $(".error").text('');
                            $.each(errorResponse.errors, function (key, value) {
                                $("#" + key + "_error").text(value);
                            });
                        }
                    });
                });

                $(document).on('click', '.icon-button-top', function () {
                    var id = $(this).attr('id')  
                    $("#imgInput_"+id).click();
                });

                $(document).on('click', '.icon-button-bottom', function () {  
                    var id = $(this).attr('id')
                    $('#img_preveiw_'+id).attr('src', "{{ global_asset('storage/common/camera_preview.jpg') }}");
                    $('#imgInput_'+id).val('');
                });
                
            }); // ready

            var x = 2;
            function addRow() {
                var data = "";

                data = '<div class="animate__animated animate__fadeInDown animate__fasters">\
                            <hr style="border-bottom: 1px solid black">\
                            <div class="row">\
                                <div class="col-sm-6">\
                                    <div class="form-group">\
                                        <label for="make_id_'+x+'">Make</label>\
                                        <select class="form-control form-control-c" name="make_id['+x+']" id="make_id_'+x+'">\
                                        </select>\
                                    </div>\
                                </div>\
                                <div class="col-sm-6">\
                                    <div class="form-group">\
                                        <label for="model_id_'+x+'">Model</label>\
                                        <select class="form-control form-control-c" name="model_id['+x+']" id="model_id_'+x+'">\
                                        </select>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="row">\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                        <label for="year_from_'+x+'">Year From</label>\
                                        <input type="text" class="form-control form-control-c" name="year_from['+x+']" id="year_from_'+x+'">\
                                    </div>\
                                </div>\
                                <div class="col-sm-4">\
                                    <div class="form-group">\
                                        <label for="year_to_'+x+'">Year To</label>\
                                        <input type="text" class="form-control form-control-c" name="year_to['+x+']" id="year_to_'+x+'">\
                                    </div>\
                                </div>\
                                <div class="col-sm-4 d-flex justify-content-center align-items-center">\
                                    <button type="button" onclick="addRow()" class="btn m-2 btn-c\ btn-primary"><i class="fas fa-plus"></i> Add</button>\
                                    <button type="button" onclick="removeRow(this);" class="btn m-2 btn-c\ btn-danger"><i class="fas fa-trash"></i> Remove</button>\
                                </div>\
                            </div>\
                        </div>';
                $("#vehicle_inform").append(data);

                initSelect(x);
                x++;
            }
            
            var y = 2;
            function addRew() {
                var deta = `<div class="animate__animated animate__fadeInDown animate__fasters">
                                <hr style="border-bottom: 1px solid black">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="service_id_`+y+`">Service</label>
                                            <select class="form-control form-control-c" name="service_id[`+y+`]" id="service_id_`+y+`">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 non_vehicle_`+y+`">
                                        <div class="form-group">
                                            <label for="key_type_`+y+`">Key Type</label>
                                            <select class="form-control form-control-c" name="key_type[`+y+`]" id="key_type_`+y+`">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 d-flex justify-content-center align-items-center">
                                        <strong class="non_vehicle_`+y+`">Which Key Manufacturer</strong>
                                    </div>
                                    <div class="col-sm-3 d-flex justify-content-center align-items-center">
                                        <div class="non_vehicle_`+y+` form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="OEMRadio_`+y+`" name="key_manu[`+y+`]">
                                            <label class="form-check-label" for="OEMRadio_`+y+`">OEM</label>
                                        </div>
                                        <div class="non_vehicle_`+y+` form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="afterRadio_`+y+`" name="key_manu[`+y+`]">
                                            <label class="form-check-label" for="afterRadio_`+y+`">Aftermarket</label>
                                        </div>
                                    </div>
                                </div> {{-- row --}}

                                <div class="row mt-4">
                                    <div class="col-sm-8">
                                        <div class="row non_vehicle_`+y+`">
                                            <label for="comfort_access_`+y+`" class="col-sm-4">Comfort Access?</label>
                                            <div class="col-sm-2 d-flex justify-content-center form-check form-switch">
                                                <input class="form-check-input switch-c" type="checkbox" id="comfort_access_`+y+`" name="comfort_access[`+y+`]">
                                            </div>
                                            <label for="akl_`+y+`" class="col-sm-4">Set 'All Keys Lost' Price?</label>
                                            <div class="col-sm-2 d-flex justify-content-center form-check form-switch">
                                                <input class="form-check-input switch-c" type="checkbox" id="akl_`+y+`" name="akl[`+y+`]">
                                            </div>
                                        </div> {{-- inner row --}}
                                        <div class="row">
                                            <div class="col-sm-3 mt-3">
                                                <label for="amount_`+y+`">Amount</label>
                                                <input type="text" class="form-control form-control-c" id="amount_`+y+`" name="amount[`+y+`]" placeholder="00.00">
                                            </div>
                                            <div class="col-sm-9 mt-3">
                                                <label for="notes_`+y+`">Notes</label>
                                                <input type="text" class="form-control form-control-c" id="notes_`+y+`" name="notes[`+y+`]" placeholder="Notes">
                                            </div>
                                        </div> {{-- inner row --}}
                                    </div> {{-- outer col --}}
                                    <div class="col-sm-2">
                                        <div class="form-group justify-content-end">
                                            <label for="imgInput">Select Image</label><br>
                                            <div class="image-container">
                                                <div class="icon-button-top" id="`+y+`">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <div class="icon-button-bottom" id="`+y+`">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                                <img src="{{ global_asset('storage/common/camera_preview.jpg') }}" class="imagePreview" id="img_preveiw_`+y+`">
                                            </div>

                                            <input type="file" name="file[`+y+`]" class="d-none" onchange="readURL(this, '`+y+`')" id="imgInput_`+y+`">
                                        </div>
                                    </div> {{-- outer col --}}
                                    <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                        <button type="button" onclick="addRew()" class="btn btn-c btn-primary"><i class="fas fa-plus"></i></button>
                                        <button type="button" onclick="removeRow(this);" class="btn m-2 btn-c\ btn-danger"><i class="fas fa-trash"></i></button>\
                                    </div>
                                </div> {{-- outer row --}}
                            </div>
                            `;

                $("#detail_inform").append(deta);
                initDetail(y);
                y++;
            }

            function removeRow(thiss) {
                var data = $(thiss).parent().parent().parent();
                data.removeClass('animate__fadeInDown').addClass('animate__zoomOutDown')
                setTimeout(() => {
                    data.remove();
                }, 1000);
            }

            function initSelect(x) {  
                $("#make_id_"+x).select2({
                    placeholder: '~~ Select Makes ~~',
                    width: "100%",
                    dropdownParent: $('#priceManagerModal'),
                    ajax: {
                        method: 'post',
                        url: '{{ route("price.makes") }}',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            var dynamicOptions = $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name,
                                };
                            });

                            var staticOption = { id: 'new', text: '~~ New Makes ~~' };
                            dynamicOptions.push(staticOption);
                            
                            return {
                                results: dynamicOptions
                            }
                        },
                        cache: true,
                    }
                }).on('change', function () {  
                    if ($(this).val() == 'new') {
                        $(".model_id_"+x).val(null).trigger('change');
                        $(this).parent().parent().removeClass('col-sm-6').addClass('col-sm-3')
                        var name = '<div class="col-sm-3 make_name_'+(+x-1)+'">\
                                            <div class="form-group">\
                                            <label for="make_name">New Make</label>\
                                            <input class="form-control form-control-c" name="make_name['+(+x-1)+']" id="make_name">\
                                        </div>\
                                    </div>';
                        
                        $(this).parent().parent().after(name);
                    }else{
                        $(".make_name_"+x).remove();
                        $(this).parent().parent().removeClass('col-sm-3').addClass('col-sm-6')
                    }
                });

                $("#model_id_"+x).select2({
                    placeholder: '~~ Select Models ~~',
                    width: "100%",
                    dropdownParent: $('#priceManagerModal'),
                    ajax: {
                        method: 'post',
                        url: function () {
                            return "{{ route('price.models', ['id' => ':id']) }}".replace(':id', $("#make_id_"+x).val())
                        },
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            var dynamicOptions = $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name,
                                };
                            });

                            var staticOption = { id: 'new', text: '~~ New Model ~~' };
                            dynamicOptions.push(staticOption);
                            
                            return {
                                results: dynamicOptions
                            }
                        },
                        cache: true,
                    }
                }).on('change', function () {
                    if ($(this).val() == 'new') {
                        $(this).parent().parent().removeClass('col-sm-6').addClass('col-sm-3')
                        var name = '<div class="col-sm-3 model_name_'+(+x-1)+'">\
                                            <div class="form-group">\
                                            <label for="model_name">New Model</label>\
                                            <input class="form-control form-control-c" name="model_name['+(+x-1)+']" id="model_name">\
                                        </div>\
                                    </div>';
                        
                        $(this).parent().parent().after(name);
                    }else{
                        $(".model_name_"+x).remove();
                        $(this).parent().parent().removeClass('col-sm-3').addClass('col-sm-6')
                    }
                });
            }

            function initDetail(y) {
                $("#service_id_"+y).select2({
                    placeholder: '~~ Select Services ~~',
                    width: "100%",
                    dropdownParent: $('#priceManagerModal'),
                    ajax: {
                        method: 'post',
                        url: "{{ route('price.services') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            var dynamicOptions = $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name,
                                };
                            });
                            
                            return {
                                results: dynamicOptions
                            }
                        },
                        cache: true,
                    }
                }).on('change', function () {
                    var service = $(this).find(":selected").text();
                    if (service.trim() == 'Key Replacement' || service.trim() == 'Programming') {
                        $(".non_vehicle_"+$(this).attr('id').substr(11)).show();
                    }else{
                        $(".non_vehicle_"+$(this).attr('id').substr(11)).hide();
                    }
                });

                $("#key_type_"+y).select2({
                    placeholder: '~~ Select Key Type ~~',
                    width: "100%",
                    dropdownParent: $('#priceManagerModal'),
                    ajax: {
                        method: 'post',
                        url: "{{ route('price.key_type') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            var dynamicOptions = $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name,
                                };
                            });
                            
                            return {
                                results: dynamicOptions
                            }
                        },
                        cache: true,
                    }
                });

                y++;
            }

            //File Input With Preview and Validation
            function readURL(input, z) {
                if (input.files && input.files[0]) {
                    var fileExtension = ['jpeg', 'jpg', 'png'];
                    var fileSize = input.files[0].size;
                    var reader = new FileReader(); // Add parentheses here
                    reader.onload = function () { // file is loaded
                        // check image extensions
                        if ($.inArray($(input).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                            swal('Opss', 'Only formats are allowed: ' + fileExtension.join(', '), 'error')
                            // $(".icon-button-bottom").trigger('click')
                        } else {
                            // check image size
                            if (fileSize > 2000000) {
                                swal('Opss', 'Image Size Can Not be more than 2MB', 'error')
                                // $(".icon-button-bottom").trigger('click')
                            } else {
                                var img = new Image();
                                img.src = reader.result;
                                img.onload = function() {
                                    $('#img_preveiw_'+z).attr('src', reader.result);
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