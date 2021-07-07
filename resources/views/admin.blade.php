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
    </div>
    <section id="wrapper" class="wrapper home">
      <div class="inner-wrapper">
        <div class="head-nav" style="text-align:right;">
          <a href="/logout" style="text-align:right;">
            Admin
          </a>
        </div>

        <hr>

        @if(session()->has('success'))
          <h3 class="success">{{ session('success') }}</h3>
        @elseif(session()->has('error'))
          <h1 class="error">{{ session('error') }}</h1>
        @endif

        <form method="POST" action="{{ url('buat_pertanyaan') }}">
            @csrf
            <table border="1" style="width:100%;">
                <tr>
                    <td>
                      <label>Quiz</label>
                    </td>
                    <td>
                      <select name="quiz">
                        <option value="">Pilih quiz</option>
                        @foreach($quiz as $row)
                          <option value="{{ $row->id_quiz }}" {{ old('quiz') == $row->id_quiz ? 'selected' : '' }}>{{ $row->nama_quiz }}</option>
                        @endforeach
                      </select>
                      <span class="error">{{ $errors->first('quiz') }}</span>
                    </td>
                </tr>
                <tr>
                    <td>Pertanyaan</td>
                    <td>
                      <textarea name="pertanyaan" placeholder="pertanyaan">{{ old('pertanyaan') }}</textarea>
                      <span class="error">{{ $errors->first('pertanyaan') }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                      <label>a.</label>
                    </td>
                    <td>
                      <input type="text" name="a" placeholder="pilihan a" value="{{ old('a') }}">
                      <span class="error">{{ $errors->first('a') }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                      <label>b.</label>
                    </td>
                    <td>
                      <input type="text" name="b" placeholder="pilihan b" value="{{ old('b') }}">
                      <span class="error">{{ $errors->first('b') }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                      <label>c.</label>
                    </td>
                    <td>
                      <input type="text" name="c" placeholder="pilihan c" value="{{ old('c') }}">
                      <span class="error">{{ $errors->first('c') }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                      <label>d.</label>
                    </td>
                    <td>
                      <input type="text" name="d" placeholder="pilihan d" value="{{ old('d') }}">
                      <span class="error">{{ $errors->first('d') }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                      <label>Jawaan</label>
                    </td>
                    <td>
                      <select name="jawaban">
                        <option value="">Pilih jawaban</option>
                        <option value="a" {{ old('jawaban') == 'a' ? 'selected' : '' }}>a</option>
                        <option value="b" {{ old('jawaban') == 'b' ? 'selected' : '' }}>b</option>
                        <option value="c" {{ old('jawaban') == 'c' ? 'selected' : '' }}>c</option>
                        <option value="d" {{ old('jawaban') == 'd' ? 'selected' : '' }}>d</option>
                      </select>
                      <span class="error">{{ $errors->first('jawaban') }}</span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Buat Pertanyaan" /></td>
                </tr>
            </table>
        </form>
      </div>
    </section>
  </body>
</html>
