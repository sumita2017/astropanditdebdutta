<?php

namespace App\Http\Controllers;

use App\Models\banner_video;
use App\Http\Requests\Storebanner_videoRequest;
use App\Http\Requests\Updatebanner_videoRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class BannerVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function managebannervideo()
    {
        $bannerthumbnail = banner_video::where('thumbnailtype', '0')->get();
        $videothumbnail = banner_video::where('thumbnailtype', '1')->get();
        //dd($bannerthumbnail);
        return view('admin.managebannervideo', ['page_name' => 'Manage Banners and Videos', 'navstatus' => "managebannervideo", 'bannerthumbnail' => $bannerthumbnail, 'videothumbnail' => $videothumbnail]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addbannervideo(Request $request)
    {

        $request->validate([
            'url' => 'url:http,https',
        ]);

        $data = $request->except('_token');
        //dd($data);
        if ($data['thumbnailtype'] == "1") {
            if ($data['videolink'] != null) {
                if ($request->hasFile('fileToUpload')) {
                    //dd($data);
                    $request->validate([
                        'image' => ['required|image|mimes:jpeg,png,jpg,gif,svg']
                    ]);
                    $newBannerVideo = new banner_video;
                    $file = $request->file('fileToUpload');
                    $ext = $file->getClientOriginalExtension();
                    $filename = 'Banner' . time() . '.' . $ext;
                    $image = Image::read($file);
                    // Resize image

                    // resize image canvas
                    //$image->resizeCanvas(550, 550);
                    // $image->resize(836, 1080, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // });
                    if ($image->save(public_path('bannervideo') . '/' . $filename)) {
                        $newBannerVideo->thumbnail = $filename;
                        $newBannerVideo->videolink = $data['videolink'];
                        $newBannerVideo->thumbnailtype = $data['thumbnailtype'];
                        $newBannerVideo->bannertext = "";
                        $newBannerVideo->show = $data['show'];
                        // dd($newBannerVideo);

                        if ($newBannerVideo->save()) {
                            session(['status' => "1", 'msg' => 'File Add is successful']);
                        } else {
                            session(['status' => "0", 'msg' => 'File data is not Added']);
                        }
                    } else {
                        session(['status' => "0", 'msg' => 'File not uploaded']);
                    }
                } else {
                    session(['status' => "0", 'msg' => 'File not uploaded']);
                }
            } else {
                session(['status' => "0", 'msg' => 'Video Link not Added']);
            }
        } else {
            if ($request->hasFile('fileToUpload')) {
                //dd($data);
                $request->validate([
                    'image' => ['required|image|mimes:jpeg,png,jpg,gif,svg']
                ]);
                $newBannerVideo = new banner_video;
                $file = $request->file('fileToUpload');
                $ext = $file->getClientOriginalExtension();
                $filename = 'Banner' . time() . '.' . $ext;
                $image = Image::read($file);
                // Resize image

                // resize image canvas
                //$image->resizeCanvas(550, 550);
                // $image->resize(836, 1080, function ($constraint) {
                //     $constraint->aspectRatio();
                // });
                if ($image->save(public_path('bannervideo') . '/' . $filename)) {
                    $newBannerVideo->thumbnail = $filename;
                    $newBannerVideo->videolink = $data['videolink'];
                    $newBannerVideo->thumbnailtype = $data['thumbnailtype'];
                    $newBannerVideo->bannertext = $data['bannertext'];
                    $newBannerVideo->show = $data['show'];
                    //dd($newBannerVideo);

                    if ($newBannerVideo->save()) {
                        session(['status' => "1", 'msg' => 'File Add is successful']);
                    } else {
                        session(['status' => "0", 'msg' => 'File data is not Added']);
                    }
                } else {
                    session(['status' => "0", 'msg' => 'File not uploaded']);
                }
            }
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storebanner_videoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(banner_video $banner_video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editbannervideo($id)
    {
        $id = base64_decode($id);
        $bannervideodata = banner_video::where('id', $id)->first();

        //dd($bannervideodata);
        return view('admin.editbannervideo', ['page_name' => 'Manage Banners and Videos', 'bannervideodata' => $bannervideodata, 'navstatus' => "managebannervideo"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatebannervideo(Request $request)
    {
        $data = $request->except('_token');
        //dd($request);

        $updatedata['videolink'] = $request->videolink;
        $updatedata['thumbnailtype'] = $request->thumbnailtype;
        $updatedata['show'] = $request->show;
        if ($updatedata['thumbnailtype'] == 1) {
            if ($updatedata['videolink'] != null) {
                if ($request->hasFile('fileToUpload')) {

                    $request->validate([
                        'image' => ['image|mimes:jpeg,png,jpg,gif,svg']
                    ]);
                    $image = public_path('bannervideo') . '/' . $request->oldimage;
                    if (file_exists($image)) {
                        unlink($image);
                    }

                    $file = $request->file('fileToUpload');
                    $ext = $file->getClientOriginalExtension();
                    $filename = 'Banner' . time() . '.' . $ext;
                    $image = Image::read($file);
                    // Resize image

                    // resize image canvas
                    //$image->resizeCanvas(550, 550);
                    // $image->resize(836, 1080, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // });
                    if ($image->save(public_path('bannervideo') . '/' . $filename)) {
                        $updatedata['thumbnail'] = $filename;
                        $updatedata['bannertext'] = "";
                    } else {

                        session(['status' => "0", 'msg' => 'File not uploaded']);
                        return redirect('/managebannervideo');
                    }
                } else {
                    $updatedata['thumbnail'] = $request->oldimage;
                }
            } else {
                session(['status' => "0", 'msg' => 'Video Link not Added']);
                return redirect('/managebannervideo');
            }
        } else {
            if ($request->hasFile('fileToUpload')) {

                $request->validate([
                    'image' => ['image|mimes:jpeg,png,jpg,gif,svg']
                ]);
                $image = public_path('bannervideo') . '/' . $request->oldimage;
                if (file_exists($image)) {
                    unlink($image);
                }

                $file = $request->file('fileToUpload');
                $ext = $file->getClientOriginalExtension();
                $filename = 'Banner' . time() . '.' . $ext;
                $image = Image::read($file);
                // Resize image

                // resize image canvas
                //$image->resizeCanvas(550, 550);
                // $image->resize(836, 1080, function ($constraint) {
                //     $constraint->aspectRatio();
                // });
                if ($image->save(public_path('bannervideo') . '/' . $filename)) {
                    $updatedata['thumbnail'] = $filename;
                } else {
                    session(['status' => "0", 'msg' => 'File not uploaded']);
                    return redirect('/managebannervideo');
                }
            } else {
                $updatedata['thumbnail'] = $request->oldimage;
            }
            $updatedata['bannertext'] = $request->bannertext;
        }

        $update = banner_video::where('id', $request->id)
            ->update($updatedata);

        if ($update) {
            session(['status' => "1", 'msg' => 'File Update is successful']);
        } else {
            session(['status' => "0", 'msg' => 'File data is not Updated']);
        }

        return redirect('/managebannervideo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletebannervideo(Request $request)
    {
        $id = base64_decode($request->id);
        $image = public_path('bannervideo') . '/' . $request->bannervideoimage;
        // echo json_encode(array('status' => 1, 'msg' => $image));
        $bannervideo = banner_video::where('id', $id)->delete();
        if ($bannervideo) {
            if (file_exists($image)) {
                unlink($image);
            }
            echo json_encode(array('status' => 1, 'msg' => "true"));
        } else {
            echo json_encode(array('status' => 0, 'msg' => "false"));
        }
    }
}
