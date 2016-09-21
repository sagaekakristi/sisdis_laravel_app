<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
// use SoapServer;
// use SoapClient;

class Tugas3Controller extends Controller
{
    /**
     * Construct
     */
    public function __construct() {
        // parent::__construct();
        ini_set('soap.wsdl_cache_enabled', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        ini_set('default_socket_timeout', 300);
        ini_set('max_execution_time', 0);
    }

    /**
     * Hello
     */
    public function index()
    {
        return View::make('tugas3.index');
    }

    /**
     * Receiver
     */
    public function receive(Request $request)
    {
        $hello_input_message = $request->input('helloInputMessage');
        $string_output = "Hallo, " . $hello_input_message;
        return $string_output;
    }

    public function server()
    {
        $server = new \SoapServer(
            // "http://152.118.33.95/tugas3/speksaya.wsdl",
            "http://152.118.33.96/tugas3/speksaya.wsdl",
            array('soap_version' => SOAP_1_2)
        );

        // $class = "\\App\\Http\\Controllers\\HelloWorld";
        $class = \App\Http\Controllers\HelloWorld::class;
        $server->setClass($class);
        // $server->addFunction("hello");
        // $server->addFunction();

        $server->handle();
    }

    public function client(Request $request)
    {
        // $client = new SoapClient('/tugas3/spesifikasi.wsdl');
        
        $client = new \SoapClient('http://152.118.33.96/tugas3/speksaya.wsdl');
        $result = $client->hello($request->input('helloInputMessage'));
        return $result;
    }

    public function hello($input_par)
    {
        return "Hallo " . $input_par;
    }

    public function demo(Request $request)
    {
        // Add a new service to the wrapper
        \SoapWrapper::add(function ($service) {
            $service
                ->name('hello')
                // ->wsdl('http://www.herongyang.com/Service/Hello_WSDL_11_SOAP.wsdl');
                // ->wsdl('http://152.118.33.95/tugas3/speksaya.wsdl');
                ->wsdl('http://152.118.33.96/tugas3/speksaya.wsdl');
                // ->wsdl('http://152.118.33.97/tugas3/speksaya.wsdl');
        });

        $data = array(
            'input_string' => 'I am Thor',
            'return_string' => null,
        );
        // $data = $request->input('helloInputMessage');

        // Using the added service
        SoapWrapper::service('hello', function ($service) use ($data) {
            // var_dump($service->getFunctions());
            // var_dump($service->call('hello', [$data]));
            $service->getFunctions();
            var_dump($service->call('hello', [$data['input_string']]));
        });
    }
}

class HelloWorld {
    public function hello() {
        return "Hallo, Thor";
    }
}
