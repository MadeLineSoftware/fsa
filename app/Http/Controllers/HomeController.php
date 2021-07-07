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
            $data['quiz']   = $klasifikasi->quiz();
            $data['english']    = $klasifikasi->get_quiz(session('uid'), 1);
            $data['matematika']    = $klasifikasi->get_quiz(session('uid'), 2);
            $data['bahasa']    = $klasifikasi->get_quiz(session('uid'), 3);
            $data['ipa']    = $klasifikasi->get_quiz(session('uid'), 4);

            return view('home', $data);
        }
        
        return view('login');
    }
    

    public function admin(Request $request)
    {
        $klasifikasi    = new klasifikasi();

        $data['quiz']   = $klasifikasi->quiz();
        return view('admin', $data);
    }

    public function buat_pertanyaan(Request $request)
    {
        // validate the form
        $validation = $request->validate([
            'quiz'  => 'required',
            'pertanyaan'  => 'required',
            'a'  => 'required',
            'b'  => 'required',
            'c'  => 'required',
            'd'  => 'required',
            'jawaban'  => 'required'
        ]);
        
        $pilihan    = 'a '.ucwords($request->a).'||b '.ucwords($request->b).'||c '.ucwords($request->c).'||d '.ucwords($request->d);
        DB::table('pertanyaan')->insert([
            'pertanyaan'    => ucwords($request->pertanyaan),
            'pilihan'    => $pilihan,
            'jawaban'    => $request->jawaban,
            'id_quiz'  => $request->quiz,
        ]);
        
        return redirect(url('admin'))->with(['success' => 'Berhasil tambah pertanyaan.']);
    }

    public function quiz(Request $request)
    {
        $klasifikasi = new klasifikasi();
        $id = $request->segment(2);
        $data['data']   = $klasifikasi->one_quiz($id);
        $data['quiz']   = $klasifikasi->quiz();
        $data['id_quiz']   = $id;
        $data['test']    = $klasifikasi->get_quiz(session('uid'), $id);
        return view('quiz', $data);
    }

    public function buat_quiz(Request $request)
    {
        $klasifikasi = new klasifikasi();
        $id = $request->segment(2);
        
        $selected = 0;
        $data   = $klasifikasi->one_quiz($id);
        foreach($data as $row)
        {
            if(!isset($_POST[$row->id_pertanyaan]))
            {
                $selected += 1;
            }
        }

        if($selected > 0)
        {
            return redirect(url('quiz/'.$request->segment(2)))->with(['error' => 'Semua pertanyaan harus dijawab.']);
        }
        
        foreach($data as $row)
        {
            $jawaban = $row->jawaban;
                $id_pertanyaan = $row->id_pertanyaan;
                DB::table('test_quiz')
                    ->insert([
                        'user_id' => session('uid'),
                        'id_pertanyaan' => $row->id_pertanyaan,
                        'id_quiz' => $id,
                        // 'benar' => $benar,
                        'jawaban' => explode('|', $request->$id_pertanyaan)[1]
                    ]);
        }

        return redirect(url('/quiz/'.$id))->with(['success' => 'Berhasil melakukan test.']);
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
        $request->session()->put('nama', $row->nama);

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

    public function sertifikat()
    {
        $klasifikasi = new klasifikasi();
        $uid = session('uid');
        $data['quiz']   = $klasifikasi->quiz();

        $english = $klasifikasi->one_quiz(1);
        $ebanar = 0;
        $esalah = 0;
        foreach($english as $row)
        {
            $dat = $klasifikasi->get_jawab($row->id_pertanyaan, session('uid'));
            $ujawab = $dat->jawaban;
            if($row->jawaban === $ujawab)
            {
                $ebanar += 1;
            }
            else
            {
                $esalah += 1;
            }
        }

        $data['b_english']    = $ebanar;
        $data['s_english']    = $esalah;

        $mate = $klasifikasi->one_quiz(2);
        $ebanar = 0;
        $esalah = 0;
        foreach($mate as $row)
        {
            $dat = $klasifikasi->get_jawab($row->id_pertanyaan, session('uid'));
            $ujawab = $dat->jawaban;
            if($row->jawaban === $ujawab)
            {
                $ebanar += 1;
            }
            else
            {
                $esalah += 1;
            }
        }

        $data['b_mate']    = $ebanar;
        $data['s_mate']    = $esalah;

        $bahasa = $klasifikasi->one_quiz(3);
        $ebanar = 0;
        $esalah = 0;
        foreach($bahasa as $row)
        {
            $dat = $klasifikasi->get_jawab($row->id_pertanyaan, session('uid'));
            $ujawab = $dat->jawaban;
            if($row->jawaban === $ujawab)
            {
                $ebanar += 1;
            }
            else
            {
                $esalah += 1;
            }
        }

        $data['b_bahasa']    = $ebanar;
        $data['s_bahasa']    = $esalah;

        $ipa = $klasifikasi->one_quiz(4);
        $ebanar = 0;
        $esalah = 0;
        foreach($ipa as $row)
        {
            $dat = $klasifikasi->get_jawab($row->id_pertanyaan, session('uid'));
            $ujawab = $dat->jawaban;
            if($row->jawaban === $ujawab)
            {
                $ebanar += 1;
            }
            else
            {
                $esalah += 1;
            }
        }

        $data['b_ipa']    = $ebanar;
        $data['s_ipa']    = $esalah;

        


        return view('sertifikat', $data);
    }
}
