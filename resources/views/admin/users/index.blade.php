@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h1><i class="fa fa-users"></i> User Administration <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
                    <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Paket</th>
                                    <th>Valid Until</th>
                                    <th>Date/Time Added</th>
                                    <th>User Roles</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->packages->first()->name }}</td>
                                    <td>{{ $user->packages->first()->valid_until }}</td>
                                    <td>{{ $user->created_at->isoFormat('Do MMMM YYYY, h:mm:ss a') }}</td>
                                    <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                                    <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-xs pull-left" style="margin-right: 3px;">Edit</a>

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs confirm']) !!}
                                    {!! Form::close() !!}

                                    <a href="{{ route('user.payment.status', $user->id) }}" class="btn btn-warning btn-xs">Status</a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()

@section('extra_script')
    <script>
        $('.confirm').on('click', function (e) {
            if (confirm('Apakah anda yakin akan menghapus data ini?')) {
                return true;
            }
            else {
                return false;
            }
        });
    </script>
@endsection()