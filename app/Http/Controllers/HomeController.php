<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Validator;

use App\Models\klasifikasi;

class HomeController extends Controller
{
    public function index()
    {
        if(session('loged_in'))
        {
            $klasifikasi     = new klasifikasi();
            $data['dataset'] = $klasifikasi->dataset(session('uid'));

            return view('home', $data);
        }
        
        return view('login');
    }

    public function diagnosa(Request $request)
    {
        if(!session('loged_in'))
        {
            return view('login');
        }
        
        $klasifikasi = new klasifikasi();
        $id = $request->segment(2);
        
        $data['diagnosa'] = $klasifikasi->diagnosa();
        $data['id'] = $id;
        $data['one_diagnosa'] = $klasifikasi->one_hasil_diagnosa($id);
        return view('diagnosa', $data);
    }

    public function do_login(Request $request)
    {
        // validate the form
        $validation = $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        $klasifikasi = new klasifikasi();
        $row = $klasifikasi->validate_login($request->username, $request->password);
        if($row->total > 0)
        {
            $error = ValidationException::withMessages([
                'error' => ['Username atau password tidak valid.'],
            ]);
            throw $error;
        }
        
        // set first log in after reset pasword session
        $row = $klasifikasi->satu_wali($request->username);

        $request->session()->put('loged_in', true);
        $request->session()->put('uid', $row->id);
        $request->session()->put('nama', $row->wali);

        // redirect to change pasword after pasword reset
        return redirect(url('/'));
    }

    public function daftar()
    {
        if(session('loged_in'))
        {
            $klasifikasi     = new klasifikasi();
            $data['dataset'] = $klasifikasi->dataset();

            return view('home', $data);
        }
        
        return view('daftar');
    }

    public function do_daftar(Request $request)
    {
        // validate the form
        $validation = $request->validate([
            'wali'      => 'required',
            'username'  => 'required',
            'password'  => 'required',
            'telfon'    => 'required',
            'alamat'    => 'required'
        ]);

        $klasifikasi = new klasifikasi();
        $row = $klasifikasi->check_username($request->username);
        if($row->total > 0)
        {
            $error = ValidationException::withMessages([
                'error' => ['Username suda terpakai.'],
            ]);
            throw $error;
        }

        // insert new youtubes account
        DB::table('wali')->insert([
            'wali'      => ucwords($request->wali),
            'telfon'    => ucwords($request->telfon),
            'alamat'    => ucwords($request->alamat),
            'username'  => trim($request->username),
            'password'  => sha1($request->password)
        ]);
        
        // set first log in after reset pasword session
        $row = $klasifikasi->satu_wali($request->username);

        $request->session()->put('loged_in', true);
        $request->session()->put('uid', $row->id);
        $request->session()->put('nama', $row->wali);

        // redirect to change pasword after pasword reset
        return redirect(url('/'));
    }

    public function tambah_anak(Request $request)
    {
        // validate the form
        $validation = $request->validate([
            'nama'  => 'required',
            'jenis_kelamin'    => 'required'
        ]);

        // masukan data
        DB::table('anak')->insert([
            'nama'  => ucwords($request->nama),
            'jenis_kelamin'    => $request->jenis_kelamin,
            'id_wali'    => session('uid')
        ]);

        // masukan data
        DB::table('hasil_diagnosa')->insert([
            'id_anak'  => DB::getPdo()->lastInsertId()
        ]);

        return redirect(url('/'))->with(['success' => 'Berhasil menambahkan dataset.']);
    }

    public function hapus_anak(Request $request)
    {
        $klasifikasi = new klasifikasi();
        $id = $request->segment(2);
        
        $row = $klasifikasi->count_anak($id);
        if($row->total > 0)
        {
            DB::table('anak')->where('id', $id)->delete();
            return redirect(url('/'))->with(['success' => 'Berhasil hapus data training.']);
        }
        else
        {
            return redirect(url('/'))->with(['error' => 'ID data training tidak ditemukan.']);
        }
    }

    public function buat_diagnosa(Request $request)
    {
        $klasifikasi = new klasifikasi();
        $result      = $klasifikasi->diagnosa();

        $selected   = 0;
        $sel_index  = '';
        $sel_nama   = '';

        // validate the form
        foreach($result as $row)
        {
            if(isset($_POST[$row->code_diagnosa]))
            {
                $selected += 1;
                $sel_index .= $row->code_diagnosa.',';
                $sel_nama .= $row->diagnosa.'| ';
            }
        }

        if($selected < 1)
        {
            return redirect(url('diagnosa/'.$request->segment(2)))->with(['error' => 'Harus memilih salah satuh diagnosa.']);
        }

        // insert new youtubes account
        DB::table('hasil_diagnosa')
            ->where('id_anak', $request->segment(2))
            ->update([
                'code_diagnosa' => rtrim($sel_index, ', '),
                'nama_diagnosa' => rtrim($sel_nama, '| ')
            ]);

        return redirect(url('/'))->with(['success' => 'Berhasil melakukan diagnosa.']);
    }

