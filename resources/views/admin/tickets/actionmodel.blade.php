<div class="modal fade text-left" id="action_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel34">Change Ticket Status</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => 'admin/ticket/action', 'class' => 'form-horizontal action_form', 'files' => true]) !!}
            {!! Form::hidden('ticket_id',0, ['class' => 'form-control','id'=>'action_ticket_id']) !!}
                        
            <div class="modal-body">
                <label>Ticket status </label>
                <div class="form-group position-relative">
                     <select class="full-width " id="action_status" name="filter">
                                              	<option value="open">Open</option>
													<option value="closed">Closed</option>
                                            </select>
                </div>
            </div>
            <div class="modal-footer">
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
		var action_model = "#action_modal";
        $(document).on('click', '.more-action', function (e) {
			
			var id=$(this).attr('data-id');
			$("#action_ticket_id").val(id);
            $(action_model).modal('show');

        });
		
		$('.action_form').submit(function(event) {


        var formData = {
            'ticket_id': $("#action_ticket_id").val(),
            'status': $("#action_status").val(),
        };

        $.ajax({
            type: "POST",
            url: url + "/changestatus",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            success: function (data) {

                $(action_model).modal('hide');
               
                datatable.fnDraw(false);
                toastr.success('Action Success!', data.message)
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