<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="container-fluid my-2">
        @if (session()->has('suc_mhs'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" wire:ignore>
                {{ session('suc_mhs') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session()->has('err_mhs'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" wire:ignore>
                {{ session('err_mhs') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="table-responsive-sm">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Peran</th>
                    <th>Prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($anggota) != null)
                    @foreach ($anggota as $index => $mhs)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mhs->npm_mhs }}</td>
                            <td>{{ $mhs->mahasiswa->nm_mahasiswa }}</td>
                            <td>{{ $mhs->peran }}</td>
                            <td>{{ $mhs->mahasiswa->prodi->nm_prodi }}</td>
                            <td>
                                <a href="" class="btn-sm btn-warning text-white" data-toggle="modal"
                                    data-target="#edit_mhs" wire:click="detail({{ $mhs->id }})"><i
                                        class="nav-icon fas fa-cog"></i>
                                    Peran</a>
                                <a href="" data-toggle="modal" data-target="#del_mhs" class="btn-sm btn-danger"
                                    wire:click="detail({{ $mhs->id }})"><i class="nav-icon fas fa-trash"></i>
                                    Hapus</a>
                                {{-- <a href="" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#detail_dosenlokal" wire:click="detail({{ $doslok->id }})"><i
                                        class="nav-icon fas fa-eye"></i>
                                    Detail</a> --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center"><span class="bg bg-danger p-2">Data
                                Kosong.</span>
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>


    <div wire:ignore.self class="modal fade" id="edit_mhs">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Ubah Data Anggota Dosen</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="peran">Peran</label>
                                <select class="form-control @error('peran') is-invalid @enderror" id="peran"
                                    name="peran" wire:model="peran">
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
                            <button type="button" id="btn_ubah" class="btn btn-primary" wire:click="update()"
                                data-dismiss="modal">Submit</button>
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

    <div wire:ignore.self class="modal fade" id="del_mhs">
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
                        <button class="btn btn-danger btn-sm" wire:click="delete()" data-dismiss="modal">Hapus</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
