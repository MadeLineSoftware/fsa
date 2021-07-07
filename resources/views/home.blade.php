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

        <h2>SELAMAT DATANG</h2>

        <table border="1" style="width:100%;">
          <tr>
              <td>BAHASA INGGRIS</td>
              <td>
                @if($english == '')
                <a href="/quiz/1" style="text-align:right;">
                  AMBIL TEST
                </a>
                @else
                  SUDAH DIAMBIL
                @endif
              </td>
          </tr>
          <tr>
              <td>MATEMATIKA</td>
              <td>
                @if($matematika == '')
                <a href="/quiz/2" style="text-align:right;">
                  AMBIL TEST
                </a>
                @else
                  SUDAH DIAMBIL
                @endif
              </td>
          </tr>
          <tr>
              <td>BAHASA INDONESIA</td>
              <td>
                @if($bahasa == '')
                <a href="/quiz/3" style="text-align:right;">
                  AMBIL TEST
                </a>
                @else
                  SUDAH DIAMBIL
                @endif
              </td>
          </tr>
          <tr>
              <td>IPA</td>
              <td>
                @if($ipa == '')
                <a href="/quiz/4" style="text-align:right;">
                  AMBIL TEST
                </a>
                @else
                  SUDAH DIAMBIL
                @endif
              </td>
          </tr>
        </table>

      </div>
    </section>
  </body>
</html>
