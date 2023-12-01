@extends('sidebar')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Pesanan</h4>
                <form class="forms-sample" method="post" action="{{route('pesanan.store')}}">
                @csrf
                <div class="form-group row">
                    <label for="id_pesanan" class="col-sm-3 col-form-label">ID Pesanan</label>
                    <div class="col-sm-9 text-dark">
                        <input type="number" class="form-control text-dark" id="id_pesanan" name="id_pesanan" placeholder="Masukkan ID">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan tanggal pesanan">
                    </div>
                </div>
                <div class="form-group row">

                <div class="form-group row">
                    <label for="menu" class="col-sm-3 col-form-label">Menu</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="id_menu" id="id_menu">
                            @foreach ($menus as $menu)
                            <option value="{{$menu->ID_Menu}}">{{$menu->ID_Menu}} - {{$menu->Nama_Menu}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pelanggan" class="col-sm-3 col-form-label">pelanggan</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="id_pelanggan" id="id_pelanggan">
                            @foreach ($pelanggans as $pelanggan)
                            <option value="{{$pelanggan->ID_Pelanggan}}">{{$pelanggan->ID_Pelanggan}} - {{$pelanggan->Nama_Pelanggan}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                <a href="{{route('pesanan.index')}}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@stop