<?php

namespace App\Http\Controllers;

use App\Models\alttag;
use App\Http\Requests\StorealttagRequest;
use App\Http\Requests\UpdatealttagRequest;
use App\Models\about_contact;
use App\Models\banner_video;
use App\Models\blog;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class AlttagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function alttag()
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
        $serviceimage = Service::select('id', 'Image', 'nameurl')->get();
        $blogimage = blog::select('id', 'image', 'nameurl')->get();
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

                        $allimages['about_contact'][$i]['id'] = $alttagdetails->id;
                        $allimages['about_contact'][$i]['page'] = $alttagdetails->page;
                        $allimages['about_contact'][$i]['alttag'] = $alttagdetails->alttag;
                        $allimages['about_contact'][$i]['title'] = $alttagdetails->title;
                    } else {
                        $allimages['about_contact'][$i]['id'] = '';
                        $allimages['about_contact'][$i]['page'] = 'about_contact';
                        $allimages['about_contact'][$i]['alttag'] = "";
                        $allimages['about_contact'][$i]['title'] = "";
                    }
                    $allimages['about_contact'][$i]['image'] = $image->image;
                    $allimages['about_contact'][$i]['relatedid'] = $image->id;
                    $i++;
                }
            }
        } else {
            $allimages['about_contact'] = '';
        }

        if (!empty($banner)) {
            $j = 0;
            foreach ($banner as $image) {
                if ($image->thumbnail != null) {
                    $alttagdetails = alttag::where([
                        ['relatedid', $image->id],
                        ['page', 'banner'],
                    ])->first();
                    if (!empty($alttagdetails)) {
                        $allimages['banner'][$j]['id'] = $alttagdetails->id;
                        $allimages['banner'][$j]['page'] = $alttagdetails->page;
                        $allimages['banner'][$j]['alttag'] = $alttagdetails->alttag;
                        $allimages['banner'][$j]['title'] = $alttagdetails->title;
                    } else {
                        $allimages['banner'][$j]['id'] = "";
                        $allimages['banner'][$j]['page'] = "banner";
                        $allimages['banner'][$j]['alttag'] = "";
                        $allimages['banner'][$j]['title'] = "";
                    }
                    $allimages['banner'][$j]['image'] = $image->thumbnail;
                    $allimages['banner'][$j]['videolink'] = $image->videolink;
                    $allimages['banner'][$j]['relatedid'] = $image->id;
                    $j++;
                }
            }
        } else {
            $allimages['banner'] = '';
        }

        if (!empty($videos)) {
            $j = 0;
            foreach ($videos as $image) {
                if ($image->thumbnail != null) {
                    $alttagdetails = alttag::where([
                        ['relatedid', $image->id],
                        ['page', 'youtube'],
                    ])->first();
                    if (!empty($alttagdetails)) {
                        $allimages['videos'][$j]['id'] = $alttagdetails->id;
                        $allimages['videos'][$j]['page'] = $alttagdetails->page;
                        $allimages['videos'][$j]['alttag'] = $alttagdetails->alttag;
                        $allimages['videos'][$j]['title'] = $alttagdetails->title;
                    } else {
                        $allimages['videos'][$j]['id'] = "";
                        $allimages['videos'][$j]['page'] = "youtube";
                        $allimages['videos'][$j]['alttag'] = "";
                        $allimages['videos'][$j]['title'] = "";
                    }
                    $allimages['videos'][$j]['image'] = $image->thumbnail;
                    $allimages['videos'][$j]['videolink'] = $image->videolink;
                    $allimages['videos'][$j]['relatedid'] = $image->id;
                    $j++;
                }
            }
        } else {
            $allimages['videos'] = '';
        }


        if (!empty($serviceimage)) {
            $k = 0;
            foreach ($serviceimage as $image) {
                if ($image->Image != null) {
                    $alttagdetails = alttag::where([
                        ['relatedid', $image->id],
                        ['page', 'Service'],
                    ])->first();
                    if (!empty($alttagdetails)) {
                        $allimages['Service'][$k]['id'] = $alttagdetails->id;
                        $allimages['Service'][$k]['page'] = $alttagdetails->page;
                        $allimages['Service'][$k]['alttag'] = $alttagdetails->alttag;
                        $allimages['Service'][$k]['title'] = $alttagdetails->title;
                    } else {
                        $allimages['Service'][$k]['id'] = "";
                        $allimages['Service'][$k]['page'] = "Service";
                        $allimages['Service'][$k]['alttag'] = "";
                        $allimages['Service'][$k]['title'] = "";
                    }
                    $allimages['Service'][$k]['image'] = $image->Image;
                    $allimages['Service'][$k]['relatedid'] = $image->id;
                    $allimages['Service'][$k]['nameurl'] = $image->nameurl;
                    $k++;
                }
            }
        } else {
            $allimages['Service'] = '';
        }

        if (!empty($blogimage)) {
            $l = 0;
            foreach ($blogimage as $image) {
                if ($image->image != null) {
                    $alttagdetails = alttag::where([
                        ['relatedid', $image->id],
                        ['page', 'blog'],
                    ])->first();
                    if (!empty($alttagdetails)) {
                        $allimages['blog'][$l]['id'] = $alttagdetails->id;
                        $allimages['blog'][$l]['page'] = $alttagdetails->page;
                        $allimages['blog'][$l]['alttag'] = $alttagdetails->alttag;
                        $allimages['blog'][$l]['title'] = $alttagdetails->title;
                    } else {
                        $allimages['blog'][$l]['id'] = "";
                        $allimages['blog'][$l]['page'] = "blog";
                        $allimages['blog'][$l]['alttag'] = "";
                        $allimages['blog'][$l]['title'] = "";
                    }
                    $allimages['blog'][$l]['image'] = $image->image;
                    $allimages['blog'][$l]['relatedid'] = $image->id;
                    $allimages['blog'][$l]['nameurl'] = $image->nameurl;
                    $l++;
                }
            }
        } else {
            $allimages['blog'] = '';
        }

        //dd($allimages);

        return view('admin.alttag', ['page_name' => 'Alt Tag', 'navstatus' => "alttag", 'allimages' => $allimages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorealttagRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(alttag $alttag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(alttag $alttag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatealttag(Request $request)
    {

        $data = $request->except('_token');
        //dd($data['page']);

        $ifdata = alttag::where([
            ['relatedid', $data['relatedid']],
            ['page', $data['page']],
        ])->first();
        //dd($ifdata);
        if (empty($ifdata)) {
            $newalttag = new alttag;
            $newalttag->title = $data['title'];
            $newalttag->alttag = $data['alttag'];
            $newalttag->page = $data['page'];
            $newalttag->relatedid = $data['relatedid'];
            //set session
            if ($newalttag->save()) {
                session(['status' => "1", 'msg' => 'Alt tag and Title Add is successful']);
            } else {
                session(['status' => "0", 'msg' => 'Alt tag and Title data is not Added']);
            }
        } else {
            $updatedata['alttag'] = $data['alttag'];
            $updatedata['title'] = $data['title'];

            $update = alttag::where([
                ['relatedid', $data['relatedid']],
                ['page', $data['page']]
            ])
                ->update($updatedata);

            //set session

            if ($update) {
                session(['status' => "1", 'msg' => 'Alt tag and Title Update is successful']);
            } else {
                session(['status' => "0", 'msg' => 'Alt tag and Title data is not Updated']);
            }
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(alttag $alttag)
    {
        //
    }
}
