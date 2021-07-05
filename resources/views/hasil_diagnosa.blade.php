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

        <?php
        ?>

        <table border="1" style="width:100%;">
            <!-- <tr>
                <th colspan="6" style="background: grey; color: white;">Daftar Dataset</th>
            </tr> -->
            <tr>
                <th>JENIS KEBUTUHAN</th>
                <th>JUMLAH DIAGNOSA</th>
            </tr>

            @for($i = 0; $i < count($list_jumlah); $i++)
                <tr>
                    <td>{{ '['.$list_nama[$i].'] '.$list_np[$i]}}</td>
                    <td>{{$list_jumlah[$i]}}</td>
                </tr>
            @endfor

        <?php
        
            // Klasifikasi berdasarkan jumlah gejalah
            for($i = 0; $i < count($list_jumlah) - 1; $i++)
            {
                $min    = $i;
                for($j = $i + 1; $j < count($list_jumlah); $j++)
                {
                    if($list_jumlah[$j] > $list_jumlah[$min])
                    {
                        $min    = $j;
                    }

                    // swap jumlah gejalah
                    $temp_jumlah        = $list_jumlah[$min];
                    $list_jumlah[$min]  = $list_jumlah[$i];
                    $list_jumlah[$i]    = $temp_jumlah;

                    // swap nama gejalah
                    $temp_nama        = $list_nama[$min];
                    $list_nama[$min]  = $list_nama[$i];
                    $list_nama[$i]    = $temp_nama;

                    // swap nama gejalah
                    $temp_np        = $list_np[$min];
                    $list_np[$min]  = $list_np[$i];
                    $list_np[$i]    = $temp_np;
                }
            }

            // get result
            $new_list_jumlah    = array();
            $new_list_nama      = array();
            $new_list_np      = array();
            $great = $list_jumlah[0];
            for($i = 0; $i < count($list_jumlah) - 1; $i++)
            {
                if($list_jumlah[$i] === $great)
                {
                    array_push($new_list_jumlah, $list_jumlah[$i]);
                    array_push($new_list_nama, $list_nama[$i]);
                    array_push($new_list_np, $list_np[$i]);
                }
            }
        ?>
            <tr style="border:none;">
                <td colspan="3"></td>
            </tr>
            <tr style="border:none;">
                <td colspan="3"></td>
            </tr>
            <tr style="border:none;">
                <td colspan="3"></td>
            </tr>
            <tr style="border:none;">
                <td colspan="3"></td>
            </tr>
            <tr>
                <th colspan="3">HASIL KLASIFIKASI</th>
            </tr>
        
            @for($i = 0; $i < count($new_list_jumlah); $i++)
                <tr>
                    <td style='padding:5px 10px;'>{{ '['.$new_list_nama[$i].'] '.$new_list_np[$i]}}</td>
                    <td style='padding:5px 10px;'>{{$new_list_jumlah[$i]}}</td>
                </tr>
            @endfor

            
            <tr style="border:none;">
                <td colspan="3"></td>
            </tr>
            <tr style="border:none;">
                <td colspan="3"></td>
            </tr>
            <tr style="border:none;">
                <td colspan="3"></td>
            </tr>
            <tr style="border:none;">
                <td colspan="3"></td>
            </tr>
            <tr>
                <th colspan="3">HASIL JENIS KEBUTUHAN KUSUS</th>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center;">
                    Berdasarkan metode Backward Chaining jenis kebutuhan kusus dari <b><i>{{$nama_anak->nama}}</i></b> adalah
                    <?php
                        $penyakit   = '';
                        for($i = 0; $i < count($new_list_jumlah); $i++)
                        {
                            $penyakit .= $new_list_np[$i].', ';
                        }
                    ?>

                    <span><b><i>"{{rtrim($penyakit, ', ')}}"</i></b></span>
                </td>
            </tr>
        </table>
      </div>
    </section>
  </body>
</html>
