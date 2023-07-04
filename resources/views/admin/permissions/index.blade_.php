@extends('layouts.backend')

@section('title','Permissions')


@section('headExtra')

    <style>

        .tree, .tree ul {
            margin: 0;
            padding: 0;
            list-style: none
        }

        .tree ul {
            margin-left: 1em;
            position: relative
        }

        .tree ul ul {
            margin-left: .5em
        }

        .tree ul:before {
            content: "";
            display: block;
            width: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            border-left: 1px solid
        }

        .tree li {
            margin: 0;
            padding: 0 1em;
            line-height: 2em;
            color: #369;
            font-weight: 700;
            position: relative
        }

        .tree ul li:before {
            content: "";
            display: block;
            width: 10px;
            height: 0;
            border-top: 1px solid;
            margin-top: -1px;
            position: absolute;
            top: 1em;
            left: 0
        }

        .tree ul li:last-child:before {
            background: #fff;
            height: auto;
            top: 1em;
            bottom: 0
        }

        .indicator {
            margin-right: 5px;
        }

        .tree li a {
            text-decoration: none;
            color: #369;
        }

        .tree li button, .tree li button:active, .tree li button:focus {
            text-decoration: none;
            color: #369;
            border: none;
            background: transparent;
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
            outline: 0;
        }


    </style>

@stop


@section('footerExtra')

    <script>
        $.fn.extend({
            treed: function (o) {

                var openedClass = 'glyphicon-minus-sign';
                var closedClass = 'glyphicon-plus-sign';

                if (typeof o != 'undefined') {
                    if (typeof o.openedClass != 'undefined') {
                        openedClass = o.openedClass;
                    }
                    if (typeof o.closedClass != 'undefined') {
                        closedClass = o.closedClass;
                    }
                }
                ;

                //initialize each of the top levels
                var tree = $(this);
                tree.addClass("tree");
                tree.find('li').has("ul").each(function () {
                    var branch = $(this); //li with children ul
                    branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                    branch.addClass('branch');
                    branch.on('click', function (e) {
                        if (this == e.target) {
                            var icon = $(this).children('i:first');
                            icon.toggleClass(openedClass + " " + closedClass);
                            $(this).children().children().toggle();
                        }
                    })
                    branch.children().children().toggle();
                });
                //fire event from the dynamically added icon
                tree.find('.branch .indicator').each(function () {
                    $(this).on('click', function () {
                        $(this).closest('li').click();
                    });
                });
                //fire event to open branch if the li contains an anchor instead of text
                tree.find('.branch>a').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
                //fire event to open branch if the li contains a button instead of text
                tree.find('.branch>button').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
            }
        });

        //Initialization of treeviews

        $('#tree1').treed();

        $('#tree2').treed({openedClass: 'glyphicon-folder-open', closedClass: 'glyphicon-folder-close'});

        $('#tree3').treed({openedClass: 'glyphicon-chevron-right', closedClass: 'glyphicon-chevron-down'});

    </script>
@stop


@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Permissions</div>
                <div class="panel-body">


                    <a href="{{ url('/admin/permissions/create') }}" class="btn btn-success btn-sm"
                       title="Add New Permission">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>
                    <hr>

            <ul >

                @foreach($permissions as $item)



                        <a href="#">{{$item->label}}</a>

                        <a href="{{ url('/admin/permissions/' . $item->id) }}" title="View Permission">
                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                   aria-hidden="true"></i> View
                            </button>
                        </a>
                        <a href="{{ url('/admin/permissions/' . $item->id . '/edit') }}"
                           title="Edit Permission">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>
                        {{--{!! Form::open([--}}
                            {{--'method' => 'DELETE',--}}
                            {{--'url' => ['/admin/permissions', $item->id],--}}
                            {{--'style' => 'display:inline'--}}
                        {{--]) !!}--}}
                        {{--{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(--}}
                                {{--'type' => 'submit',--}}
                                {{--'class' => 'btn btn-danger btn-xs',--}}
                                {{--'title' => 'Delete Permission',--}}
                                {{--'onclick'=>'return confirm("Confirm delete?")'--}}
                        {{--)) !!}--}}
                        {{--{!! Form::close() !!}--}}
                        {{--</p>--}}

                    @if($item->child)
                            <ul>
                                @foreach($item->child as $per)
                                    <li>{{$per->label}}

                                        <a href="{{ url('/admin/permissions/' . $per->id) }}" title="View Permission">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ url('/admin/permissions/' . $per->id . '/edit') }}"
                                           title="Edit Permission">
                                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                                      aria-hidden="true"></i> Edit
                                            </button>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif


                    </li>

                @endforeach

            </ul>

                </div>
            </div>

        </div>
    </div>

@stop


@section('contentxx')









    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Permissions</div>
                <div class="panel-body">
                    <a href="{{ url('/admin/permissions/create') }}" class="btn btn-success btn-sm"
                       title="Add New Permission">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    <div id="test" class="tree">
                        <ul>
                            <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                <ul>
                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                        <ul>
                                            <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                        <ul>
                                            <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                        <ul>
                                            <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                <ul>
                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                        <ul>
                                            <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                        <ul>
                                            <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                        <ul>
                                            <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                <ul>
                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                        <ul>
                                            <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                        <ul>
                                            <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                        <ul>
                                            <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                <ul>
                                                    <li class="parent_li"><span title="Verkleinern">Test 1</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 2</span>
                                                        <ul></ul>
                                                    </li>
                                                    <li class="parent_li"><span title="Verkleinern">Test 3</span>
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>


                    {!! Form::open(['method' => 'GET', 'url' => '/admin/permissions', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
                        <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                    {!! Form::close() !!}

                    <br/>
                    <br/>


                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Permission Name</th>
                                <th>Label</th>
                                <th>Child Permissions</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="col-md-2"><a
                                                href="{{ url('/admin/permissions', $item->id) }}">{{ $item->name }}</a>
                                    </td>
                                    <td>{{ $item->label }}</td>

                                    <td>
                                        <ul>
                                            @foreach($item->child as $i)

                                                <li>{{$i->name}} ({{$i->label}})</li>

                                            @endforeach
                                        </ul>

                                    </td>

                                    <td>
                                        <a href="{{ url('/admin/permissions/' . $item->id) }}" title="View Permission">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ url('/admin/permissions/' . $item->id . '/edit') }}"
                                           title="Edit Permission">
                                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                                      aria-hidden="true"></i> Edit
                                            </button>
                                        </a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/admin/permissions', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete Permission',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination"> {!! $permissions->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
