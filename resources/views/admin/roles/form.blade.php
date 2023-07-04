
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
    <label for="name" class="col-xl-4 col-sm-4 label-control">@lang('comman.label.label')
      
    </label>

    <div class="col-xl-8 col-sm-8">
        {!! Form::text('label', null, ['class' => 'form-control']) !!}
        {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row {{ $errors->has('label') ? ' has-error' : ''}}">
    <label for="permissions" class="col-xl-4 col-sm-4 label-control">
        <span class="field_compulsory">*</span>
        @lang('permission.label.permissions')
       
    </label>
    <div class="col-xl-8 col-sm-8">

        <ul class="ul_list_style_n">

            @foreach($permissions as $permission)

                <li>
                    <div class="checkbox">
                        <input type="checkbox" name="permissions[]" class="parent" id="{{$permission->name}}"
                                               data-parent="{!! $permission->id !!}"
                                               value="{{ $permission->name }}" {!! isset($isChecked)?$isChecked($permission->name):"" !!} >

                        <label for="{{$permission->name}}"> [ {{$permission->name}} ] <span class="text-danger">{{ $permission->label }}</span></label>
                    </div>
                    <ul class="child">
                        @foreach($permission->child as $perm)
                            <li>
                                <div class="checkbox">
                                   <input type="checkbox" name="permissions[]" id="{{$perm->name}}"
                                                  class="child-{!! $perm->parent_id !!}"
                                                  {!! isset($isChecked)?$isChecked($perm->name):"" !!}
                                                  value="{{ $perm->name }}">
                                    <label for="{{$perm->name}}">
                                        <span class="text-info ">{{ $perm->label }}</span> [ {{$perm->name}} ]
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </li>

            @endforeach
        </ul>


       
        {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row">
    <label class="col-xl-4 col-sm-4 label-control"></label>
    <div class="col-xl-8 col-sm-8">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
        {{ Form::reset(trans('comman.label.clear_form'), ['class' => 'btn btn-light']) }}
    </div>
</div>


@push('js')


    <script>

        $(document).ready(function () {

            $('.parent').change(function (e) {

                var $this = $(this),
                    parent = $this.data('parent'),
                    child = $('.child-' + parent);

                if ($this.is(':checked')) {
                    child.prop('checked', true);
                } else {
                    child.prop('checked', false);
                }
                e.preventDefault();
            });


        });

    </script>

@endpush