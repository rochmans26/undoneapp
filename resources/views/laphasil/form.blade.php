@extends('layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>Formulir Laporan Hasil</h1>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid mb-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulir Laporan Hasil</h3>&nbsp;
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                {{-- <div class="container-fluid">
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
                </div> --}}
                <div class="card-body">
                    <form action="{{ route('simpan-laporan-hasil') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="id">Referensi Proposal</label>
                            <select id="id" class="form-control select2 @error('id') is-invalid @enderror"
                                name="id" style="width: 100%" value="{{ old('id') }}">
                                <option value="">-- Judul Proposal --</option>
                                @foreach ($proposals as $proposal)
                                    <option value="{{ $proposal->id }}">{{ $proposal->judul_proposal }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="judul_pkm">Judul PKM</label>
                            <input type="text" class="form-control @error('judul_pkm') is-invalid @enderror"
                                id="judul_pkm" placeholder="Judul PKM" name="judul_pkm" value="{{ old('judul_pkm') }}">
                            @error('judul_pkm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="id_bidang">Bidang</label>
                                <select id="id_bidang" class="form-control @error('id_bidang') is-invalid @enderror"
                                    name="id_bidang" value="{{ old('id_bidang') }}">
                                    <option value="">-- Pilih Bidang --</option>
                                    @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->id_bidang }}">{{ $bidang->nm_bidang }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_bidang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="id_skim">Skim</label>
                                <select id="id_skim" class="form-control @error('id_skim') is-invalid @enderror"
                                    name="id_skim" value="{{ old('id_skim') }}">
                                    <option value="">-- Pilih Jenis Skim --</option>
                                    @foreach ($skims as $skim)
                                        <option value="{{ $skim->id_skim }}">{{ $skim->nm_skim }}</option>
                                    @endforeach
                                </select>
                                @error('id_skim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lok_kegiatan">Lokasi Kegiatan</label>
                            <input type="text" class="form-control @error('lok_kegiatan') is-invalid @enderror"
                                id="lok_kegiatan" placeholder="Lokasi Kegiatan" name="lok_kegiatan"
                                value="{{ old('lok_kegiatan') }}">
                            @error('lok_kegiatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="thn_mulai">Tahun Mulai</label>
                                <select id="thn_mulai" class="form-control @error('thn_mulai') is-invalid @enderror"
                                    name="thn_mulai" value="{{ old('thn_mulai') }}">
                                    <option value="">-- Tahun --</option>
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
                                <select id="thn_selesai" class="form-control @error('thn_selesai') is-invalid @enderror"
                                    name="thn_selesai" value="{{ old('thn_selesai') }}">
                                    <option value="">-- Tahun --</option>
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
                                    id="thn_pelaksanaan" placeholder="1998" name="thn_pelaksanaan">
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
                                <input type="number" class="form-control @error('dana_dikti') is-invalid @enderror"
                                    id="dana_dikti" placeholder="0,00" name="dana_dikti" value="{{ old('dana_dikti') }}">
                                @error('dana_dikti')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dana_unla">Dana Unla</label>
                                <input type="number" class="form-control @error('dana_unla') is-invalid @enderror"
                                    id="dana_unla" placeholder="0,00" name="dana_unla" value="{{ old('dana_unla') }}">
                                @error('dana_unla')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dana_lainnya">Dana Lainnya</label>
                                <input type="number" class="form-control @error('dana_lainnya') is-invalid @enderror"
                                    id="dana_lainnya" placeholder="0,00" name="dana_lainnya"
                                    value="{{ old('dana_lainnya') }}">
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
                                <input type="text" class="form-control @error('nosk_pkm') is-invalid @enderror"
                                    id="nosk_pkm" placeholder="No. SK PKM" name="nosk_pkm"
                                    value="{{ old('nosk_pkm') }}">
                                @error('nosk_pkm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tglsk_pkm">Tgl. SK PKM</label>
                                <input type="date" class="form-control @error('tglsk_pkm') is-invalid @enderror"
                                    id="tglsk_pkm" placeholder="" name="tglsk_pkm" value="{{ old('tglsk_pkm') }}">
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
                                <input type="text" class="form-control @error('mitra_pkm') is-invalid @enderror"
                                    id="mitra_pkm" placeholder="Mitra PKM" name="mitra_pkm"
                                    value="{{ old('mitra_pkm') }}">
                                @error('mitra_pkm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dok_laphasil">Dokumen</label>
                                <input type="file" class="form-control @error('dok_laphasil') is-invalid @enderror"
                                    id="dok_laphasil" name="dok_laphasil" value="{{ old('dok_laphasil') }}">
                                @error('dok_laphasil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
        </div>


    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#id').select2({
                theme: "bootstrap4",
            });
        });

        $('#id').change(function() {
         var id = $(this).val();
         var url = '{{ route("detail-proposal", ":id") }}';
         url = url.replace(':id', id);

         $.ajax({
             url: url,
             type: 'get',
             dataType: 'json',
             success: function(response) {
                 if (response != null) {
                     $('#id_bidang').val(response.id_bidang);
                     $('#id_skim').val(response.id_skim);
                     $('#lok_kegiatan').val(response.lokasi_kegiatan);
                     $('#thn_mulai').val(response.thn_mulai);
                     $('#thn_selesai').val(response.thn_selesai);
                    }
                }
            });
        });
    </script>
@endpush