    public function hasil_diagnosa(Request $request)
    {
        $klasifikasi = new klasifikasi();
        $id = $request->segment(2);

        $row    = $klasifikasi->one_hasil_diagnosa($id);
        if(!$row)
        {
            exit('Data dignosa tidak ditemukan. Silahkan tekan tombol kembali.');
        }

        $kebutuhan_kusus = $klasifikasi->kebutuhan_kusus();
        foreach($kebutuhan_kusus as $row)
        {
            ${'array_'.$row->code}  = $this->get_penyakit($row->code);
            ${'total_'.$row->code}  = 0;
        }
        
        $hasil = $klasifikasi->one_hasil_diagnosa($id);
        $sel_index  = explode(',', $hasil->code_diagnosa);
        foreach($sel_index as $val)
        {
            foreach($kebutuhan_kusus as $row)
            {
                if(in_array($val, ${'array_'.$row->code}))
                {
                    ${'total_'.$row->code} += 1;
                }
            }
        }

        // echo $total_P002;
        
        $list_jumlah    = array();
        $list_nama      = array();
        $list_np      = array();
        
        foreach($kebutuhan_kusus as $row)
        {
            array_push($list_jumlah, ${'total_'.$row->code});
            array_push($list_nama, $row->code);
            array_push($list_np, $row->jenis_kebutuhan);
        }

        $data['list_jumlah'] = $list_jumlah;
        $data['list_nama'] = $list_nama;
        $data['list_np'] = $list_np;
        $data['nama_anak'] = $klasifikasi->satu_anak($id);
        return view('hasil_diagnosa', $data);
    }

    protected function get_penyakit($penyakit)
    {
        $klasifikasi    = new klasifikasi();
        $list           = array();
        $pilek          = $klasifikasi->one_diagnosa1($penyakit);
        foreach($pilek as $row)
        {
            array_push($list, $row->code_diagnosa);
        }

        return $list;
    }
    
    public function jenis_kk()
    {
        $klasifikasi     = new klasifikasi();
        $data['kebutuhan_kusus'] = $klasifikasi->kebutuhan_kusus();
        return view('jenis_kk', $data);
    }

    public function tambah_jkk(Request $request)
    {
        // validate the form
        $validation = $request->validate([
            'code'  => 'required',
            'jenis_kebutuhan'    => 'required'
        ]);

        // masukan data
        DB::table('kebutuhan_kusus')->insert([
            'code'  => ucwords($request->code),
            'jenis_kebutuhan'    => $request->jenis_kebutuhan
        ]);

        return redirect(url('jenis_kk'))->with(['success' => 'Berhasil menambahkan kebutuhan kusus.']);
    }

    public function hapus_jkk(Request $request)
    {
        $klasifikasi = new klasifikasi();
        $id = $request->segment(2);
        
        DB::table('kebutuhan_kusus')->where('id', $id)->delete();
        return redirect(url('jenis_kk'))->with(['success' => 'Berhasil hapus data kebutuhan kusus.']);
    }
    
    public function jenis_diagnosa()
    {
        $klasifikasi     = new klasifikasi();
        $data['jenis_diagnosa'] = $klasifikasi->jenis_diagnosa();
        $data['kebutuhan_kusus'] = $klasifikasi->kebutuhan_kusus();
        return view('jenis_diagnosa', $data);
    }

    public function tambah_diagnosa(Request $request)
    {
        // validate the form
        $validation = $request->validate([
            'code'  => 'required',
            'jenis_kebutuhan'    => 'required',
            'diagnosa'    => 'required'
        ]);

        // masukan data
        DB::table('diagnosa')->insert([
            'code_diagnosa'  => ucwords($request->code),
            'code_kebutuhan'    => $request->jenis_kebutuhan,
            'diagnosa'    => $request->diagnosa
        ]);

        return redirect(url('jenis_diagnosa'))->with(['success' => 'Berhasil menambahkan diagnosa.']);
    }

    public function hapus_diagnosa(Request $request)
    {
        $klasifikasi = new klasifikasi();
        $id = $request->segment(2);
        
        DB::table('diagnosa')->where('id', $id)->delete();
        return redirect(url('jenis_diagnosa'))->with(['success' => 'Berhasil hapus data diagnosa.']);
    }
}
