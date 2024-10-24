<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar detail penjualan'
        ];


        $activeMenu = 'detailpenjualan';

        $penjualan = PenjualanModel::all();
        $barang = BarangModel::all();

        return view('detailpenjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'penjualan' => $penjualan, 'barang' => $barang]);
    }

    public function list(Request $request){
        $detailpenjualans = PenjualanDetailModel::select('detail_id', 'penjualan_id', 'barang_id', 'harga', 'jumlah')->with('penjualan', 'barang');

        //Filter data user berdasarkan level_id
        if($request->penjualan_id){
            $detailpenjualans->where('penjualan_id', $request->penjualan_id);
        } else if ($request->barang_id) {
            $detailpenjualans->where('barang_id', $request->barang_id);
        }

        return DataTables::of($detailpenjualans)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($detailpenjualan){ //menambahkan kolom aksi
                $btn = '<button onclick="modalAction(\''.url('/detailpenjualan/'. $detailpenjualan->detail_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/detailpenjualan/' . $detailpenjualan->detail_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function show_ajax(string $id) 
    {
        $detailpenjualan = PenjualanDetailModel::find($id);

        return view('detailpenjualan.show_ajax', ['detailpenjualan' => $detailpenjualan]);
    }

    public function confirm_ajax(string $id)
    {
        $detailpenjualan = PenjualanDetailModel::find($id);

        return view('detailpenjualan.confirm_ajax', ['detailpenjualan' => $detailpenjualan]);
    }

    public function delete_ajax(Request $request, $id) 
    {
        if ($request->ajax() || $request->wantsJson()) {
            $detailpenjualan = PenjualanDetailModel::find($id);
            if ($detailpenjualan) {
                $detailpenjualan->delete();
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
        return redirect('/detailpenjualan');
    }

    public function export_excel()
    {
        // Ambil data barang yang akan diexport
        $detailpenjualan = PenjualanDetailModel::select('penjualan_id', 'barang_id', 'harga', 'jumlah')
            ->orderBy('penjualan_id')
            ->orderBy('barang_id')
            ->with('penjualan', 'barang')
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Penjualan');
        $sheet->setCellValue('C1', 'Nama Barang');
        $sheet->setCellValue('D1', 'Harga');
        $sheet->setCellValue('E1', 'Total Pembelian');

        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        $no = 1;
        $baris = 2;
        foreach ($detailpenjualan as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->penjualan->penjualan_kode);
            $sheet->setCellValue('C' . $baris, $value->barang->barang_nama);
            $sheet->setCellValue('D' . $baris, $value->harga);
            $sheet->setCellValue('E' . $baris, $value->jumlah);
            $baris++;
            $no++;
        }

        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Detail Penjualan');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Detail Penjualan'.date('Y-m-d H:i:s').'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') .' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    public function export_pdf()
    {
        $detailpenjualan = PenjualanDetailModel::select('penjualan_id', 'barang_id', 'harga', 'jumlah')
            ->orderBy('penjualan_id')
            ->orderBy('barang_id')
            ->orderBy('detail_id')
            ->with('penjualan', 'barang')
            ->get();
        
        $pdf = Pdf::loadView('detailpenjualan.export_pdf', ['detailpenjualan'=> $detailpenjualan]);
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption("isRemoteEnabled", true);
        $pdf->render();

        return $pdf->stream('Data Detail Penjualan '.date('Y-m-d H:i:s').'.pdf');
    }
}