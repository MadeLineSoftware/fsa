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
    <div id="wrapper" class="wrapper ftg login">
        @if(session()->has('error'))
            <span class="error">{{ session('error') }}</span>
        @endif
      <form method="POST" action="{{ url('do_login') }}">
        @csrf

        <table style="width:100%;">
            @if(session()->has('success'))
                <tr>
                    <td></td>
                    <td>
                        <span class="success">{{ session('success') }}</span>
                    </td>
                </tr>
            @endif

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
                    <input type="submit" value="Login">
                    <a href="{{ url('daftar') }}">
                        <div class="h1b" style="background: gray;">Daftar</div>
                    </a>
                </td>
            </tr>
        </table>
      </form>
    </div>
  </body>
</html>
