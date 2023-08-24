@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Pengajuan</h1>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid mb-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Pengajuan Proposal</h3>&nbsp;
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
                    <form action="{{ route('kirim-pengajuan') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="judul_proposal">Judul Proposal</label>
                            <input type="text" class="form-control @error('judul_proposal') is-invalid @enderror"
                                id="judul_proposal" placeholder="Judul Proposal" name="judul_proposal"
                                value="{{ old('judul_proposal') }}">
                            @error('judul_proposal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="id_bidang">Bidang</label>
                                <select id="id_bidang" class="form-control @error('id_bidang') is-invalid @enderror"
                                    name="id_bidang" value="{{ old('id_bidang') }}">
                                    <option selected>-- Pilih Bidang --</option>
                                    @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->id_bidang }}">{{ $bidang->nm_bidang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="id_skim">Skim</label>
                                <select id="id_skim" class="form-control @error('id_skim') is-invalid @enderror"
                                    name="id_skim" value="{{ old('id_skim') }}">
                                    <option selected>-- Pilih Jenis Skim --</option>
                                    @foreach ($skims as $skim)
                                        <option value="{{ $skim->id_skim }}">{{ $skim->nm_skim }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lokasi_kegiatan">Lokasi Kegiatan</label>
                            <input type="text" class="form-control @error('lokasi_kegiatan') is-invalid @enderror"
                                id="lokasi_kegiatan" placeholder="Lokasi Kegiatan" name="lokasi_kegiatan"
                                value="{{ old('lokasi_kegiatan') }}">
                            @error('lokasi_kegiatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="thn_mulai">Tahun Mulai</label>
                                <select id="thn_mulai" class="form-control @error('thn_mulai') is-invalid @enderror"
                                    name="thn_mulai" value="{{ old('thn_mulai') }}">
                                    <option selected>-- Tahun --</option>
                                    @php
                                        $tahunSekarang = date('Y');
                                        $tahunAwal = $tahunSekarang - 100;
                                        $tahunAkhir = $tahunSekarang + 30;
                                        for ($tahun = $tahunAkhir; $tahun >= $tahunAwal; $tahun--) {
                                            echo '<option value="' . $tahun . '">' . $tahun . '</option>';
                                        }
                                    @endphp
                                    {{-- @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->thn_mulai }}">{{ $bidang->nm_bidang }}
                                        </option>
                                    @endforeach --}}
                                </select>
                                {{-- <input type="number" class="form-control @error('thn_usulan') is-invalid @enderror"
                                    id="thn_usulan" placeholder="Tahun" name="thn_usulan" value="{{ old('thn_usulan') }}"
                                    min="1900" max="2099"> --}}
                                @error('thn_usulan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="thn_selesai">Tahun Selesai</label>
                                <select id="thn_selesai" class="form-control @error('thn_selesai') is-invalid @enderror"
                                    name="thn_selesai" value="{{ old('thn_selesai') }}">
                                    <option selected>-- Tahun --</option>
                                    @php
                                        $tahunSekarang = date('Y');
                                        $tahunAwal = $tahunSekarang - 100;
                                        $tahunAkhir = $tahunSekarang + 30;
                                        for ($tahun = $tahunAkhir; $tahun >= $tahunAwal; $tahun--) {
                                            echo '<option value="' . $tahun . '">' . $tahun . '</option>';
                                        }
                                    @endphp
                                </select>
                                {{-- <input type="number" class="form-control @error('thn_kegiatan') is-invalid @enderror"
                                    id="thn_kegiatan" placeholder="Tahun" name="thn_kegiatan"
                                    value="{{ old('thn_kegiatan') }}" min="1900" max="2099"> --}}
                                @error('thn_selesai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                {{-- <label for="dok_link">Dokumen</label>
                                <input type="file" class="form-control @error('dok_link') is-invalid @enderror"
                                    id="dok_link" name="dok_link">
                                @error('dok_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dok_link">Dokumen</label>
                            <input type="file" class="form-control @error('dok_link') is-invalid @enderror"
                                id="dok_link" name="dok_link">
                            @error('dok_link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary"><i
                                class="fas fa-paper-plane"></i>&nbsp;Kirim</button>
                    </form>
                    {{-- @livewire('form-proposal') --}}
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        {{-- Tambah Data ke Tabel Dosen --}}
        {{-- <div class="modal fade" id="tambah_dosen">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fas fa-edit"></i> Tambah Dosen</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpan-data-dosen') }}" method="POST">
                            <div class="card-body">
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
                                    <input type="text"
                                        class="form-control @error('alamat_dosen') is-invalid @enderror"
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
                                    <div class="form-group col-md-6">
                                        <label for="jafung">Jabatan Fungsional</label><br>
                                        <select class="form-control @error('jafung') is-invalid @enderror" id="jafung"
                                            name="jafung" style="width: 100%">
                                            <option selected>-- Pilih Jafung --</option>
                                            <option value="Asisten Ahli"
                                                {{ old('jafung') == 'Asisten Ahli' ? selected : '' }}>
                                                Asisten Ahli</option>
                                            <option value="Lektor" {{ old('jafung') == 'Lektor' ? selected : '' }}>Lektor
                                            </option>
                                            <option value="Lektor Kepala"
                                                {{ old('jafung') == 'Lektor Kepala' ? selected : '' }}>Lektor Kepala
                                            </option>
                                        </select>
                                        @error('jafung')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="id_prodi">Prodi</label> <br>
                                        <select class="form-control @error('id_prodi') is-invalid @enderror"
                                            id="id_prodi" name="id_prodi" style="width: 100%">
                                            <option selected>-- Pilih Prodi --</option>
                                            @foreach ($prodis as $prodi)
                                                @if (old('id_prodi') == $prodi->id)
                                                    <option value="{{ $prodi->id }}" selected>{{ $prodi->nm_prodi }}
                                                    </option>
                                                @else
                                                    <option value="{{ $prodi->id }}">{{ $prodi->nm_prodi }}</option>
                                                @endif
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
        </div> --}}

        {{-- Tambah Data ke Tabel Dosen Luar --}}
        {{-- <div class="modal fade" id="tambah_dosen_luar">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fas fa-edit"></i> Tambah Dosen Luar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpan-data-dosen-luar') }}" method="POST">
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label for="nidn_dosen_luar">NIDN/NIP</label>
                                    <input type="text"
                                        class="form-control @error('nidn_dosen_luar') is-invalid @enderror"
                                        id="nidn_dosen_luar" name="nidn_dosen_luar"
                                        value="{{ old('nidn_dosen_luar') }}">
                                    @error('nidn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nm_dosen_luar">Nama Dosen</label>
                                    <input type="text"
                                        class="form-control @error('nm_dosen_luar') is-invalid @enderror"
                                        id="nm_dosen_luar" name="nm_dosen_luar" value="{{ old('nm_dosen_luar') }}">
                                    @error('nm_dosen_luar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email_dosen_luar">Email</label>
                                    <input type="email"
                                        class="form-control @error('email_dosen_luar') is-invalid @enderror"
                                        id="email_dosen_luar" name="email_dosen_luar"
                                        value="{{ old('email_dosen_luar') }}">
                                    @error('email_dosen_luar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="telp_dosen_luar">Telp</label>
                                    <input type="tel"
                                        class="form-control @error('telp_dosen_luar') is-invalid @enderror"
                                        id="telp_dosen_luar" name="telp_dosen_luar"
                                        value="{{ old('telp_dosen_luar') }}">
                                    @error('telp_dosen_luar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fakultas_dosen_luar">Fakultas</label>
                                    <input type="text"
                                        class="form-control @error('fakultas_dosen_luar') is-invalid @enderror"
                                        id="fakultas_dosen_luar" name="fakultas_dosen_luar"
                                        value="{{ old('fakultas_dosen_luar') }}">
                                    @error('fakultas_dosen_luar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="prodi_dosen_luar">Prodi</label>
                                    <input type="text"
                                        class="form-control @error('prodi_dosen_luar') is-invalid @enderror"
                                        id="prodi_dosen_luar" name="prodi_dosen_luar"
                                        value="{{ old('prodi_dosen_luar') }}">
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
                                        id="universitas_dosen_luar" name="universitas_dosen_luar"
                                        value="{{ old('universitas_dosen_luar') }}">
                                    @error('universitas_dosen_luar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
        </div> --}}

        {{-- Tambah Data ke Tabel Mahasiswa --}}
        {{-- <div class="modal fade" id="tambah_mhs">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fas fa-edit"></i> Tambah Mahasiswa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('simpan-data-mahasiswa') }}" method="POST">
                            <div class="card-body">
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
                                    <input type="text"
                                        class="form-control @error('nm_mahasiswa') is-invalid @enderror"
                                        id="nm_mahasiswa" name="nm_mahasiswa" value="{{ old('nm_mahasiswa') }}">
                                    @error('nm_mahasiswa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id_prodi">Prodi</label> <br>
                                    <select class="form-control @error('id_prodi') is-invalid @enderror" id="id_prodi"
                                        name="id_prodi" style="width: 100%">
                                        <option selected>-- Pilih Prodi --</option>
                                        @foreach ($prodis as $prodi)
                                            @if (old('id_prodi') == $prodi->id)
                                                <option value="{{ $prodi->id }}" selected>{{ $prodi->nm_prodi }}
                                                </option>
                                            @else
                                                <option value="{{ $prodi->id }}">{{ $prodi->nm_prodi }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('id_prodi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="thn_masuk">Tahun Masuk</label>
                                    <input type="number" class="form-control @error('thn_masuk') is-invalid @enderror"
                                        id="thn_masuk" name="thn_masuk" value="{{ old('thn_masuk') }}">
                                    @error('thn_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
        </div> --}}
    </section>
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
