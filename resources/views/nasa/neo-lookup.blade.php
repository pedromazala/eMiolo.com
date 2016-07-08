@extends('nasa.api')

@section('name')
    NEO - Lookup
@endsection

@section('contents')
    <p>Lookup a specific Asteroid based on its NASA JPL small body (SPK-ID) ID</p>
    <p>Here we can get data using the parameters above</p>
    <form class="form-horizontal" action="#">

        <div class="form-group">
            <label for="start_date" class="col-md-4 control-label">JPL ID</label>

            <div class="col-md-6">
                <input id="id" type="int" class="form-control" name="id"
                       value="{{ Request::input('id') }}" autocomplete="off"/>
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

                if ("name" in result) {
                    $dataResponse.html('');

                    var $response = $layout.clone();

                    $response.find('.name').val(result.name);
                    $response.find('.neo_reference_id').val(result.neo_reference_id);
                    $response.find('.nasa_jpl_url').attr('href', '{{ $urlJpl }}' + result.neo_reference_id);
                    $response.find('.absolute_magnitude_h').val(result.absolute_magnitude_h);

                    $response.find('.estimated_diameter_min').val(result.estimated_diameter.feet.estimated_diameter_min.toFixed(2) + ' feet');
                    $response.find('.estimated_diameter_max').val(result.estimated_diameter.feet.estimated_diameter_max.toFixed(2) + ' feet');

                    if (result.is_potentially_hazardous_asteroid) {
                        $response.find('.is_potentially_hazardous_asteroid').attr('checked', 1);
                    }

                    var cad = result.close_approach_data[Object.keys(result.close_approach_data)[0]];
                    $response.find('.relative_velocity').val((cad.relative_velocity.miles_per_hour * 1.0).toFixed(2) + '  miles/hour');
                    $response.find('.miss_distance').val((cad.miss_distance.miles * 1.0).toFixed(2) + '  miles');
                    $response.find('.orbiting_body').val(cad.orbiting_body);

                    $dataResponse.append($response);
                }

                $(".api-response").show();
                $(".api-loading").hide();
            };

            var id = $('form input[name="id"]').val();
            if (id) {
                $(".api-response").hide();
                $(".api-loading").show();
                $.ajax({
                    url: '{{ $url }}' + id + '?api_key={{ $api_key }}',
                    success: handleResult
                });
            }
        }

        $(function () {
            $(document).ajaxError(function (e, xhr, settings, exception) {
                alert("The informed JPL ID is not compatible with this API");
            });

            getData();
        });
    </script>
@endsection