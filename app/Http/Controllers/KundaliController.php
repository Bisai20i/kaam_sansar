<?php
namespace App\Http\Controllers;

use App\Models\Astrologer;
use App\Models\Kundali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class KundaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Retrive all detail
        $kundali = Kundali::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('backend.kundali.lists', compact('kundali'));
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
        //check if the request is from mobile  using request_type
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Get the authenticated user
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if (! $user) {
            return $isMobile
            ? $this->responseError('Unauthorized', 401)
            : redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        Log::info('Authenticated Job Seeker ID: ' . $user->id);

        $jobSeekerId  = $user->id;
        $emailAddress = $user->emailAddress;
        $phoneNumber  = $user->phoneNumber;

        // Validate request data
        $validator = Validator::make($request->all(), [
            'personName'         => 'required|string|max:255',
            'personDateOfBirth'  => 'required',
            'personPlaceOfBirth' => 'required|string|max:255',
            'personTimeOfBirth'  => 'required|string|max:255',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return $isMobile
            ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
            : redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // Create new Kundali record
        $kundali                     = new Kundali();
        $kundali->jobSeekerId        = $jobSeekerId;
        $kundali->emailAddress       = $emailAddress;
        $kundali->phoneNumber        = $phoneNumber;
        $kundali->personName         = $request->input('personName');
        $kundali->personDateOfBirth  = $request->input('personDateOfBirth');
        $kundali->personPlaceOfBirth = $request->input('personPlaceOfBirth');
        $kundali->personTimeOfBirth  = $request->input('personTimeOfBirth');
        $kundali->Query1             = $request->input('query1');
        $kundali->Query2             = $request->input('query2');
        $kundali->Query3             = $request->input('query3');
        // Save the record to the database
        $kundali->save();
        return $isMobile
        ? $this->responseSuccess('kundali created successfully', $kundali)
        : $this->responseSuccess('kundali created successfully', $kundali);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kundali  $kundali
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $kundali    = Kundali::findOrFail($id);
        $astrologer = Astrologer::where('kundaliId', $id)->first();

        return view('backend.kundali.show', compact('kundali', 'astrologer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kundali  $kundali
     * @return \Illuminate\Http\Response
     */
    public function edit(Kundali $kundali)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kundali  $kundali
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Validate request data
        $validator = Validator::make($request->all(), [
            'personName'         => 'required|string|max:255',
            'personDateOfBirth'  => 'required|date',
            'personPlaceOfBirth' => 'required|string|max:255',
            'personTimeOfBirth'  => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // Update Kundali record
        $kundali                     = Kundali::findOrFail($id);
        $kundali->personName         = $request->personName;
        $kundali->personDateOfBirth  = $request->personDateOfBirth;
        $kundali->personPlaceOfBirth = $request->personPlaceOfBirth;
        $kundali->personTimeOfBirth  = $request->personTimeOfBirth;

        $kundali->save();
        return redirect()->route('kundali.index')->with('success', 'Kundali updated successfully');
    }

    /**
     * Handle error response.
     */
    protected function responseError($message, $statusCode, $errors = [])
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'errors'  => $errors,
        ], $statusCode);
    }
    /**
     * Handle success response.
     */
    protected function responseSuccess($message, $data = [], $statusCode = 200)
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ], $statusCode);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kundali  $kundali
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get the id to be deleted
        $kundali = Kundali::findOrFail($id);
        $kundali->Delete();
        return redirect()->route('kundalidetail.index')->with('success', 'kundali deleted successfully');
    }

    public function frontendKundaliList($id = null)
    {
        $user        = Auth::guard('job_seekers')->user();
        $kundali     = Kundali::where('jobSeekerId', $user->id)->orderBy('created_at', 'desc')->get();
        $editKundali = $id ? Kundali::where('jobSeekerId', $user->id)->findOrFail($id) : null;

        return view('frontend.profile.partials.my-kundali', compact('kundali', 'editKundali'));
    }

    public function frontendKundaliEdit($id)
    {
        $kundali = Kundali::findOrFail($id);             // Get the record by ID
        return view('kundali.edit', compact('kundali')); // Send data to the edit view
    }
    public function frontendUpdate(Request $request, $id)
    {

        $request->validate([
            'personName'         => 'required|string|max:255',
            'day'                => 'required|numeric|min:1|max:31',
            'month'              => 'required|string|max:20', // you might want to validate month differently
            'year'               => 'required|numeric|min:1900|max:' . date('Y'),
            'personPlaceOfBirth' => 'required|string|max:255',
            'hour'               => 'required|numeric|min:0|max:23',
            'minute'             => 'required|numeric|min:0|max:59',
            'second'             => 'required|numeric|min:0|max:59',
            'query1'             => 'required|string',
            'query2'             => 'required|string',
            'query3'             => 'required|string',
        ]);

// Log::info('Validation passed');

        $kundali = Kundali::findOrFail($id);

        // Convert day, month, year to a date string (assuming month is a month name or number)
        // If month is name like "March", convert to number:
        $monthNum = date('m', strtotime($request->month));

        $dob = $request->year . '-' . $monthNum . '-' . str_pad($request->day, 2, '0', STR_PAD_LEFT);

        // Convert time parts to HH:MM:SS
        $hour   = str_pad($request->hour, 2, '0', STR_PAD_LEFT);
        $minute = str_pad($request->minute, 2, '0', STR_PAD_LEFT);
        $second = str_pad($request->second ?? '00', 2, '0', STR_PAD_LEFT);
        $time   = $hour . ':' . $minute . ':' . $second;

        $kundali->personName         = $request->personName;
        $kundali->personDateOfBirth  = $dob;
        $kundali->personPlaceOfBirth = $request->personPlaceOfBirth;
        $kundali->personTimeOfBirth  = $time;
        $kundali->Query1             = $request->query1;
        $kundali->Query2             = $request->query2;
        $kundali->Query3             = $request->query3;

        $kundali->save();

        return redirect()->back()->with('success', 'Kundali updated successfully.');
    }

    public function frontendDelete($id)
    {
        $kundali = Kundali::findOrFail($id);
        $kundali->delete();

        return redirect()->route('jobseeker.kundali')->with('success', 'Kundali deleted successfully.');
    }
}
