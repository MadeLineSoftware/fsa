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
            Klasifikasi calon mahasiswa penerima beasiswa
          </div>
          <div class="manual-lfn bot-manual-lfn">
            Menggunakan K-NN
          </div>
        </div>
      </div>

      <a href="jenis_diagnosa" class="link wfc">
        <button class="rsb-menu hovered_bcolor">Semua jenis diagnosa</button>
      </a>
      <a href="jenis_kk" class="link wfc">
        <button class="rsb-menu">Semua jenis kebutuhan kusus</button>
      </a>
    </div>
    <section id="wrapper" class="wrapper home">
      <div class="inner-wrapper">
        <div class="head-nav">
          <h3 style="text-align:center;">Sistem informasi klasifikasi calon mahasiswa penerima beasiswa menggunakan K-NN</h3>
          <!-- <h3 style="text-align:center;">Menggunakan K-NN</h3> -->
        </div>

        <hr>
        
        <form method="POST" action="{{ url('tambah_diagnosa') }}">
          @csrf
          <table style="width:100%;">
            <tr>
                <td>
                  <label>Code</label>
                  <input type="text" name="code" placeholder="contoh: G001" value="{{ old('code') }}">
                  <span class="error">{{ $errors->first('code') }}</span>
                </td>
                <td>
                  <label>Diganosa</label>
                  <input type="text" name="diagnosa" placeholder="contoh: Mata tampak merah" value="{{ old('diagnosa') }}">
                  <span class="error">{{ $errors->first('diagnosa') }}</span>
                </td>
                <td>
                  <label>Jenis kebutuhan kusus</label>
                    <select name="jenis_kebutuhan">
                        <option value="">Pilih Jenis Kebutuhan</option>
                        @foreach($kebutuhan_kusus as $row)
                            <option value="{{ $row->code }}" {{ old('jenis_kebutuhan') === $row->code ? 'selected' : '' }}>{{ '['.$row->code.'] '.$row->jenis_kebutuhan }}</option>
                        @endforeach
                    </select>
                  <span class="error">{{ $errors->first('jenis_kebutuhan') }}</span>
                </td>
                <td>
                  <td><input type="submit" value="Tambah data"></td>
                </td>
            </tr>
          </table>
        </form>

        <hr>

        @if(session()->has('success'))
          <h3 class="success">{{ session('success') }}</h3>
        @elseif(session()->has('error'))
          <h3 class="error">{{ session('error') }}</h3>
        @endif

        <table border="1" style="width:100%;">
          <tr>
            <th colspan="6" style="background: grey; color: white;">Daftar Jenis Diagnosa</th>
          </tr>
          <tr>
              <th>NO.</th>
              <th>CODE</th>
              <th>DIAGNOSA</th>
              <th>JENIS KEBUTUHAN KUSUS</th>
              <th>ACTION</th>
          </tr>
          @foreach($jenis_diagnosa as $row)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $row->code_diagnosa }}</td>
                  <td>{{ $row->diagnosa }}</td>
                  <td>{{ '['.$row->code.'] '.$row->jenis_kebutuhan }}</td>
                  <td>
                      <a href="{{ url('hapus_diagnosa/'.$row->id) }}">Hapus data</a>
                  </td>
              </tr>
          @endforeach
      </table>

      </div>
    </section>
  </body>
</html>