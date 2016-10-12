@extends('layouts.lte-module')

@section('css')
<link href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
@parent
<script type='text/javascript'>
    var id = '{{$vitalSigns->SY}}|{{$vitalSigns->sem}}|{{$vitalSigns->SN}}';
    var mode = '{{$mode}}';
</script>   
<script src="{{ asset ("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/vital-signs/form.js") }}" type="text/javascript"></script>

<!-- InputMask -->
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Vital Signs
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
                                <div class="form-group">
                                    <label>School Year</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" required name="sy" class="form-control" value="{{ $vitalSigns->sy }}" placeholder="Year from-year to (xxxx-xxxx)" data-inputmask='"mask": "9999-9999"' data-mask>
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <select class="form-control" name="sem">
                                        <option value="1st" {{$vitalSigns->sem=="1st" ? "selected" : ""}}>1st</option>
                                        <option value="2nd" {{$vitalSigns->sem=="2nd" ? "selected" : ""}}>2nd</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Student Number</label>
                                    <!--TODO: make this dropdown instead if there is more time-->
                                    <input type="text" required name="SN" class="form-control" value="{{ $vitalSigns->SN }}" placeholder="Student Number">
                                </div>
                                <div class="form-group">
                                    <label>Physician Liscense No.</label>                                        
                                    <input type="text" required name="license_no" class="form-control" value="{{ $vitalSigns->license_no }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Pulse Rate</label>                                        
                                        <input type="number" required name="pulse_rate" class="form-control" value="{{ $vitalSigns->pulse_rate }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Blood Pressure</label>                                        
                                        <input type="text" required name="blood_pressure" class="form-control" value="{{ $vitalSigns->blood_pressure }}">
                                    </div>

                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Vision</label>                                        
                                        <input type="text" required name="vision" class="form-control" value="{{ $vitalSigns->vision }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Color Vision</label>                                        
                                        <input type="text" required name="color_vision" class="form-control" value="{{ $vitalSigns->color_vision }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Hearing</label>                                        
                                        <input type="text" required name="hearing" class="form-control" value="{{ $vitalSigns->hearing }}">
                                    </div>
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