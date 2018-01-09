<?php
/**
 * Created by PhpStorm.
 * User: nitbit
 * Date: 3/5/17
 * Time: 3:09 PM
 */

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode as SimpleQrCode;
use Response;

class TestController
{

    public function qrCodeTest($number)
    {
        return response(

            '<img src="data:image/png;base64,' . base64_encode(SimpleQrCode::format('png')->size(200)->generate($number)) . '">'
            .

            '<br/><br/><br/><br/><img src="/qrcode/' . $number . '">'
        );
    }

    public function qrCode($ordernumber)
    {
        $img = SimpleQrCode::format('png')->size(200)->generate($ordernumber);
        $reponse = Response::make($img, 200);
        $reponse->header('Content-Type', 'image/png');
        return $reponse;
    }
}