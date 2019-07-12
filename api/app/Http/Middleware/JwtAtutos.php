<?php

namespace App\Http\Middleware;

use Closure;
use app\Tools\jwtAuto;

class JwtAtutos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token=$request->token ??  "";
        $jwt=jwtAuto::instantf()->setToken($token);
        try{
            if($token){
                if($jwt->validate() && $jwt->validate()){
                    return $next($request);
                }else{
                    $arr=[
                        'code'=>102,
                        'msg'=>'shi bai',
                        'data'=>""
                    ];
                    echo json_encode($arr);exit;
                }
            }else{
                $arr=[
                    'code'=>101,
                    'msg'=>'can shu qie shi',
                    'data'=>""
                ];
                echo json_encode($arr);exit;
            }
        }catch (\Throwable $exception){
            $arr=[
                'code'=>101,
                'msg'=>'can shu qie shi',
                'data'=>""
            ];
            echo json_encode($arr);exit;
        }


    }
}
