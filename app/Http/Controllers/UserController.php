<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Tampilkan halaman landing.
     */
    public function tampilLanding()
    {
        return view('landing-page');
    }

    /**
     * Menampilkan daftar pengguna.
     */
    public function index()
    {
        $users = User::simplePaginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Tampilkan halaman login.
     */
    public function login()
    {
        return view('login_page');
    }

    /**
     * Mengautentikasi pengguna dan mengarahkan berdasarkan peran.
     */
    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Validasi kredensial dan autentikasi
        $user = $request->only('email', 'password');

        if (Auth::attempt($user)) {
            $authenticatedUser = Auth::user();
            switch ($authenticatedUser->role) {
                case 'GUEST':
                    return redirect()->route('report.index');
                case 'HEAD_STAFF':
                    return redirect()->route('home.akun');
                case 'STAFF':
                    return redirect()->route('response');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('failed', 'Role tidak valid.');
            }
        } else {
            return redirect()->back()->with('failed', 'Email atau password salah.');
        }
    }

    /**
     * Tampilkan halaman registrasi.
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Membuat akun baru dan mengarahkan pengguna setelah pendaftaran.
     */
    public function createUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'GUEST',
        ]);

        Auth::login($user);
        return redirect()->route('report.index')->with('success', 'Akun berhasil dibuat.');
    }

    /**
     * Logout pengguna dan mengarahkan ke halaman login.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Tampilkan form pembuatan pengguna.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Simpan pengguna baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('home.akun')->with('success', 'User created successfully');
    }

    /**
     * Reset password pengguna berdasarkan ID.
     */
    public function reset($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('home.akun')->with('failed', 'User tidak ditemukan.');
        }

        $email = $user->email;
        $password = explode('@', $email)[0];

        $user->update([
            'password' => Hash::make($password),
        ]);

        return redirect()->route('home.akun')->with('success', 'Password reset successfully');
    }

    /**
     * Hapus pengguna berdasarkan ID.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('home.akun')->with('success', 'User deleted successfully');
    }
}
