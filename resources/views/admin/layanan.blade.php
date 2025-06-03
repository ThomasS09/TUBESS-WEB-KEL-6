{{-- resources/views/admin/carwash/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Daftar Paket Carwash')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Manajemen Paket Carwash</h1>

    {{-- Tombol tambah paket --}}
    <div class="mb-3 text-end">
        <a href="{{ route('admin.carwash.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Paket Carwash
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel paket carwash --}}
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Nama Paket</th>
                    <th>Deskripsi</th>
                    <th>Harga (Rp)</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paketCarwash as $index => $paket)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $paket->nama_paket }}</td>
                        <td>{{ Str::limit($paket->deskripsi, 50) }}</td>
                        <td>{{ number_format($paket->harga, 0, ',', '.') }}</td>
                        <td>
                            @if($paket->status === 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.carwash.edit', $paket->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.carwash.destroy', $paket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada paket carwash tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
