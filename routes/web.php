<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'users'], function() {
    // Rutas de los controladores dentro del Namespace "App\Http\Controllers\Admin"
    Route::get('/', "HyperWallerController@listUsers");

});


Route::get('test', function(){

    $hyperwallet = new \Hyperwallet\Hyperwallet( "restapiuser@22067451611", "ydsRK9grZi9M");
    //$hyperwallet = new \Hyperwallet\Hyperwallet("restapiuser@22067451611", "ydsRK9grZi9M!", "prg-56cefbbb-f05e-492c-81ed-71a477290433", "https://api.sandbox.hyperwallet.com");
/*
 // 1.- Create User
    $response = $hyperwallet->createUser((new \Hyperwallet\Model\User())
        ->setAddressLine1("575 Market Street")
        ->setCity("San Francisco")
        ->setClientUserId("CSK7b8Ffch")
        ->setCountry("US")
        //->setDateOfBirth("1991-01-01")
        ->setEmail("user+4satF1xV@hyperwallet.com")
        ->setFirstName("Some")
        ->setLastName("Guy")
        ->setPostalCode("94105")
        ->setProfileType("INDIVIDUAL")
        ->setProgramToken("prg-56cefbbb-f05e-492c-81ed-71a477290433")
        ->setStateProvince("CA")
    );
*/

    //2.- List Users
    //$listUsers = $hyperwallet->listUsers();
    //dd($listUsers);

    //3.-Create a payment
    /*
    $response = $hyperwallet->createBankAccount("usr-50fd6c94-2d37-447f-8d51-d01af6e05615", (new \Hyperwallet\Model\BankAccount())
        ->setBankAccountId("675825206")
        ->setBankAccountPurpose("CHECKING")
        ->setBankAccountRelationship("SELF")
        ->setBranchId("026009593")

        ->setTransferMethodCountry("US")
        ->setTransferMethodCurrency("USD")
        ->setType("BANK_ACCOUNT")
    );
    return response()->json($response);
    */

    //4.- List payment methods
    //$response = $hyperwallet->listBankAccounts("usr-50fd6c94-2d37-447f-8d51-d01af6e05615");
    //dd($response);

    //5.- Emitir un pago
    $response = $hyperwallet->createPayment((new \Hyperwallet\Model\Payment())
        ->setAmount("20.00")
        ->setClientPaymentId("DyClk0VG")
        ->setCurrency("USD")
        ->setDestinationToken("usr-50fd6c94-2d37-447f-8d51-d01af6e05615")
        ->setProgramToken("prg-56cefbbb-f05e-492c-81ed-71a477290433")
        ->setPurpose("OTHER")
    );

    try {


    } catch (\Hyperwallet\Exception\HyperwalletException $e) {
        foreach ($e->getErrorResponse()->getErrors() as $error) {
            echo "\n------\n";
            echo $error->getFieldName()."\n";
            echo $error->getCode()."\n";
            echo $error->getMessage()."\n";
        }
    }


    /*
      "profileType": "INDIVIDUAL",
      "clientUserId": "t-1563257170009",
      "firstName": "John",
      "lastName": "Developer",
      "email": "t-1563257170009@email.com",
      "dateOfBirth": "1991-02-15",
      "addressLine1": "575 Market St",
      "city": "San Francisco",
      "country": "US",
      "stateProvince": "CA",
      "postalCode": "94105",
      "programToken": "prg-56cefbbb-f05e-492c-81ed-71a477290433"

     */
});
