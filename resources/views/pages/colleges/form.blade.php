@extends('layouts.lte-module')

@section('js')
@parent
<script type='text/javascript'>
    var collegeid = '{{$college->collegeid}}';
    var mode = '{{$mode}}';
</script>
<script src="{{ asset ("/js/pages/colleges/form.js") }}" type="text/javascript"></script>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        College
        <small>
            {{ ($mode == "ADD" ? "Create New" : "Edit") }}
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
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>College ID</label>
                                    <input type="text" disabled name="collegeid" class="form-control" value="{{ $college->collegeid }}" placeholder="This will automatically be generated">
                                </div>

                                <div class="form-group">
                                    <label>College Code</label>
                                    <input type="text" required name="college" class="form-control" value="{{ $college->college }}">
                                </div>

                                <div class="form-group">
                                    <label>College Description</label>
                                    <input type="text" required name="collegedesc" class="form-control" value="{{ $college->collegedesc }}">
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