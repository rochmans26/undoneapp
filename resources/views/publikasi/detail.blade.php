@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Publikasi</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>{{ $showDetailPub->judul_jurnal }}</b></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-6 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-info">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-white">Nama Jurnal</span>
                                        <span
                                            class="info-box-number text-center text-white mb-0">{{ $showDetailPub->nm_jurnal }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-warning">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-dark">Volume</span>
                                        <span
                                            class="info-box-number text-center text-dark mb-0">{{ $showDetailPub->vol_jurnal }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Nomor</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $showDetailPub->no_jurnal }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h4><i class="fas fa-calendar-alt"></i> Terbit</h4>
                                <div class="post">
                                    <b>{{ $showDetailPub->tgl_terbit_jurnal }}</b>
                                </div>
                                <h4>Jumlah Penulis : {{ $showDetailPub->jumlah_penulis }}</h4>
                                <div class="post">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
                        <object data="{{ asset('storage') }}/{{ $showDetailPub->dok_jurnal }}" type="application/pdf"
                            width="100%" height="300px">
                            <p>Unable to display PDF file. <a
                                    href="{{ asset('storage') }}/{{ $showDetailPub->dok_jurnal }}">Download</a>
                                instead.</p>
                        </object>
                        {{-- <a href="{{ asset('storage') }}/{{ $showDetailPub->dok_jurnal }}" target="_blank">
                        <h3 class="text-primary"><i class="fas fa-file"></i> Berkas</h3>
                    </a> --}}
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Klik Link Dibawah
                                <a href="{{ asset('storage') }}/{{ $showDetailPub->dok_jurnal }}" target="_blank">
                                    <b class="d-block"><i class="fas fa-link"></i> Buka di Tab Baru</b>
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>

        {{-- Anggota Mahasiswa --}}
    </section>
@endsection
