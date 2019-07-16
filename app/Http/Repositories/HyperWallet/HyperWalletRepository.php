<?php

namespace App\Repositories\HyperWallet;

use Carbon\Carbon;

class HyperWalletRepository
{
    protected $hyperwallet = null;

    /**
     * HyperWallerController constructor.
     */
    public function __construct()
    {
        $this->hyperwallet = new \Hyperwallet\Hyperwallet( env('HYPERWALLET_USER_NAME', 'restapiuser@22067451611'), env('HYPERWALLET_PASSWORD', 'ydsRK9grZi9M'));
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    function createUser($request){

        $dateOfBirth = new Carbon($request->get('dateOfBirth'));

        try{
            $response = $this->hyperwallet->createUser((new \Hyperwallet\Model\User())
                ->setAddressLine1($request->get('address'))
                ->setCity($request->get('city'))
                ->setClientUserId($request->get('clientUserId'))
                ->setCountry($request->get('country'))
                ->setDateOfBirth($dateOfBirth)
                ->setEmail($request->get('email'))
                ->setFirstName($request->get('firstName'))
                ->setLastName($request->get('lastName'))
                ->setPostalCode($request->get('postalCode'))
                ->setProfileType($request->get('profileType'))
                ->setProgramToken(env("HYPERWALLET_TOKEN", "prg-56cefbbb-f05e-492c-81ed-71a477290433"))
                ->setStateProvince($request->get('stateProvince')));

            return response()->json($response->getProperties(), 200);
        }
        catch(\Exception $e){
            if($e->getErrorResponse()){
                $json = array();
                foreach($e->getErrorResponse()->getErrors() as $key => $value) {
                    $json[$key] = [
                        "field" => $value->getFieldName(),
                        "message" => $value->getMessage()
                    ];
                };
                return response()->json(["errors" => $json]);
            }
            return response()->json($e->getMessage(), 400);
        }

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function listUsers(){
        try{
            $response = $this->hyperwallet->listUsers();

            $data =  $response->getData();

            $json = array();
            foreach($data as $key => $value) {
                $json[$key] = $value->getProperties();
            };
            return response()->json($json, 200);
        }
        catch(\Exception $e){
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createBanckAccount($request){

        try {
            $response = $this->hyperwallet->createBankAccount($request->get('userToken'), (new \Hyperwallet\Model\BankAccount())
                ->setBankAccountId($request->get('bankAccountId'))
                ->setBankAccountPurpose($request->get('bankAccountPurpose'))
                ->setBankAccountRelationship($request->get('bankAccountRelationship'))
                ->setBranchId($request->get('setBranchId'))

                //default parameters
                ->setTransferMethodCountry("US")
                ->setTransferMethodCurrency("USD")
                ->setType("BANK_ACCOUNT")
            );
            return response()->json($response->getProperties(), 200);
        }
        catch(\Exception $e){
            if($e->getErrorResponse()){
                $json = array();
                foreach($e->getErrorResponse()->getErrors() as $key => $value) {
                    $json[$key] = [
                        "field" => $value->getFieldName(),
                        "message" => $value->getMessage()
                    ];
                };
                return response()->json(["errors" => $json], 400);
            }
            return response()->json($e->getMessage(), 400);
        }

    }

    /**
     * @param $userToken
     * @return \Illuminate\Http\JsonResponse
     */
    public function listPayments($userToken){
        try {
            $response = $this->hyperwallet->listBankAccounts($userToken);
            $json = array();
            foreach($response->getData() as $key => $value) {
                $json[$key] = $value->getProperties();
            };
            return response()->json($json, 200);
        }
        catch(\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPayment($request){

        try{
            $response = $this->hyperwallet->createPayment((new \Hyperwallet\Model\Payment())
                ->setAmount($request->get('amount'))
                ->setClientPaymentId($request->get('clientPaymentId'))
                ->setCurrency($request->get('currency'))
                ->setDestinationToken($request->get('destinationToken'))
                ->setProgramToken(env("HYPERWALLET_TOKEN", "prg-56cefbbb-f05e-492c-81ed-71a477290433"))
                ->setPurpose("OTHER")
            );

            return response()->json($response->getProperties(), 200);
        }
        catch(\Exception $e) {

            return response()->json(["errors" => $e->getMessage()], 400);
        }
    }

}