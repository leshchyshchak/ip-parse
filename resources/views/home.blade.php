@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header display-flex-center-between">
                        Dashboard
                        <div>
                            <button class="btn btn-primary btn-xs pull-right" data-toggle="modal"
                                    data-target="#addIpModal">
                                Add new IP
                            </button>
                            <button class="btn btn-primary btn-xs pull-right" data-toggle="modal"
                                    data-target="#parseDataModal">
                                Parse data
                            </button>
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped custab margin-bottom0">
                        <thead>
                        <tr class="width-33 border-none">
                            <th>ID</th>
                            <th>IP</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>

                        @if(count($user_ip_lists))
                            @foreach($user_ip_lists as $list)
                                <tr class="width-33 border-none">
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->ip}}</td>
                                    <td class="display-flex-center-right">
                                        <a href="{{route('ip_list.show', ['id' => $list->id,])}}"
                                           class="btn btn-warning margin-right-10">Show</a>
                                        <button class="btn btn-info btn-xs margin-right-10" data-toggle="modal"
                                                data-target="#editIpModal-{{$list->id}}">
                                            <span class="glyphicon glyphicon-edit"></span>Edit
                                        </button>
                                        <form action="{{route('ip_list.destroy', ['id' => $list->id,])}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-xs" type="submit">
                                                <span class="glyphicon glyphicon-remove"></span> Del
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    You have no IP.
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif

                    </table>

                </div>

                <div class="pagination-block margin-top-15">
                    {{$user_ip_lists->links()}}
                </div>

            </div>
        </div>
    </div>

    @foreach($user_ip_lists as $list)
        <div class="modal fade" id="editIpModal-{{$list->id}}" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <form action="{{route('ip_list.update', ['id' => $list->id])}}" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit IP</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <label for="ip-data">Enter IP:</label>
                            <input class="form-control" type="text" id="ip-data" name="ip" value="{{$list->ip}}">
                        </div>
                        <div class="modal-footer">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success">Edit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    @endforeach

    <div class="modal fade" id="addIpModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form action="{{route('ip_list.store')}}" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Add IP:</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label for="ip-data">Enter IP</label>
                        <input class="form-control" type="text" id="ip-data" name="ip" value="{{old('ip')}}">
                    </div>
                    <div class="modal-footer">
                        @csrf
                        <button type="submit" class="btn btn-success">Add</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <div class="modal fade" id="parseDataModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form action="{{route('ip_list.parse_data')}}" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Start parser?</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        Maybe some another options
                    </div>
                    <div class="modal-footer">
                        @csrf
                        <button type="submit" class="btn btn-success">Start</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


@endsection
