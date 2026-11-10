@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<main class="admin-page">
    <div class="container admin-container wide">
        <div class="page-heading">
            <div>
                <span class="eyebrow">Dashboard sederhana</span>
                <h1>Kelola Produk</h1>
            </div>
            <div class="heading-action">
                <a class="btn btn-secondary" href="{{ route('landing') }}">
                    Lihat Landing Page</a>

                <a class="btn" href="{{ route('produk.create') }}">
                    Tambah Produk</a>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $item)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>
                            <strong>{{ $item->nama_produk }}</strong>
                            <small>{{ $item->deskripsi }}</small>
                        </td>
                        <td>
                            Rp{{ number_format($item->harga,0, ',','.') }}
                        </td> 
                        <td><img src="{{ asset('images/' . ($item->gambar ?: 'kopi-default.jpg')) }}" alt="{{ $item->nama_produk }}" width="100" class="produk-image"></td>
                        <td class="actions">
                            <a class="btn btn-small btn-edit" href="{{ route('produk.edit', $item) }}">
                                Edit
                            </a>
                            <form method="POST" 
                            action="{{ route('produk.destroy', $item) }}"
                            onsubmit="return confirm('Hapus produk ini?')">
                            
                            @csrf
                             @method('DELETE')
                                <button class="btn btn-small btn-danger" 
                                type="submit">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Tidak ada produk yang tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection