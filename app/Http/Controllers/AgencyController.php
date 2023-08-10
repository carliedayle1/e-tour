<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\NewUserNotification;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\File;


class AgencyController extends Controller
{
    public function create()
    {
        return view('auth.register-agency');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'agency' => ['required', 'string', 'max:255', 'min:3'],
            'certificate' => ['required', 'mimes:pdf,jpg,jpeg,png'],
            'description' => ['required', 'string', 'max:255', 'min:6'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => 'agency',
            'password' => Hash::make($request->password),
        ]);

        if(request()->file('certificate') !== null) {
            $validated['certificate'] = request()->file('certificate')->store('business-certificate', 'public');
        }
        Agency::create([
            'user_id' => $user->id,
            'name' => $request->agency,
            'certificate' => $validated['certificate'],
            'description' => $request->description,
        ]);

        event(new Registered($user));

        $admins = User::where('type', 'admin')->get();
        
        Notification::send($admins, new NewUserNotification($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());
        
        $validated = $request->validate([
            'agency' => ['required', 'string', 'max:255', 'min:3'],
            'description' => ['required', 'string', 'max:255', 'min:6'],
            'certificate' => ['nullable', 'mimes:pdf,jpg,jpeg,png'],
        ]);

        if(request()->file('certificate') !== null) {
            $validated['certificate'] = request()->file('certificate')->store('business-certificate', 'public');
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        
        $request->user()->save();
        $request->user()->agency->update([
            'name' => $request->agency,
            'description' => $request->description,
            'certificate' => $validated['certificate'] !== null ? $validated['certificate'] : $request->user()->agency->certificate
        ]);

        toast('Agency information updated successfully','info');
        return Redirect::route('profile.edit');
    }
}
