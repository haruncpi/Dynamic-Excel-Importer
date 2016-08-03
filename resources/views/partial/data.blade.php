<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">File Data</h3>
    </div>
    <div class="panel-body">
        @if(Session::has('upload_results') && Session::has('table_fields'))
            <?php
            $mainResults = Session::get('upload_results');
            $results = array_slice($mainResults, 0, 10);
            $database = Session::get('database');
            $table = Session::get('table');
            $tableFields = Session::get('table_fields');
            $fileColumns = array_keys($results[0]);      // xls file columns
            ?>


            <form method="post" action="{{route('importProcessRoute')}}" id="data-process-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="well well-sm">
                    <div class="btn-group pull-right">
                        <button class="btn btn-success btn-sm" type="submit">PROCESS</button>
                    </div>


                    <p><i class="fa fa-info-circle"></i> Total Row Found In Sheet : {{count($mainResults)}} <br>
                        <i class="fa fa-database"></i> Database: {{$database}}<br>
                        <i class="fa fa-table"></i> Table: {{$table}}
                    </p>
                </div>

                <table class="table table-bordered table-condensed">

                    <thead>
                    <tr>
                        @foreach($fileColumns as $column)

                            <th>
                                {{$column}} <br>
                                <select name="{{$column}}" class="form-control input-sm">
                                    <option value="">--Select--</option>
                                    @foreach($tableFields as $field)
                                        <option value="{{$field}}">{{$field}}</option>
                                    @endforeach
                                </select>
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results as $row)
                        <tr>
                            @foreach($fileColumns as $column)
                                <td>{{$row[$column]}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="{{count($fileColumns)}}">
                            <i class="fa fa-info-circle"></i> Here showing first {{count($results)}} records
                            of {{count($mainResults)}}. {{count($mainResults)}} row will be insert in your
                            <strong>{{$table}}</strong> table of <strong>{{$database}}</strong> database
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </form>
        @endif
    </div>
</div>
