<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Mail\MailableName;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class CustomPasswordResetController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $token=str::random(60);
        Db::table('password_reset_tokens')->where('email',$request->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>now(),

        ]);
        // dd($request->email);
        Mail::to($request->email)->send(new MailableName($request->email,$token));
        return back()->with('status', 'Password reset link sent!');
    }
    public function showResetPasswordForm(Request $request,$token)
    {
        return view('auth.reset-password', ['token' => $token,'email'=>request()->email]);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    public function changePassword(Request $request, $id)
    {
    try{
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);
    }catch(Exception $e){
        dd($e->getMessage());
        $e->getMessage();
    }


    
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/setting')->with("status","passwod changed");
    }
        
}

