@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>Kelola Anggota</h1>
        </div>
    </section>
    <section class="content">
        {{-- session alert --}}
        <div class="container-fluid my-2">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" wire:ignore>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session()->has('suc_dosen'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" wire:ignore>
                    {{ session('suc_dosen') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" wire:ignore>
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        {{-- SPA Anggota Dosen --}}
        <div class="container-fluid mb-1">
            {{-- Anggota Dosen --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Anggota Dosen</h3>
                    <div class="card-tools">
                        <span>
                            <a href="" class="btn-sm btn-success mb-3" data-target="#add_doslokal"
                                data-toggle="modal"><i class="nav-icon fas fa-plus"></i> Tambah
                                Anggota
                                Dosen
                            </a>
                            &nbsp;
                            <a href="" class="btn-sm btn-info mb-3" data-target="#t_dosen" data-toggle="modal"><i
                                    class="nav-icon fas fa-plus"></i> <i class="fas fa-user"></i> Dosen
                            </a>
                        </span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('anggota-dosen', ['params' => $id_proposal])
                </div>
            </div>
        </div>

        {{-- SPA Anggota Dosen Luar --}}
        <div class="container-fluid mb-1">
            {{-- Anggota Dosen Luar --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Anggota Dosen Luar</h3>&nbsp;

                    <div class="card-tools">
                        <span>
                            <a href="" class="btn-sm btn-success mb-3" data-target="#add_dosluar"
                                data-toggle="modal"><i class="nav-icon fas fa-plus"></i> Tambah
                                Anggota
                                Dosen Luar
                            </a>
                            &nbsp;
                            <a href="" class="btn-sm btn-info mb-3" data-target="#t_dosluar" data-toggle="modal"><i
                                    class="nav-icon fas fa-plus"></i> <i class="fas fa-user"></i> Dosen
                                Luar
                            </a>
                        </span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('anggota-dosen-luars', ['params' => $id_proposal])
                </div>
            </div>
        </div>

        {{-- SPA Anggota Mahasiswa --}}
        <div class="container-fluid mb-1">
            {{-- Anggota Mahasiswa --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Anggota Mahasiswa</h3>&nbsp;

                    <div class="card-tools">
                        <span>
                            <a href="" class="btn-sm btn-success mb-3" data-target="#add_mhs" data-toggle="modal"><i
                                    class="nav-icon fas fa-plus"></i> Tambah
                                Anggota
                                Mahasiswa
                            </a>
                            &nbsp;
                            <a href="" class="btn-sm btn-info mb-3" data-target="#t_mhs" data-toggle="modal"><i
                                    class="nav-icon fas fa-plus"></i> <i class="fas fa-user"></i>
                                Mahasiswa
                            </a>
                        </span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('anggota-mahasiswas', ['params' => $id_proposal])
                </div>
            </div>
        </div>
        <div class="container-fluid mb-1">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <a href="{{ route(Auth::user()->level . ".proposals") }}" class="btn btn-primary">Selesai</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal ADD Dosen Lokal -->
    <div class="modal fade" id="add_doslokal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-edit"></i> Anggota Dosen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('simpan-anggotadosen') }}" method="POST">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="id_proposal" value="{{ $id_proposal }}">
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="id_dosen">Nama Dosen</label>
                                    <div class="input-group">
                                        <select name="id_dosen" id="id_dosen" class="form-control" style="width: 100%">
                                            <option value="" selected>-- Pilih Dosen --</option>
                                            @foreach ($dosens as $dosen)
                                                <option value="{{ $dosen->id }}">{{ $dosen->nidn }} -
                                                    {{ $dosen->nm_dosen }} - {{$dosen->prodi->nm_prodi}}</option>
                                            @endforeach
                                        </select>
                                        @error('id_dosen')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="peran">Peran</label>
                                    <div class="input-group">
                                        <select class="form-control @error('peran') is-invalid @enderror" id="peran"
                                            name="peran" style="width: 100%">
                                            <option value="" selected>-- Pilih Peran --</option>
                                            <option value="ketua">Ketua</option>
                                            <option value="anggota">Anggota</option>
                                        </select>
                                        @error('peran')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>
                                Tambah</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Anggota Dosen Luar --}}
    <div class="modal fade" id="add_dosluar">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-edit"></i> Anggota Dosen Luar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('simpan-anggotadosenluar') }}" method="POST">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="id_proposal" value="{{ $id_proposal }}">
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="nidn_dosen_luar">Nama Dosen Luar</label>
                                    <div class="input-group">
                                        <select name="nidn_dosen_luar" id="nidn_dosen_luar" class="form-control"
                                            style="width: 100%">
                                            <option value="" selected>-- Pilih Dosen --</option>
                                            @foreach ($dosenluars as $dosenluar)
                                                <option value="{{ $dosenluar->nidn_dosen_luar }}">
                                                    {{ $dosenluar->nidn_dosen_luar }} -
                                                    {{ $dosenluar->nm_dosen_luar }}</option>
                                            @endforeach
                                        </select>
                                        @error('nidn_dosen_luar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="peran">Peran</label>
                                    <div class="input-group">
                                        <select class="form-control @error('peran') is-invalid @enderror" id="peran"
                                            name="peran" style="width: 100%">
                                            <option value="" selected>-- Pilih Peran --</option>
                                            <option value="ketua">Ketua</option>
                                            <option value="anggota">Anggota</option>
                                        </select>
                                        @error('peran')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>
                                Tambah</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Anggota Mahasiswa --}}
    <div class="modal fade" id="add_mhs">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-edit"></i> Anggota Mahasiswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('simpan-anggotamahasiswa') }}" method="POST">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="id_proposal" value="{{ $id_proposal }}">
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="npm_mhs">Nama Mahasiswa</label>
                                    <div class="input-group">
                                        <select name="npm_mhs" id="npm_mhs" class="form-control" style="width: 100%">
                                            <option value="" selected>-- Pilih Mahasiswa --</option>
                                            @foreach ($mahasiswas as $mahasiswa)
                                                <option value="{{ $mahasiswa->npm }}">
                                                    {{ $mahasiswa->npm }} -
                                                    {{ $mahasiswa->nm_mahasiswa }}</option>
                                            @endforeach
                                        </select>
                                        @error('nidn_dosen_luar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="peran">Peran</label>
                                    <div class="input-group">
                                        <select class="form-control @error('peran') is-invalid @enderror" id="peran"
                                            name="peran" style="width: 100%">
                                            <option value="" selected>-- Pilih Peran --</option>
                                            <option value="ketua">Ketua</option>
                                            <option value="anggota">Anggota</option>
                                        </select>
                                        @error('peran')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>
                                Tambah</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Tambah Data Dosen --}}
    <div class="modal fade" id="t_dosen">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title"><i class="fas fa-edit"></i> Tambah Data Dosen</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="{{ route('simpan-data-dosen') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nidn">NIDN/NIP</label>
                                <input type="text" class="form-control @error('nidn') is-invalid @enderror"
                                    id="nidn" name="nidn" value="{{ old('nidn') }}">
                                @error('nidn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nm_dosen">Nama Dosen</label>
                                <input type="text" class="form-control @error('nm_dosen') is-invalid @enderror"
                                    id="nm_dosen" name="nm_dosen" value="{{ old('nm_dosen') }}">
                                @error('nm_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat_dosen">Alamat</label>
                                <input type="text" class="form-control @error('alamat_dosen') is-invalid @enderror"
                                    id="alamat_dosen" name="alamat_dosen" value="{{ old('alamat_dosen') }}">
                                @error('alamat_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp</label>
                                <input type="text" class="form-control @error('telp') is-invalid @enderror"
                                    id="telp" name="telp" value="{{ old('telp') }}">
                                @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="jafung">Jabatan Fungsional</label>
                                    <div class="input-group">
                                        <select class="form-control @error('jafung') is-invalid @enderror" id="jafung"
                                            name="jafung" style="width: 100%" value="{{ old('jafung') }}">
                                            <option selected>-- Pilih Jafung --</option>
                                            <option value="Asisten Ahli">Asisten Ahli</option>
                                            <option value="Lektor">Lektor</option>
                                            <option value="Lektor Kepala">Lektor Kepala</option>
                                        </select>
                                        @error('jafung')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="id_prodi">Prodi</label>
                                    <div class="input-group">
                                        <select class="form-control @error('id_prodi') is-invalid @enderror"
                                            id="id_prodi" name="id_prodi" style="width: 100%"
                                            value="{{ old('id_prodi') }}">
                                            <option selected>-- Pilih Prodi --</option>
                                            @foreach ($prodis as $prodi)
                                                <option value="{{ $prodi->id }}">{{ $prodi->nm_prodi }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_prodi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Tambah Data Dosen Luar --}}
    <div class="modal fade" id="t_dosluar">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title"><i class="fas fa-edit"></i> Tambah Data Dosen Luar</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="{{ route('simpan-data-dosenluar') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nidn_dosen_luar">NIDN</label>
                                <input type="text" class="form-control @error('nidn_dosen_luar') is-invalid @enderror"
                                    id="nidn_dosen_luar" name="nidn_dosen_luar" value="{{ old('nidn_dosen_luar') }}">
                                @error('nidn_dosen_luar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nm_dosen_luar">Nama Dosen</label>
                                <input type="text" class="form-control @error('nm_dosen_luar') is-invalid @enderror"
                                    id="nm_dosen_luar" name="nm_dosen_luar">
                                @error('nm_dosen_luar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telp_dosen_luar">Telp.</label>
                                <input type="text" class="form-control @error('telp_dosen_luar') is-invalid @enderror"
                                    id="telp_dosen_luar" name="telp_dosen_luar">
                                @error('telp_dosen_luar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email_dosen_luar">Email</label>
                                <input type="text"
                                    class="form-control @error('email_dosen_luar') is-invalid @enderror"
                                    id="email_dosen_luar" name="email_dosen_luar">
                                @error('email_dosen_luar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fakultas_dosen_luar">Fakultas</label>
                                <input type="text"
                                    class="form-control @error('fakultas_dosen_luar') is-invalid @enderror"
                                    id="fakultas_dosen_luar" name="fakultas_dosen_luar">
                                @error('fakultas_dosen_luar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="prodi_dosen_luar">Program Studi</label>
                                <input type="text"
                                    class="form-control @error('prodi_dosen_luar') is-invalid @enderror"
                                    id="prodi_dosen_luar" name="prodi_dosen_luar">
                                @error('prodi_dosen_luar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="universitas_dosen_luar">Universitas</label>
                                <input type="text"
                                    class="form-control @error('universitas_dosen_luar') is-invalid @enderror"
                                    id="universitas_dosen_luar" name="universitas_dosen_luar">
                                @error('universitas_dosen_luar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Tambah Data Mahasiswa --}}
    <div class="modal fade" id="t_mhs">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title"><i class="fas fa-edit"></i> Tambah Data Mahasiswa</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="{{ route('simpan-data-mahasiswa') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="npm">NPM</label>
                                <input type="text" class="form-control @error('npm') is-invalid @enderror"
                                    id="npm" name="npm" value="{{ old('npm') }}">
                                @error('npm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nm_mahasiswa">Nama Mahasiswa</label>
                                <input type="text" class="form-control @error('nm_mahasiswa') is-invalid @enderror"
                                    id="nm_mahasiswa" name="nm_mahasiswa" value="{{ old('nm_mahasiswa') }}">
                                @error('nm_mahasiswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="id_prodi">Prodi</label>
                                    <div class="input-group">
                                        <select class="form-control @error('id_prodi') is-invalid @enderror"
                                            id="id_prodi" name="id_prodi" style="width: 100%"
                                            value="{{ old('id_prodi') }}">
                                            <option value="">-- Pilih Prodi --</option>
                                            @foreach ($prodis as $prodi)
                                                <option value="{{ $prodi->id }}">{{ $prodi->nm_prodi }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_prodi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="thn_masuk">Tahun Masuk</label>
                                    <div class="input-group">
                                        <select id="thn_masuk" name="thn_masuk"
                                            class="form-control @error('thn_masuk') is-invalid @enderror"
                                            value="{{ old('thn_masuk') }}" style="width: 100%">
                                            <option value="">-- Pilih Tahun --</option>
                                            <!-- Script untuk mengisi nilai tahun secara dinamis -->
                                            @php
                                                $tahunSekarang = date('Y');
                                                $tahunAwal = $tahunSekarang - 7;
                                                for ($tahun = $tahunSekarang; $tahun >= $tahunAwal; $tahun--) {
                                                    echo '<option value="' . $tahun . '">' . $tahun . '</option>';
                                                }
                                            @endphp
                                        </select>
                                        @error('thn_masuk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('select').select2({
                theme: "classic"
            });
        });
    </script>
@endpush
