<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Klasifikasi</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="csdev" name="author" />

    <link href="{{ asset('style1.css') }}" rel="stylesheet" type="text/css">
  </head>

  <body class="hide-rtl" style="background: url({{ asset('images/bg.jpg') }}); background-size:cover;">
    <div id="wrapper" class="wrapper ftg daftar">
        @if($errors->first('error'))
            <span class="error">{{ $errors->first('error') }}</span>
        @endif
      <form method="POST" action="{{ url('do_daftar') }}">
        @csrf

        <table style="width:100%;">
            <tr>
                <td>Nama Wali</td>
                <td>
                    <input type="text" name="wali" placeholder="nama wali" value="{{ old('wali') }}">
                    <span class="error">{{ $errors->first('wali') }}</span>
                </td>
            </tr>
            <tr>
                <td>No Telfon</td>
                <td>
                    <input type="text" name="telfon" placeholder="nomor telfon" value="{{ old('telfon') }}">
                    <span class="error">{{ $errors->first('telfon') }}</span>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    <input type="text" name="alamat" placeholder="alamat" value="{{ old('alamat') }}">
                    <span class="error">{{ $errors->first('alamat') }}</span>
                </td>
            </tr>
            <tr>
                <td>Username</td>
                <td>
                    <input type="text" name="username" placeholder="username" value="{{ old('username') }}">
                    <span class="error">{{ $errors->first('username') }}</span>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password" placeholder="password" value="{{ old('password') }}">
                    <span class="error">{{ $errors->first('password') }}</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Regis">
                    <a href="{{ url('/') }}">
                        <div class="h1b" style="background: gray;">Login</div>
                    </a>
                </td>
            </tr>
        </table>
      </form>
    </div>
  </body>
</html>
