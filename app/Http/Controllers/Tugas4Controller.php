<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;
// use Image;

class Tugas4Controller extends Controller
{
    public function get_image_api($filename)
    {
        $image_base64_data = null;
        $image_location = null;
        $image_filesize = null;

        return array(
            'isi_berkas' => $image_base64_data,
            'lokasi_berkas' => $image_location,
            'ukuran_berkas' => $image_filesize,
        );
    }

    public function view_image($filename){
        $image_path = public_path() . '/assets/tugas4/img/' . $filename;

        // if(file_exists($image_path) == false){
        //     return array(
        //         'code' => 9999,
        //         'message' => 'file not exist',
        //     );
        // }

        $image_file = File::get($image_path);
        $image_type = File::mimeType($image_path);
        $image_size = 0;

        return view('tugas4.view_image')
            ->with('image_filename', $filename)
            ->with('image_path', $image_path)
            ->with('image_size', $image_size)
            ;
    }

    public function upload_image_api(){
        
    }

    public function upload_image_ui(){
        
    }
}
