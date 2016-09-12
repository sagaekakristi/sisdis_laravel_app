<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Note;

class GeneralController extends Controller
{
    /**
     * Display specific note.
     */
    public function hello()
    {
        $hello_note = Note::where('title', '=', 'Hello World Note')->first();
        return array(
        	'code' => 1000,
        	'message' => 'return hello note',
        	'data' => $hello_note->content,
    	);
    }
}
