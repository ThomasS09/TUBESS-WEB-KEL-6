{{-- filepath: d:\cucimobilpaw\car-wash-management\resources\views\work-schedules\edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Jadwal Kerja</h2>
<style>
body {
    background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container {
    max-width: 420px;
    margin: 60px auto;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
    padding: 36px 28px;
}

h2 {
    text-align: center;
    color: #1e3c72;
    margin-bottom: 24px;
    font-weight: 700;
}

label {
    display: block;
    margin-bottom: 6px;
    color: #333;
    font-weight: 500;
}

input[type="text"],
input[type="email"],
input[type="date"],
select {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 18px;
    border: 1px solid #bfc9d1;
    border-radius: 7px;
    font-size: 1em;
    transition: border 0.2s;
    box-sizing: border-box;
    background: #f8fafc;
}

input:focus, select:focus {
    border-color: #1e3c72;
    outline: none;
    background: #eaf1fb;
}

button, .btn {
    padding: 12px 0;
    width: 48%;
    background: #1e3c72;
    color: #fff;
    border: none;
    border-radius: 7px;
    font-size: 1.1em;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
    margin-top: 10px;
    margin-right: 2%;
    display: inline-block;
    text-align: center;
    text-decoration: none;
}

button:hover, .btn:hover {
    background: #2a5298;
    transform: translateY(-2px) scale(1.03);
}

.btn-cancel {
    background: #e74c3c;
}

.btn-cancel:hover {
    background: #c0392b;
}

@media (max-width: 600px) {
    .container {
        padding: 18px 6px;
    }
    button, .btn {
        width: 100%;
        margin-bottom: 8px;
    }
}
</style>
<form action="{{ route('employee.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="employee_id" class="form-label">Karyawan</label>
            <select name="employee_id" id="employee_id" class="form-select" required>
                <option value="">-- Pilih Karyawan --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $employee->date }}" required>
        </div>
        <div class="mb-3">
            <label for="shift" class="form-label">Shift</label>
            <select name="shift" id="shift" class="form-select" required>
                <option value="">-- Pilih Shift --</option>
                <option value="pagi" {{ $employee->shift == 'pagi' ? 'selected' : '' }}>Pagi</option>
                <option value="siang" {{ $employee->shift == 'siang' ? 'selected' : '' }}>Siang</option>
                <option value="malam" {{ $employee->shift == 'malam' ? 'selected' : '' }}>Malam</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('work-schedules.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection