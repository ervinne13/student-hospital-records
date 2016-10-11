@extends('layouts.lte-module')

@section('css')
<link href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
@parent
<script type='text/javascript'>
    var id = '{{$hematology->SY}}|{{$hematology->sem}}|{{$hematology->SN}}';
    var mode = '{{$mode}}';
</script>
<script src="{{ asset ("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/hematology/form.js") }}" type="text/javascript"></script>

<!-- InputMask -->
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Hematology
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
                                        <input type="text" required name="sy" class="form-control" value="{{ $hematology->SY }}" placeholder="Year from-year to (xxxx-xxxx)" data-inputmask='"mask": "9999-9999"' data-mask>
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <select class="form-control" name="sem">
                                        <option value="1st" {{$hematology->sem=="1st" ? "selected" : ""}}>1st</option>
                                        <option value="2nd" {{$hematology->sem=="2nd" ? "selected" : ""}}>2nd</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Student Number</label>
                                    <!--TODO: make this dropdown instead if there is more time-->
                                    <input type="text" required name="SN" class="form-control" value="{{ $hematology->SN }}" placeholder="Student Number">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Hemoglobin</label>
                                        <!--TODO: make this dropdown instead if there is more time-->
                                        <input type="number" required name="hemoglobin" class="form-control" value="{{ $hematology->hemoglobin }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Hematocrit</label>
                                        <!--TODO: make this dropdown instead if there is more time-->
                                        <input type="number" required name="hematocrit" class="form-control" value="{{ $hematology->hematocrit }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Red Blood</label>
                                        <!--TODO: make this dropdown instead if there is more time-->
                                        <input type="number" required name="red_blood" class="form-control" value="{{ $hematology->red_blood }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Basophiles</label>
                                        <!--TODO: make this dropdown instead if there is more time-->
                                        <input type="number" required name="basophiles" class="form-control" value="{{ $hematology->basophiles }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Platelet</label>
                                        <!--TODO: make this dropdown instead if there is more time-->
                                        <input type="number" required name="platelet" class="form-control" value="{{ $hematology->platelet }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Segmenters</label>
                                        <!--TODO: make this dropdown instead if there is more time-->
                                        <input type="number" required name="segmenters" class="form-control" value="{{ $hematology->segmenters }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Lymphocytes</label>
                                        <!--TODO: make this dropdown instead if there is more time-->
                                        <input type="number" required name="lymphocytes" class="form-control" value="{{ $hematology->lymphocytes }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Monocytes</label>
                                        <!--TODO: make this dropdown instead if there is more time-->
                                        <input type="number" required name="monocytes" class="form-control" value="{{ $hematology->monocytes }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Eosinophiles</label>
                                        <!--TODO: make this dropdown instead if there is more time-->
                                        <input type="number" required name="eosinophiles" class="form-control" value="{{ $hematology->eosinophiles }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Stab Cells</label>
                                        <!--TODO: make this dropdown instead if there is more time-->
                                        <input type="number" required name="stab_cells" class="form-control" value="{{ $hematology->stab_cells }}">
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