<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;

class HyperWallerController
{
    protected $hyperwallet = null;

    /**
     * HyperWallerController constructor.
     */
    public function __construct()
    {
        $this->hyperwallet = new \Hyperwallet\Hyperwallet( "restapiuser@22067451611", "ydsRK9grZi9M");
    }

    public function createUser(Request $request){

    }

    public function  listUsers(){
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
            return response()->json($e->getMessage());
        }

    }
}