<?php

namespace App\Http\Controllers;

use App\Models\about_contact;
use App\Http\Requests\Storeabout_contactRequest;
use App\Http\Requests\Updateabout_contactRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class AboutContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manageaboutcontactus()
    {
        $user = userdetails();
        // dd($user);
        if ($user['usertype'] == 0 || $user['usertype'] == 1 || $user['usertype'] == 5) {
            $aboutcontactus = about_contact::first();
            //dd(($aboutcontactus));
            return view('admin.manageaboutcontactus', ['page_name' => 'Manage About and Contact details', 'navstatus' => "manageaboutcontactus", 'aboutcontactus' => $aboutcontactus]);
        } else {
            return redirect('/dashboard');
        }
    }

    /**
     * Update the about us resource in storage.
     */
    public function updateaboutus(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        $updateabout['title'] = htmlentities($request->title);
        $updateabout['description'] = htmlentities($request->description);
        $updateabout['homedescription'] = htmlentities($request->homedescription);


        if ($request->hasFile('image')) {

            $request->validate([
                'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
            ]);

            $data['oldimage'] = "default.jpg";
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = 'about' . time() . '.' . $ext;
            $image = Image::read($file);
            // Resize image

            // resize image canvas
            //$image->resizeCanvas(550, 550);
            $image->resize(550, 550, function ($constraint) {
                $constraint->aspectRatio();
            });

            if ($image->save(public_path('about') . '/' . $filename)) {
                if ($request->oldimage != null) {
                    $image = public_path('about') . '/' . $request->oldimage;
                    //dd($request->oldimage);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                $updateabout['image'] = $filename;
            }
        } else {

            $updateabout['image'] = $request->oldimage;
        }
        //dd($updateabout);
        $update = about_contact::where('id', $request->id)
            ->update($updateabout);

        if ($update) {
            session(['status' => "1", 'msg' => 'About details update is successful']);
        } else {
            session(['status' => "0", 'msg' => 'About details is not Updated']);
        }
        return redirect('/manageaboutcontactus');
    }

    /**
     * Update the contact us resource in storage.
     */
    public function updatecontactus(Request $request)
    {
        $data = $request->except('_token');

        $updatecontact['address'] = $request->address;
        $updatecontact['email'] = $request->email;
        $updatecontact['phone'] = implode(",", $request->phone);
        $updatecontact['whatsapp'] = $request->whatsapp;

        //dd($updatecontact);
        $update = about_contact::where('id', $request->contactid)
            ->update($updatecontact);

        if ($update) {
            session(['status' => "1", 'msg' => 'Contact details update is successful']);
        } else {
            session(['status' => "0", 'msg' => 'Contact details is not Updated']);
        }
        return redirect('/manageaboutcontactus');
    }


    /**
     * About details for frontend.
     */
    public function frontabout()
    {
        // about me details
        $aboutcontactus = about_contact::first();

        //dd($aboutcontactus);
        return view('front.aboutme', ['about_contact' => $aboutcontactus]);
    }
}
