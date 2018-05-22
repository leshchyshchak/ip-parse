@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header display-flex-center-between">
                        IP data
                        <div>
                            <a href="{{route('home')}}" class="btn btn-primary btn-xs pull-right">
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif


                        @if(count($user_ip_data))
                            @foreach($user_ip_data as $data)
                                <table class="vtable table-striped">
                                    <tbody class="width-65 border-none">
                                    <tr>
                                        <th>IP Address</th>
                                        <td>{{$data->ipList->ip}}</td>
                                    </tr>
                                    <tr>
                                        <th>Decimal Representation</th>
                                        <td>{{$data->decimal_representation}}</td>
                                    </tr>
                                    <tr>
                                        <th><abbr title="Autonomous System Number">ASN</abbr></th>
                                        <td>{{$data->asn}}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{$data->city}}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td>{{$data->country}}</td>
                                    </tr>
                                    <tr>
                                        <th>Country Code</th>
                                        <td>{{$data->country_code}}</td>
                                    </tr>
                                    <tr>
                                        <th><abbr title="Internet Service Provider">ISP</abbr></th>
                                        <td>{{$data->isp}}</td>
                                    </tr>
                                    <tr>
                                        <th>Latitude</th>
                                        <td>{{$data->latitude}}</td>
                                    </tr>
                                    <tr>
                                        <th>Longitude</th>
                                        <td>{{$data->longitude}}</td>
                                    </tr>
                                    <tr>
                                        <th>Organization</th>
                                        <td>{{$data->organization}}</td>
                                    </tr>
                                    <tr>
                                        <th>Postal Code</th>
                                        <td>{{$data->postal_code}}</td>
                                    </tr>
                                    <tr>
                                        <th>Is Private IP Address</th>
                                        <td>{{$data->is_private}}</td>
                                    </tr>
                                    <tr>
                                        <th>PTR Resource Record</th>
                                        <td>{{$data->ptr_resource}}</td>
                                    </tr>
                                    <tr>
                                        <th>Is Reserved IP Address</th>
                                        <td>{{$data->is_reserved}}</td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td>{{$data->state}}</td>
                                    </tr>
                                    <tr>
                                        <th>State Code</th>
                                        <td>{{$data->state_code}}</td>
                                    </tr>
                                    <tr>
                                        <th>Timezone</th>
                                        <td>{{$data->timezone}}</td>
                                    </tr>
                                    <tr>
                                        <th>Local Time</th>
                                        <td>{{$data->local_time}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                    <br>
                                <table class="htable ipwhoisranges table-striped">
                                    <thead class="width-33 border-none">
                                    <tr>
                                        <th>Subnet</th>
                                        <th>Net Size</th>
                                        <th>Registrant</th>
                                        <th>Country</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$data->subnet}}</td>
                                        <td>{{$data->net_size}}</td>
                                        <td>{{$data->registrant}}</td>
                                        <td>{{$data->another_country}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$data->subnet_2}}</td>
                                        <td>{{$data->net_size_2}}</td>
                                        <td>{{$data->registrant_2}}</td>
                                        <td>{{$data->another_country_2}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        @else
                            No data
                        @endif


                    </div>
                    <div class="pagination-block margin-top-15">
                        {{$user_ip_data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection