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
        $url = 'grup1-01.sisdis.ui.ac.id:7480/auth/1.0';
        $response = $guzzle_client->request('GET', $url, [
            'headers' => array(
                'X-Auth-User' => 'alvin:swift',
                'X-Auth-Key' => 'Jwq9kFXmG0hsS0su1aILsfpLaH9yqjYLpJPALGy2',
            ),
        ]);
        $xauthtoken = $response->getHeaderLine('X-Auth-Token');

        //
        $url = 'grup1-01.sisdis.ui.ac.id:7480/swift/v1/';
        $response = $guzzle_client->request('GET', $url, [
            'headers' => array(
                'X-Auth-Token' => $xauthtoken,
            ),
        ]);
        $body_response = $response->getBody()->getContents();
        $list_of_bucket = explode("\n", trim($body_response));

        foreach($list_of_bucket as $bucket_name){
            $url = url('ceph/' . $bucket_name);
            $link = '<a href="' . $url . '">' . $bucket_name . '</a>' . '<br>';
            echo $link;
        }
    }

    /**
     * 
     */
    public function list_file(Request $request, $bucket_name)
    {
        //
        $guzzle_client = new GuzzleClient();
        $url = 'grup1-01.sisdis.ui.ac.id:7480/auth/1.0';
        $response = $guzzle_client->request('GET', $url, [
            'headers' => array(
                'X-Auth-User' => 'alvin:swift',
                'X-Auth-Key' => 'Jwq9kFXmG0hsS0su1aILsfpLaH9yqjYLpJPALGy2',
            ),
        ]);
        $xauthtoken = $response->getHeaderLine('X-Auth-Token');

        //
        $url = 'grup1-01.sisdis.ui.ac.id:7480/swift/v1/' . $bucket_name;
        $response = $guzzle_client->request('GET', $url, [
            'headers' => array(
                'X-Auth-Token' => $xauthtoken,
            ),
        ]);
        $body_response = $response->getBody()->getContents();
        $list_of_object = explode("\n", trim($body_response));

        foreach($list_of_object as $object_name){
            $url = url('ceph/' . $bucket_name . '/' . $object_name);
            $link = '<a href="' . $url . '">' . $object_name . '</a>' . '<br>';
            echo $link;
        }
    }

    /**
     * 
     */
    public function get_file(Request $request, $bucket_name, $file_name)
    {
        //
        $guzzle_client = new GuzzleClient();
        $url = 'grup1-01.sisdis.ui.ac.id:7480/auth/1.0';
        $response = $guzzle_client->request('GET', $url, [
            'headers' => array(
                'X-Auth-User' => 'alvin:swift',
                'X-Auth-Key' => 'Jwq9kFXmG0hsS0su1aILsfpLaH9yqjYLpJPALGy2',
            ),
        ]);
        $xauthtoken = $response->getHeaderLine('X-Auth-Token');

        //
        $url = 'grup1-01.sisdis.ui.ac.id:7480/swift/v1/' . $bucket_name . '/' . $file_name;
        $response = $guzzle_client->request('GET', $url, [
            'headers' => array(
                'X-Auth-Token' => $xauthtoken,
            ),
        ]);
        $body_response = $response->getBody()->getContents();

        return $body_response;
    }
}
