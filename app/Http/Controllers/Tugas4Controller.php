<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;
// use Image;
use GuzzleHttp\Client as GuzzleClient;

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

    public function view_image_direct($filename){
        $image_path = public_path() . '/assets/tugas4/img/' . $filename;
        $image_file = File::get($image_path);
        $image_size = File::size($image_path);

        return view('tugas4.view_image')
            ->with('image_filename', $filename)
            ->with('image_path', $image_path)
            ->with('image_size', $image_size)
            ;
    }

     public function view_image_hit($filename){
        $guzzle_client = new GuzzleClient();
        $url = url('tugas4/server/getImage/' . $filename);
        // return $url;
        $response = $guzzle_client->request('GET', $url, [
            // 'form_params' => [],
            // 'headers' => [],
            // 'body' => [],
        ]);
        $body_response = json_decode($response->getBody()->getContents(), true);
        // return $body_response;

        $image_base64 = $body_response['isi_berkas'];
        $image_path = $body_response['lokasi_berkas'];
        $image_extension = pathinfo($image_path, PATHINFO_EXTENSION);
        $image_size = $body_response['ukuran_berkas'];

        $image_data = 'data:image/' . $extension . ';base64,' . $image_base64;

        return view('tugas4.view_image')
            ->with('image_data', $image_data)
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
        return view('tugas4.upload_ui');
    }

    public function upload_image_ui_receiver(){
        
    }
}
