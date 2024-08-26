<?php

use App\Http\Controllers\NormalController;
use App\Models\Normal;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $waters = Normal::latest()->get();

    // Ambil data dari database
    $data = Normal::orderBy('date', 'desc')
        ->orderBy('time', 'desc')
        ->take(15)
        ->get(); // Ganti dengan query yang sesuai

    // Format data menjadi format JSON untuk grafik
    $chartData = $data->map(function ($item) {
        $date = $item->date . 'T' . $item->time . 'Z';
        return [
            'date' => $date, // Sesuaikan dengan format tanggal di database
            'value' => $item->level
        ];
    });

    return view('welcome', compact('waters', 'chartData'))->with('i');
});

Route::resource('water', NormalController::class);

Route::get('/diagram', function () {
    // Ambil data dari database
    $data = Normal::orderBy('date', 'desc')
        ->orderBy('time', 'desc')
        ->take(15)
        ->get(); // Ganti dengan query yang sesuai

    // Format data menjadi format JSON untuk grafik
    $chartData = $data->map(function ($item) {
        $date = $item->date . 'T' . $item->time . 'Z';
        return [
            'date' => $date, // Sesuaikan dengan format tanggal di database
            'value' => $item->level
        ];
    });
    return view('diagram', compact('chartData'));
});
