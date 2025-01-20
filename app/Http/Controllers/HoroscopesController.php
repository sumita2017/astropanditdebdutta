<?php

namespace App\Http\Controllers;

use App\Models\horoscopes;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatehoroscopesRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\File;

class HoroscopesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminshow()
    {

        $horoscopedata = horoscopes::get();
        $horoscopedetails = [];
        foreach ($horoscopedata as $horoscope) {
            $horoscopedetails[$horoscope->horoscopetype][$horoscope->id] = $horoscope->filename;
        }
        //dd($horoscopedetails);
        return view('admin.horoscope', ['page_name' => 'Manage horoscopr files', 'navstatus' => "horoscope", 'horoscopedata' => $horoscopedetails]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updatehoroscope(Request $request)
    {
        $data = $request->except('_token');

        if ($request->hasFile('files')) {
            $request->validate([
                'image' => ['required|image|mimes:jpeg,png,jpg,gif,svg']
            ]);
            if (count($data['files']) == 12) {
                foreach ($data['files'] as $file) {
                    $ext = $file->getClientOriginalExtension();
                    $filename = 'horoscope' . time() . '.' . $ext;

                    if ($file->move(public_path('horoscope'), $filename)) {

                        $horoscopedata = horoscopes::select('filename')->where('horoscopetype', $data['horoscopetype'])->get();

                        if (!empty($horoscopedata)) {
                            foreach ($horoscopedata as $horoscope) {
                                if ($horoscope->filename != '') {
                                    unlink(public_path('horoscope/' . $horoscope->filename));
                                }
                            }
                            $update = horoscopes::where('horoscopetype', $data['horoscopetype'])->update(['filename' => $filename]);
                            if ($update) {
                                session(['status' => "1", 'msg' => 'Horoscope updated successful']);
                            } else {
                                session(['status' => "0", 'msg' => 'Horoscope data is not updated']);
                            }
                            return redirect()->back();
                        } else {
                            $newhoroscope = new horoscopes;
                            $newhoroscope->filename = $filename;
                            $newhoroscope->horoscopetype = $data['horoscopetype'];
                            $newhoroscope->show = '1';

                            if ($newhoroscope->save()) {
                                session(['status' => "1", 'msg' => 'Horoscope Add is successful']);
                            } else {
                                session(['status' => "0", 'msg' => 'Horoscope data is not Added']);
                            }
                            return redirect()->back();
                        }
                    }
                }
            } else {
                $horoscopedata = horoscopes::select('filename')->where('horoscopetype', $data['horoscopetype'])->get();
                $totalhoroscope = count($horoscopedata) + count($data['files']);
                if ($totalhoroscope <= 12) {
                    foreach ($data['files'] as $file) {
                        $ext = $file->getClientOriginalExtension();
                        $filename = 'horoscope' . time() . '.' . $ext;

                        if ($file->move(public_path('horoscope'), $filename)) {

                            $newhoroscope = new horoscopes;
                            $newhoroscope->filename = $filename;
                            $newhoroscope->horoscopetype = $data['horoscopetype'];
                            $newhoroscope->show = '1';
                            if ($newhoroscope->save()) {
                                session(['status' => "1", 'msg' => 'Horoscope Add is successful']);
                            } else {
                                session(['status' => "0", 'msg' => 'Horoscope data is not Added']);
                            }
                            return redirect()->back();
                        }
                    }
                } else {
                    session(['status' => "0", 'msg' => 'Unable to upload more than 12 files']);
                    return redirect()->back();
                }
            }
        } else {
            session(['status' => "0", 'msg' => 'No file is uploaded']);
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.mainly creating health table, education, personal life ,career table and storing the file as well in foldar. both data table and folder value can be updated any time . 
     */

    public function horoscopedata()
    {
        return view('admin.horoscopedata', ['page_name' => 'Manage Horoscopr Data', 'navstatus' => "horoscope"]);
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $line) {
            $data = str_getcsv($line);

            Product::create([
                'name' => $data[0],
                'price' => $data[1],
                // Add more fields as needed
            ]);
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }

    public function export()
    {
        $products = Product::all();
        $csvFileName = 'products.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Name', 'Price']); // Add more headers as needed

        foreach ($products as $product) {
            fputcsv($handle, [$product->name, $product->price]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
    /**
     * Display the specified resource.
     */
    public function show(horoscopes $horoscopes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(horoscopes $horoscopes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatehoroscopesRequest $request, horoscopes $horoscopes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(horoscopes $horoscopes)
    {
        //
    }
}
