<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('bagian', '!=', 'Admin Produksi')->get();
        return view('user.users')->with([
            'users' => $users,
            'bagian' => ['Press Welding', 'Line Coating', 'Line Molding'],
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'bagian' => 'required',
            'password' => 'required',
            'email' => 'required',
            'departemen' => 'required',
        ];

        $messages = [
            'name.required' => "Nama Karyawan Harus Diisi",
            'bagian.required' => 'Bagian Karyawan Wajib Diisi',
            'password.required' => 'Kata sandi Karyawan Wajib Diisi',
            'email.required' => 'Email Karyawan Wajib Diisi',
            'departemen.required' => 'Departemen Karyawan Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = 'produksi';
            $user->departemen = $request->departemen;
            $user->bagian = $request->bagian;

            $user->save();

            return redirect()->back()->with(['success' => 'Karyawan ' . $user->name . ' berhasil tersimpan!']);
        } catch (QueryException $e) {
            // Handle the exception - Log, redirect, or show an error message
            if ($e->errorInfo[1] == 1062) {
                // Handle the duplicate entry error
                return redirect()->back()->with(['error' => 'Data Ada']);
            } else {
                // Handle other database errors
                return redirect()->back()->with(['error' => 'Database error: ' . $e->getMessage()]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Terjadi error, hubungi administrator']);
        }
    }

    public function updateIndex($id)
    {
        $user = User::find($id);
        return view('user.adminedit', with([
            'user' => $user,
            'bagian' => ['Press Welding', 'Line Coating', 'Line Molding'],
        ]));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = $request->password;
        }
        $user->bagian = $request->bagian;
        $user->save();

        $users = User::get();

        return redirect('employees')->with(['success' => 'Data Berhasil Diperbarui', 'products' => $users]);

    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            $users = User::get();
            return redirect('employees')->with(['success' => 'Data Berhasil Dihapus', 'products' => $users]);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Terjadi error, hubungi administrator. Kode ' . $e->getMessage()]);

        }
    }

    public function updateUserIndex()
    {
        return view('user.edit', with(['user' => Auth::user()]));
    }

    public function updateUser(Request $request)
    {
        try {
            $user = Auth::user();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password != null) {
                $user->password = $request->password;
            }

            $user->save();

            return redirect('/')->with(['success' => 'Data Berhasil Diperbarui']);

        } catch (Exception $e) {

        }
    }
}
