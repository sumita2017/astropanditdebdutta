<?php

namespace App\Http\Controllers;

use App\Models\zodiac;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorezodiacRequest;
use App\Http\Requests\UpdatezodiacRequest;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;


class ZodiacController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function zodiacsigns()
    {
        $zodiacdata = zodiac::get();
        //dd($zodiacdata);
        return view('admin.zodiacsigns', ['page_name' => 'Manage Zodiac Signs', 'navstatus' => "horoscope", 'zodiacdata' => $zodiacdata]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updatezodiacimage(Request $request)
    {
        $data = $request->except('_token');

        //dd($data);
        if ($request->hasFile('zodiacimage')) {
            $file = $request->file('zodiacimage');
            $ext = $file->getClientOriginalExtension();
            $filename = 'Zodiac' . time() . '.' . $ext;
            $image = Image::read($file);

            $image->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $updatezodiac = [];
            if ($image->save(public_path('zodiac') . '/' . $filename)) {
                $updatezodiac['image'] = $filename;
            }
        } else {
            $filename = $data['oldimage'];
        }

        $updatezodiac['planet'] = $data['planet'];
        $update = zodiac::where('id', $data['zodiacid'])
            ->update($updatezodiac);
        //dd($data['zodiacid']);

        if ($update) {
            print_r(json_encode(['status' => 1, 'msg' => "true", 'file' => $filename, 'id' => $data['zodiacid'], 'planet' => $data['planet']]));
        } else {
            print_r(json_encode(['status' => 0, 'msg' => "false"]));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorezodiacRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(zodiac $zodiac)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(zodiac $zodiac)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatezodiacRequest $request, zodiac $zodiac)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(zodiac $zodiac)
    {
        //
    }
}
