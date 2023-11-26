@extends('layouts.main')

@section('content')

    <div class="container-fluid">
        <div class="inner-body quote-generator-box">
            <div class="row mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70 m-3">

                <div class="col-sm-7 col-md-8 col-lg-5 col-xl-5 cstm-margin-0 pr-0">
                    <div class="card h-100 shadow-right-border">
                        <div class="cstm-card-header cstm-border-top quote-page-card-header">Vehicle Informations</div>

                        <form action="{{ route('quote.search') }}" method="post" id="quoteSearch">
                            <div class="cstm-card-body g-quote-body">
                                <div class="d-flex justify-content-evenly cstm-margin-top-10">
                                    <div class="col-2 pl-0">
                                        <label for="category">Category</label>
                                    </div>
                                    <div class="col">
                                        @foreach ($categories as $x => $category)
                                            <div class="radio mt-0 d-inline-block">
                                                <input type="radio" name="category" id="{{ Str::slug($category->name) }}" value="{{ $category->id }}" {{ $category->id == 1 ? "checked": "" }} class="quote_category">
                                                <label class="radio-label" for="{{ Str::slug($category->name) }}">{{ $category->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div><!-- category -->
                                <span class="error-span text-danger " id="error-category"></span>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-2">
                                            <label for="service_id">Service</label>
                                            <select name="service_id" id="service_id" class="form-control form-control-c">
                                            </select>
                                            <span class="error-span text-danger " id="error-service_id"></span>
                                        </div>
                                    </div><!-- service's select2 -->
                                </div><!-- select2 vehicle details -->

                                <div class="row" id="quoteFormFields"></div>

                            </div><!-- custom card body {col-1} -->

                            <div class="cstm-card-footer d-flex justify-content-between align-items-center footer-top-shadow">
                                <p class="cstm-margin-0 text-danger" id="resultResponse"></p>
                                <button type="submit" class="btn footer-btn addQuote">Add to Quote</button>
                            </div><!-- custom card footer {col-1} -->
                        </form>

                    </div><!-- card col-1 -->
                </div> <!-- col 1 -->

                <div class="col-sm-5 col-md-4 col-lg-3 col-xl-3 cstm-margin-0">
                    <div class="card h-100 g-quote-header shadow-right-border">
                        <div class="cstm-card-header cstm-border-top quote-page-card-header">Generated Quote</div><!-- custom card header -->

                        <div class="cstm-card-body g-quote-body">

                            <div class="quoteKeys"></div>
                            <div class="quoteOthers"></div>

                        </div><!-- custom card body -->

                        <div class="cstm-card-footer d-flex justify-content-evenly lead g-quote-footer footer-top-shadow">
                            <span class="float-md-left"><b>Subtotal</b></span>
                            <strong class="float-md-right"><ins><span id="subtotal">00.00</span></ins></strong>
                        </div><!-- custom card footer -->

                    </div><!-- card col-2 -->
                </div> <!-- col 2 -->

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 pad-mar-0-imp">
                    <div class="card h-100 l-info-card shadow-right-border">
                        <div class="cstm-card-header cstm-border-top quote-page-card-header">Lead Info</div><!-- custom card header -->
                        <form action="{{ route('quote.save_lead') }}" id="save_lead" method="post">
                        <div class="cstm-card-body">


                                <div class="form-row">
                                    <div class="col">
                                        <label for="phone_number">Phone Number</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-c" placeholder="Search for..." value="877.514.9393" type="text" name="phone_number" id="phone_number">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary btn-c searchCallBtn" type="button">
                                                    <span class="input-group-btn">
                                                        <i class="fa fa-search"></i>
                                                    </span>
                                                </button>
                                            </span>
                                        </div>
                                        <span class="error-span text-danger " id="error-phonenumber"></span>
                                    </div>

                                    <div class="col">
                                        <label for="caller_name">Caller Name</label>
                                        <input type="text" name="caller_name" class="form-control form-control-c" placeholder="John Smith">
                                        <span class="error-span text-danger " id="error-caller_name"></span>
                                    </div>
                                </div><!-- input-group number details -->

                                <div class="form-row mt-30">
                                    <div class="col">
                                        <label for="quoted_price">Quoted Price</label>
                                        <input type="text" name="quoted_price" id="quoted_price" class="form-control form-control-c" placeholder="00.00" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="custom_price">Custom Price</label>
                                        <div class="form-check form-switch d-flex  mt-2">
                                            <input class="form-check-input switch-c" type="checkbox" name="custom_price" id="custom_price" value="1">
                                        </div>
                                        <span class="error-span text-danger " id="error-custom_price"></span>
                                    </div>
                                </div><!-- input-group price details -->

                                <div class="form-row mt-30">
                                    <div class="col-12">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control form-control-c">
                                            <option value="">~~ SELECT ~~</option>
                                            <option value="Active">Active</option>
                                            <option value="Booked">Booked</option>
                                            <option value="Failed">Failed</option>
                                            <option value="Invalid">Invalid</option>
                                            <option value="Warranty">Warranty</option>
                                        </select>
                                        <span class="error-span text-danger " id="error-status"></span>
                                    </div>
                                    <div class="col-12 mt-30">
                                        <div class="d-flex  cstm-margin-top-20">
                                            <div class="col-2 pl-0">
                                                <label for="call-type">Call Type</label>
                                            </div>
                                            <div class="col">
                                                <div class="radio mt-0 d-inline-block">
                                                    <input type="radio" name="call_type" id="incomming">
                                                    <label for="incomming" class="radio-label">Incomming</label>
                                                </div>
                                                <div class="radio mt-0 d-inline-block">
                                                    <input type="radio" name="call_type" id="outgoing">
                                                    <label for="outgoing" class="radio-label">Outgoing</label>
                                                </div>
                                            </div>
                                        </div><!-- input-group call type -->
                                        <span class="error-span text-danger " id="error-call_type"></span>
                                    </div>

                                    <div class="col-12 mt-30">
                                        <label for="notes">Notes</label>
                                        <textarea name="notes" id="notes" rows="2" class="form-control textarea-c"></textarea>
                                        <span class="error-span text-danger " id="error-notes"></span>
                                    </div><!-- input-group notes textarea -->

                                </div>


                            </div><!-- custom card body -->

                            <div class="cstm-card-footer d-flex justify-content-end l-info-footer footer-top-shadow">
                                <button type="submit" class="btn footer-btn">Save Call</button>
                            </div><!-- custom card footer -->
                        </form>
                    </div><!-- card col-3 -->
                </div> <!-- col 3 -->
            </div> <!-- row -->
        </div>
    </div>

    <!-- Filter Option modal START -->
    <div class="modal animate__animated animate__zoomIn animate__fasters" id="leadCall" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">

            <div class="modal-content br-radius-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Select Which Lead</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div><!-- modal header -->
                <div class="modal-body">
                    <p class="color-black">Which lead is this regarding?</p>
                    <div class="row">
                        <table class="table table-stripped table-record-bg">
                            <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Vehicle(s)</th>
                                <th>Service(s)</th>
                                <th>Last Call</th>
                                <th>Quoted</th>
                                <th>Notes</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody class="logsData">

                            </tbody>
                        </table>
                    </div><!-- row -->
                </div><!-- modal body -->
                <div class="modal-footer m-auto border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary getLead" >OK</button>
                </div><!-- modal footer -->
            </div><!-- modal content -->

        </div><!-- modal dialog -->
    </div>

    @push('script')
        <script>
            $(document).ready(function () {
                getServices(1);

                setTimeout(() => {
                    var option = new Option('Key Replacement', 1, false, true);
                    $("#service_id").append(option).trigger('select2:select');
                }, 1000);

                $(document).on('click', '.quote_category', function () {
                    $("#service_id").val(null).trigger('select2:select')
                    getServices($(".quote_category:checked").val())
                });

                $(document).on('change', '#custom_price', function () {
                    var price = $(this).is(':checked');
                    if (price) {
                        $("#quoted_price").prop('disabled', false).focus();
                    }else{
                        $("#quoted_price").prop('disabled', true);
                    }
                });

                $(document).on('click', '.searchCallBtn', function () {
                    var phone = $("#phone_number").val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('quote.search_call') }}",
                        data: {
                            phone: phone
                        },
                        dataType: "html",
                        success: function (response) {
                            $(".logsData").html(response)
                            $("#leadCall").modal("show")
                        }
                    });
                });

                $("#quoteSearch").on('submit', function (e) {
                    e.preventDefault();
                    var form = $(this);
                    var formData = new FormData(this);

                    $(".customSwitch").each(function () {
                        var id = $(this).attr('id').substr(3);

                        if ($("#cus_"+id).hasClass('d-none')) {
                            return false;
                        }

                        if ($("#cus_"+id).is(':checked')) {
                            // formData.append($("#lb_"+id).attr('name'), '1');
                        }else{
                            formData.append($("#lb_"+id).attr('name'), '0');
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: form.attr('action'),
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            $(".error-span").text('')

                            $('#resultResponse').text('No price found.');

                            $('#resultResponse').text(response.length+' result found.');

                            if (response.length > 0 && response.length < 2) {
                                fetchedService(response[0])
                            }else{
                                var text = '';
                                $.each(response, function (index, value) {
                                    text += `<div class="imgContainer">
                                                <input type="radio" id="image_`+value.id+`" class="image-radio" name="multi_img" value="`+index+`">
                                                <label for="image_`+value.id+`">
                                                    <img src="`+value.image+`" class="img-thumbnail">
                                                </label>
                                                <h5>`+value.PN+`</h5>
                                            </div>
                                            <hr>`;
                                });
                                // var options = {
                                //     title: 'Multiple Keys Found. Which One User wants?',
                                //     html: true,
                                //     text: text,
                                // };
                                //
                                // swal(options, function (isConfirm) {
                                //     fetchedService(response[$(".image-radio:checked").val()]);
                                // });
                                alert("AAA");
                            }

                        },
                        error: function (jqXhr) {
                            var errorResponse = $.parseJSON(jqXhr.responseText);
                            $(".error-span").text('')

                            $.each(errorResponse.errors, function (key, value) {
                                var y = key.split('.');
                                if (y.length > 1) {
                                    $("#error-" + y[1]).text('The '+y[1]+' field is required');
                                }else{
                                    $("#error-" + y[0]).text('The '+y[0]+' field is required');
                                }
                            });
                        }
                    });
                });

                $("#save_lead").on('submit', function(e) {
                    e.preventDefault();
                    $("#saveData").prop('disabled', true);
                    var form = $('#save_lead');
                    var formData = new FormData(this);

                    formData.append('sub_total', $("#subtotal").text().trim())

                    $('#quoteSearch :input[name]').each(function () {
                        formData.append($(this).attr('name'), $(this).val());
                    });

                    $(".model_price_id").each(function () {
                        formData.append('model_price_id[]', $(this).val());
                    });

                    $(".model_qty").each(function () {
                        formData.append('model_qty[]', $(this).val());
                    });

                    let selectedValue = $('input[name="options[key-manfacturer]"]:checked').val();
                    if(selectedValue){
                        formData.append('key_manufacturer', selectedValue)
                    }
                    let category = $('input[name="category"]:checked').val();
                    if(category){
                        formData.append('category_id', category)
                    }

                    let service_id = $('#service_id').val();
                    if(service_id){
                        formData.append('service_id', service_id)
                    }



                    $.ajax({
                        type: 'POST',
                        url: form.attr('action'),
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response.errors.status)
                            if(response.errors){
                                let errors = response.errors
                                if (errors.hasOwnProperty('status')) {
                                    $("#error-status").text(errors.status)
                                }
                                if (errors.hasOwnProperty('caller_name')) {
                                    $("#error-caller_name").text(errors.caller_name)
                                }
                                if (errors.hasOwnProperty('call_type')) {
                                    $("#error-call_type").text(errors.call_type)
                                }
                                if (errors.hasOwnProperty('notes')) {
                                    $("#error-notes").text(errors.notes)
                                }
                                if (errors.hasOwnProperty('phone_number')) {
                                    $("#error-phonenumber").text(errors.phone_number)
                                }


                            }
                            $("#saveData").prop("disabled", false).text('Save').addClass('btn-primary').removeClass('btn-danger');
                            $('#save_lead').each(function() {
                                this.reset();
                            });
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
                });

                $(document).on('click', '.removePrice', function () {
                    var id = $(this).attr('id');
                    var type = $(this).data('type');

                    if (type == 'options') {
                        $("#quo_div_"+id).remove();
                    }else{
                        var count = $("#quota_"+id).text();
                        if (count > 1) {
                            $('#quoteQtyO_'+count).remove();
                            count--;
                            $("#quota_"+id).text(count);
                        }else{
                            $("#quotaDiv_"+id).remove();
                        }
                    }
                    calcPrice();
                });

                $("#service_id").on('select2:select', function () {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('quote.parameters', ['id' => ':id']) }}".replace(':id', $("#service_id").val()),
                        dataType: "html",
                        success: function (response) {
                            $("#quoteFormFields").empty().append(response)

                            $(".customSelect").each(function () {
                                $(this).select2({
                                    width: "100%",
                                });
                            });

                            $(".customSwitch").each(function () {
                                $(this).on('change', function () {
                                    var action = $(this).data('action');
                                    $("#cus_"+action).toggleClass('d-none');

                                    var reaction = $(this).data('reaction');
                                    $("#cus_"+reaction).toggleClass('d-none');
                                })
                            });

                            $("#make_id").select2({
                                placeholder: '~~ Select Makes ~~',
                                width: "100%",
                                ajax: {
                                    method: 'post',
                                    url: '{{ route("price.makes") }}',
                                    dataType: 'json',
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
                                    cache: false,
                                }
                            });

                            $("#model_id").select2({
                                placeholder: '~~ Select Models ~~',
                                width: "100%",
                                ajax: {
                                    method: 'post',
                                    url: function () {
                                        return "{{ route('price.models', ['id' => ':id']) }}".replace(':id', $("#make_id").val())
                                    },
                                    dataType: 'json',
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
                        }
                    });
                });
            });

            function fetchedService(datta) {
                var gl_id = datta.id;
                var lii = ` <div class="d-flex justify-content-center gen-quo-div"  id="quotaDiv_`+gl_id+`">
                                <div class="p-2 gen-quo-div-data" style="width: 100%">
                                    <div class="d-flex justify-content-center">
                                        <img src="`+datta.image+`" alt="" style="border:1px solid black;height:90px;width:90px">
                                        <input type="hidden" class="model_price_id" value="`+gl_id+`"/>
                                    </div>
                                    <p class="text-center fw-bold mt-1">`+datta.name+`</p>

                                    <div class="d-flex justify-content-between">
                                        <span>Key Replacement</span>
                                        <span>AKL `+datta.akl+`</span>
                                    </div><!-- copy 1 -->
                                    <div class="d-flex justify-content-between">
                                        <span>`+datta.oem+` Prox</span>
                                        <span class="basPrice" id="`+gl_id+`">`+datta.amount+`</span>
                                    </div><!-- copy 2 -->
                                    <div class="d-flex justify-content-between">
                                        <span>Turn Key + Remote</span>
                                        <span>
                                            Qty: <i id="quota_`+gl_id+`">1</i>
                                        </span>
                                    </div><!-- copy 3 -->

                                    <p class="pt-2 d-flex justify-content-center text-danger fw-bold">`+datta.PN+`</p>

                                    <span id="quoteKeyQty_`+gl_id+`"></span>
                                    <input type="hidden" id="model_qty_`+gl_id+`" class="model_qty" value="`+gl_id+`"/>
                                </div>
                                <div class="gen-quo-div-btn">
                                    <button class="btn removePrice footer-btn" id="` +gl_id+ `" data-type="quotes">Remove</button>
                                </div>
                            </div>`;

                $(".quoteOthers").empty().append(datta.opt);
                if ($("#quotaDiv_"+gl_id).length < 1) {
                    $(".quoteKeys").append(lii)
                    $("#model_qty_"+gl_id).val(1);
                }else{
                    var count = $("#quota_"+gl_id).text();
                    count++;
                    var pp = '<p class="d-flex justify-content-center text-success fst-italic" id="quoteQtyO_'+count+'">Key #'+count+' :  <b class="nextQtyPrice_'+gl_id+'">'+datta.amount+'</b></p>';

                    $("#quoteKeyQty_"+gl_id).append(pp);
                    $("#quota_"+gl_id).text(count);
                    $("#model_qty_"+gl_id).val(count);
                }
                calcPrice()
            }

            function calcPrice() {
                var price = 0;
                $(".basPrice").each(function () {
                    var id = $(this).attr('id')
                    var qty = 0;
                    $('.nextQtyPrice_'+id).each(function () {
                        qty += +$(this).text().substr(1);
                    });
                    price += +$(this).text().substr(1) + qty;
                })


                $(".servicesEf").each(function () {
                    var operator = $(this).data('operator');
                    var amount = $(this).data('amount');
                    if (operator == 'multiplicative') {
                        var amountToAdd = ((100 - +amount) / 100) * price;
                        price = price - amountToAdd;
                    }
                })

                $(".servicesEf").each(function () {
                    var operator = $(this).data('operator');
                    var amount = $(this).data('amount');
                    if (operator == 'additive') {
                        price += +amount;
                    }
                });
                console.log(price);
                $("#subtotal").text(price.toFixed(2))
            }

            function getServices(id) {
                $("#service_id").select2({
                    placeholder: '~~ Select Service ~~',
                    width: "100%",
                    ajax: {
                        method: 'post',
                        url: "{{ route('quote.service', ['id' => ':id']) }}".replace(':id', id),
                        dataType: 'json',
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
                    },
                })
            }

            $(document).on("click", ".getLead", function (){
                var id = $('.get-call-data:checked').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('quote.get-lead-detail') }}",
                    data: {
                        id: id
                    },
                    // dataType: "html",
                    success: function (response) {
                        // $("#lb_does-the-vehicle-use-push-to-start-or-knob-turn-to-start").prop("checked", true);
                        // $("input[name=options\\[key-manfacturer\\]]").val(0);

                        // $(".quote-generator-box").html(response)
                        // $(".select2").select2();
                        // $("#leadCall").modal("show")
                        var prices = response.prices
                        var custom_price = response.lead.custom_price

                        if(prices){
                            if(prices.oem == 0){
                                $("#lb_key-manfacturer5").prop("checked", true);
                            }if(prices.oem == 1){
                                $("#lb_key-manfacturer4").prop("checked", true);
                            }

                            if(prices.pts == 1){
                                $("#lb_does-the-vehicle-use-push-to-start-or-knob-turn-to-start").prop("checked", true);
                                $("#lb_does-the-vehicle-use-push-to-start-or-knob-turn-to-start").trigger("click");
                                // $("#lb_is-there-comfort-access").
                            }
                            if(prices.pts == 1){
                                $("#lb_year").val(prices.year_start);
                            }

                            $("#lb_type-of-key").val(prices.key_type_id).trigger('change');
                            $("#select2-lb_caaaaa-results").val(prices.key_type_id).trigger('change');


                        }

                        if(custom_price){
                            $("#lb_locations").val(custom_price.locations).trigger('change');
                            $("#lb_caaaaa").val(custom_price.caa).trigger('change');
                            $("#lb_daynight").val(custom_price.day_night).trigger('change');
                            $("#lb_caller-type").val(custom_price.day_night).trigger('change');
                            if(custom_price.lost_spare_keys){
                                $("#lb_has-the-customer-lost-all-the-spare-keys").prop("checked", true);
                            }
                        }

                        // Assuming you want to check the radio button with value 2
                        // $('input[name="category"][value="'+response.categoryId+'"]').prop('checked', true);
                        // $('input[name="category"][value="'+response.categoryId+'"]').trigger('click');
                        // setTimeout( () => {
                        //     $("#service_id").val(response.serviceId).trigger('change');
                        // }, 1500)


                        setTimeout( () => {
                            $(".addQuote").trigger("click");
                        }, 30000)

                        $("#leadCall").modal("hide")
                    }
                });
            });



        </script>
    @endpush

@endsection
