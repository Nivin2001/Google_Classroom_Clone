<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApplyUserPreferences
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supported=['ar','en'];
        $header=$request->header('accept=langusge');
        $locales=explode(',',$header);
        // dd($locales);
        if($locales){
            foreach($locales as $locale)
            {
                if(($i=strpos($locale,';'))!== false){
                    $locale=substr($locale,0,$i);
                }
                if(! in_array($locale,$supported)){
                    break;

                }
            }
        }

            if(! in_array($locale,$supported)){
                $locale=config('app.locale');
            }


        $user = auth()->user();

        if ($user) {
            // Check if the user has a profile and set the locale accordingly
            $locale=$user->profile->locale ?? $locale;

        }
        App::setLocale( $locale);

        return $next($request);
    }
}
