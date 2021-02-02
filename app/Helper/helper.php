<?php

function returnCaptibiliy($array)
{

    if (!$array) return;
    $array = unserialize($array);
    if (!$array) return;
    $string_array = implode(', ', $array);
    return $string_array;
}

function arrayToList($array, $key, $val)
{
    if (empty($array) OR count($array) == 0)
        return;
    foreach ($array as $a) {
        $result[$a[$key]] = $a[$val];
    }
    return $result;
}

function checkedInArray($value, $array, $serialize = false)
{
    if ($serialize == true) $array = unserialize($array);
    if (!empty($array) and in_array($value, $array))
        echo 'checked="checked"';
}

function checkedInObject($value, $key, $object)
{
    if ((is_array($object) || is_object($object)) && count($object) > 0) {
        foreach ($object as $obj) {
            if ($obj->$key == $value) {
                echo 'checked="checked"';
                return;
            }
        }
    } else {
        return null;
    }
}

function checkedIn($value, $key)
{
    if ($value = $key)
        echo 'checked="checked"';
}

function get_option($option, $default = null)
{
    $cacheKey = 'get.' . $option;
    $result = cache()->remember($cacheKey, 24 * 60 * 60, function () use ($option) {
        return \App\Models\Option::where('option', $option)->value('value');
    });
    if ($result) {
        return $result;
    }

    return $default;
}

function getTemplate()
{
    $template = cache()->remember('view.template', 7 * 24 * 60 * 60, function () {
        return \App\Models\ViewTemplate::where('status', true)->first();
    });
    if (!empty($template) and $template->count() > 0) {
        return 'web.' . $template->folder;
    }
    return 'web.default';
}

function del_option($option)
{
    \App\Models\Option::where('option', $option)->delete();
}

function set_option($option, $value, $mode = 'normal')
{
    \App\Models\Option::updateOrCreate(
        ['option' => $option],
        ['value' => $value, 'mode' => $mode]
    );
}

function currency()
{
    return get_option('currency', 'USD');
}

function currencySign()
{
    switch (get_option('currency')) {
        case 'USD':
            return '$';
            break;
        case 'EUR':
            return '€';
            break;
        case 'JPY':
        case 'CNY':
            return '¥';
            break;
        case 'AED':
            return 'د.إ';
            break;
        case 'SAR':
            return 'ر.س';
            break;
        case 'KRW':
            return '₩';
            break;
        case 'INR':
            return '₹';
            break;
        case 'RUB':
            return '₽';
            break;
        case 'Lek':
            return 'Lek';
            break;
        case 'AFN':
            return '؋';
            break;
        case 'ARS':
            return '$';
            break;
        case 'AWG':
            return 'ƒ';
            break;
        case 'AUD':
            return '$';
            break;
        case 'AZN':
            return '₼';
            break;
        case 'BSD':
            return '$';
            break;
        case 'BBD':
            return '$';
            break;
        case 'BYN':
            return 'Br';
            break;
        case 'BZD':
            return 'BZ$';
            break;
        case 'BMD':
            return '$';
            break;
        case 'BOB':
            return '$b';
            break;
        case 'BAM':
            return 'KM';
            break;
        case 'BWP':
            return 'P';
            break;
        case 'BGN':
            return 'лв';
            break;
        case 'BRL':
            return 'R$';
            break;
        case 'BND':
            return '$';
            break;
        case 'COP':
            return '$';
            break;
        case 'CRC':
            return '₡';
            break;
        case 'CZK':
            return 'Kč';
            break;
        case 'CUP':
            return '₱';
            break;
        case 'DKK':
            return 'kr';
            break;
        case 'DOP':
            return 'RD$';
            break;
        case 'XCD':
            return '$';
            break;
        case 'EGP':
            return '£';
            break;
        case 'GTQ':
            return 'Q';
            break;
        case 'HKD':
            return '$';
            break;
        case 'HUF':
            return 'Ft';
            break;
        case 'IDR':
            return 'Rp';
            break;
        case 'IRR':
            return '﷼';
            break;
        case 'ILS':
            return '₪';
            break;
        case 'LBP':
            return '£';
            break;
        case 'MYR':
            return 'RM';
            break;
        case 'NGN':
            return '₦';
            break;
        case 'NOK':
            return 'kr';
            break;
        case 'OMR':
            return '﷼';
            break;
        case 'PKR':
            return '₨';
            break;
        case 'PHP':
            return '₱';
            break;
        case 'PLN':
            return 'zł';
            break;
        case 'RON':
            return 'lei';
            break;
        case 'ZAR':
            return 'R';
            break;
        case 'LKR':
            return '₨';
            break;
        case 'SEK':
            return 'kr';
            break;
        case 'CHF':
            return 'CHF';
            break;
        case 'THB':
            return '฿';
            break;
        case 'TRY':
            return '₺';
            break;
        case 'UAH':
            return '₴';
            break;
        case 'GBP':
            return '£';
            break;
        case 'VND':
            return '₫';
            break;
        case 'TWD':
            return 'NT$';
            break;
        case 'UZS':
            return 'лв';
            break;
        default:
            return '$';
    }

    return '$';
}

