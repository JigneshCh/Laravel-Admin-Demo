@extends('layouts.frontend')

@section('body_class',' pace-done')

@section('title','Tickets')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="content-header"> Assigned Tickets </div>
        {{--  @include('partials.page_tooltip',['model' => 'user','page'=>'index']) --}}
    </div>
</div>

    <section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   
                    <div class="row">
                    
						
						<div class="card-body">
                          <div class="card-block">
                              
                              
                              <div class="form-body">
                                  <div class="row">
                                      
									  
                                      
                                      <div class="col-xl-3 col-sm-4">
                                          <div class="form-group">
                                              <select class="full-width filter" id="filter_status" name="filter">
													<option value="">All</option>
													<option value="open" selected>Open</option>
													<option value="solved" >Solved</option>
													<option value="closed">Closed</option>
													
                                            </select>
                                          </div>
                                      </div>
                                     
                                      
                                  </div>
							</div>
                              
              
                          </div>
                        </div>
						
                    </div>
                </div>
                <div class="card-body collapse show">
                    
                    <div class="card-block card-dashboard">
                       
                        
                        <div class="table-responsive">
                           <table class="table table-bordered table-striped datatable responsive">
                            <thead>
                            <tr>
                                <th data-priority="2">Subject</th>
                                <th data-priority="4">Status</th>
                                <th data-priority="6">Date</th>
								<th data-priority="6">Action</th>
                            </tr>
                            </thead>

                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


@endsection



@push('js')
<script>

    var url = "{{url('tickets')}}";
	var auth_uid = {{\Auth::user()->id}};
    datatable = $('.datatable').dataTable({
        pagingType: "full_numbers",
        "language": {
            "emptyTable":"@lang('comman.datatable.emptyTable')",
            "infoEmpty":"@lang('comman.datatable.infoEmpty')",
            "search": "@lang('comman.datatable.search')",
            "sLengthMenu": "@lang('comman.datatable.show') _MENU_ @lang('comman.datatable.entries')",
            "sInfo": "@lang('comman.datatable.showing') _START_ @lang('comman.datatable.to') _END_ @lang('comman.datatable.of') _TOTAL_ @lang('comman.datatable.small_entries')",
            paginate: {
                next: '@lang('comman.datatable.paginate.next')',
                previous: '@lang('comman.datatable.paginate.previous')',
                first:'@lang('comman.datatable.paginate.first')',
                last:'@lang('comman.datatable.paginate.last')',
            }
        },
        processing: true,
        serverSide: true,
        autoWidth: false,
        stateSave: false,
        order: [2, "DESC"],
        columns: [
            { "data": "subject","name":"subject","width":"15%"},
            { "data": "status","name":"status","width":"10%"},
            { "data": "created","name":"created_at","width":"20%"},
            { "data": null,
                "searchable": false,
                "orderable": false,
                "width": "4%",
                "render": function (o) {
                    var e=""; var d=""; var v="";

					e =  " <a href='"+url+"/"+o.slug+"' data-id="+o.id+" title='View in detail'><i class='fa fa-eye' aria-hidden='true'></i></a>";
					
					if(o.status == "open"){
                    var v =  " <a href='#' data-id="+o.id+" class='action_complete' title='Complete'><i class='fa fa-check-circle' aria-hidden='true'></i></a>";
					}
					
                    return e + v+d;

                }
            }

        ],
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $('td', nRow).attr('nowrap', 'nowrap');
            return nRow;
        },
        ajax: {
            url: "{{ url('tickets/datatable') }}", // json datasource
            type: "get", // method , by default get
            data: function (d) {
                d.status = $('#filter_status').val();
            }
        }
    });

	
	$(document).on('click', '.action_complete', function (e) {
		var id=$(this).attr('data-id');
		var r = confirm("Are you sure to complete and submit the ticket");
        if (r == true) {
			
		var formData = {
            'ticket_id': id,
            'status': "closed",
        };
		$.ajax({
            type: "POST",
            url: url + "/changestatus",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            success: function (data) {
				datatable.fnDraw(false);
                toastr.success('Action Success!', data.message)
            },
            error: function (xhr, status, error) {
                var erro = ajaxError(xhr, status, error);
                toastr.error('Action Not Procede!',erro)
            }
        });
		}

        return false;

    });
    $('.filter').change(function() {
        datatable.fnDraw();
    });

</script>


@endpush