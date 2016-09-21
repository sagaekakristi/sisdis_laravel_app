<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
use SoapServer;
use SoapClient;

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
        $server = new SoapServer(
            "http://152.118.33.96/tugas3/speksaya.wsdl",
            array('soap_version' => SOAP_1_2)
        );
        $class = \App\Http\Controllers\HelloWorld::class;
        $server->setClass($class);

        $server->handle();
    }

    public function client(Request $request)
    {
        $url_wsdl = $request->input('urlWsdl');

        // Add a new service to the wrapper
        SoapWrapper::add(function ($service) {
            $service
                ->name('hello')
                ->wsdl($url_wsdl);
        });

        $data = $request->input('helloInputMessage');

        // Using the added service
        SoapWrapper::service('hello', function ($service) use ($data) {
            $service->getFunctions();
            var_dump($service->call('hello', [$data]));
        });
    }

    public function demo(Request $request)
    {
        // Add a new service to the wrapper
        SoapWrapper::add(function ($service) {
            $service
                ->name('hello')
                ->wsdl('http://152.118.33.96/tugas3/speksaya.wsdl');
        });

        $data = 'I am Thor';
        // $data = $request->input('helloInputMessage');

        // Using the added service
        SoapWrapper::service('hello', function ($service) use ($data) {
            $service->getFunctions();
            var_dump($service->call('hello', [$data]));
        });
    }
}

class HelloWorld {
    public function hello($input_data) {
        return "Hallo, " . $input_data;
    }
}
