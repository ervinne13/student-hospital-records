@extends('layouts.lte-module')

@section('css')
<link href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
@parent
<script type='text/javascript'>
    var id = '{{$urinalysis->SY}}|{{$urinalysis->sem}}|{{$urinalysis->SN}}';
    var urinalysisRef = '{!!$urinalysisRef!!}';
    var mode = '{{$mode}}';
</script>   
<script src="{{ asset ("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/urinalysis/form.js") }}" type="text/javascript"></script>

<!-- InputMask -->
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Urinalysis
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
                                        <input type="text" required name="sy" class="form-control" value="{{ $urinalysis->sy }}" placeholder="Year from-year to (xxxx-xxxx)" data-inputmask='"mask": "9999-9999"' data-mask>
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <select class="form-control" name="sem">
                                        <option value="1st" {{$urinalysis->sem=="1st" ? "selected" : ""}}>1st</option>
                                        <option value="2nd" {{$urinalysis->sem=="2nd" ? "selected" : ""}}>2nd</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Student Number</label>
                                    <!--TODO: make this dropdown instead if there is more time-->
                                    <input type="text" required name="SN" class="form-control" value="{{ $urinalysis->SN }}" placeholder="Student Number">
                                </div>

                                <hr>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Scopic Exam</th>
                                            <th>Normal Min</th>
                                            <th>Normal Max</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($urinalysisRef AS $ref)
                                        <tr>
                                            <td>{{$ref->scopic_exam}}</td>
                                            <td>{{$ref->normal_min}}</td>
                                            <td>{{$ref->normal_max}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group col-sm-6">
                                    <label>Color</label>                                    
                                    <input type="text" name="color" class="form-control" value="{{ $urinalysis->color }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Transparency</label>                                    
                                    <input type="text" name="transparency" class="form-control" value="{{ $urinalysis->transparency}}">
                                </div>  
                                <div class="form-group col-sm-6">
                                    <label>Reaction</label>                                    
                                    <input type="text" name="reaction" class="form-control" value="{{ $urinalysis->reaction}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>SP Gravity</label>                                    
                                    <input type="text" name="sp_gravity" class="form-control" value="{{ $urinalysis->sp_gravity}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Sugar</label>                                    
                                    <input type="text" name="sugar" class="form-control" value="{{ $urinalysis->sugar}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Protein</label>                                    
                                    <input type="text" name="protein" class="form-control" value="{{ $urinalysis->protein}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Pus Cells</label>                                    
                                    <input type="text" name="pus_cells" class="form-control" value="{{ $urinalysis->pus_cells}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Red Cells</label>                                    
                                    <input type="text" name="red_cells" class="form-control" value="{{ $urinalysis->red_cells}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Epithelial Cells</label>                                    
                                    <input type="text" name="epithelial_cells" class="form-control" value="{{ $urinalysis->epithelial_cells}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>M Thread</label>                                    
                                    <input type="text" name="m_thread" class="form-control" value="{{ $urinalysis->m_thread}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Bacteria</label>                                    
                                    <input type="text" name="bacteria" class="form-control" value="{{ $urinalysis->bacteria}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Crystals</label>                                    
                                    <input type="text" name="crystals" class="form-control" value="{{ $urinalysis->crystals}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Others</label>                                    
                                    <input type="text" name="others" class="form-control" value="{{ $urinalysis->others}}">
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