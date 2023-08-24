<div>
    {{-- <style type="text/css">
        /* .search-box .clear {
            clear: both;
            margin-top: 20px;
        } */

        .option ul {
            list-style: none;
            padding: 0px;
            width: 70%;
            position: absolute;
            margin: 0;
            background: white;
        }

        .option ul li {
            background: lavender;
            padding: 4px;
            margin-bottom: 1px;
        }

        .option ul li:nth-child(even) {
            background: cadetblue;
            color: white;
        }

        .option ul li:hover {
            cursor: pointer;
        }

        /* .option input[type=text] {
            padding: 5px;
            width: 250px;
            letter-spacing: 1px;
        } */
    </style> --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Hasil</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container-fluid">
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <section class="content">
            <div class="container-fluid mb-1">
                <div class="row">
                    {{-- <div class="col-lg-2 mb-1">
                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#add"
                            wire:click="ClearForm"><i class="nav-icon fas fa-plus"></i> Buat
                            Laporan</a>
                    </div> --}}
                    <div class="col-lg-2 mb-1">
                        <a href="{{ route('formulir-laporan-hasil') }}" class="btn btn-success"><i
                                class="nav-icon fas fa-plus"></i> Buat
                            Laporan(new)</a>
                    </div>
                    <div class="col-lg-1 mb-1">
                        <select wire:model='result' class="form-control">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-lg-3 mb-1">
                        <input type="text" wire:model='search' class="form-control" placeholder="Cari ...">
                    </div>

                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="table-responsive" wire:ignore.self>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="vertical-align: middle">
                                            <th class="text-center">No.</th>
                                            {{-- <th>Ref. Proposal</th> --}}
                                            <th class="text-center">Judul PKM</th>
                                            <th class="text-center">Bidang</th>
                                            <th class="text-center">Jenis Skim</th>
                                            {{-- <th>Lokasi Kegiatan</th> --}}
                                            <th class="text-center">Periode</th>
                                            {{-- <th>Tahun Kegiatan</th>
                                            <th>Tahun Pelaksanaan</th> --}}
                                            {{-- <th>Dana Dikti</th>
                                            <th>Dana Unla</th>
                                            <th>Dana Lainnya</th>
                                            <th>No. SK</th>
                                            <th>Tgl. SK</th> --}}
                                            {{-- <th>Mitra</th> --}}
                                            <th class="text-center">Link Dokumen</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    @if (count($laporanhasil) != null)
                                        <tbody>
                                            @foreach ($laporanhasil as $index => $pkm)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    {{-- <td>{{ $pkm->judul_proposal }}
                                                    </td> --}}
                                                    <td>{{ $pkm->judul_pkm }}</td>
                                                    <td>{{ $pkm->nm_bidang }}</td>
                                                    <td>{{ $pkm->nm_skim }}</td>
                                                    {{-- <td>{{ $pkm->lok_kegiatan }}</td> --}}
                                                    <td class="text-center">{{ $pkm->thn_mulai }} -
                                                        {{ $pkm->thn_selesai }}</td>
                                                    {{-- <td>{{ $pkm->thn_kegiatan }}</td>
                                                    <td>{{ $pkm->thn_pelaksanaan }}</td> --}}
                                                    {{-- <td>{{ number_format($pkm->dana_dikti) }}</td>
                                                    <td>{{ number_format($pkm->dana_unla) }}</td>
                                                    <td>{{ number_format($pkm->dana_lainnya) }}</td> --}}
                                                    {{-- <td>{{ $pkm->nosk_pkm }}</td>
                                                    <td>{{ $pkm->tglsk_pkm }}</td>
                                                    <td>{{ $pkm->mitra_pkm }}</td> --}}
                                                    <td class="text-center"> <a
                                                            href="{{ asset('storage') }}/{{ $pkm->dok_laphasil }}"
                                                            target="_blank">
                                                            <span style="font-size: 15pt">
                                                                <i class="nav-icon fas fa-file-alt"></i> Dokumen
                                                            </span>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="" class="btn btn-sm btn-warning mb-1"
                                                            data-toggle="modal" data-target="#edit"
                                                            wire:click="edit({{ $pkm->id }})"><i
                                                                class="nav-icon fas fa-edit"></i></a>
                                                        @if (Auth::user()->level == 'sp-admin')
                                                            <a href="{{ route('sp-admin.laphasil.detail', ['id' => $pkm->id]) }}"
                                                                class="btn btn-sm btn-primary mb-1"><i
                                                                    class="nav-icon fas fa-eye"></i></a>
                                                        @else
                                                            <a href="{{ route('admin.laphasil.detail', ['id' => $pkm->id]) }}"
                                                                class="btn btn-sm btn-primary mb-1"><i
                                                                    class="nav-icon fas fa-eye"></i></a>
                                                        @endif
                                                        <a href="" class="btn btn-sm btn-danger mb-1"
                                                            data-toggle="modal" data-target="#delete"
                                                            wire:click="confirmdel({{ $pkm->id }})"><i
                                                                class="nav-icon fas fa-trash"></i></a>
                                                        <a href="/kelola-anggota/{{ $pkm->id }}"
                                                            class="btn btn-sm btn-info mb-1"><i
                                                                class="fas fa-user-cog"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            <tr>
                                                <td colspan="16">
                                                    <h5 class="text-center text-dark">Tidak Ada Data Ditemukan!</h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endif
                                </table>
                                <div class="pagination justify-content-center">
                                    {{ $laporanhasil->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div><!-- /.container-fluid -->


    <!-- Modal Edit Bidang -->
    <div wire:ignore.self class="modal fade" id="edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Edit Data</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="judul_pkm">Judul PKM</label>
                                <input type="text" class="form-control @error('judul_pkm') is-invalid @enderror"
                                    id="judul_pkm" placeholder="Judul PKM" wire:model="judul_pkm">
                                @error('judul_pkm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="id_bidang">Bidang</label>
                                    <select id="id_bidang"
                                        class="form-control @error('id_bidang') is-invalid @enderror"
                                        wire:model="id_bidang">
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
                                        wire:model="id_skim">
                                        <option selected>-- Pilih Jenis Skim --</option>
                                        @foreach ($skims as $skim)
                                            <option value="{{ $skim->id_skim }}">{{ $skim->nm_skim }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lok_kegiatan">Lokasi Kegiatan</label>
                                <input type="text" class="form-control @error('lok_kegiatan') is-invalid @enderror"
                                    id="lok_kegiatan" placeholder="Lokasi Kegiatan" wire:model="lok_kegiatan">
                                @error('lok_kegiatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="thn_usulan">Tahun Usulan</label>
                                    <input type="text"
                                        class="form-control @error('thn_usulan') is-invalid @enderror" id="thn_usulan"
                                        placeholder="1998" wire:model="thn_usulan">
                                    @error('thn_usulan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="thn_kegiatan">Tahun Kegiatan</label>
                                    <input type="text"
                                        class="form-control @error('thn_kegiatan') is-invalid @enderror"
                                        id="thn_kegiatan" placeholder="1998" wire:model="thn_kegiatan">
                                    @error('thn_kegiatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="thn_pelaksanaan">Tahun Pelaksanaan</label>
                                    <input type="text"
                                        class="form-control @error('thn_pelaksanaan') is-invalid @enderror"
                                        id="thn_pelaksanaan" placeholder="1998" wire:model="thn_pelaksanaan">
                                    @error('thn_pelaksanaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="dana_dikti">Dana Dikti</label>
                                    <input type="number"
                                        class="form-control @error('dana_dikti') is-invalid @enderror" id="dana_dikti"
                                        placeholder="0,00" wire:model="dana_dikti">
                                    @error('dana_dikti')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dana_unla">Dana Unla</label>
                                    <input type="number"
                                        class="form-control @error('dana_unla') is-invalid @enderror" id="dana_unla"
                                        placeholder="0,00" wire:model="dana_unla">
                                    @error('dana_unla')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dana_lainnya">Dana Lainnya</label>
                                    <input type="number"
                                        class="form-control @error('dana_lainnya') is-invalid @enderror"
                                        id="dana_lainnya" placeholder="0,00" wire:model="dana_lainnya">
                                    @error('dana_lainnya')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nosk_pkm">No. SK PKM</label>
                                    <input type="text"
                                        class="form-control @error('nosk_pkm') is-invalid @enderror" id="nosk_pkm"
                                        placeholder="No. SK PKM" wire:model="nosk_pkm">
                                    @error('nosk_pkm')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tglsk_pkm">Tgl. SK PKM</label>
                                    <input type="date"
                                        class="form-control @error('tglsk_pkm') is-invalid @enderror" id="tglsk_pkm"
                                        placeholder="" wire:model="tglsk_pkm">
                                    @error('tglsk_pkm')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="mitra_pkm">Mitra PKM</label>
                                    <input type="text"
                                        class="form-control @error('mitra_pkm') is-invalid @enderror" id="mitra_pkm"
                                        placeholder="Mitra PKM" wire:model="mitra_pkm">
                                    @error('mitra_pkm')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="dok_laphasil">Dokumen</label>
                                    <input type="file"
                                        class="form-control @error('dok_laphasil') is-invalid @enderror"
                                        id="dok_laphasil" wire:model="dok_laphasil">
                                    <small>
                                        <input type="text" wire:model="dok_laphasil" disabled>
                                    </small>
                                    @error('dok_laphasil')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" wire:click="update()">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <!-- Modal Delete USER -->
    <div wire:ignore.self class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        Apakah anda yakin untuk menghapus data ini?
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <div class="form-group">
                        <button class="btn btn-danger btn-sm" wire:click="delete()">Hapus</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal ADD Bidang -->
    <div wire:ignore.self class="modal fade" id="add">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Buat Laporan Hasil</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                        wire:click="ClearForm">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="id_proposal">Referensi Proposal</label>
                                <select id="id_proposal"
                                    class="form-control select2 @error('id_proposal') is-invalid @enderror"
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
                                {{-- <input type="text" class="form-control @error('id_proposal') is-invalid @enderror"
                                    id="id_proposal" name="id_proposal" wire:model="type" wire:keyup="typeResult"
                                    placeholder="Cari Judul">
                                @if ($showresult)
                                    <div class="option">
                                        <ul>
                                            @if (!empty($records))
                                                @foreach ($records as $record)
                                                    <li wire:click="fetchProposalDetail({{ $record->id }})">
                                                        {{ $record->judul_proposal }} - {{ $record->thn_mulai }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                @error('id_proposal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                            </div>
                            <div class="form-group">
                                <label for="judul_pkm">Judul PKM</label>
                                <input type="text" class="form-control @error('judul_pkm') is-invalid @enderror"
                                    id="judul_pkm" placeholder="Judul PKM" wire:model="judul_pkm">
                                @error('judul_pkm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="id_bidang">Bidang</label>
                                    <select id="id_bidang"
                                        class="form-control @error('id_bidang') is-invalid @enderror"
                                        wire:model="id_bidang">
                                        <option selected>-- Pilih Bidang --</option>
                                        @foreach ($bidangs as $bidang)
                                            <option value="{{ $bidang->id_bidang }}">{{ $bidang->nm_bidang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_skim">Skim</label>
                                    <select id="id_skim"
                                        class="form-control @error('id_skim') is-invalid @enderror"
                                        wire:model="id_skim">
                                        <option selected>-- Pilih Jenis Skim --</option>
                                        @foreach ($skims as $skim)
                                            <option value="{{ $skim->id_skim }}">{{ $skim->nm_skim }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lok_kegiatan">Lokasi Kegiatan</label>
                                <input type="text"
                                    class="form-control @error('lok_kegiatan') is-invalid @enderror"
                                    id="lok_kegiatan" placeholder="Lokasi Kegiatan" wire:model="lok_kegiatan">
                                @error('lok_kegiatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="thn_mulai">Tahun Mulai</label>
                                    <select id="thn_mulai"
                                        class="form-control @error('thn_mulai') is-invalid @enderror"
                                        name="thn_mulai" wire:model="thn_mulai">
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
                                    @error('thn_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="thn_selesai">Tahun Selesai</label>
                                    <select id="thn_selesai"
                                        class="form-control @error('thn_selesai') is-invalid @enderror"
                                        name="thn_selesai" wire:model="thn_selesai">
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
                                    @error('thn_selesai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="thn_pelaksanaan">Tahun Pelaksanaan</label>
                                    <input type="text"
                                        class="form-control @error('thn_pelaksanaan') is-invalid @enderror"
                                        id="thn_pelaksanaan" placeholder="1998" wire:model="thn_pelaksanaan">
                                    @error('thn_pelaksanaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="dana_dikti">Dana Dikti</label>
                                    <input type="number"
                                        class="form-control @error('dana_dikti') is-invalid @enderror"
                                        id="dana_dikti" placeholder="0,00" wire:model="dana_dikti">
                                    @error('dana_dikti')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dana_unla">Dana Unla</label>
                                    <input type="number"
                                        class="form-control @error('dana_unla') is-invalid @enderror" id="dana_unla"
                                        placeholder="0,00" wire:model="dana_unla">
                                    @error('dana_unla')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dana_lainnya">Dana Lainnya</label>
                                    <input type="number"
                                        class="form-control @error('dana_lainnya') is-invalid @enderror"
                                        id="dana_lainnya" placeholder="0,00" wire:model="dana_lainnya">
                                    @error('dana_lainnya')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nosk_pkm">No. SK PKM</label>
                                    <input type="text"
                                        class="form-control @error('nosk_pkm') is-invalid @enderror" id="nosk_pkm"
                                        placeholder="No. SK PKM" wire:model="nosk_pkm">
                                    @error('nosk_pkm')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tglsk_pkm">Tgl. SK PKM</label>
                                    <input type="date"
                                        class="form-control @error('tglsk_pkm') is-invalid @enderror" id="tglsk_pkm"
                                        placeholder="" wire:model="tglsk_pkm">
                                    @error('tglsk_pkm')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="mitra_pkm">Mitra PKM</label>
                                    <input type="text"
                                        class="form-control @error('mitra_pkm') is-invalid @enderror" id="mitra_pkm"
                                        placeholder="Mitra PKM" wire:model="mitra_pkm">
                                    @error('mitra_pkm')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="dok_laphasil">Dokumen</label>
                                    <input type="file"
                                        class="form-control @error('dok_laphasil') is-invalid @enderror"
                                        id="dok_laphasil" wire:model="dok_laphasil">
                                    @error('dok_laphasil')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="create()">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        wire:click="ClearForm">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
        window.addEventListener('closeModal', event => {
            $("#add").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#edit").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#delete").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#detail").modal('hide');
        })
    </script>
</div>
