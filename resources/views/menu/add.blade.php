@extends('sidebar')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Menu</h4>
                <form class="forms-sample" method="post" action="{{route('menu.store')}}">
                @csrf
                <div class="form-group row">
                    <label for="id_menu" class="col-sm-3 col-form-label">ID Menu</label>
                    <div class="col-sm-9 text-dark">
                        <input type="number" class="form-control text-dark" id="id_menu" name="id_menu" placeholder="Masukkan ID">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_menu" class="col-sm-3 col-form-label">Nama Menu</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Masukkan Nama">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan nomor harga">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                <a href="{{route('menu.index')}}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@stop