@extends('layouts.main')

@section('content')

    <div class="container-fluid">
        <div class="inner-body">
            
            <div class="row mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">
                
            <div class="col-sm-9 col-md-8 col-lg-5 col-xl-5" style="padding:0 !important; margin: 0 !important; padding:5px !important;">
                    <div class="card">
                        <div class="cstm-card-body">
                            <p class="cstm-card-header">Vehicle Information</p>
                            
                            <p class="d-flex justify-content-center">Category</p>

                            <div class="d-flex justify-content-evenly">
                                <div>
                                    <input type="radio" name="category" id="automotive"> <label for="automotive">Automotive</label>
                                </div>
                                <div>
                                    <input type="radio" name="category" id="building"> <label for="building">Building</label>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-evenly flex-wrap">
                                <div style="width:45%;">
                                    <label for="cars">Service</label>
                                    <select name="cars" id="cars" class="form-control">
                                        <option value="volvo">Volvo</option>
                                        <option value="saab">Saab</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select>
                                </div>
    
                                <div style="width:45%;">
                                    <label for="cars">Make</label>
                                    <select name="cars" id="cars" class="form-control">
                                        <option value="volvo">Volvo</option>
                                        <option value="saab">Saab</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select>
                                </div>
    
                                <div style="width:45%;">
                                    <label for="cars">Model</label>
                                    <select name="cars" id="cars" class="form-control">
                                        <option value="volvo">Volvo</option>
                                        <option value="saab">Saab</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select>
                                </div>
    
                                <div style="width:45%;">
                                    <label for="cars">Year</label>
                                    <select name="cars" id="cars" class="form-control">
                                        <option value="volvo">Volvo</option>
                                        <option value="saab">Saab</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select>
                                </div>
                            </div>
                            

                        </div>
                    </div>

                </div> {{-- col --}}

                <div class="col-sm-3 col-md-4 col-lg-3 col-xl-3"  style="padding:0 !important; margin: 0 !important; padding:5px !important;">
                    <div class="card" style="padding:0 !important; margin: 0 !important;">
                        <div class="cstm-card-body">
                            <p class="cstm-card-header">Generated Quote</p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos dolores fugiat nemo totam perferendis ad, adipisci repudiandae distinctio a? Beatae quia unde amet quod commodi expedita excepturi id veritatis eveniet!
                        </div>
                    </div>
                </div> {{-- col --}}

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4"  style="padding:0 !important; margin: 0 !important; padding:5px !important;">
                    <div class="card" style="padding:0 !important; margin: 0 !important;">
                        <div class="cstm-card-body">
                            <p class="cstm-card-header">Lead Info</p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus temporibus ut et vel similique, id praesentium eos totam! Modi ducimus voluptatem, accusamus minima velit consequatur quibusdam quam perferendis ea expedita.
                        </div>
                    </div>
                </div> {{-- col --}}

            </div> {{-- row --}}
            <br><br>
        </div>
    </div>

@endsection
