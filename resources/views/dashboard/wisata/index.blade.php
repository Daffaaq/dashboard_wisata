@extends('dashboard.layouts.main')
@section('container')
<div class="container mt-3">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow my-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary fs-3"><strong>List Data Wisata</strong></h6>
            <div class="d-flex">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button type="button" class="btn btn-primary"><a class="text-decoration-none text-white" href="/dashboard/wisata/create">Tambah Wisata</a></button>
                    {{-- <button type="button" class="btn btn-primary"><a class="text-decoration-none text-white" href="/dashboard/cetak-barang">Cetak Data Wisata</a></button> --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>lokasi</th>
                        <th>jam</th>
                        <th>harga</th>
                        <th>deskripsi</th>
                        <th>gambar</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- @dd($wisata); --}}
                    @foreach($wisata as $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $b->nama }}</td>
                        <td>{{ $b->lokasi }}</td>
                        <td>{{ $b->jam }}</td>
                        <td>{{ $b->harga }}</td>
                        <td>{{ $b->deskripsi }}</td>
                        <td><img width="150px" src="{{ asset('storage/'.$b->gambar) }}" alt="Gambar Wisata"></td>
                        {{-- <td> <img src="{{asset('storage/' .$b->gambar)}}" class="mx-auto d-block" style="max-width: 100%;" alt="foto-produk"></td> --}}
                        
                        <td class="d-flex justify-content-evenly">
                            <a href="wisata/{{ $b->id }}" class="badge bg-success"><i class="bi bi-eye-fill" style="font-size: 18px;"></i></a>
                            <a href="wisata/{{ $b->id }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square" style="font-size: 18px;"></i></a>
                            <form action="wisata/{{ $b->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('beneran mau hapus?')"><i class="bi bi-trash" style="font-size: 18px;"></i></button>
                            </form>
                            <!-- <a href="barang/{{ $b->id }}" class="badge bg-warning"><i class="bi bi-pencil-square" style="font-size: 18px;"></i></a> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection