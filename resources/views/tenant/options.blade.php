@php
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="inner-body">
            <div class="card mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">
                <div class="card-header p-3 tx-medium my-auto tx-white tenant-nav">Manage Options</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <form action="{{ route('option.add') }}" class="formData" method="post">
                                <div class="form-group">
                                    <label for="option_name">Parameter Name</label>
                                    <input type="text" class="form-control" placeholder="Parameter Name" name="option_name" id="option_name">
                                    <small id="option_name_error" class="text-danger error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="option_type">Parameter Type</label>
                                    <select class="form-control" name="option_type" id="option_type">
                                        <option>~~ SELECT ~~</option>
                                        <option value="input">Text Field / Input Field</option>
                                        <option value="select">Selectable Field</option>
                                        <option value="radio">Radio Checkbox Field</option>
                                        <option value="switch">Switch Field</option>
                                    </select>
                                    <small id="option_type_error" class="text-danger error"></small>
                                </div>
                                <button type="submit" id="saveData" class="btn ripple btn-primary btn-block">Save</button>
                                {{-- @if (Auth::user()->can('Add Role'))
                                @else
                                    <div class="alert alert-danger flex items-center" role="alert"> <i
                                            data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> You Don't
                                        Have Right To Perform this Action </div>
                                @endif --}}
                            </form>
                        </div> {{-- inner col-4 --}}
                        <div class="col-sm-8">
                            <div class="table-responsive mt-3">
                                <table class="table table-striped table-hover table-bordered align-middle" id="makenModal">
                                    <table class="table table-striped table-hover table-bordered align-middle" id="optionTable">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>#</th>
                                                <th>Parameter Name</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </table>
                            </div>
                        </div> {{-- inner col-8 --}}
                    </div> {{-- inner row --}}
                </div> {{-- body --}}
            </div> {{-- card --}}
        </div>
    </div>
    
    <div class="modal animate__animated animate__zoomIn animate__faster" id="optionsVModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Options for <span id="options_name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" id="optionsForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="option_value_name" class="form-label">Parameters Values</label>
                            <input type="text" id="option_value_name" required class="form-control" autofocus="true">
                            <small id="option_value_name_error" class="text-danger error"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary saveOptions">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('script')
        <script>
            $(document).ready(function() {

                $(document).on('click', '.addSelectOptions', function () {
                    var id = $(this).attr('id')
                    $("#optionsForm").attr('action', "{{ route('option.value_add', ['id' => ':id']) }}".replace(':id', id));
                    $("#optionsVModal").modal('show');
                });

                $(document).on('click', '.main-toggle', function() {
                    $(this).toggleClass('on');
                })

                $("#optionsForm").on('submit', function (e) {
                    e.preventDefault();
                    var url = $("#optionsForm").attr('action')
                    $("#saveOptions").prop('disabled', true)
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            option_value_name: $("#option_value_name").val(),
                        },
                        dataType: "json",
                        success: function (response) {
                            $("#option_value_name").val('')
                            $("#optionsVModal").modal('hide')
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                            optionTable.ajax.reload(null, false);
                            $("#saveOptions").prop('disabled', true)
                        },
                        error: function (response) {
                            console.log(response);
                            var errorResponse = $.parseJSON(response.responseText);
                            $(".error").text('');
                            $.each(errorResponse.errors, function (key, value) {
                                $("#" + key + "_error").text(value);
                            });
                            $("#saveOptions").prop('disabled', false)
                        }
                    });
                });

                $(document).on('click', '.modifyOptions', function () {
                    var id = $(this).attr('id');
                    var type = $(this).data('type');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('option.value_modify') }}",
                        data: {
                            id: id,
                            type: type
                        },
                        dataType: "json",
                        success: function (response) {
                            if (type == 'edit') {
                                $('.saveOptions').attr('id', id);
                                $("#optionsVModal").modal('show')
                                $("#option_value_name").val(response.name);
                                $("#optionsForm").attr('action', "{{ route('option.update_values', ['option_v_id' => ':id']) }}".replace(':id', id));
                            }else{
                                notif({
                                    type: response.sts,
                                    msg: response.msg,
                                    position: 'right',
                                    bottom: 10,
                                    time: 2000,
                                });    
                                optionTable.ajax.reload(null, false);
                            }
                        }
                    });
                });

                //Save Data into Database
                $(".formData").on('submit', function(e) {
                    e.preventDefault();
                    $("#saveData").prop('disabled', true);
                    var form = $('.formData');
                    $.ajax({
                        type: 'POST',
                        url: form.attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            $(".formData").attr('action', "{{ route('option.add') }}");
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
                    }); //ajax call
                }); //main

                var optionTable = $("#optionTable").DataTable({
                    stateSave: true,
                    "ajax": {
                        url: "{{ route('option.load') }}", // json datasource
                        type: 'post', // method  , by default get
                    },
                    'order': [],
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'type'
                        },
                        {
                            data: 'action'
                        },
                    ],
                    drawCallback: function (settings) {
                        // Add click event listener to the plus button
                        $('.show-models').off('click').on('click', function () {
                            var class1 = $(this).data('class');
                            var id = $(this).attr('id');
                            var tr = $(this).closest('tr');
                            $("."+id).remove();

                            if (class1 == 'hide') {
                                $("#"+id).html('<i class="fe fe-minus"></i>');
                                $("#"+id).data('class', 'show');
                                var option_values = settings.json.option_values.filter(function (model) {
                                    return model.option_id == id.substr(4); // Filter models by make_id
                                });
                                tr.after(formatChildRow(option_values, id));
                            }else{
                                $("#"+id).html('<i class="fe fe-plus"></i>');
                                $("#"+id).data('class', 'hide');
                            }
                        });
                    }
                });

                // Function to format the child row content
                function formatChildRow(models, id) {
                    if (!models || !Array.isArray(models) || models.length === 0) {
                        return '<tr class="'+id+'"><td colspan="3">No models available<td></tr>'; // Handle the case where models is empty or undefined
                    }

                    var table = "";
                    for (var i = 0; i < models.length; i++) {
                        var rand1 = Math.floor(Math.random()*90000) + 10000;
                        var rand2 = Math.floor(Math.random()*90000) + 10000;
                        var did = rand1+""+models[i].id+""+rand2
                        table += '<tr class="'+id+'">\
                                    <td></td>\
                                    <td><span class="badge bg-light text-danger">Values</span></td><td>' + models[i].name + '</td>\
                                    <td>\
                                        <button class="modifyOptions btn btn-sm ripple btn-outline-info" data-type="edit" id="'+ btoa(did) +'">\
                                            <i class="fe fe-edit-2"></i>\
                                        </button>\
                                        <button class="modifyOptions btn btn-sm ripple btn-outline-danger" data-type="delete" id="'+ btoa(did) +'">\
                                            <i class="fe fe-trash"></i>\
                                        </button>\
                                    </td>\
                                </tr>';
                    }
                    return table;
                }

                $(document).on('click', ".edit", function() {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('option.get', ['id' => ':id']) }}".replace(':id', id),
                        dataType: "json",
                        success: function(response) {
                            $("#saveData").text('Update').addClass('btn-danger').removeClass('btn-primary');
                            $(".formData").attr('action', "{{ route('option.update', ['id' => ':id']) }}".replace(':id', id));

                            $("#option_name").val(response.name)
                            $("#option_type").val(response.type)
                        }, 
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    });
                });

                $(document).on("click", ".delete", function() {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('option.delete', ['id' => ':id']) }}".replace(':id', id),
                        dataType: "json",
                        success: function(response) {
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                            optionTable.ajax.reload(null, false);
                        }, 
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    });
                });
            }); // ready
        </script>
    @endpush
@endsection
