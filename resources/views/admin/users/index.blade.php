@extends('layouts.apex')

@section('body_class',' pace-done')

@section('title',trans('user.label.users'))

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="content-header"> Users </div>
        {{--  @include('partials.page_tooltip',['model' => 'user','page'=>'index']) --}}
    </div>
</div>

    <section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   
                    <div class="row">
                    
                    <div class="col-3">
                        <div class="actions pull-left">
                            
                                <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-sm"
                                   title="Add New User">
                                    <i class="fa fa-plus" aria-hidden="true"></i> @lang('comman.label.add_new')
                                </a>

                            
                          </div>
                         </div>
						 <div class="col-6"></div>
                        <div class="col-3">
                          <div class="form-group">
                              <select class="full-width filter form-control" id="filter_status" name="filter">
									<option value="">All</option>
									<option value="active" selected>Active</option>
									<option value="inactive" >Inactive</option>
							  </select>
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
                                <th>@lang('user.label.id')</th>
                                <th>@lang('user.label.name')</th>
                                <th>@lang('user.label.email')</th>
                                <th>@lang('user.label.role')</th>
								<th>@lang('comman.label.status')</th>
								<th>@lang('comman.label.action')</th>
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

    var url = "{{url('admin/users')}}";
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
        order: [1, "asc"],
        columns: [
            { "data": "id","name":"id","searchable": false,"width":"8%"},
            { 
                "data": null,
                "name":"last_name",
                "searchable": true,
                "orderable": true,
                "render": function (o) {
                    return o.full_name;
                }
            },
            { "data": "email","name":"email","width":"20%"},
            { "data": null,
                "searchable": false,
                "orderable": false,
                "render": function (o) {
                    if(o.roles){
                        var rol = "";
                        for(var i=0;i<o.roles.length;i++){
                            rol = rol + o.roles[i].label;
                            if(i!=o.roles.length-1){
                                rol = rol+" , ";
                            }
                        }
                        return rol;
                    }else{
                        return "";
                    }
                }
            },
            { "data": "status","name":"status","width":"20%"},
            { "data": null,
                "searchable": false,
                "orderable": false,
                "width": "4%",
                "render": function (o) {
                    var e=""; var d=""; var v="";

						if(auth_uid != o.id && o.id != 1){
                   
                        e= " <a href='"+url+"/"+o.id+"/edit' data-id="+o.id+" title='@lang('tooltip.common.icon.edit')'><i class='fa fa-edit action_icon'></i></a>";
                   
                        d = " <a href='javascript:void(0);' class='del-item' data-id="+o.id+" title='@lang('tooltip.common.icon.delete')' ><i class='fa fa-trash action_icon '></i></a>";
                   
				   }

                    var v =  " <a href='"+url+"/"+o.id+"' data-id="+o.id+" title='@lang('tooltip.common.icon.eye')'><i class='fa fa-eye' aria-hidden='true'></i></a>";


                    return v+d+e;

                }
            }

        ],
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $('td', nRow).attr('nowrap', 'nowrap');
            return nRow;
        },
        ajax: {
            url: "{{ url('admin/users/datatable') }}", // json datasource
            type: "get", // method , by default get
            data: function (d) {
                d.status = $('#filter_status').val();
            }
        }
    });

    $('.filter').change(function() {
        datatable.fnDraw();
    });

    $(document).on('click', '.del-item', function (e) {
        var id = $(this).attr('data-id');
        var r = confirm("@lang('comman.js_msg.confirm_for_delete',['item_name'=>'User'])");
        if (r == true) {
            $.ajax({
                type: "DELETE",
                url: url + "/" + id,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function (data) {
                    datatable.fnDraw();
                    toastr.success('Action Success!', data.message)
                },
                error: function (xhr, status, error) {
                    var erro = ajaxError(xhr, status, error);
                    toastr.error('Action Not Procede!',erro)
                }
            });
        }
    });


</script>


@endpush