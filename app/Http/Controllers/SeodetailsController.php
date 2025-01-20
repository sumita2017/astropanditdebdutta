<?php

namespace App\Http\Controllers;

use App\Models\seodetails;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\blog;
use App\Http\Requests\StoreseodetailsRequest;
use Illuminate\Http\Request;


class SeodetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function seodetails()
    {
        $seodata = seodetails::where('relatedid', '=', '0')->get();
        $seodetails = [];

        foreach ($seodata as $key => $data) {
            $seodetails[$key]['page'] = $data->page;
            $seodetails[$key]['pagetype'] = "static";
            $seodetails[$key]['relatedid'] = $data->relatedid;
            $seodetails[$key]['status'] = 1;
        }
        //dd($seodetails);

        $i = 0;
        $newseo = [];
        $services = Service::select('id', 'nameurl')->get();
        foreach ($services as $service) {
            $newseo[$i]['page'] = "service/" . $service->nameurl;
            $newseo[$i]['pagetype'] = "service";
            $newseo[$i]['relatedid'] = $service->id;
            $seostatus = seodetails::where([['relatedid', '=', $service->id], ['page', '=', 'service']])->first();
            if ($seostatus) {
                $newseo[$i]['status'] = 1;
            } else {
                $newseo[$i]['status'] = 0;
            }
            $i++;
        }

        $blogs = blog::select('id', 'nameurl')->get();
        foreach ($blogs as $blog) {
            $newseo[$i]['page'] = "blog/" . $blog->nameurl;
            $newseo[$i]['pagetype'] = "relatedid";
            $newseo[$i]['relatedid'] = $blog->id;
            $seostatus = seodetails::where([['relatedid', '=', $blog->id], ['page', '=', 'blog']])->first();
            if ($seostatus) {
                $newseo[$i]['status'] = 1;
            } else {
                $newseo[$i]['status'] = 0;
            }
            $i++;
        }
        //dd($newseo);
        return view('admin.seodetails', ['page_name' => 'Manage Seo details', 'navstatus' => "seodetails", 'seodetails' => $seodetails, 'newseo' => $newseo]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function xmlupload(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);

        if ($request->hasFile('sitemap')) {
            //dd($data);
            $file = $request->file('sitemap');
            $ext = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();

            $image = public_path('/') . '/' . $filename;
            if (file_exists($image)) {
                unlink($image);
            }

            if ($file->move(public_path('/'), $filename)) {
                session(['status' => "1", 'msg' => 'File Uploaded Successfully']);
            } else {
                session(['status' => "0", 'msg' => 'File Uploaded not done']);
            }

            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreseodetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(seodetails $seodetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editseo($pagetype, $nameulr)
    {
        $seodata = [];
        if ($pagetype == 'static') {
            $seodetails = seodetails::where('page', '=', $nameulr)->first();
            $relatedid = 0;
        } elseif ($pagetype == 'service') {
            $service = Service::select('id')->where('nameurl', $nameulr)->first();
            $relatedid = $service->id;
            $seodetails = seodetails::where([['page', '=', $pagetype], ['relatedid', '=', $relatedid]])->first();
        } elseif ($pagetype == 'blog') {
            $blog = blog::select('id')->where('nameurl', $nameulr)->first();
            $relatedid = $blog->id;
            $seodetails = seodetails::where([['page', '=', $pagetype], ['relatedid', '=', $relatedid]])->first();
        }


        if (!empty($seodetails) && $seodetails != null) {
            $seodata['page'] = $nameulr;
            $seodata['pagetype'] = $pagetype;
            $seodata['relatedid'] = $seodetails->relatedid;
            $seodata['title'] = $seodetails->title;
            $seodata['keywords'] = $seodetails->keyword;
            $seodata['description'] = $seodetails->description;
            $seodata['metadata'] = json_decode($seodetails->metadata);
        } else {
            $seodata['page'] = $nameulr;
            $seodata['pagetype'] = $pagetype;
            $seodata['relatedid'] = $relatedid;
            $seodata['title'] = "";
            $seodata['keywords'] = "";
            $seodata['description'] = "";
            $seodata['metadata'] = [];
        }
        return view('admin.editseo', ['page_name' => 'Edit Seo details', 'navstatus' => "seodetails", 'seodata' => $seodata]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateseo(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        if (seodetails::where([['page', '=', $data['pagetype']], ['relatedid', '=', $request->relatedid]])->exists()) {
            // page found
            if (!empty($data['title'])) {
                $updateseo['title'] = $data['title'];
            } else {
                $updateseo['title'] = "Best Astrologer in Kolkata";
            }

            if (!empty($data['keyword'])) {
                $updateseo['keyword'] = $data['keyword'];
            } else {
                $updateseo['keyword'] = "Best Astrologer in Kolkata";
            }

            if (!empty($data['description'])) {
                $updateseo['description'] = $data['description'];
            } else {
                $updateseo['description'] = "Best Astrologer in Kolkata";
            }
            if (!empty($data['metadata']) && count($data['metadata']) != 0) {
                //dd(vars: "dsadasdsad");
                $updateseo['metadata'] = json_encode($data['metadata']);
            } else {
                //dd("fgfhgfhfh");
                $data['metadata'] = "<meta property='og:url' content='https://astroachariyadebdutta.com/' />";
                $updateseo['metadata'] = $data['metadata'];
            }

            //dd($updateseo);
            if ($data['pagetype'] == "static") {

                $update = seodetails::where([['page', '=', $data['page']], ['relatedid', '=', $data['relatedid']]])->update($updateseo);

            } else {

                $update = seodetails::where([['page', '=', $data['pagetype']], ['relatedid', '=', $data['relatedid']]])->update($updateseo);

            }

            if ($update) {
                session(['status' => "1", 'msg' => 'Seo Updated successfully']);
            } else {
                session(['status' => "0", 'msg' => 'Seo Updated not done']);
            }

        } else {
            //page not found
            $newseo = new seodetails;

            if ($data['pagetype'] == 'static') {
                $newseo->page = $data['page'];
            } else {
                $newseo->page = $data['pagetype'];
            }

            $newseo->relatedid = $data['relatedid'];

            if (!empty($data['title'])) {
                $newseo->title = $data['title'];
            } else {
                $newseo->title = "Best Astrologer in Kolkata";
            }

            if (!empty($data['keyword'])) {
                $newseo->keyword = $data['keyword'];
            } else {
                $newseo->keyword = "Best Astrologer in Kolkata";
            }

            if (!empty($data['description'])) {
                $newseo->description = $data['description'];
            } else {
                $newseo->description = "Best Astrologer in Kolkata";
            }

            if (!empty($data['metadata'])) {
                $newseo->metadata = json_encode($data['metadata']);
            } else {
                $data['metadata'] = "<meta property='og:url' content='https://astroachariyadebdutta.com/' />";
                $newseo->metadata = $data['metadata'];
            }

            if ($newseo->save()) {
                session(['status' => "1", 'msg' => 'Seo Add is successful']);
            } else {
                session(['status' => "0", 'msg' => 'Seo data is not Added']);
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(seodetails $seodetails)
    {
        //
    }
}
