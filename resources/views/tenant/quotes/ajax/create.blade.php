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
                                    <input type="radio" name="category" id="{{ Str::slug($category->name) }}" value="{{ $category->id }}" {{ $category->id == $categoryId ? "checked": "" }} class="quote_category">
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
                                <select name="service_id" id="service_id" class="form-control form-control-c select2">
                                    @foreach($services as $service)
                                    <option value="{{$service->id}}" @if($service->id == $serviceId) selected @endif>{{$service->name}}</option>
                                    @endforeach
                                </select>
                                <span class="error-span text-danger " id="error-service_id"></span>
                            </div>
                        </div><!-- service's select2 -->
                    </div><!-- select2 vehicle details -->

                    <div class="row" id="quoteFormFields"></div>

                </div><!-- custom card body {col-1} -->

                <div class="cstm-card-footer d-flex justify-content-between align-items-center footer-top-shadow">
                    <p class="cstm-margin-0 text-danger" id="resultResponse"></p>
                    <button type="submit" class="btn footer-btn">Add to Quote</button>
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

                        <div class="col">
                            <label for="caller_name">Caller Name</label>
                            <input type="text" name="caller_name" class="form-control form-control-c" placeholder="John Smith">
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
                        </div>

                        <div class="col-12 mt-30">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" rows="2" class="form-control textarea-c"></textarea>
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
