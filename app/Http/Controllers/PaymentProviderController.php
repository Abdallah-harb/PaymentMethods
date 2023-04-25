<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentProviderController extends Controller
{
    public function getcheckoutid(Request $request){

        //api that contained it from hyperpay integration guide
        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
            "&amount=".$request->price .
            "&currency=EUR" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        //get data as json to show it
        $res = json_decode($responseData,true);

      // get checkoutId and return it to form.blade to show the payment form
       $views =  view('ajax.form')->with(['res'=>$res,'id' => $request->offer_id ])->renderSections();

       return response()->json([
           'status' => true,
           'content' => $views['main'] //main name of section on ajax.form
       ]);
    }
}
