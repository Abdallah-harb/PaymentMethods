<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Models\Offer;

class OfferController extends Controller
{
    public function index(){

        $offers = Offer::get();



        return view('offers.index',compact('offers'));
    }
    public function show($offer_id){

        $offer = Offer::findOrFail($offer_id);
        //if user come from payment

        if (request('id') && request('resourcePath')){
            $payment_status = $this->getPaymentStatus(request('id'), request('resourcePath'));

            //if it transaction success
            if(isset($payment_status['id'])){
                $showPaymentSuccessMessage = true;
                return view('offers.details',compact('offer'))->with(['success' =>'تم الدفع بنجاح']);
            }else{
                $showPaymentFailMessage =true;
                return view('offers.details',compact('offer')) ->with(['fail' =>'فشلت عمليه الدفع برجاء المحاوله وقت اخر']);
            }
        }
        return view('offers.details',compact('offer'));
    }

    private function getPaymentStatus($id,$resourcePath){

        $url = "https://eu-test.oppwa.com/";
        $url .= $resourcePath;
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        return json_decode($responseData,true);

    }


}
