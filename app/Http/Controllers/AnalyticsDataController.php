<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsData;
use Illuminate\Http\Request;

class AnalyticsDataController extends Controller
{
    public function index()
    {
        $analytics = AnalyticsData::orderBy('date', 'asc')->get();

        // Group by platform
        $grouped = $analytics->groupBy('platform');
        $chartData = [];

        foreach ($grouped as $platform => $records) {
            $chartData[] = [
                'label' => ucfirst(str_replace('_', ' ', $platform)),
                'data' => $records->map(function ($item) {
                    return [
                        'x' => \Carbon\Carbon::parse($item->date)->format('Y-m-d'),
                        'y' => (int) $item->data,
                    ];
                }),
            ];
        }

        return view('analytics.index', [
            'analytics' => AnalyticsData::latest()->paginate(10),
            'chartData' => json_encode($chartData),
        ]);
    }

    public function create()
    {
        return view('analytics.create');
    }

    public function store(Request $request)
    {
        // return "ok";
        $action = $request->input('action');
        $platform = str_replace('_ok', '', $action);

        $dataField = $platform . '_data';
        $dateField = $platform . '_date';

        $request->validate([
            $dataField => 'required|string',
            $dateField => 'required|date',
        ]);

        AnalyticsData::create([
            'platform' => $platform,
            'data' => $request->input($dataField),
            'date' => $request->input($dateField),
        ]);

        return response()->json(['status' => 'success']);
    }








}