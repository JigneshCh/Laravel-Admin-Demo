@extends('layouts.apex')

@section('title','Roles')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="content-header"> @lang('role.label.roles') </div>
      
    </div>
</div>

    <section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   
                    <div class="row">
                    
                    <div class="col-3">
					{{-- <div class="actions pull-left">
                             
                                <a href="{{ url('/admin/roles/create') }}" class="btn btn-success btn-sm"
                                   title="Add New Role">
                                    <i class="fa fa-plus" aria-hidden="true"></i> @lang('comman.label.add_new')
                                </a>
                           
                          </div> --}}
                         </div>
                        <div class="col-9">
                          
                            
                    </div>
                    </div>
                </div>
                <div class="card-body collapse show">
                    
                    <div class="card-block card-dashboard">
                       
                        
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped datatable responsive">
                            <thead>
                            <tr>
                                <th>@lang('comman.label.id')</th>
                                <th>@lang('user.label.name')</th>
                                <th>Role</th>
                                
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

    var url = "{{url('admin/roles')}}";
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
        order: [0, "asc"],
        columns: [
            { "data": "id","name":"id","searchable": false,"width":"8%"},
            { "data": "name","name":"name","width":"30%"},
            { "data": "label","name":"label","width":"20%"}

        ],
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $('td', nRow).attr('nowrap', 'nowrap');
            return nRow;
        },
        ajax: {
            url: "{{ url('admin/roles/datatable') }}", // json datasource
            type: "get", // method , by default get
            data: function (d) {
                
            }
        }
    });

    $('.filter').change(function() {
        datatable.fnDraw();
    });
   


    $(document).on('click', '.del-item', function (e) {
        var id = $(this).attr('data-id');
        var r = confirm("@lang('comman.js_msg.confirm_for_delete',['item_name'=>'Role'])");
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
