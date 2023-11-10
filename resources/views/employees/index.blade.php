@extends('layouts.app')
@section('title')
    <title>Employees</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
    @if (session('error'))
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p class="mb-0">{{ session('error') }}</p>
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p class="mb-0">{{ session('success') }}</p>
    </div>
    @endif
    <div class="card card-default color-palette-box">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-landmark"></i>
            Employees
          </h3>
            <button type="button" class="btn btn-outline-info mr-1 mb-3 btn-sm" id="add-new" style="float:right;">
                <i class="fa fa-fw fa-plus mr-1"></i> Add New
            </button>
        </div>
        <div class="card-body">
            <form id="filterfordatatable" class="form-horizontal" onsubmit="event.preventDefault();">
                <div class="row ">
                    <div class="col">
                        <input type="text" name="search" class="form-control" placeholder="Search with company name">
                    </div>
                </div>
            </form><br>
            <table class="table table-bordered table-striped" id="item-table">
                <thead>
                    <tr>
                        <th class="nosort">#</th>
                        <th>{{ __('First name') }}</th>
                        <th>{{ __('Last name') }}</th>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th class="nosort">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div><br>
@endsection
@section('scripts')
        <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            function drawTable()
            {
                var table = $('#item-table').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    // responsive: true,
                    buttons: [],
                    "pagingType": "full_numbers",
                    "dom": 'B<"clear">lrtip',
                    ajax: {
                        "url": '{{route("employees.index")}}',
                        "data": function(d) {
                            var searchprams = $('#filterfordatatable').serializeArray();
                            var indexed_array = {};

                            $.map(searchprams, function(n, i) {
                                indexed_array[n['name']] = n['value'];
                            });
                            return $.extend({}, d, indexed_array);
                        },
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'name'
                        },
                        {
                            data: 'first_name',
                            name: 'first_name'
                        },
                        {
                            data: 'last_name',
                            name: 'last_name'
                        },
                        {
                            data: 'company.company_name',
                            name: 'company.company_name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ],

                    'aoColumnDefs': [{
                        'bSortable': false,
                        'aTargets': ['nosort']
                    }]

                });

                $.fn.DataTable.ext.pager.numbers_length = 5;
                $('#filterfordatatable').change(function() {
                    table.draw();
                });
            }
            drawTable();

            function editData(id){
                var url="{{route('employees.edit','ID')}}";
                url=url.replace('ID',id);
                window.location.href=url;
            }

            function deleteData(id)
            {
                swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
                }).then((result) => {
                    if (result) {
                        var url="{{route('employees.destroy','ID')}}";
                        url=url.replace('ID',id);
                        $.ajax({
                            url: url,
                            type:"delete",
                            data:{
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(response){
                                console.log(response);
                                if(response.success){
                                    swal("Good job!", "You deleted the data!", "success");
                                    drawTable();
                                }else{
                                    swal("Oops!", "Failed to deleted the data!", "danger");
                                }
                            },
                        });
                    }
                })
            }

            $('#add-new').click(function(){
                window.location.href="{{route('employees.create')}}";
            });

        </script>
    @endsection
