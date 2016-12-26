<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client as GuzzleClient;
use Exception;

class CephConsumer extends Controller
{
    /**
     * 
     */
    public function list_bucket(Request $request)
    {
        //
        $guzzle_client = new GuzzleClient();
        $url = 'grup1-01.sisdis.ui.ac.id:7480';
        $response = $guzzle_client->request('GET', $url, [
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Host' => 'grup1-01.sisdis.ui.ac.id:7480',
                'X-Amz-Date' => '20161226T040054Z',
                'Authorization' => 'AWS4-HMAC-SHA256 Credential=UZHT321LEU84XA0KPV5R/20161226/us-east-1/execute-api/aws4_request, SignedHeaders=content-type;host;x-amz-date, Signature=619dd17d247062de009da2c455d3015f8330ad850babb4fe31fe90042cf837f7',
            ),
        ]);
        $body_response = $response->getBody()->getContents();

        $parsed = simplexml_load_string($body_response);
        foreach($parsed->Buckets as $bucket){
            foreach($bucket as $inside_bucket){
                $bucket_name = $inside_bucket->Name;
                $url = url('ceph/' . $bucket_name);
                $link = '<a href="' . $url . '">' . $bucket_name . '</a>' . '<br>';
                echo $link;
            }
        }
    }

    /**
     * 
     */
    public function list_file(Request $request, $bucket_name)
    {
        //
        $guzzle_client = new GuzzleClient();
        $url = 'grup1-01.sisdis.ui.ac.id:7480/'.$bucket_name;
        $response = $guzzle_client->request('GET', $url, [
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Host' => 'grup1-01.sisdis.ui.ac.id:7480',
                'X-Amz-Date' => '20161226T050931Z',
                'Authorization' => 'AWS4-HMAC-SHA256 Credential=UZHT321LEU84XA0KPV5R/20161226/us-east-1/execute-api/aws4_request, SignedHeaders=content-type;host;x-amz-date, Signature=0605f1567aa7940a60f60bd585ca9d1d0f00ca6c14b4a9a6fc488bf7100c0ad4',
            ),
        ]);
        $body_response = $response->getBody()->getContents();

        $parsed = simplexml_load_string($body_response);
        dd($parsed->Contents);
        foreach($parsed->Contents as $content){
            foreach($content as $inside_content){
                $content_key = $inside_content->Key;
                $url = url('ceph/' . $bucket_name . '/' . $content_key);
                $link = '<a href="' . $url . '">' . $content_key . '</a>' . '<br>';
                echo $link;
            }
        }
    }

    /**
     * 
     */
    public function get_file(Request $request, $bucket_name, $file_name)
    {
        //
    }
}
