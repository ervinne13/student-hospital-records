@extends('layouts.lte-record-list')

@section('js')
@parent
<script src="{{ asset ("/js/pages/colleges/index.js") }}" type="text/javascript"></script>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Colleges
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
                                            <a href="/colleges/create">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            @endif
                                        </th>
                                        <th>College ID</th>
                                        <th>College Code</th>
                                        <th>College Description</th>
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