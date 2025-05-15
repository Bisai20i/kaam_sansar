<?php
namespace App\Http\Controllers;

use App\Mail\OTPMail;
use App\Models\Aboard;
use App\Models\Advertisement;
use App\Models\AdvertisementCategory;
use App\Models\JobBookmark;
use App\Models\JobPost;
use App\Models\JobSeeker;
use App\Models\ProductCategory;
use App\Rules\ValidPhoneNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class JobSeekerController extends Controller
{
    
    /**
     * Register a new job seeker.
     */

    public function register(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $validator = Validator::make($request->all(), [
            'first_name'            => 'required|max:255',
            'last_name'             => 'required|max:255',
            'email_or_phone'        => 'required|in:email,phone', // Ensure the value is either "email" or "phone"
            'email'                 => [
                'nullable',
                'required_if:email_or_phone,email', // Required if email_or_phone is "email"
                'email',
                'unique:job_seekers,emailAddress',
            ],
            'phone_number'          => [
                'nullable',
                'required_if:email_or_phone,phone', // Required if email_or_phone is "phone"
                new ValidPhoneNumber($request->country_code),
                'unique:job_seekers,phoneNumber',
            ],
            'country_code'          => [
                'nullable',
                'required_if:email_or_phone,phone', // Required if email_or_phone is "phone"
                'string',
            ],
            'country'               => [
                'required',
                'string',
            ],
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            'acceptedTerms'         => 'required|accepted',
            'whoAmI'                => ['required', 'in:student,worker'],

        ], [
            'acceptedTerms.required'   => 'You must agree to the terms and conditions.',
            'acceptedTerms.accepted'   => 'You must agree to the terms and conditions.',
            'email.required_if'        => 'The email field is required when registering with email.',
            'phone_number.required_if' => 'The phone number field is required when registering with phone.',
            'country_code.required_if' => 'The country code field is required when registering with phone.',
        ]);

        if ($validator->fails()) {
            if ($isMobile) {
                return $this->responseError(
                    'Validation failed. Please check your inputs.',
                    422,
                    [
                        'errors'         => $validator->errors(),
                        'email_or_phone' => $request->email_or_phone, // Pass the email_or_phone value
                    ]
                );
            }
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with('email_or_phone', $request->email_or_phone); // Pass the email_or_phone value
        }

        // Format phone number for consistent storage
        $phoneUtil            = PhoneNumberUtil::getInstance();
        $formattedPhoneNumber = null;

        if ($request->email_or_phone === 'phone') {
            $formattedPhoneNumber = $phoneUtil->format(
                $phoneUtil->parse($request->phone_number, strtoupper($request->country_code)),
                \libphonenumber\PhoneNumberFormat::E164
            );

            //     // Check if phone number already exists
            //     if (JobSeeker::where('phoneNumber', $formattedPhoneNumber)->exists()) {
            //         if ($isMobile) {
            //             return $this->responseError('Phone number already registered.', 422);
            //         }
            //         return redirect()
            //         ->withErrors(['phone_number' => 'Phone number already registered.'])
            //         ->withInput();            }
        }

        $otp       = rand(1000, 9999);
        $otpExpiry = now()->addMinutes(1);

        $user = JobSeeker::create([
            'phoneNumber'    => $formattedPhoneNumber,
            'password'       => Hash::make($request->password),
            'firstName'      => $request->first_name,
            'lastName'       => $request->last_name,
            'emailAddress'   => $request->email ?? null,
            'otp'            => $otp,
            'otpVerified'    => false,
            'otpExpiry'      => $otpExpiry,
            'acceptedTerms'  => $request->has('acceptedTerms'),
            'countryCode'    => $request->country_code,
            'country'        => $request->country,
            'whoAmI'         => $request->whoAmI,
            'email_or_phone' => $request->email_or_phone,
        ]);

        // Send OTP based on registration method
        if ($request->email_or_phone === 'phone') {
            // Send OTP via SMS
            $this->sendOTPViaSMS($formattedPhoneNumber, $otp);
        } else {

            Mail::to($user->emailAddress)->send(new OTPMail($user, $otp));
        }

        if ($isMobile) {
            // Revoke old tokens before creating a new one to ensure session exclusivity
            $user->tokens()->delete();

            // Create a new token for API login
            $token = $user->createToken('JobSeekerToken')->plainTextToken;

            return $this->responseSuccess(
                'Registration successful! Use the OTP for verification.',
                [
                    'jobSeeker' => array_merge($user->toArray(), ['token' => $token], ['email_or_phone' => $user->email_or_phone]),
                ],
                201
            );
        }
        // Login the user only in the web session
        Auth::guard('job_seekers')->login($user);
        session()->put('email_or_phone', $user->email_or_phone);

        return redirect()->route('jobseeker.otp_page')->with(
            'success',
            "Registration successful! Use the OTP for verification sent to your {$user->email_or_phone}."
        );
    }

    // Method to send OTP via SMS
    private function sendOTPViaSMS($phoneNumber, $otp)
    {
        // Implement your SMS sending logic here
        // Example: Use a third-party SMS service like Twilio
        Log::info("Sending OTP to phone: $phoneNumber, OTP: $otp");
        // Example: Twilio::sendSMS($phoneNumber, "Your OTP is: $otp");
    }

    /**
     * Display the OTP verification page.
     *
     * @return \Illuminate\Contracts\View\View
     */

    /******  15fc6e71-8ce0-4ae9-be4b-92575e3607a9  *******/

    public function otp_page()
    {
        // Try to get authenticated user first
        $user = Auth::guard('job_seekers')->user();

        // If no authenticated user, try to get from session (forgot password flow)
        if (! $user) {
            $email_or_phone = session()->get('email_or_phone');
            if ($email_or_phone == 'phone') {
                $phone_number = session()->get('phone_number');

                $user = JobSeeker::where('phoneNumber', $phone_number)->first();
            } elseif ($email_or_phone == 'email') {
                $email = session()->get('email');

                $user = JobSeeker::where('emailAddress', $email)->first();
            }

            // If no user is found, redirect with an error
            if (! $user) {
                return redirect()->back()
                    ->with('error', 'User not found.');
            }
        }

        // Check OTP expiry
        $otpExpiry   = $user->otpExpiry;
        $currentTime = Carbon::now();

        // Determine OTP status
        if ($otpExpiry === null || $otpExpiry->isPast()) {
            $timeLeftInSeconds = 0;
            $canResend         = true;
            $message           = 'OTP has expired. Please resend OTP again.';
        } else {
            $timeLeftInSeconds = $currentTime->diffInSeconds($otpExpiry, false);
            $canResend         = false;
            $message           = 'OTP has been sent. Please enter the OTP within ' . $timeLeftInSeconds . ' seconds.';
        }

        // Prepare data for the view
        $data = compact('user', 'timeLeftInSeconds', 'canResend');

        // Return the view directly
        return view('frontend.auth.otp-validation', $data)
            ->with('info', $message);
    }
    public function otpVerify(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (! $user) {
            if ($isMobile) {
                return $this->responseError('User not found.', 404);
            }
            return redirect()->back()->with('error', 'User not found.');
        }

        $validator = Validator::make($request->all(), [
            'otp' => 'required|min:4|numeric',
        ]);

        if ($validator->fails()) {
            if ($isMobile) {
                return $this->responseError(
                    'Validation failed. Please check your inputs.',
                    422,
                    $validator->errors()
                );
            }

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if ($user->otpExpiry && now()->greaterThan($user->otpExpiry)) {
            if ($isMobile) {
                return $this->responseError('OTP expired. Please request a new OTP.', 400);
            }

            return redirect()->back()->with('error', 'OTP expired. Please request a new OTP.');
        }

        if ($user->otpVerified) {
            if ($isMobile) {
                return $this->responseError('User already verified.', 400);
            }
            return redirect()->back()->with('info', 'User already verified.');
        }

        if ((int) $user->otp !== (int) $request->otp) {

            if ($isMobile) {
                return $this->responseError('Invalid OTP. Please try again.', 400);
            }

            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }
        $user->update([
            'otpVerified'     => true,
            'emailVerifiedAt' => now(),
            'otp'             => null,
            'otpExpiry'       => null,
        ]);
        if (session()->has('profile_update_data')) {
            $profileData = session()->get('profile_update_data');
            session()->forget('profile_update_data');
            return $this->updateProfile(new Request($profileData), $user->id);
        }
        if ($isMobile) {
            return $this->responseSuccess('OTP verified successfully.', $user);
        }
        $redirectUrl = $request->session()->pull('redirect_url', route('index'));
        session()->forget('redirect_url');
        return redirect($redirectUrl)->with('success', 'You have successfully logged in.');
    }

    public function login(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $isEmail = $request->input('email_or_phone') === 'email';

        // Set validation rules based on the request type and input type
        $rules = $isMobile
        ? ($isEmail
            ? ['email' => 'required|email', 'password' => 'required', 'email_or_phone' => 'required']
            : ['phone_number' => 'required|numeric', 'country_code' => 'required|string', 'password' => 'required', 'email_or_phone' => 'required'])
        : ($isEmail
            ? ['login_email' => 'required|email', 'login_password' => 'required', 'email_or_phone' => 'required|in:email']
            : ['login_phone_number' => 'required|numeric', 'country_code' => 'required|string', 'login_password' => 'required', 'email_or_phone' => 'required|in:phone']);

        // Custom error messages for web requests
        $messages = $isMobile ? [] : [
            'login_phone_number.required'   => 'The phone number is required.',
            'login_password.required'       => 'The password is required.',
            'country_code.required'         => 'The country code is required.',
            'email_or_phone.required'       => 'The email or phone is required.',
            'email_or_phone.email_or_phone' => 'Please enter a valid email or phone number.',
            'login_email.required'          => 'The email field is required.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $isMobile
            ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
            : redirect()->back()->withErrors($validator)->withInput();
        }

        // Determine the credentials based on the input type
        $credentials = $isEmail
        ? [
            'emailAddress' => $isMobile ? $request->email : $request->login_email,
            'password'     => $isMobile ? $request->password : $request->login_password,
        ]
        : [
            'phoneNumber' => $this->formatPhoneNumber(
                $isMobile ? $request->phone_number : $request->login_phone_number,
                $request->country_code
            ),
            'password'    => $isMobile ? $request->password : $request->login_password,
        ];

        // Validate phone number format
        if (! $isEmail && (! isset($credentials['phoneNumber']) || empty($credentials['phoneNumber']))) {
            return $isMobile
            ? $this->responseError('Invalid phone number format.', 422)
            : back()->withErrors(['email_or_phone' => 'Invalid phone number format.'])->withInput();
        }

        // Validate email format
        if ($isEmail && (! isset($credentials['emailAddress']) || empty($credentials['emailAddress']))) {
            return $isMobile
            ? $this->responseError('Invalid email format.', 422)
            : back()->withErrors(['email_or_phone' => 'Invalid email format.'])->withInput();
        }

        // Fetch user based on credentials
        $user = $isEmail
        ? JobSeeker::where('emailAddress', $credentials['emailAddress'])->first()
        : JobSeeker::where('phoneNumber', $credentials['phoneNumber'])->first();

        // Validate user and password
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            if ($isEmail) {
                return $isMobile
                ? $this->responseError('Invalid credentials.', 401)
                : redirect()->back()->withErrors(['login_email' => 'Invalid email or password.'])->withInput();
            } else {
                return $isMobile
                ? $this->responseError('Invalid credentials.', 401)
                : redirect()->back()->withErrors(['login_phone_number' => 'Invalid phone number or password.'])->withInput();
            }
        }

        // Handle authentication based on request type
        if ($isMobile) {
            // Revoke all previous API tokens and create a new one
            $user->tokens()->delete();
            $token = $user->createToken('JobSeekerToken')->plainTextToken;
        } else {
            // Login the user in the web session
            Auth::guard('job_seekers')->login($user);
        }

        // Update user status
        $user->update(['status' => 'active']);

        // Check OTP verification
        if ($user->otpVerified != 1) {
            return $isMobile
            ? $this->responseSuccess('OTP is not verified. Please verify your OTP.', ['jobSeeker' => array_merge($user->toArray(), ['token' => $token ?? null])])
            : redirect()->route('jobseeker.otp_page')->with('info', 'OTP is not verified. Please verify your OTP.');
        }

        // Return success response
        return $isMobile
        ? $this->responseSuccess('Login successful.', ['jobSeeker' => array_merge($user->toArray(), ['token' => $token ?? null])])
        : redirect($request->session()->pull('redirect_url', route('index')))->with('success', 'You have successfully logged in.');
    }
    private function formatPhoneNumber($phoneNumber, $countryCode)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $parsedNumber = $phoneUtil->parse($phoneNumber, strtoupper($countryCode));
            return $phoneUtil->isValidNumber($parsedNumber)
            ? $phoneUtil->format($parsedNumber, \libphonenumber\PhoneNumberFormat::E164)
            : null;
        } catch (NumberParseException $e) {
            return null;
        }
    }

    public function logout(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->request_type === 'mobile';

        // Determine the user based on the platform (web or mobile)
        $user = $isMobile
        ? $request->user()                    // Sanctum token authentication
        : Auth::guard('job_seekers')->user(); // Web authentication

        if ($user) {
            if ($isMobile) {
                // Revoke the current access token for mobile users
                $user->currentAccessToken()->delete();
                return $this->responseSuccess('User logged out successfully.');
            } else {
                // Logout web users and invalidate the session
                Auth::guard('job_seekers')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('index')->with('success', 'You have successfully logged out.');
            }
        } else {
            return $isMobile
            ? $this->responseError('User not found or unauthorized. Please log in.', 401)

            : redirect()->back()->with('error', 'User not found or unauthorized. Please log in.');
        }
    }
    public function resendOtp(Request $request)
    {
        // Determine the user type based on the request (mobile or job seekers)
        $isMobile = $request->has('request_type') && $request->request_type === 'mobile';
        $user     = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // If user is not authenticated, return an error response
        if (! $user) {
            return $this->responseError(
                'User not found or unauthorized. Please log in.',
                401
            );
        }
        $email_or_phone = $isMobile ? $request->email_or_phone : $user->email_or_phone;

        try {
            // Check if the OTP expiry exists and is not expired
            if ($user->otpExpiry == null || Carbon::now()->greaterThan($user->otpExpiry)) {
                                               // Generate a new OTP and expiry time (1 minute)
                $otp       = rand(1000, 9999); // Random 4-digit OTP
                $otpExpiry = Carbon::now()->addMinutes(1);

                // Update the user's OTP and expiry time in the database
                $user->update([
                    'otp'         => $otp,
                    'otpExpiry'   => $otpExpiry,
                    'otpVerified' => false,
                ]);

                // Send OTP via the selected method
                if ($email_or_phone === 'email') {
                    Mail::to($user->emailAddress)->send(new OTPMail($user, $otp));
                } else {
                    $this->sendOTPViaSMS($user, $otp);
                }

                $successMessage = 'OTP resent successfully. Please check your ' . $user->email_or_phone . ' or request a new OTP.';

                // Return response based on request type
                if ($isMobile) {
                    return $this->responseSuccess($successMessage, ['user' => $user]);
                } else {
                    session()->forget('email_or_phone');
                    return redirect()->back()->with('success', $successMessage);
                }
            } else {
                // Error message for already sent OTP
                $errorMessage = 'OTP already sent. Please check your ' . $user->email_or_phone . ' or request a new OTP.';

                // Return response based on request type
                if ($isMobile) {
                    return $this->responseError($errorMessage, 400);
                } else {
                    return redirect()->back()->with('error', $errorMessage);
                }
            }
        } catch (\Exception $e) {
            // Log the error message and return a generic error response
            Log::error('Error resending OTP: ' . $e->getMessage());

            $errorMessage = 'An error occurred while resending the OTP. Please try again later.';

            // Return response based on request type
            if ($isMobile) {
                return $this->responseError($errorMessage, 500);
            } else {
                return redirect()->back()->with('error', $errorMessage);
            }
        }
    }
    public function forgotResendOtp(Request $request)
    {
        $isMobile = $request->input('request_type') === 'mobile';

        $email_or_phone = $isMobile ? $request->input('email_or_phone') : session('email_or_phone');

        if ($email_or_phone === 'email') {
            $isEmail = true;
        } else {
            $isEmail = false;
        }

        if ($isMobile) {
            $rules = $isEmail
            ? ['email' => 'required|email', 'email_or_phone' => 'required|in:email']
            : [
                'country_code'   => 'required|string',
                'phone_number'   => 'required|numeric',
                'email_or_phone' => 'required|in:phone',
            ];

            $messages = [
                'email.required'        => 'The email field is required.',
                'country_code.required' => 'The country code is required.',
                'phone_number.required' => 'The phone number is required.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return $isMobile
                ? $this->responseError('Validation failed.', 422, $validator->errors())
                : redirect()->back()->withErrors($validator->errors());
            }
        }

        try {
            if ($isEmail) {
                $email = $isMobile ? $request->input('email') : session('email');
                $user  = JobSeeker::where('emailAddress', $email)->first();
            } else {
                $phoneNumber = $isMobile ? $request->input('phone_number') : session('phone_number');
                $countryCode = $isMobile ? $request->input('country_code') : session('country_code');

                $formattedPhoneNumber = $this->formatPhoneNumber($phoneNumber, $countryCode);
                if (! $formattedPhoneNumber) {
                    return $isMobile
                    ? $this->responseError('Invalid phone number format.', 422)
                    : redirect()->back()->withErrors(['phone_number' => 'Invalid phone number format.'])->withInput();
                }

                $user = JobSeeker::where('phoneNumber', $formattedPhoneNumber)->first();
            }

            if (! $user) {
                return $isMobile
                ? $this->responseError('User not found.', 404)
                : redirect()->back()->with('error', 'User not found.');
            }

            if ($user->otpExpiry && Carbon::now()->lessThan($user->otpExpiry)) {
                return $isMobile
                ? $this->responseError('OTP already sent. Please wait before requesting again.', 400)
                : redirect()->back()->with('error', 'OTP already sent.');
            }

            // Generate OTP
            $otp       = random_int(1000, 9999);
            $otpExpiry = Carbon::now()->addMinutes(1);

            // Update user OTP
            $user->update([
                'otp'         => $otp,
                'otpExpiry'   => $otpExpiry,
                'otpVerified' => false,
            ]);

            // Send OTP
            if ($isEmail) {
                Mail::to($user->emailAddress)->send(new OTPMail($user, $otp));
            } else {
                $this->sendOTPViaSMS($user->phoneNumber, $otp);
            }

            return $isMobile
            ? $this->responseSuccess('OTP resent successfully.', ['user' => $user], 200)
            : redirect()->back()->with('success', 'OTP resent successfully.');
        } catch (\Exception $e) {
            Log::error('Error resending OTP: ' . $e->getMessage(), ['request' => $request->all()]);

            return $isMobile
            ? $this->responseError('An error occurred.', 500)
            : redirect()->back()->with('error', 'An error occurred.');
        }
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function verifyPhonePage()
    {
        return view('frontend.auth.forgot-password');
    }

    public function verifyPhone(Request $request)
    {
        // Debugging: Check what the request contains

        // Determine request type (API or Web)

        $isMobile       = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $email_or_phone = $request->input('email_or_phone') === 'phone' ? 'phone' : 'email';

        // Validation Rules & Messages
        $rules    = [];
        $messages = [];

        if ($email_or_phone == 'phone') {
            $isMobile ?
            $rules = [
                'phone_number'   => 'required|numeric',
                'country_code'   => 'required|string|max:3',
                'email_or_phone' => 'required|in:phone',
            ] : $rules = [
                'forgot_phone_number' => 'required|numeric',
                'country_code'        => 'required|string|max:3',

            ];
            $messages = [
                'forgot_phone_number.required' => 'The phone number is required.',
                'country_code.required'        => 'The country code is required.',
            ];
        } else {
            $isMobile ? $rules = ['email' => 'required|email', 'email_or_phone' => 'required|in:email'] : $rules = ['forgot_email' => 'required|email'];

            $messages = [
                'email.required'            => 'The email field is required.',
                'forgot_email.required'     => 'The email field is required.',
                'forgot_email.forgot_email' => 'Please enter a valid email address.',
            ];
        }

        // Validate Request
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $isMobile
            ? response()->json(['error' => 'Validation failed', 'messages' => $validator->errors()], 422)
            : redirect()->back()->withErrors($validator->errors());
        }

        // Process Phone Verification
        if ($email_or_phone == 'phone') {
            $phoneUtil = PhoneNumberUtil::getInstance();
            try {
                $isMobile ?
                $formattedPhoneNumber = $phoneUtil->format(
                    $phoneUtil->parse($request->input('phone_number'), strtoupper($request->input('country_code'))),
                    \libphonenumber\PhoneNumberFormat::E164
                )
                : $formattedPhoneNumber = $phoneUtil->format(
                    $phoneUtil->parse($request->input('forgot_phone_number'), strtoupper($request->input('country_code'))),
                    \libphonenumber\PhoneNumberFormat::E164
                );
            } catch (\libphonenumber\NumberParseException $e) {
                return $isMobile
                ? response()->json(['error' => 'Invalid phone number format.'], 422)
                : redirect()->back()->with('error', 'Invalid phone number format.');
            }

            // Check if Phone Exists
            $user = JobSeeker::where('phoneNumber', $formattedPhoneNumber)->first();

            if (! $user) {
                $message = 'User phone not found. Please register first.';
                return $isMobile
                ? response()->json(['error' => $message], 404)
                : redirect()->back()->with('error', $message);
            }

            // Generate OTP
            $otp             = rand(1000, 9999);
            $user->otp       = $otp;
            $user->otpExpiry = now()->addMinutes(1);
            $user->save();

            // Send OTP (Implement SMS Service Here)
            $this->sendOTPViaSMS($user, $otp);

            session([
                'phone_number'   => $formattedPhoneNumber,
                'email_or_phone' => $email_or_phone,
                'country_code'   => $request->input('country_code'),
            ]);

            return $isMobile
            ? response()->json(['message' => 'Phone Number Verified and OTP sent to your phone.', 'phone_number' => $formattedPhoneNumber, 'otp' => $otp], 200)
            : redirect()->route('jobseeker.verify-otp-page')->with('success', 'Phone Number Verified and OTP sent to your phone.');
        }

        // Process Email Verification
        if ($email_or_phone == 'email') {
            $isMobile ? $user = JobSeeker::where('emailAddress', $request->input('email'))->first() : $user = JobSeeker::where('emailAddress', $request->input('forgot_email'))->first();

            if (! $user) {
                $message = 'User email not found. Please register first.';
                return $isMobile
                ? response()->json(['error' => $message], 404)
                : redirect()->back()->with('error', $message);
            }

            // Generate OTP for Email (You can use Laravel Notification here)
            $otp             = rand(1000, 9999);
            $user->otp       = $otp;
            $user->otpExpiry = now()->addMinutes(1);
            $user->save();

            // Send OTP via Email (Implement Email Service Here)
            Mail::to($user->emailAddress)->send(new OTPMail($user, $otp));
            session([
                'email'          => $user->emailAddress, // Fixing the property name
                'email_or_phone' => $email_or_phone,
            ]);

            return $isMobile
            ? response()->json(['message' => 'Email Verified and OTP sent to your email.', 'email' => $user->emailAddress, 'otp' => $otp], 200)
            : redirect()->route('jobseeker.verify-otp-page')->with('success', 'Email Verified and OTP sent to your email.');
        }
    }

    public function verifyOtp(Request $request)
    {
        $isMobile       = $request->input('request_type') === 'mobile';
        $email_or_phone = $isMobile ? $request->input('email_or_phone') : session('email_or_phone');

        // Validation Rules & Messages
        $rules    = [];
        $messages = [];

        if ($email_or_phone === 'phone') {
            // Validation for Phone-Based OTP Verification

            $isMobile ?
            $rules = [
                'country_code'   => 'required|string|max:3',
                'phone_number'   => 'required|numeric|digits:10',
                'otp'            => 'required|min:4|numeric',
                'email_or_phone' => 'required|in:phone',
            ] : $rules = [

                'otp' => 'required|min:4|numeric',
            ];

            $messages = [
                'country_code.required' => 'The country code is required.',
                'phone_number.required' => 'The phone number is required.',
                'otp.required'          => 'The OTP is required.',
            ];
        } else {
            $isMobile ?
            $rules = [
                'email'          => 'required|email',
                'otp'            => 'required|min:4|numeric',
                'email_or_phone' => 'required|in:email',
            ] : $rules = [
                'otp' => 'required|min:4|numeric',
            ];

            $messages = [
                'email.required' => 'The email field is required.',
                'otp.required'   => 'The OTP is required.',
            ];
        }

        // Validate Input
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $isMobile
            ? $this->responseError('Validation failed. Please check your inputs.', 422, $validator->errors())
            : redirect()->back()->withErrors($validator->errors());
        }

        // Handle Phone-Based OTP Verification
        if ($email_or_phone === 'phone') {
            // Parse and Validate Phone Number
            $phoneUtil = PhoneNumberUtil::getInstance();

            try {
                if ($isMobile) {
                    $formattedPhoneNumber = $phoneUtil->format(
                        $phoneUtil->parse($request->input('phone_number'), strtoupper($request->input('country_code'))),
                        \libphonenumber\PhoneNumberFormat::E164
                    );
                } else {
                    $formattedPhoneNumber = $phoneUtil->format(
                        $phoneUtil->parse(session()->get('phone_number'), strtoupper(session()->get('country_code'))),
                        \libphonenumber\PhoneNumberFormat::E164
                    );
                }
            } catch (\libphonenumber\NumberParseException $e) {
                return $isMobile
                ? response()->json(['error' => 'Invalid phone number format.'], 422)
                : redirect()->back()->with('error', 'Invalid phone number format.');
            }

            // Retrieve phone number (Session for Web, Request for Mobile)
            $phoneNumber = $isMobile ? $request->input('phone_number') : session('phone_number');
            if (! $phoneNumber) {
                $message = 'Session expired. Please verify your phone number again.';
                return $isMobile
                ? $this->responseError($message, 400)
                : redirect()->back()->with('error', $message);
            }

            // Fetch User Based on Phone Number
            $user = JobSeeker::where('phoneNumber', $formattedPhoneNumber)->first();
        } else {
            // Retrieve Email (Session for Web, Request for Mobile)
            $email = $isMobile ? $request->input('email') : session('email');
            if (! $email) {
                $message = 'Session expired. Please verify your email again.';
                return $isMobile
                ? $this->responseError($message, 400)
                : redirect()->back()->with('error', $message);
            }

            // Fetch User Based on Email
            $user = JobSeeker::where('emailAddress', $email)->first();
        }

        if (! $user) {
            $message = 'User not found. Please register first.';
            return $isMobile
            ? $this->responseError($message, 404)
            : redirect()->back()->with('error', $message);
        }

        // Validate OTP and Expiry

        if ($user->otp != $request->input('otp') || $user->otpExpiry < Carbon::now()) {
            $message = 'Invalid or expired OTP. Please try again.';
            return $isMobile
            ? $this->responseError($message, 401)
            : redirect()->back()->with('error', $message);
        }

        // Update User Data (Clear OTP and Mark as Verified)
        $user->update([
            'otp'         => null,
            'otpExpiry'   => null,
            'otpVerified' => true,
        ]);

        // Success Response
        $successMessage = 'OTP verified successfully. You can now reset your password.';
        if ($email_or_phone === 'email') {
            return $isMobile
            ? $this->responseSuccess($successMessage, [
                'email' => $user->emailAddress ?? null,
            ])
            : redirect()->route('jobseeker.password_reset_page')->with('success', $successMessage);
        } else {
            return $isMobile
            ? $this->responseSuccess($successMessage, [
                'formatted_phone_number' => $formattedPhoneNumber ?? null,
            ])
            : redirect()->route('jobseeker.password_reset_page')->with('success', $successMessage);
        }
    }

    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Resend OTP to the user's phone number if the OTP has expired
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /******  f86795ba-2d07-4c6d-bbf4-3ec1e9691816  *******/

    public function resetPasswordPage()
    {
        return view('frontend.auth.password_reset');
    }

    public function resetPassword(Request $request)
    {
        $isMobile = $request->input('request_type') === 'mobile';

        $email_or_phone = $request->input('email_or_phone') === 'phone' ? 'phone' : 'email';
        if ($email_or_phone == 'email') {
            $isEmail = true;
        } else {
            $isEmail = false;
        }

        if ($isMobile) {
            $rules = $isEmail
            ? ['email' => 'required|email', 'new_password' => 'required|min:6', 'password_confirmation' => 'required|same:new_password', 'email_or_phone' => 'required|in:email']
            : ['phone_number' => 'required|numeric', 'country_code' => 'required|string', 'new_password' => 'required|min:6', 'password_confirmation' => 'required|same:new_password', 'email_or_phone' => 'required|in:phone'];
        } else {
            $rules = $isEmail
            ? ['new_password' => 'required|min:6', 'confirmation_password' => 'required|same:new_password']
            : ['new_password' => 'required|min:6', 'confirmation_password' => 'required|same:new_password'];
        }
        $messages = [
            'new_password.required'          => 'The new password field is required.',
            'confirmation_password.required' => 'The confirmation password field is required.',
            'confirmation_password.same'     => 'The confirmation password and password must match.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $isMobile
            ? $this->responseError('Validation failed.', 422, $validator->errors())
            : redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            if ($isEmail) {
                $email = $isMobile ? $request->input('email') : session('email');
                $user  = JobSeeker::where('emailAddress', $email)->first();
            } else {
                $phoneNumber = $isMobile ? $request->input('phone_number') : session('phone_number');
                $countryCode = $isMobile ? $request->input('country_code') : session('country_code');

                $formattedPhoneNumber = $this->formatPhoneNumber($phoneNumber, $countryCode);
                if (! $formattedPhoneNumber) {
                    return $isMobile
                    ? $this->responseError('Invalid phone number format.', 422)
                    : redirect()->back()->withErrors(['phone_number' => 'Invalid phone number format.'])->withInput();
                }

                $user = JobSeeker::where('phoneNumber', $formattedPhoneNumber)->first();
            }

            if (! $user) {
                return $isMobile
                ? $this->responseError('User not found.', 404)
                : redirect()->back()->with('error', 'User not found.');
            }

            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            if (! $isMobile) {
                session()->forget('email_or_phone');
                session()->forget('email');
                session()->forget('phone_number');
                session()->forget('country_code');
            }

            return $isMobile
            ? $this->responseSuccess('Password reset successfully.', ['user' => $user], 200)
            : redirect()->route('index')->with('success', 'Password reset successfully. Please login.');
        } catch (\Exception $e) {
            Log::error('Error resetting password: ' . $e->getMessage(), ['request' => $request->all()]);

            return $isMobile
            ? $this->responseError('An error occurred.', 500)
            : redirect()->back()->with('error', 'An error occurred.');
        }
    }

    public function changePassword()
    {
        return view('frontend.auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Validation rules
        $rules = $isMobile ? [
            'current_password'      => 'required|string|min:6',
            'new_password'          => 'required|string|min:6',
            'password_confirmation' => 'required',
        ] : [
            'current_password'      => 'required|string|min:6',
            'new_password'          => 'required|string|min:6',
            'confirmation_password' => 'required|same:new_password',
        ];

        $messages = $isMobile ? [] : [
            'confirmation_password.required' => 'The  password confirmation field is required..',
        ];
        // Validate request
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            if ($isMobile) {
                return $this->responseError(
                    'Validation failed. Please check your inputs.',
                    422,
                    $validator->errors()
                );
            }

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        if (! $user) {
            if ($isMobile) {
                return $this->responseError('User not found.', 404);
            }

            return redirect()->back()->with('error', 'User not found.');
        }

        if (! Hash::check($request->current_password, $user->password)) {
            if ($isMobile) {
                return $this->responseError('Current password is incorrect.', 401);
            }

            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        $isMobile ? $user->tokens()->delete() : Auth::guard('job_seekers')->logout();
        if ($isMobile) {
            return $this->responseSuccess(
                'Password updated successfully.',
            );
        } else {
            return redirect()->route('index')->with('success', 'Password updated successfully. Please login.');
        }
    }

    public function deactivate(Request $request)
    {

        $isMobile  = $request->has('request_type') && $request->input('request_type') === 'mobile';
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            if ($isMobile) {
                return $this->responseError(
                    'Validation failed. Please check your inputs.',
                    422,
                    $validator->errors()
                );
            }
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (! $user) {
            if ($isMobile) {
                return $this->responseError('User not found.', 404);
            }
            return redirect()->back()->with('error', 'User not found.');
        }

        if (! Hash::check($request->password, $user->password)) {
            if ($isMobile) {
                return $this->responseError('Password is incorrect.', 401);
            }
            return redirect()->back()->with('error', 'Password is incorrect.');
        }

        $user->status = 'inactive';
        $user->save();
        if ($isMobile) {
            return $this->responseSuccess(
                'Account deactivated successfully.',
                [
                    'jobSeeker' => $user,
                ]
            );
        } else {
            return redirect()->route('index')->with('success', 'Account deactivated successfully. Please login.');
        }
    }

    public function delete(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            if ($isMobile) {
                return $this->responseError(
                    'Validation failed. Please check your inputs.',
                    422,
                    $validator->errors()
                );
            }

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (! $user) {
            if ($isMobile) {
                return $this->responseError('User not found.', 404);
            }

            return redirect()->back()->with('error', 'User not found.');
        }

        if (! Hash::check($request->password, $user->password)) {
            if ($isMobile) {
                return $this->responseError('Password is incorrect.', 401);
            }

            return redirect()->back()->with('error', 'Password is incorrect.');
        }

        $user->delete();

        if ($isMobile) {
            return $this->responseSuccess(
                'Account deleted successfully.',
            );
        } else {
            return redirect()->route('index')->with('success', 'Account deleted successfully. Please login.');
        }
    }

    private function responseSuccess(string $message = null, $data = [], int $status = 200)
    {
        return response()->json([
            'status'  => 'true',
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    /**
     * Handle responses for errors.
     */
    private function responseError(string $message, int $status = 400, $data = null)
    {
        $response = [
            'status'  => 'false',
            'message' => $message,
        ];

        if ($data) {
            $response['data'] = $data; // Include the token or additional info in the data field
        }

        return response()->json($response, $status);
    }

    public function getProfile(Request $request, $id)
    {
        // dd ($id);

        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user || $user->id != $id) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }

        // API response for mobile clients
        if ($isMobile) {
            return response()->json([
                'status'  => true,
                'message' => 'Profile fetched successfully.',
                'data'    => [
                    'information' => [
                        'id_no'         => $user->id,
                        'name'          => $user->firstName . ' ' . $user->lastName,
                        'profession'    => $user->profession,
                        'location'      => $user->permanentLocation,
                        'referral_code' => $user->referralCode,
                    ],
                    'download'    => [
                        'photo_url' => $user->userThumbnail ? asset('storage/' . $user->userThumbnail[0]) : null,
                    ],
                ], // Returning user profile as JSON
            ]);
        }

        // Web response (view rendering)
        return view('frontend.profile.partials.basic-info', compact('user', 'isMobile'));
    }

    public function getPurchaseHistory(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user || $user->id != $id) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }

        // API response for mobile clients
        if ($isMobile) {
            return response()->json([
                'status' => true,

            ]);
        }

        // Web response (view rendering)
        return view('frontend.profile.partials.purchase-history', compact('user', 'isMobile'));
    }

    public function editProfile(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user || $user->id != $id) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }

        // API response for mobile clients
        if ($isMobile) {

            $imageLinks = [];

            // return $user->userThumbnail? "User Thumbnail Exists": "No user Thumbnail!";

            if ($user->userThumbnail) {
                $imagePaths = $user->userThumbnail ? $user->userThumbnail : [];
                $imageLinks = array_map(function ($path) {
                    return asset($path);
                }, $imagePaths);
            }
            // $imagePaths = $user->userThumbnail;
            // $imageLinks = array_map(function ($path) {
            //     return asset($path);
            // }, $imagePaths);

            return response()->json([
                'status'      => true,
                'user'        => $user,
                'image_links' => $imageLinks,
            ]);
        }

        // Web response (view rendering)
        return view('frontend.profile.partials.edit-profile', compact('user'));
    }

    public function setProfile(Request $request, $index)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }
        $thumbnails = $user->userThumbnail;
        if (isset($thumbnails[$index])) {
            // Remove the image at the given index
            $imagePath = $thumbnails[$index];

            unset($thumbnails[$index]);

            // Re-index the array (optional but ensures the keys are correct)
            $thumbnails = array_values($thumbnails);

            array_unshift($thumbnails, $imagePath);
            // Save the updated model
            $user->userThumbnail = $thumbnails;
            $user->save();
        }

        // API response for mobile clients
        if ($isMobile) {
            return response()->json([
                'status'  => true,
                'message' => "Profile Picture changed Successfully!",

            ]);
        }

        // Web response (view rendering)
        return redirect()->back()->with('success', 'Profile Picture changed Successfully!');
    }

    public function deleteImage(Request $request, $index)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }
        $thumbnails = $user->userThumbnail;
        if (isset($thumbnails[$index])) {
            // Remove the image at the given index
            $imagePath = $thumbnails[$index];

            unset($thumbnails[$index]);

            // Re-index the array (optional but ensures the keys are correct)
            $thumbnails = array_values($thumbnails);
            Storage::disk('public')->delete($imagePath);
            // Save the updated model
            $user->userThumbnail = $thumbnails;
            $user->save();
        }

        // API response for mobile clients
        if ($isMobile) {
            return response()->json([
                'status'  => true,
                'message' => "Successfully Deleted Image.",

            ]);
        }

        // Web response (view rendering)
        return redirect()->back()->with('success', 'Successfully Deleted Image.');
    }

    public function getAbroadDeals(Request $request)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }

        try {

            $aboards = Aboard::where('jobSeekerId', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            $categories = ProductCategory::all();

            if ($aboards) {

                $aboards->transform(function ($abroad) {
                    if ($abroad->productThumbnail) {
                        $abroad->productThumbnail = asset($abroad->productThumbnail);
                    }
                    return $abroad;
                });
                return $isMobile ?
                response()->json([
                    'status'  => true,
                    'message' => 'Products fetched successfully.',
                    'data'    => $aboards,
                ], 200) :
                view('frontend.profile.partials.my-abroad', compact('aboards', 'categories'));

            }
            return $aboards;

        } catch (\Exception $e) {
            if ($isMobile) {
                return response()->json([
                    'status'  => false,
                    'message' => "Validation Error!",
                    'errors'  => $e->getMessage(),

                ]);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }

    }



public function updateAbroadDeals(Request $request)
{

return $request->all();


    // Validate incoming data
    $validated = $request->validate([
        'id' => 'required|exists:aboards,id',
        'productTitle' => 'required|string|max:255',
        'productCategoryId' => 'required|exists:product_categories,id',
        'productDescription' => 'required|string',
        // Add other fields if needed
    ]);

    // Find the Aboard record
    $aboard = Aboard::find($validated['id']);

    // Update the record
    $aboard->productTitle = $validated['productTitle'];
    $aboard->productCategoryId = $validated['productCategoryId'];
    $aboard->productDescription = $validated['productDescription'];
    // Update other fields if you have more (e.g., price, images, etc.)

    $aboard->save();

    // Return JSON response (or redirect, if applicable)
    return response()->json([
        'message' => 'Aboard deal updated successfully.',
        'aboard' => $aboard
    ]);
}




    public function getAdvertisements(Request $request, $id)
    {

        //Check if the request is from mobile using request_type
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';

        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

        if (! $user || $user->id != $id) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }

        try {

            $ads = Advertisement::where('jobSeekerId', $user->id)->get();

            $ads = $ads->transform(function ($ad) {
                // Assuming 'image' is the field where the image filename is stored
                $ad->image_url = $ad->adsThumbnail ? asset($ad->adsThumbnail) : null;

                // Modify according to your image storage path
                return $ad;
            });

            $adsCategory = AdvertisementCategory::all();
            // return $adsCategory;
            // return $ads;

            return $isMobile ?
            response()->json([
                'status'  => true,
                'message' => 'Advertisements fetched successfully.',
                'data'    => $ads,
            ]) : view('frontend.profile.partials.advertisement', compact('ads'));

        } catch (\Exception $e) {

            if ($isMobile) {
                return response()->json([
                    'status'  => false,
                    'message' => "Validation Error!",
                    'errors'  => $e->getMessage(),

                ]);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getCV(Request $request, $id)
    {
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        // Determine authenticated user based on request type
        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        // Ensure user is authenticated and matches the requested profile
        if (! $user || $user->id != $id) {
            if ($isMobile) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated or access denied.',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }

        // API response for mobile clients
        if ($isMobile) {
            return response()->json([
                'status' => true,

            ]);
        }

        // Web response (view rendering)
        return view('frontend.profile.partials.your-cv', compact('user', 'isMobile'));
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

        $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();
        

        if (! $user) {

            Log::alert("User is un authentic");

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed. Please check your inputs.',
                ]);
            }

            return $isMobile
            ? $this->responseError('Unauthorized access.', 403)
            : redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'fullName'          => 'nullable|string',
            'images'            => 'nullable|array|max:5',
            'images.*'          => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dob'               => 'nullable|date',
            'temporaryLocation' => 'nullable|string|max:255',
            'permanentLocation' => 'nullable|string|max:255',
            'gender'            => 'nullable|in:male,female,other',
            'luckyNumber'       => 'nullable|numeric',
            'type'              => 'nullable|in:trainee,parttime,fulltime,user',
            'whoAmI'            => 'nullable|in:student,worker,consultant',
            'profession'        => 'nullable|string',
            'country'           => 'nullable|string',
        ]);

        // return $request->all();
        // Handle validation errors
        if ($validator->fails()) {

            Log::alert("Someting went wrong:", $validator->errors());

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed. Please check your inputs.',
                    'errors'  => $validator->errors(),
                ]);
            }

            if ($isMobile) {
                return $this->responseError(
                    'Validation failed. Please check your inputs.',
                    422,
                    $validator->errors()
                );
            }

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // Fetch the user record to update

        try {

            // return $request->all();
            Log::info("Request data: ", $request->all());

            //handle files
            if ($request->hasFile('images')) {
                $files = $request->file('images');

                Log::info("Files: ", $files);

                // Limit to 5 images

                if ($user->userThumbnail) {
                    if (count($user->userThumbnail) === 5) {
                        $files = [];
                    } else {
                        $files = array_slice($files, 0, 5 - count($user->userThumbnail));
                    }
                } else {
                    $files = array_slice($files, 0, 5);
                }
                $imagePaths = [];
                foreach ($files as $file) {
                    $path         = $file->store('jobSeekerImage', 'public');
                    $imagePaths[] = $path;
                }
                // $user->userThumbnail[] = array_merge($user->userThumbnail, $imagePaths);
                if ($user->userThumbnail) {
                    $newArr              = array_merge($user->userThumbnail, $imagePaths);
                    $user->userThumbnail = $newArr;
                } else {
                    $user->userThumbnail = $imagePaths;
                }
            }
            // dd($request->all());
            $fullName = trim($request->input('fullName'));

            $parts = preg_split('/\s+/', $fullName, 2); // Split by first space

            $firstName = $parts[0] ?? null;
            $lastName  = $parts[1] ?? null;
            // Update fields
            if ($firstName && $lastName) {
                $user->firstName = $firstName;
                $user->lastName  = $lastName;
            }

            if ($request->input('dob')) {
                $user->dateOfBirth = $request->input('dob');
            }

            if ($request->input('temporaryLocation')) {
                $user->temporaryLocation = $request->input('temporaryLocation');
            }

            if ($request->input('permanentLocation')) {
                $user->permanentLocation = $request->input('permanentLocation');
            }

            if ($request->input('gender')) {
                $user->gender = $request->input('gender');
            }

            if ($request->input('luckyNumber')) {
                $user->luckyNumber = $request->input('luckyNumber');
            }

            if ($request->input('whoAmI')) {
                $user->whoAmI = $request->input('whoAmI');
            }

            if ($request->input('profession')) {
                $user->profession = $request->input('profession');
            }

            if ($request->input('type')) {
                $user->type = $request->input('type');
            }

            if ($request->input('country')) {
                $user->country = $request->input('country');
            }

            // Save updates
            $user->save();

            Log::info("User updated successfully: $user");

            if ($isMobile) {
                return $this->responseSuccess('Profile updated successfully.', $request->all());
            }

            if (request()->ajax()) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Profile updated successfully.',
                ]);
            }

            return redirect()->back()->with('success', 'Profile updated successfully.');

        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed. Please check your inputs.',
                ]);
            }

            return $isMobile ? $this->responseError(
                'Validation failed. Please check your inputs.',
                422,
                $validator->errors()
            ) : redirect()->back()->withErrors($validator->errors())->withInput();

        }

    }

    // public function updateProfile(Request $request, $id)
    // {
    //     // Checking if request type is mobile
    //     $isMobile = $request->has('request_type') && $request->input('request_type') === 'mobile';

    //     // Define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'firstName' => 'required|string|max:255',
    //         'lastName' => 'required|string|max:255',
    //         'emailAddress' => 'required|email|unique:job_seekers,emailAddress,' . $id,
    //         'countryCode' => 'required|string|max:10',
    //         'phoneNumber' => 'required|string|max:20|unique:job_seekers,phoneNumber,' . $id,
    //         'userThumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'dateOfBirth' => 'required|date',
    //         'temporaryLocation' => 'required|string|max:255',
    //         'permanentLocation' => 'required|string|max:255',
    //         'luckyNumber' => 'required|string|max:20',
    //     ]);

    //     // Handle validation errors
    //     if ($validator->fails()) {
    //         if ($isMobile) {
    //             return $this->responseError(
    //                 'Validation failed. Please check your inputs.',
    //                 422,
    //                 $validator->errors()
    //             );
    //         }

    //         return redirect()->back()->withErrors($validator->errors())->withInput();
    //     }

    //     // Phone number validation and formatting
    //     $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
    //     try {
    //         $countryCode = strtoupper($request->input('countryCode'));
    //         if (!$countryCode) {
    //             throw new \libphonenumber\NumberParseException('Country code is required.');
    //         }
    //         $parsedPhone = $phoneUtil->parse($request->input('phoneNumber'), $countryCode);
    //         if (!$phoneUtil->isValidNumber($parsedPhone)) {
    //             throw new \libphonenumber\NumberParseException('Invalid phone number format.');
    //         }
    //         $formattedPhoneNumber = $phoneUtil->format($parsedPhone, \libphonenumber\PhoneNumberFormat::E164);
    //     } catch (\libphonenumber\NumberParseException $e) {
    //         return $isMobile
    //             ? $this->responseError('Invalid phone number format.', 422, ['error' => $e->getMessage()])
    //             : redirect()->back()->with('error', 'Invalid phone number format.')->withInput();
    //     }

    //     // Fetch the user record to update
    //     $user = $isMobile ? $request->user() : Auth::guard('job_seekers')->user();

    //     if (!$user || $user->id != $id) {
    //         return $isMobile
    //             ? $this->responseError('Unauthorized access.', 403)
    //             : redirect()->back()->with('error', 'Unauthorized access.');
    //     }

    //     // Update fields
    //     $user->firstName = $request->input('firstName');
    //     $user->lastName = $request->input('lastName');
    //     $user->emailAddress = $request->input('emailAddress');
    //     $user->countryCode = $request->input('countryCode', $user->countryCode);
    //     $user->phoneNumber = $formattedPhoneNumber; // Update with the formatted phone number
    //     $user->dateOfBirth = $request->input('dateOfBirth', $user->dateOfBirth);
    //     $user->temporaryLocation = $request->input('temporaryLocation', $user->temporaryLocation);
    //     $user->permanentLocation = $request->input('permanentLocation', $user->permanentLocation);
    //     $user->luckyNumber = $request->input('luckyNumber', $user->luckyNumber);

    //     // Handle user thumbnail upload
    //     if ($request->hasFile('userThumbnail')) {
    //         $request->validate([
    //             'userThumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //         ]);
    //         $imageExtension = $request->file('userThumbnail')->getClientOriginalExtension();
    //         $imageName = uniqid('user_thumbnail_', true) . '.' . $imageExtension;
    //         $thumbnailPath = $request->file('userThumbnail')->storeAs('thumbnails', $imageName, 'public');
    //         $user->userThumbnail = $thumbnailPath;
    //     }

    //     // Save updates
    //     $user->save();

    //     // Return response
    //     if ($isMobile) {
    //         return $this->responseSuccess('Profile updated successfully.', $user);
    //     }

    //     return redirect()->back()->with('success', 'Profile updated successfully.');
    // }

    public function clearSessionFlag(Request $request)
    {
        // Clear the session flag
        $request->session()->forget('error');
        return response()->json(['success' => true]);
    }

    // Add this method to handle phone verification
    // public function verifyPhone(Request $request)
    // {
    //     $request->validate([
    //         'otp' => 'required|string|size:6'
    //     ]);

    //     $verification = session()->get('phone_verification_otp');

    //     if (!$verification || now()->isAfter($verification['expires_at'])) {
    //         return redirect()->back()
    //             ->with('error', 'OTP has expired. Please request a new one.');
    //     }

    //     if ($request->otp != $verification['otp']) {
    //         return redirect()->back()
    //             ->with('error', 'Invalid OTP. Please try again.');
    //     }

    //     // Get stored form data
    //     $profileData = session()->get('profile_update_data');

    //     if (!$profileData) {
    //         return redirect()->route('jobseeker.profile.edit')
    //             ->with('error', 'Session expired. Please try again.');
    //     }

    //     // Clear verification data
    //     session()->forget(['phone_verification_otp', 'profile_update_data']);

    //     // Update user with verified phone
    //     $user = Auth::guard('job_seekers')->user();
    //     $user->phone_verified_at = now();

    //     // Redirect back to profile update with verified status
    //     return redirect()->route('jobseeker.profile.edit')
    //         ->with('success', 'Phone number verified successfully. Please save your profile changes.');
    // }

    public function myjobs($id)
    {
        try {
            // $bookmarkedJobs = JobBookmark::where('jobSeekerId','=', $id)
            //     ->with('jobPost')
            //     ->get();
            $jobs = JobPost::withWhereHas('jobBookmark', function ($query) use ($id) {
                $query->where("jobSeekerId", $id);
            })
                ->with('jobCompany')
                ->orderBy('created_at', 'desc')
                ->where('jobStatus', 'published')
                ->get();

            $jobs = JobPost::withWhereHas('jobBookmark', function ($query) use ($id) {
                $query->where("jobSeekerId", $id);
            })
                ->with('jobCompany') // Only eager load the jobCompany
                ->orderBy('created_at', 'desc')
                ->where('jobStatus', 'published')
                ->get();

            // return ($jobs);

            // return ($bookmarkedJobs);
            return view('frontend.profile.partials.my-jobs', compact('jobs'));
            // dd ($bookmarkedJobs);
        } catch (\Exception $e) {
            return ($e);
        }
    }

    public function removeBookmark($id)
    {
        try {
            $jobSeekerId = Auth::id();

            $bookmarkedJob = JobBookmark::where('jobSeekerId', $jobSeekerId)
                ->where('jobPostId', $id)->first();

            if ($bookmarkedJob) {
                $bookmarkedJob->delete();
                return redirect()->back()->with('success', "Successfully Deleted the bookmark");
            }
            return redirect()->back()->with('error', "Request operation not allowed");
        } catch (\Exception $e) {
            return ($e);
        }
    }

    public function myforms(){
        return view('frontend.profile.partials.my-forms');
    }

    public function mynews(){
        return view('frontend.profile.partials.my-news');
    }

    public function myblogs(){
        return view('frontend.profile.partials.my-podcasts');
    }
}
