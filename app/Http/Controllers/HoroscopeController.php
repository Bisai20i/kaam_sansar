<?php

namespace App\Http\Controllers;

use App\Models\Horoscope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class HoroscopeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //retrive all horoscope detail

        $type = $request->get('type', 'daily');  // Default to 'daily' if no type is passed
        $horoscopes = Horoscope::where('type', $type)->get();        
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';

        if ($isMobile) {
            return response()->json($horoscopes);
        } else {
            return view('backend.horoscope.lists', compact('horoscopes','type'));
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //redirect to create page
        return view('backend.horoscope.create');
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validated request
        $validator = Validator::make($request->all(), [
            'zodiacSignEnglish' => 'required|string',
            'zodiacSignNepali' => 'required|string',
            'nameStartLetter' => 'required|string',
            'birthMonth' => 'required|string',
            'contentNp' => 'required|string',
            'contentEn' => 'required|string',
            'publishDate' => 'required|string',
            'type' => 'required|in:daily,weekly,monthly,yearly',
            'zodiacImgNepali' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'zodiacImgEnglish' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        // Handle validation errors
        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
                return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        //slug created
        $zodiacslug = $this->generateUniqueSlug($request->zodiacSignEnglish,'zodiacSignSlug');
        $typeslug = $this->generateUniqueSlug($request->zodiacSignEnglish,'typeSlug');
        

        // Error handling 
        $errors = [];

        if ($zodiacslug === null) {
            $errors['zodiacSignEnglish'] = 'The zodiac sign "' . $request->zodiacSignEnglish . '" already exists. Please choose a different name.';
        }
        if ($typeslug === null) {
            $errors['type'] = 'The type "' . $request->type . '" already exists for this zodiac sign. Please choose a different type.';
        }

        //handle zodaic image

        $zodiacImgNepali = handleUpload('zodiacImgNepali');
        $zodiacImgEnglish = handleUpload('zodiacImgEnglish');

        //create new horoscope record
         $horoscope = new Horoscope();
         $horoscope->zodiacSignEnglish =$request->input('zodiacSignEnglish');
         $horoscope->zodiacSignNepali =$request->input('zodiacSignNepali');
         $horoscope->type =$request->input('type');
         $horoscope->contentEn=$request->input('contentEn');
         $horoscope->contentNp=$request->input('contentNp');
         $horoscope->publishDate=$request->input('publishDate');
         $horoscope->nameStartLetter=$request->input('nameStartLetter');
         $horoscope->birthMonth=$request->input('birthMonth');
         $horoscope->zodiacSignSlug=$zodiacslug;
         $horoscope->typeSlug=$typeslug;
         $horoscope->zodiacImgNepali=$zodiacImgNepali;
         $horoscope->zodiacImgEnglish=$zodiacImgEnglish;
        //save to database
         $horoscope->save();

         //redirect back with success message

         return redirect()->route('horoscope.index')->with('succes','Horoscope created successfully');




    }
    //slug generated function

    private function generateUniqueSlug($title, $column, $id = 0)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;

        // Get existing slugs
        $existingSlugs = Horoscope::where('id', '!=', $id)
            ->where($column, 'LIKE', "{$slug}%")
            ->pluck($column)
            ->toArray();

        if (in_array($slug, $existingSlugs)) {
            return null; // Return null if slug exists
        }

        $count = 1;
        while (in_array($slug, $existingSlugs)) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horoscope  $horoscope
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
 //Check if request is from mobile using request_type
 $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';
// get the horoscope detail
$gethoroscope = Horoscope::findOrFail($id);

if (!$gethoroscope){
    return $isMobile
       ? $this->responseError('Horoscope detail not found', 404)
       : redirect()->back()->with('error','Horoscope details not found');
}
 return $isMobile
     ? $this->responseSuccess('Horoscope details found', $gethoroscope)
     : redirect()->back()->with('success', 'Horoscope details found');


}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horoscope  $horoscope
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //edit the respective horoscope detail
        $horoscope = Horoscope::findOrFail($id);
        return view('backend.horoscope.create',compact('horoscope'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horoscope  $horoscope
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'zodiacSignEnglish' => 'required|string',
            'zodiacSignNepali' => 'required|string',
            'nameStartLetter' => 'required|string',
            'birthMonth' => 'required|string',
            'contentNp' => 'required|string',
            'contentEn' => 'required|string',
            'publishDate' => 'required|string',
            'type' => 'required|in:daily,weekly,monthly,yearly',
            'zodiacImgNepali' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'zodiacImgEnglish' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Handle validation errors
        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        // Get the existing horoscope
        $horoscope = Horoscope::find($id);
        
        if (!$horoscope) {
            return redirect()->route('horoscope.index')->with('error', 'Horoscope not found.');
        }
        
        // Slug creation logic using the unique slug method
        $zodiacslug = $this->generateUniqueSlug($request->zodiacSign, 'zodiacSignSlug', $id);
        $typeslug = $this->generateUniqueSlug($request->type, 'typeSlug', $id);
        
        // Error handling for slugs
        $errors = [];
        if ($zodiacslug === null) {
            $errors['zodiacSign'] = 'The zodiac sign "' . $request->zodiacSign . '" already exists. Please choose a different name.';
        }
        if ($typeslug === null) {
            $errors['type'] = 'The type "' . $request->type . '" already exists for this zodiac sign. Please choose a different type.';
        }
        
        // Handle zodiac image upload (only if a new image is provided)
        $zodiacImgNepali = $request->hasFile('zodiacImgNepali') ? $request->file('zodiacImgNepali')->store('zodiac_images') : $horoscope->zodiacImgNepali;
        $zodiacImgEnglish = $request->hasFile('zodiacImgEnglish') ? $request->file('zodiacImgEnglish')->store('zodiac_images') : $horoscope->zodiacImgEnglish;
    
        // Update horoscope record
        $horoscope->zodiacSignEnglish =$request->input('zodiacSignEnglish');
        $horoscope->zodiacSignNepali =$request->input('zodiacSignNepali');
        $horoscope->type =$request->input('type');
        $horoscope->contentEn=$request->input('contentEn');
        $horoscope->contentNp=$request->input('contentNp');
        $horoscope->publishDate=$request->input('publishDate');
        $horoscope->nameStartLetter=$request->input('nameStartLetter');
        $horoscope->birthMonth=$request->input('birthMonth');
        $horoscope->zodiacSignSlug=$zodiacslug;
        $horoscope->typeSlug=$typeslug;
        $horoscope->zodiacImgNepali=$zodiacImgNepali;
        $horoscope->zodiacImgEnglish=$zodiacImgEnglish;
        
        // Save the updated record
        $horoscope->save();
        Log::info('Updated horoscope data: ', $horoscope->toArray());
        
        // Redirect back with success message
        return redirect()->route('horoscope.index')->with('success', 'Horoscope updated successfully');
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horoscope  $horoscope
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete the horoscope
        $horoscope = Horoscope::findOrFail($id);
        $horoscope->delete();
        return redirect()->route('horoscope.index')->with('succes', 'Horoscope deleted successfully');
        
    }

    
     /**
     * Handle error response.
     */
    protected function responseError($message, $statusCode, $errors = [])
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }
    /**
     * Handle success response.
     */
    protected function responseSuccess($message, $data = [], $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