function get_user_meta($user_id, $meta_key, $default = null)
{
    $cache_key = 'user.' . $user_id . '.meta.' . $meta_key;

    $meta = cache()->remember($cache_key, 24 * 60 * 60, function () use ($user_id, $meta_key) {
        return \App\Models\Usermeta::where('user_id', $user_id)
            ->where('option', $meta_key)
            ->first();
    });
    if ($meta)
        return $meta->value;
    else
        return $default;
}

function all_option($mode = 'object')
{
    $result = \App\Models\Option::lists('value', 'option');

    if ($mode == 'object') {
        return $result;
    } else {
        return $result->toArray();
    }
}

function sendMail(array $request)
{
    $recipent = $request['recipent'];
    $users = \App\User::whereIn('email', $recipent)->get();
    if (!isset($request['title']))
        $request['title'] = '';
    if (!isset($request['content']))
        $request['content'] = '';

    if (isset($request['template'])) {
        $template = cache()->remember('email.template.' . $request['template'], 24 * 60 * 60, function () use ($request) {
            return \App\Models\EmailTemplate::where('id', $request['template'])->first();
        });
        if(isset($template)) {
            $request['message'] = $template->template;
            $request['subject'] = $template->title;
        }
    }

    foreach ($users as $to) {
        if(isset($request['message'])) {
            $request['message'] = str_replace(['[password]','[username]', '[name]', '[email]', '[active]', '[token]', '[n.title]', '[n.content]'], [isset($request['password'])?$request['password']:'',$to->username, $to->name, $to->email, url('/') . '/user/active/' . $to->token, url('/') . '/user/reset/token/' . $to->token, $request['title'], $request['content']], $request['message']);
            Mail::send('email.content', ['content' => $request['message']], function ($mail) use ($to, $request) {
                $mail->to($to->email, $to->name);
                $mail->subject($request['subject']);
                $mail->from(get_option('site_email', 'no-reply@site.com'), get_option('site_title'));
                if (isset($request['attach']) && $request['attach'] != '') {
                    $mail->attach(public_path() . $request['attach']);
                }
            });
        }
    }

    if (count(Mail::failures()) > 0) {
        return false;
    } else {
        return count($users);
    }

}

function expandSidebarMenu($nav = null, $array = null)
{
    $segmentList = request()->segments();
    $segment = $segmentList[1];
    if ($nav == $segment)
        echo 'nav-expanded nav-active';
    else {
        if ($array != null && is_array($array) && in_array($nav, $array))
            return;
        else
            echo 'hidden';
    }
}

function activeSidebarSubmenu($nav = null, $subMenu = null)
{

    if ($nav == null || $subMenu == null)
        return;

    $segmentList = request()->segments();
    $segment_nav = $segmentList[1];
    if (isset($segmentList[2]))
        $segment_submenu = $segmentList[2];

    if ($nav == $segment_nav && $subMenu == $segment_submenu)
        echo 'class="nav-active active"';
    else
        return;
}

function dateToTimestamp($date)
{
    $jdate = new App\Classes\jDateTime;
    $array_expire = explode('/', $date);
    return $time = $jdate->mktime(0, 0, 0, $array_expire[2], $array_expire[1], $array_expire[0]);
}

function contentMenu()
{
    $menus = cache()->remember('menu.parents', 2 * 24 * 60 * 60, function () {
        return \App\Models\ContentCategory::where('parent_id', 0)->get();
    });
    $menus = $menus->toArray();

    foreach ($menus as $index => $menu) {
        $cacheTag = 'menu.' . $menu['id'];
        $submenu = cache()->remember($cacheTag . '.sub', 4 * 24 * 60 * 60, function () use ($menu) {
            return \App\Models\ContentCategory::where('parent_id', $menu['id'])->get();
        });

        if ($submenu)
            $menus[$index]['submenu'] = $submenu->toArray();
    }
    return $menus;
}

function selectMenu()
{
    $menus = cache()->remember('menu.parents', 2 * 24 * 60 * 60, function () {
        return \App\Models\ContentCategory::where('parent_id', 0)->get();
    });
    $menus = $menus->toArray();

    foreach ($menus as $index => $menu) {
        $cacheTag = 'menu.' . $menu['id'];
        $submenu = cache()->remember($cacheTag . '.sub', 4 * 24 * 60 * 60, function () use ($menu) {
            return \App\Models\ContentCategory::where('parent_id', $menu['id'])->get();
        });
        if ($submenu->count() == 0)
            $menus[$index]['submenu'] = [$menu];
        else
            $menus[$index]['submenu'] = $submenu->toArray();
    }
    return $menus;
}

function findKey($array, $key, $keySearch)
{
    foreach ($array as $item) {
        if ($item[$key] == $keySearch) {
            return true;
        }
    }
    return false;
}

