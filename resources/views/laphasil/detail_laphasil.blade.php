@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Laporan Hasil</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>{{ $data->judul_pkm }}</strong></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-6 order-2 order-md-1">
                        <h4 class="mb-3">
                            @if (Auth::user()->level == 'sp-admin')
                                <a href="/sp-admin/proposals/{{ $data->id }}/detail" target="_blank"
                                    class="text-dark"><b><i class="fas fa-link"></i></b> Referensi Proposal</a>
                            @else
                                <a href="/admin/proposals/{{ $data->id }}/detail" target="_blank"
                                    class="text-dark"><b><i class="fas fa-link"></i></b> Referensi Proposal</a>
                            @endif
                        </h4>
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-info">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-white">Periode</span>
                                        <span class="info-box-number text-center text-white mb-0">{{ $data->thn_mulai }} -
                                            {{ $data->thn_selesai }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-warning">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-dark">Bidang</span>
                                        <span
                                            class="info-box-number text-center text-dark mb-0">{{ $data->nm_bidang }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Skim</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $data->nm_skim }}</span>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tahun Pelaksanaan</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $data->thn_pelaksanaan }}</span>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row my-2">
                            <div class="col-12 col-sm-6">
                                <span>No.SK : <b>{{ $data->nosk_pkm }}</b></span>
                            </div>
                            <div class="col-12 col-sm-6 text-right">
                                <span class="">Tanggal SK : <b>{{ $data->tglsk_pkm }}</b></span>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h4><i class="fas fa-map-marker-alt"></i> Lokasi Kegiatan</h4>
                                <div class="post">
                                    <p>{{ $data->lok_kegiatan }}</p>
                                </div>
                                <h4>Mitra PKM</h4>
                                <div class="post">
                                    <p>{{ $data->mitra_pkm }}</p>
                                </div>

                                <h4>Pendanaan</h4>
                                <div class="post">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div
                                                class="info-box {{ $data->dana_dikti != null ? 'bg-success' : 'bg-light' }}">
                                                <div class="info-box-content">
                                                    <span
                                                        class="info-box-text text-center {{ $data->dana_dikti != null ? 'text-white' : 'text-muted' }}"><i
                                                            class="fas fa-money-bill-wave"></i> Dana
                                                        Dikti</span>
                                                    <span
                                                        class="info-box-number text-center {{ $data->dana_dikti != null ? 'text-white' : 'text-muted' }} mb-0">{{ $data->dana_dikti != null ? 'Rp. ' . number_format($data->dana_dikti) . ',-' : '-' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div
                                                class="info-box {{ $data->dana_unla != null ? 'bg-success' : 'bg-light' }}">
                                                <div class="info-box-content">
                                                    <span
                                                        class="info-box-text text-center {{ $data->dana_unla != null ? 'text-white' : 'text-muted' }}"><i
                                                            class="fas fa-money-bill-wave"></i> Dana UNLA</span>
                                                    <span
                                                        class="info-box-number text-center {{ $data->dana_unla != null ? 'text-white' : 'text-muted' }} mb-0">{{ $data->dana_unla != null ? 'Rp.' . number_format($data->dana_unla) . ',-' : '-' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div
                                                class="info-box {{ $data->dana_lainnya != null ? 'bg-success' : 'bg-light' }}">
                                                <div class="info-box-content">
                                                    <span
                                                        class="info-box-text text-center {{ $data->dana_lainnya != null ? 'text-white' : 'text-muted' }}"><i
                                                            class="fas fa-money-bill-wave"></i> Dana Lainnya</span>
                                                    <span
                                                        class="info-box-number text-center {{ $data->dana_lainnya != null ? 'text-white' : 'text-muted' }} mb-0">{{ $data->dana_lainnya != null ? 'Rp.' . number_format($data->dana_lainnya) . ',-' : '-' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h5>
                                        <b class="text-dark">
                                            Total Pendanaan : {{ 'Rp. ' . number_format($total) . ',-' }}
                                        </b>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
                        <object data="{{ asset('storage') }}/{{ $data->dok_laphasil }}" type="application/pdf"
                            width="100%" height="535px">
                            <p>Unable to display PDF file. <a
                                    href="{{ asset('storage') }}/{{ $data->dok_laphasil }}">Download</a>
                                instead.</p>
                        </object>
                        <div class="text-muted">
                            <p class="text-sm">Klik Link Dibawah ini
                                <a href="{{ asset('storage') }}/{{ $data->dok_laphasil }}" target="_blank">
                                    <b class="d-block"><i class="fas fa-link"></i> Buka di Tab Baru</b>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h4>Anggota Dosen</h4>
                        <div class="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>NIDN/NIP</th>
                                        <th>Nama Dosen</th>
                                        <th style="width: 60px">Peran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggotadosens as $item => $anggotadosen)
                                        <tr>
                                            <td>{{ $item + 1 }}</td>
                                            <td>{{ $anggotadosen->nidn }}</td>
                                            <td>{{ $anggotadosen->nm_dosen }}</td>
                                            <td>
                                                @if ($anggotadosen->peran == 'ketua')
                                                    <span class="badge badge-danger">{{ $anggotadosen->peran }}</span>
                                                @else
                                                    <span class="badge badge-primary">{{ $anggotadosen->peran }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <p>{{ $data->nm_bidang }}</p> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h4>Anggota Dosen Luar</h4>
                        <div class="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>NIDN/NIP</th>
                                        <th>Nama Dosen</th>
                                        <th style="width: 60px">Peran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggotadosenluars as $item => $anggotadosenluar)
                                        <tr>
                                            <td>{{ $item + 1 }}</td>
                                            <td>{{ $anggotadosenluar->nidn_dosen_luar }}</td>
                                            <td>{{ $anggotadosenluar->nm_dosen_luar }}</td>
                                            <td>
                                                @if ($anggotadosenluar->peran == 'ketua')
                                                    <span class="badge badge-danger">{{ $anggotadosenluar->peran }}</span>
                                                @else
                                                    <span class="badge badge-primary">{{ $anggotadosenluar->peran }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h4>Anggota Mahasiswa</h4>
                        <div class="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>NPM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th style="width: 60px">Peran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggotamahasiswas as $item => $anggotamahasiswa)
                                        <tr>
                                            <td>{{ $item + 1 }}</td>
                                            <td>{{ $anggotamahasiswa->npm_mhs }}</td>
                                            <td>{{ $anggotamahasiswa->nm_mahasiswa }}</td>
                                            <td>
                                                @if ($anggotamahasiswa->peran == 'ketua')
                                                    <span class="badge badge-danger">{{ $anggotamahasiswa->peran }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-primary">{{ $anggotamahasiswa->peran }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <p>{{ $data->nm_bidang }}</p> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h4><b>Jumlah Anggota :
                                {{ count($anggotadosens) + count($anggotadosenluars) + count($anggotamahasiswas) }}
                                Orang</b></h4>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>

        {{-- Anggota Mahasiswa --}}
        {{-- @livewire('proposal-anggotadosen', ['params' => $data->id])
        @livewire('proposal-anggotamhs', ['params' => $data->id])
        @livewire('proposal-anggotadosluar', ['params' => $data->id]) --}}
    </section>
@endsection
