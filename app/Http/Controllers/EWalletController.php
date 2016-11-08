<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// models
use App\Models\EWallet;

// helpers
use App\Helpers\EWalletHelper;

// others
use GuzzleHttp\Client as GuzzleClient;
use Exception;
use View;

class EWalletController extends Controller
{
    /* Functions */

    /**
     * ping.
     */
    public function ping()
    {
        return array(
            'pong' => 1,
        );
    }

    /**
     * register.
     */
    public function register(Request $request)
    {
        // cek quorum
        $quorum_data = EWalletHelper::quorum_check();
        $quorum_count = $quorum_data['quorum'];
        if($quorum_count < 5){
            return array(
                'message' => 'quorum tidak terpenuhi',
                'quorum_status' => -1,
                'quorum_data' => $quorum_data,
            );
        }

        $user_id = $request->input('user_id');
        $nama = $request->input('nama');
        $ip_domisili = $request->input('ip_domisili');

        // check if user already exist
        $user = EWallet::where('user_id', '=', $user_id)->first();
        $default_saldo = 1000000;
        $success = null;

        if($user != null){
            // pass
            $success = 1;
        }
        else {
            $user = new EWallet;
            $user->user_id = $user_id;
            $user->nama = $nama;
            $user->ip_domisili = $ip_domisili;
            $user->saldo = $default_saldo;
            $user->save();

            $success = 1;
        }

        return array(
            'success' => $success,
        );
    }

    /**
     * getSaldo.
     */
    public function getSaldo(Request $request)
    {
        // cek quorum
        $quorum_data = EWalletHelper::quorum_check();
        $quorum_count = $quorum_data['quorum'];
        if($quorum_count < 5){
            return array(
                'message' => 'quorum tidak terpenuhi',
                'quorum_status' => -1,
                'quorum_data' => $quorum_data,
            );
        }

        $user_id = $request->input('user_id');

        $user = EWallet::where('user_id', '=', $user_id)->first();
        $nilai_saldo = -1;
        // check if user exist
        if($user == null){
            // pass
        }
        else {
            $nilai_saldo = intval($user->saldo);
        }

        return array(
            'nilai_saldo' => $nilai_saldo,
        );
    }

    /**
     * getTotalSaldo.
     */
    public function getTotalSaldo(Request $request)
    {
        // cek quorum
        $quorum_data = EWalletHelper::quorum_check();
        $quorum_count = $quorum_data['quorum'];
        if($quorum_count < 8){
            return array(
                'message' => 'quorum tidak terpenuhi',
                'quorum_status' => -1,
                'quorum_data' => $quorum_data,
            );
        }

        $user_id = $request->input('user_id');
        $saldo_total = 0;
        $sources = [];
        $ips = [
            'https://saga.sisdis.ui.ac.id/',
            'https://halim.sisdis.ui.ac.id/',
            'https://wijaya.sisdis.ui.ac.id/',
            'https://gylberth.sisdis.ui.ac.id/',
            'https://joseph.sisdis.ui.ac.id/',
            'https://raditya.sisdis.ui.ac.id/',
            'https://wicaksono.sisdis.ui.ac.id/',
            'https://nindyatama.sisdis.ui.ac.id/',
        ];

        $guzzle_client = new GuzzleClient();
        foreach ($ips as $ip){
            $url = $ip . 'ewallet/getSaldo';

            // catch: connection and parsing exception
            try {
                $call_response = $guzzle_client->request('POST', $url, [
                    // 'form_params' => [],
                    // 'headers' => [],
                    'form_params' => array(
                        'user_id' => $user_id,
                    ),
                    'verify' => false,
                ]);
                $body_response = json_decode($call_response->getBody()->getContents(), true);
            }
            catch(Exception $e){
                $body_response = [];
                $body_response['nilai_saldo'] = -98;
            }

            // catch: dictionary key missing exception
            try {
                $saldo = intval($body_response['nilai_saldo']);
            }
            catch(Exception $e){
                $saldo = -97;
            }
            
            // handle negative saldo
            if($saldo == -1){
                // pass negative value
                array_push($sources, array(
                    'saldo' => $saldo, 
                    'ip' => $ip,
                    'message' => 'user not found',
                ));
            }
            else if ($saldo == -98){
                // pass
                array_push($sources, array(
                    'saldo' => $saldo, 
                    'ip' => $ip,
                    'message' => 'json key nilai_saldo missing',
                ));
            }
            else if ($saldo == -97){
                // pass
                array_push($sources, array(
                    'saldo' => $saldo, 
                    'ip' => $ip,
                    'message' => 'request to server error',
                ));
            }
            else if ($saldo < 0){
                // pass
                array_push($sources, array(
                    'saldo' => $saldo, 
                    'ip' => $ip,
                    'message' => 'unknown response',
                    'response' => $body_response,
                ));
            }
            else {
                // add saldo
                $saldo_total += $saldo;
                array_push($sources, array(
                    'saldo' => $saldo, 
                    'ip' => $ip,
                ));
            }
        }

        return array(
            'nilai_saldo' => $saldo_total,
            'sources' => $sources,
        );
    }

