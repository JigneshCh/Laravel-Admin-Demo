<div class="modal fade text-left" id="assign_modal" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel34">Ticket Assign To</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => 'admin/tickets/action', 'class' => 'form-horizontal assign_form', 'files' => true]) !!}

            {!! Form::hidden('ticket_id',0, ['class' => 'form-control','id'=>'assign_ticket_id']) !!}
            
            <div class="modal-body">
                <label>Select User </label>
                <div class="form-group position-relative">
                    <select class="full-width assign_user" id="assign_user" name="assign_user">
                                                <option value="">Select User</option>
                                                @foreach($users as $k => $val)
													@if($val->status == 'active')
                                                    <option value="{{$val->id}}" >{{$val->full_name}}</option>
													@endif
                                                @endforeach
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

    var url = "{{url('admin/tickets')}}";
	$("#assign_user").select2();
/***************action model******************/
    var assign_model = "#assign_modal";
        $(document).on('click', '.assign_to', function (e) {
			var id=$(this).attr('data-id');
            var user_id=$(this).attr('data-uid');

            $("#assign_ticket_id").val(id);
            $(assign_model).modal('show');

            return false;
        });

    

    $('.assign_form').submit(function(event) {


        var formData = {
            'ticket_id': $("#assign_ticket_id").val(),
            'user_id': $("#assign_user").val(),
        };

        $.ajax({
            type: "POST",
            url: url + "/assignuser",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            success: function (data) {

                $(assign_model).modal('hide');
               
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