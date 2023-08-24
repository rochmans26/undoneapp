<div>
    {{-- In work, do what you enjoy. --}}
    <form action="{{ route('sp-admin.proposals.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul_proposal">Judul Proposal</label>
            <input type="text" class="form-control @error('judul_proposal') is-invalid @enderror" id="judul_proposal"
                placeholder="Judul Proposal" name="judul_proposal" value="{{ old('judul_proposal') }}">
            @error('judul_proposal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="id_bidang">Bidang</label>
                <select id="id_bidang" class="form-control @error('id_bidang') is-invalid @enderror" name="id_bidang"
                    value="{{ old('id_bidang') }}">
                    <option selected>-- Pilih Bidang --</option>
                    @foreach ($bidangs as $bidang)
                        <option value="{{ $bidang->id_bidang }}">{{ $bidang->nm_bidang }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="id_skim">Skim</label>
                <select id="id_skim" class="form-control @error('id_skim') is-invalid @enderror" name="id_skim"
                    value="{{ old('id_skim') }}">
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
                <label for="thn_usulan">Tahun Usulan</label>
                <input type="text" class="form-control @error('thn_usulan') is-invalid @enderror" id="thn_usulan"
                    placeholder="Tahun" name="thn_usulan" value="{{ old('thn_usulan') }}">
                @error('thn_usulan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="thn_kegiatan">Tahun Kegiatan</label>
                <input type="text" class="form-control @error('thn_kegiatan') is-invalid @enderror" id="thn_kegiatan"
                    placeholder="Tahun" name="thn_kegiatan" value="{{ old('thn_kegiatan') }}">
                @error('thn_kegiatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="thn_pelaksanaan">Tahun Pelaksanaan</label>
                <input type="text" class="form-control @error('thn_pelaksanaan') is-invalid @enderror"
                    id="thn_pelaksanaan" placeholder="Tahun" name="thn_pelaksanaan"
                    value="{{ old('thn_pelaksanaan') }}">
                @error('thn_pelaksanaan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <hr>

        {{-- Anggota Dosen Lokal --}}
        <div class="form-group text-center">
            <h3>Anggota Dosen</h3>
        </div>
        <div class="my-3">
            <button class="btn btn-primary" wire:click.prevent="addDosen"><i class="fas fa-plus"></i>
                Anggota</button>
        </div>
        <div class="dosen" id="dosen">
            @foreach ($keanggotaanProposal as $index => $anggota)
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_dosen">Nama Dosen</label>
                        <div class="input-group">
                            <select name="keanggotaanProposal[{{ $index }}][id_dosen]" id="id_dosen"
                                class="id_dosen form-control"
                                wire:model="keanggotaanProposal.{{ $index }}.id_dosen">
                                <option value="" selected>-- Pilih Dosen --</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id }}">
                                        {{ $dosen->nidn }} - {{ $dosen->nm_dosen }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" data-toggle="modal"
                                    data-target="#tambah_dosen"><i class="fas fa-plus"></i>
                                    Dosen</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="peran">Peran</label>
                        <div class="input-group">
                            <select class="form-control" id="peran"
                                name="keanggotaanProposal[{{ $index }}][peran]"
                                wire:model="keanggotaanProposal.{{ $index }}.peran">
                                <option selected>-- Pilih Peran --</option>
                                <option value="ketua">Ketua</option>
                                <option value="anggota">Anggota</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="button"
                                    wire:click.prevent="removeDosen({{ $index }})"><i class="fas fa-trash"></i>
                                    Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="anggotadosen"></div>
        </div>

        <hr>

        {{-- Anggota Dosen Luar --}}
        {{-- <div class="form-group text-center">
            <h3>Anggota Dosen Luar</h3>
        </div>

        <div class="dosenluar" id="dosenluar">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nidn">NIDN</label>
                    <input type="text" class="form-control @error('nidn') is-invalid @enderror"
                        id="nidn" name="nidn" wire:model="nidn">
                    @error('nidn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="nm_dosen">Nama Dosen</label>
                    <input type="text" class="form-control @error('nm_dosen') is-invalid @enderror"
                        id="nm_dosen" name="nm_dosen" wire:model="nm_dosen">
                    @error('nm_dosen')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="telp">Telp.</label>
                <input type="text" class="form-control @error('telp') is-invalid @enderror"
                    id="telp" name="telp" wire:model="telp">
                @error('telp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror"
                    id="email" name="email" wire:model="email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="fakultas">Fakultas</label>
                <input type="text" class="form-control @error('fakultas') is-invalid @enderror"
                    id="fakultas" name="fakultas" wire:model="fakultas">
                @error('fakultas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="prodi">Program Studi</label>
                <input type="text" class="form-control @error('prodi') is-invalid @enderror"
                    id="prodi" name="prodi" wire:model="prodi">
                @error('prodi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="universitas">Universitas</label>
                <input type="text" class="form-control @error('universitas') is-invalid @enderror"
                    id="universitas" name="universitas" wire:model="universitas">
                @error('universitas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="peran">Peran</label>
                <select class="form-control @error('peran') is-invalid @enderror" id="peran"
                    name="peran" wire:model="peran">
                    <option selected>-- Pilih Peran --</option>
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
        <hr> --}}

        {{-- Anggota Mahasiswa --}}
        {{-- <div class="form-group text-center">
            <h3>Anggota Mahasiswa</h3>
        </div>
        <div class="mahasiswa" id="mahasiswa">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="npm">NPM</label>
                    <input type="text" class="form-control @error('npm') is-invalid @enderror"
                        id="npm" name="npm" wire:model="npm">
                    @error('npm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="nm_mahasiswa">Nama Mahasiswa</label>
                    <input type="text"
                        class="form-control @error('nm_mahasiswa') is-invalid @enderror"
                        id="nm_mahasiswa" name="nm_mahasiswa" wire:model="nm_mahasiswa">
                    @error('nm_mahasiswa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="id_prodi">Program Studi</label>
                    <select id="id_prodi" class="form-control @error('id_prodi') is-invalid @enderror"
                        wire:model="id_prodi">
                        <option selected>-- Pilih Jenis Prodi --</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nm_prodi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="thn_masuk">Tahun Masuk</label>
                    <input type="number" class="form-control @error('thn_masuk') is-invalid @enderror"
                        id="thn_masuk" name="thn_masuk" wire:model="thn_masuk">
                    @error('thn_masuk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="peran">Peran</label>
                    <select class="form-control @error('peran') is-invalid @enderror" id="peran"
                        name="peran" wire:model="peran">
                        <option selected>-- Pilih Peran --</option>
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
        </div> --}}
        <hr>
        {{-- <div class="form-group">
            <label for="dok_link">Dokumen</label>
            <input type="file" class="form-control @error('dok_link') is-invalid @enderror" id="dok_link"
                wire:model="dok_link">
            @error('dok_link')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div> --}}
        <input type="submit" value="Kirim" class="btn btn-primary">
    </form>


    <div class="modal fade" id="tambah_dosen">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-edit"></i> Tambah Dosen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambah-dosen') }}" method="POST">
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
                            <div class="form-group">
                                <label for="jafung">Jabatan Fungsional</label>
                                <select class="form-control @error('jafung') is-invalid @enderror" id="jafung"
                                    name="jafung">
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
                            <div class="form-group">
                                <label for="id_prodi">Prodi</label>
                                <select class="form-control @error('id_prodi') is-invalid @enderror"
                                    wire:model="id_prodi" id="id_prodi" name="id_prodi">
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

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#id_dosen').select2();
        });
    </script>
</div>
