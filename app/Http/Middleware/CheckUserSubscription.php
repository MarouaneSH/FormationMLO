<?php

namespace App\Http\Middleware;

use Closure;
use View;
use Auth;
use App\User;
use App\Messages_user;

class CheckUserSubscription
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
        $user = Auth::user();
        //Passing Data to all view for Count of Message unread 
        View::share('message_unread', count($user->Messages_user->where('read',"0")));
        View::share('message_nameSender',$user->Messages_user->where('read',"0")->sortByDesc('id')->values()->take(5));
        if(!Auth::user()->subscribed)
        {
            View::share('subscribed' , false);
        }
        else
        {
            $date_subscription =Auth::user()->date_subscription;
            $date_fin_subscription = Auth::user()->date_fin_subscription;
            View::share([
                'subscribed' => true,
                "date_subscription"=>$date_subscription,
                "date_fin_subscription"=>$date_fin_subscription
            ]);
        }
        
    
        return $next($request);
    }
}
