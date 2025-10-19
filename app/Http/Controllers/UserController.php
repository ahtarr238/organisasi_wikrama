<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                // wajib diisi min/minimal karakter
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                // dns emailnya valid,@gmail.com,@company.com, dll
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'birth_date' => 'required|date|before:-15 years',
                'phone_number' => 'required|numeric|min:10',
                'address' => 'required|min:10',
            ],
            [
                'first_name.required' => 'Nama depan wajib diisi',
                'first_name.min' => 'Nama depan wajib diisi minimal 3 Huruf',
                'last_name.required' => 'Nama belakang wajib diisi',
                'last_name.min' => 'Nama belakang wajib diisi minimal 3 Huruf',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Email wajib diisi dengan data yang valid',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 8 Huruf',
                'gender.required' => 'Jenis kelamin wajib diisi',
                'birth_date.required' => 'Tanggal lahir anda wajib diisi',
                'birth_date.before' => 'Anda harus berusia minimal 15 tahun',
                'phone_number.required' => 'Nomor telepon anda wajib diisi ',
                'phone_number.min' => 'Nomor telepon wajib diisi minimal 10 angka',
                'address.required' => 'Alamat anda wajib diisi',
                'address.min' => 'Alamat anda wajib diisi minimal 10 huruf'
            ]
        );

        $updateUser = User::create([
            'name'     => $request->first_name . ' ' . $request->last_name,
            'email'    => $request->email,
            'gender'   => $request->gender,
            'birth_date' => $request->birth_date, // kalau sudah di validasi dan ingin simpan
            'password' => Hash::make($request->password),
            'role'     => 'anggota', // default role
        ]);
        if ($updateUser) {
            // redirect memindahkan halaman , route():name routing yg di tuju
            // with mengirimkan session biasanya untuk modifikasi
            return redirect()->route('login')->with('success!', 'silahkan login');
        } else {
            // back kembali ke halaman sebelumnya
            return redirect()->back()->with('error', 'gagal!, silahkan coba lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function signUp(Request $request)
    {
        //class untuk mengambil data dari form
        $request->validate(
            [
                // wajib diisi min/minimal karakter
                'name' => 'required|min:3',
                // dns emailnya valid,@gmail.com,@company.com, dll
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'birth_date' => 'required|date|before:-15 years',
                'address' => 'required|min:10',
                'join_date' => 'required|date',
            ],
            [
                'name.required' => 'Nama lengkap wajib diisi',
                'name.min' => 'Nama lengkap wajib diisi minimal 3 Huruf',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Email wajib diisi dengan data yang valid',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 8 Huruf',
                'gender.required' => 'Jenis kelamin wajib diisi',
                'birth_date.required' => 'Tanggal lahir anda wajib diisi',
                'birth_date.before' => 'Anda harus berusia minimal 15 tahun',
                'address.required' => 'Alamat anda wajib diisi',
                'address.min' => 'Alamat anda wajib diisi minimal 10 huruf',
                'join_date.required' => 'Tanggal bergabung wajib diisi',
            ]
        );

        // Konversi gender ke format singkat
        $genderValue = $request->gender == 'Laki-laki' ? 'L' : 'P';

        // Menggunakan role yang sesuai dengan struktur database
        $roleValue = 'user'; // default role yang sesuai dengan struktur database

        $CreateUser = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'gender'   => $genderValue,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'join_date' => $request->join_date,
            'password' => Hash::make($request->password),
            'role'     => $roleValue, // default role yang lebih singkat
        ]);
        if ($CreateUser) {
            // redirect memindahkan halaman , route():name routing yg di tuju
            // with mengirimkan session biasanya untuk modifikasi
            return redirect()->route('login')->with('success', 'Silahkan login dengan akun yang telah dibuat');
        } else {
            // back kembali ke halaman sebelumnya
            return redirect()->back()->with('error', 'Gagal mendaftar, silahkan coba lagi');
        }
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil login.');
            } elseif (Auth::user()->role == 'staff') {
                return redirect()->route('staff.dashboard')->with('success', 'Berhasil login.');
            } elseif (Auth::user()->role == 'user') {
                return redirect()->route('home.auth')->with('success', 'Berhasil login.');
            } else {
                return redirect()->back()->with('error', 'Role tidak dikenali, silahkan hubungi admin.');
            }
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah.');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Berhasil logout! Silakan login kembali untuk akses lengkap.');
    }
}
