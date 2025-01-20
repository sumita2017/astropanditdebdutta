<?php // Code within app\Helpers\Helper.php

use App\Models\Service;
use App\Models\about_contact;
use App\Models\banner_video;
use App\Models\Appointment;
use App\Models\blog;
use App\Models\tag;
use App\Models\category;
use App\Models\keyword;
use App\Models\chamber;
use App\Models\Contactus;
use App\Models\Invoice;
use App\Models\Social;
use App\Models\alttag;
use App\Models\seodetails;
use Illuminate\Support\Facades\Auth;

if (!function_exists('numberService')) {
    function numberService()
    {
        $numberservice = Service::count();
        return $numberservice;
    }
}

if (!function_exists('aboutalldetails')) {
    function aboutalldetails()
    {
        $aboutcontact = about_contact::first();

        $phonearray = explode(',', $aboutcontact->phone);
        $aboutcontact->phone = $phonearray;
        //dd($aboutcontact->phone);
        return $aboutcontact;
    }
}


if (!function_exists('scociallinks')) {
    function scociallinks()
    {
        //social media link
        $social = Social::where('visibility', '1')->get();
        $socialdata = [];
        $i = 0;
        foreach ($social as $icon) {
            // echo "<pre>";
            // echo $icon;
            // echo "</pre>";
            $socialdata[$i]['id'] = $icon->id;
            $socialdata[$i]['name'] = $icon->name;
            $socialdata[$i]['icon'] = $icon->icon;
            $socialdata[$i]['url'] = $icon->url;
            $socialdata[$i]['visibility'] = $icon->visibility;

            $i++;
        }
        return $socialdata;
    }
}

if (!function_exists('servicelistfooter')) {
    function servicelistfooter()
    {
        //service link
        $services = Service::select('id', 'name', 'nameurl')->get();
        $servicedata = [];
        foreach ($services as $service) {
            $servicedata[$service->id]['name'] = $service->name;
            $servicedata[$service->id]['nameurl'] = $service->nameurl;
        }
        return $servicedata;
    }
}


if (!function_exists('blogfilters')) {
    function blogfilters()
    {
        $blogfilters = [];

        $alltags = tag::select('id', 'tag')->get();
        $alltag = [];
        foreach ($alltags as $tag) {
            $alltag[$tag->id] = $tag->tag;
        }
        $blogfilters['alltag'] = $alltag;

        $allkeywords = keyword::select('id', 'keyword')->get();
        $allkeyword = [];
        foreach ($allkeywords as $keyword) {
            $allkeyword[$keyword->id] = $keyword->keyword;
        }
        $blogfilters['allkeyword'] = $allkeyword;

        $allcategories = category::select('id', 'category')->get();
        $allcategory = [];
        foreach ($allcategories as $category) {
            $allcategory[$category->id] = $category->category;
        }
        $blogfilters['allcategory'] = $allcategory;


        return $blogfilters;
    }
}


