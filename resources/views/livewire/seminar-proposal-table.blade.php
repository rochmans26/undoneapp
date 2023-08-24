<div class="container-fluid">
    {{-- Success is as dangerous as failure. --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Seminar Proposal</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container-fluid mb-3">
        <div class="row justify-content-center">
            <div class="col-lg-3 mb-1">
                <input type="text" wire:model='search' class="form-control"
                    placeholder="Cari  Berdasarkan Judul ...">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('formulir-seminar-proposal') }}" class="btn btn-success"><i
                        class="nav-icon fas fa-plus"></i> Seminar Proposal(new)</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr style="vertical-align: middle">
                                    <th style="max-width: 2%" class="text-center">No.</th>
                                    <th style="max-width: 48%">Jadwal Seminar Proposal</th>
                                    {{-- <th>Tanggal Seminar</th>
                                    <th>Jam Seminar</th>
                                    <th>Sifat</th>
                                    <th>Tempat</th>
                                    <th>Tautan</th>
                                    <th>Reviewer 1</th>
                                    <th>Reviewer 2</th> --}}
                                    {{-- <th>Catatan 1</th>
                                    <th>Catatan 2</th> --}}
                                    <th style="max-width: 35%">Dokumen Revisi</th>
                                    <th style="max-width: 15%">Kelola Seminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($sempros) != null)
                                    @foreach ($sempros as $index => $sempro)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            {{ $sempro->judul_proposal }}
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <dl>
                                                                    <dt>Tanggal Seminar</dt>
                                                                    <dd>{{ date('d M Y', strtotime($sempro->tgl_seminar)) }}
                                                                    </dd>
                                                                    <dt>Jam Seminar</dt>
                                                                    <dd>{{ $sempro->jam_seminar }}</dd>
                                                                </dl>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <dl>
                                                                    <dt>Sifat Seminar</dt>
                                                                    <dd>
                                                                        @if ($sempro->sifat_seminar == 'daring')
                                                                            {{ $sempro->sifat_seminar }} (Tautan : <a
                                                                                href="{{ $sempro->tautan }}"
                                                                                target="_blank">Klik
                                                                                Disini</a>
                                                                            )
                                                                        @else
                                                                            {{ $sempro->sifat_seminar }} (Tempat :
                                                                            {{ $sempro->tmpt_seminar }})
                                                                        @endif
                                                                    </dd>
                                                                    <dt>Reviewer</dt>
                                                                    <dd>
                                                                        Reviewer 1 : {{ $sempro->reviewer1 }} <br>
                                                                        Reviewer 2 : {{ $sempro->reviewer2 }}
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->

                                            </td>
                                            <td class="align-middle" style="max-width: 35%">
                                                @if ($sempro->dok_rev != null)
                                                    <object data="{{ asset('storage') }}/{{ $sempro->dok_rev }}"
                                                        type="application/pdf" width="100%" height="200px">
                                                        <p>Unable to display PDF file. <a
                                                                href="{{ asset('storage') }}/{{ $sempro->dok_rev }}">Download</a>
                                                            instead.</p>
                                                    </object>
                                                    <a href="{{ asset('storage') }}/{{ $sempro->dok_rev }}"
                                                        target="_blank"><b>Buka di Tab Baru</b></a>
                                                @else
                                                    <div class="text-center">
                                                        <img src="{{ asset('img/dokumen.png') }}" alt=""
                                                            width="100px">

                                                        <p>Tidak Ada Dokumen yang Diunggah!</p>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="row mb-1 btn-sm btn-success text-center">
                                                    <div class="col-12">
                                                        <a href="" data-toggle="modal" data-target="#add_notes"
                                                            class="text text-white"
                                                            wire:click="update({{ $sempro->id_sempro }})"><i
                                                                class="nav-icon fas fa-plus"></i>
                                                            Catatan</a>
                                                    </div>
                                                </div>
                                                <div class="row mb-1 btn-sm btn-info text-center">
                                                    <div class="col-12">
                                                        <a href="" data-toggle="modal" data-target="#view_notes"
                                                            class="text text-white"
                                                            wire:click="update({{ $sempro->id_sempro }})"><i
                                                                class="nav-icon fas fa-eye"></i>
                                                            Lihat Catatan</a>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    @if ($sempro->dok_rev != null)
                                                        <div class="col-12 btn-sm btn-warning text-center">
                                                            <a href="" data-toggle="modal"
                                                                data-target="#add_dokrev" class="text text-dark"
                                                                wire:click="update({{ $sempro->id_sempro }})"><i
                                                                    class="fas fa-edit"></i>
                                                                Ubah Dokumen</a>
                                                        </div>
                                                    @else
                                                        <div class="col-12 btn-sm btn-danger text-center">
                                                            <a href="" data-toggle="modal"
                                                                data-target="#add_dokrev" class="text text-white"
                                                                wire:click="update({{ $sempro->id_sempro }})"><i
                                                                    class="nav-icon fas fa-file-alt"></i>
                                                                Dokumen Revisi</a>
                                                        </div>
                                                    @endif
                                                </div>
                                                {{-- <div class="row mb-1 btn-sm btn-primary text-center">
                                                    <div class="col-12">
                                                        <a href="" data-toggle="modal" data-target="#ubah"
                                                            wire:click="update({{ $sempro->id_sempro }})"
                                                            class="text text-white"><i class="fas fa-cog"></i>
                                                            Seminar</a>
                                                    </div>
                                                </div> --}}
                                                <div class="row mb-1 btn-sm btn-primary text-center">
                                                    <div class="col-12">
                                                        <a href="/edit-seminar-proposal/{{ $sempro->id_sempro }}/edit"
                                                            class="text text-white"><i class="fas fa-cog"></i>
                                                            Seminar(new)</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="11">
                                            <h5 class="text-center text-dark">Tidak Ada Data Ditemukan!</h5>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center">
                            {{ $sempros->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row justify-content-center">
            @if (count($sempros) != null)
                @foreach ($sempros as $index => $sempro)
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box bg-white">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">
                                    <h5><strong>{{ $sempro->judul_proposal }}</strong></h5>
                                </span>
                                <strong>Jadwal Seminar</strong>
                                <span class="info-box-text">{{ date('d M Y', strtotime($sempro->tgl_seminar)) }} | Pukul
                                    <strong>{{ $sempro->jam_seminar }}</strong></span>
                                <span class="info-box-text">Sifat : {{ $sempro->sifat_seminar }}</span>

                                <div class="row">
                                    <div class="col">
                                        <strong>Reviewer 1</strong>
                                        <span class="info-box-text">{{ $sempro->reviewer1 }}</span>
                                    </div>
                                    <div class="col">
                                        <strong>Reviewer 2</strong>
                                        <span class="info-box-text">{{ $sempro->reviewer2 }}</span>
                                    </div>
                                </div>
                                <span>
                                    <a href="" data-toggle="modal" data-target="#add_notes"
                                        class="btn-sm btn-success"
                                        wire:click="update({{ $sempro->id_sempro }})">Tambahkan Catatan</a>
                                    <a href="" data-toggle="modal" data-target="#view_notes"
                                        class="btn-sm btn-primary" wire:click="update({{ $sempro->id_sempro }})">Lihat
                                        Catatan</a>
                                </span>
                                <span class="mt-2">
                                    <strong>Dokumen Revisi</strong>
                                </span>
                                @if ($sempro->dok_rev != null)
                                    <a href="{{ $sempro->dok_rev }}" class="btn badge bg-warning" target="_blank">
                                        <span>Lihat Dokumen Revisi</span>
                                    </a>
                                @else
                                    <span class="mt-1">
                                        <a href="" data-toggle="modal" data-target="#add_dokrev"
                                            class="btn-sm btn-danger"
                                            wire:click="update({{ $sempro->id_sempro }})">Upload
                                            Dokumen Revisi</a>
                                    </span>
                                @endif


                                <span class="progress-description">

                                </span>

                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                @endforeach
            @else
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="background-color: #222E3C">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <span style='font-size:80px;'>&#128532;</span>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <h1 class="fw-bold text-white">Mohon Maaf !<br>Belum Ada Pengajuan
                                                Proposal
                                            </h1>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <span style='font-size:80px;'>&#128532;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div> --}}

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-1 mb-1">
                {{ $sempros->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Lihat Catatan -->
    <div wire:ignore.self class="modal fade" id="view_notes">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Catatan</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                        wire:click="ClearForm">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <h5><strong>Catatan Reviewer 1</strong></h5>
                        <textarea class="form-control border-0" id="note_rev1" rows="3" wire:model="note_rev1" readonly></textarea>
                    </div>
                    <div class="container">
                        <h5><strong>Catatan Reviewer 2</strong></h5>
                        <textarea class="form-control border-0" id="note_rev1" rows="3" wire:model="note_rev1" readonly></textarea>
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

    <!-- Modal Ubah Seminar -->
    <div wire:ignore.self class="modal fade" id="ubah">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Atur Seminar</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                        wire:click="ClearForm">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tgl_seminar">Tanggal Seminar</label>
                                    <input type="date"
                                        class="form-control @error('tgl_seminar') is-invalid @enderror"
                                        id="tgl_seminar" placeholder="Tanggal Seminar" wire:model="tgl_seminar">
                                    @error('tgl_seminar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jam_seminar">Jam Seminar</label>
                                    <input type="time"
                                        class="form-control @error('jam_seminar') is-invalid @enderror"
                                        id="jam_seminar" placeholder="Tanggal Seminar" wire:model="jam_seminar"
                                        step="1">
                                    @error('jam_seminar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="sifat_seminar">Sifat Seminar</label>
                                    <select name="sifat_seminar" id="sifat_seminar"
                                        class="form-control @error('sifat_seminar') is-invalid @enderror"
                                        wire:model="sifat_seminar" onChange="opsi(this)">
                                        <option value="" selected>-- Pilih --</option>
                                        <option value="Daring">Daring</option>
                                        <option value="Luring">Luring</option>
                                    </select>
                                    @error('sifat_seminar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tmpt_seminar">Tempat Seminar</label>
                                    <input type="text"
                                        class="form-control @error('tmpt_seminar') is-invalid @enderror"
                                        id="tmpt_seminar" placeholder="Tempat Seminar" wire:model="tmpt_seminar"
                                        wire:ignore.self>
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
                                        id="tautan" placeholder="https://www.meet.google.co.id"
                                        wire:model="tautan" wire:ignore.self>
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
                                    <input type="text"
                                        class="form-control @error('reviewer1') is-invalid @enderror" id="reviewer1"
                                        placeholder="Jhon Doe" wire:model="reviewer1">
                                    @error('reviewer1')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="reviewer2">Reviewer 2</label>
                                    <input type="text"
                                        class="form-control @error('reviewer2') is-invalid @enderror" id="reviewer2"
                                        placeholder="Anna Watson" wire:model="reviewer2">
                                    @error('reviewer2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" wire:click="ubahseminar()">Submit</button>
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


    <!-- Modal Tambah Link -->
    <div wire:ignore.self class="modal fade" id="add_dokrev">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Dokumen Revisi</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="dok_rev">Dokumen Revisi</label>
                                <input type="file" class="form-control @error('dok_rev') is-invalid @enderror"
                                    wire:model="dok_rev">
                                @error('dok_rev')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="dokrev()">Submit</button>
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

    <!-- Modal ADD Bidang -->
    <div wire:ignore.self class="modal fade" id="add_notes">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Catatan</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="note_rev1">Catatan Reviewer 1</label>
                                <textarea class="form-control @error('note_rev1') is-invalid @enderror" id="note_rev1" rows="3"
                                    wire:model="note_rev1"></textarea>
                                @error('note_rev1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="note_rev2">Catatan Reviewer 2</label>
                                <textarea class="form-control @error('note_rev2') is-invalid @enderror" id="note_rev2" rows="3"
                                    wire:model="note_rev2"></textarea>
                                @error('note_rev2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="add_notes()">Submit</button>
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
        function opsi(value) {
            var st = $("#sifat_seminar").val();
            if (st == "Daring") {
                document.getElementById("tmpt_seminar").disabled = true;
                document.getElementById("tautan").disabled = false;
            } else if (st == "Luring") {
                document.getElementById("tmpt_seminar").disabled = false;
                document.getElementById("tautan").disabled = true;
            } else {
                document.getElementById("tmpt_seminar").disabled = true;
                document.getElementById("tautan").disabled = true;
            }
        }
    </script>
    <script>
        window.addEventListener('closeModal', event => {
            $("#add_dokrev").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#add_notes").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#view_notes").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#ubah").modal('hide');
        })
    </script>
</div>
