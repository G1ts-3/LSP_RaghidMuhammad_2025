<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function profile($id)
{
    $user = User::findOrFail($id);
    return view('member.profile', compact('user'));
}
public function update(Request $request, User $user)
{

    $validated = $request->validate([
        'nis' => 'required|unique:users,nis,' . $user->id,
        'name' => 'required',
        'class' => 'required',
        'major'=>'required',
        'username' => 'required|unique:users,username,' . $user->id,
        'password' => 'nullable|min:5',
        'role' => 'required|in:admin,member',
    ]);


    if (isset($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
    } else {
        unset($validated['password']);
    }


    if (auth()->user()->id === $user->id && $validated['role'] === 'member') {
        return redirect()->route('member.dashboard')
            ->with('error', 'Maaf anda tidak bisa mengganti role anda ke member.');
    }


    $user->update($validated);


    return redirect()->route('member.dashboard')
        ->with('success', 'Data anggota berhasil diperbarui');
}

}
