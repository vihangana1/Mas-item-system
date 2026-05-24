<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diesel;

class UserDieselController extends Controller
{
    public function index()
    {
        // Use same ordering as admin so numbering (loop->iteration) matches
        $diesels = Diesel::latest()->get();
        return view('User.user_diesel_page', compact('diesels'));
    }

    public function refresh()
    {
        $diesels = Diesel::latest()->get();
        return response()->json([
            'html' => view('User.partials.diesel_rows', compact('diesels'))->render(),
        ]);
    }

    /**
     * Download diesel records as CSV and optionally push to Google Sheets webhook.
     */
    public function download(Request $request)
    {
        $diesels = Diesel::latest()->get();

        $filename = 'diesel_export_'.now()->format('Ymd_His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($diesels) {
            $out = fopen('php://output', 'w');
            // Header row
            fputcsv($out, ['No','Date','Main Level (cm)','Main Liters','Day Level (cm)','Day Liters','Gen1 L','Gen2 L','Gen3 L','Total L','Admin Username','Admin Password','Updated At']);

            foreach ($diesels as $index => $d) {
                fputcsv($out, [
                    $index + 1,
                    $d->diesel_fill_date,
                    $d->main_storage_tank_level,
                    $d->main_storage_tank_liters,
                    $d->boiler_day_tank_level,
                    $d->boiler_day_tank_liters,
                    $d->generator_1_liters,
                    $d->generator_2_liters,
                    $d->generator_3_liters,
                    $d->deisel_total_liters,
                    $d->admin_username,
                    $d->admin_password,
                    $d->updated_at,
                ]);
            }

            fclose($out);
        };

        // Optionally post to a Google Sheets webhook (Apps Script URL) if provided
        $webhook = config('services.google_sheets.webhook_url') ?: env('GOOGLE_SHEETS_WEBHOOK');
        if ($webhook) {
            try {
                $rows = $diesels->map(function($d, $i){
                    return [
                        $i+1,
                        $d->diesel_fill_date,
                        $d->main_storage_tank_level,
                        $d->main_storage_tank_liters,
                        $d->boiler_day_tank_level,
                        $d->boiler_day_tank_liters,
                        $d->generator_1_liters,
                        $d->generator_2_liters,
                        $d->generator_3_liters,
                        $d->deisel_total_liters,
                        $d->admin_username,
                        $d->admin_password,
                        $d->updated_at,
                    ];
                })->toArray();

                // Send minimal JSON payload
                @file_get_contents($webhook, false, stream_context_create([
                    'http' => [
                        'method' => 'POST',
                        'header' => "Content-Type: application/json\r\n",
                        'content' => json_encode(['rows' => $rows]),
                        'timeout' => 5,
                    ]
                ]));
            } catch (\Exception $e) {
                // swallow; download still works
            }
        }

        return response()->stream($callback, 200, $headers);
    }
}
