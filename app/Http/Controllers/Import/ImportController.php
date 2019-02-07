<?php namespace App\Http\Controllers\Import;

use App\Http\Controllers\DBC;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Log;
use Maatwebsite\Excel\Facades\Excel;


class ImportController extends Controller
{

    public function home()
    {
        return view('home');
    }

    public function import()
    {
        return view('import');
    }

    public function postImport(Request $r)
    {

        $file = $r->file('file');
        $ext = $file->guessClientExtension();    // get file extension

        $db = $r->get('database');
        $tbl = $r->get('table');

        $conn = DBC::connection();
        mysqli_select_db($conn, $db);
        $res = mysqli_query($conn, "SHOW COLUMNS FROM " . $tbl . "");

        $dataArr = [];
        while ($row = mysqli_fetch_assoc($res)) {
            array_push($dataArr, $row['Field']);
        }
        DBC::dbClose();

        Session::put('database', $db);
        Session::put('table', $tbl);
        Session::put('table_fields', $dataArr);

        switch ($ext) {
            case 'xls':
            case 'xlsx':
            case 'csv':
                //parsing data
                Excel::selectSheetsByIndex(0)->load($file, function ($reader) {
                    $tempResults = $reader->toArray();
                    Session::put('upload_results', $tempResults);
                });
                // end parsing data

                return view('partial.data');
                break;
            case 'json':
                //parsing data
                $content = file_get_contents($file);
                $jsonData = json_decode($content, true);

                Session::put('upload_results', $jsonData);

                return view('partial.data');
                // end parsing data
                break;
        }
        //end of switch
    }

    public function postImportProcess()
    {
        $database = Session::get('database');
        $table = Session::get('table');
        $conn = DBC::connection();
        mysqli_select_db($conn, $database);

        $results = Session::get('upload_results');


        $inputData = Input::except('_token');

        $inputData = array_filter($inputData); //filter array with null value

        $tblColumn = implode(',', array_values($inputData));

        mysqli_autocommit($conn, FALSE);

        try {
            $totalSuccess = 0;
            $totalFail = 0;
            foreach ($results as $row) {
                $columnTempArr = [];
                $excelColumnArr = array_keys($inputData);
                foreach ($excelColumnArr as $exCol) {
                    array_push($columnTempArr, "'" . $row[$exCol] . "'");
                }
                $excelColumnValues = implode(',', $columnTempArr);
                $sql = "INSERT INTO " . $table . "(" . $tblColumn . ") values(" . $excelColumnValues . ")";
                Log::info($sql);

                $queryResult = mysqli_query($conn, $sql);
                if ($queryResult) {
                    $totalSuccess = $totalSuccess + 1;
                } else {
                    $totalFail = $totalFail + 1;
                }
            }

            // Commit transaction
            mysqli_commit($conn);
            Session::flush();
            return view('partial.process-result', compact(['totalSuccess', 'totalFail']));
        } catch (\Exception $e) {
            Log::info("Exception found");
            // Rollback transaction
            mysqli_rollback($conn);
            // Close connection
            mysqli_close($conn);
        }


    }

    public function reset()
    {
        Session::flush();
        return redirect()->back()->with('success', 'Data Reset Successfully');
    }


}
