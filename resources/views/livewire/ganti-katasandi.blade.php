<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-key"></i> Ganti Kata Sandi</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center my-3">
            <!-- left column -->
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ganti Kata Sandi</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form wire:submit.prevent='ganti'>
                        <div class="card-body">
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="oldpassword">Kata Sandi Lama</label>
                                <input type="password" class="form-control @error('oldpassword') is-invalid @enderror"
                                    id="kata-sandi-lama" placeholder="Kata Sandi Lama" wire:model='oldpassword'>
                                @error('oldpassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="newpassword">Kata Sandi Baru</label>
                                <input type="password" class="form-control @error('newpassword') is-invalid @enderror"
                                    id="newpassword" placeholder="Kata Sandi Baru" wire:model="newpassword">
                                @error('newpassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
