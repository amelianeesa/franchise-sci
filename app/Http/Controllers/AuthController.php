<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'jenis_pelanggan' => 'required|in:perorangan,perusahaan',
            // company_name wajib kalau jenis_pelanggan = perusahaan
            'company_name' => 'nullable|string|max:255|required_if:jenis_pelanggan,perusahaan',
            'jabatan' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:30',
            'whatsapp' => 'required|string|max:20',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            // role TIDAK boleh datang dari input, selalu hardcode di sini
            'role' => 'pelanggan',
            'jenis_pelanggan' => $validated['jenis_pelanggan'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            // cukup pakai plain password di sini, biarkan cast 'hashed' di Model yang meng-hash
            'password' => $validated['password'],
            'npwp' => $validated['npwp'] ?? null,
            'company_name' => $validated['company_name'] ?? null,
            'jabatan' => $validated['jabatan'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'whatsapp' => $validated['whatsapp'],
            'is_active' => 1,
        ]);

        Auth::login($user);

        // redirect ke dashboard, bukan ke landing page, karena user sudah login
        return redirect()->route('dashboard')->with('success', 'Pendaftaran akun berhasil!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // blokir akun yang dinonaktifkan admin, walau password benar
            if (! $user->is_active) {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun Anda telah dinonaktifkan. Silakan hubungi admin.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()->intended($this->redirectPathForRole($user->role))
                ->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }

    private function redirectPathForRole(string $role): string
    {
        return match ($role) {
            'admin_pusat', 'admin_cabang' => '/admin/dashboard',
            'tenaga_ahli' => '/mitra/dashboard',
            default => '/dashboard',
        };
    }
}