<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = Profile::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
        ]);

        $profile->user()->update([
            'username'=> $request->input('username')
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $following = auth()->user() ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember('count.posts'. $user->id, now()->addSeconds(30),  function() use ($user) {
            return $user->posts->count();
        });
        $followersCount = Cache::remember('count.follower'. $user->id, now()->addSeconds(30),  function() use ($user) {
            return $user->profile->followers->count();
        });
        $followingCount = Cache::remember('count.following'. $user->id, now()->addSeconds(30),  function() use ($user) {
            return $user->following->count();
        });

         

        return view('profile.show', compact(['following', 'user', 'postCount', 'followersCount', 'followingCount']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $this->authorize('update', $profile);
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, Profile $profile)
    {
        // Authorize the user to perform the update action on the profile
        $this->authorize('update', $profile);

        // Extracting request data into an array
        $data = $request->only(['title', 'description', 'url', 'image']);


        // If image is uploaded, store it and update profile image path
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $data['image'] = $imagePath ?? [];
        }

        // Update profile data
        auth()->user()->profile->update($data);

        // Update user's username
        auth()->user()->update([
            'username' => $request->input('username')
        ]);


        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): RedirectResponse

    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');

    }
}
