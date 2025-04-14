<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return view('profiles.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        if(auth()->id() !== $user->id){
            abort(403, 'Unauthorized action.');
        }

        return view('profiles.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if(auth()->id() !== $user->id){
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'bio' => 'nullable',
            'profile_image' => 'image|nullable|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        if($request->hasFile('profile_image')){
            if($user->profile_image){
                Storage::disk('public')->delete($user->profile_image);
            }

            $imagePath = $request->file('profile_image')->store('profile', 'public');
            $data['profile_image'] = $imagePath;
        }
        $user->update($data);
        return redirect("/profile/{$user->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