function num2str($money)
{
    return $money;
}

function checkboxValue($checkbox, $value, $defaultvalue)
{
    if (isset($checkbox) && $checkbox == $value)
        return $value;
    else
        return $defaultvalue;
}

function notify($msg, $type)
{
    \Illuminate\Support\Facades\Session::flash('msg', $msg);
    \Illuminate\Support\Facades\Session::flash('type', $type);
}

function convertToHoursMins($time, $format = '%02d:%02d')
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

function getRate($user)
{
    $result = [];
    $rates = \App\Models\UserRate::all();
    $_user = \App\User::where('id', $user['id'])
        ->withCount(['contents' => function ($query) {
            $query->where('mode', 'publish');
        }, 'sells', 'buys'])->with('point')->first();

    $p = [];
    if(isset($_user->point)) {
        foreach ($_user->point as $point) {
            $post_count = 0;
            $post_rate = 0;
            if ($point->mode == 'post') {
                $post_count++;
                $post_rate += $point->rate;
                $p['post_avg'] = $post_rate / $post_count;
            }
            $content_count = 0;
            $content_rate = 0;
            if ($point->mode == 'content') {
                $content_count++;
                $content_rate += $point->rate;
                $p['content_avg'] = $content_rate / $content_count;
            }
            $support_count = 0;
            $support_rate = 0;
            if ($point->mode == 'support') {
                $support_count++;
                $support_rate += $point->rate;
                $p['support_avg'] = $support_rate / $support_count;
            }
        }
    }

    foreach ($rates as $rate) {
        $avg = explode(',', $rate->value);
        if ($rate->mode == 'videocount' and $avg[0] <= $_user->contents_count and $_user->contents_count <= $avg[1]) {
            $result [] = $rate->toArray();
        }
        if ($rate->mode == 'sellcount' and $avg[0] <= $_user->sells_count and $_user->sells_count <= $avg[1]) {
            $result [] = $rate->toArray();
        }
        if ($rate->mode == 'buycount' and $avg[0] <= $_user->buys_count and $_user->buys_count <= $avg[1]) {
            $result [] = $rate->toArray();
        }
        if ($rate->mode == 'day' and $avg[0] <= ((time() - $_user->created_at) / 86400) and ((time() - $_user->created_at) / 86400) <= $avg[1]) {
            $result [] = $rate->toArray();
        }
        if (isset($p['content_avg']) and $rate->mode == 'productrate' and $avg[0] <= $p['content_avg'] and $p['content_avg'] <= $avg[1]) {
            $result [] = $rate->toArray();
        }
        if (isset($p['support_avg']) and $rate->mode == 'supportrate' and $avg[0] <= $p['support_avg'] and $p['support_avg'] <= $avg[1]) {
            $result [] = $rate->toArray();
        }
        if (isset($p['post_avg']) and $rate->mode == 'postrate' and $avg[0] <= $p['post_avg'] and $p['post_avg'] <= $avg[1]) {
            $result [] = $rate->toArray();
        }
    }

    ## For Custom Badge Relation ##
    $UserRateRelation = \App\Models\UserRateRelation::where('user_id',$user['id'])->get();
    foreach ($UserRateRelation as $URR){
        $result[] = \App\Models\UserRate::find($URR->rate_id)->toArray();
    }

    return $result;
}

