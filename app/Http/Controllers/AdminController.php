<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    // end method

    public function AdminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // create verification code

            $verification_code = random_int(100000, 999999);

            session(['verification_code' => $verification_code, 'user_id' => $user->id]);

            Mail::to($user->email)->send(new VerificationCodeMail($verification_code));

            Auth::logout();

            return redirect()->route('custom.verification.form')->with('status', 'Verification code sent to your mail');
        }

        // fall back
        return redirect()->back()->withErrors(['email' => 'invalid credentials']);
    }
    // end method

    public function ShowVerification()
    {
        return view('auth.verify');
    }
    // end method

    public function VerificationVerify(Request $request)
    {
        $request->validate(['code' => 'required|numeric']);

        if ($request->code == session('verification_code')) {
            Auth::loginUsingId(session('user_id'));

            session()->forget(['verification_code', 'user_id']);
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['code' => 'invalid code']);

    }
    // end method

    public function AdminProfile()
    {
        // get the user who is loggin ID
        $id = Auth::user()->id;

        //find the data specific to the user
        $profileData = User::find($id);

        //pass the data, to access it
        return view('admin.profile', compact('profileData'));
    }
    // end method

    private function deleteOldImage($fileName)
    {
        $path = public_path('backend/assets/upload/' . $fileName);

        if (file_exists($path)) {
            unlink($path); // deletes the file
        }
    }
    // end method

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        $data = $request->validate([
            'name' => 'max:18',
            'email' => 'email',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'phone' => 'nullable|numeric|digits_between:8,12',
            'address' => 'nullable|max:55'
        ]);

        $oldPhotoPath = $profileData->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/assets/upload'), $fileName);
            $data['photo'] = $fileName;

            if ($oldPhotoPath && $oldPhotoPath !== $fileName) {
                $this->deleteOldImage($oldPhotoPath);
            }

        }

        $notification = array(
            'message' => 'Profile updated successfully!',
            'alert-type' => 'success'
        );

        $profileData->update($data);
        return redirect()->back()->with($notification);
    }
    // end method

    public function Update_Profile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            $notification = array(
                'message' => 'Password does not match!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        User::whereId($user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    //end method

}
