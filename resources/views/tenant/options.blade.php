@php
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="inner-body">
            <h3 class="page-heading"><i class='fas fa-network-wired'></i> Manage Options</h3>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('option.add') }}" class="formData" method="post">
                                <div class="form-group">
                                    <label for="option_name">Parameter Name</label>
                                    <input type="text" class="form-control form-control-c" placeholder="Parameter Name" name="option_name" id="option_name" required>
                                    <small id="option_name_error" class="text-danger error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="option_type">Parameter Type</label>
                                    <select class="form-control form-control-c" name="option_type" id="option_type" required>
                                        <option>~~ SELECT ~~</option>
                                        <option value="input">Text Field / Input Field</option>
                                        <option value="select">Selectable Field</option>
                                        <option value="radio">Radio Checkbox Field</option>
                                        <option value="switch">Switch Field</option>
                                    </select>
                                    <small id="option_type_error" class="text-danger error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="option_category">Category</label>
                                    <select class="form-control form-control-c" name="option_category" id="option_category" required>
                                        <option>~~ SELECT ~~</option>
                                        @foreach ($options as $x => $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                        {{-- <option value="other">Others</option> --}}
                                    </select>
                                </div>
                                <div class="mb-3 option1Div">
                                    <label for="">Operaters</label>
                                    <select class="form-control form-control-c" id="option_operator" name="option_operator" required>
                                        <option value="no_effect">No Effect</option>
                                        <option value="additive">+ / - (e.g. -$50)</option>
                                        <option value="multiplicative">% (e.g. 120%)</option>
                                    </select>
                                    <small id="option_operator_error" class="text-danger error"></small>
                                </div>

                                @if (Auth::user()->can('Add Option'))
                                    <button type="submit" id="saveData" class="btn btn-c btn-primary btn-block">Save</button>
                                @else
                                    <div class="alert alert-danger flex items-center" role="alert"> <i
                                            data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> You Don't
                                        Have Right To Perform this Action </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div> {{-- inner col-4 --}}
                <div class="col-sm-8">
                    <div class="card shadow" >
                        <div class="card-body">
                            <div class="table-responsive mt-3">
                                <table class="table table-striped table-hover table-bordered align-middle" id="makenModal">
                                    <table class="table table-striped table-hover table-bordered align-middle" id="optionTable">
                                        <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Parameter Name</th>
                                            <th>Category</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-capitalize">
                                        </tbody>
                                    </table>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> {{-- inner col-8 --}}
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
                            <input type="text" id="option_value_name" required class="form-control form-control-c" autofocus="true">
                            <small id="option_value_name_error" class="text-danger error"></small>
                        </div>
                        <div class="mb-3 optionDiv">
                            <label for="option_value_amount" class="form-label">Amount</label>
                            <input type="text" id="option_value_amount" class="form-control form-control-c">
                            <small id="option_value_amount_error" class="text-danger error"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-c btn-primary saveOptions">Save</button>
                        <button type="button" class="btn btn-c btn-secondary" data-bs-dismiss="modal">Close</button>
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
                    // Find the parent <tr> of the clicked button
                    var tr = $(this).closest('tr');

                    // Get the second td value within the parent tr
                    var secondTdValue = tr.find('td:nth-child(2)').text();
                    $("#options_name").html(secondTdValue)
                    var third = $(this).data('type');

                    $(".optionDiv").hide();
                    $("#option_value_amount").removeAttr('required')
                    if (third == 'no_effect') {
                        $(".optionDiv").hide();
                        $("#option_value_amount").removeAttr('required');
                        console.log('if');
                    }else{
                        $(".optionDiv").show();
                        console.log('ifelse');
                        $("#option_value_amount").prop('required', true);
                    }

                    $("#optionsForm").attr('action', "{{ route('option.value_add', ['id' => ':id']) }}".replace(':id', id));
                    $("#optionsVModal").modal('show');
                });

                // $(".option1Div").hide();
                // $("#option_operator").removeAttr('required')
                // $(document).on('change', '#option_category', function () {
                //     var type = $(this).val()

                //     if (type == 'automotive') {
                //         $(".option1Div").hide();
                //         $("#option_operator").removeAttr('required').val('');
                //     }else{
                //         $(".option1Div").show();
                //         $("#option_operator").prop('required', true);
                //     }

                // });

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
                            option_value_amount: $("#option_value_amount").val(),
                        },
                        dataType: "json",
                        success: function (response) {
                            $("#option_value_name").val('')
                            $("#option_value_amount").val('')
                            // $("#optionsVModal").modal('hide')
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
                                $("#option_value_amount").val(response.amount);

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
                            data: 'option_category'
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

                        if (models[i].amount !== null) {
                            var amount = models[i].amount
                        }else{
                            var amount = 'N/A';
                        }
                        table += '<tr class="'+id+'">\
                                    <td></td>\
                                    <td><span class="badge bg-light text-danger">Values</span></td><td>' + models[i].name + '</td>\
                                    <td>'+amount+'</td>\
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
                            $("#option_category").val(response.category_id)
                            $("#option_operator").val(response.operator);
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
