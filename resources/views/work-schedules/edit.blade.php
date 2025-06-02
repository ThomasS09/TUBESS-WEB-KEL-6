{{-- filepath: d:\cucimobilpaw\car-wash-management\resources\views\work-schedules\edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Jadwal Kerja</h2>
    <form action="{{ route('work-schedules.update', $workSchedule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="employee_id" class="form-label">Karyawan</label>
            <select name="employee_id" id="employee_id" class="form-select" required>
                <option value="">-- Pilih Karyawan --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $workSchedule->employee_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $workSchedule->date }}" required>
        </div>
        <div class="mb-3">
            <label for="shift" class="form-label">Shift</label>
            <select name="shift" id="shift" class="form-select" required>
                <option value="">-- Pilih Shift --</option>
                <option value="pagi" {{ $workSchedule->shift == 'pagi' ? 'selected' : '' }}>Pagi</option>
                <option value="siang" {{ $workSchedule->shift == 'siang' ? 'selected' : '' }}>Siang</option>
                <option value="malam" {{ $workSchedule->shift == 'malam' ? 'selected' : '' }}>Malam</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('work-schedules.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection