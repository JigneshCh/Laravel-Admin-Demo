
<div class="form-group row {{ $errors->has('parent_id') ? ' has-error' : ''}}">
    <label for="parent_id" class="col-xl-4 col-sm-4 label-control">@lang('permission.label.Parent_Permission').
       
    </label>
    <div class="col-xl-8 col-sm-8">
        {!! Form::select('parent_id',$permissions, null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row {{ $errors->has('name') ? ' has-error' : ''}}">
    <label for="name" class="col-xl-4 col-sm-4 label-control">
        <span class="field_compulsory">*</span>
        @lang('comman.label.name')
      
    </label>
    <div class="col-xl-8 col-sm-8">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('label') ? ' has-error' : ''}}">
    <label for="label" class="col-xl-4 col-sm-4 label-control">@lang('comman.label.label')
        
    </label>
    <div class="col-xl-8 col-sm-8">
        {!! Form::text('label', null, ['class' => 'form-control']) !!}
        {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-4 col-sm-4 label-control"></label>
    <div class="col-xl-8 col-sm-8">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : trans('comman.label.create'), ['class' => 'btn btn-primary']) !!}
        {{ Form::reset(trans('comman.label.clear_form'), ['class' => 'btn btn-light']) }}
    </div>
</div>