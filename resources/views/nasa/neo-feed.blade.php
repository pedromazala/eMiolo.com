@extends('nasa.api')

@section('name')
    NEO - Feed
@endsection

@section('contents')
    <p>Retrieve a list of Asteroids based on their closest approach date to Earth. </p>
    <p>Here we can get data using the parameters above</p>
    <form class="form-horizontal" action="#">

        <div class="form-group">
            <label for="start_date" class="col-md-4 control-label">Start date</label>

            <div class="col-md-6">
                <input id="start_date" type="date" class="form-control" name="start_date"
                       value="{{ date('Y-m-d', time() - (24 * 60 * 60)) }}" autocomplete="off"/>
            </div>
        </div>

        <div class="form-group">
            <label for="start_date" class="col-md-4 control-label">End date</label>

            <div class="col-md-6">
                <input id="end_date" type="date" class="form-control" name="end_date"
                       value="{{ date('Y-m-d') }}" autocomplete="off"/>
            </div>
        </div>

        <a class="btn btn-primary" href="#" onclick="getData()">Get data</a>
        <a class="btn btn-default" href="{{ url('/nasa') }}">Back</a>
    </form>
    <hr/>
    <div class="api-contents">
        <div class="api-response">
            <div style="display: none;">
                <div class="response-layout">
                    <div class="container">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control name" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Neo id</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control neo_reference_id" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Lookup</label>
                                <div class="col-md-4">
                                    <a class="nasa_lookup" href="" target="_blank">Link to Lookup</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">JPL URL</label>
                                <div class="col-md-4">
                                    <a class="nasa_jpl_url" href="" target="_blank">Link to JPL</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Absolute magnitude</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control absolute_magnitude_h" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Estimated diameter</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control estimated_diameter_min" readonly/>
                                    <input type="text" class="form-control estimated_diameter_max" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Is potentially hazardous</label>
                                <div class="col-md-4">
                                    <input type="checkbox" class="form-control is_potentially_hazardous_asteroid"
                                           disabled/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Relative velocity</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control relative_velocity" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Miss distance</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control miss_distance" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Orbiting</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control orbiting_body" readonly/>
                                </div>
                            </div>
                            <hr/>
                        </form>
                    </div>
                </div>
            </div>
            <div class="data"></div>
        </div>
        <div class="api-loading" style="height: 200px;">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <script>
        function getData() {

            var handleResult = function (result) {
                var nearObjects,
                        $layout = $(".api-response .response-layout"),
                        $dataResponse = $(".api-response .data");

                if ("element_count" in result) {
                    nearObjects = result.near_earth_objects;
                    $dataResponse.html('');
                    for (var day in nearObjects) {
                        if (!nearObjects.hasOwnProperty(day)) continue;
                        var neos = nearObjects[day];
                        $dataResponse.append('<div class="days"></div>');
                        var $day = $dataResponse.find(".days").last();
                        $day.append('<h3>' + day + '</h3>');


                        for (var i in neos) {
                            if (!neos.hasOwnProperty(i)) continue;

                            var neo = neos[i], $response = $layout.clone();

                            $response.find('.name').val(neo.name);
                            $response.find('.neo_reference_id').val(neo.neo_reference_id);
                            $response.find('.nasa_jpl_url').attr('href', '{{ $urlJpl }}' + neo.neo_reference_id);
                            $response.find('.nasa_lookup').attr('href', '{{ url('/nasa/neo-lookup') }}?id=' + neo.neo_reference_id);
                            $response.find('.absolute_magnitude_h').val(neo.absolute_magnitude_h);

                            $response.find('.estimated_diameter_min').val(neo.estimated_diameter.feet.estimated_diameter_min.toFixed(2) + ' feet');
                            $response.find('.estimated_diameter_max').val(neo.estimated_diameter.feet.estimated_diameter_max.toFixed(2) + ' feet');

                            if (neo.is_potentially_hazardous_asteroid) {
                                $response.find('.is_potentially_hazardous_asteroid').attr('checked', 1);
                            }

                            var cad = neo.close_approach_data[Object.keys(neo.close_approach_data)[0]];
                            $response.find('.relative_velocity').val((cad.relative_velocity.miles_per_hour * 1.0).toFixed(2) + '  miles/hour');
                            $response.find('.miss_distance').val((cad.miss_distance.miles * 1.0).toFixed(2) + '  miles');
                            $response.find('.orbiting_body').val(cad.orbiting_body);

                            $day.append($response);
                        }
                    }
                }

                $(".api-response").show();
                $(".api-loading").hide();
            };

            $(".api-response").hide();
            $(".api-loading").show();
            $.ajax({
                url: '{{ $url }}' + '&' + $('form').serialize(),
                success: handleResult
            });
        }

        $(function () {
            getData();
        });
    </script>
@endsection