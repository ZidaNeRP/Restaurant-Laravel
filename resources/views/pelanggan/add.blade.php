@extends('sidebar')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Pelanggan</h4>
                <form class="forms-sample" method="post" action="{{route('pelanggan.store')}}">
                @csrf
                <div class="form-group row">
                    <label for="id_pelanggan" class="col-sm-3 col-form-label">ID Pelanggan</label>
                    <div class="col-sm-9 text-dark">
                        <input type="number" class="form-control text-dark" id="id_pelanggan" name="id_pelanggan" placeholder="Masukkan ID">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_pelanggan" class="col-sm-3 col-form-label">Nama pelanggan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan Nama">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nomer_telepon" class="col-sm-3 col-form-label">Telepon</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nomer_telepon" name="nomer_telepon" placeholder="Masukkan nomor telepon">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                <a href="{{route('pelanggan.index')}}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@stop