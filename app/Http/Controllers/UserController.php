<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Post;
class UserController extends Controller
{
    public function showDataInHome(){
        $post=Post::all();
        return view('home',compact('post'));
    }
    /**
     * Display the user's profile form.
     */
    public function showFullPost($id){
        $post=Post::findOrFail($id);
        return view('fullpost',compact('post'));
    }
    public function home(Request $request)
    {
        if($request->user()->usertype=='user'){
            return view('dashboard');
        }
        // admin登入時自動導向 /admin/dashboard
        else if($request->user()->usertype=='admin'){
            return redirect()->route('admin.dashboard');
        }
        // 其他類型可加上預設處理
        return redirect('/');
    }
    public function index(Request $request)
    {
        if($request->user()->usertype=='admin')
            return view('admin.dashboard');
        else{
            return redirect()->route('dashboard');
        }
    }

    

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
