@extends('sidebar')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ubah Data Pelanggan</h4>
                <form class="forms-sample" method="post" action="{{route('pelanggan.update', $data->id_pelanggan)}}">
                @csrf
                <div class="form-group row">
                    <label for="nama_pelanggan" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan Nama" value="{{ $data->nama_pelanggan }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nomer_telepon" class="col-sm-3 col-form-label">Telepon</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nomer_telepon" name="nomer_telepon" placeholder="Masukkan nomor telepon" value="{{ $data->nomer_telepon }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                <button class="btn btn-light">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop