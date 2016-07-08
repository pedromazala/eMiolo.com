@extends('nasa.api')

@section('name')
    APOD
@endsection

@section('contents')
    <p>One of the most popular websites at NASA is the Astronomy Picture of the Day. In fact, this
        website is one of the most popular websites across all federal agencies. It has the popular
        appeal of a Justin Bieber video. This endpoint structures the APOD imagery and associated
        metadata so that it can be repurposed for other applications. In addition, if the
        concept_tags parameter is set to True, then keywords derived from the image explanation are
        returned. These keywords could be used as auto-generated hashtags for twitter or instagram
        feeds; but generally help with discoverability of relevant imagery.</p>
    <p>Here we can get data using the parameters above</p>
    <form class="form-horizontal" action="#">

        <div class="form-group">
            <label for="date" class="col-md-4 control-label">Date</label>

            <div class="col-md-6">
                <input id="date" type="date" class="form-control" name="date"
                       value="{{ date('Y-m-d') }}" autocomplete="off"/>
            </div>
        </div>

        <div class="form-group">
            <label for="hd" class="col-md-4 control-label">HD</label>

            <div class="col-md-6">
                <input id="hd" type="checkbox" class="form-control" name="hd"
                       value="true" checked/>
            </div>
        </div>
        <a class="btn btn-primary" href="#" onclick="getData()">Get data</a>
        <a class="btn btn-default" href="{{ url('/nasa') }}">Back</a>
    </form>
    <hr/>
    <div class="api-contents">
        <div class="api-response">
            <img id="apod_img_id" width="250px"/>

            <iframe id="apod_vid_id" type="text/html" width="640" height="385"
                    frameborder="0"></iframe>
            <p id="copyright"></p>

            <h3 id="apod_title"></h3>
            <p id="apod_explaination"></p>
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
                if ("copyright" in result) {
                    $("#copyright").text("Image Credits: " + result.copyright);
                }
                else {
                    $("#copyright").text("Image Credits: " + "Public Domain");
                }

                if (result.media_type == "video") {
                    $("#apod_img_id").css("display", "none");
                    $("#apod_vid_id").attr("src", result.url);
                }
                else {
                    $("#apod_vid_id").css("display", "none");

                    $("#apod_img_id").attr("src", result.url);
                    if ($('input[name="hd"]:checked')) {
                        $("#apod_img_id").attr("src", result.hdurl);
                    }
                }
                $("#apod_explaination").text(result.explanation);
                $("#apod_title").text(result.title);

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