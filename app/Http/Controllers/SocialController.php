<?php

namespace App\Http\Controllers;

use App\Models\Social;
use App\Http\Requests\StoreSocialRequest;
use App\Http\Requests\UpdateSocialRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminsocial()
    {
        $social = Social::get();

        $socialdata = [];
        $i = 0;
        foreach ($social as $icon) {
            // echo "<pre>";
            // echo $icon;
            // echo "</pre>";
            $socialdata[$i]['id'] = $icon->id;
            $socialdata[$i]['name'] = $icon->name;
            $socialdata[$i][$icon->name] = $icon->icon;
            $socialdata[$i]['url'] = $icon->url;
            $socialdata[$i]['visibility'] = $icon->visibility;

            $i++;
        }
        //dd($socialdata);
        return view('admin.adminsocial', ['page_name' => 'Manage Social Media links', 'navstatus' => "adminsocial", 'socialdata' => $socialdata]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addsociallink(Request $request)
    {
        $request->validate(['name' => 'unique:socials,name']);
        $data = $request->except('_token');
        $newSocial = new Social;
        $newSocial->name = ucfirst($data['name']);
        $newSocial->url = urlencode($data['url']);
        $newSocial->icon = $data['icon'];

        //dd($newSocial);

        //set session
        if ($newSocial->save()) {
            session(['status' => "1", 'msg' => 'Social Link Add is successful']);
        } else {
            session(['status' => "0", 'msg' => 'Social Link data is not Added']);
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function addeditsocials(Request $request)
    {
        $id = base64_decode($request->id);
        $url = $request->url;
        $updatedata['url'] = $url;
        //echo json_encode(array('status' => 1, 'msg' => $url));
        $update = Social::where('id', $request->id)
            ->update($updatedata);

        if ($update) {
            echo json_encode(array('status' => 1, 'msg' => "true"));
        } else {
            echo json_encode(array('status' => 0, 'msg' => "false"));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function visibilitylink(Request $request)
    {
        $id = base64_decode($request->id);
        $radioValue = $request->radioValue;
        $updatedata['visibility'] = $radioValue;
        //echo json_encode(array('status' => 1, 'msg' => $url));
        $update = Social::where('id', $request->id)
            ->update($updatedata);

        if ($update) {
            echo json_encode(array('status' => 1, 'msg' => "true"));
        } else {
            echo json_encode(array('status' => 0, 'msg' => "false"));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletesocials(Request $request)
    {
        $id = base64_decode($request->id);
        // echo json_encode(array('status' => 1, 'msg' => $id));
        $social = Social::where('id', $id)->delete();

        if ($social) {
            echo json_encode(array('status' => 1, 'msg' => "true"));
        } else {
            echo json_encode(array('status' => 0, 'msg' => "false"));
        }
    }
}
