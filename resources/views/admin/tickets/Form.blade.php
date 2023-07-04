<div class="modal fade text-left" id="unitpackage_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                     <h3 class="modal-title title_form_model">Create New Tickets</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                   
                
            </div>
            {!! Form::open(['url' => '','id'=>'unitpackage_form','class' => 'form-horizontal unitpackage_form', 'files' => true]) !!}
           
           
                        
            <div class="modal-body">
				
				
                {!! Form::label('subject','Subject' ,['class' => '']) !!}
                <div class="form-group position-relative">
                    <input type="text" name="subject" class="filter form-control"  id="subject" style="">    
                </div>
                
                {!! Form::label('desc', 'Description',['class' => '']) !!}
                <div class="form-group position-relative">
                    <textarea  name="content" class="filter form-control" rows="3" id="content" style=""></textarea>
                </div>
            
			</div>
            <div class="modal-footer">
                <p class="form_submit_error text-error"></p>
                <button type="button" class="btn btn-primary" style="float: none;" data-dismiss="modal" aria-hidden="true">@lang('comman.label.cancel')</button>
                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : trans('comman.label.submit'), ['class' => 'btn btn-light']) !!}

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>



@push('js')


<script>


	 
	 
 
/***************action model******************/
		var _model = "#unitpackage_modal";
        $(document).on('click', '.ticket_form_open', function (e) {
            var id=$(this).attr('data-id');
            $('#unitpackage_form')[0].reset();
            $(_model).modal('show');
            return false;
        });


    $('.unitpackage_form').submit(function(event) {

        var error_msg = "";
        

        
        var url = "{{url('admin/tickets')}}";
        var method = "POST";

        $.ajax({
            type: method,
            url: url,
            dataType:'json',
            async:false,
            processData: false,
            contentType: false,
            data:new FormData($("#unitpackage_form")[0]),
            success: function (data) {
                $(_model).modal('hide');
                toastr.success('Action Success!', data.message);
                datatable.fnDraw(false);
            },
            error: function (xhr, status, error) {
                var erro = ajaxError(xhr, status, error);
                toastr.error('Action Not Procede!',erro)
            }
        });

        return false;
    });
</script>
@endpush