    /**
     * /transfer (sesuai SOAL)
     */
    public function transfer_receiver(Request $request)
    {
        // cek quorum
        $quorum_data = EWalletHelper::quorum_check();
        $quorum_count = $quorum_data['quorum'];
        if($quorum_count < 5){
            return array(
                'message' => 'quorum tidak terpenuhi',
                'quorum_status' => -1,
                'quorum_data' => $quorum_data,
            );
        }

        $user_id_destination = $request->input('user_id');
        $nilai = $request->input('nilai');

        $user = EWallet::where('user_id', '=', $user_id_destination)->first();
        $status_transfer = null;

        // check if user exist
        if($user == null){
            // user not found
            $status_transfer = -1;
        }
        else { // user exist
            $user->saldo += $nilai;
            $user->save();

            $status_transfer = 0;
        }

        return array(
            'status_transfer' => $status_transfer,
        );
    }

    /**
     * health check
     */
    public function health_check(Request $request)
    {
        $ips = [
            'http://192.168.75.96', // saga
            'http://192.168.75.97', // halim
            'http://192.168.75.99', // wijaya
            'http://192.168.75.104', // gylberth
            'http://192.168.75.95', // joseph
            'http://192.168.75.76', // raditya
            'http://192.168.75.85', // wicaksono
            'http://192.168.75.71', // nindyatama
        ];
        $success = [];
        $failure = [];

        $guzzle_client = new GuzzleClient();
        foreach ($ips as $ip){
            $url = $ip . '/ewallet/ping';
            // catch: connection and parsing exception
            try {
                $call_response = $guzzle_client->request('POST', $url, [
                    // 'form_params' => [],
                    // 'headers' => [],
                    // 'form_params' => [],
                    'verify' => false,
                ]);
                $body_response = json_decode($call_response->getBody()->getContents(), true);
            }
            catch(Exception $e){
                $body_response = [];
            }

            // catch: dictionary key missing exception
            try {
                $pong = $body_response['pong'];
                if($pong == 1){
                    array_push($success, $ip);
                }
                else {
                    array_push($failure, $ip);
                }
            }
            catch(Exception $e){
                array_push($failure, $ip);
            }
        }

        return array(
            'healthy' => $success,
            'unhealthy' => $failure,
        );
    }

    /**
     * quorum
     */
    public function quorum(Request $request)
    {
        $ips = [
            'http://192.168.75.96', // saga
            'http://192.168.75.97', // halim
            'http://192.168.75.99', // wijaya
            'http://192.168.75.104', // gylberth
            'http://192.168.75.95', // joseph
            'http://192.168.75.76', // raditya
            'http://192.168.75.85', // wicaksono
            'http://192.168.75.71', // nindyatama
        ];
        $success = [];
        $failure = [];

        $guzzle_client = new GuzzleClient();
        foreach ($ips as $ip){
            $url = $ip . '/ewallet/ping';
            // catch: connection and parsing exception
            try {
                $call_response = $guzzle_client->request('POST', $url, [
                    // 'form_params' => [],
                    // 'headers' => [],
                    // 'form_params' => [],
                    'verify' => false,
                ]);
                $body_response = json_decode($call_response->getBody()->getContents(), true);
            }
            catch(Exception $e){
                $body_response = [];
            }

            // catch: dictionary key missing exception
            try {
                $pong = $body_response['pong'];
                if($pong == 1){
                    array_push($success, $ip);
                }
                else {
                    array_push($failure, $ip);
                    // array_push($failure, $url);
                    // array_push($failure, $body_response);
                }
            }
            catch(Exception $e){
                array_push($failure, $ip);
                // array_push($failure, $url);
                // array_push($failure, $body_response);
            }
        }

        $total_count = sizeof($ips);
        $success_count = sizeof($success);
        $failure_count = sizeof($failure);

        return array(
            'quorum' => $success_count,
            'percentage' => $success_count / (float) $total_count * 100,
            'success' => $success,
            'failure' => $failure,
        );
    }

    /* UI */

    /**
     * UI transfer form render
     */
    public function transfer_ui(Request $request)
    {
        return View::make('ewallet.transfer_form');
    }