function getRateById($userId)
{
    $result = [];
    $rates = \App\Models\UserRate::all();

    $_user = \App\User::where('id', $userId)
        ->withCount(['contents' => function ($query) {
            $query->where('mode', 'publish');
        }, 'sells', 'buys'])->with('point')->first();

    $p = [];
    foreach ($_user->point as $point) {
        $post_count = 0;
        $post_rate = 0;
        if ($point->mode == 'post') {
            $post_count++;
            $post_rate += $point->rate;
            $p['post_avg'] = $post_rate / $post_count;
        }
        $content_count = 0;
        $content_rate = 0;
        if ($point->mode == 'content') {
            $content_count++;
            $content_rate += $point->rate;
            $p['content_avg'] = $content_rate / $content_count;
        }
        $support_count = 0;
        $support_rate = 0;
        if ($point->mode == 'support') {
            $support_count++;
            $support_rate += $point->rate;
            $p['support_avg'] = $support_rate / $support_count;
        }
    }

    foreach ($rates as $rate) {
        $avg = explode(',', $rate->value);
        if ($rate->mode == 'videocount' && $avg[0] < $_user->contents_count && $_user->contents_count < $avg[1]) {
            $nr = $rate->toArray();
            $nr['title'] = trans('admin.from') . $avg[0] . trans('admin.to') . $avg[1] . trans('admin.courses');
            $result [] = $nr;
        }
        if ($rate->mode == 'sellcount' && $avg[0] < $_user->sells_count && $_user->sells_count < $avg[1]) {
            $nr = $rate->toArray();
            $nr['title'] = trans('admin.from') . $avg[0] . trans('admin.to') . $avg[1] . trans('admin.sales');
            $result [] = $nr;
        }
        if ($rate->mode == 'buycount' && $avg[0] < $_user->buys_count && $_user->buys_count < $avg[1]) {
            $nr = $rate->toArray();
            $nr['title'] = trans('admin.from') . $avg[0] . trans('admin.to') . $avg[1] . trans('admin.purchases');
            $result [] = $nr;
        }
        if ($rate->mode == 'day' && $avg[0] < ((time() - $_user->created_at) / 86400) && ((time() - $_user->created_at) / 86400) < $avg[1]) {
            $nr = $rate->toArray();
            $nr['title'] = trans('admin.from') . $avg[0] . trans('admin.to') . $avg[1] . trans('admin.registration_days');
            $result [] = $nr;
        }
        if (isset($p['content_avg']) && $rate->mode == 'productrate' && $avg[0] < $p['content_avg'] && $p['content_avg'] < $avg[1]) {
            $nr = $rate->toArray();
            $nr['title'] = trans('admin.from') . $avg[0] . trans('admin.to') . $avg[1] . trans('admin.course_rate');
            $result [] = $nr;
        }
        if (isset($p['support_avg']) && $rate->mode == 'supportrate' && $avg[0] < $p['support_avg'] && $p['support_avg'] < $avg[1]) {
            $nr = $rate->toArray();
            $nr['title'] = trans('admin.from') . $avg[0] . trans('admin.to') . $avg[1] . trans('admin.support_rate');
            $result [] = $nr;
        }
        if (isset($p['post_avg']) && $rate->mode == 'postrate' && $avg[0] < $p['post_avg'] && $p['post_avg'] < $avg[1]) {
            $nr = $rate->toArray();
            $nr['title'] = trans('admin.from') . $avg[0] . trans('admin.to') . $avg[1] . trans('admin.physical_sales_rate');
            $result [] = $nr;
        }
    }

    return $result;
}

function groupDay($array, $day = 1)
{
    $fTime = strtotime('-' . $day . ' day');
    $lTime = $fTime + 86400;
    $result = 0;
    foreach ($array as $a) {
        if ($fTime <= $a->created_at && $a->created_at <= $lTime)
            $result++;
    }
    return $result;
}

function random_color()
{
    return rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255);
}

function timeToSecond($time)
{
    $time = $time . ':00';
    $seconds = strtotime("1970-01-01 $time UTC");
    return $seconds;
}

function to_latin_num($string)
{
    return $string;
}

function sendNotification($senderId, $source, $message_id, $recipentType, $recipentList)
{
    $message = \App\Models\NotificationTemplate::find($message_id);

    if (!isset($message))
        return false;

    ## Filters
    $title = str_replace(
        array_keys($source),
        array_values($source),
        $message->title);

    $message = str_replace(
        array_keys($source),
        array_values($source),
        $message->template);

    $notification = \App\Models\Notification::create([
        'user_id' => $senderId,
        'title' => $title,
        'msg' => $message,
        'created_at' => time(),
        'recipent_type' => $recipentType,
        'recipent_list' => $recipentList,
    ]);

    ## Send Email ##
    if ($recipentType == 'user') {
        $userEmail = \App\User::find($recipentList);

        if(isset($userEmail) && isset($userEmail->email)) {
            sendMail([
                'recipent' => [$userEmail->email],
                'template' => get_option('email_notification_template', 0),
                'subject' => $title,
                'title' => $title,
                'content' => $message,
            ]);
        }
    }
    ## End Email Section ##

    if ($notification->id)
        return true;
    else
        return false;
}

function toTimestamp($date)
{
    return strtotime($date) + 12600;
}

function price($content_id, $category_id, $p)
{
    $price['price'] = $p;
    $price['price_txt'] = $p . currencySign();
    $percent = 0;
    if ($p == 0 || !isset($p) || $p == '') {
        $price['price_txt'] = 'free';
    }

    $discountQuery = \App\Models\DiscountContent::where('first_date', '<', time())
        ->where('last_date', '>', time())
        ->where('mode', 'publish');
    ## Single Content
    $contentDiscount = $discountQuery->where('type', 'content')
        ->where('off_id', $content_id)
        ->orderBy('id', 'DESC')
        ->first();

    if (isset($contentDiscount)) {
        $percent = $contentDiscount->off;
        $price['price'] = $p - (($contentDiscount->off / 100) * $p);
        $price['price_txt'] = $price['price'] . currencySign();
    }
    ## Category Content
    $categoryDiscount = $discountQuery->where('type', 'category')
        ->where('off_id', $category_id)
        ->orderBy('id', 'DESC')
        ->first();


    if (isset($categoryDiscount) and is_array($categoryDiscount) and count($categoryDiscount) > 0) {
        $percent = $categoryDiscount->off;
        $price['price'] = $p - (($categoryDiscount->off / 100) * $p);
        $price['price_txt'] = $price['price'] . currencySign();
    }
    ## All Content
    $allDiscount = $discountQuery->where('type', 'all')
        ->orderBy('id', 'DESC')
        ->first();

    if (isset($allDiscount) and count($allDiscount) > 0) {
        $percent = $allDiscount->off;
        $price['price'] = $p - (($allDiscount->off / 100) * $p);
        $price['price_txt'] = $price['price'] . currencySign();
    }
    ## User Group
    $user = (auth()->check()) ? auth()->user() : false;
    if ($user) {
        $userGroup = \App\Models\Usercategories::where('id', $user->category_id)->first();

        if ($userGroup) {
            $percent += $userGroup->off;
            $price['price'] = $p - (($percent / 100) * $p);
            $price['price_txt'] = $price['price'] . currencySign();
        }
    }
    ## No Discount
    return $price;
}

