@php
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Option;
@endphp
@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="inner-body">
            <h3 class="page-heading">
                Quote Configurator (Set Fields for Price Manager & Quote Gen)
            </h3>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('quote.create') }}" method="post" id="formData">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="category_services" class="form-label">Select a Services</label>
                                    <select class="form-control" id="category_services" name="service_id" required>
                                    </select>
                                    <small id="category_services_error" class="text-danger error"></small>
                                </div>
                                <div class="mt-3">
                                    <label for="fields" class="form-label">Choose Fields</label>
                                    <select class="form-control" id="fields">
                                    </select>
                                    <small id="fields_error" class="text-danger error"></small>
                                </div>

                                <button type="submit" id="saveForm" class="btn btn-c mt-3 btn-primary btn-block">Save</button>
                                <button type="button" id="resetForm" class="btn btn-c mt-2 btn-warning"><i class="fas fa-refresh"></i> Reset</button>
                            </div>
                            <div class="col-lg-5 offset-1">
                                <ul id="treeview2">
                                    <li>
                                        <a href="#" id="serviceName">Service Name</a>
                                        <ul class="sortable">
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>


                </div> {{-- body --}}
            </div> {{-- card --}}

            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-responsive mt-5">
                        <table class="table table-striped table-hover table-bordered align-middle" id="configTbl">
                            <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Service</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {

                $("ul.sortable").sortable();

                $(document).on('click', '#resetForm', function () {
                    $("#category_services").val(null).trigger('change');
                    // $("#fields").val(null).trigger('change');
                    $("#fields").val([]).change();
                    $(".sortable").empty();
                    // location.reload();
                });

                $("#formData").on('submit', function (e) {
                    e.preventDefault();
                    var form = $('#formData');
                    $.ajax({
                        type: "POST",
                        url: form.attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function (response) {
                            configTbl.ajax.reload(null, false);
                            $("#resetForm").trigger('click')
                            $('.formData').each(function() {
                                this.reset();
                            });
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                        }
                    });

                });

                var configTbl = $("#configTbl").DataTable({
                    stateSave: true,
                    responsive: true,
                    "ajax": {
                        url: "{{ route('quote.load') }}", // json datasource
                        type: 'post', // method  , by default get
                    },
                    'order': [],
                    columns: [
                        {
                            data: 'DT_RowIndex'
                        },
                        {
                            data: 'category_id'
                        },
                        {
                            data: 'service_id'
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
                                var models = settings.json.models.filter(function (model) {
                                    return model.service_id == id.substr(4); // Filter models by make_id
                                });
                                tr.after(formatChildRow(models, id));
                            }else{
                                $("#"+id).html('<i class="fe fe-plus"></i>');
                                $("#"+id).data('class', 'hide');
                            }
                        });
                    }
                });

                $("#fields").select2({
                    placeholder: '~~ Select Fields ~~',
                    width: "100%",
                    ajax: {
                        method: 'post',
                        url: '{{ route("quote.fields") }}',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        id: item.id,
                                        text: item.name,
                                    }
                                })
                            }
                        }
                    }
                }).on('select2:select', function (e) {

                    var id = $("#fields option:selected").val();
                    var text = $("#fields option:selected").text();
                    $(".sortable").append(`
                                            <div class="d-flex justify-content-between">
                                                <li style="width: 90%" class="d-flex justify-content-between">
                                                    <span>` + text + `</span>
                                                    <input type="hidden" value="`+id+`" name="option_id[]" />
                                                    <input type="hidden" value="" name="quote_config_id[]" />
                                                    <select name="width[]">
                                                        <option value="6">Half</option>
                                                        <option value="12">Full</option>
                                                    </select>
                                                </li>
                                                <button type="button" class="removeRow1" id=""><i class="fas fa-trash"></i></button>
                                            </div>
                                            `);
                });

                $(document).on('click', '.removeRow1', function () {
                    var id = $(this).attr('id');
                    console.log(id);
                    if (id != '') {
                        $(this).parent().remove();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('quote.delete_config', ['id' => ':id']) }}".replace(':id', id),
                            dataType: "json",
                            success: function (response) {
                                console.log(response);
                            }
                        });
                    }else{
                        $(this).parent().remove()
                    }

                });

                $(document).on("click", ".delete", function() {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('quote.delete', ['id' => ':id']) }}".replace(':id', id),
                        dataType: "json",
                        success: function(response) {
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                            configTbl.ajax.reload(null, false);
                        },
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    });
                });

                $("#category_services").select2({
                    placeholder: '~~ Select Categories ~~',
                    width: "100%",
                    ajax: {
                        method: 'post',
                        url: '{{ route("quote.category") }}',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        "children" : $.map(item.services, function (it) {
                                            return {
                                                id: it.id,
                                                text: it.name,
                                            }
                                        })
                                    };
                                })
                            };
                        },
                    }
                }).on('select2:select', function (e) {
                    e.preventDefault();
                    var id = $(this).val();
                    var text = $("#category_services option:selected").text();
                    $("#serviceName").text(text.trim())

                    $("#fields").val(null).trigger('change');
                    $(".sortable").empty();
                    getData(id);

                });

                $(document).on("click", ".edit", function() {
                    var id = $(this).attr('id');
                    getData(id);
                });

                function getData(id) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('quote.edit', ['id' => ':id']) }}".replace(':id', id),
                        dataType: "json",
                        success: function(response) {

                            if (response.length > 0) {
                                var option = new Option(response[0].service.name, response[0].service.id, false, true);
                                $("#category_services").append(option).trigger('change');

                                $("#fields").val(null).trigger('change');
                                var rowDa = "";

                                $.each(response, function (index, value) {

                                    if (value.option !== null) {

                                        rowDa += `<div class="d-flex justify-content-between">
                                                    <li style="width: 90%" class="d-flex justify-content-between" id="li_`+response[index].id+`">
                                                        <span>`+value.option.name+`</span>
                                                        <input type="hidden" value="`+response[index].id+`" name="quote_config_id[]" />
                                                        <input type="hidden" value="`+value.option.id+`" name="option_id[]" />
                                                        <select name="width[]">
                                                            <option `+(response[index].width == 6 ? 'selected': '')+` value="6">Half</option>
                                                            <option `+(response[index].width == 12 ? 'selected': '')+` value="12">Full</option>
                                                        </select>
                                                    </li>
                                                    <button type="button" class="removeRow1" id="`+response[index].id+`"><i class="fas fa-trash"></i></button>
                                                </div>`;
                                            }
                                });

                                $(".sortable").empty().append(rowDa);
                            }
                        },
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    });
                }

                function formatChildRow(models, id) {
                    if (!models || !Array.isArray(models) || models.length === 0) {
                        return '<tr class="'+id+'"><td colspan="3">No Fields available<td></tr>'; // Handle the case where models is empty or undefined
                    }

                    var table = "";
                    for (var i = 0; i < models.length; i++) {
                        var rand1 = Math.floor(Math.random()*90000) + 10000;
                        var rand2 = Math.floor(Math.random()*90000) + 10000;
                        var did = rand1+""+models[i].id+""+rand2
                        table += '<tr class="'+id+'">\
                                    <td></td>\
                                    <td><span class="badge bg-light text-danger">Parameters</span></td><td>' + models[i].option.name + '</td>\
                                    <td>\
                                        <button class="edit btn btn-sm ripple btn-outline-warning" data-tbl="makenModal" id="models/'+ btoa(did) +'">\
                                            <i class="fe fe-edit-2"></i>\
                                        </button>\
                                        <button class="delete btn btn-sm ripple btn-outline-danger" data-tbl="makenModal" id="models/'+ btoa(did) +'">\
                                            <i class="fe fe-trash"></i>\
                                        </button>\
                                    </td>\
                                </tr>';
                    }
                    return table;
                }

            }); // ready
        </script>
    @endpush
@endsection
