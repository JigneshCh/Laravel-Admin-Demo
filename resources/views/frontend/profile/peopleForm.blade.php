@push('css')
<style>
    .intl-tel-input{
        display: block;
    }
</style>
@endpush




<div class="form-group row">
<label  class="col-md-4 label-control"></label>
    @if($user->people->photo)
        <div class="col-md-6 col-md-offset-4">
            <img src="{!! asset('uploads/'.$user->people->photo) !!}" alt="" width="150px">
        </div>
    @endif
</div>

<div class="form-group row {{ $errors->has('photo') ? 'has-error' : ''}}">
    @if($user->people->photo)
        {!! Form::label('photo', trans('people.label.change_photo'), ['class' => 'col-md-4 label-control']) !!}
    @else
        {!! Form::label('photo', trans('people.label.photo'), ['class' => 'col-md-4 label-control']) !!}
    @endif
    <div class="col-md-6">
        {!! Form::file('photo',  ['class' => 'form-control']) !!}
        {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('phone_number_1') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 label-control">
        <span class="field_compulsory">*</span>@lang('people.label.phone_number_1')
    </label>
    <div class="col-md-6">
        {!! Form::text('phone_number_1', $user->people->phone_number_1, ['id'=>'phone_number_1','class' => 'form-control','style'=>'padding-left: 90px !important']) !!}
        {{ Form::hidden('code_phone_number_1',null, array('id' => 'code_phone_number_1')) }}
        {!! $errors->first('phone_number_1', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('phone_type_1') ? 'has-error' : ''}}">
    <label for="phone_type_1" class="col-md-4 label-control">
        <span class="field_compulsory">*</span>@lang('people.label.phone_type_1')
    </label>
    <div class="col-md-6">
        {!! Form::select('phone_type_1',$phoneTypes, $user->people->phone_type_1, ['class' => 'form-control']) !!}
        {!! $errors->first('phone_type_1', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('phone_number_2') ? 'has-error' : ''}}">
    <label for="phone_number_2" class="col-md-4 label-control">
        <span class="field_compulsory">*</span>@lang('people.label.phone_number_2')
    </label>
    <div class="col-md-6">
        {!! Form::text('phone_number_2', $user->people->phone_number_2,['id'=>'phone_number_2','class' => 'form-control','style'=>'padding-left: 90px !important']) !!}
        {{ Form::hidden('code_phone_number_2',null, array('id' => 'code_phone_number_2')) }}
        {!! $errors->first('phone_number_2', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('phone_type_2') ? 'has-error' : ''}}">
    <label for="phone_type_2" class="col-md-4 label-control">
        <span class="field_compulsory">*</span>@lang('people.label.phone_type_2')
    </label>
    <div class="col-md-6">
        {!! Form::select('phone_type_2',$phoneTypes, $user->people->phone_type_2, ['class' => 'form-control']) !!}
        {!! $errors->first('phone_type_2', '<p class="help-block">:message</p>') !!}
    </div>
</div>



@push('js')
<script>

    var old_code1 = "{{ env('DEFAULT_PHONE_COUNTRY_CODE', 'fr') }}";
    var old_code2 = "{{ env('DEFAULT_PHONE_COUNTRY_CODE', 'fr') }}";;
    @if(isset($user) && $user->people && $user->people->phone_number_1 != '')
        old_code1 ="{{$user->people->code_phone_number_1}}";
    @endif
    @if(isset($user) && $user->people && $user->people->phone_number_2 != '')
        old_code2 ="{{$user->people->code_phone_number_2}}";
    @endif

    $("#phone_number_2").intlTelInput({
        preferredCountries:[old_code2],
        separateDialCode: true,
        utilsScript: "{!! asset('/assets/build/js/utils.js')!!}"
    });
    $("#phone_number_1").intlTelInput({
        preferredCountries:[old_code1],
        separateDialCode: true,
        utilsScript: "{!! asset('/assets/build/js/utils.js')!!}"
    });
    
    $("#phone_number_1").intlTelInput("setCountry", old_code1);
    $("#phone_number_2").intlTelInput("setCountry",old_code2);

    $("#phone_number_1").on("countrychange", function(e, countryData) {
        var code =  countryData.iso2;
        $("#code_phone_number_1").val(code);
    });
    $("#phone_number_2").on("countrychange", function(e, countryData) {
        var code =  countryData.iso2;
        $("#code_phone_number_2").val(code);
    });



</script>




@endpush