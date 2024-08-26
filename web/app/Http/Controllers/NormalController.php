<?php

namespace App\Http\Controllers;

use App\Models\Normal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NormalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waters = Normal::latest()->get();
        return view('water.index', compact('waters'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('water.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'days' => 'required',
            'time' => 'required',
            'level' => 'required',
            'action' => 'required',
        ]);

        $totalData = Normal::count();

        // Jika total data lebih dari 30, hapus data yang paling lama
        if ($totalData > 30) {
            $oldestData = Normal::orderBy('created_at', 'asc')->first();
            $oldestData->delete();
        }

        Normal::create([
            'date' => $request->input('date'),
            'days' => $request->input('days'),
            'time' => $request->input('time'),
            'level' => $request->input('level'),
            'action' => $request->input('action'),
        ]);

        return redirect()->route('water.index')
            ->with('success', 'Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Normal $normal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Normal $normal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Normal $normal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Normal $normal)
    {
        $normal->delete();
        return redirect()->route('water.index')
            ->with('success', 'Berhasil Dihapus');
    }
}
