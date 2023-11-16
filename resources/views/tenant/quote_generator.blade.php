@extends('layouts.main')

@section('content')

    <div class="container-fluid">
        <div class="inner-body">
            <div class="row mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70 m-3">
                
                <div class="col-sm-7 col-md-8 col-lg-5 col-xl-5 pad-mar-0-imp">
                    <div class="card h-100">
                        <div class="cstm-card-header cstm-border-top">Vehicle Information</div>

                        <form action="{{ route('quote.search') }}" method="post" id="quoteSearch">
                            <div class="cstm-card-body g-quote-body">
                                <p class="d-flex justify-content-center text-muted">Category</p>
                                <div class="d-flex justify-content-evenly cstm-margin-top-10">
                                    @foreach ($categories as $x => $category)
                                        <div>
                                            <input type="radio" name="category" id="{{ Str::slug($category->name) }}" value="{{ $category->id }}" {{ $category->id == 1 ? "checked": "" }} class="quote_category"> 
                                            <label for="{{ Str::slug($category->name) }}">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
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
    
                            <div class="cstm-card-footer d-flex justify-content-between align-items-center cstm-border-bottom">
                                <p class="cstm-margin-0 text-danger" id="resultResponse"></p>
                                <button type="submit" class="btn footer-btn">Add to Quote</button>
                            </div><!-- custom card footer {col-1} -->
                        </form>

                    </div><!-- card col-1 -->
                </div> <!-- col 1 -->

                <div class="col-sm-5 col-md-4 col-lg-3 col-xl-3 pad-mar-0-imp">
                    <div class="card h-100 g-quote-header">
                        <div class="cstm-card-header cstm-border-top">Generated Quote</div><!-- custom card header -->
                        
                        <div class="cstm-card-body g-quote-body">

                            <div class="quoteKeys"></div>
                            <div class="quoteOthers"></div>

                        </div><!-- custom card body -->

                        <div class="cstm-card-footer d-flex justify-content-evenly lead cstm-border-bottom g-quote-footer">
                            <span>Subtotal:</span> <strong><ins><span id="subtotal">00.00</span></ins></strong>
                        </div><!-- custom card footer -->

                    </div><!-- card col-2 -->
                </div> <!-- col 2 -->

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 pad-mar-0-imp">
                    <div class="card h-100 l-info-card">
                        <div class="cstm-card-header cstm-border-top">Lead Info</div><!-- custom card header -->

                        <div class="cstm-card-body">

                            <form action="{{ route('quote.save_lead') }}" method="post">
                                <div class="d-flex justify-content-evenly">
                                    <div class="cstm-group-47w">
                                        <label for="phone_number">Phone Number</label>
                                        <div class="input-group">
                                            <input class="form-control form-control-c" placeholder="Search for..." type="text" name="phone_number" id="phone_number">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary btn-c searchCallBtn" type="button">
                                                    <span class="input-group-btn">
                                                        <i class="fa fa-search"></i>
                                                    </span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="cstm-group-47w">
                                        <label for="caller_name">Caller Name</label>
                                        <input type="text" name="caller_name" class="form-control form-control-c" placeholder="John Smith">
                                    </div>
                                </div><!-- input-group number details -->
    
                                <div class="d-flex justify-content-evenly flex-wrap">
                                    <div class="cstm-margin-top-20 quoted_price_div">
                                        <label for="quoted_price">Quoted Price</label>
                                        <input type="text" name="quoted_price" id="quoted_price" class="form-control form-control-c" placeholder="301.85" disabled>
                                    </div>
                                    <div class="cstm-margin-top-20 custom_price_div">
                                        <label for="custom_price" class="d-flex justify-content-center">Custom Price</label>
                                        <div class="form-check form-switch d-flex justify-content-center mt-2">
                                            <input class="form-check-input switch-c" type="checkbox" name="custom_price" id="custom_price" value="1">
                                        </div>
                                        <span class="error-span text-danger " id="error-custom_price"></span>
                                    </div>
                                    <div class="cstm-margin-top-20 status_div">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control form-control-c">
                                            <option value="">~~ SELECT ~~</option>
                                            <option value="Active">Active</option>
                                            <option value="Booked">Booked</option>
                                            <option value="Failed">Failed</option>
                                            <option value="Invalid">Invalid</option>
                                            <option value="Warranty">Warranty</option>
                                        </select>
                                    </div>
                                </div><!-- input-group price details -->
    
                                <div class="cstm-margin-top-20">
                                    <p class="d-flex justify-content-center text-muted">Call Type</p>
                                    <div class="d-flex justify-content-evenly cstm-margin-top-10">
                                        <div>
                                            <input type="radio" name="call_type" id="incomming"> <label for="incomming">Incomming</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="call_type" id="outgoing"> <label for="outgoing">Outgoing</label>
                                        </div>
                                    </div>
                                </div><!-- input-group call type -->
    
                                <div class="cstm-margin-top-20 cstm-margin-bottom-60">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" rows="2" class="form-control textarea-c"></textarea>
                                </div><!-- input-group notes textarea -->
                            </form>
                        </div><!-- custom card body -->

                        <div class="cstm-card-footer d-flex justify-content-end cstm-border-bottom l-info-footer">
                            <button class="btn footer-btn">Save Call</button>
                        </div><!-- custom card footer -->
                    </div><!-- card col-3 -->
                </div> <!-- col 3 -->
            </div> <!-- row -->
        </div>
    </div>
    
    <br><br>

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
                        dataType: "json",
                        success: function (response) {
                            
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
                            if (response.length > 0) {
                                $('#resultResponse').text(response.length+' result found.');
                                var gl_id = response[0].id;
                                var lii = ` <div class="d-flex justify-content-center gen-quo-div"  id="quotaDiv_`+gl_id+`">
                                                <div class="p-2 gen-quo-div-data" style="width: 100%">
                                                    <div class="d-flex justify-content-center">
                                                        <img src="`+response[0].image+`" alt="" style="border:1px solid black;height:90px;width:90px">
                                                    </div>
                                                    <p class="text-center fw-bold mt-1">`+response[0].name+`</p>
    
                                                    <div class="d-flex justify-content-between">
                                                        <span>Key Replacement</span>
                                                        <span>AKL `+response[0].akl+`</span>
                                                    </div><!-- copy 1 -->
                                                    <div class="d-flex justify-content-between">
                                                        <span>`+response[0].oem+` Prox</span>
                                                        <span class="basPrice" id="`+gl_id+`">`+response[0].amount+`</span>
                                                    </div><!-- copy 2 -->
                                                    <div class="d-flex justify-content-between">
                                                        <span>Turn Key + Remote</span>
                                                        <span>
                                                            Qty: <i id="quota_`+gl_id+`">1</i> 
                                                        </span>
                                                    </div><!-- copy 3 -->
    
                                                    <p class="pt-2 d-flex justify-content-center text-danger fw-bold">`+response[0].PN+`</p>
                                                    
                                                    <span id="quoteKeyQty_`+gl_id+`"></span>
                                                </div>
                                                <div class="gen-quo-div-btn">
                                                    <button class="btn removePrice footer-btn" id="` +gl_id+ `" data-type="quotes">Remove</button>
                                                </div>
                                            </div>`;

                                $(".quoteOthers").empty().append(response[0].opt);
                                if ($("#quotaDiv_"+gl_id).length < 1) {
                                    $(".quoteKeys").append(lii)
                                }else{
                                    var count = $("#quota_"+gl_id).text();
                                    count++;
                                    var pp = '<p class="d-flex justify-content-center text-success fst-italic" id="quoteQtyO_'+count+'">Key #'+count+' :  <b class="nextQtyPrice_'+gl_id+'">'+response[0].amount+'</b></p>';

                                    $("#quoteKeyQty_"+gl_id).append(pp);
                                    $("#quota_"+gl_id).text(count);
                                }

                                calcPrice()
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
                                    cache: true,
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
                
                console.log(price);

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
        </script>
    @endpush

@endsection
