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
        <button class="rsb-menu">Daftar Anak</button>
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

        @if(session()->has('success'))
          <h3 class="success">{{ session('success') }}</h3>
        @elseif(session()->has('error'))
          <h1 class="error">{{ session('error') }}</h1>
        @endif

        <form method="POST" action="{{ url('buat_diagnosa/'.$id) }}">
            @csrf
            <table border="1" style="width:100%;">
                <tr>
                    <th colspan="6" style="background: grey; color: white;">Daftar Diagnosa</th>
                </tr>
                @foreach($diagnosa as $row)
                    <tr>
                        <td>{{ '['.$row->code_diagnosa.'] '.$row->diagnosa }}</td>
                        <td>                            
                            <label class="container">
                                @foreach(explode(',', rtrim($one_diagnosa->code_diagnosa)) as $val)
                                    @if($val === $row->code_diagnosa)
                                        <input type="checkbox" checked name="{{ $row->code_diagnosa }}" value="{{ $row->code_diagnosa }}">
                                    @else
                                        <input type="checkbox" name="{{ $row->code_diagnosa }}" value="{{ $row->code_diagnosa }}">
                                    @endif
                                @endforeach
                                <span class="checkmark"></span>
                            </label>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td><input type="submit" value="Buat Diagnosa" /></td>
                    <td></td>
                </tr>
            </table>
        </form>
      </div>
    </section>
  </body>
</html>
