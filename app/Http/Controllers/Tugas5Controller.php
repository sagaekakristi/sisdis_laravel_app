<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\VisitorCount;

class Tugas5Controller extends Controller
{
    /**
     * Render page.
     */
    public function index()
    {
        $visitor_counter = VisitorCount::find(1);
        $visitor_counter->counter += 1;
        $visitor_counter->save();

        $ip = '152.118.33.96';
        $owner_name = 'Adrianus Saga Ekakristi';
        $penumpang_name = 'Christian Halim, Alvin Wijaya';

        return view('tugas5.index')
            ->with('ip', $ip)
            ->with('owner_name', $owner_name)
            ->with('penumpang_name', $penumpang_name)
            ->with('counter_value', $visitor_counter->counter)
            ;
    }
}
