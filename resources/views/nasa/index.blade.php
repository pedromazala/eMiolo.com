@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">API's</div>
                    <div class="panel-body">

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>-</th>
                                <th>API</th>
                                <th>Short description</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td><a class="btn btn-info" href="{{ url('/nasa/apod') }}">Access</a></td>
                                <td>APOD</td>
                                <td><a href="http://apod.nasa.gov/apod/astropix.html" target="_blank">Astronomy Picture
                                        of the Day</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection