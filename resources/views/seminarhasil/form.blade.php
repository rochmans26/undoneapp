@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>Seminar Hasil</h1>
            <p>Jumlah Laporan Hasil Yang Belum Dibuatkan Jadwal Seminar : {{ count($laphasil) }} </p>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid mb-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulir Seminar Hasil</h3>&nbsp;
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="container-fluid">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('buat-seminar-hasil') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_laphasil">Referensi Laporan Hasil</label>
                            <select id="id_laphasil" class="form-control select2 @error('id_laphasil') is-invalid @enderror"
                                name="id_laphasil" style="width: 100%">
                                <option value="">-- Judul Laporan Hasil --</option>
                                @foreach ($laphasil as $lh)
                                    <option value="{{ $lh->id }}">{{ $lh->judul_pkm }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_laphasil')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tgl_semhas">Tanggal Seminar</label>
                                <input type="date" class="form-control @error('tgl_semhas') is-invalid @enderror"
                                    id="tgl_semhas" placeholder="Tanggal Seminar" name="tgl_semhas">
                                @error('tgl_semhas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jam_semhas">Jam Seminar</label>
                                <input type="time" class="form-control @error('jam_semhas') is-invalid @enderror"
                                    id="jam_semhas" placeholder="Tanggal Seminar" name="jam_semhas">
                                @error('jam_semhas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="sifat_semhas" class="mb-3">Sifat Seminar</label>
                                <div class="input-group">
                                    <div class="radio-group">
                                        <input type="radio" id="option1" name="sifat_semhas" value="luring"
                                            onchange="toggleInput()" checked>
                                        <label for="option1">Luar Jaringan (Luring)</label>
                                    </div>
                                    &nbsp;
                                    <div class="radio-group">
                                        <input type="radio" id="option2" name="sifat_semhas" value="daring"
                                            onchange="toggleInput()">
                                        <label for="option2">Dalam Jaringan (Daring)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tmpt_semhas">Tempat Seminar</label>
                                <input type="text" class="form-control @error('tmpt_semhas') is-invalid @enderror"
                                    id="tmpt_semhas" placeholder="Tempat Seminar" name="tmpt_semhas">
                                <small><i>*(Abaikan Jika Sifat Seminar Daring)</i></small>
                                @error('tmpt_semhas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tautan_semhas">Tautan</label>
                                <input type="text" class="form-control @error('tautan_semhas') is-invalid @enderror"
                                    id="tautan_semhas" placeholder="https://www.meet.google.co.id" disabled
                                    name="tautan_semhas">
                                <small><i>*(Abaikan Jika Sifat Seminar Luring)</i></small>
                                @error('tautan_semhas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="rev1_semhas">Reviewer 1</label>
                                <input type="text" class="form-control @error('rev1_semhas') is-invalid @enderror"
                                    id="rev1_semhas" placeholder="Jhon Doe" name="rev1_semhas">
                                @error('rev1_semhas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rev2_semhas">Reviewer 2</label>
                                <input type="text" class="form-control @error('rev2_semhas') is-invalid @enderror"
                                    id="rev2_semhas" placeholder="Anna Watson" name="rev2_semhas">
                                @error('rev2_semhas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        function toggleInput() {
            var option1 = document.getElementById("option1");
            var option2 = document.getElementById("option2");
            var input1 = document.getElementById("tmpt_semhas");
            var input2 = document.getElementById("tautan_semhas");
            if (option1.checked) {
                input1.disabled = false;
                input2.disabled = true;
                input2.value = "";
            } else if (option2.checked) {
                input1.disabled = true;
                input1.value = "";
                input2.disabled = false;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('select').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@endpush
