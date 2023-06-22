@extends('master')

@section('Title')
Employees
@endsection

@section('Style')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('Content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><strong>EMPLOYEES</strong></h5>
                        <div class="float-sm-right ml-1">
                            <button type="button" class="btn btn-block btn-default">Default</button>
                        </div>
                        <div class="float-sm-right ml-1">
                            <button type="button" class="btn btn-block btn-default">Default</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="employee">
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{$employee->id}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{$employee->employee->address ? $employee->employee->address : 'Address not found!'}}</td>
                                    <td>{{$employee->phone ? $employee->phone : 'Phone not found!'}}</td>
                                    <td>
                                        <input type="checkbox" name="status" {{$employee->status ? 'checked' :
                                        ''}} data-bootstrap-switch data-off-color="danger" data-on-color="success"
                                        class="change_status" onchange="myFunction(event)" value="{{$employee->id}}">
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Script')
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins')}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('plugins')}}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('plugins')}}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('plugins')}}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('plugins')}}/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('plugins')}}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('plugins')}}/jszip/jszip.min.js"></script>
<script src="{{asset('plugins')}}/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('plugins')}}/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('plugins')}}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="{{asset('plugins')}}/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script src="{{asset('dist')}}/js/adminlte.min.js"></script>

<script>
    $(function () {
    $("#example2").DataTable({
        "drawCallback": function(){
            $('.paginate_button:not(.disabled)', this.api().table().container()).on('click', function(){
                $("input[data-bootstrap-switch]").each(function(){
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
            });
        },
        "responsive": true, "lengthChange": true, "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  });

  function myFunction(event) {
    let empID = event.target.value;
  }
</script>
@endsection
