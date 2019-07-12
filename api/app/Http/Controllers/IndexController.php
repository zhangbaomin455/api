<?php

namespace App\Http\Controllers;

use app\Tools\jwtAuto;
use Illuminate\Http\Request;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        echo $_SERVER["HTTP_REFERER"];exit;
        dd($_SERVER['SERVER_SOFTWARE']);
      $res= $_SERVER['SERVER_NAME'] == "www.1811blog.com" ? 123 :  1234;


      echo $res;exit;
        $token =jwtAuto::instantf()->setid(1)->encode()->GetToken();
//        echo jwtAuto::instantf()->setToken($token)->decode();exit;
//        return view('index');
        $time = time();
        $signer=new Sha256();
        $token = (new Builder())->issuedBy('http://example.com') // Configures the issuer (iss claim)
        ->permittedFor('http://example.org') // Configures the audience (aud claim)
        ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
        ->issuedAt($time) // Configures the time that the token was issue (iat claim)
        ->canOnlyBeUsedAfter($time + 60) // Configures the time that the token can be used (nbf claim)
        ->expiresAt(120) // Configures the expiration time of the token (exp claim)
        ->withClaim('uid', 1) // Configures a new claim, called "uid"
        ->getToken($signer,new Key('xiaochuang')); // Retrieves the generated token
        echo $token;
//

    }

    public function checktoken()
    {
        $token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLmNvbSIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUub3JnIiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE1NjIzOTY1MzUsIm5iZiI6MTU2MjM5NjU5NSwiZXhwIjoxMjAsInVpZCI6MX0.fVbvo7bf5aVQXb3x8W6IpuQrD49nc3pE7IMMQw6_awU";
        $signer=new Sha256();
        $token = (new Parser())->parse((string) $token); // Parses from a string
        var_dump($token->verify($signer,'xiaochuang'));

    }

    public function read()
    {
        return view('read');
    }
}
