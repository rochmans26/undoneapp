@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>Publikasi</h1>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid mb-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulir Publikasi</h3>&nbsp;
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
                    <form action="{{ route('simpan-publikasi') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_laphasil">Referensi Judul PKM</label>
                            <select id="id_laphasil" class="form-control select2 @error('id_laphasil') is-invalid @enderror"
                                name="id_laphasil" style="width: 100%">
                                <option value="">-- Judul Laporan Hasil --</option>
                                @foreach ($laporanhasils as $lh)
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
                        <div class="form-group">
                            <label for="judul_jurnal">Judul Jurnal</label>
                            <input type="text" class="form-control @error('judul_jurnal') is-invalid @enderror"
                                id="judul_jurnal" placeholder="Judul Jurnal" name="judul_jurnal">
                            @error('judul_jurnal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nm_jurnal">Nama Jurnal</label>
                                <input type="text" class="form-control @error('nm_jurnal') is-invalid @enderror"
                                    id="nm_jurnal" placeholder="Nama Jurnal" name="nm_jurnal">
                                @error('nm_jurnal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="vol_jurnal">Volume</label>
                                <input type="number" class="form-control @error('vol_jurnal') is-invalid @enderror"
                                    id="vol_jurnal" placeholder="Vol. Jurnal" name="vol_jurnal">
                                @error('vol_jurnal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="no_jurnal">Nomor Jurnal</label>
                                <input type="number" class="form-control @error('no_jurnal') is-invalid @enderror"
                                    id="no_jurnal" placeholder="Nomor Jurnal" name="no_jurnal">
                                @error('no_jurnal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="tgl_terbit_jurnal">Tanggal Terbit</label>
                                <input type="date" class="form-control @error('tgl_terbit_jurnal') is-invalid @enderror"
                                    id="tgl_terbit_jurnal" placeholder="dd/mm/yyyy" name="tgl_terbit_jurnal">
                                @error('tgl_terbit_jurnal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="jumlah_penulis">Jumlah Penulis</label>
                                <input type="number" class="form-control @error('jumlah_penulis') is-invalid @enderror"
                                    id="jumlah_penulis" placeholder="Jumlah Penulis" name="jumlah_penulis">
                                @error('jumlah_penulis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status_jurnal">Status Jurnal</label>
                                <select id="status_jurnal"
                                    class="form-control @error('status_jurnal') is-invalid @enderror"
                                    name="status_jurnal">
                                    <option selected>-- Pilih Status Jurnal --</option>
                                    <option value="non-akreditasi">Non Akreditasi</option>
                                    <option value="akreditasi-kemenristek">Terakreditasi Kemenristek</option>
                                    <option value="non-scopus">Non Scopus</option>
                                    <option value="scopus">Scopus</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="link_jurnal">Link Jurnal</label>
                            <input type="url" class="form-control @error('link_jurnal') is-invalid @enderror"
                                id="link_jurnal" placeholder="Link Jurnal" name="link_jurnal">
                            @error('link_jurnal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@endsection