function pricePay($content_id, $category_id, $p)
{
    $price['price'] = $p;
    $price['price_txt'] = $p . currencySign();
    $percent = 0;
    if ($p == 0 || !isset($p) || $p == '') {
        $price['price_txt'] = 'free';
    }
    $discountQuery = \App\Models\DiscountContent::where('first_date', '<', time())
        ->where('last_date', '>', time())
        ->where('mode', 'publish');
    ## Single Content
    $contentDiscount = $discountQuery->where('type', 'content')
        ->where('off_id', $content_id)
        ->orderBy('id', 'DESC')
        ->first();

    ## Single Content

    if (!empty($contentDiscount) and is_array($contentDiscount) and count($contentDiscount) > 0) {
        $percent = $contentDiscount->off;
        $price['price'] = $p - (($contentDiscount->off / 100) * $p);
        $price['price_txt'] = $price['price'] . currencySign();
    }
    ## Category Content
    $categoryDiscount = $discountQuery->where('type', 'category')
        ->where('off_id', $category_id)
        ->orderBy('id', 'DESC')
        ->first();

    if (isset($categoryDiscount) && count($categoryDiscount) > 0) {
        $percent = $categoryDiscount->off;
        $price['price'] = $p - (($categoryDiscount->off / 100) * $p);
        $price['price_txt'] = $price['price'] . currencySign();
    }
    ## All Content
    $allDiscount = $discountQuery->where('type', 'all')
        ->orderBy('id', 'DESC')
        ->first();

    if (isset($allDiscount) && count($allDiscount) > 0) {
        $percent = $allDiscount->off;
        $price['price'] = $p - (($allDiscount->off / 100) * $p);
        $price['price_txt'] = $price['price'] . currencySign();
    }
    ## User Group
    $user = (auth()->check()) ? auth()->user() : false;
    if ($user) {
        $userGroup = \App\Models\Usercategories::where('id', $user->category_id)->first();

        if ($userGroup) {
            $percent += $userGroup->off;
            $price['price'] = $p - (($percent / 100) * $p);
            $price['price_txt'] = $price['price'] . currencySign();
        }
    }
    ## Gift && Off
    if (session('gift') != '') {
        $gift = \App\Models\Discount::where('id', session('gift'))
            ->where('created_at', '<', time())
            ->where('expire_at', '>', time())
            ->first();

        if ($gift->type == 'gift') {
            $price['price'] = $price['price'] - $gift->off;
            $price['price_txt'] = $price['price'] . currencySign();
        } else {
            $price['price'] = $price['price'] - intval(($gift->off / 100) * $price['price']);
            $price['price_txt'] = $price['price'] . currencySign();
        }
        session()->forget('gift');
    }


    ## No Discount
    return $price;
}

function contentMeta($content_id, $meta_key, $default = "")
{

    $value = \App\Models\ContentMeta::where('content_id', $content_id)
        ->where('option', $meta_key)
        ->take(1)
        ->value('value');

    if ($value == null)
        return $default;
    else
        return $value;
}

function userMeta($user_id, $meta_key, $default = "")
{
    $value = \App\Models\Usermeta::where('user_id', $user_id)
        ->where('option', $meta_key)
        ->take(1)
        ->value('value');

    if ($value == null)
        return $default;
    else
        return $value;
}

function setUserMeta($user_id, $meta_key, $meta_value)
{
    \App\Models\Usermeta::updateOrCreate(
        ['option' => $meta_key, 'user_id' => $user_id],
        ['value' => $meta_value]
    );

    cache()->forget('user.' . $user_id . '.meta.' . $meta_key);
    cache()->forget('user.' . $user_id);
    cache()->forget('user.' . $user_id . '.meta');
    cache()->forget('user.' . $user_id . '.metas.pluck.value');
}

function listByKey($array = null, $key = null)
{
    $list = [];
    foreach ($array as $index => $arr) {
        $id = $arr[$key];
        if (!array_key_exists($id, $list))
            $list[$id][] = $arr;
        else
            $list[$id]['child'][] = $arr;
    }
    foreach ($list as $index => $li) {
        if (count($li) == 0)
            unset($list[$index]);
    }
    return $list;
}

