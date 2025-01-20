<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\banner_video;
use App\Models\blog;
use App\Models\reviewsection;
use Ixudra\Curl\Facades\Curl;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {

        // banner details
        $banner_video = banner_video::where([
            ['thumbnailtype', '0'],
            ['show', '1'],
        ])->get();

        //  services details
        $services = Service::get();
        $allservices = '';
        $servicedata = [];
        $i = 0;
        $servicecount = count($services);

        foreach ($services as $data) {

            $serviceid = $data->id;
            $servicedata[$serviceid] = $data;
            $i++;
            if ($i === $servicecount) {
                $allservices .= $data->name;
            } else {
                $allservices .= $data->name . ', ';
            }

        }

        // youtube video details
        $youtube_video = banner_video::where([
            ['thumbnailtype', '1'],
            ['show', '1'],
        ])->get();

        // blog details
        $blogs = blog::get();
        $blogitems = [];

        foreach ($blogs as $blogdata) {

            $blogitems[$blogdata->id]['description'] = html_entity_decode($blogdata->description);
            $blogitems[$blogdata->id]['title'] = $blogdata->title;
            $blogitems[$blogdata->id]['nameurl'] = $blogdata->nameurl;
            $blogitems[$blogdata->id]['id'] = $blogdata->id;

            if (!empty($blogdata->image)) {
                $blogitems[$blogdata->id]['image'] = $blogdata->image;
            } else {
                $blogitems[$blogdata->id]['image'] = 'noimage.jpg';
            }
            $createdat = $blogdata->created_at;
            $blogitems[$blogdata->id]['createdat'] = $blogdata->created_at->format('d F, Y');
        }

        $reviews = reviewsection::all();

        //@AchariyaDebdutta
        $url1 = 'https://www.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCqDfG4lWZ5OJgJSc2XK7g4A' . '&key=AIzaSyBUm1uVpuIGK2GudT_jFjagMWqnwZRojNI';
        // echo "The time is " . date("h:i:s A", strtotime("now"));
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        // echo date('H:i:s');

        $response1 = Curl::to($url1)
            ->get();
        //if(){$response}
        $response1 = json_decode($response1);
        //dd($response1->error);

        if (isset($response1->error) && $response1->error) {

            $youtubetitle1 = "Astronama Achariya Debdutta";
            $youtubechanneldatasubscription1 = "176000";
            $youtubecustomUrl1 = "@AstronamaAchariyaDebdutta";
            $youtubedp1 = "https://yt3.googleusercontent.com/t7EdcCiGFiXenJtLe5opcQAVXJjZ86z9-eRNPptoxtbXfK54aK_aerC7ygGnrcbl6W5C0JS5zfM=s160-c-k-c0x00ffffff-no-rj";

        } else {

            $youtubechannelitems1 = $response1->items[0];
            $youtubechanneldata1 = $youtubechannelitems1->snippet;
            $youtubedp1 = $youtubechanneldata1->thumbnails->medium->url;
            $youtubetitle1 = $youtubechanneldata1->title;
            $youtubecustomUrl1 = $youtubechanneldata1->customUrl;
            $youtubechanneldatasubscription1 = $youtubechannelitems1->statistics->subscriberCount;

        }

        //@TheDebduttaShow -
        $url2 = 'https://www.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCE6Wescg35pfTdUmOpJsYsQ' . '&key=AIzaSyBUm1uVpuIGK2GudT_jFjagMWqnwZRojNI';

        $response2 = Curl::to($url2)
            ->get();

        //dd($response);
        $response2 = json_decode($response2);
        if (isset($response2->error) && $response2->error) {

            $youtubetitle2 = "The Debdutta Show";
            $youtubechanneldatasubscription2 = "7640";
            $youtubecustomUrl2 = "@TheDebduttaShow";
            $youtubedp2 = "https://yt3.googleusercontent.com/Khr_9QO7Q7zhiwSesX5O6qEEarOz2eFIJfv_A9n6StY2wyjdLGLHZMWsQjp9EjAbYbW2QT7_qw=s160-c-k-c0x00ffffff-no-rj";

        } else {

            $youtubechannelitems2 = $response2->items[0];
            $youtubechanneldata2 = $youtubechannelitems2->snippet;
            $youtubedp2 = $youtubechanneldata2->thumbnails->medium->url;
            $youtubetitle2 = $youtubechanneldata2->title;
            $youtubecustomUrl2 = $youtubechanneldata2->customUrl;
            $youtubechanneldatasubscription2 = $youtubechannelitems2->statistics->subscriberCount;

        }

        //@AstroAchariya
        $url3 = 'https://www.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCHeZB0rv09RBnEySIfehLOA' . '&key=AIzaSyBUm1uVpuIGK2GudT_jFjagMWqnwZRojNI';

        $response3 = Curl::to($url3)
            ->get();

        $response3 = json_decode($response3);
        if (isset($response3->error) && $response3->error) {

            $youtubetitle3 = "Astro Pandit Devdutt";
            $youtubechanneldatasubscription3 = "1634";
            $youtubecustomUrl3 = "@Astropanditdevdutt";
            $youtubedp3 = "https://yt3.googleusercontent.com/Dp65a3j3JcIVMtWUIj1Ty6j1VIIJtppKM0wg8IIwGT6KjppEETkKG5DElfKLFN7EdZj-MXJTpw=s160-c-k-c0x00ffffff-no-rj";

        } else {

            $youtubechannelitems3 = $response3->items[0];
            $youtubechanneldata3 = $youtubechannelitems3->snippet;
            $youtubedp3 = $youtubechanneldata3->thumbnails->medium->url;
            $youtubetitle3 = $youtubechanneldata3->title;
            $youtubecustomUrl3 = $youtubechanneldata3->customUrl;
            $youtubechanneldatasubscription3 = $youtubechannelitems3->statistics->subscriberCount;

        }

        //dd($banner_video);

        return view('front.home', [
            'banner_video' => $banner_video,
            'servicedata' => $servicedata,
            'allservices' => $allservices,
            'youtube_video' => $youtube_video,
            'blogitems' => $blogitems,
            'reviews' => $reviews,
            'youtubedp1' => $youtubedp1,
            'youtubetitle1' => $youtubetitle1,
            'youtubechanneldatasubscription1' => $youtubechanneldatasubscription1,
            'youtubecustomUrl1' => $youtubecustomUrl1,
            'youtubedp2' => $youtubedp2,
            'youtubetitle2' => $youtubetitle2,
            'youtubechanneldatasubscription2' => $youtubechanneldatasubscription2,
            'youtubecustomUrl2' => $youtubecustomUrl2,
            'youtubedp3' => $youtubedp3,
            'youtubetitle3' => $youtubetitle3,
            'youtubechanneldatasubscription3' => $youtubechanneldatasubscription3,
            'youtubecustomUrl3' => $youtubecustomUrl3,

        ]);
    }

    /**
     * Show page for terms and condition
     */
    public function terms_conditions()
    {
        return view('front.terms_conditions');
    }

    /**
     * Show page for terms and condition
     */
    public function privacy_policy()
    {
        return view('front.privacy_policy');
    }

    /**
     * Show page for terms and condition
     */
    public function refund_policy()
    {
        return view('front.refund_policy');
    }

    /**
     * Show page for shipping
     */
    public function shipping()
    {
        return view('front.shipping');
    }
}
