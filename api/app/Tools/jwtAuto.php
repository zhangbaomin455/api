<?php
namespace app\Tools;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
class jwtAuto
{
     private static $jwt;

     private $stalt="xixiaochuang";

     private $iss='http://www.1811blog.com';

     private $aud='http://www.1811blogs.com';

     public $token;

     private $tokens;

     private $id;

     private $decodetoken;

     private function __construct()
     {

     }

     private function __clone()
     {
         // TODO: Implement __clone() method.
     }

     public static function instantf(){
         if(!self::$jwt instanceof self){
             self::$jwt=new self;
         }
         return self::$jwt;
     }

     public function setid($id)
     {
         $this->id=$id;
         return $this;
     }

     public function encode()
     {
//       $id=$request->id ?? 1;
         $time=time();
         $this->token=(new Builder())
           ->setIssuer($this->iss)
           ->setAudience($this->aud)
           ->setIssuedAt($time)
           ->setExpiration($time+3600)
           ->withClaim('uid',$this->id)
//             ->identifiedBy()
           ->sign(new Sha256(),$this->stalt)
           ->getToken();
         return $this;

     }

    public function GetToken()
    {
        return $this->token;
     }

    public function setToken($token)
    {
        $this->tokens=$token;
        return $this;
     }

    public function validate()
    {
        $dataWithLeeway = new ValidationData();
        $dataWithLeeway->setIssuer($this->iss);
        $dataWithLeeway->setAudience($this->aud);
        return $this->decode()->validate($dataWithLeeway);



     }

     public function verify()
     {

        return $this->decode()->verify(new Sha256(),$this->stalt);

     }

     public  function decode()
     {
         if(!$this->decodetoken){
             $this->decodetoken=(new Parser())->parse((string) $this->tokens);
         }
         return $this->decodetoken;
     }

}