<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class klasifikasi extends Model
{
    use HasFactory;

    public function check_username($un = '')
    {
        return DB::table('users')
                ->select(DB::raw(
                    "COUNT(*) as total"
                ))
                ->where([
                    ['username', $un]
                ])
                ->first();
    }

    public function quiz()
    {
        return DB::table('quiz')->get();
    }

    public function get_quiz($uid, $qid)
    {
        return DB::table('test_quiz')
                ->where([
                    ['user_id', $uid],
                    ['id_quiz', $qid]
                ])
                ->first();
    }

    public function one_quiz($qid)
    {
        return DB::table('pertanyaan')
                ->where([
                    ['id_quiz', $qid]
                ])
                ->get();
    }

    public function get_jawab($pid, $uid)
    {
        return DB::table('test_quiz')
                ->where([
                    ['user_id', $uid],
                    ['id_pertanyaan', $pid]
                ])
                ->first();
    }

    public function satu_wali($un = '')
    {
        return DB::table('users')
                ->where([
                    ['username', $un]
                ])
                ->first();
    }

    public function validate_login($un = '', $pass = '')
    {
        return DB::table('users')
                ->select(DB::raw(
                    "COUNT(*) as total"
                ))
                ->where([
                    ['username', $un],
                    ['password', $pass]
                ])
                ->first();
    }

    public function dataset($id_wali)
    {
        return DB::table('anak')
                ->leftJoin('hasil_diagnosa', 'anak.id', '=', 'hasil_diagnosa.id_anak')
                ->where([
                    ['anak.id_wali', $id_wali]
                ])
                ->orderBy('anak.id', 'DESC')
                ->get();
    }

    public function satu_anak($id)
    {
        return DB::table('anak')
                ->where([
                    ['id', $id]
                ])
                ->first();
    }
    
    public function count_anak($id)
    {
        return DB::table('anak')
                ->select(DB::raw(
                    "COUNT(*) as total"
                ))
                ->where([
                    ['id', $id]
                ])->first();
    }

    public function kebutuhan_kusus()
    {
        return DB::table('kebutuhan_kusus')->orderBy('code')->get();
    }

    public function one_diagnosa1($code = '')
    {
        return DB::table('diagnosa')->where(['code_kebutuhan' => $code])->get();
    }

    public function jenis_diagnosa()
    {
        return DB::table('diagnosa')
                ->leftJoin('kebutuhan_kusus', 'diagnosa.code_kebutuhan', '=', 'kebutuhan_kusus.code')
                ->orderBy('diagnosa.code_diagnosa')
                ->get();
    }

    public function diagnosa()
    {
        return DB::table('diagnosa')
                ->orderBy('diagnosa.code_diagnosa')
                ->get();
    }

    public function one_diagnosa($id = '')
    {
        return DB::table('diagnosa')
                ->where([
                    ['id', $id]
                ])
                ->first();
    }

    public function one_hasil_diagnosa($id = '')
    {
        return DB::table('hasil_diagnosa')
                ->where([
                    ['id_anak', $id]
                ])
                ->first();
    }
}