function userAddress($userId)
{
    if (userMeta($userId, 'address', '') == '') {
        return '<b style="color: red">Your address not found!</b>';
    }
    return userMeta($userId, 'state', trans('admin.not_defined')) . ' - ' . userMeta($userId, 'city', trans('admin.not_defined')) . ' - ' . userMeta($userId, 'address', trans('admin.not_defined')) . ' - Zip Code ' . userMeta($userId, 'postalcode', trans('admin.not_defined'));
}

function getNotification($user_id, $type, $notification_id = null)
{
    if ($notification_id == null) {
        $notification = 0;
        if ($type == 'ticket') {
            $Tickets = \App\Models\Tickets::select('id')
                ->where('user_id', $user_id)
                ->get();

            $Messages = \App\Models\TicketsMsg::whereIn('ticket_id', $Tickets->toArray())
                ->where('user_id', '<>', $user_id)
                ->get();

            foreach ($Messages as $message) {
                $view = \App\Models\View::where('user_id', $user_id)
                    ->where('notification_id', $message->id)
                    ->where('type', 'ticket')
                    ->count();

                if ($view == 0)
                    $notification++;
            }
        }
        if ($type == 'notification') {
            $Notifications = \App\Models\Notification::where('recipent_list', $user_id)->get();

            foreach ($Notifications as $notify) {
                $view = \App\Models\View::where('user_id', $user_id)
                    ->where('notification_id', $notify->id)
                    ->where('type', 'notification')
                    ->count();

                if ($view == 0)
                    $notification++;
            }
        }
        if ($type == 'comment') {
            $content = \App\Models\Content::where('user_id', $user_id)
                ->where('mode', 'publish')
                ->pluck('id');

            $comments = \App\Models\ContentComment::whereIn('content_id', $content)->get();

            foreach ($comments as $comment) {
                $view = \App\Models\View::where('user_id', $user_id)
                    ->where('notification_id', $comment->id)
                    ->where('type', 'comment')
                    ->count();
                if ($view == 0)
                    $notification++;
            }
        }
        if ($type == 'sell_all') {
            $sell_all = \App\Models\Sell::where('user_id', $user_id)->get();

            foreach ($sell_all as $sell) {
                $view = \App\Models\View::where('user_id', $user_id)
                    ->where('notification_id', $sell->id)
                    ->where('type', 'sell')
                    ->count();

                if ($view == 0)
                    $notification++;
            }
        }
        if ($type == 'sell_post') {
            $sell_all = \App\Models\Sell::where('user_id', $user_id)
                ->where('type', 'post')
                ->get();

            foreach ($sell_all as $sell) {
                $view = \App\Models\View::where('user_id', $user_id)
                    ->where('notification_id', $sell->id)
                    ->where('type', 'sell')
                    ->count();

                if ($view == 0)
                    $notification++;
            }
        }
        if ($type == 'sell_download') {
            $sell_all = \App\Models\Sell::where('user_id', $user_id)
                ->where('type', 'download')
                ->get();

            foreach ($sell_all as $sell) {
                $view = \App\Models\View::where('user_id', $user_id)
                    ->where('notification_id', $sell->id)
                    ->where('type', 'sell')
                    ->count();

                if ($view == 0)
                    $notification++;
            }
        }
        return $notification;
    } else {

        $View = \App\Models\View::where('type', $type)
            ->where('user_id', $user_id)
            ->where('notification_id', $notification_id)
            ->count();

        if ($View == 0)
            return false;
        else
            return true;
    }
}

function setNotification($user_id, $type, $notification_id)
{
    $new = \App\Models\View::updateOrCreate([
        'user_id' => $user_id,
        'type' => $type,
        'notification_id' => $notification_id
    ], [
        'user_id' => $user_id,
        'type' => $type,
        'notification_id' => $notification_id
    ]);
    if ($new)
        return 1;
    else
        return 0;
}

function sendSms($phone, $message)
{
    return true;
}

function checkAccess($key)
{
    global $Access;
    if ($Access == 'all')
        return true;

    if (!isset($Access) || $Access == null)
        return true;
    if (in_array($key, $Access))
        return true;

    return false;
}

function checkSubscribeSell($product)
{
    if (is_numeric($product->price_3) && $product->price_3 > 0)
        return true;
    if (is_numeric($product->price_6) && $product->price_6 > 0)
        return true;
    if (is_numeric($product->price_9) && $product->price_9 > 0)
        return true;
    if (is_numeric($product->price_12) && $product->price_12 > 0)
        return true;

    return false;
}

function productSpendTime($product_id)
{
    $usages = \App\Models\Usage::where('product_id', $product_id)->count();
    return $usages * 5;
}

function productTopViewer($product_id)
{
    $Usages = \App\Models\Usage::where('product_id', $product_id)
        ->select('user_id', DB::raw('count(*) as total'))
        ->groupBy('user_id')
        ->orderBy('total', 'DESC')
        ->first();

    if ($Usages) {
        $user = \App\User::find($Usages->user_id);

        if ($user)
            return $user->username;
    }
    return false;
}

