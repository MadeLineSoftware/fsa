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

      <a href="/" class="link wfc">
        <button class="rsb-menu hovered_bcolor">Semua Dataset</button>
      </a>
      <a href="/data-training" class="link wfc">
        <button class="rsb-menu">Semua Data Training</button>
      </a>
    </div>
    <section id="wrapper" class="wrapper home">
      <div class="inner-wrapper">
        <div class="head-nav">
          <h3 style="text-align:center;">Sistem informasi klasifikasi calon mahasiswa penerima beasiswa menggunakan K-NN</h3>
          <!-- <h3 style="text-align:center;">Menggunakan K-NN</h3> -->
        </div>

        <hr>
        
        <form method="POST" action="{{ url('buat-klasifikasi') }}">
          @csrf
          <table>
            <tr>
                <td>
                  <label>K = </label>
                </td>
                <td>
                  <input type="text" name="K" value="{{ isset($K) ? $K : '' }}">
                  <input type="hidden" name="id" value="{{ $id }}">
                  <span class="error">{{ $errors->first('K') ? $errors->first('K') : (session('input_error') ? session('input_error') : '') }}</span>
                </td>
                <td>
                  <td><input type="submit" value="Buat Klasifikasi"></td>
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
            <th colspan="8" style="background: grey; color: white;">Daftar Data Training</th>
          </tr>
          <tr>
              <th>No.</th>
              <th>IPK</th>
              <th>GAJI ORANG TUA</th>
              <th>TANGGUNGAN ORANG TUA</th>
              <th>KLASIFIKASI</th>
              <th>EUCLIDEAN DISTANCE CALCULATION</th>
              <th>EUCLIDEAN DISTANCE</th>
          </tr>
          
            <?php
                $total_hitung = array();
                $terima = 0;
                $tidak  = 0;
            ?>

            @foreach($data_training as $row)
                <?php
                    $euclidena = sqrt(pow($row->ipk - $dataset->ipk, 2) + pow(str_replace('.', '', $row->gajih) - str_replace('.', '', $dataset->gajih), 2) + pow($row->tanggungan - $dataset->tanggungan, 2));

                    if($row->klasifikasi === 'Terima')
                    {
                        $terima += 1;
                    }
                    else
                    {
                        $tidak += 1;
                    }
                ?>
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $row->ipk }}</td>
                  <td>{{ $row->gajih }}</td>
                  <td>{{ $row->tanggungan }}</td>
                  <td>{{ $row->klasifikasi }}</td>
                  <td>&radic;<span style="text-decoration:overline;">({{ $row->ipk.' - '.$dataset->ipk }})<sup class="pow">2</sup> + ({{ $row->gajih.' - '.$dataset->gajih }})<sup class="pow">2</sup> + ({{ $row->tanggungan.' - '.$dataset->tanggungan }})<sup class="pow">2</sup></span></td>
                  <td>{{ $euclidena }}</td>
              </tr>
            @endforeach
      </table>
      
        @if(isset($K))
            <br><span>Jumlah data <b>Terima</b> dari <b>K = {{ $K }}</b> adalah <b>{{ $terima }}</b></span>
            <br><span>Jumlah data <b>Tidak</b> dari <b>K = {{ $K }}</b> adalah <b>{{ $tidak }}</b></span>
            
            @if($terima > $tidak)
                <br><br><span><b><i>{{ $dataset->nama }} berhak menerima beasiswa</i></b></span>
            @elseif($terima === $tidak)
                <br><br><span><b><i>Belum bisa menentukan hasil akhir, silahkan coba ganti angka "K"</i></b></span>
            @else
                <br><br><span><b><i>{{ $dataset->nama }} belum bisa menerima beasiswa</i></b></span>
            @endif
        @endif

      </div>
    </section>
  </body>
</html>