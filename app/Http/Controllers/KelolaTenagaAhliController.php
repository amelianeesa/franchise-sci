<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TenagaAhliAccMail;
use Illuminate\Support\Str;

class KelolaTenagaAhliController extends Controller
{
    public function index()
    {
        $tenagaAhliList = User::where('role', 'tenaga_ahli')->latest()->get();
        return view('admin.ta_index', compact('tenagaAhliList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        $randomPassword = Str::password(8);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($randomPassword),
            'role' => 'tenaga_ahli',
        ]);

        Mail::to($user->email)->send(new TenagaAhliAccMail($user, $randomPassword));

        return redirect()->route('admin.ta_index')
            ->with('success', 'Akun tenaga ahli berhasil dibuat dan info login telah dikirim via email.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->back()
            ->with('success', 'Data akun tenaga ahli ' . $user->name . ' berhasil diperbarui.');
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'new_password' => 'required|string|min:6',
        ]);

        if ($user->role !== 'tenaga_ahli') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()
            ->with('success', 'Password untuk tenaga ahli ' . $user->name . ' berhasil diperbarui.');
    }
}