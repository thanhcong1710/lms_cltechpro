<?php

namespace App\Http\Middleware;

use App\Models\AdsBox;
use App\Models\ChannelRequest;
use App\Models\Content;
use App\Models\ContentComment;
use App\Models\Notification;
use App\Models\Sell;
use App\Models\Social;
use App\Models\Tickets;
use Closure;
use App\User;
use App\Models\Usermeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class NotificationMiddleware
{
    public function handle($request, Closure $next)
    {
        app()->setLocale(get_option('site_language', 'en'));

        if (session()->has('impersonated')) {
            Auth::onceUsingId(session()->get('impersonated'));
        }

        if (auth()->check()) {
            $user = auth()->user();

            $usermeta = cache()->remember('user.' . $user->id . '.meta', 4 * 24 * 60 * 60, function () use ($user) {
                return Usermeta::where('user_id', $user->id)->get();
            });

            $userMeta = arrayToList($usermeta, 'option', 'value');
            view()->share('user', $user);
            view()->share('userMeta', $userMeta);

            if(isset($userMeta['language'])){
                app()->setLocale($userMeta['language']);
            }


            global $alert;
            $alert['notification'] = 0;
            if ($user->last_view == null) {
                $user->last_view = 0;
            }

            $notification =  Notification::where('recipent_list', $user->id)
                    ->with(['status' => function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    }])->get();


            foreach ($notification as $noti) {
                if (empty($noti->status->id))
                    $alert['notification']++;
            }

            $ticket =  Tickets::where('user_id', $user->id)
                    ->where('mode', 'open')
                    ->with('messages')
                    ->whereHas('messages', function ($query) {
                        $query->where('view', '0')->where('mode', '<>', 'user');
                    })->get();

            $alert['ticket'] = count($ticket);

            $contentIds =  Content::where('user_id', $user->id)
                    ->where('mode', 'publish')
                    ->pluck('id');

            $alert['comment'] =  ContentComment::whereIn('content_id', $contentIds)
                    ->where('created_at', '>', $user->last_view)
                    ->count();

            $sellQuery = Sell::where('user_id', $user->id);
            $sell_all =  $sellQuery->count();

            $alert['sell_all'] = $sell_all;

            $Sell_download =  $sellQuery->where('view', 0)
                    ->where('type', 'download')
                    ->get();

            $alert['sell_download'] = count($Sell_download);

            $Sell_post = $sellQuery
                    ->where('view', 0)
                    ->where('type', 'post')
                    ->get();

            $alert['sell_post'] = count($Sell_post);

            $alert['channel_request'] =  ChannelRequest::where('mode', 'draft')->count();


            $alert['all'] = $alert['notification'] + $alert['ticket'] + $alert['comment'] + $alert['sell_download'] + $alert['sell_post'] + $alert['channel_request'];

            view()->share('alert', $alert);
        }

        #### Get Footer Socials ####
        ############################
        $socials = Social::orderBy('sort')->get();
        view()->share('socials', $socials);

        #### Get Site Ads ####
        ######################

        $ads = AdsBox::where('mode', 'publish')->orderBy('sort')->get();
        view()->share('ads', $ads);

        return $next($request);
    }
}
