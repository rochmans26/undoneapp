<div class="container-fluid">
    {{-- Success is as dangerous as failure. --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1 class="m-0">Seminar Hasil</h1>

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
                <a href="{{ route('formulir-seminar-hasil') }}" class="btn btn-success"><i
                        class="nav-icon fas fa-plus"></i> Seminar Hasil(new)</a>
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
                                <tr style="vertical-align: middle">
                                    <th style="max-width: 2%" class="text-center">No.</th>
                                    <th style="max-width: 48%">Jadwal Seminar Hasil</th>
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
                                {{-- <th>No.</th>
                                    <th>Judul PKM </th>
                                    <th>Tanggal Seminar</th>
                                    <th>Jam Seminar</th>
                                    <th>Sifat</th>
                                    <th>Tempat</th>
                                    <th>Tautan</th>
                                    <th>Reviewer 1</th>
                                    <th>Reviewer 2</th>
                                    <th style="max-width: 200px;">Catatan 1</th>
                                    <th style="max-width: 200px;">Catatan 2</th>
                                    <th>Dokumen Revisi</th>
                                    <th style="width: 300px;">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($semhass) != null)
                                    @foreach ($semhass as $index => $semhas)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            {{ $semhas->judul_pkm }}
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <dl>
                                                                    <dt>Tanggal Seminar</dt>
                                                                    <dd>{{ date('d M Y', strtotime($semhas->tgl_semhas)) }}
                                                                    </dd>
                                                                    <dt>Jam Seminar</dt>
                                                                    <dd>{{ $semhas->jam_semhas }}</dd>
                                                                </dl>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <dl>
                                                                    <dt>Sifat Seminar</dt>
                                                                    <dd>
                                                                        @if ($semhas->sifat_semhas == 'daring')
                                                                            {{ $semhas->sifat_semhas }} (Tautan : <a
                                                                                href="{{ $semhas->tautan_semhas }}"
                                                                                target="_blank">Klik
                                                                                Disini</a>
                                                                            )
                                                                        @else
                                                                            {{ $semhas->sifat_semhas }} (Tempat :
                                                                            {{ $semhas->tmpt_semhas }})
                                                                        @endif
                                                                    </dd>
                                                                    <dt>Reviewer</dt>
                                                                    <dd>
                                                                        Reviewer 1 : {{ $semhas->rev1_semhas }} <br>
                                                                        Reviewer 2 : {{ $semhas->rev2_semhas }}
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
                                                @if ($semhas->dok_rev_semhas != null)
                                                    <object
                                                        data="{{ asset('storage') }}/{{ $semhas->dok_rev_semhas }}"
                                                        type="application/pdf" width="100%" height="200px">
                                                        <p>Unable to display PDF file. <a
                                                                href="{{ asset('storage') }}/{{ $semhas->dok_rev_semhas }}">Download</a>
                                                            instead.</p>
                                                    </object>
                                                    <a href="{{ asset('storage') }}/{{ $semhas->dok_rev_semhas }}"
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
                                                            wire:click="update({{ $semhas->id_semhas }})"><i
                                                                class="nav-icon fas fa-plus"></i>
                                                            Catatan</a>
                                                    </div>
                                                </div>
                                                <div class="row mb-1 btn-sm btn-info text-center">
                                                    <div class="col-12">
                                                        <a href="" data-toggle="modal" data-target="#view_notes"
                                                            class="text text-white"
                                                            wire:click="update({{ $semhas->id_semhas }})"><i
                                                                class="nav-icon fas fa-eye"></i> Lihat
                                                            Catatan</a>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    @if ($semhas->dok_rev_semhas != null)
                                                        <div class="col-12 btn-sm btn-warning text-center">
                                                            <a href="" data-toggle="modal"
                                                                data-target="#add_dokrev" class="text text-dark"
                                                                wire:click="update({{ $semhas->id_semhas }})"><i
                                                                    class="fas fa-edit"></i>
                                                                Ubah Dokumen</a>
                                                        </div>
                                                    @else
                                                        <div class="col-12 btn-sm btn-danger text-center">
                                                            <a href="" data-toggle="modal"
                                                                data-target="#add_dokrev" class="text text-white"
                                                                wire:click="update({{ $semhas->id_semhas }})"><i
                                                                    class="nav-icon fas fa-file-alt"></i>
                                                                Dokumen Revisi</a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="row mb-1 btn-sm btn-primary text-center">
                                                    <div class="col-12">
                                                        <a href="{{ route('edit-seminar-hasil', $semhas->id_semhas) }}"
                                                            class="text text-white"><i class="fas fa-cog"></i>
                                                            Seminar(New)</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="13">
                                            <h5 class="text-center text-dark">Tidak Ada Data Ditemukan!</h5>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center">
                            {{ $semhass->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container-fluid">
        <div class="row justify-content-center">
            @if (count($semhass) != null)
                @foreach ($semhass as $index => $semhas)
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box bg-white">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">
                                    <h5><strong>{{ $semhas->judul_pkm }}</strong></h5>
                                </span>
                                <strong>Jadwal Seminar</strong>
                                <span class="info-box-text">{{ date('d M Y', strtotime($semhas->tgl_semhas)) }} | Pukul
                                    <strong>{{ $semhas->jam_semhas }}</strong></span>
                                <span class="info-box-text">Sifat : {{ $semhas->sifat_semhas }}</span>

                                <div class="row">
                                    <div class="col">
                                        <strong>Reviewer 1</strong>
                                        <span class="info-box-text">{{ $semhas->rev1_semhas }}</span>
                                    </div>
                                    <div class="col">
                                        <strong>Reviewer 2</strong>
                                        <span class="info-box-text">{{ $semhas->rev2_semhas }}</span>
                                    </div>
                                </div>
                                <span>
                                    <a href="" data-toggle="modal" data-target="#add_notes"
                                        class="btn-sm btn-success"
                                        wire:click="update({{ $semhas->id_semhas }})">Tambahkan Catatan</a>
                                    <a href="" data-toggle="modal" data-target="#view_notes"
                                        class="btn-sm btn-primary" wire:click="update({{ $semhas->id_semhas }})">Lihat
                                        Catatan</a>
                                </span>
                                <span class="mt-2">
                                    <strong>Dokumen Revisi</strong>
                                </span>
                                @if ($semhas->dok_rev_semhas != null)
                                    <a href="{{ $semhas->dok_rev_semhas }}" class="btn badge bg-warning"
                                        target="_blank">
                                        <span>Lihat Dokumen Revisi</span>
                                    </a>
                                @else
                                    <span class="mt-1">
                                        <a href="" data-toggle="modal" data-target="#add_dokrev"
                                            class="btn-sm btn-danger"
                                            wire:click="update({{ $semhas->id_semhas }})">Upload
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
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-1 mb-1">
                {{ $semhass->links() }}
            </div>
        </div>
    </div> --}}

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
                        <textarea class="form-control border-0" id="nrev1_semhas" rows="3" wire:model="nrev1_semhas" readonly></textarea>
                    </div>
                    <div class="container">
                        <h5><strong>Catatan Reviewer 2</strong></h5>
                        <textarea class="form-control border-0" id="nrev2_semhas" rows="3" wire:model="nrev2_semhas" readonly></textarea>
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
                                <label for="dok_rev_semhas">Upload Dokumen</label>
                                <input type="file"
                                    class="form-control @error('dok_rev_semhas') is-invalid @enderror"
                                    wire:model="dok_rev_semhas">
                                @error('dok_rev_semhas')
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                                    <label for="tgl_semhas">Tanggal Seminar</label>
                                    <input type="date"
                                        class="form-control @error('tgl_semhas') is-invalid @enderror" id="tgl_semhas"
                                        placeholder="Tanggal Seminar" wire:model="tgl_semhas">
                                    @error('tgl_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jam_semhas">Jam Seminar</label>
                                    <input type="time"
                                        class="form-control @error('jam_semhas') is-invalid @enderror" id="jam_semhas"
                                        placeholder="Tanggal Seminar" wire:model="jam_semhas">
                                    @error('jam_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="sifat_semhas">Sifat Seminar</label>
                                    <select name="sifat_semhas" id="sifat_semhas"
                                        class="form-control @error('sifat_semhas') is-invalid @enderror"
                                        wire:model="sifat_semhas" onChange="opsi(this)">
                                        <option value="" selected>-- Pilih --</option>
                                        <option value="Daring">Daring</option>
                                        <option value="Luring">Luring</option>
                                    </select>
                                    @error('sifat_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tmpt_semhas">Tempat Seminar</label>
                                    <input type="text"
                                        class="form-control @error('tmpt_semhas') is-invalid @enderror"
                                        id="tmpt_semhas" placeholder="Tempat Seminar" wire:model="tmpt_semhas"
                                        wire:ignore.self>
                                    <small><i>*(Abaikan Jika Sifat Seminar Daring)</i></small>
                                    @error('tmpt_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tautan_semhas">Tautan Seminar Hasil</label>
                                    <input type="text"
                                        class="form-control @error('tautan_semhas') is-invalid @enderror"
                                        id="tautan_semhas" placeholder="https://www.meet.google.co.id"
                                        wire:model="tautan_semhas" wire:ignore.self>
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
                                    <input type="text"
                                        class="form-control @error('rev1_semhas') is-invalid @enderror"
                                        id="rev1_semhas" placeholder="Jhon Doe" wire:model="rev1_semhas">
                                    @error('rev1_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="rev2_semhas">Reviewer 2</label>
                                    <input type="text"
                                        class="form-control @error('rev2_semhas') is-invalid @enderror"
                                        id="rev2_semhas" placeholder="Anna Watson" wire:model="rev2_semhas">
                                    @error('rev2_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" wire:click="ubahsemhas()">Submit</button>
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
                                <label for="nrev1_semhas">Catatan Reviewer 1</label>
                                <textarea class="form-control @error('nrev1_semhas') is-invalid @enderror" id="nrev1_semhas" rows="3"
                                    wire:model="nrev1_semhas"></textarea>
                                @error('nrev1_semhas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nrev2_semhas">Catatan Reviewer 2</label>
                                <textarea class="form-control @error('nrev2_semhas') is-invalid @enderror" id="nrev2_semhas" rows="3"
                                    wire:model="nrev2_semhas"></textarea>
                                @error('nrev2_semhas')
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
