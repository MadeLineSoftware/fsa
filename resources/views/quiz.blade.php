<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Klasifikasi</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="csdev" name="author" />

    <link href="{{ asset('style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('reset.css') }}" rel="stylesheet" type="text/css">
  </head>

  <body class="hide-rtl body">
    <div class="left-pannel">
      <div class="rsb-heading">
        <div class="rsm-heading">
          <div class="manual-lfn">
            IMPLEMENTASI FINITE STATE AUTOMATA
          </div>
          <div class="manual-lfn bot-manual-lfn">
            PADA PROSES PENDAFTARAN KURSUS </i>
          </div>
        </div>
      </div>

      <a href="/" class="link wfc">
        <button class="rsb-menu">Home</button>
      </a>
      @foreach($quiz as $row)
      <a href="/quiz/{{ $row->id_quiz }}" class="link wfc">
        <button class="rsb-menu">{{ $row->nama_quiz }}</button>
      </a>
      @endforeach
      <a href="/sertifikat" class="link wfc">
        <button class="rsb-menu">Sertifikat</button>
      </a>
    </div>
    <section id="wrapper" class="wrapper home">
      <div class="inner-wrapper">
        <div class="head-nav" style="text-align:right;">
          <a href="/logout" style="text-align:right;">
            ({{ session('nama') }}) Logout
          </a>
        </div>

        <hr>

        @if($test == '')
            <h2>SELAMAT DATANG</h2>

            @if(session()->has('success'))
            <h3 class="success">{{ session('success') }}</h3>
            @elseif(session()->has('error'))
            <h1 class="error">{{ session('error') }}</h1>
            @elseif($errors->any())
            <h1 class="error">SILAHKAN DIISI SEMUA SOAL</h1>
            @endif

            <form method="POST" action="{{ url('buat_quiz/'.$id_quiz) }}">
                @csrf
                <table style="width:100%;">
                    @foreach($data as $row)
                        <tr>
                            <td>
                                {{ $loop->iteration }}. {{ $row->pertanyaan }}
                                <br>
                                <?php
                                    $data = explode('||', $row->pilihan);
                                ?>
                                @foreach($data as $val)
                                    <?php $value = $row->id_pertanyaan.'|'.explode(' ', $val)[0]; ?>
                                    @if($value === old($row->id_pertanyaan))
                                        <input type="radio" checked name="{{ $row->id_pertanyaan }}" value="{{ $row->id_pertanyaan.'|'.explode(' ', $val)[0] }}">
                                    @else
                                        <input type="radio" name="{{ $row->id_pertanyaan }}" value="{{ $row->id_pertanyaan.'|'.explode(' ', $val)[0] }}">
                                    @endif
                                    {{ $val }} <br>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Selesai" /></td>
                    </tr>
                </table>
            </from>
        @else
            <h2>ANDA SUDAH SELESAI MELAKUKAN TEST INI, SILAHKAN SELESAIKAN TEST YANG LAIN KEMUDIAN LIHAT SERTIFIKAT</h2>
        @endif
      </div>
    </section>
  </body>
</html>
