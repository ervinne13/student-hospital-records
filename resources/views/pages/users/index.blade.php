@extends('layouts.lte-record-list')

@section('js')
@parent
<script type="text/javascript">
    var username = '{{$user->username}}';
</script>
<script src="{{ asset ("/js/pages/users/index.js") }}" type="text/javascript"></script>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users        
    </h1>
</section>

<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="users-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <a href="/users/create">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </th>
                                        <th>Username</th>
                                        <th>Complete Name</th>
                                        <th>User Type</th>
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