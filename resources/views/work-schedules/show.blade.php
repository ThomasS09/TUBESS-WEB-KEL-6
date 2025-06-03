@extends('layouts.app')

@section('content')
<div style="max-width:600px;margin:40px auto;background:#fff;border-radius:12px;box-shadow:0 4px 16px rgba(30,60,114,0.10);padding:32px;">
    <h2 style="color:#1e3c72;text-align:center;margin-bottom:24px;">Jadwal Kerja Hari Ini</h2>
    @if(count($todaySchedules))
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#e0eafc;">
                    <th style="padding:8px;border-bottom:1px solid #bfc9d1;">Mulai</th>
                    <th style="padding:8px;border-bottom:1px solid #bfc9d1;">Selesai</th>
                    <th style="padding:8px;border-bottom:1px solid #bfc9d1;">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($todaySchedules as $schedule)
                    <tr>
                        <td style="padding:8px;border-bottom:1px solid #f0f0f0;">{{ $schedule->start_time }}</td>
                        <td style="padding:8px;border-bottom:1px solid #f0f0f0;">{{ $schedule->end_time }}</td>
                        <td style="padding:8px;border-bottom:1px solid #f0f0f0;">{{ $schedule->notes  }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align:center;color:#888;">Tidak ada jadwal kerja hari ini.</p>
    @endif
</div>
@endsection