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

        return view('ceph.list_bucket')
            ->with('list_of_bucket', $list_of_bucket);
    }

    /**
     * 
     */
    public function list_bucket_api(Request $request)
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

        return array(
            'message' => 'return list of bucket',
            'data' => array(
                'buckets' => $list_of_bucket,
            ),
        );
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

        return view('ceph.list_file')
            ->with('list_of_object', $list_of_object)
            ->with('bucket_name', $bucket_name);
    }

    /**
     * 
     */
    public function list_file_api(Request $request, $bucket_name)
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

        return array(
            'message' => 'return list of object',
            'data' => array(
                'bucket_name' => $bucket_name,
                'objects' => $list_of_object,
            ),
        );
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

        return $response;
    }

    /**
     * 
     */
    public function create_bucket_form(Request $request)
    {
        return view('ceph.create_bucket_form');
    }

    /**
     * 
     */
    public function create_bucket_receiver(Request $request)
    {
        $bucket_name = $request->input('bucket_name');

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
        $response = $guzzle_client->request('PUT', $url, [
            'headers' => array(
                'X-Auth-Token' => $xauthtoken,
            ),
        ]);
        $body_response = $response->getBody()->getContents();

        return array(
            'message' => 'Successfuly creating bucket',
        );
    }

    /**
     * 
     */
    public function delete_bucket_form(Request $request)
    {
        return view('ceph.delete_bucket_form');
    }

    /**
     * 
     */
    public function delete_bucket_receiver(Request $request)
    {
        $bucket_name = $request->input('bucket_name');

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
        $response = $guzzle_client->request('DELETE', $url, [
            'headers' => array(
                'X-Auth-Token' => $xauthtoken,
            ),
        ]);
        $body_response = $response->getBody()->getContents();

        return array(
            'message' => 'Successfuly deleting bucket',
        );
    }

    /**
     * 
     */
    public function create_object_form(Request $request)
    {
        return view('ceph.create_object_form');
    }

    /**
     * 
     */
    public function create_object_receiver(Request $request)
    {
        $bucket_name = $request->input('bucket_name');
        $object_name = $request->input('object_name');
        //$object_content = $request->input('object_content');
        $file = $request->file('object_content');
        $file_content = file_get_contents($file);

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
        $url = 'grup1-01.sisdis.ui.ac.id:7480/swift/v1/' . $bucket_name . '/' . $object_name;
        $response = $guzzle_client->request('PUT', $url, [
            'headers' => array(
                'X-Auth-Token' => $xauthtoken,
            ),
            'body' => $file_content,
        ]);
        $body_response = $response->getBody()->getContents();

        return array(
            'message' => 'Successfuly creating object',
        );
    }

    /**
     * 
     */
    public function delete_object_form(Request $request)
    {
        return view('ceph.delete_object_form');
    }

    /**
     * 
     */
    public function delete_object_receiver(Request $request)
    {
        $bucket_name = $request->input('bucket_name');
        $object_name = $request->input('object_name');

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
        $url = 'grup1-01.sisdis.ui.ac.id:7480/swift/v1/' . $bucket_name . '/' . $object_name;
        $response = $guzzle_client->request('DELETE', $url, [
            'headers' => array(
                'X-Auth-Token' => $xauthtoken,
            ),
        ]);
        $body_response = $response->getBody()->getContents();

        return array(
            'message' => 'Successfuly deleting object',
        );
    }

    /**
     * 
     */
    public function copy_object_form(Request $request)
    {
        return view('ceph.copy_object_form');
    }

    /**
     * 
     */
    public function copy_object_receiver(Request $request)
    {
        $source_bucket_name = $request->input('source_bucket_name');
        $source_object_name = $request->input('source_object_name');

        $destination_bucket_name = $request->input('destination_bucket_name');
        $destination_object_name = $request->input('destination_object_name');

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
        $url = 'grup1-01.sisdis.ui.ac.id:7480/swift/v1/' . $source_bucket_name . '/' . $source_object_name;
        $response = $guzzle_client->request('COPY', $url, [
            'headers' => array(
                'X-Auth-Token' => $xauthtoken,
                'Destination' => $destination_bucket_name . '/' . $destination_object_name,
            ),
        ]);
        $body_response = $response->getBody()->getContents();

        return array(
            'message' => 'Successfuly copying object',
        );
    }

    public function list_bucket_ui(Request $request)
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

        return view('cephui.index')
            ->with('list_of_bucket', $list_of_bucket);
    }

    public function list_file_ui(Request $request, $bucket_name)
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

        return view('cephui.bucket-detil')
            ->with('list_of_object', $list_of_object)
            ->with('bucket_name', $bucket_name);
    }
}
