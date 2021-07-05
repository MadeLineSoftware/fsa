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
        return DB::table('wali')
                ->select(DB::raw(
                    "COUNT(*) as total"
                ))
                ->where([
                    ['username', $un]
                ])
                ->first();
    }

    public function satu_wali($un = '')
    {
        return DB::table('wali')
                ->where([
                    ['username', $un]
                ])
                ->first();
    }

    public function validate_login($un = '', $pass = '')
    {
        return DB::table('wali')
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




    
    // public function count_dataset($id)
    // {
    //     return DB::table('dataset')
    //             ->select(DB::raw(
    //                 "COUNT(*) as total"
    //             ))
    //             ->where([
    //                 ['id', $id]
    //             ])->first();
    // }
    
    // public function one_dataset($id)
    // {
    //     return DB::table('dataset')
    //             ->where([
    //                 ['id', $id]
    //             ])->first();
    // }

    // public function data_training()
    // {
    //     return DB::table('data_training')->get();
    // }

    // public function sort_data_training()
    // {
    //     return DB::table('data_training')->orderBy('total')->get();
    // }

    // public function hasil_uji($k = '')
    // {
    //     return DB::table('data_training')->orderBy('total')->take($k)->get();
    // }
    
    // public function count_data_training($id)
    // {
    //     return DB::table('data_training')
    //             ->select(DB::raw(
    //                 "COUNT(*) as total"
    //             ))
    //             ->where([
    //                 ['id', $id]
    //             ])->first();
    // }
    
    // public function one_data_training($id)
    // {
    //     return DB::table('data_training')
    //             ->where([
    //                 ['id', $id]
    //             ])->first();
    // }
}