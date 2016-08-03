<?php namespace App\Http\Controllers\Import;

use App\Http\Controllers\DBC;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ApiImportController extends Controller
{

    
    public function getDatabases()
    {
        $conn = DBC::connection();
        $dbs = mysqli_query($conn, "SHOW DATABASES");
        $allDatabases = [];
        while ($row = mysqli_fetch_assoc($dbs)) {
            array_push($allDatabases, $row['Database']);
        }

        DBC::dbClose();
        return $allDatabases;
    }

    public function getTables($db)
    {
        $conn = DBC::connection();
        $res = mysqli_query($conn, "SHOW TABLES FROM " . $db . "");
        $allTables = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $name='Tables_in_'.$db.'';
            array_push($allTables, $row[$name]);
        }

        DBC::dbClose();
        return $allTables;
    }

    public function getFields($db, $tbl)
    {
        $conn = DBC::connection();
        mysqli_select_db($conn, $db);
        $res = mysqli_query($conn, "SHOW COLUMNS FROM " . $tbl . "");

        $dataArr = [];
        while ($row = mysqli_fetch_assoc($res)) {
            array_push($dataArr, $row['Field']);
        }

        DBC::dbClose();
        return $dataArr;
    }


}
