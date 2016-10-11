@extends('layouts.lte-module')

@section('css')
<link href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
@parent
<script type='text/javascript'>
    var sn = '{{$student->SN}}';
    var mode = '{{$mode}}';
</script>
<script src="{{ asset ("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/students/form.js") }}" type="text/javascript"></script>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Student
        <small>
            {{ ($mode == "ADD" ? "Register New" : "Edit") }}
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
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>Student Number</label>
                                    <input type="text" required name="SN" class="form-control" value="{{ $student->SN }}">
                                </div>

                                <div class="form-group">
                                    <label>College</label>
                                    <select name="collegecde" class="form-control" required>
                                        @foreach($colleges AS $college)
                                        <?php $selected = $college->collegeid == $student->collegecde ? "selected" : "" ?>
                                        <option value="{{$college->collegeid}}" {{$selected}}>({{$college->college}}) {{$college->collegedesc}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" required name="first_name" class="form-control" value="{{ $student->first_name }}">
                                </div>

                                <div class="form-group">
                                    <label>Year Level</label>
                                    <select name="yearlevel" class="form-control" required>
                                        @foreach($yearLevels AS $yearLevel)
                                        <?php $selected = $yearLevel["value"] == $student->yearlevel ? "selected" : "" ?>
                                        <option value="{{$yearLevel["value"]}}" {{$selected}}>{{$yearLevel["display"]}}</option>
                                        @endforeach
                                    </select>
                                </div>  
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" required name="last_name" class="form-control" value="{{ $student->last_name }}">
                                </div>

                                <div class="form-group">
                                    <label>Course</label>
                                    <input type="text" required name="course" class="form-control" value="{{ $student->course }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Birth Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>                                    
                                        <input type="text" required name="bday" class="form-control pull-right datepicker" value="{{ $student->bday }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Weight</label>
                                    <input type="number" required name="weight" class="form-control" value="{{ $student->weight }}" placeholder="kg(s)">
                                </div>

                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Age</label>
                                    <input type="number" required name="age" class="form-control" value="{{ $student->age }}">
                                </div>                                

                                <div class="form-group">
                                    <label>Height</label>
                                    <input type="number" required name="height" class="form-control" value="{{ $student->height }}"placeholder="cm(s)">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control" required>
                                        @foreach($genders AS $gender)
                                        <?php $selected = $gender["value"] == $student->gender ? "selected" : "" ?>
                                        <option value="{{$gender["value"]}}" {{$selected}}>{{$gender["display"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Civil Status</label>
                                    <select name="civil_status" class="form-control" required>
                                        @foreach($civilStatusList AS $civilStatus)
                                        <?php $selected = $civilStatus["value"] == $student->civil_status ? "selected" : "" ?>
                                        <option value="{{$civilStatus["value"]}}" {{$selected}}>{{$civilStatus["display"]}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-4 col-sm-6">

                                <div class="form-group">
                                    <label>Complexion</label>
                                    <input type="text" name="complexion" required class="form-control" value="{{ $student->complexion }}">
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        @foreach($illnessStatusList AS $illnessStatus)
                                        <?php $selected = $illnessStatus["value"] == $student->status ? "selected" : "" ?>
                                        <option value="{{$illnessStatus["value"]}}" {{$selected}}>{{$illnessStatus["display"]}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-lg-4 col-sm-6">

                                <div class="form-group">
                                    <label>Mobile / Cellphone Number</label>
                                    <input type="text" required name="cp_no" class="form-control" value="{{ $student->cp_no }}">
                                </div>

                                <div class="form-group">
                                    <label>Landline / Tel. Number</label>
                                    <input type="text" required name="tel_no" class="form-control" value="{{ $student->tel_no }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" rows="6">{{$student->address}}</textarea>
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