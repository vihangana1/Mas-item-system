<tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
    <td class="text-white-50">{{ $index }}</td>
    <td class="text-white-50">{{ $diesel->diesel_fill_date }}</td>
    <td class="text-white-50">{{ $diesel->main_storage_tank_level ?? 0 }} cm / {{ $diesel->main_storage_tank_liters ?? 0 }} L</td>
    <td class="text-white-50">{{ $diesel->boiler_day_tank_level ?? 0 }} cm / {{ $diesel->boiler_day_tank_liters ?? 0 }} L</td>
    <td class="text-white-50">{{ $diesel->generator_1_liters ?? 0 }} L</td>
    <td class="text-white-50">{{ $diesel->generator_2_liters ?? 0 }} L</td>
    <td class="text-white-50">{{ $diesel->generator_3_liters ?? 0 }} L</td>
    <td class="text-white-50 fw-bold">{{ number_format($diesel->deisel_total_liters ?? 0) }} L</td>
    <td class="text-white-50">{{ $diesel->admin_username ?? '-' }}</td>
    <td class="text-white-50">{{ $diesel->admin_password ?? '-' }}</td>
</tr>
