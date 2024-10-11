<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $roles): Response
    {   
        // $user = $request->user(); // ambil data user yang login
        //                         // fungsi user() diambil dari UserModel.php
        // if($user->hasRole($role)){  // cek apakah user punya role yang diinginkan
        $user_role = $request->user()->getRole(); //admnil data_level kode dari user yg login
        if(in_array($user_role, $roles)){  //cek apakah level_kode user ada di dalam user yg login
            return $next($request); //jika ada, maka lanjutkan request
        }

        //jika tidak punya role, maka akan muncul pesan eror 403
        abort(403,'Forbidden. Kamu tidak punya akses ke halaman ini ');
       
    }
}
