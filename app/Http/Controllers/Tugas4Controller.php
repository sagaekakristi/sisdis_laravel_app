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
        $image_path = public_path() . '/assets/tugas4/img/' . $filename;
        $image_file = File::get($image_path);
        $image_size = File::size($image_path);
        $image_base64_data = base64_encode($image_file);

        return array(
            'isi_berkas' => $image_base64_data,
            'lokasi_berkas' => $image_path,
            'ukuran_berkas' => $image_size,
        );
    }

    public function view_image($filename){
        $image_path = public_path() . '/assets/tugas4/img/' . $filename;
        $image_file = File::get($image_path);
        $image_size = File::size($image_path);

        return view('tugas4.view_image')
            ->with('image_filename', $filename)
            ->with('image_path', $image_path)
            ->with('image_size', $image_size)
            ;
    }

    public function upload_image_api(Request $request){
        $input_image_base64_key = 'image';
        $input_image_filename_key = 'filename';

        $input_image_base64 = $request->input($input_image_base64_key);
        $input_image_filename = $request->input($input_image_filename_key);

        $image_path = public_path() . '/assets/tugas4/img/' . $input_image_filename;
        $image = base64_decode($input_image_base64);
        file_put_contents($image_path, $image);

        return array(
            'image' => $input_image_base64,
            'filename' => $input_image_filename,
        );
    }

    public function upload_image_ui(){
        
    }

    public function upload_image_ui_receiver(){
        
    }
}
