<?php

namespace App\Http\Controllers\master;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $karyawan = User::where('username', '<>', 'super_admin')->where('status_hapus', '<>', 1)->get();
        return view('master.karyawan.index', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $validation =  Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:6',
                'nik' => 'required',
                'alamat' => 'required',
                'telp' => 'required',
                'tanggal_lahir' => 'required',
                'tanggal_gabung' => 'required'
            ]);
            if ($validation->fails()) {
                return redirect()->back()->with(['danger_message' => 'Data karyawan gagal disimpan.']);
            } else {
                $new = new User();
                $new->name = $request->input('name');
                $new->username = $request->input('username');
                $new->password = Hash::make($request->input('password'));
                $new->password_plain = $request->input('password');
                $new->nik = $request->input('nik');
                $new->alamat = $request->input('alamat');
                $new->telp = $request->input('telp');
                $new->tanggal_lahir = date("Y-m-d", strtotime($request->input('tanggal_lahir')));
                $new->tanggal_gabung = date("Y-m-d", strtotime($request->input('tanggal_gabung')));
                $new->created_at = date("Y-m-d H:i:s");
                $new->updated_at = date("Y-m-d H:i:s");
                $new->status_hapus = 0;
                $new->save();
    
                return redirect()->back()->with(['message' => 'Data karyawan berhasil disimpan.']);
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with(['danger_message' => 'Data karyawan gagal disimpan.']);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $karyawan = User::find($id);
        echo json_encode($karyawan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $karyawan = User::find($id);
        echo json_encode($karyawan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $karyawan = User::find($id);
            $karyawan->name = $request->input('txtNamaKaryawanEdit');
            $karyawan->username = $request->input('txtUsernameEdit');
            $karyawan->password = Hash::make($request->input('txtPasswordEdit'));
            $karyawan->password_plain = $request->input('txtPasswordEdit');
            $karyawan->nik = $request->input('txtNikEdit');
            $karyawan->alamat = $request->input('txtAlamatEdit');
            $karyawan->telp = $request->input('txtPhoneNumberEdit');
            $karyawan->tanggal_lahir = date("Y-m-d", strtotime($request->input('txtBirthDateEdit')));
            $karyawan->tanggal_gabung = date("Y-m-d", strtotime($request->input('txtJoinDateEdit')));
            $karyawan->updated_at = date("Y-m-d H:i:s");
            $karyawan->save();
            return redirect()->back()->with(['message' => 'Data karyawan berhasil diubah.']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['danger_message' => 'Data karyawan gagal diubah.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try {
            if($request->jenis_delete == 'all'){
                $arrId = $request->input('txtDeleteAll');
                foreach ($arrId as $key => $value) {
                    $user = User::find($value);
                    $user->status_hapus = 1;
                    $user->updated_at = date("Y-m-d H:i:s");
                    $user->save();
                }
                return redirect()->back()->with(['message' => 'Data karyawan berhasil dihapus.']);
            }
            else{
                $user = User::find($id);
                $user->status_hapus = 1;
                $user->updated_at = date("Y-m-d H:i:s");
                $user->save();
                return redirect()->back()->with(['message' => 'Data karyawan berhasil dihapus.']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with(['danger_message' => 'Data karyawan gagal dihapus.']);
        }
       
    }

    public function getProfile()
    {
        $user = User::where('id', '=', Auth::user()->id)->where('status_hapus', '<>', 1)->get();
        return view('master.profile', compact('user'));
    }

    public function passwordActions(Request $request)
    {
        if($request->jenis_action == 'cek_password'){
            $pass = $request->oldpass;
            $user = User::where('id', '=', Auth::user()->id)->where('status_hapus', '<>', 1)->get();
            $istrue = "false";
            if ($user->password_plain == $pass) {
                $istrue = "true";
            }
            return $istrue;
        }
        else{
            try {
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->input('inputNewPass'));
                $user->password_plain = $request->input('inputNewPass');
                $user->updated_at = date("Y-m-d H:i:s");
                $user->save();
            } catch (Exception $e) {
                return redirect()->back()->with(['danger_message' => 'Ganti password gagal']);
            }
    
            return redirect()->back()->with(['message' => 'Ganti password berhasil']);
        }
    }

    public function importKaryawan(Request $request)
    {
        if ($request->hasFile('input-file-now')) {
            $path = $request->file('input-file-now')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $users = User::where('username', '=', $value->username)->where('status_hapus', '<>', 1)->get();
                    $users_id = User::where('id', $value->id)->get();

                    if (count($users) != 0 || strlen($value->password) < 6 || count($users_id) != 0) {
                        return redirect()->back()->with(['danger_message' => 'Data karyawan gagal disimpan.']);
                    } else {
                        $new = new User();
                        $new->name = $value->id;
                        $new->username = $value->username;
                        $new->password = Hash::make($value->password);
                        $new->password_plain = $value->password;
                        $new->nik = $value->nik;
                        $new->alamat = $value->alamat;
                        $new->telp = $value->telp;
                        $new->tanggal_lahir =  date("Y-m-d", strtotime($value->tanggal_lahir));
                        $new->tanggal_gabung = date("Y-m-d", strtotime($value->tanggal_lahir));
                        $new->created_at = date("Y-m-d H:i:s");
                        $new->updated_at = date("Y-m-d H:i:s");
                        $new->status_hapus = 0;
                        $new->save();
                       
                    }
                }

                return redirect()->back()->with(['message' => 'Data karyawan berhasil disimpan.']);
            } else {
                return redirect()->back()->with(['danger_message' => 'Data import kosong.']);
            }
        }
    }
}