function stripTagsAll($arr = [])
{
    if (!is_array($arr))
        return '';

    $json = strip_tags(json_encode($arr));
    return json_decode($json, true);
}

function checkUrl($url = null)
{
    if ($url == null)
        return null;

    if (strpos($url, 'http') !== false) {
        return $url;
    }

    return url('/') . $url;
}

function getCategoryCount($id)
{
    $count = \App\Models\Content::where('mode', 'publish')
        ->where('category_id', $id)
        ->count();
    return $count;
}

// Truncate a string only at a whitespace
function truncate($text, $length, $withTail = true)
{
    $length = abs((int)$length);
    if (strlen($text) > $length) {
        $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", ($withTail ? '\\1 ...' : '\\1'), $text);
    }
    return ($text);
}

function contentCacheForget($id = null)
{
    cache()->forget('new.content');
    cache()->forget('sellCount.content');
    cache()->forget('popular.content');
    if (!empty($id)) {
        cache()->forget('content.' . $id);
    }
}

function zoomCreateMeeting($userId, $contentId = null, $title = 'live',$duration = 60){
    $jwt  = get_user_meta($userId,'zoom_jwt',null);
    $id   = null;

    if($jwt == null)
        return ['status'=> -2];


    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.zoom.us/v2/users/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $jwt",
            "content-type: application/json"
        ),
    ));


    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if($err){
        return ['status'=> -2];
    }else{
        $response = json_decode($response, true);
        if(isset($response['users'])){
            $id = $response['users'][0]['id'];
        }else{
            return ['status'=> -2];
        }
    }



    $post = [
        'topic'     => $title,
        'duration'  => $duration
    ];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.zoom.us/v2/users/$id/meetings",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $jwt",
            "content-type: application/json"
        ),
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => json_encode($post)
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return ['status'=> -2];
    } else {
        $response = json_decode($response, true);
        if(isset($response['uuid'])){
            return [
                'status'    => 0,
                'start_url' => $response['start_url'],
                'join_url'  => $response['join_url']
            ];
        }
    }

}

function contentDuration($id){
    $parts = \App\Models\ContentPart::where('content_id',$id)->get()->toArray();
    $Duration = 0;

    foreach ($parts as $part) {
        $Duration = $Duration + $part['duration'];
    }

    return convertToHoursMins($Duration,'%01d hour %02d min');
}

