<?php

namespace App\Http\Controllers;

use App\Helpers\UniqueCode;
use App\Jobs\SendVerificationEmailJob;
use App\Mail\VerificationMail;
use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function register(){
    //     return view('register');
    // }
    
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required | email',
            'password' => 'required | min:8 | max:25'
        ]);

        $user = User::where('email', $request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                if($user->email_verified_at != null){
                    Auth::loginUsingId($user->id);
                    return redirect('/');
                }else{
                    
                    $old_codes = VerificationCode::where('user_id',$user->id)->get();
                    foreach($old_codes as $code){
                        $code->delete();
                    }

                    $verification_code = UniqueCode::generate(10);

                    $code = VerificationCode::create([
                        'verification_code' => $verification_code,
                        'user_id' => $user->id
                    ]);
        
                    // Mail::to($user->email)->send(new VerificationMail($user,$code));
                    SendVerificationEmailJob::dispatch($user,$code);
                    return view('EmailVerification',['email'=>'لطفا به منظور تایید حساب کاربری کد ارسال شده را وارد کنید']);
                }
            }else{
                return view('login',['message'=>'رمز وارد شده اشتباه میباشد']);
            }
        }else{
            return view('login',['message'=>'کاربری با این ایمیل ثبت نام نکرده است']);
        }
    }

    public function VerifyEmail(Request $request){
        $code = VerificationCode::where('verification_code',$request->verification_code)->first();
        if($code){
            $user = $code->user;
            if($user->email_verified_at != null){
                auth::attempt([$user->email,$user->password]);
                return view('dashboard',['message'=>'اکانت شما از پیش تایید شده است']);
            }else{
                $user->email_verified_at = Carbon::now();
                $user->save();
                Auth::loginUsingId($user->id);
                $code->delete();
                return redirect('/');
            }
        }else{
            return view('EmailVerification',['message' => 'کد وارد شده اشتباه میباشد لطفا مجددا تلاش کنید']);
        }
    }

    public function Register(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required | email',
            'username' => 'required',
            'password' => 'required | min:8 | max:25 | confirmed'
        ]);

        if($validator->passes()){
            $verification_code = UniqueCode::generate(10);
            $user = User::create([
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);

            $code = VerificationCode::create([
                'verification_code' => $verification_code,
                'user_id' => $user->id
            ]);
            dispatch(new SendVerificationEmailJob($user,$code));
            // SendVerificationEmailJob::dispatch($user,$code);
            // Mail::to($user->email)->send(new VerificationMail($user,$code));
            
            return view('EmailVerification');
        }
    }

    public function logout(){
        Auth::logout();
        return view('login');
    }
}
