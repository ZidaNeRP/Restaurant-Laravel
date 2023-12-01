@extends('sidebar')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center mb-4">
                <h4 class="card-title mb-sm-0">Daftar Pelanggan</h4>
                <form action="{{ route('pelanggan.index') }}" method="GET" class="mr-0 ml-auto mb-1 mb-sm-0">
                    <input type="text" name="search" class="form-control rounded-1 text-dark" placeholder="Cari Pelanggan..." value="{{ $searchTerm }}">
                </form>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-lg btn-inverse-info p-2 mr-1 ml-3 mb-1 mb-sm-0">Tambah Data Pelanggan</a>
                </div>
                <div class="table-responsive border rounded p-1">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="font-weight-bold">ID Pelanggan</th>
                                <th class="font-weight-bold">Nama Pelanggan</th>
                                <th class="font-weight-bold">Nomor Telepon</th>
                                <th class="font-weight-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                            <tr>
                                <td>{{ $data->ID_Pelanggan }}</td>
                                <td>{{ $data->Nama_Pelanggan }}</td>
                                <td>{{ $data->Nomor_Telepon }}</td>
                                <td>
                                    <a href="{{ route('pelanggan.edit', $data->ID_Pelanggan) }}" class="btn btn-primary p-2">Edit</a>
                                    <button class="btn btn-danger p-2 ml-1" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->ID_Pelanggan }}">Delete</button>

                                    <!-- Modals -->
                                    <div class="modal fade" id="hapusModal{{ $data->ID_Pelanggan }}" tabindex="-1"
                                        aria-labelledby="hapusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="{{ route('pelanggan.delete', $data->ID_Pelanggan) }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Ya</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
