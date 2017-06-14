@extends('layouts.app')
 
@section('content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Edit New User</h2>
	        </div>
	    </div>
	</div>

    @include('admin.partials.errors')

	{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], 'role' => 'form', 'enctype' => "multipart/form-data", 'class' => 'form-horizontal', 'files' => true, 'onsubmit' => "return validateImageSize()"]) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
        </div>

        {{-- Upload Avatar --}}
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Avatar</strong>
                <img src="{{ url(($user->image != '' ? $user->image : 'images/avatar/avatar/png')) }}" id="avatar" class="img-responsive" atl="Avatar">
                <div class="form-group">
                    <input type="file" id="photo" class="form-control" name="photo" onchange="readURL(this);" />
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Password:</strong>
                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
            </div>
        </div>
        {{--@if(!empty($roles) && !empty($userRole)) --}}{{-- Check roles and userRole not null --}}
            @role('admin') {{-- Check role admin --}}
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Role:</strong>
                        {{--{!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}--}}
                        @foreach($roles as $role)
                            <br>
                            {!! Form::checkbox('roles[]', $role->id, in_array($role->id, (array)old('attendies'))?'checked':null) !!}
                            {{ Form::label('role', $role->name) }}
                        @endforeach
                    </div>
                </div>
            @endrole
        {{--@endif--}}
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
        </div>
	</div>
	{!! Form::close() !!}
@endsection

@section('script')

    {{-- Script load image preview --}}
    var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
    var max_img_size = 2097152;
    function readURL(input) {
    {{-- Validate type before upload file --}}

        if (input.type == "file") {
            var sFileName = input.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    input.value = "";
                    return false;
                }
            }
        }
        {{-- End Validate--}}

        {{-- Show preview image before upload --}}
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#avatar')
                .attr('src', e.target.result)
                .width('433')
                .height('393')
            };
            reader.readAsDataURL(input.files[0]);
        }
        {{-- End show image preview --}}
    }

    {{-- Check size Image before upload --}}
    function validateImageSize() {
        var input = document.getElementById("photo");
        // check for browser support (may need to be modified)
        if(input.files && input.files.length == 1)
        {
            if (input.files[0].size > max_img_size)
            {
                alert("The file must be less than " + (max_img_size/1024/1024) + "MB");
                return false;
            }
        }
        return true;
    }
    {{-- End check size --}}

@endsection