<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diesel;

class DieselController extends Controller
{
    public function dieselPage(){
        $diesels = Diesel::latest()->get();
        return view('admin.diesel_page', compact('diesels'));
    }

    public function store(Request $request){
        $request->validate([
            'diesel_fill_date' => 'nullable|date',
            'main_storage_tank_level' => 'nullable|integer',
            'main_storage_tank_liters' => 'nullable|integer',
            'boiler_day_tank_level' => 'nullable|integer',
            'boiler_day_tank_liters' => 'nullable|integer',
            'generator_1_liters' => 'nullable|integer',
            'generator_2_liters' => 'nullable|integer',
            'generator_3_liters' => 'nullable|integer',
            'admin_username' => 'nullable|string',
            'admin_password' => 'nullable|string',
        ]);

        $deisel_total_liters = (int)($request->main_storage_tank_liters ?? 0)
            + (int)($request->boiler_day_tank_liters ?? 0)
            + (int)($request->generator_1_liters ?? 0)
            + (int)($request->generator_2_liters ?? 0)
            + (int)($request->generator_3_liters ?? 0);

        $data = $request->only([
            'diesel_fill_date',
            'main_storage_tank_level',
            'main_storage_tank_liters',
            'boiler_day_tank_level',
            'boiler_day_tank_liters',
            'generator_1_liters',
            'generator_2_liters',
            'generator_3_liters',
            'admin_username',
            'admin_password',
        ]);
        $data['deisel_total_liters'] = $deisel_total_liters;

        $diesel = Diesel::create($data);

        if ($request->wantsJson()) {
            $html = view('admin.partials.diesel_row', ['diesel' => $diesel, 'index' => 1])->render();
            return response()->json(['success' => true, 'html' => $html]);
        }

        return redirect()->back()->with('success', 'Diesel entry created successfully.');
    }

    public function update(Request $request, $id){
        $diesel = Diesel::findOrFail($id);

        $request->validate([
            'diesel_fill_date' => 'nullable|date',
            'main_storage_tank_level' => 'nullable|integer',
            'main_storage_tank_liters' => 'nullable|integer',
            'boiler_day_tank_level' => 'nullable|integer',
            'boiler_day_tank_liters' => 'nullable|integer',
            'generator_1_liters' => 'nullable|integer',
            'generator_2_liters' => 'nullable|integer',
            'generator_3_liters' => 'nullable|integer',
            'admin_username' => 'nullable|string',
            'admin_password' => 'nullable|string',
        ]);

        $deisel_total_liters = (int)($request->main_storage_tank_liters ?? 0)
            + (int)($request->boiler_day_tank_liters ?? 0)
            + (int)($request->generator_1_liters ?? 0)
            + (int)($request->generator_2_liters ?? 0)
            + (int)($request->generator_3_liters ?? 0);

        $data = $request->only([
            'diesel_fill_date',
            'main_storage_tank_level',
            'main_storage_tank_liters',
            'boiler_day_tank_level',
            'boiler_day_tank_liters',
            'generator_1_liters',
            'generator_2_liters',
            'generator_3_liters',
            'admin_username',
            'admin_password',
        ]);
        $data['deisel_total_liters'] = $deisel_total_liters;

        $diesel->update($data);

        return redirect()->back()->with('success', 'Diesel entry updated successfully.');
    }

    public function destroy($id){
        $diesel = Diesel::findOrFail($id);
        $diesel->delete();

        return redirect()->back()->with('success', 'Diesel entry deleted successfully.');
    }
}
