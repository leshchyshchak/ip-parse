<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserIpParseController extends Controller
{
    public function parseData()
    {

        $user_ips = Auth::user()->ipLists; // getting user ips


        foreach ($user_ips as $ip) {

            $url = $ip->ip . ".ip-adress.com"; // forming url

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
            curl_setopt($ch, CURLOPT_URL, urlencode($url));
            $response = curl_exec($ch);
            curl_close($ch);


            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($response);
            libxml_use_internal_errors(false);


//            $headers = $dom->getElementsByTagName('th'); // getting headers
            $rows = $dom->getElementsByTagName('td'); // getting rows

//        foreach($headers as $nodeHeader)
//        {
//            $dataHeader[] = trim($nodeHeader->textContent); // headers (just in case)
//        }
            $dataRow = Array(); // result array

            foreach ($rows as $nodeRow) {
                $dataRow[] = trim($nodeRow->textContent); // getting rows content
            }


            Auth::user()->createParsedData($dataRow, $ip->id); // creating data for IPS
        }

        return back()->with('status', 'Work is done.');
    }
}
