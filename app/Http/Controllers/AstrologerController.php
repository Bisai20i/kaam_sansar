<?php

namespace App\Http\Controllers;

use App\Models\Astrologer;
use Illuminate\Http\Request;
use App\Models\Kundali;
use App\Models\KundaliMatching;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AstrologerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Retrive all detail
         $kundali = Kundali::orderBy('created_at','desc')->simplePaginate(10);
         return view ('backend.kundali.lists',compact('kundali'));
     }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validates request
        $validator =Validator::make($request->all(),[
            'kundaliId' => 'nullable|exists:kundalis,id',
            'kundaliMatchingId' => 'nullable|exists:kundali_matchings,id',
            'astrologerName' => 'nullable|string|max:255',
            'astrologerPhone' => 'nullable|string|max:20',
            'astrologerLocation' => 'nullable|string|max:255',
            'astroVideoLink' => 'nullable|url',
            'status' => 'nullable|string|in:Review,Approved,Rejected',
            'publishStatus' => 'nullable|string|in:publish,unpublish',
        ]);
                // Handle validation errors
                if ($validator->fails()) {
                    Log::error('Validation errors: ', $validator->errors()->toArray());
                        return redirect()->back()->withErrors($validator->errors())->withInput();
                }
                        //create new record
                        $astrologer = new Astrologer();

        $astrologer->kundaliId = $request->input('kundaliId');
        $astrologer->kundaliMatchingId = $request->input('kundaliMatchingId');
        $astrologer->astrologerName = $request->input('astrologerName');
        $astrologer->astrologerPhone = $request->input('astrologerPhone');
        $astrologer->astrologerLocation = $request->input('astrologerLocation');
        $astrologer->astroVideoLink = $request->input('astroVideoLink');
        $astrologer->status = $request->input('status'); // Default to Review
        $astrologer->publishStatus = $request->input('publishStatus','publish'); // Default to publish
        $astrologer->save();
        return redirect()->route('astrologer.index')->with('success','Astrolger respond succesfully craeted');
                        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Astrologer  $astrologer
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request , $id)

    {
        $kundali = Kundali::findOrFail($id);

        $astrologer = Astrologer::where('kundaliId', $id)->first();


        
    
        return view('backend.kundali.show', compact('astrologer','kundali'));
    }

    public function view($type, $id)
    {
        if ($type === 'kundali') {
            $kundali = Kundali::findOrFail($id);
            $astrologer = Astrologer::where('kundaliId', $id)->first();
            return view('backend.kundali.show', compact('kundali', 'astrologer'));
        }
    
        if ($type === 'matching') {
            $kundaliMatching = KundaliMatching::findOrFail($id);
            $astrologer = Astrologer::where('kundaliMatchingId', $id)->first();
            return view('backend.kundalimatching.show', compact('kundaliMatching', 'astrologer'));
        }
    
        abort(404);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Astrologer  $astrologer
     * @return \Illuminate\Http\Response
     */
    public function edit(Astrologer $astrologer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Astrologer  $astrologer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Astrologer $astrologer)
    {

        //validates request
        $validator =Validator::make($request->all(),[
            'kundaliId' => 'nullable|exists:kundalis,id',
            'kundaliMatchingId' => 'nullable|exists:kundali_matchings,id',
            'astrologerName' => 'nullable|string|max:255',
            'astrologerPhone' => 'nullable|string|max:20',
            'astrologerLocation' => 'nullable|string|max:255',
            'astroVideoLink' => 'nullable|url',
            'status' => 'nullable|string|in:Review,Approved,Rejected',
            'publishStatus' => 'nullable|string|in:publish,unpublish',
        ]);
                // Handle validation errors
                if ($validator->fails()) {
                    Log::error('Validation errors: ', $validator->errors()->toArray());
                        return redirect()->back()->withErrors($validator->errors())->withInput();
                }

                        //create new record
                        $astrologer = Astrologer::where('kundaliId', $astrologer->kundaliId)->firstOrFail();

        $astrologer->kundaliId = $request->input('kundaliId');
        $astrologer->kundaliMatchingId = $request->input('kundaliMatchingId');
        $astrologer->astrologerName = $request->input('astrologerName');
        $astrologer->astrologerPhone = $request->input('astrologerPhone');
        $astrologer->astrologerLocation = $request->input('astrologerLocation');
        $astrologer->astroVideoLink = $request->input('astroVideoLink');
        $astrologer->status = $request->input('status'); // Default to Review
        $astrologer->publishStatus = $request->input('publishStatus','publish'); // Default to publish
        $astrologer->save();
        return redirect()->route('astrologer.index')->with('success','Astrolger respond succesfully updated');
                        
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Astrologer  $astrologer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Astrologer $astrologer)
    {
        //
    }
}
