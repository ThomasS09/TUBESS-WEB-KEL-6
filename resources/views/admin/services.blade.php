<!DOCTYPE html>
<html>
<head>
    <title>Kelola Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4">Daftar Layanan</h1>

        <a href="#" class="btn btn-primary mb-3">+ Tambah Layanan</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Layanan</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop layanan --}}
                <tr>
                    <td>1</td>
                    <td>Cuci Eksterior</td>
                    <td>Cuci bagian luar kendaraan</td>
                    <td>Rp50.000</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning">Edit</a>
                        <form action="#" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus layanan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
