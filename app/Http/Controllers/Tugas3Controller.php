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
        // ini_set('soap.wsdl_cache_enabled', 0);
        // ini_set('soap.wsdl_cache_ttl', 0);
        // ini_set('default_socket_timeout', 300);
        // ini_set('max_execution_time', 0);
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
            // "http://152.118.33.95/tugas3/speksaya.wsdl",
            "http://localhost:8000/tugas3/speksaya.wsdl",
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
        
        $client = new SoapClient('http://localhost:8000/tugas3/speksaya.wsdl');
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
        SoapWrapper::add(function ($service) {
            $service
                ->name('hello')
                // ->wsdl('http://www.herongyang.com/Service/Hello_WSDL_11_SOAP.wsdl');
                // ->wsdl('http://152.118.33.95/tugas3/speksaya.wsdl');
                ->wsdl('http://localhost:8000/tugas3/speksaya.wsdl');
        });

        $data = 'I am Thor';
        // $data = $request->input('helloInputMessage');

        // Using the added service
        SoapWrapper::service('hello', function ($service) use ($data) {
            var_dump($service->getFunctions());
            var_dump($service->call('hello', [$data]));
        });
    }

    // public function server() {
    //     $location = 'http://localhost:8000/tugas3/spesifikasi.wsdl';//url('tugas3/server'); // http://payment.dev/server
    //     // dd($location);
    //     $namespace = $location;
    //     $class = "\\App\\Http\\Controllers\\HelloWorld";

    //     // $wsdl = new \WSDL\WSDLCreator($class, $location);
    //     // $wsdl->setNamespace($namespace);

    //     // if (isset($_GET['wsdl'])) {
    //     //     $wsdl->renderWSDL();
    //     //     exit;
    //     // }

    //     // $wsdl->renderWSDLService();

    //     $wsdlUrl = url('tugas3/spesifikasi.wsdl');
    //     $server = new \SoapServer(
    //         url($location),
    //         array(
    //             'exceptions' => 1,
    //             'trace' => 1,
    //         )
    //     );

    //     $server->setClass($class);
    //     $server->handle();
    //     exit;
    // }

    // public function client() {
    //     $wsdl = url('tugas3/spesifikasi.wsdl');
    //     $client = new \SoapClient($wsdl);

    //     try {
    //         $res = $client->hello('world');
    //         dd($res);
    //     } catch (\Exception $ex) {
    //         dd($ex);
    //     }
    // }
}

    // public function service(){
    //     ini_set("soap.wsdl_cache_enabled", "0"); 
    //     $server = new SoapServer("http://152.118.33.96/tugas3/spesifikasi.wsdl", array('soap_version' => SOAP_1_2));
    //     // $server->addFunction("hello");
    //     $server->setClass('App\Http\Controllers\SoapRequest');
    //     $server->handle();
    //     exit;
    // }

    // function hello($hello_input_message) { 
    //     return "Hallo " . $hello_input_message;
    // }

    // public function demo()
    // {
    //     // Add a new service to the wrapper
    //     SoapWrapper::add(function ($service) {
    //         $service
    //             ->name('currency')
    //             ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?WSDL');
    //             // ->trace(true)                                                   // Optional: (parameter: true/false)
    //             // ->header()                                                      // Optional: (parameters: $namespace,$name,$data,$mustunderstand,$actor)
    //             // ->customHeader($customHeader)                                   // Optional: (parameters: $customerHeader) Use this to add a custom SoapHeader or extended class                
    //             // ->cookie()                                                      // Optional: (parameters: $name,$value)
    //             // ->location()                                                    // Optional: (parameter: $location)
    //             // ->certificate()                                                 // Optional: (parameter: $certLocation)
    //             // ->cache(WSDL_CACHE_NONE)                                        // Optional: Set the WSDL cache
    //             // ->options(['login' => 'username', 'password' => 'password']);   // Optional: Set some extra options
    //     });

    //     $data = [
    //         'CurrencyFrom' => 'USD',
    //         'CurrencyTo'   => 'EUR',
    //         'RateDate'     => '2014-06-05',
    //         'Amount'       => '1000'
    //     ];

    //     // Using the added service
    //     SoapWrapper::service('currency', function ($service) use ($data) {
    //         var_dump($service->getFunctions());
    //         var_dump($service->call('GetConversionAmount', [$data])->GetConversionAmountResult);
    //     });
    // }
// }

class HelloWorld {
    /**
     * @WebMethod
     * @desc Hello Web-Service
     * @param string $name
     * @return string $helloMessage
     */
    public function hello() {
        return "Hallo, Thor";
    }
}

// class SoapRequest{
//     public function functionFromWsdl($hello_input_message)
//     {
//         return "Hallo " . $hello_input_message;
//     }
// }