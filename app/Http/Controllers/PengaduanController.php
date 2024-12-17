<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PengaduanController extends Controller
{

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $report = Pengaduan::findOrFail($id);

        Comment::create([
            'report_id' => $report->id,
            'comment' => $request->comment,
            'user_id' => auth()->id(), // Mengambil ID pengguna yang login
        ]);

        return redirect()->route('report.show', $id)->with('success', 'Komentar berhasil ditambahkan.');
    }
    public function index(Request $request)
    {
        $province = $request->input('province');

        // Ambil data laporan berdasarkan provinsi (jika dipilih)
        $reports = Pengaduan::with(['users', 'comments'])
        ->when($province, function ($query, $province) {
            return $query->where('province', 'LIKE', "%{$province}%");
        })
        ->get();

        return view('report.artikel', compact('reports'));
        // dd($reports);
    }

    public function create()
    {
        return view('report.create_report');
    }

    public function store(Request $request)
    {
        $request->validate([
            'province' => 'required|string|max:255',
            'regency' => 'required|string|max:255',
            'subdistrict' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'type' => 'required|string|in:KEJAHATAN,PEMBANGUNAN,SOSIAL',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'statement' => 'required|accepted'
        ]);

        try {
            $provinceName = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/province/{$request->province}.json")->json()['name'];
            $regencyName = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regency/{$request->regency}.json")->json()['name'];
            $subdistrictName = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/district/{$request->subdistrict}.json")->json()['name'];
            $villageName = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/village/{$request->village}.json")->json()['name'];
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengambil data lokasi. Silakan coba lagi.']);
        }

        $filePath = null;
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('reports', 'public');
        }

        Pengaduan::create([
            'user_id' => Auth::id(),
            'province' => $provinceName,
            'regency' => $regencyName,
            'subdistrict' => $subdistrictName,
            'village' => $villageName,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $filePath,
            'statement' => true,
        ]);

        return redirect()->route('report.show')->with('success', 'Berhasil membuat pengaduan.');
    }


    public function show()
    {

        // return view('report.show_report');
        $reports = Pengaduan::with(['users', 'comments'])->get();
           return view('report.show_report', compact('reports'));
    }
    public function show_report()
    {
        // Tampilkan laporan milik pengguna yang sedang login
        $reports = Pengaduan::where('user_id', Auth::id())->get();
        $reports = Pengaduan::with('comments')->get();
        return view('report.detail', compact('reports'));
    }
}
