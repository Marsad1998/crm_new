@extends('layouts.main')

@section('content')

    <div class="container-fluid">
        <div class="inner-body">
            <div class="row mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">
                
                <div class="col-sm-7 col-md-8 col-lg-5 col-xl-5 pad-mar-0-imp">
                    <div class="card">
                        <div class="cstm-card-header cstm-border-top">Vehicle Information</div><!-- custom card header {col-1}-->
                        <div class="cstm-card-body">
                            <p class="d-flex justify-content-center text-muted">Category</p>
                            <div class="d-flex justify-content-evenly cstm-margin-top-10">
                                
                                @foreach ($categories as $x => $category)
                                    <div>
                                        <input type="radio" name="category" id="{{ Str::slug($category->name) }}" value="{{ $category->id }}" {{ $category->id == 1 ? "checked": "" }} class="quote_category"> 
                                        <label for="{{ Str::slug($category->name) }}">{{ $category->name }}</label>
                                    </div>
                                @endforeach

                            </div><!-- category -->
                            
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="cstm-select2-div">
                                    <label class="text-muted" for="service_id">Service</label>
                                    <select name="service_id" id="service_id" class="form-control form-control-c">
                                    </select>
                                </div><!-- service's select2 -->
    
                                <div class="cstm-select2-div">
                                    <label class="text-muted" for="make">Make</label>
                                    <select name="make" id="make_id" class="form-control form-control-c">
                                    </select>
                                </div><!-- make's select2 -->
    
                                <div class="cstm-select2-div">
                                    <label class="text-muted" for="model">Model</label>
                                    <select name="model" id="model_id" class="form-control form-control-c">
                                    </select>
                                </div><!-- model's select2 -->
    
                                <div class="cstm-select2-div">
                                    <label class="text-muted" for="year">Year</label>
                                    <input type="number" name="year" id="year" class="form-control form-control-c" placeholder="Input Year">
                                </div><!-- year's input field -->
                            </div><!-- select2 vehicle details -->
                            
                            <p class="d-flex justify-content-center text-muted cstm-margin-top-20">Remote Ignition</p>
                            <div class="d-flex justify-content-between cstm-margin-top-10">
                                <p>Does the vehicle use Push-to-Start?</p>
                                <div>
                                    <label class="cstm-switch" for="ignition">
                                        <input type="checkbox" name="ignition" id="ignition" />
                                        <div class="cstm-slider cstm-round"></div>
                                    </label>
                                </div>
                            </div><!-- remote ignition -->

                            <div class="d-flex justify-content-betweenn cstm-margin-top-20">
                                <div class="cstm-group-47w">
                                    <label class="text-muted" for="type_of_key">Type of Key</label>
                                    <select name="type_of_key" id="type_of_key" class="form-control form-control-c">
                                        <option value="">Smart Key (PTS)</option>
                                        <option value="">Remote Only</option>
                                        <option value="">Turn Key Only</option>
                                    </select>
                                </div><!-- input group type_of_key -->
                                <div class="cstm-group-47w">
                                    <p class="d-flex justify-content-center text-muted">Key Manufacturer</p>
                                    <div class="d-flex justify-content-evenly">
                                        <div>
                                            <input type="radio" name="key_manufacturer" id="oem">
                                            <label for="oem"> OEM</label>
                                        </div><!-- sub-input-group -->
                                        <div>
                                            <input type="radio" name="key_manufacturer" id="after_market">
                                            <label for="after_market"> After Market</label>
                                        </div><!-- sub-input-group -->
                                    </div>
                                </div><!-- input group key_manufacturer -->
                            </div><!-- type of key / key manufacturer -->

                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="cstm-select2-div">
                                    <label class="text-muted" for="location">Location</label>
                                    <select name="location" id="location" class="form-control form-control-c">
                                        <option value="">Shop</option>
                                        <option value="">Burlington</option>
                                        <option value="">North York</option>
                                        <option value="">Bradford</option>
                                    </select>
                                </div><!-- location select2 -->
    
                                <div class="cstm-select2-div">
                                    <label class="text-muted" for="caller_type">Caller Type</label>
                                    <select name="caller_type" id="caller_type" class="form-control form-control-c">
                                        <option value="">Consumer</option>
                                        <option value="">Repair Shop</option>
                                        <option value="">Dealership</option>
                                        <option value="">Fleet Manager</option>
                                        <option value="">Auction</option>
                                    </select>
                                </div><!-- caller type select2 -->
    
                                <div class="cstm-select2-div">
                                    <label class="text-muted" for="caa_aaa">CAA/AAA</label>
                                    <select name="caa_aaa" id="caa_aaa" class="form-control form-control-c">
                                        <option value="">Basic(Direct call from CAA)</option>
                                        <option value="">Basic(Direct call from Monty's)</option>
                                        <option value="">Plus(Direct call from Monty's)</option>
                                        <option value="">Basic(Direct call from Monty's)</option>
                                    </select>
                                </div><!-- caa/aaa select2 -->
    
                                <div class="cstm-select2-div">
                                    <label class="text-muted" for="day_night_rate">Day/Night rate</label>
                                    <select name="day_night_rate" id="day_night_rate" class="form-control form-control-c">
                                        <option value="">Day rate(until 7PM)</option>
                                        <option value="">Night rate(after 7PM)</option>
                                    </select>
                                </div><!-- day/night rate select2 -->
                            </div><!-- select2 shop details -->

                            <p class="d-flex justify-content-center text-muted cstm-margin-top-20">Has the customer lost all the spare keys?</p>
                            <div class="d-flex justify-content-center">
                                <label for="">AKL &nbsp;</label>
                                <label class="cstm-switch" for="spare_keys">
                                    <input type="checkbox" name="spare_keys" id="spare_keys" />
                                    <div class="cstm-slider cstm-round"></div>
                                </label>
                            </div><!-- spare keys group -->
                        </div><!-- custom card body {col-1} -->

                        <div class="cstm-card-footer d-flex justify-content-between align-items-center cstm-border-bottom">
                            <p class="cstm-margin-0 text-danger">No price found.</p>
                            <button class="btn footer-btn">Add to Quote</button>
                        </div><!-- custom card footer {col-1} -->
                    </div><!-- card col-1 -->
                </div> <!-- col 1 -->

                <div class="col-sm-5 col-md-4 col-lg-3 col-xl-3 pad-mar-0-imp">
                    <div class="card h-100 g-quote-header">
                        <div class="cstm-card-header cstm-border-top">Generated Quote</div><!-- custom card header -->
                        
                        <div class="cstm-card-body g-quote-body">

                            <div class="d-flex justify-content-center gen-quo-div">
                                <div class="p-2 gen-quo-div-data">

                                    <div class="d-flex justify-content-center">
                                        <img src="assets/img/media/dummy_pic.jfif" alt="" style="border:1px solid black;height:90px;width:90px">
                                    </div>
                                    <p class="text-center fw-bold mt-1">2020 Toyota Yaris</p>

                                    <div class="d-flex justify-content-between">
                                        <span>Key Replacement</span>
                                        <span>AKL No</span>
                                    </div><!-- copy 1 -->
                                    <div class="d-flex justify-content-between">
                                        <span>Aftermarket Prox</span>
                                        <span>$145:00</span>
                                    </div><!-- copy 2 -->
                                    <div class="d-flex justify-content-between">
                                        <span>Turn Key + Remote</span>
                                        <span>Qty: 2</span>
                                    </div><!-- copy 3 -->

                                    <p class="pt-2 d-flex justify-content-center text-danger fw-bold">Remotehead Key - add pricing for mobile</p>

                                    <p class="d-flex justify-content-center text-success fst-italic">Key #2: -$43.50</p>
                                    
                                </div>
                                <div class="gen-quo-div-btn">
                                    <button class="btn footer-btn">Remove</button>
                                </div>
                            </div> <!-- dynamic div-1 copy 1 -->

                            <div class="d-flex justify-content-center gen-quo-div">
                                <div class="p-2 gen-quo-div-data">

                                    <strong><span>Caller Type</span>: <span>Repair Shop</span></strong><br>
                                    <p class="pt-3 fst-italic d-flex justify-content-center">Base Cost x 90%</p>
                                    
                                </div>
                                <div class="gen-quo-div-btn">
                                    <button class="btn footer-btn">Remove</button>
                                </div>
                            </div> <!-- dynamic div-2 copy 1 -->

                            <div class="d-flex justify-content-center gen-quo-div">
                                <div class="p-2 gen-quo-div-data">

                                    <strong><span>Day/Night rate</span>: <span>Day rate(until 7PM)</span></strong><br>
                                    <p class="pt-3 fst-italic d-flex justify-content-center">$0.00</p>
                                    
                                </div>
                                <div class="gen-quo-div-btn">
                                    <button class="btn footer-btn">Remove</button>
                                </div>
                            </div> <!-- dynamic div-2 copy 2-->

                            <div class="d-flex justify-content-center gen-quo-div">
                                <div class="p-2 gen-quo-div-data">

                                    <strong><span>CAA/AAA</span>: <span>Not a member/No discount allowed</span></strong><br>
                                    <p class="pt-3 fst-italic d-flex justify-content-center">$0.00</p>
                                    
                                </div>
                                <div class="gen-quo-div-btn">
                                    <button class="btn footer-btn">Remove</button>
                                </div>
                            </div> <!-- dynamic div-2 copy 3-->

                            <div class="d-flex justify-content-center gen-quo-div">
                                <div class="p-2 gen-quo-div-data">

                                    <strong><span>Location</span>: <span>Burlington</span></strong><br>
                                    <p class="pt-3 fst-italic d-flex justify-content-center">$80.00</p>
                                    
                                </div>
                                <div class="gen-quo-div-btn">
                                    <button class="btn footer-btn">Remove</button>
                                </div>
                            </div> <!-- dynamic div-2 copy 4 -->

                            <div class="d-flex justify-content-center gen-quo-div mb-5">
                                <div class="p-2 gen-quo-div-data">

                                    <strong><span>Location</span>: <span>Burlington</span></strong><br>
                                    <p class="pt-3 fst-italic d-flex justify-content-center">$80.00</p>
                                    
                                </div>
                                <div class="gen-quo-div-btn">
                                    <button class="btn footer-btn">Remove</button>
                                </div>
                            </div> <!-- dynamic div-2 copy 5 -->

                        </div><!-- custom card body -->

                        <div class="cstm-card-footer d-flex justify-content-evenly lead cstm-border-bottom g-quote-footer">
                            <span>Subtotal:</span> <strong><ins><span>301.85</span></ins></strong>
                        </div><!-- custom card footer -->

                    </div><!-- card col-2 -->
                </div> <!-- col 2 -->

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 pad-mar-0-imp">
                    <div class="card h-100 l-info-card">
                        <div class="cstm-card-header cstm-border-top">Lead Info</div><!-- custom card header -->

                        <div class="cstm-card-body">

                            <div class="d-flex justify-content-evenly">
                                <div class="cstm-group-47w">
                                    <label for="phone_number" class="text-muted">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control form-control-c" placeholder="416 555-1234">
                                </div>
                                
                                <div class="cstm-group-47w">
                                    <label for="caller_name" class="text-muted">Caller Name</label>
                                    <input type="text" name="caller_name" class="form-control form-control-c" placeholder="John Smith">
                                </div>
                            </div><!-- input-group number details -->

                            <div class="d-flex justify-content-evenly flex-wrap">
                                <div class="cstm-margin-top-20 quoted_price_div">
                                    <label for="quoted_price" class="text-muted">Quoted Price</label>
                                    <input type="text" name="quoted_price" class="form-control form-control-c" placeholder="301.85" readonly>
                                </div>
                                <div class="cstm-margin-top-20 custom_price_div">
                                    <label class="text-muted">Custom Price</label>
                                    <div class="d-flex justify-content-center mt-2">
                                        <label class="cstm-switch" for="custom_price">
                                            <input type="checkbox" name="custom_price" id="custom_price" />
                                            <div class="cstm-slider cstm-round"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="cstm-margin-top-20 status_div">
                                    <label for="status" class="text-muted">Status</label>
                                    <select name="status" id="status" class="form-control form-control-c" readonly>
                                        <option value="">Set the Status</option>
                                    </select>
                                </div>
                            </div><!-- input-group price details -->

                            <div class="cstm-margin-top-20">
                                <p class="d-flex justify-content-center text-muted">Call Type</p>
                                <div class="d-flex justify-content-evenly cstm-margin-top-10">
                                    <div>
                                        <input type="radio" name="call_type" id="incomming"> <label for="incomming" class="text-muted">Incomming</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="call_type" id="outgoing"> <label for="outgoing" class="text-muted">Outgoing</label>
                                    </div>
                                </div>
                            </div><!-- input-group call type -->

                            <div class="cstm-margin-top-20 cstm-margin-bottom-60">
                                <label for="notes" class="text-muted">Notes</label>
                                <textarea name="notes" id="notes" rows="2" class="form-control textarea-c"></textarea>
                            </div><!-- input-group notes textarea -->
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

                $(document).on('click', '.quote_category', function () {
                    $("#service_id").val(null).trigger('change')
                    getServices($(".quote_category:checked").val())
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
                
            });
            
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
                    }
                });
            }
        </script>
    @endpush

@endsection
