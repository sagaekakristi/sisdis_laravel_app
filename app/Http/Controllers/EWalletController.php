<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// models
use App\Models\EWallet;

class EWalletController extends Controller
{
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
        $user_id = $request->input('user_id');

        $user = EWallet::where('user_id', '=', $user_id)->first();
        $nilai_saldo = null;
        // check if user exist
        if($user == null){
            // pass
        }
        else {
            $nilai_saldo = $user->saldo;
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
        $user_id = $request->input('user_id');

        return array(
            
        );
    }

    /**
     * transfer.
     */
    public function transfer_caller(Request $request)
    {
        $user_id_owner = $request->input('user_id');
        $nilai = $request->input('nilai');

        $user = EWallet::where('user_id', '=', $user_id_owner)->first();
        $status_transfer = null;
        // check if user exist
        if($user == null){
            // 
            $status_transfer = -1;
        }
        else { // user exist
            if($user->saldo < $nilai){
                // saldo kurang
                $status_transfer = -1;
            }
            else { // saldo cukup untuk dikurangi
                // panggil target

                $status_transfer = 0;
            }
        }

        return array(
            'status_transfer' => $status_transfer,
        );
    }

    /**
     * transfer.
     */
    public function transfer_receiver(Request $request)
    {
        $user_id_destination = $request->input('user_id');
        $nilai = $request->input('nilai');

        $user = EWallet::where('user_id', '=', $user_id_destination)->first();
        $status_transfer = null;

        // check if user exist
        if($user == null){
            // 
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
}
