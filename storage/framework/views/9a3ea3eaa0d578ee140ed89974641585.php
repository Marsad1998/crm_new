<?php
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades\Auth;
?>


<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="inner-body">
            <h3 class="mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">Price Manager</h3>
            <div class="card" style="min-height: 700px;">
                <style>
                    .icon-container {
                        position: relative;
                        cursor: pointer;
                    }

                    .hover-info {
                        display: none;
                        position: absolute;
                        top: -250%; /* Move the div above the icon */
                        right: 110%; /* Move the div to the right of the icon */
                        background-color: #f0f0f0;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        width: 400%; /* Relative width (half of the parent's width) */
                        height: 500%; /* Set the height to 600% of the width, maintaining a 2:3 aspect ratio */
                        max-width: 200px; /* Set a maximum width */
                        max-height: 300px; /* Set a maximum height */
                        z-index: 99999;
                        overflow: hidden; /* Hide any overflowing content */
                    }

                    .hover-info img {
                        width: 100%; /* Make the image fill the entire .hover-info div */
                        height: 100%; /* Make the image fill the entire .hover-info div */
                    }

                    .icon-container:hover .hover-info {
                        display: block;
                    }
                </style>

                    <!-- DROPDOWN Menu on regular button Romove -->
                    <!-- <div class="dropdown" id="filterDropdown">
                        <button class="btn btn-primary mx-2 btn-c dropdown-toggle dropdown-btn" tabindex="0" aria-controls="priceManager" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><span><i class="fas fa-filter"></i> Filters</span></button>
                        <ul class="dropdown-menu br-radius-10" aria-labelledby="dropdownMenuButton1" style="width:auto">
                            <li>
                                <div class="card-header padding-10">Filter Options</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label for="make_1">Make:</label>
                                                <select name="make_1" id="make_1" class="form-control">
                                                    <option value="">Select option</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label for="make_2">Make:</label>
                                                <select name="make_2" id="make_2" class="form-control">
                                                    <option value="">Select option</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label for="year">Year:</label>
                                                <input type="text" name="year" id="year" class="form-control" placeholder="2023">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-lg-6 col-xl-6">
                                            <div class="form-group">
                                                <label for="service">Service:</label>
                                                <select name="service" id="service" class="form-control">
                                                    <option value="">Select option</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-6">
                                            <div class="form-group">
                                                <label for="key_type">Key Type:</label>
                                                <select name="key_type" id="key_type" class="form-control">
                                                    <option value="">Select option</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6 col-xl-6">
                                            <div class="form-group">
                                                <label>Comfort Access:</label>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <input type="checkbox" name="comfort_accessYes" id="comfort_accessYes"> <label for="comfort_accessYes">Yes</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="comfort_accessNo" id="comfort_accessNo"> <label for="comfort_accessNo">No</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="comfort_accessUnset" id="comfort_accessUnset"> <label for="comfort_accessUnset">Unset</label>
                                                    </div>
                                                    <div></div><div></div><div></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-6">
                                            <div class="form-group">
                                                <label>Manufacturer:</label>
                                                <div class="d-flex justify-content-between">
                                                        <div>
                                                            <input type="checkbox" name="manufacturer_oem" id="manufacturer_oem"> <label for="manufacturer_oem">OEM</label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="manufacturer_aftermarket" id="manufacturer_aftermarket"> <label for="manufacturer_aftermarket">Aftermarket</label>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="manufacturer_unset" id="manufacturer_unset"> <label for="manufacturer_unset">Unset</label>
                                                        </div>
                                                        <div></div><div></div><div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label>AKL:</label>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <input type="checkbox" name="akl_Yes" id="akl_Yes"> <label for="akl_Yes">Yes</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="akl_No" id="akl_No"> <label for="akl_No">No</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="akl_Unset" id="akl_Unset"> <label for="akl_Unset">Unset</label>
                                                    </div>
                                                    <div></div><div></div><div></div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label>Has notes:</label>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <input type="checkbox" name="has_notesYes" id="has_notesYes"> <label for="has_notesYes">Yes</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="has_notesNo" id="has_notesNo"> <label for="has_notesNo">No</label>
                                                    </div>
                                                    <div></div><div></div><div></div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label for="has_image">Has image:</label>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <input type="checkbox" name="has_imageYes" id="has_imageYes"> <label for="has_imageYes">Yes</label>
                                                    </div>
                                                    <div>
                                                        <input type="checkbox" name="has_imageNo" id="has_imageNo"> <label for="has_imageNo">No</label>
                                                    </div>
                                                    <div></div><div></div><div></div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>
                                            <label for="price_range">Price Range:</label>
                                            <input type="text" id="price_range" readonly style="border:0; color:#51B3DE; font-weight:bold;">
                                        </p>
                                        <div id="slider-range"></div>
                                    </div>
                                </div>
                                <div class="card-footer padding-10 d-flex justify-content-end">
                                    <div>
                                        <button type="button" class="btn btn-light">Reset</button>
                                        <button type="button" class="btn btn-primary">Apply</button>
                                    </div>
                                </div>
                            </li>
                            <li></li>
                        </ul>
                    </div> -->
                    
                <div class="card-body table-responsive mt-3">
                    <table class="table table-striped table-hover table-bordered align-middle" id="priceManager">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Service</th>
                                <th>Year From</th>
                                <th>Year To</th>
                                <th>Key Type</th>
                                <th>CA / Prox</th>
                                <th>Manufacturer</th>
                                <th>AKL</th>
                                <th>Notes</th>
                                <th>Amount</th>
                                <th>Image</th>
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

    <div class="modal animate__animated animate__zoomIn animate__fasters" id="priceManagerModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Add a Price</h5>
                    <button type="button" class="btn-close priceManagerModalclose"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('price.create')); ?>" id="prcieForm" method="post">
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
                                <button type="button" onclick="addRow()" class="addRowVtn btn m-2 btn-c btn-primary"><i class="fas fa-plus"></i> Add</button>
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
                        </div> 
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
                                </div> 
                                <div class="row">
                                    <div class="col-sm-3 mt-3">
                                        <label for="amount_1">Amount</label>
                                        <input type="text" class="form-control form-control-c" name="amount[0]" id="amount_1" placeholder="00.00">
                                    </div>
                                    <div class="col-sm-9 mt-3">
                                        <label for="notes_1">Notes</label>
                                        <textarea cols="30" rows="4" class="form-control textarea-c" name="notes[0]" id="notes_1" placeholder="Notes"></textarea>
                                    </div>
                                </div> 
                            </div> 
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
                                        <img src="<?php echo e(global_asset('storage/common/camera_preview.jpg')); ?>" class="imagePreview" id="img_preveiw_1">
                                    </div>

                                    <input type="file" name="file[0]" class="d-none" onchange="readURL(this, '1')" id="imgInput_1">
                                </div>
                            </div> 
                            <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                <button type="button" onclick="addRew()" class="addRowVtn btn btn-c btn-primary"><i class="fas fa-plus"></i> Add</button>
                            </div>
                        </div> 
                        
                        <div id="detail_inform"></div>

                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn priceManagerModalclose btn-light">Close</button>
                    <button type="submit" id="saveData" class="btn btn-primary">Save</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Option modal START -->
    <div class="modal animate__animated animate__zoomIn animate__fasters" id="filter_optionsModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            
            <div class="modal-content br-radius-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Filters Options</h5>
                    <button type="button" class="btn-close filter_optionsModalclose"></button>
                </div><!-- modal header -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="make_1">Make:</label>
                                <select name="make_1" id="make_1" class="form-control">
                                    <option value="">Select option</option>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- col-1 -->
                        <div class="col-md-12 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="make_2">Make:</label>
                                <select name="make_2" id="make_2" class="form-control">
                                    <option value="">Select option</option>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- col-2 -->
                        <div class="col-md-12 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="year">Year:</label>
                                <input type="text" name="year" id="year" class="form-control" placeholder="2023">
                            </div><!-- form-group -->
                        </div><!-- col-3 -->
                    </div><!-- row -->

                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="service">Service:</label>
                                <select name="service" id="service" class="form-control">
                                    <option value="">Select option</option>
                                </select>
                            </div><!-- form-group -->
                            <div class="form-group">
                               <label>Comfort Access:</label>
                               <div class="d-flex justify-content-between">
                                    <div>
                                        <input type="checkbox" name="comfort_accessYes" id="comfort_accessYes"> <label for="comfort_accessYes">Yes</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="comfort_accessNo" id="comfort_accessNo"> <label for="comfort_accessNo">No</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="comfort_accessUnset" id="comfort_accessUnset"> <label for="comfort_accessUnset">Unset</label>
                                    </div>
                                    <div></div><div></div><div></div>
                               </div>
                            </div><!-- form-group -->
                        </div><!-- col-1 -->
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="key_type">Key Type:</label>
                                <select name="key_type" id="key_type" class="form-control">
                                    <option value="">Select option</option>
                                </select>
                            </div><!-- form-group -->
                            <div class="form-group">
                               <label>Manufacturer:</label>
                               <div class="d-flex justify-content-between">
                                    <div>
                                        <input type="checkbox" name="manufacturer_oem" id="manufacturer_oem"> <label for="manufacturer_oem">OEM</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="manufacturer_aftermarket" id="manufacturer_aftermarket"> <label for="manufacturer_aftermarket">Aftermarket</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="manufacturer_unset" id="manufacturer_unset"> <label for="manufacturer_unset">Unset</label>
                                    </div>
                                    <div></div><div></div><div></div>
                               </div>
                            </div><!-- form-group -->
                        </div><!-- col-2 -->
                    </div><!-- row -->

                    <div class="row">
                        <div class="col-md-12 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label>AKL:</label>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <input type="checkbox" name="akl_Yes" id="akl_Yes"> <label for="akl_Yes">Yes</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="akl_No" id="akl_No"> <label for="akl_No">No</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="akl_Unset" id="akl_Unset"> <label for="akl_Unset">Unset</label>
                                    </div>
                                    <div></div><div></div><div></div>
                               </div>
                            </div><!-- form-group -->
                        </div><!-- col-1 -->
                        <div class="col-md-12 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label>Has notes:</label>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <input type="checkbox" name="has_notesYes" id="has_notesYes"> <label for="has_notesYes">Yes</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="has_notesNo" id="has_notesNo"> <label for="has_notesNo">No</label>
                                    </div>
                                    <div></div><div></div><div></div>
                               </div>
                            </div><!-- form-group -->
                        </div><!-- col-2 -->
                        <div class="col-md-12 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="has_image">Has image:</label>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <input type="checkbox" name="has_imageYes" id="has_imageYes"> <label for="has_imageYes">Yes</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="has_imageNo" id="has_imageNo"> <label for="has_imageNo">No</label>
                                    </div>
                                    <div></div><div></div><div></div>
                               </div>
                            </div><!-- form-group -->
                        </div><!-- col-3 -->
                    </div><!-- row -->

                    <div class="form-group">
                        <p>
                            <label for="price_range">Price Range:</label>
                            <input type="text" id="price_range" readonly style="border:0; color:#51B3DE; font-weight:bold;">
                        </p>
                        <div id="slider-range"></div>
                    </div><!-- form-group -->
                </div><!-- modal body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light">Reset</button>
                    <button type="button" class="btn btn-primary">Apply</button>
                </div><!-- modal footer -->
            </div><!-- modal content -->

        </div><!-- modal dialog -->
    </div>
    <!-- Filter Option modal END -->

    <?php $__env->startPush('script'); ?>
        <script>
            $(document).ready(function() {
                // $("#priceManagerModal").modal('show');

                initSelect(1);
                initDetail(1);

                $('.icon-container').hover(
                    function () {
                        // Mouse enter event
                        $('.hover-info').show();
                    },function () {
                        // Mouse leave event
                        $('.hover-info').hide();
                    }
                );

                var priceManager = $("#priceManager").DataTable({
                    dom: '<"row"<"col-sm-4"l><"col-sm-4"B><"col-sm-4"f>>rt<"row"<"col-sm-4"i><"col-sm-4"><"col-sm-4"p>>',
                    stateSave: true,
                    "ajax": {
                        url: "<?php echo e(route('price.show')); ?>", // json datasource
                        type: 'post', // method  , by default get
                    },
                    'order': [],
                    processing: true,
                    serverSide: true,
                    buttons: [
                        {
                            className: "mx-2 btn-c",
                            text: '<i class="fas fa-plus-circle"></i> Add Price',
                            action: function (e, dt, node, config) {
                                $("#vehicle_inform").empty();
                                $("#detail_inform").empty();
                                // addRow(1);
                                // addRew(1);
                                // priceManager.ajax.reload(null, false);
                                $("#priceManagerModal").modal('show')
                            }
                        },
                        {
                            className: "mx-2 btn-c filterOptDropDBtnPar",
                            text: '<div class="dropdown" id="filterDropdown">\
                        <button class="btn btn-primary mx-2 btn-c dropdown-toggle filterOptDropDBtn" tabindex="0" aria-controls="priceManager" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><span><i class="fas fa-filter"></i> Filters</span></button>\
                        <ul class="dropdown-menu br-radius-10 filterOptDropDMenu" aria-labelledby="dropdownMenuButton1">\
                            <li>\
                                <div class="card-header padding-10">Filter Options</div>\
                                <div class="card-body">\
                                    <div class="row">\
                                        <div class="col-md-12 col-lg-4 col-xl-4">\
                                            <div class="form-group">\
                                                <label for="make_1">Make:</label>\
                                                <select name="make_1" id="make_1" class="form-control">\
                                                    <option value="">Select option</option>\
                                                </select>\
                                            </div><!-- form-group -->\
                                        </div><!-- col-1 -->\
                                        <div class="col-md-12 col-lg-4 col-xl-4">\
                                            <div class="form-group">\
                                                <label for="make_2">Make:</label>\
                                                <select name="make_2" id="make_2" class="form-control">\
                                                    <option value="">Select option</option>\
                                                </select>\
                                            </div><!-- form-group -->\
                                        </div><!-- col-2 -->\
                                        <div class="col-md-12 col-lg-4 col-xl-4">\
                                            <div class="form-group">\
                                                <label for="year">Year:</label>\
                                                <input type="text" name="year" id="year" class="form-control" placeholder="2023">\
                                            </div><!-- form-group -->\
                                        </div><!-- col-3 -->\
                                    </div><!-- row -->\
                                    <div class="row">\
                                        <div class="col-md-12 col-lg-6 col-xl-6">\
                                            <div class="form-group">\
                                                <label for="service">Service:</label>\
                                                <select name="service" id="service" class="form-control">\
                                                    <option value="">Select option</option>\
                                                </select>\
                                            </div><!-- form-group -->\
                                        </div><!-- col-1 -->\
                                        <div class="col-md-12 col-lg-6 col-xl-6">\
                                            <div class="form-group">\
                                                <label for="key_type">Key Type:</label>\
                                                <select name="key_type" id="key_type" class="form-control">\
                                                    <option value="">Select option</option>\
                                                </select>\
                                            </div><!-- form-group -->\
                                        </div><!-- col-2 -->\
                                    </div><!-- row -->\
                                    <div class="row">\
                                        <div class="col-md-12 col-lg-6 col-xl-6">\
                                            <div class="form-group">\
                                            <label>Comfort Access:</label>\
                                            <div class="d-flex justify-content-between">\
                                                    <div>\
                                                        <input type="checkbox" name="comfort_accessYes" id="comfort_accessYes"> <label for="comfort_accessYes">Yes</label>\
                                                    </div>\
                                                    <div>\
                                                        <input type="checkbox" name="comfort_accessNo" id="comfort_accessNo"> <label for="comfort_accessNo">No</label>\
                                                    </div>\
                                                    <div>\
                                                        <input type="checkbox" name="comfort_accessUnset" id="comfort_accessUnset"> <label for="comfort_accessUnset">Unset</label>\
                                                    </div>\
                                                    <div></div><div></div>\
                                            </div>\
                                            </div><!-- form-group -->\
                                        </div><!-- col-1 -->\
                                        <div class="col-md-12 col-lg-6 col-xl-6">\
                                            <div class="form-group">\
                                                <label>Manufacturer:</label>\
                                                <div class="d-flex justify-content-between">\
                                                        <div>\
                                                            <input type="checkbox" name="manufacturer_oem" id="manufacturer_oem"> <label for="manufacturer_oem">OEM</label>\
                                                        </div>\
                                                        <div>\
                                                            <input type="checkbox" name="manufacturer_aftermarket" id="manufacturer_aftermarket"> <label for="manufacturer_aftermarket">Aftermarket</label>\
                                                        </div>\
                                                        <div>\
                                                            <input type="checkbox" name="manufacturer_unset" id="manufacturer_unset"> <label for="manufacturer_unset">Unset</label>\
                                                        </div>\
                                                </div>\
                                            </div><!-- form-group -->\
                                        </div><!-- col-2 -->\
                                    </div><!-- row -->\
                                    <div class="row">\
                                        <div class="col-md-12 col-lg-4 col-xl-4">\
                                            <div class="form-group">\
                                                <label>AKL:</label>\
                                                <div class="d-flex justify-content-between">\
                                                    <div>\
                                                        <input type="checkbox" name="akl_Yes" id="akl_Yes"> <label for="akl_Yes">Yes</label>\
                                                    </div>\
                                                    <div>\
                                                        <input type="checkbox" name="akl_No" id="akl_No"> <label for="akl_No">No</label>\
                                                    </div>\
                                                    <div>\
                                                        <input type="checkbox" name="akl_Unset" id="akl_Unset"> <label for="akl_Unset">Unset</label>\
                                                    </div>\
                                            </div>\
                                            </div><!-- form-group -->\
                                        </div><!-- col-1 -->\
                                        <div class="col-md-12 col-lg-4 col-xl-4">\
                                            <div class="form-group">\
                                                <label>Has notes:</label>\
                                                <div class="d-flex justify-content-between">\
                                                    <div>\
                                                        <input type="checkbox" name="has_notesYes" id="has_notesYes"> <label for="has_notesYes">Yes</label>\
                                                    </div>\
                                                    <div>\
                                                        <input type="checkbox" name="has_notesNo" id="has_notesNo"> <label for="has_notesNo">No</label>\
                                                    </div>\
                                                    <div></div><div></div>\
                                            </div>\
                                            </div><!-- form-group -->\
                                        </div><!-- col-2 -->\
                                        <div class="col-md-12 col-lg-4 col-xl-4">\
                                            <div class="form-group">\
                                                <label for="has_image">Has image:</label>\
                                                <div class="d-flex justify-content-between">\
                                                    <div>\
                                                        <input type="checkbox" name="has_imageYes" id="has_imageYes"> <label for="has_imageYes">Yes</label>\
                                                    </div>\
                                                    <div>\
                                                        <input type="checkbox" name="has_imageNo" id="has_imageNo"> <label for="has_imageNo">No</label>\
                                                    </div>\
                                                    <div></div><div></div>\
                                            </div>\
                                            </div><!-- form-group -->\
                                        </div><!-- col-3 -->\
                                    </div><!-- row -->\
                                    <div class="form-group">\
                                        <p>\
                                            <label for="price_range">Price Range:</label>\
                                            <input type="text" id="price_range" readonly style="border:0; color:#51B3DE; font-weight:bold;">\
                                        </p>\
                                        <div id="slider-range"></div>\
                                    </div><!-- form-group -->\
                                </div>\
                                <div class="card-footer padding-10 d-flex justify-content-end">\
                                    <div>\
                                        <button type="button" class="btn btn-light">Reset</button>\
                                        <button type="button" class="btn btn-primary">Apply</button>\
                                    </div>\
                                </div>\
                            </li>\
                            <li></li>\
                        </ul>\
                    </div>',
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
                            data: 'make_id'
                        },
                        {
                            data: 'model_id'
                        },
                        {
                            data: 'service_id'
                        },
                        {
                            data: 'year_start'
                        },
                        {
                            data: 'year_end'
                        },
                        {
                            data: 'key_type_id'
                        },
                        {
                            data: 'comfort_access'
                        },
                        {
                            data: 'manufacturer'
                        },
                        {
                            data: 'akl'
                        },
                        {
                            data: 'PN'
                        },
                        {
                            data: 'amount'
                        },
                        {
                            data: 'image'
                        },
                        {
                            data: 'action'
                        },
                    ]
                });

                $(document).on('hidePrevented.bs.modal', function () {
                    swal({
                        title: "",
                        text: "Are you sure you would like to cancel?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $("#priceManagerModal").modal('hide');
                            $("#filter_optionsModal").modal('hide');
                            swal.close();
                        } else {
                            swal.close();
                        }
                    });
                });

                $(document).on('click', '.priceManagerModalclose, .filter_optionsModalclose', function () {
                    swal({
                        title: "",
                        text: "Are you sure you would like to cancel?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $("#priceManagerModal").modal('hide');
                            $("#filter_optionsModal").modal('hide');
                            swal.close();
                        } else {
                            swal.close();
                        }
                    });
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
                            $("#vehicle_inform").empty();
                            $("#detail_inform").empty();
                            priceManager.ajax.reload(null, false);
                            x = 2;
                            y = 2;

                            $('#prcieForm').each(function() {
                                this.reset();
                                $(this).find('select.select2').val(null).trigger('change');
                                $(this).find('textarea').val('');
                                $(".icon-button-bottom").click();
                            });
                            $("#prcieForm").attr('action', "<?php echo e(route('price.create')); ?>");

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

                $(document).on('click', '.edit', function () {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(route('price.edit', ['id' => ':id'])); ?>".replace(':id', $(this).attr('id')),
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            $("#saveData").text('Update').addClass('btn-danger').removeClass('btn-primary');
                            $(".addRowVtn").hide();
                            $("#priceManagerModal").modal('show');
                            
                            var option = new Option(response.makes.name, response.makes.id, false, false);
                            $("#make_id_1").append(option).trigger('change');

                            var option = new Option(response.models.name, response.models.id, false, false);
                            $("#model_id_1").append(option).trigger('change');

                            var option = new Option(response.services.name, response.services.id, false, false);
                            $("#service_id_1").append(option).trigger('change');

                            var option = new Option(response.keys.name, response.keys.id, false, false);
                            $("#key_type_1").append(option).trigger('change');
                                
                            $("#year_from_1").val(response.year_start);
                            $("#year_to_1").val(response.year_end);

                            if (response.oem == 1) {
                                $("#OEMRadio_1").prop('checked', true);
                            }else if (response.oem == 0){
                                $("#afterRadio_1").prop('checked', true);
                            }

                            if (response.pts == 1) {
                                $("#comfort_access_1").prop('checked', true);
                            }
                            
                            if (response.akl == 1) {
                                $("#akl_1").prop('checked', true);;
                            }

                            $("#amount_1").val(response.amount);
                            $("#notes_1").val(response.PN);
                            $("#img_preveiw_1").attr('src', response.image);
                            
                            $("#prcieForm").attr('action', "<?php echo e(route('price.update', ['id' => ':id'])); ?>".replace(':id', response.id));
                            // $("#name").val(response.name)
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
                        url: "<?php echo e(route('price.delete', ['id' => ':id'])); ?>".replace(':id', id),
                        dataType: "json",
                        success: function(response) {
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                            priceManager.ajax.reload(null, false);
                        }, 
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    });
                });

                $(document).on('click', '.icon-button-top', function () {
                    var id = $(this).attr('id')
                    $("#imgInput_"+id).click();
                });

                $(document).on('click', '.icon-button-bottom', function () {  
                    var id = $(this).attr('id')
                    $('#img_preveiw_'+id).attr('src', "<?php echo e(global_asset('storage/common/camera_preview.jpg')); ?>");
                    $('#imgInput_'+id).val('');
                });

                $( "#slider-range" ).slider({
                    range: true,
                    min: 0,
                    max: 5000,
                    step: 1000,
                    values: [ 0, 5000 ],
                    slide: function( event, ui ) {
                        $( "#price_range" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                    }
                });
                
                $("#filterDropdown").click(function(e){
                    e.stopPropagation();
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
                                </div> 

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
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-3 mt-3">
                                                <label for="amount_`+y+`">Amount</label>
                                                <input type="text" class="form-control form-control-c" id="amount_`+y+`" name="amount[`+y+`]" placeholder="00.00">
                                            </div>
                                            <div class="col-sm-9 mt-3">
                                                <label for="notes_`+y+`">Notes</label>
                                                
                                                <textarea cols="30" rows="4" class="form-control textarea-c"  id="notes_`+y+`" name="notes[`+y+`]" placeholder="Notes"></textarea>
                                            </div>
                                        </div> 
                                    </div> 
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
                                                <img src="<?php echo e(global_asset('storage/common/camera_preview.jpg')); ?>" class="imagePreview" id="img_preveiw_`+y+`">
                                            </div>

                                            <input type="file" name="file[`+y+`]" class="d-none" onchange="readURL(this, '`+y+`')" id="imgInput_`+y+`">
                                        </div>
                                    </div> 
                                    <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                        <button type="button" onclick="addRew()" class="btn btn-c btn-primary"><i class="fas fa-plus"></i></button>
                                        <button type="button" onclick="removeRow(this);" class="btn m-2 btn-c\ btn-danger"><i class="fas fa-trash"></i></button>\
                                    </div>
                                </div> 
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
                        url: '<?php echo e(route("price.makes")); ?>',
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
                            return "<?php echo e(route('price.models', ['id' => ':id'])); ?>".replace(':id', $("#make_id_"+x).val())
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
                        url: "<?php echo e(route('price.services')); ?>",
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
                        url: "<?php echo e(route('price.key_type')); ?>",
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
            
            /* function filter_options() {
                // $("#filter_optionsModal").modal('show');
            } */
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\upwork\monties\resources\views/tenant/price.blade.php ENDPATH**/ ?>