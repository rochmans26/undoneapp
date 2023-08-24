@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>Seminar Proposal</h1>
            <p>Jumlah Proposal Yang Belum Dibuatkan Jadwal Seminar : {{ count($proposals) }} </p>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid mb-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulir Seminar Proposal</h3>&nbsp;
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
                    <form action="{{ route('buat-seminar-proposal') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_proposal">Referensi Proposal</label>
                            <select id="id_proposal" class="form-control select2 @error('id_proposal') is-invalid @enderror"
                                name="id_proposal" style="width: 100%">
                                <option value="">-- Judul Proposal --</option>
                                @foreach ($proposals as $proposal)
                                    <option value="{{ $proposal->id }}">{{ $proposal->judul_proposal }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_proposal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tgl_seminar">Tanggal Seminar</label>
                                <input type="date" class="form-control @error('tgl_seminar') is-invalid @enderror"
                                    id="tgl_seminar" placeholder="Tanggal Seminar" name="tgl_seminar">
                                @error('tgl_seminar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jam_seminar">Jam Seminar</label>
                                <input type="time" class="form-control @error('jam_seminar') is-invalid @enderror"
                                    id="jam_seminar" placeholder="Tanggal Seminar" name="jam_seminar">
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
                                            onchange="toggleInput()" checked>
                                        <label for="option1">Luar Jaringan (Luring)</label>
                                    </div>
                                    &nbsp;
                                    <div class="radio-group">
                                        <input type="radio" id="option2" name="sifat_seminar" value="daring"
                                            onchange="toggleInput()">
                                        <label for="option2">Dalam Jaringan (Daring)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tmpt_seminar">Tempat Seminar</label>
                                <input type="text" class="form-control @error('tmpt_seminar') is-invalid @enderror"
                                    id="tmpt_seminar" placeholder="Tempat Seminar" name="tmpt_seminar">
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
                                    id="tautan" placeholder="https://www.meet.google.co.id" disabled name="tautan">
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
                                    id="reviewer1" placeholder="Jhon Doe" name="reviewer1">
                                @error('reviewer1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="reviewer2">Reviewer 2</label>
                                <input type="text" class="form-control @error('reviewer2') is-invalid @enderror"
                                    id="reviewer2" placeholder="Anna Watson" name="reviewer2">
                                @error('reviewer2')
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
