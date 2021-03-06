@extends('layouts.lte-record-list')

@section('js')
@parent
<script type="text/javascript">
    var user = {!! Auth::user() !!}
    ;
</script>
<script src="{{ asset ("/js/pages/xray/index.js") }}" type="text/javascript"></script>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        X-Ray Records
    </h1>
</section>

<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            @if (Auth::user()->usertype == 999)
                                            <a href="/xray/create">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            @endif
                                        </th>
                                        <th>SY</th>
                                        <th>Sem.</th>
                                        <th>Student No.</th>
                                        <th>Findings</th>
                                        <th>Date Saved</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div><!-- /.col -->                        
                    </div><!-- /.row -->
                </div><!-- ./box-body -->                
            </div><!-- /.box -->            
        </div>
    </div>

</section><!-- /.content -->
@endsection