<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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
        $users = User::where('username', '<>', 'super_admin')->where('status_hapus', '<>', 1)->get();
        return view('master.karyawan', compact('users'));
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
        $validation = new User();
        $validation = $validation->validator($request->all());
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
        //
        // $id = $request->input('txtID');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user->status_hapus = 1;
        $user->updated_at = date("Y-m-d H:i:s");
        $user->save();
        return redirect()->back()->with(['message' => 'Data karyawan berhasil dihapus.']);
    }

    public function destroyChecked(Request $request)
    {
        $arrId = $request->input('txtDeleteAll');

        foreach ($arrId as $key => $value) {
            $user = User::find($value);
            $user->status_hapus = 1;
            $user->updated_at = date("Y-m-d H:i:s");
            $user->save();
        }

        return redirect()->back()->with(['message' => 'Data karyawan berhasil dihapus.']);
    }

    public function getProfile()
    {
        $user = User::where('id', '=', Auth::user()->id)->where('status_hapus', '<>', 1)->get();
        return view('master.profile', compact('user'));
    }

    public function cekPassword(Request $request)
    {
        $pass = $request->oldpass;
        $user = User::where('id', '=', Auth::user()->id)->where('status_hapus', '<>', 1)->get();
        $istrue = "false";
        if ($user->password_plain == $pass) {
            $istrue = "true";
        }
        return $istrue;
    }

    public function gantiPass(Request $request)
    {
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

    public function exportTemplate()
    {
        Excel::create('template_karyawan', function ($excel) {
            // Set the title
            $excel->setTitle('Template Data Master Karyawan');
            // $excel->setCreator('no no creator')->setCompany('no company');
            // $excel->setDescription('report file');

            $excel->sheet('sheet1', function ($sheet) {
                $data = array(
                    array('id', 'nik', 'name', 'username', 'password', 'alamat', 'telp', 'tanggal_lahir', 'tanggal_gabung'),
                    array('1', '00000001', 'Adi', 'adi_admin', 'adi123', 'Jl. Kertajaya Indah Timur IX No. 1 Surabaya', '087761525167', '1997-01-01', '2018-01-01'),
                    array('2', '00000002', 'Bagas', 'bagas_admin', 'bagas123', 'Jl. Kertajaya Indah Timur IX No. 1 Surabaya', '087761525167', '1997-01-01', '2018-01-01')
                );
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->cells('A1:I1', function ($cells) {
                    $cells->setBackground('#AAAAFF');
                });
            });
        })->download('xlsx');
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
