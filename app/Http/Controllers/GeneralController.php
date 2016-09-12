<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Note;

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
    	$system_string = $system_data[0];
    	$uptime = explode(" ", $system_string);

    	$up_days = $uptime[4];
    	$hours = explode(":", $uptime[7]);
    	$up_hours = $hours[0];
    	$mins = $hours[1];
    	$up_mins = str_replace(",", "", $mins);

        return "The server has been up for " . $up_days . " days, " . $up_hours . " hours, and " . $up_mins . " minutes.";
    }
}
