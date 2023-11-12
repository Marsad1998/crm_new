<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="inner-body">
            <div class="row mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70 m-3">
                
                <div class="col-sm-7 col-md-8 col-lg-5 col-xl-5 pad-mar-0-imp">
                    <div class="card h-100">
                        <div class="cstm-card-header cstm-border-top">Vehicle Information</div>

                        <form action="<?php echo e(route('quote.search')); ?>" method="post" id="quoteSearch">
                            <div class="cstm-card-body g-quote-body">
                                <p class="d-flex justify-content-center text-muted">Category</p>
                                <div class="d-flex justify-content-evenly cstm-margin-top-10">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div>
                                            <input type="radio" name="category" id="<?php echo e(Str::slug($category->name)); ?>" value="<?php echo e($category->id); ?>" <?php echo e($category->id == 1 ? "checked": ""); ?> class="quote_category"> 
                                            <label for="<?php echo e(Str::slug($category->name)); ?>"><?php echo e($category->name); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div><!-- category -->
                                <span class="error-span text-danger " id="error-category"></span>
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-2">
                                            <label class="text-muted" for="service_id">Service</label>
                                            <select name="service_id" id="service_id" class="form-control form-control-c">
                                            </select>
                                            <span class="error-span text-danger " id="error-service_id"></span>
                                        </div>
                                    </div><!-- service's select2 -->
                                </div><!-- select2 vehicle details -->
                                
                                <div class="row" id="quoteFormFields"></div>
    
                            </div><!-- custom card body {col-1} -->
    
                            <div class="cstm-card-footer d-flex justify-content-between align-items-center cstm-border-bottom">
                                <p class="cstm-margin-0 text-danger">No price found.</p>
                                <button type="submit" class="btn footer-btn">Add to Quote</button>
                            </div><!-- custom card footer {col-1} -->
                        </form>

                    </div><!-- card col-1 -->
                </div> <!-- col 1 -->

                <div class="col-sm-5 col-md-4 col-lg-3 col-xl-3 pad-mar-0-imp">
                    <div class="card h-100 g-quote-header">
                        <div class="cstm-card-header cstm-border-top">Generated Quote</div><!-- custom card header -->
                        
                        <div class="cstm-card-body g-quote-body">

                            <div class="d-flex justify-content-center gen-quo-div">
                                <div class="p-2 gen-quo-div-data">

                                    <div class="d-flex justify-content-center">
                                        
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
                            <div class="evenValue"></div>


                            

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

    <?php $__env->startPush('script'); ?>
        <script>
            $(document).ready(function () {
                getServices(1);

                setTimeout(() => {
                    var option = new Option('Key Replacement', 1, false, true);
                    $("#service_id").append(option).trigger('select2:select');
                }, 500);
                
                $(document).on('click', '.quote_category', function () {
                    $("#service_id").val(null).trigger('select2:select')
                    getServices($(".quote_category:checked").val())
                });

                $("#quoteSearch").on('submit', function (e) {
                    e.preventDefault();
                    var form = $(this);
                    $.ajax({
                        type: 'POST',
                        url: form.attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            $(".error-span").text('')

                        }, 
                        error: function (jqXhr) {
                            var errorResponse = $.parseJSON(jqXhr.responseText);
                            $(".error-span").text('')
                            
                            $.each(errorResponse.errors, function (key, value) {
                                var y = key.split('.');
                                console.log(y);
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
                    console.log(id);
                });

                $("#service_id").on('select2:select', function () {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(route('quote.parameters', ['id' => ':id'])); ?>".replace(':id', $("#service_id").val()),
                        dataType: "html",
                        success: function (response) {
                            $("#quoteFormFields").empty().append(response)

                            $(".customSelect").each(function () {
                                $(this).select2({
                                    width: "100%",
                                }).on('change', function () {
                                    var id = $(this).find('option:selected').val();
                                    var name = $(this).data('name1');
                                    var slug = $(this).data('slug');
                                    var effect = $(this).data('effect');
                                    var value = $(this).find('option:selected').text();

                                    $("#"+slug).remove();
                                    if (effect == 'additive') {
                                        var action = '<p class="pt-3 fst-italic d-flex justify-content-center">$56</p>';
                                    }
                                    else if (effect == 'multiplicative') {
                                        var action = '<p class="pt-3 fst-italic d-flex justify-content-center">Base Cost x 50%</p>';
                                    }
                                    else{
                                        var action = "";
                                    }

                                    var li = '<div class="d-flex justify-content-center gen-quo-div" id="'+slug+'">\
                                                <div class="p-2 gen-quo-div-data">\
                                                    <strong><span>'+name+'</span>: <span>'+value+'</span></strong><br>\
                                                    '+action+'\
                                                </div>\
                                                <div class="gen-quo-div-btn">\
                                                    <button class="btn removePrice footer-btn" id="'+slug+'">Remove</button>\
                                                </div>\
                                            </div>';

                                    $(".evenValue").append(li);

                                });
                            });

                            $(".customSwitch").each(function () {  
                                $(this).on('change', function () {
                                    var action = $(this).data('action');
                                    var reaction = $(this).data('reaction');
                                    $("#cus_"+action).toggleClass('d-none');
                                    $("#cus_"+reaction).toggleClass('d-none');
                                })
                            });

                            $("#make_id").select2({
                                placeholder: '~~ Select Makes ~~',
                                width: "100%",
                                ajax: {
                                    method: 'post',
                                    url: '<?php echo e(route("price.makes")); ?>',
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
                                        return "<?php echo e(route('price.models', ['id' => ':id'])); ?>".replace(':id', $("#make_id").val())
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
            
            function getServices(id) {  
                $("#service_id").select2({
                    placeholder: '~~ Select Service ~~',
                    width: "100%",
                    ajax: {
                        method: 'post',
                        url: "<?php echo e(route('quote.service', ['id' => ':id'])); ?>".replace(':id', id),
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
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\upwork\monties\resources\views/tenant/quote_generator.blade.php ENDPATH**/ ?>