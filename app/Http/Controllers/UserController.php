<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';
    const JOB_EMPLOYER = 'employer';

    public function createSeeker() {
        return view('user.seeker-register');
    }

    public function createEmployer() {
        return view('user.employer-register');
    }

    public function storeSeeker(RegistrationRequest $request) {
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_type' => self::JOB_SEEKER
        ]);

        //$user->sendEmailVerificationNotification();
        //Auth::login($user);

        return redirect()->route('login')->with('successMessage', 'Your account was created!');
    }

    public function storeEmployer(RegistrationRequest $request) {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_type' => self::JOB_EMPLOYER,
            'user_trial' => now()->addWeek()
        ]);

        //$user->sendEmailVerificationNotification();
        //Auth::login($user);
        //return response()->json('success');
        return redirect()->route('login')->with('successMessage', 'Your account was created!');
    }

    public function login() {
        return view('user.login');
    }

    public function postLogin(LoginRequest $request) {

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            if(auth()->user()->user_type == 'employer') {
                return redirect()->to('dashboard');
            } else {
                return redirect()->to('/');
            }
            return redirect()->intended('dashboard');
        }

        return view('user.login');
    }

    public function logout() {
        auth()->logout();
        return redirect()->intended('login');
    }

    public function profile()
    {
        return view('profile.index');
    }

    public function seekerProfile()
    {
        return view('seeker.profile');
    } 

    public function uploadResume(Request $request)
    {
        $this->validate($request,[
            'resume' => 'required|mimes:pdf,doc,docx',
        ]);

        if($request->hasFile('resume')) {
            $resume = $request->file('resume')->store('resume', 'public');   
            User::find(auth()->user()->id)->update(['resume' => $resume]);

            return back()->with('success','Your resume has been updated successfully');

        }
    }

    public function update(Request $request)
    {
        if($request->hasFile('profile_pic')) {
            $imagepath = $request->file('profile_pic')->store('profile', 'public');   

            User::find(auth()->user()->id)->update(['profile_pic' => $imagepath]);
        }

        User::find(auth()->user()->id)->update($request->except('profile_pic'));

        return back()->with('success','Your profile has been updated');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = auth()->user();
        if(!Hash::check($request->current_password, $user->password)) {
            return back()->with('error','Current password is incorrect');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success','Your password has been updated successfully');
    }

    public function jobApplied()
    {
        $users =  User::with('listings')->where('id',auth()->user()->id)->get();

        return view('seeker.job-applied',compact('users'));
    }
}
