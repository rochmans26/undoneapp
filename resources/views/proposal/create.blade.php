@extends('layouts.master', $dosens)
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>Formulir Pengajuan</h1>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid mb-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulir Pengajuan Proposal</h3>&nbsp;
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
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
                <div class="card-body">
                    @livewire('form-proposal')
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(".t_anggotadosen").on('click', function() {
            add_anggotadosen();

        });

        function add_anggotadosen() {
            var anggotadosen =
                '<div class="form-row"><div class="form-group col-md-6"><label for="id_dosen">Nama Dosen</label><div class="input-group"><select name="id_dosen" id="id_dosen" class="id_dosen form-control"><option value="" selected>-- Pilih Dosen --</option>@foreach ($dosens as $dosen)<option value="{{ $dosen->id }}">{{ $dosen->nidn }} - {{ $dosen->nm_dosen }}</option>@endforeach</select>@error('id_dosen')<div class="invalid-feedback">{{ $message }}</div>@enderror</div></div><div class="form-group col-md-6"><label for="peran">Peran</label><div class="input-group"><select class="form-control @error('peran') is-invalid @enderror" id="peran"name="peran"><option selected>-- Pilih Peran --</option><option value="ketua">Ketua</option><option value="anggota">Anggota</option></select><div class="input-group-append"><button class="remove btn btn-danger" type="button"><iclass="fas fa-trash"></i>Hapus</button></div>@error('peran')<div class="invalid-feedback">{{ $message }}</div>@enderror</div></div></div>';

            $('.anggotadosen').append(anggotadosen);
        }
        $('.remove').on('click', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>
@endsection
