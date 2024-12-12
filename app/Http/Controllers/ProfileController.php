<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $title = 'Profile Page';
        return view('profile', compact('user', 'title'));
    }



    public function update(Request $request, $id)
    {
        request()->validate([
            'name'       => 'required|string|min:2|max:100',
            'email'      => 'required|email|unique:users,email, ' . $id . ',id',
            'old_password' => 'nullable|string',
            'password' => 'nullable|required_with:old_password|string|confirmed|min:6',
            'address'       => 'required|string|min:2|max:100'
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;

        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            } else {
                return back()
                    ->withErrors(['old_password' => __('Please enter the correct password')])
                    ->withInput();
            }
        }

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($user->image && Storage::exists('public/img/' . $user->image)) {
                Storage::delete('public/img/' . $user->image);
            }

            // Simpan file baru
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Nama unik berdasarkan waktu
            $file->move(public_path('img'), $fileName);

            // Simpan nama file ke database
            $user->image = $fileName;
        }



        $user->save();

        return back()->with('status', 'Profile updated!');
    }
}
