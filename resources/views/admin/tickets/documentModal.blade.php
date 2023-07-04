<div class="modal fade text-left" id="doc_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="">Upload Documents</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => 'admin/tickets/document', 'class' => 'form-horizontal doc_form', 'files' => true]) !!}
            {!! Form::hidden('ticket_id',0, ['class' => 'form-control','id'=>'doc_ticket_id']) !!}
                        
            <div class="modal-body">
                <label>Ticket Document or file </label>
                <div class="form-group position-relative">
                    {!! Form::file('images[]',  ['class' => '','multiple'=>true]) !!}
                    <div class="form-control-position">
                        {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : trans('comman.label.submit'), ['class' => 'btn btn-light']) !!}

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@push('js')

<script>
/***************action model******************/
		var doc_modal = "#doc_modal";
        $(document).on('click', '.more-doc', function (e) {
			var id=$(this).attr('data-id');
			$("#doc_ticket_id").val(id);
            $(doc_modal).modal('show');

        });
		
</script>
@endpush