function languages(){
    return [
        'ab' => 'Abkhazian',
        'aa' => 'Afar',
        'af' => 'Afrikaans',
        'ak' => 'Akan',
        'sq' => 'Albanian',
        'am' => 'Amharic',
        'ar' => 'Arabic',
        'an' => 'Aragonese',
        'hy' => 'Armenian',
        'as' => 'Assamese',
        'av' => 'Avaric',
        'ae' => 'Avestan',
        'ay' => 'Aymara',
        'az' => 'Azerbaijani',
        'bm' => 'Bambara',
        'ba' => 'Bashkir',
        'eu' => 'Basque',
        'be' => 'Belarusian',
        'bn' => 'Bengali',
        'bh' => 'Bihari languages',
        'bi' => 'Bislama',
        'bs' => 'Bosnian',
        'br' => 'Breton',
        'bg' => 'Bulgarian',
        'my' => 'Burmese',
        'ca' => 'Catalan, Valencian',
        'km' => 'Central Khmer',
        'ch' => 'Chamorro',
        'ce' => 'Chechen',
        'ny' => 'Chichewa, Chewa, Nyanja',
        'zh' => 'Chinese',
        'cu' => 'Church Slavonic, Old Bulgarian, Old Church Slavonic',
        'cv' => 'Chuvash',
        'kw' => 'Cornish',
        'co' => 'Corsican',
        'cr' => 'Cree',
        'hr' => 'Croatian',
        'cs' => 'Czech',
        'da' => 'Danish',
        'dv' => 'Divehi, Dhivehi, Maldivian',
        'nl' => 'Dutch, Flemish',
        'dz' => 'Dzongkha',
        'en' => 'English',
        'eo' => 'Esperanto',
        'et' => 'Estonian',
        'ee' => 'Ewe',
        'fo' => 'Faroese',
        'fj' => 'Fijian',
        'fi' => 'Finnish',
        'fr' => 'French',
        'ff' => 'Fulah',
        'gd' => 'Gaelic, Scottish Gaelic',
        'gl' => 'Galician',
        'lg' => 'Ganda',
        'ka' => 'Georgian',
        'de' => 'German',
        'ki' => 'Gikuyu, Kikuyu',
        'el' => 'Greek (Modern)',
        'kl' => 'Greenlandic, Kalaallisut',
        'gn' => 'Guarani',
        'gu' => 'Gujarati',
        'ht' => 'Haitian, Haitian Creole',
        'ha' => 'Hausa',
        'he' => 'Hebrew',
        'hz' => 'Herero',
        'hi' => 'Hindi',
        'ho' => 'Hiri Motu',
        'hu' => 'Hungarian',
        'is' => 'Icelandic',
        'io' => 'Ido',
        'ig' => 'Igbo',
        'id' => 'Indonesian',
        'ia' => 'Interlingua (International Auxiliary Language Association)',
        'ie' => 'Interlingue',
        'iu' => 'Inuktitut',
        'ik' => 'Inupiaq',
        'ga' => 'Irish',
        'it' => 'Italian',
        'ja' => 'Japanese',
        'jv' => 'Javanese',
        'kn' => 'Kannada',
        'kr' => 'Kanuri',
        'ks' => 'Kashmiri',
        'kk' => 'Kazakh',
        'rw' => 'Kinyarwanda',
        'kv' => 'Komi',
        'kg' => 'Kongo',
        'ko' => 'Korean',
        'kj' => 'Kwanyama, Kuanyama',
        'ku' => 'Kurdish',
        'ky' => 'Kyrgyz',
        'lo' => 'Lao',
        'la' => 'Latin',
        'lv' => 'Latvian',
        'lb' => 'Letzeburgesch, Luxembourgish',
        'li' => 'Limburgish, Limburgan, Limburger',
        'ln' => 'Lingala',
        'lt' => 'Lithuanian',
        'lu' => 'Luba-Katanga',
        'mk' => 'Macedonian',
        'mg' => 'Malagasy',
        'ms' => 'Malay',
        'ml' => 'Malayalam',
        'mt' => 'Maltese',
        'gv' => 'Manx',
        'mi' => 'Maori',
        'mr' => 'Marathi',
        'mh' => 'Marshallese',
        'ro' => 'Moldovan, Moldavian, Romanian',
        'mn' => 'Mongolian',
        'na' => 'Nauru',
        'nv' => 'Navajo, Navaho',
        'nd' => 'Northern Ndebele',
        'ng' => 'Ndonga',
        'ne' => 'Nepali',
        'se' => 'Northern Sami',
        'no' => 'Norwegian',
        'nb' => 'Norwegian Bokmål',
        'nn' => 'Norwegian Nynorsk',
        'ii' => 'Nuosu, Sichuan Yi',
        'oc' => 'Occitan (post 1500)',
        'oj' => 'Ojibwa',
        'or' => 'Oriya',
        'om' => 'Oromo',
        'os' => 'Ossetian, Ossetic',
        'pi' => 'Pali',
        'pa' => 'Panjabi, Punjabi',
        'ps' => 'Pashto, Pushto',
        'fa' => 'Persian',
        'pl' => 'Polish',
        'pt' => 'Portuguese',
        'qu' => 'Quechua',
        'rm' => 'Romansh',
        'rn' => 'Rundi',
        'ru' => 'Russian',
        'sm' => 'Samoan',
        'sg' => 'Sango',
        'sa' => 'Sanskrit',
        'sc' => 'Sardinian',
        'sr' => 'Serbian',
        'sn' => 'Shona',
        'sd' => 'Sindhi',
        'si' => 'Sinhala, Sinhalese',
        'sk' => 'Slovak',
        'sl' => 'Slovenian',
        'so' => 'Somali',
        'st' => 'Sotho, Southern',
        'nr' => 'South Ndebele',
        'es' => 'Spanish, Castilian',
        'su' => 'Sundanese',
        'sw' => 'Swahili',
        'ss' => 'Swati',
        'sv' => 'Swedish',
        'tl' => 'Tagalog',
        'ty' => 'Tahitian',
        'tg' => 'Tajik',
        'ta' => 'Tamil',
        'tt' => 'Tatar',
        'te' => 'Telugu',
        'th' => 'Thai',
        'bo' => 'Tibetan',
        'ti' => 'Tigrinya',
        'to' => 'Tonga (Tonga Islands)',
        'ts' => 'Tsonga',
        'tn' => 'Tswana',
        'tr' => 'Turkish',
        'tk' => 'Turkmen',
        'tw' => 'Twi',
        'ug' => 'Uighur, Uyghur',
        'uk' => 'Ukrainian',
        'ur' => 'Urdu',
        'uz' => 'Uzbek',
        've' => 'Venda',
        'vi' => 'Vietnamese',
        'vo' => 'Volap_k',
        'wa' => 'Walloon',
        'cy' => 'Welsh',
        'fy' => 'Western Frisian',
        'wo' => 'Wolof',
        'xh' => 'Xhosa',
        'yi' => 'Yiddish',
        'yo' => 'Yoruba',
        'za' => 'Zhuang, Chuang',
        'zu' => 'Zulu'
    ];
}

function checkQuiz(){
    return true;
}

function notificationStatus($id, $user_id){
    $duplicate = \App\Models\NotificationStatus::where('user_id',$user_id)->where('notification_id', $id)->count();
    if($duplicate > 0)
        return;

    \App\Models\NotificationStatus::create(['notification_id'=>$id,'user_id'=>$user_id]);
}