if (!function_exists('alttagforimages')) {
    function alttagforimages()
    {
        $aboutimage = '';
        $bannervideos = '';
        $blog = '';
        $service = '';

        // about page images
        $aboutimage = about_contact::select('id', 'image')->get();
        $banner = banner_video::select('id', 'thumbnail', 'videolink')->where('thumbnailtype', '0')->get();
        $videos = banner_video::select('id', 'thumbnail', 'videolink')->where('thumbnailtype', '1')->get();
        //dd($videos);
        $serviceimage = Service::select('id', 'Image', 'name')->get();
        $blogimage = blog::select('id', 'image')->get();
        //dd($bannervideos);
        $allimages = [];
        $allimages['about_contact'] = [];
        $allimages['banner'] = [];
        $allimages['videos'] = [];
        $allimages['Service'] = [];
        $allimages['blog'] = [];

        if (!empty($aboutimage)) {
            $i = 0;
            foreach ($aboutimage as $image) {
                if ($image->image != null) {
                    $alttagdetails = alttag::where([
                        ['relatedid', $image->id],
                        ['page', 'about_contact'],
                    ])->first();

                    if (!empty($alttagdetails)) {

                        $allimages['about_contact'][$image->id]['id'] = $alttagdetails->id;
                        $allimages['about_contact'][$image->id]['page'] = $alttagdetails->page;
                        $allimages['about_contact'][$image->id]['alttag'] = $alttagdetails->alttag;
                        $allimages['about_contact'][$image->id]['title'] = $alttagdetails->title;
                    } else {
                        $allimages['about_contact'][$image->id]['id'] = '';
                        $allimages['about_contact'][$image->id]['page'] = 'about_contact';
                        $allimages['about_contact'][$image->id]['alttag'] = "";
                        $allimages['about_contact'][$image->id]['title'] = "";
                    }
                    $allimages['about_contact'][$image->id]['image'] = $image->image;
                }
            }
        } else {
            $allimages['about_contact'] = '';
        }

        if (!empty($banner)) {
            foreach ($banner as $image) {
                if ($image->thumbnail != null) {
                    $alttagdetails = alttag::where([
                        ['relatedid', $image->id],
                        ['page', 'banner'],
                    ])->first();
                    if (!empty($alttagdetails)) {
                        $allimages['banner'][$image->id]['id'] = $alttagdetails->id;
                        $allimages['banner'][$image->id]['page'] = $alttagdetails->page;
                        $allimages['banner'][$image->id]['alttag'] = $alttagdetails->alttag;
                        $allimages['banner'][$image->id]['title'] = $alttagdetails->title;
                    } else {
                        $allimages['banner'][$image->id]['id'] = "";
                        $allimages['banner'][$image->id]['page'] = "banner";
                        $allimages['banner'][$image->id]['alttag'] = "";
                        $allimages['banner'][$image->id]['title'] = "";
                    }
                    $allimages['banner'][$image->id]['image'] = $image->thumbnail;
                    $allimages['banner'][$image->id]['videolink'] = $image->videolink;
                    $allimages['banner'][$image->id]['relatedid'] = $image->id;
                }
            }
        } else {
            $allimages['banner'] = '';
        }

        if (!empty($videos)) {

            foreach ($videos as $image) {
                if ($image->thumbnail != null) {
                    $alttagdetails = alttag::where([
                        ['relatedid', $image->id],
                        ['page', 'youtube'],
                    ])->first();
                    if (!empty($alttagdetails)) {
                        $allimages['videos'][$image->id]['id'] = $alttagdetails->id;
                        $allimages['videos'][$image->id]['page'] = $alttagdetails->page;
                        $allimages['videos'][$image->id]['alttag'] = $alttagdetails->alttag;
                        $allimages['videos'][$image->id]['title'] = $alttagdetails->title;
                    } else {
                        $allimages['videos'][$image->id]['id'] = "";
                        $allimages['videos'][$image->id]['page'] = "youtube";
                        $allimages['videos'][$image->id]['alttag'] = "";
                        $allimages['videos'][$image->id]['title'] = "";
                    }
                    $allimages['videos'][$image->id]['image'] = $image->thumbnail;
                    $allimages['videos'][$image->id]['videolink'] = $image->videolink;
                    $allimages['videos'][$image->id]['relatedid'] = $image->id;
                }
            }
        } else {
            $allimages['videos'] = '';
        }


        if (!empty($serviceimage)) {

            foreach ($serviceimage as $image) {
                if ($image->Image != null) {
                    $alttagdetails = alttag::where([
                        ['relatedid', $image->id],
                        ['page', 'Service'],
                    ])->first();
                    if (!empty($alttagdetails)) {
                        $allimages['Service'][$image->id]['id'] = $alttagdetails->id;
                        $allimages['Service'][$image->id]['page'] = $alttagdetails->page;
                        $allimages['Service'][$image->id]['alttag'] = $alttagdetails->alttag;
                        $allimages['Service'][$image->id]['title'] = $alttagdetails->title;
                    } else {
                        $allimages['Service'][$image->id]['id'] = "";
                        $allimages['Service'][$image->id]['page'] = "Service";
                        $allimages['Service'][$image->id]['alttag'] = "";
                        $allimages['Service'][$image->id]['title'] = "";
                    }
                    $allimages['Service'][$image->id]['image'] = $image->Image;
                    $allimages['Service'][$image->id]['relatedid'] = $image->id;
                    $allimages['Service'][$image->id]['name'] = $image->name;
                }
            }
        } else {
            $allimages['Service'] = '';
        }

        if (!empty($blogimage)) {

            foreach ($blogimage as $image) {
                if ($image->image != null) {
                    $alttagdetails = alttag::where([
                        ['relatedid', $image->id],
                        ['page', 'blog'],
                    ])->first();
                    if (!empty($alttagdetails)) {
                        $allimages['blog'][$image->id]['id'] = $alttagdetails->id;
                        $allimages['blog'][$image->id]['page'] = $alttagdetails->page;
                        $allimages['blog'][$image->id]['alttag'] = $alttagdetails->alttag;
                        $allimages['blog'][$image->id]['title'] = $alttagdetails->title;
                    } else {
                        $allimages['blog'][$image->id]['id'] = "";
                        $allimages['blog'][$image->id]['page'] = "blog";
                        $allimages['blog'][$image->id]['alttag'] = "";
                        $allimages['blog'][$image->id]['title'] = "";
                    }
                    $allimages['blog'][$image->id]['image'] = $image->image;
                    $allimages['blog'][$image->id]['relatedid'] = $image->id;
                }
            }
        } else {
            $allimages['blog'] = '';
        }
        return $allimages;
    }
}


if (!function_exists('seodetailsperpage')) {
    function seodetailsperpage($page, $pagetype)
    {
        //seo detail
        $seodata = [];
        // dd($page . $pagetype);

        if ($pagetype == 'service') {
            $relatedid = Service::where('nameurl', $page)->first()->id;
            $seodetails = seodetails::where(
                [
                    ['page', '=', $pagetype],
                    ['relatedid', '=', $relatedid]
                ]
            )->first();
        } else if ($pagetype == 'blog') {
            $relatedid = blog::where('nameurl', $page)->first()->id;
            $seodetails = seodetails::where(
                [
                    ['page', '=', $pagetype],
                    ['relatedid', '=', $relatedid]
                ]
            )->first();
        } else {
            $seodetails = seodetails::where([
                ['page', '=', $page],
                ['relatedid', '=', 0]
            ])->first();
        }
        //dd($seodetails);

        if (!empty($seodetails) && $seodetails != null) {
            $seodata['page'] = $seodetails->page;
            $seodata['title'] = $seodetails->title;
            $seodata['description'] = $seodetails->description;
            $seodata['keyword'] = $seodetails->keyword;
            $seodata['metadata'] = json_decode($seodetails->metadata);
        } else {
            $seodefault = seodetails::where('page', '=', 'home')->first();
            $seodata['page'] = $page;
            $seodata['title'] = $seodefault->title;
            $seodata['description'] = $seodefault->description;
            $seodata['keyword'] = $seodefault->keyword;
            $seodata['metadata'] = json_decode($seodefault->metadata);
        }


        return $seodata;
    }
}

if (!function_exists('userdetails')) {
    function userdetails()
    {
        $user = Auth::user();
        return $user;
    }
}
