<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\seodetails;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminservice()
    {
        $services = Service::get();

        $servicedata = [];
        foreach ($services as $data) {
            // $adminuser = $data->name;
            $serviceid = $data->id;

            $servicedata[$serviceid] = $data;
        }

        return view('admin.service', ['page_name' => 'Services', 'navstatus' => "adminservice", "servicedata" => $servicedata]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addservice(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            ['name' => 'required|unique:services'],
            ['nameurl' => 'required|unique:services'],
            ['shortdescription' => ['required|max:255']],
            ['description' => 'required|max:255'],
        ]);

        $find = array('\/', '\\', ',', '\'', '/', '"', '!', '_', '-');
        $nameurl = str_replace($find, "", $data['name']);
        $nameurl = str_replace(" ", "-", strtolower(trim($nameurl)));
        $nameurl = str_replace("&", "and", $nameurl);

        if (Service::where('nameurl', '=', $nameurl)->exists()) {
            // data found
            session(['status' => "0", 'msg' => 'Service name already exists']);
        } else {
            // data not found

            if ($request->hasFile('fileToUpload')) {
                //dd($data);
                $request->validate([
                    'image' => ['required|image|mimes:jpeg,png,jpg,gif,svg']
                ]);

                $newService = new Service;

                $file = $request->file('fileToUpload');
                $ext = $file->getClientOriginalExtension();
                $filename = 'Service' . time() . '.' . $ext;
                $image = Image::read($file);
                // Resize image

                // resize image canvas
                //$image->resizeCanvas(1200, 900);
                $image->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                });
                if ($image->save(public_path('service') . '/' . $filename)) {
                    $newService->image = $filename;
                }

                $shortdescription = htmlentities($data['shortdescription']);
                $description = htmlentities($data['description']);

                $newService->name = ucwords($data['name']);
                $newService->nameurl = $nameurl;
                $newService->shortdescription = $data['shortdescription'];
                $newService->description = $description;

                //dd($newService);

                if ($newService->save()) {
                    session(['status' => "1", 'msg' => 'Service Add is successful']);
                } else {
                    session(['status' => "0", 'msg' => 'Service data is not Added']);
                }
            } else {
                session(['status' => "0", 'msg' => 'Image not uploaded']);
            }
        }

        return redirect()->back();
    }

    /**
     * show the resource in user interphase.
     */
    public function servicedetails($nameurl)
    {
        $servicedata = Service::where('nameurl', $nameurl)->first();
        //dd($servicedata);
        return view('front.servicedetail', ['servicedata' => $servicedata]);
    }

    /**
     * Display the specified resource.
     */
    public function servicelists(Service $service)
    {
        $services = Service::get();
        $allservices = '';
        $servicedata = [];
        $i = 0;
        $servicecount = count($services);
        foreach ($services as $data) {
            // $adminuser = $data->name;
            $serviceid = $data->id;

            $servicedata[$serviceid] = $data;
            $i++;
            if ($i === $servicecount) {
                $allservices .= $data->name;
            } else {
                $allservices .= $data->name . ', ';
            }
        }

        return view('front.servicelist', ['servicedata' => $servicedata, 'allservices' => $allservices]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editservice($id)
    {
        $id = base64_decode($id);
        $servicedata = Service::where('id', $id)->first();

        //dd($servicedata);
        return view('admin.editservice', ['page_name' => 'Services', 'servicedata' => $servicedata, 'navstatus' => "adminservice"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateservice(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            ['name' => 'required|unique:services'],
            ['nameurl' => 'required|unique:services'],
            ['shortdescription' => ['required|max:255']],
            ['description' => 'required|max:255'],
        ]);

        $find = array('\/', '\\', ',', '\'', '/', '"', '!', '_', '-');
        $nameurl = str_replace($find, "", $data['name']);
        $nameurl = str_replace(" ", "-", strtolower(trim($nameurl)));
        $nameurl = str_replace("&", "and", $nameurl);

        if (Service::where([['nameurl', '=', $nameurl], ['id', '!=', $request->id]])->exists()) {
            // data found
            session(['status' => "0", 'msg' => 'Service name already exists']);
        } else {
            // data not found

            $shortdescription = htmlentities($data['shortdescription']);
            $description = htmlentities($data['description']);

            $updatedata['name'] = ucwords($request->name);
            $updatedata['nameurl'] = $nameurl;
            $updatedata['shortdescription'] = $request->shortdescription;
            $updatedata['description'] = $request->description;

            if ($request->hasFile('fileToUpload')) {

                $request->validate([
                    'image' => ['image|mimes:jpeg,png,jpg,gif,svg']
                ]);

                $image = public_path('service') . '/' . $request->oldimage;
                if (file_exists($image)) {
                    unlink($image);
                }

                $file = $request->file('fileToUpload');
                $ext = $file->getClientOriginalExtension();
                $filename = 'Service' . time() . '.' . $ext;
                $image = Image::read($file);
                // Resize image

                // resize image canvas
                //$image->resizeCanvas(1200, 900);
                $image->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                });

                if ($image->save(public_path('service') . '/' . $filename)) {
                    $updatedata['Image'] = $filename;
                }
            } else {

                $updatedata['Image'] = $request->oldimage;
            }
            // echo $request->id;
            // dd($updatedata);

            $update = Service::where('id', $request->id)
                ->update($updatedata);

            if ($update) {
                session(['status' => "1", 'msg' => 'Service Update is successful']);
            } else {
                session(['status' => "0", 'msg' => 'Service data is not Updated']);
            }
        }

        return redirect('/adminservice');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteservice(Request $request)
    {
        $id = base64_decode($request->id);
        $image = public_path('service') . '/' . $request->serviceimage;
        //echo json_encode(array('status' => 1, 'msg' => $image));
        $service = Service::where('id', $id)->delete();
        $seoblog = seodetails::where([['relatedid', $id], ['page', 'service']])->delete();
        if ($service) {
            if (file_exists($image)) {
                unlink($image);
            }
            echo json_encode(array('status' => 1, 'msg' => "true"));
        } else {
            echo json_encode(array('status' => 0, 'msg' => "false"));
        }
    }
}
