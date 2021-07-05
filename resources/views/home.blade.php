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
            DIAGNOSA ANAK BERKEBUTUHAN KHUSUS
          </div>
          <div class="manual-lfn bot-manual-lfn">
            MENGGUNAKAN <i>BACKWARD CHAINING</i>
          </div>
        </div>
      </div>

      <a href="/" class="link wfc">
        <button class="rsb-menu hovered_bcolor">Daftar Anak</button>
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
        
        <form method="POST" action="{{ url('tambah_anak') }}">
          @csrf
          <table style="width:100%;">
            <tr>
                <td>
                  <label>Nama</label>
                  <input type="text" name="nama" placeholder="contoh agung widjaya" value="{{ old('nama') }}">
                  <span class="error">{{ $errors->first('nama') }}</span>
                </td>
                <td>
                  <label>Jenis Kelamin</label>
                  <select name="jenis_kelamin">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="l" {{ old('jenis_kelamin') === 'l' ? 'selected' : '' }}>Laki - Laki</option>
                    <option value="p" {{ old('jenis_kelamin') === 'p' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                  <span class="error">{{ $errors->first('jenis_kelamin') }}</span>
                </td>
                <td>
                  <input type="submit" value="Tambah Anak">
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
            <th colspan="6" style="background: grey; color: white;">Daftar Dataset</th>
          </tr>
          <tr>
              <th>NO.</th>
              <th>NAMA ANAK</th>
              <th>JENIS KELAMIN</th>
              <th>DIAGNOSA</th>
              <th>ACTION</th>
          </tr>
          @foreach($dataset as $row)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $row->nama }}</td>
                  <td>{{ $row->jenis_kelamin === 'l' ? 'Laki - Laki' : 'Perempuan' }}</td>
                  <td>
                    <?php if(!empty($row->code_diagnosa)) { ?>
                      <ol>
                          @foreach(explode('| ', rtrim($row->nama_diagnosa)) as $val)
                              <li>{{ $val }}</li>
                          @endforeach
                      </ol>
                    <?php } else { echo 'BELUM DIDIAGNOSA!'; } ?>
                  <td>
                    <a href="{{ url('hasil_diagnosa/'.$row->id_anak) }}">Lihat Hasil Diagnosa</a><hr>
                    <a href="{{ url('diagnosa/'.$row->id_anak) }}">Diagnosa</a><hr>
                    <a href="{{ url('hapus_anak/'.$row->id_anak) }}">Hapus data</a>
                  </td>
              </tr>
          @endforeach
      </table>

      </div>
    </section>
  </body>
</html>
