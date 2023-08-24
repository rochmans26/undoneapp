@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Seminar Proposal</h1>
            <p>Judul Proposal : {{ $judul->judul_proposal }} </p>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid mb-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulir Edit Seminar Proposal</h3>&nbsp;
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
                    <form action="{{ route('ubah-seminar-proposal', $sempro->id_sempro) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- <input type="hidden" name="id_sempro" value="{{ $sempro->id_sempro }}"> --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tgl_seminar">Tanggal Seminar</label>
                                <input type="date" class="form-control @error('tgl_seminar') is-invalid @enderror"
                                    id="tgl_seminar" placeholder="Tanggal Seminar" name="tgl_seminar"
                                    value="{{ old('tgl_seminar', $sempro->tgl_seminar) }}">
                                @error('tgl_seminar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jam_seminar">Jam Seminar</label>
                                <input type="time" class="form-control @error('jam_seminar') is-invalid @enderror"
                                    id="jam_seminar" placeholder="Tanggal Seminar" name="jam_seminar"
                                    value="{{ old('jam_seminar', $sempro->jam_seminar) }}">
                                @error('jam_seminar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="sifat_seminar" class="mb-3">Sifat Seminar</label>
                                <div class="input-group">
                                    <div class="radio-group">
                                        <input type="radio" id="option1" name="sifat_seminar" value="luring"
                                            onchange="toggleInput()"
                                            {{ $sempro->sifat_seminar == 'luring' ? 'checked' : '' }}>
                                        <label for="option1">Luar Jaringan (Luring)</label>
                                    </div>
                                    &nbsp;
                                    <div class="radio-group">
                                        <input type="radio" id="option2" name="sifat_seminar" value="daring"
                                            onchange="toggleInput()"
                                            {{ $sempro->sifat_seminar == 'daring' ? 'checked' : '' }}>
                                        <label for="option2">Dalam Jaringan (Daring)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tmpt_seminar">Tempat Seminar</label>
                                <input type="text" class="form-control @error('tmpt_seminar') is-invalid @enderror"
                                    id="tmpt_seminar" placeholder="Tempat Seminar" name="tmpt_seminar"
                                    value="{{ old('tmpt_seminar', $sempro->tmpt_seminar) }}">
                                <small><i>*(Abaikan Jika Sifat Seminar Daring)</i></small>
                                @error('tmpt_seminar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tautan">Tautan</label>
                                <input type="text" class="form-control @error('tautan') is-invalid @enderror"
                                    id="tautan" placeholder="https://www.meet.google.co.id" disabled name="tautan"
                                    value="{{ old('tautan', $sempro->tautan) }}">
                                <small><i>*(Abaikan Jika Sifat Seminar Luring)</i></small>
                                @error('tautan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="reviewer1">Reviewer 1</label>
                                <input type="text" class="form-control @error('reviewer1') is-invalid @enderror"
                                    id="reviewer1" placeholder="Jhon Doe" name="reviewer1"
                                    value="{{ old('reviewer1', $sempro->reviewer1) }}">
                                @error('reviewer1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="reviewer2">Reviewer 2</label>
                                <input type="text" class="form-control @error('reviewer2') is-invalid @enderror"
                                    id="reviewer2" placeholder="Anna Watson" name="reviewer2"
                                    value="{{ old('reviewer2', $sempro->reviewer2) }}">
                                @error('reviewer2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        if (document.getElementById("option1").checked == true) {
            document.getElementById("tmpt_seminar").disabled = false;
            document.getElementById("tautan").disabled = true;
            document.getElementById("tautan").value = "";
        } else if (document.getElementById("option2").checked == true) {
            document.getElementById("tautan").disabled = false;
            document.getElementById("tmpt_seminar").disabled = true;
            document.getElementById("tmpt_seminar").value = "";
        };

        function toggleInput() {
            var option1 = document.getElementById("option1");
            var option2 = document.getElementById("option2");
            var input1 = document.getElementById("tmpt_seminar");
            var input2 = document.getElementById("tautan");
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
