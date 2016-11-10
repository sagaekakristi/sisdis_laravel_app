<?php

namespace App\Helpers;

// others
use GuzzleHttp\Client as GuzzleClient;
use Exception;

class EWalletHelper {
	public static function quorum_check(){
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

    public static function front_ip_to_domain($params)
    {
        $ip_domisili = $params['ip_domisili'];
        $domain_domisili = null;
        $domain_dict = array(
            '152.118.33.96' => 'saga.sisdis.ui.ac.id',
            '152.118.33.97' => 'halim.sisdis.ui.ac.id',
            '152.118.33.99' => 'wijaya.sisdis.ui.ac.id',
            '152.118.33.104' => 'gylberth.sisdis.ui.ac.id',
            '152.118.33.95' => 'joseph.sisdis.ui.ac.id',
            '152.118.33.76' => 'raditya.sisdis.ui.ac.id',
            '152.118.33.85' => 'wicaksono.sisdis.ui.ac.id',
            '152.118.33.71' => 'nindyatama.sisdis.ui.ac.id',
        );

        try {
            $domain_domisili = $domain_dict['ip_domisili'];
        }
        catch(Exception $exception){
            // front ip key not found -> back to front ip
            $domain_domisili = $ip_domisili;
        }

        return $domain_domisili;
    }
}