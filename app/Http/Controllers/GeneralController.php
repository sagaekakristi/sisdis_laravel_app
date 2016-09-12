<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Note;

use DB;

class GeneralController extends Controller
{
    /**
     * Hello world.
     */
    public function hello()
    {
        $hello_note = Note::where('title', '=', 'Hello World Note')->first();
        return $hello_note->content;
     //    return array(
     //    	'code' => 1000,
     //    	'message' => 'return hello note',
     //    	'data' => $hello_note->content,
    	// );
    }

    /**
     * Hello world.
     */
    public function uptime()
    {
    	exec("uptime", $system_data);
    	$uptime_linux = $system_data[0];

    	$uptime_mysql = DB::select("SHOW GLOBAL STATUS LIKE 'Uptime'")[0]->Value;

    	return array(
    		'uptime_linux_server' => $uptime_linux,
    		'uptime_mysql_database' => $uptime_mysql,
    	);
    }
}
