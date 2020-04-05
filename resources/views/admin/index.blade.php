@extends('layouts.master')
@section('pageTitle', 'Admin List')
@section('styles')
    {!! Html::style('assets/dataTables/datatables.min.css') !!}
@endsection

@section('content')
    <div class="jumbotron">
        <div class="panel-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Admin</h3>
                        <div class="float-right">
                            <a class="float-right btn btn btn-info btn-md" href="{{ route('admin.create')  }}">Add New</a>
                        </div>
                    </div>
                    @include('partials._flash_message')
                    <div class="row">
                        <div class="card-body col-12">
                            <table id="admin-list" class="table table-bordered table-responsive table-striped" cellspacing="0"  width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($admins))
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->company->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->contact_number }}</td>
                                            <td>{{ ucfirst($admin->status) }}</td>
                                            <td>{{ $admin->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit', $admin->id ) }}" data-app-id="app-{{ $admin->id }}" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" title="Delete" class="admin-delete" data-id="{{ $admin->id }}" id="admin-delete"">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('assets/dataTables/datatables.min.js') !!}
    <script>
        $(function () {
            $('#admin-list').dataTable( {
                "searching": false,
                "bInfo" : false,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 10,
            });
            $('.admin-delete').click(function(e){
                e.preventDefault();
                if (confirm('Are you sure you want to delete this record?')) {
                    $recordId = $(this).data('id');
                    $.ajax({
                        url: '{{ url('company/admin/delete') }}/' + $recordId,
                        type: 'GET',
                        dataType: 'text',
                        success: function (response) {
                            var obj = JSON.parse(response);
                            if (obj.success === true) {
                                alert('Record deleted successfully!');
                            } else {
                                alert('Record can not be deleted now. Try again later.');
                            }
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection
