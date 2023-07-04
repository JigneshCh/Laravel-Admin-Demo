@push('css')
<style>
    .intl-tel-input{
        display: block;
    }
</style>
@endpush

<div class="row ">

    <lable class="col-md-1"></lable>
    <div class="col-md-6">
      
        
        

        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
            <label for="first_name" class="">
                <span class="field_compulsory">*</span>@lang('people.label.first_name')
            </label>
                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}

        </div>
        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
            <label for="last_name" class="">
                <span class="field_compulsory">*</span>@lang('people.label.last_name')
            </label>
                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}

        </div>
        
        
        <div class="form-group{{ $errors->has('roles') ? ' has-error' : ''}}">
            <label for="role" >
                <span class="field_compulsory">*</span>@lang('user.label.role')
            </label>
            <div >
                {!! Form::select('roles[]',$roles,$selected_role, ['class' => 'full-width selectTag2']) !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            <label for="email" class="">
                <span class="field_compulsory">*</span>@lang('user.label.email')
            </label>
				@if(isset($user) && 0)
                 {!! Form::email('email', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
				@else
				{!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
			    @endif
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}

        </div>
        
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
            <label for="password" class="">
                @if(!isset($user_roles))
                    <span class="field_compulsory">*</span>
                @endif
                @lang('user.label.password')
            </label>
                 {!! Form::password('password', ['class' => 'form-control']) !!}
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}

        </div>
		
		<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            {!! Form::label('status', trans('people.label.active'), ['class' => '']) !!}
            {!! Form::select('status',['active'=>'Active','inactive'=>'Inactive'], null, ['class' => 'form-control']) !!}
        </div>
        

        
      
        <div class="form-group">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : trans('comman.label.create'), ['class' => 'btn btn-primary']) !!}
        {{ Form::reset(trans('comman.label.clear_form'), ['class' => 'btn btn-light']) }}
        </div>
   
        
    </div>
   
    
</div>







@push('js')
<script>

    
    
    
    $('.selectTag2').select2({
            tokenSeparators: [",", " "]
     });

    

</script>


@endpush

