<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $isMobile = request()->has('request_type') && request()->input('request_type') === 'mobile';
        try {
            if ($isMobile) {
                $googleUser = Socialite::driver('google')->userFromToken($request->access_token);
            }
            // For web requests, handle the callback
            else {
                $googleUser = Socialite::driver('google')->user();
            }

            $user = JobSeeker::where('socialMediaLogin', $googleUser->id)
                ->orWhere('emailAddress', $googleUser->email)
                ->first();

            if (! $user) {
                // Create new user
                $user = JobSeeker::create([
                    'firstName'        => $googleUser->user['given_name'] ?? $googleUser->name,
                    'lastName'         => $googleUser->user['family_name'] ?? '',
                    'emailAddress'     => $googleUser->email,
                    'socialMediaLogin' => $googleUser->id,
                    'email_or_phone'   => 'google',
                    'otpVerified'      => true,
                    'status'           => 'active',
                    'password'         => bcrypt(Str::random(16)), // Random password for social login
                    'emailVerifiedAt'  => now(),
                    'referralCode'     => Str::upper(Str::random(8)),
                ]);
            } else {
                // Update existing user's google info
                $socialLogin = $user->socialMediaLogin ?? $googleUser->id;

                $user->update([
                    'socialMediaLogin' => $socialLogin,
                    'emailVerifiedAt'  => now(),
                ]);
            }

            // Handle authentication based on request type
            if ($isMobile) {
                $user->tokens()->delete();
                $token = $user->createToken('JobSeekerToken')->plainTextToken;

                return response()->json([
                    'status'    => true,
                    'message'   => 'Google login successful.',
                    'jobSeeker' => array_merge($user->toArray(), ['token' => $token]),
                ]);
            } else {
                Auth::guard('job_seekers')->login($user);
                return redirect($request->session()->pull('redirect_url', route('index')))
                    ->with('success', 'Google login successful.');
            }

        } catch (\Exception $e) {
            return $isMobile
            ? $this->responseError('Google authentication failed: ' . $e->getMessage(), 401)
            : redirect()->route('jobseeker.login')->with('error', 'Google login failed. Please try again.');
        }
    }
}
