@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h1><i class='fa fa-user-plus'></i> Edit {{$user->name}}</h1>
                    <hr>

                    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}

                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', null, array('class' => 'form-control')) }}
                    </div>

                    <div class='form-group'>
                        {{ Form::label('package', 'Paket') }}
                        {!! Form::select('package', $packages, $user->packages->pluck('id'), ['class'=>'form-control']) !!}
                    </div>

                    <h5><b>Give Role</b></h5>

                    <div class='form-group'>
                        @foreach ($roles as $role)
                            {{ Form::checkbox('roles[]',  $role->id, $user->roles) }}
                            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                        @endforeach
                    </div>
                
                    <div class="password_container"></div>

                    <div class="form-group">
                         <label><input type="checkbox" name="with_password" class="change_password"> Change User Password </label>
                    </div>

                    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection();

@section('extra_script')
    <script>
        $('select[name="package"]').change(function(){

            var checkboxes = $(this).closest('form');
            var subscriber = checkboxes.find(':checkbox:eq(2)');
            var unsubscriber = checkboxes.find(':checkbox:eq(3)');

            if ($(this).val() == 4) {
                subscriber.prop('checked', false);
                unsubscriber.prop('checked', true);
            } else {
                subscriber.prop('checked', true);
                unsubscriber.prop('checked', false);
            }
        });

        $('.change_password').change(function(){
            if ($(this).is(':checked')) {

                $('.password_container').html(`
                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}<br>
                        {{ Form::password('password', array('class' => 'form-control')) }}

                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Confirm Password') }}<br>
                        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

                    </div>
                `);

            }else{

                $('.password_container').empty();
            }
        });
    </script>
@endsection()