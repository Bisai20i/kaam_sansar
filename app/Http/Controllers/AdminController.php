<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // Add this import
use Illuminate\Support\Facades\Storage;




class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request)
    {

        $admins = Admin::all();
        Log::info($request->all());



        return view('backend.superadmin.dashboard', ['admins' => $admins]);
    }

    public function loginView()
    {
        return view('auth.admin-login');
    }

    public function create()
    {
        return view('backend.superadmin.adduser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // // return $request;
        // return $request->hasFile('profile_image')?$request->file('profile_image'):$request->file('profile_image');

            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email', 'unique:admins,email'],
                'fullName' => ['required', 'max:200'],
                'roleType' => ['required', 'in:superAdmin,admin,postAdmin,user'],
                'status' => ['in:active,inactive'],
                'location' => 'nullable|string',
                'profile_image' => 'nullable|image|max:2048'
            ]);
    
    
           
    
            // Handle validation failures
            if ($validator->fails()) {
    
                return redirect()->back()->withErrors($validator)->withInput();
            }
        
        
        try {
            // Generate a random OTP
            $randomPassword = Str::random(8);
            $filePath = null;
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
            
                // Get the file extension
                $fileExtension = $file->getClientOriginalExtension();
            
                // Get the file name without extension
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            
                // Generate a unique name using current time and file name
                $newName = time() . '_' . $fileName . '.' . $fileExtension;
            
                // Store the file in 'profile_images' directory on 'public' disk
                $filePath = $file->storeAs('profile_images', $newName, 'public');
            }
            

            // Create the admin account
            $admin = Admin::create([
                'email' => $request->email,
                'password' => bcrypt($randomPassword),
                'fullName' => $request->fullName,
                'roleType' => $request->roleType,
                'status' => 'active',
                'location' => $request->location,
                'profile_image' => $filePath,
                // 'otp' => $otp,
                // 'otpVerified' => false,
                // 'otpExpiry' => now()->addMinutes(5),
            ]);


            // Log the created admin data
            Log::info('Admin created:', ['admin' => $admin]);

            // Send verification email
            Mail::to($admin->email)->send(new VerificationMail($admin, $randomPassword));
            

            // Check request type for response


            // Redirect back for website
            return redirect()->back()->with('success', 'Admin account created successfully! Please check your email to verify your account.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating admin:', ['error' => $e->getMessage()]);



            return redirect()->back()->with('error', 'Failed to create admin account. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {


            return redirect()->route('admin.index')->withErrors('Admin not found.');
        }



        return view('admin.show', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {


            return redirect()->route(route: 'admin.index')->withErrors('Admin not found.');
        }

        if ($admin->profile_image) {
            // Get the file path of the profile image
            $filePath = $admin->profile_image;
    
            // Delete the file from the storage (public disk)
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);


            } 
        }
        $admin->delete();



        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully.');
    }

    public function login(Request $request)
    {
        // Validate the request input
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        // Handle validation failure
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve the admin user securely
        $admin = Admin::where('email', $request->input('email'))->first();

        // Log the admin object for debugging (remove in production)
        Log::info($admin);

        // Check if the admin exists and the password is correct
        if (!$admin || !Hash::check($request->input('password'), $admin->password)) {
            $errorResponse = ['message' => 'Invalid credentials.'];
            return redirect()->back()->withErrors($errorResponse)->withInput();
        }



        // Clear any existing sessions and log in the admin securely
        Auth::guard('admin')->login($admin);

        // Redirect based on the role of the admin
        if ($admin->roleType === 'admin') {
            // Redirect to the admin dashboard
            return  redirect('adminuser/dashboard')->with('success', 'Login successful.');
        }

        if ($admin->roleType === 'superAdmin') {
            // Redirect to the superadmin dashboard
            return  redirect()->route('superadmin.dashboard')->with('success', 'Login successful.');
        }

        if ($admin->roleType === 'postAdmin') {
            // Redirect to the postadmin dashboard
            return  redirect()->route('postadmin.dashboard')->with('success', 'Login successful.');
        }

        // Default redirect (if role doesn't match)
        return  redirect()->route('login')->withErrors(['message' => 'Invalid role.']);
    }







    // public function verifyOtp(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => ['required', 'email', 'exists:admins,email'],
    //         'otp' => ['required', 'digits:4'],
    //     ]);
    //     if ($validator->fails()) {
    //         if ($request->has('request_type') && $request->request_type === 'mobile') {
    //             return response()->json(['errors' => $validator->errors()], 422);
    //         }
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Find the admin by email
    //     $admin = Admin::where('email', $request->email)->first();

    //     // Check if OTP matches and is not expired
    //     if ($admin->otp === $request->otp && $admin->otpExpiry > now()) {
    //         $admin->update([
    //             'otpVerified' => true,
    //             'otp' => null,
    //             'otpExpiry' => null,
    //         ]);

    //         if ($request->has('request_type') && $request->request_type === 'mobile') {
    //             return response()->json([
    //                 'message' => 'Email verified successfully!',
    //             ], 200);
    //         }

    //         return redirect()->route('admin.index')->with('success', 'Email verified successfully!');
    //     }

    //     if ($request->has('request_type') && $request->request_type === 'mobile') {
    //         return response()->json(['message' => 'Invalid or expired OTP.'], 422);
    //     }

    //     return redirect()->back()->with('error', 'Invalid or expired OTP.');
    // }
    public function logout(Request $request)
    {

        // Handle logout for web admins
        Auth::guard('admin')->logout();

        // Clear the session
        $request->session()->invalidate();
        $request->session()->flush();

        // Redirect to the admin login page with a success message
        return redirect()->route('index')->with('success', 'Admin logout successful.');
    }

    public function editadmin(String $id)
    {
        $admin = Admin::findOrFail($id);
        return view('backend.superadmin.adduser', compact('admin'));
    }


    public function updateadmin(Request $request, string $id)
    {
        try{
            $admin = Admin::find($id);

            if (!$admin) {

                return redirect()->route('admin.index')->withErrors('Admin not found.');
            }

            // return $request->all();

            // Validation
            $validator = Validator::make($request->all(), [
                'email' => ['sometimes', 'email', 'unique:admins,email,' . $id],
                'password' => ['nullable', 'min:6'],
                'password_confirmation' => ['nullable', 'same:password'],
                'fullName' => ['sometimes', 'max:200'],
                'roleType' => ['required', 'in:superAdmin,admin,postAdmin'],
                'location' => 'nullable|string',
                'profile_image' => 'nullable|image|max:2048'
            ]);

            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();
            }

            // return $request;

            //check if the file exists update file
            if($request->hasFile('profile_image')){


                $file = $request->file('profile_image');
                
                    // Get the file extension
                $fileExtension = $file->getClientOriginalExtension();
                
                    // Get the file name without extension
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                
                    // Generate a unique name using current time and file name
                $newName = time() . '_' . $fileName . '.' . $fileExtension;
                
                    // Store the file in 'profile_images' directory on 'public' disk
                $filePath = $file->storeAs('profile_images', $newName, 'public');




                if ($admin->profile_image) {
                    // Get the file path of the profile image
                    $oldfilePath = $admin->profile_image;
            
                    // Delete the file from the storage (public disk)
                    if (Storage::disk('public')->exists($oldfilePath)) {
                        Storage::disk('public')->delete($oldfilePath);
        
                    } 
                }

                $admin->profile_image = $filePath;
            }
            

            

            // Update fields
            if ($request->has('email')) {
                $admin->email = $request->email;
            }
            if ($request->has('fullName')) {
                $admin->fullName = $request->fullName;
            }
            if ($request->has('password')) {
                $admin->password = bcrypt($request->password);
            }
            if ($request->has('roleType')) {
                $admin->roleType = $request->roleType;
            }

            // Save admin and debug
            $admin->save();
            Log::info('Admin updated: ', $admin->toArray());


            return redirect()->route('admin.index')->with('success', 'Admin updated successfully.');
        }
        catch(\Exception $e){
            return $e;
        }
        
    }
    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();
        Log::info($admin);

        // Load the respective dashboard based on the user's role
        switch ($admin->roleType) {
            case 'admin':
                $admins = Admin::all();
                return view('backend.admin.dashboard', compact('admins'));

            case 'superAdmin':
                $admins = Admin::all();
                return view('backend.superadmin.dashboard', compact('admins'));

            case 'postAdmin':
                return view('backend.postadmin.dashboard');

            default:
                // Optional: Handle unexpected roles (should not happen if middleware works correctly)
                abort(403, 'Unauthorized role');
        }
    }

    public function superadminindex()
    {
        $admins = Admin::all();
        return view('backend.superadmin.index', compact('admins'));
    }
}
