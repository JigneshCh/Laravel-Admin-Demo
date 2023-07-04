@extends('layouts.apex')

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
                                              <select class="full-width filter filter_user" id="filter_user" name="filter">
                                                <option value="">Select User</option>
                                                @foreach($users as $k => $val)
                                                    <option value="{{$val->id}}" >{{$val->full_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                          
                                      </div>
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
                                     
                                      <div class="col-xl-3 col-sm-4">
                                          <div class="form-group">
                                                 <div class="ticket-select-process">
                                                <div style="width: 100%">
                                                    <div id="reportrange"  style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;height: 32px;">
                                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                                        <span></span> <b class="caret"></b>
                                                    </div>

                                                </div>

                                            </div>
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
                    
						<div class="actions pull-left" style="padding: 0px 0px 8px 8px;">
                            
                               <a href="#" class="btn btn-success btn-sm ticket_form_open" title="Add New Ticket">
                                   <i class="fa fa-plus" aria-hidden="true"></i> @lang('comman.label.add_new')
                               </a>
                       </div>			
                        
                        <div class="table-responsive">
                           <table class="table table-bordered table-striped datatable responsive">
                            <thead>
                            <tr>
                                <th data-priority="2">Subject</th>
                                <th data-priority="3">Assign</th>
                                <th data-priority="4">Status</th>
                                <th data-priority="6">Create Date</th>
                                <th data-priority="6">Closed Date</th>
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


	
	@include("admin.tickets.actionmodel")
    @include("admin.tickets.assignmodel")
    @include("admin.tickets.documentModal")
	@include("admin.tickets.Form")
@endsection



@push('js')
<script>

	$("#filter_user").select2();
    $("#filter_status").select2();

	var range_start = "";
    var range_end = "";
	
	 
	 
	 
    var url = "{{url('admin/tickets')}}";
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
        order: [3, "DESC"],
        columns: [
            { "data": "subject","name":"subject","width":"15%"},
			{
                "data": null,
                "searchable": false,
                "orderable": false,
                "render": function (o) {
					var user_name = "";
					if(o.user){
						user_name = o.user.first_name;
					}
					if(o.status != "closed"){
					return "<a href='#' class='assign_to' data-id="+o.id+" data-uid="+o.user_id+"><i class='fa fa-edit action_icon'></i></a>"+user_name;
					}else{
						return user_name;
					}
				}
            },
            {
                "data": null,
                "name": "status",
                "render": function (o) {
					if(o.status != "closed"){
					return "<a href='#' class='more-action' data-id="+o.id+" ><i class='fa fa-edit action_icon'></i></a>"+o.status;
					}else{
						return o.status;
					}
				}
            },
            { "data": "created","name":"created_at","width":"20%"},
            { "data": "closed_at_tz","name":"closed_at","width":"20%"},
			{ "data": null,
                "searchable": false,
                "orderable": false,
                "width": "4%",
                "render": function (o) {
                    var v=""; var file="";
					v =  " <a href='"+url+"/"+o.slug+"' data-id="+o.id+" title='View in detail'><i class='fa fa-eye' aria-hidden='true'></i></a>";
					
					if(o.status == "open"){
					file =  " <a href='javascript:void(0)' class='more-doc' data-id="+o.id+" title='View in detail'><i class='fa fa-file' aria-hidden='true'></i></a>";
					}

                    return file + v;

                }
            }
        ],
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $('td', nRow).attr('nowrap', 'nowrap');
            return nRow;
        },
        ajax: {
            url: "{{ url('admin/tickets/datatable') }}", // json datasource
            type: "get", // method , by default get
            data: function (d) {
                d.status = $('#filter_status').val();
                d.user_id = $('#filter_user').val();
                d.range_start = range_start;
                d.range_end = range_end;
                
            }
        }
    });

	
	    /*************************daterange selection*****************/



    var start = moment.utc('2015-01-01','YYYY-MM-DD');
    var end = moment();
    
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        if(range_start==""){
            range_start = start.format('YYYY-MM-DD');
            range_end = end.format('YYYY-MM-DD');
        }else{
            range_start = start.format('YYYY-MM-DD');
            range_end = end.format('YYYY-MM-DD');

            datatable.fnDraw();
        }


    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            "@lang('comman.daterange.all')":[moment.utc('2015-01-01','YYYY-MM-DD'),moment()],
            "@lang('comman.daterange.today')": [moment(), moment()],
            "@lang('comman.daterange.yesterday')": [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            "@lang('comman.daterange.last7day')": [moment().subtract(6, 'days'), moment()],
            "@lang('comman.daterange.last30day')": [moment().subtract(29, 'days'), moment()],
            "@lang('comman.daterange.thismonth')": [moment().startOf('month'), moment().endOf('month')],
            "@lang('comman.daterange.lastmonth')": [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            "@lang('comman.daterange.thisyear')": [moment().startOf('year'), moment().endOf('year')],
            "@lang('comman.daterange.lastyear')": [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        }
    }, cb);

     cb(start, end);
	 
	 
	$('.filter').change(function() {
        datatable.fnDraw();
    });
    

</script>


@endpush