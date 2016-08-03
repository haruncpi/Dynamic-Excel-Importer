<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DBC extends Controller
{
    private $server;
    private $username;
    private $password;
    private $conn;

    public function __construct()
    {
        $this->server = env('DXI_HOST');
        $this->username = env('DXI_USERNAME');
        $this->password = env('DXI_PASSWORD');

    }

    public static function connection()
    {
        $obj = new Self();
        $conn = mysqli_connect($obj->server, $obj->username, $obj->password);
        return $conn;
    }

    public static function dbClose()
    {
        $obj = new Self();
        $conn = $obj->connection();
        mysqli_close($conn);
    }


}
