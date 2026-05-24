@foreach($diesels as $diesel)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td class="fw-bold" style="color: #4dc3c3;">{{ \Carbon\Carbon::parse($diesel->diesel_fill_date)->format('d/m') }}</td>
        <td>{{ $diesel->main_storage_tank_level ?? '-' }}</td>
        <td>{{ $diesel->main_storage_tank_liters ?? '-' }}</td>
        <td>{{ $diesel->boiler_day_tank_level ?? '-' }}</td>
        <td>{{ $diesel->boiler_day_tank_liters ?? '-' }}</td>
        <td>{{ $diesel->generator_1_liters ?? '-' }}</td>
        <td>{{ $diesel->generator_2_liters ?? '-' }}</td>
        <td>{{ $diesel->generator_3_liters ?? '-' }}</td>
        <td class="fw-bold text-success">{{ number_format($diesel->deisel_total_liters ?? 0) }}</td>
        <td>{{ $diesel->updated_at ? \Carbon\Carbon::parse($diesel->updated_at)->timezone(config('app.timezone'))->format('H:i d/m') : '-' }}</td>
        <td>{{ $diesel->admin_username ?? '-' }}</td>
        <td>{{ $diesel->admin_password ?? '-' }}</td>
    </tr>
@endforeach
