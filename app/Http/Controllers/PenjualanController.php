<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;


class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar Penjualan',
        ];

        $activeMenu = 'penjualan';

        $user = UserModel::all();

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'user' => $user]);
    }

    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')->with('user');

      if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }

        return DataTables::of($penjualans)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create_ajax()
    {
        $user = UserModel::select('user_id', 'nama')->get();

        return view('penjualan.create_ajax')
            ->with('user', $user);
    }


    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'user_id' => 'required|integer',
                'pembeli' => 'required|string',
                'penjualan_kode' => 'required|string|unique:t_penjualan,penjualan_kode',
                'penjualan_tanggal' => 'required|date_format:Y-m-d\TH:i'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            // Simpan ke model yang benar (misalnya PenjualanModel)
            PenjualanModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data Penjualan Berhasil Disimpan',
            ]);
        }

        return redirect('/penjualan');
    }

    public function detail_ajax(Request $request, $id) 
    {
        if ($request->ajax() || $request->wantsJson()) {
            $penjualan = PenjualanModel::find($id);
            if ($penjualan) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil ditampilkan'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }    
        return redirect('/penjualan');
    }

    public function show_ajax(string $id)
    {
        $penjualan = PenjualanModel::find($id);

        return view('penjualan.show_ajax', ['penjualan' => $penjualan]);
    }

    public function edit_ajax(string $id){
        $penjualan = PenjualanModel::find($id);
        $user = UserModel::select('user_id', 'nama')->get();
    
        return view('penjualan.edit_ajax', ['penjualan' => $penjualan, 'user' => $user]);
    }

    public function update_ajax(Request $request, string $id){
        // Cek apakah request berasal dari AJAX atau JSON
        if($request->ajax() || $request->wantsJson()){
            $rules =[
                'user_id' => 'required|integer',
                'pembeli' => 'required|string',
                'penjualan_kode' => 'required|string|unique:t_penjualan,penjualan_kode',
                'penjualan_tanggal' => 'required|date_format:Y-m-d\TH:i'
            ];
    
            // Menggunakan Validator untuk validasi input
            $validator = Validator::make($request->all(), $rules);
    
            if($validator->fails()){
                return response()->json([
                    'status' => false, // Respon JSON: true = berhasil, false = gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // Menampilkan error per field
                ]);
            }
    
            // Mencari data penjualan berdasarkan id
            $check = PenjualanModel::find($id);
            if($check){
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        
        return redirect('/penjualan');
    }

    public function confirm_ajax(string $id)
    {
        $penjualan = PenjualanModel::find($id);

        return view('penjualan.confirm_ajax', ['penjualan' => $penjualan]);
    }

    public function delete_ajax(Request $request, $id) 
    {
        if ($request->ajax() || $request->wantsJson()) {
            $penjualan = PenjualanModel::find($id);
            if ($penjualan) {
                $penjualan->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]); 
            }
        }    
        return redirect('/penjualan');
    }

    public function import()
    {
        return view('penjualan.import');
    }




}
