<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jenis Skim</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container-fluid">
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
                    <div class="col-lg-2"><button type="button" class="btn btn-success btn-sm mb-3" data-toggle="modal"
                            data-target="#add"><i class="fas fa-plus"></i>
                            Tambah Data
                        </button></div>
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
                            <div class="table-responsive-sm">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="vertical-align: middle">
                                            <th>No.</th>
                                            <th>Jenis Skim</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($skims) != null)
                                            @foreach ($skims as $index => $skim)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $skim->nm_skim }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#edit"
                                                            wire:click="edit({{ $skim->id_skim }})"><i
                                                                class="fas fa-edit"></i></a>
                                                        <a href="" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#delete"
                                                            wire:click="confirm({{ $skim->id_skim }})"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" style="background-color: #222E3C">
                                                    <h5 class="text-center text-white">Belum Ada Data</h5>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="pagination justify-content-center">
                                    {{ $skims->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Small boxes (Stat box) -->

            <!-- /.row -->
            <!-- Main row -->
            {{-- <div class="row"> --}}
            <!-- Left col -->

            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- right col -->
            {{-- </div> --}}
            <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- Modal Edit Bidang -->
    <div wire:ignore.self class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title"><i class="fas fa-edit"></i>Ubah Data</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="nm_skim">Jenis Skim</label>
                                <input type="nm_skim" class="form-control @error('nm_skim') is-invalid @enderror"
                                    id="nm_skim" name="nm_skim" value="" wire:model="enm_skim">
                                @error('nm_skim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="update()">Ubah</button>
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

    <!-- Modal Delete USER -->
    <div wire:ignore.self class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-trash"></i>Hapus Data</h4>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title"><i class="fas fa-edit"></i>Tambah Data</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="nm_skim">Jenis Skim</label>
                                <input type="nm_skim" class="form-control @error('nm_skim') is-invalid @enderror"
                                    id="nm_skim" name="nm_skim" wire:model="nm_skim" value="">
                                @error('nm_skim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="create()">Tambah</button>
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
            $("#reset").modal('hide');
        })
    </script>
</div>
