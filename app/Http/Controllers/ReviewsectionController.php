<?php

namespace App\Http\Controllers;

use App\Models\reviewsection;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorereviewsectionRequest;
use App\Http\Requests\UpdatereviewsectionRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ReviewsectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = reviewsection::get();
        return view('admin.reviewsection', ['page_name' => 'Manage Review Section', 'navstatus' => "reviews", 'reviews' => $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addcustomerreview(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        $newReview = new reviewsection;
        $newReview->review = $data['review'];
        $newReview->user_name = ucfirst($data['user_name']);

        //set session
        if ($newReview->save()) {
            session(['status' => "1", 'msg' => 'Review Added is successfully']);
        } else {
            session(['status' => "0", 'msg' => 'Review is not Added']);
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function editreview($id)
    {
        $id = base64_decode($id);
        $review = reviewsection::find($id);
        //dd($review);
        return view('admin.editreview', ['page_name' => 'Edit Review Section', 'navstatus' => "reviews", 'review' => $review]);
    }

    /**
     * Display the specified resource.
     */
    public function updatereview(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        $update = reviewsection::where('id', $request->id)
            ->update($data);

        if ($update) {
            session(['status' => "1", 'msg' => 'Review Update is successful']);
        } else {
            session(['status' => "0", 'msg' => 'Review is not Updated']);
        }

        return redirect('/adminreviewmanage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = base64_decode($request->id);
        //echo json_encode(array('status' => 1, 'msg' => $id));
        $review = reviewsection::where('id', $id)->delete();

        if ($review) {
            echo json_encode(array('status' => 1, 'msg' => "true"));
        } else {
            echo json_encode(array('status' => 0, 'msg' => "false"));
        }
    }
}
