<?php

namespace App\Http\Controllers;

use App\Models\contactus;
use App\Models\about_contact;
use App\Http\Requests\UpdatecontactusRequest;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function managecontactus()
    {
        $contactus = contactus::get();

        return view('admin.managecontactus', ['page_name' => 'Mange Contact us page', 'navstatus' => "managecontactus", 'contactus' => $contactus]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addcontactus(Request $request)
    {
        $data = $request->except('_token');

        $newContacts = new contactus;
        $newContacts->fullname = ucfirst($data['fullname']);
        $newContacts->email = $data['email'];
        $newContacts->phone = $data['phone'];
        $newContacts->message = $data['message'];

        //set session
        if ($newContacts->save()) {
            echo json_encode(array('status' => 1, 'msg' => "true"));
        } else {
            echo json_encode(array('status' => 0, 'msg' => "false"));
        }
    }

    /**
     * front contact us form view
     */
    public function contactus(Request $request)
    {
        $about_contact = about_contact::first();

        //@AchariyaDebdutta
        $url1 = 'https://www.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCqDfG4lWZ5OJgJSc2XK7g4A' . '&key=AIzaSyBUm1uVpuIGK2GudT_jFjagMWqnwZRojNI';

        $response1 = Curl::to($url1)
            ->get();
        //dd($response);
        $response1 = json_decode($response1);
        $youtubechannelitems1 = $response1->items[0];
        $youtubechanneldata1 = $youtubechannelitems1->snippet;
        $youtubechanneldatasubscription1 = $youtubechannelitems1->statistics->subscriberCount;

        //@TheDebduttaShow -
        $url2 = 'https://www.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCE6Wescg35pfTdUmOpJsYsQ' . '&key=AIzaSyBUm1uVpuIGK2GudT_jFjagMWqnwZRojNI';

        $response2 = Curl::to($url2)
            ->get();
        //dd($response);
        $response2 = json_decode($response2);
        $youtubechannelitems2 = $response2->items[0];
        $youtubechanneldata2 = $youtubechannelitems2->snippet;
        $youtubechanneldatasubscription2 = $youtubechannelitems2->statistics->subscriberCount;

        //dd($youtubechanneldatasubscription2);

        //@AstroAchariya -
        $url3 = 'https://www.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=UCHeZB0rv09RBnEySIfehLOA' . '&key=AIzaSyBUm1uVpuIGK2GudT_jFjagMWqnwZRojNI';

        $response3 = Curl::to($url3)
            ->get();
        $response3 = json_decode($response3);
        $youtubechannelitems3 = $response3->items[0];
        $youtubechanneldata3 = $youtubechannelitems3->snippet;
        $youtubechanneldatasubscription3 = $youtubechannelitems3->statistics->subscriberCount;

        return view('front.contactus', [
            'about_contact' => $about_contact,
            'youtubechanneldata1' => $youtubechanneldata1,
            'youtubechanneldatasubscription1' => $youtubechanneldatasubscription1,
            'youtubechanneldata2' => $youtubechanneldata2,
            'youtubechanneldatasubscription2' => $youtubechanneldatasubscription2,
            'youtubechanneldata3' => $youtubechanneldata3,
            'youtubechanneldatasubscription3' => $youtubechanneldatasubscription3
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(contactus $contactus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(contactus $contactus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecontactusRequest $request, contactus $contactus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletecontactdetails(Request $request)
    {
        $id = base64_decode($request->id);
        // echo json_encode(array('status' => 1, 'msg' => $id));
        $contact = contactus::where('id', $id)->delete();

        if ($contact) {
            echo json_encode(array('status' => 1, 'msg' => "true"));
        } else {
            echo json_encode(array('status' => 0, 'msg' => "false"));
        }
    }
}
