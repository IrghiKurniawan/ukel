<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PengaduanController extends Controller
{
    public function index()
    {
        $reports = Pengaduan::with(['user'])->get();
        return view('report.artikel', compact('reports'));
        // dd($reports);
    }

    public function create()
    {
        return view('report.create_report');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'province' => 'required|string|max:255',
            'regency' => 'required|string|max:255',
            'subdistrict' => 'required|string|max:255',
            'vilage' => 'required|string|max:255',
            'type' => 'required|string|in:KEJAHATAN,PEMBANGUNAN,SOSIAL',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'statement' => 'required|accepted'
        ]);

        
        $provinceName = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/province/{$request->province}.json")->json()['name'];
        $regencyName = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regency/{$request->regency}.json")->json()['name'];
        $subdistrictName = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/district/{$request->subdistrict}.json")->json()['name'];
        $villageName = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/village/{$request->vilage}.json")->json()['name'];

        // Upload file gambar
        $filePath = null;
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('reports', 'public');
        }

        $report = new Pengaduan();
        $report->user_id = Auth::id();
        $report->province = $provinceName;
        $report->regency = $regencyName;
        $report->subdistrict = $subdistrictName;
        $report->village = $villageName;
        $report->type = $request->type;
        $report->description = $request->description;
        $report->image = $filePath; 
        $report->statement = true;
        $report->save();

        // // Simpan data ke database
        // $report = new Pengaduan();
        // $report->user_id = Auth::id();
        // $report->province = $request->province;
        // $report->regency = $request->regency;
        // $report->subdistrict = $request->subdistrict;
        // $report->village = $request->vilage; // Perbaikan typo
        // $report->type = $request->type;
        // $report->description = $request->description;
        // $report->image = $filePath; // Simpan path gambar
        // $report->statement = true;
        // $report->save();

        // Redirect ke halaman laporan dengan pesan sukses
        return redirect()->route('report.show')->with('success', 'Berhasil membuat pengaduan.');
    }

    public function show()
    {
        $reports = Pengaduan::where('user_id', Auth::id())->get();
        return view('report.show_report', compact('reports'));
    }
}
