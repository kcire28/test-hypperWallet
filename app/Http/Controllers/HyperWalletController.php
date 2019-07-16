<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Repositories\HyperWallet;


class HyperWalletController
{

    protected $hyperwalletRepository = null;

    /**
     * HyperWallerController constructor.
     */
    public function __construct(HyperWallet\HyperWalletRepository $hyperwalletRepository)
    {
        $this->hyperwalletRepository = $hyperwalletRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request){

        return $this->hyperwalletRepository->createUser($request);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function  listUsers(){

        return $this->hyperwalletRepository->listUsers();

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createBanckAccount(Request $request){

        return $this->hyperwalletRepository->createBanckAccount($request);
    }

    /**
     * @param $userToken
     * @return \Illuminate\Http\JsonResponse
     */
    public function listPayments($userToken){

        return $this->hyperwalletRepository->listPayments($userToken);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPayment(Request $request){

        return $this->hyperwalletRepository->createPayment($request);
    }
}