    /**
     * UI transfer form receiver
     */
    public function transfer_caller(Request $request)
    {
        $user_id = $request->input('user_id');
        $nilai = $request->input('nilai');
        $ip_tujuan = $request->input('ip_tujuan');
        $guzzle_client = new GuzzleClient();

        $user = EWallet::where('user_id', '=', $user_id)->first();
        $status_transfer = null;
        // check if user exist
        if($user == null){
            // 
            $status_transfer = -1;
        }
        else { // user exist
            if($user->saldo < $nilai){
                // saldo kurang
                return "saldo kurang";
            }
            else { // saldo cukup untuk dikurangi
                // panggil target: cek keberadaaan user_id via getSaldo
                $url = 'https://' . $ip_tujuan . '/ewallet/getSaldo';

                // catch: connection and parsing exception
                try {
                    $call_response = $guzzle_client->request('POST', $url, [
                        'form_params' => array(
                            'user_id' => $user_id,
                            // 'nilai' => $nilai,
                        ),
                        'verify' => false,
                    ]);
                    $body_response = json_decode(
                        $call_response->getBody()->getContents(), 
                        true
                    );
                }
                catch (Exception $e){
                    return array(
                        'message' => '[1]:connection and parsing error',
                        'exception' => $e->getMessage(),
                    );
                }
                
                // catch: dictionary key missing exception
                try {
                    $response_nilai_saldo = $body_response['nilai_saldo'];
                }
                catch (Exception $e){
                    return array(
                        'message' => '[2]:dictionary key missing exception',
                        'exception' => $e->getMessage(),
                    );
                }
                
                if($response_nilai_saldo == -1){
                    // user not found
                    // call register on target
                    $register_url = 'https://' . $ip_tujuan . '/ewallet/register';

                    // catch: connection and parsing exception on registering
                    try {
                        $register_response = $guzzle_client->request('POST', $register_url, [
                            'form_params' => array(
                                'user_id' => $user_id,
                                'nama' => $user->nama,
                                'ip_domisili' => $user->ip_domisili,
                            ),
                            'verify' => false,
                        ]);
                        $register_body = json_decode(
                            $register_response->getBody()->getContents(), 
                            true
                        );
                    }
                    catch (Exception $e){
                        return array(
                            'message' => '[3]:dictionary key missing exception on registering',
                            'exception' => $e->getMessage(),
                        );
                    }

                    // recall transfer
                    $transfer_url = 'https://' . $ip_tujuan . '/ewallet/transfer';

                    // catch: connection and parsing exception on retransfer
                    try {
                        $transfer_response = $guzzle_client->request('POST', $register_url, [
                            'form_params' => array(
                                'user_id' => $user_id,
                                'nilai' => $nilai,
                            ),
                            'verify' => false,
                        ]);
                        $transfer_body = json_decode(
                            $transfer_response->getBody()->getContents(), 
                            true
                        );
                    }
                    catch (Exception $e){
                        return array(
                            'message' => '[4]:dictionary key missing exception on retransfer',
                            'exception' => $e->getMessage(),
                        );
                    }
                    

                    if($transfer_body['status_transfer'] == -1){
                        // fail on target server after register
                        return array(
                            'message' => '[5]:transfer fail after register',
                            'register_response' => $register_body,
                            'transfer_response' => $transfer_body,
                        );
                    }
                    else if ($transfer_body['status_transfer'] == 0){
                        // success on target server after register
                        $user->saldo -= $nilai;
                        $user->save();
                        return array(
                            'message' => '[6]:transfer success after register',
                            'register_response' => $register_body,
                            'transfer_response' => $transfer_body,
                        );
                    }
                }
                else if($response_nilai_saldo < 0){
                    // unknown status
                    return array(
                        'message' => 'unknown status',
                        'response' => $body_response,
                    );
                }
                else {
                    // success on target server without register
                    $user->saldo -= $nilai;
                    $user->save();
                    return array(
                        'message' => 'transfer success',
                    );
                }
            }
        }
    }

    /**
     * UI total saldo form render
     */
    public function total_saldo_ui(Request $request)
    {
        return View::make('ewallet.total_saldo_form');
    }

    /**
     * UI total saldo form render
     */
    public function total_saldo_caller(Request $request)
    {
        $user_id = $request->input('user_id');

        $guzzle_client = new GuzzleClient();
        // panggil target: cek keberadaaan user_id via getSaldo
        $url = 'https://' . 'saga.sisdis.ui.ac.id' . '/ewallet/getTotalSaldo';

        // catch: connection and parsing exception
        try {
            $call_response = $guzzle_client->request('POST', $url, [
                'form_params' => array(
                    'user_id' => $user_id,
                ),
                'verify' => false,
            ]);
            $body_response = json_decode(
                $call_response->getBody()->getContents(), 
                true
            );
        }
        catch (Exception $e){
            return array(
                'message' => '[1]:connection and parsing error',
                'exception' => $e->getMessage(),
            );
        }
        
        // catch: dictionary key missing exception
        // try {
        //     $response_nilai_saldo = $body_response['nilai_saldo'];
        // }
        // catch (Exception $e){
        //     return array(
        //         'message' => '[2]:dictionary key missing exception',
        //         'exception' => $e->getMessage(),
        //         'response' => $body_response,
        //     );
        // }

        return $body_response;
    }
}
