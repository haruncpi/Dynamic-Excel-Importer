@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Excel Import</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="{{route('uploadFileRoute')}}"
                              class="form-horizontal form-inline" name="upload-form"
                              enctype="multipart/form-data" id="upload-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="file" class="form-control input-sm" name="file">
                            <select name="database" id="database" class="select2" disabled="disabled"></select>
                            <select name="table" id="table" class="select2" disabled="disabled"></select>

                            <button class="btn btn-success btn-sm btn-upload" type="submit" disabled="disabled">Upload
                            </button>
                            <img src="{{asset("public/images/ajax-loader.gif")}}" class="upload-loader"
                                 alt="upload-loader">
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="result-loader">
                    <img src="{{asset("public/images/ajax-loader.gif")}}" alt="result-loader">
                </div>
                <div id="result-box">

                </div>
            </div>
        </div>


    </div>



@endsection


@section('script')
    <script>
        $(function () {
            //get database list
            $.get(siteUrl + '/api/databases', function (data) {
                //console.log(data)
                if (data.length) {
                    var html = '<option value="">--Select--</option>';
                    ;
                    var i = 0;
                    for (i; i < data.length; i++) {
                        html += '<option value="' + data[i] + '">' + data[i] + '</option>';
                    }
                    //console.log(html);
                    $('select[name="database"]').html(html);
                }
            });

            $('input[name="file"]').change(function () {
                var fileName = $(this).val();
                var extension = fileName.substr((fileName.lastIndexOf('.') + 1));
                switch (extension) {
                    case 'xls':
                    case 'csv':
                    case 'xlsx':
                    case 'json':
                        console.log(extension);
                        $('select[name="database"]').removeAttr("disabled");
                        break;
                    default:
                        $('select[name="database"]').attr("disabled", "disabled");
                        swal("Oops!", "Invalid file type. Please upload only csv,xls or xlsx file!", "error");

                        console.log(extension);
                }
            });
            $('select[name="database"]').change(function () {
                $('select[name="table"]').attr("disabled", "disabled");
                $('.upload-loader').show();

                var database = $(this).val();
                if (database != '') {
                    $.get(siteUrl + '/api/databases/' + database, function (data) {
                        //console.log(data)
                        if (data.length) {
                            var html = '<option value="">--Select--</option>';
                            var i = 0;
                            for (i; i < data.length; i++) {
                                html += '<option value="' + data[i] + '">' + data[i] + '</option>';
                            }
                            //console.log(html);
                            $('select[name="table"]').html(html);
                            $('select[name="table"]').removeAttr("disabled");

                            $('.upload-loader').hide();
                            $('select[name="table"]').focus();
                        }

                    });
                }
                else {
                    $('select[name="table"]').val("");
                    $('select[name="table"]').attr("disabled", "disabled");
                    $('.upload-loader').hide();
                }
            });
            $('select[name="table"]').change(function () {
                var table = $(this).val();
                if (table != '') {
                    $('.btn-upload').removeAttr("disabled");
                }
                else {
                    $('.btn-upload').attr("disabled", "disabled");
                }
            });
            $('#upload-form').submit(function (e) {
                e.preventDefault();
                $(".result-loader").show();
                var url = $(this).attr('action');
                var type = $(this).attr('method');

                var formData = new FormData($(this)[0]);

                $.ajax({
                    type: type,
                    url: url,
                    data: formData,

                    enctype: 'multipart/form-data',
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function (results) {
//                        console.log(results);

                        $(".result-loader").hide();
                        $("#result-box").html(results);
                    },
                    error: function (results) {
                        $(".result-loader").hide();
                        console.log("ERROR");
                        $("#result-box").html("Something Went Wrong!");
                    }
                });
            });

            //process
            $("#result-box").on("submit", "#data-process-form", function (e) {
                e.preventDefault();

                //check at least one column mapper
                var isAllSelectBoxNull = 1;
                $(this).find('select').each(function () {
                    var text_value = $(this).val();
                    if (text_value != '') {
                        isAllSelectBoxNull = 0;
                        return false;
                    }
                });
                //# check at least one column mapper
                if (isAllSelectBoxNull) {
                    swal("Sorry!", "You must have to map at least on table column", "error");

                }
                else {
                    if (confirm("Are your sure?")) {
                        $(".result-loader").show();
                        $("#result-box").hide();

                        var url = $(this).attr('action');
                        var type = $(this).attr('method');
                        var formData = $(this).serialize();
                        $.ajax({
                            type: type,
                            url: url,
                            data: formData,
                            success: function (results) {
//                                console.log(results);
                                $(".result-loader").hide();
                                $("#result-box").html(results);
                                $("#result-box").show();
                            },
                            error: function (results) {
                                $(".result-loader").hide();
                                console.log("ERROR");
                                $("#result-box").html("Something Went Wrong!");
                                $("#result-box").show();
                            }
                        });
                    }
                }


            });
        })

    </script>
@endsection


