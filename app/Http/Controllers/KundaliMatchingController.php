<?php

namespace App\Http\Controllers;

use App\Models\KundaliMatching;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class KundaliMatchingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check if the request is from mobile
     
    
        // Retrieve kundali data
        $kundali = KundaliMatching::orderBy('created_at','desc')->simplePaginate(10);
      
    
        return view('backend.kundalimatching.lists', compact('kundali'));
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
        $mobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $user = $mobile ? $request->user() : Auth::guard('job_seekers')->user();
        
        if (!$user) {
            if ($request->ajax() || $mobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                    'errors' => ['Unauthorized access.']
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
    
        $jobSeekerId = $user->id;
    
        $validator = Validator::make($request->all(), [
            'girlDateOfBirth' => 'required',
            'girlPlaceOfBirth' => 'required|string|max:255',
            'girlTimeOfBirth' => 'required|string|max:255',
            'girlName' => 'required|string|max:255',
            'boyName' => 'required|string|max:255',
            'boyDateOfBirth' => 'required',
            'boyPlaceOfBirth' => 'required|string|max:255',
            'boyTimeOfBirth' => 'required|string|max:255',
            'Query1' => 'nullable|string|max:255',
            'Query2' => 'nullable|string|max:255',
            'Query3' => 'nullable|string|max:255',
        ]);
    
        if ($validator->fails()) {
            if ($mobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    
        $kundali = new KundaliMatching();
        $kundali->jobSeekerId = $jobSeekerId;
        $kundali->girlDateOfBirth = $request->girlDateOfBirth;
        $kundali->girlPlaceOfBirth = $request->girlPlaceOfBirth;
        $kundali->girlTimeOfBirth = $request->girlTimeOfBirth;
        $kundali->boyName = $request->boyName;
        $kundali->girlName = $request->girlName;
        $kundali->boyDateOfBirth = $request->boyDateOfBirth;
        $kundali->boyPlaceOfBirth = $request->boyPlaceOfBirth;
        $kundali->boyTimeOfBirth = $request->boyTimeOfBirth;
        $kundali->Query1 = $request->input('Query1', '');
        $kundali->Query2 = $request->input('Query2', '');
        $kundali->Query3 = $request->input('Query3', '');
        $kundali->save();
    
        if ($request->ajax() || $mobile) {
            return response()->json([
                'success' => true,
                'message' => 'Kundali matching created successfully',
                'data' => $kundali
            ]);
        }
        return redirect()->back()->with('success', 'Kundali matching created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KundaliMatching  $kundaliMatching
     * @return \Illuminate\Http\Response
     */
  
     public function show(Request $request, $id)
     {
         $kundali = KundaliMatching::findOrFail($id);
         $astrologer = Astrologer::where('kundaliMatchingId', $id)->first();

         return view('backend.kundalimatching.show', compact('kundali','astrologer'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KundaliMatching  $kundaliMatching
     * @return \Illuminate\Http\Response
     */
    public function edit(KundaliMatching $kundaliMatching)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KundaliMatching  $kundaliMatching
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'girlDateOfBirth' => 'required|string',
            'girlPlaceOfBirth' => 'required|string|max:255',
            'girlTimeOfBirth' => 'required|string|max:255',
            'boyName' => 'required|string|max:255',
            'boyDateOfBirth' => 'required|string',
            'boyPlaceOfBirth' => 'required|string|max:255',
            'boyTimeOfBirth' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $kundali = KundaliMatching::findOrFail($id);
        $kundali->girlDateOfBirth = $request->girlDateOfBirth;
        $kundali->girlPlaceOfBirth = $request->girlPlaceOfBirth;
        $kundali->girlTimeOfBirth = $request->girlTimeOfBirth;
        $kundali->boyName = $request->boyName;
        $kundali->boyDateOfBirth = $request->boyDateOfBirth;
        $kundali->boyPlaceOfBirth = $request->boyPlaceOfBirth;
        $kundali->boyTimeOfBirth = $request->boyTimeOfBirth;
        $kundali->Query1 = $request->input('Query1');
        $kundali->Query2 = $request->input('Query2');
        $kundali->Query3 = $request->input('Query3');
        $kundali->save();

        return redirect()->route('kundalimatching.index')->with('success', 'Kundali matching updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KundaliMatching  $kundaliMatching
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kundali = KundaliMatching::findOrFail($id);
        $kundali->delete();
        return redirect()->route('kundalimatching.index')->with('success', 'Kundali matching deleted successfully');
    }

    protected function responseError($message, $statusCode, $errors = [])
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    protected function responseSuccess($message, $data = [], $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}
