<?php

namespace App\Http\Controllers;

use App\Models\chamber;
use App\Http\Requests\StorechamberRequest;
use App\Http\Requests\UpdatechamberRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class ChamberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminchamber()
    {
        $chambers = chamber::get();
        $chamberdata = [];
        foreach ($chambers as $data) {

            $availabledays = $data->availabledays;
            $daysavailable = json_decode($availabledays);
            $i = 0;
            $days = [];

            foreach ($daysavailable as $day) {

                if ($day == "1") {
                    $days[$i] = "Sunday";
                } elseif ($day === "2") {
                    $days[$i] = "Monday";
                } elseif ($day === "3") {
                    $days[$i] = "Tuesday";
                } elseif ($day === "4") {
                    $days[$i] = "Wednesday";
                } elseif ($day === "5") {
                    $days[$i] = "Thursday";
                } elseif ($day === "6") {
                    $days[$i] = "Friday";
                } else {
                    $days[$i] = "Saturday";
                }
                $i++;
            }

            $data['availabledays'] = implode(',', $days);
            $chamberid = $data->id;
            $chamberdata[$chamberid] = $data;
        }
        //dd($chamberdata);
        return view('admin.chamber', ['page_name' => 'Chambers', 'navstatus' => "adminchember", "chamberdata" => $chamberdata]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addchamber(Request $request)
    {
        $data = $request->except('_token');
        $days = $data['day'];
        //dd($data);
        $newChamber = new chamber;
        $newChamber->locationname = ucfirst($data['name']);
        $newChamber->availabledays = json_encode($days);
        $newChamber->description = $data['description'];

        //set session
        if ($newChamber->save()) {
            session(['status' => "1", 'msg' => 'Chamber Add is successful']);
        } else {
            session(['status' => "0", 'msg' => 'Chamber data is not Added']);
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorechamberRequest $request)
    {
        //
    }

    /**
     * Display the specified resource for user interface.
     */
    public function chamber(chamber $chamber)
    {
        $chambers = chamber::get();
        $chamberdata = [];
        foreach ($chambers as $data) {

            $availabledays = $data->availabledays;
            $daysavailable = json_decode($availabledays);
            $i = 0;
            $days = [];

            foreach ($daysavailable as $day) {

                if ($day == "1") {
                    $days[$i] = "Sunday";
                } elseif ($day === "2") {
                    $days[$i] = "Monday";
                } elseif ($day === "3") {
                    $days[$i] = "Tuesday";
                } elseif ($day === "4") {
                    $days[$i] = "Wednesday";
                } elseif ($day === "5") {
                    $days[$i] = "Thursday";
                } elseif ($day === "6") {
                    $days[$i] = "Friday";
                } else {
                    $days[$i] = "Saturday";
                }
                $i++;
            }

            $data['availabledays'] = implode(',', $days);
            $chamberid = $data->id;
            $chamberdata[$chamberid] = $data;
        }
        //dd($chamberdata);
        return view('front.chamberlist', ["chamberdata" => $chamberdata]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editchamber($id)
    {
        $id = base64_decode($id);
        $chamberdata = chamber::where('id', $id)->first();
        $availabledays = json_decode($chamberdata->availabledays);
        $chamberdata->availabledays = $availabledays;
        //dd($chamberdata);
        return view('admin.editchamber', ['page_name' => 'Chambers', 'chamberdata' => $chamberdata, 'navstatus' => "adminchamber"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatechamber(Request $request)
    {
        $data = $request->except('_token');
        $days = $data['day'];
        //dd($days);
        $updatedata = [];
        $updatedata['locationname'] = ucfirst($data['name']);
        $updatedata['availabledays'] = json_encode($days);
        $updatedata['description'] = $data['description'];

        $update = Chamber::where('id', $request->id)
            ->update($updatedata);

        if ($update) {
            session(['status' => "1", 'msg' => 'Chamber Update is successful']);
        } else {
            session(['status' => "0", 'msg' => 'Chamber data is not Updated']);
        }

        return redirect('/adminchember');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletechamber(Request $request)
    {
        $id = base64_decode($request->id);
        //echo json_encode(array('status' => 1, 'msg' => $id));
        $chamber = Chamber::where('id', $id)->delete();

        if ($chamber) {
            echo json_encode(array('status' => 1, 'msg' => "true"));
        } else {
            echo json_encode(array('status' => 0, 'msg' => "false"));
        }
    }
}
