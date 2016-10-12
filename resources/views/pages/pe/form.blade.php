@extends('layouts.lte-module')

@section('css')
<link href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
@parent
<script type='text/javascript'>
    var id = '{{$pe->SY}}|{{$pe->sem}}|{{$pe->SN}}';
    var mode = '{{$mode}}';
</script>   
<script src="{{ asset ("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/pe/form.js") }}" type="text/javascript"></script>

<!-- InputMask -->
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Physical Exam
        <small>
            {{ ($mode == "ADD" ? "Create New Record" : "Edit Record") }}
        </small>       
    </h1>
</section>

<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <form class="fields-container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group col-sm-6">
                                    <label>School Year</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" required name="sy" class="form-control" value="{{ $pe->sy }}" placeholder="Year from-year to (xxxx-xxxx)" data-inputmask='"mask": "9999-9999"' data-mask>
                                    </div>                                    
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Semester</label>
                                    <select class="form-control" name="sem">
                                        <option value="1st" {{$pe->sem=="1st" ? "selected" : ""}}>1st</option>
                                        <option value="2nd" {{$pe->sem=="2nd" ? "selected" : ""}}>2nd</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group col-sm-6">
                                    <label>Student Number</label>
                                    <!--TODO: make this dropdown instead if there is more time-->
                                    <input type="text" required name="SN" class="form-control" value="{{ $pe->SN }}" placeholder="Student Number">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Physician Liscense No.</label>                                        
                                    <input type="text" required name="license_no" class="form-control" value="{{ $pe->license_no }}">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group col-sm-3">
                                    <label>Skin</label>                                    
                                    <input type="text" name="skin" class="form-control" value="{{ $pe->skin }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Head / Scalp</label>                                    
                                    <input type="text" ead_scalp" class="form-control" value="{{ $pe->head_scalp }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Eyes (External)</label>                                    
                                    <input type="text" name="eyes_external" class="form-control" value="{{ $pe->eyes_external }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Pupils Opthatmoscopic</label>                                    
                                    <input type="text" name="pupils_opthatmoscopic" class="form-control" value="{{ $pe->pupils_opthatmoscopic }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Ears</label>                                    
                                    <input type="text" name="ears" class="form-control" value="{{ $pe->ears }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Nose / Sinuses</label>                                    
                                    <input type="text" name="nose_sinuses" class="form-control" value="{{ $pe->nose_sinuses }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Mouth / Throat</label>                                    
                                    <input type="text" name="mouth_throat" class="form-control" value="{{ $pe->mouth_throat }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Neck LN Thyroid</label>                                    
                                    <input type="text" name="neck_In_thyroid" class="form-control" value="{{ $pe->neck_In_thyroid }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Chest - Breast Axilla</label>                                    
                                    <input type="text" name="chest_breast_axilla" class="form-control" value="{{ $pe->chest_breast_axilla }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Lungs</label>                                    
                                    <input type="text" name="lungs" class="form-control" value="{{ $pe->lungs }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Heart</label>                                    
                                    <input type="text" name="heart" class="form-control" value="{{ $pe->heart }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Abdomen</label>                                    
                                    <input type="text" name="abdomen" class="form-control" value="{{ $pe->abdomen }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Back</label>                                    
                                    <input type="text" name="back" class="form-control" value="{{ $pe->back }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Anus / Rectum</label>                                    
                                    <input type="text" name="anus_rectum" class="form-control" value="{{ $pe->anus_rectum }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>GU System</label>                                    
                                    <input type="text" name="gu_system" class="form-control" value="{{ $pe->gu_system }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Reflexes</label>                                    
                                    <input type="text" name="reflexes" class="form-control" value="{{ $pe->reflexes }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Extremities</label>                                    
                                    <input type="text" name="extremities" class="form-control" value="{{ $pe->extremities }}">
                                </div>                                
                            </div>
                        </div>

                    </form>
                </div><!-- ./box-body -->
                <div class="box-footer">
                    @include('module.parts.actions')
                </div>
            </div><!-- /.box -->            
        </div>
    </div>

</section><!-- /.content -->
@endsection