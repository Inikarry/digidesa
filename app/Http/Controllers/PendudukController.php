<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarDesa;
use App\Models\Perkawinan;
use App\Models\Kematian;
use App\Models\Kependudukan;
use DataTables;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use PDF;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    //Buku Penduduk
    public function bukuPenduduk() {
        $data = Kependudukan::select(\DB::raw("SUM(awal_l) as awall"),
                                     \DB::raw("SUM(awal_p) as awalp"), 
                                     \DB::raw("SUM(lahir_l) as lahirl"), 
                                     \DB::raw("SUM(lahir_p) as lahirp"),
                                     \DB::raw("SUM(mati_l) as matil"),
                                     \DB::raw("SUM(mati_p) as matip"),
                                     \DB::raw("SUM(datang_p) as datangp"),
                                     \DB::raw("SUM(datang_l) as datangl"),
                                     \DB::raw("SUM(pindah_l) as pindahl"),
                                     \DB::raw("SUM(pindah_p) as pindahp"),
                                     \DB::raw("SUM(kk) as jumlah_kk"))
                    ->whereYear('kependudukan_tanggal', Carbon::now()->year)
                    ->whereMonth('kependudukan_tanggal', Carbon::now()->month)
                    ->first();
        return view('pages.penduduk.kependudukan', [
            'datas'         => $data,
        ]);
    }

    public function loadDetail(Request $request, $id){
        $current_month = Carbon::now()->month;
        if ($id+1 > $current_month){
            $year = Carbon::now()->subYears(1)->year;
        }else{
            $year = Carbon::now()->year;
        }

        if($request->ajax()){
            $data = Kependudukan::select(\DB::raw("SUM(awal_l) as awall"),
                                        \DB::raw("SUM(awal_p) as awalp"), 
                                        \DB::raw("SUM(lahir_l) as lahirl"), 
                                        \DB::raw("SUM(lahir_p) as lahirp"),
                                        \DB::raw("SUM(mati_l) as matil"),
                                        \DB::raw("SUM(mati_p) as matip"),
                                        \DB::raw("SUM(datang_p) as datangp"),
                                        \DB::raw("SUM(datang_l) as datangl"),
                                        \DB::raw("SUM(pindah_l) as pindahl"),
                                        \DB::raw("SUM(pindah_p) as pindahp"),
                                        \DB::raw("SUM(kk) as jumlah_kk"))
                            ->whereYear('kependudukan_tanggal', $year)
                            ->whereMonth('kependudukan_tanggal', $id+1)
                            ->first();
        }
        return response()->json($data);
    }

    public function savePenduduk($id){
        $data_desa = DaftarDesa::select('*')->get();
        $current_month = Carbon::now()->month;
        if ($id+1 > $current_month){
            $year = Carbon::now()->subYears(1)->year;
        }else{
            $year = Carbon::now()->year;
        }

        $months = ["JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"];
        $month = $months[$id];

        $data = DaftarDesa::leftJoin('kependudukan as pddk', function ($join) use ($id, $year) {
                                    $join->on('pddk.id_desa', '=', 'desa.id')
                                            ->whereYear('pddk.kependudukan_tanggal', $year)
                                            ->whereMonth('pddk.kependudukan_tanggal', $id+1);
                                })
                                ->select('pddk.*', 'desa.nama_desa', 'desa.id as desa_id')
                                ->get();

        $pdf = PDF::loadView('pages.pdf.penduduk',[
                                'datas'     =>$data,
                                'data_desa' =>$data_desa,
                                'month'     =>$month,
                                'year'      =>$year
                                ])->setPaper('legal', 'landscape');
        
        return $pdf->stream('Laporan Perkawinan');
    }

    public function loadPenduduk(Request $request, $id){
        $current_month = Carbon::now()->month;
        if ($id+1 > $current_month){
            $year = Carbon::now()->subYears(1)->year;
        }else{
            $year = Carbon::now()->year;
        }
        $data = DaftarDesa::leftJoin('kependudukan as pddk', function ($join) use ($id, $year) {
                                    $join->on('pddk.id_desa', '=', 'desa.id')
                                            ->whereYear('pddk.kependudukan_tanggal', $year)
                                            ->whereMonth('pddk.kependudukan_tanggal', $id+1);
                                })
                                ->select('pddk.*', 'desa.nama_desa', 'desa.id as desa_id');

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addColumn('awall', function($data){
                    if($data->awal_l !== null){
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="'.$data->awal_l.'" data-label="Penduduk Awal Bulan (Laki-laki):" data-desa="'.$data->nama_desa.'" data-field="awal_l">'.number_format($data->awal_l,0,",",".").'</a>';
                    }else{
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="0" data-label="Penduduk Awal Bulan (Laki-laki):" data-desa="'.$data->nama_desa.'" data-field="awal_l">0</a>';
                    }
                })
                ->addColumn('awalp', function($data){
                    if($data->awal_p !== null){
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="'.$data->awal_p.'" data-label="Penduduk Awal Bulan (Perempuan):" data-desa="'.$data->nama_desa.'" data-field="awal_p">'.number_format($data->awal_p,0,",",".").'</a>';
                    }else{
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="0" data-label="Penduduk Awal Bulan (Perempuan):" data-desa="'.$data->nama_desa.'" data-field="awal_p">0</a>';
                    }
                })
                ->addColumn('awallp', function($data){
                    $sum = $data->awal_l + $data->awal_p;
                    return number_format($sum,0,",",".");
                })
                ->addColumn('lahirl', function($data){
                    if($data->lahir_l !== null){
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="'.$data->lahir_l.'" data-label="Lahir Bulan Ini (Laki-laki):" data-desa="'.$data->nama_desa.'" data-field="lahir_l">'.number_format($data->lahir_l,0,",",".").'</a>';
                    }else{
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="0" data-label="Lahir Bulan Ini (Laki-laki):" data-desa="'.$data->nama_desa.'" data-field="lahir_l">0</a>';
                    }
                })
                ->addColumn('lahirp', function($data){
                    if($data->lahir_p !== null){
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="'.$data->lahir_p.'" data-label="Lahir Bulan Ini (Perempuan):" data-desa="'.$data->nama_desa.'" data-field="lahir_p">'.number_format($data->lahir_p,0,",",".").'</a>';
                    }else{
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="0" data-label="Lahir Bulan Ini (Perempuan):" data-desa="'.$data->nama_desa.'" data-field="lahir_p">0</a>';
                    }
                })
                ->addColumn('lahirlp', function($data){
                    $sum = $data->lahir_l + $data->lahir_p;
                    return number_format($sum,0,",",".");
                })
                ->addColumn('matil', function($data){
                    if($data->mati_l !== null){
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="'.$data->mati_l.'" data-label="Mati Bulan Ini (Laki-laki):" data-desa="'.$data->nama_desa.'" data-field="mati_l">'.number_format($data->mati_l,0,",",".").'</a>';
                    }else{
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="0" data-label="Mati Bulan Ini (Laki-laki):" data-desa="'.$data->nama_desa.'" data-field="mati_l">0</a>';
                    }
                })
                ->addColumn('matip', function($data){
                    if($data->mati_p !== null){
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="'.$data->mati_p.'" data-label="Mati Bulan Ini (Perempuan):" data-desa="'.$data->nama_desa.'" data-field="mati_p">'.number_format($data->mati_p,0,",",".").'</a>';
                    }else{
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="" data-label="Mati Bulan Ini (Perempuan):" data-desa="'.$data->nama_desa.'" data-field="mati_p">0</a>';
                    }
                })
                ->addColumn('matilp', function($data){
                    $sum = $data->mati_l + $data->mati_p;
                    return number_format($sum,0,",",".");
                })
                ->addColumn('datangl', function($data){
                    if($data->datang_l !== null){
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="'.$data->datang_l.'" data-label="Datang Bulan Ini (Laki-laki):" data-desa="'.$data->nama_desa.'" data-field="datang_l">'.number_format($data->datang_l,0,",",".").'</a>';
                    }else{
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="0" data-label="Datang Bulan Ini (Laki-laki):" data-desa="'.$data->nama_desa.'" data-field="datang_l">0</a>';
                    }
                })
                ->addColumn('datangp', function($data){
                    if($data->datang_p !== null){
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="'.$data->datang_p.'" data-label="Datang Bulan Ini (Perempuan):" data-desa="'.$data->nama_desa.'" data-field="datang_p">'.number_format($data->datang_p,0,",",".").'</a>';
                    }else{
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="0" data-label="Datang Bulan Ini (Perempuan):" data-desa="'.$data->nama_desa.'" data-field="datang_p">0</a>';
                    }
                })
                ->addColumn('datanglp', function($data){
                    $sum = $data->datang_l + $data->datang_p;
                    return number_format($sum,0,",",".");
                })
                ->addColumn('pindahl', function($data){
                    if($data->pindah_l !== null){
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="'.$data->pindah_l.'" data-label="Pindah Bulan Ini (Laki-Laki):" data-desa="'.$data->nama_desa.'" data-field="pindah_l">'.number_format($data->pindah_l,0,",",".").'</a>';
                    }else{
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="0" data-label="Pindah Bulan Ini (Laki-laki):" data-desa="'.$data->nama_desa.'" data-field="pindah_l">0</a>';
                    }
                })
                ->addColumn('pindahp', function($data){
                    if($data->pindah_p !== null){
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="'.$data->pindah_p.'" data-label="Pindah Bulan Ini (Perempuan):" data-desa="'.$data->nama_desa.'" data-field="pindah_p">'.number_format($data->pindah_p,0,",",".").'</a>';
                    }else{
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="0" data-label="Pindah Bulan Ini (Perempuan):" data-desa="'.$data->nama_desa.'" data-field="pindah_p">0</a>';
                    }
                })
                ->addColumn('pindahlp', function($data){
                    $sum = $data->pindah_l + $data->pindah_p;
                    return number_format($sum,0,",",".");
                })
                ->addColumn('jumlahl', function($data){
                    $sum = $data->awal_l + $data->lahir_l - $data->mati_l + $data->datang_l - $data->pindah_l;
                    return number_format($sum,0,",",".");
                })
                ->addColumn('jumlahp', function($data){
                    $sum = $data->awal_p + $data->lahir_p - $data->mati_p + $data->datang_p - $data->pindah_p;
                    return number_format($sum,0,",",".");
                })
                ->addColumn('jumlahlp', function($data){
                    $sum = $data->awal_l + $data->lahir_l - $data->mati_l + $data->datang_l - $data->pindah_l + $data->awal_p + $data->lahir_p - $data->mati_p + $data->datang_p - $data->pindah_p;
                    return number_format($sum,0,",",".");
                })
                ->addColumn('jumlah_kk', function ($data) {
                    if($data->kk !== null){
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="'.$data->kk.'" data-label="Jumlah KK:" data-desa="'.$data->nama_desa.'" data-field="kk">'.number_format($data->kk,0,",",".").'</a>';
                    }else{
                        return '<a type="button" class="edit_penduduk btn btn-light btn-xs" style="background-color: transparent;" data-id="'.$data->desa_id.'" data-value="0" data-label="Jumlah KK:" data-desa="'.$data->nama_desa.'" data-field="kk">0</a>';
                    }
                })
                ->orderColumn('awall', function ($query, $order) {
                    $query->orderBy('awal_l', $order);
                })
                ->orderColumn('awalp', function ($query, $order) {
                    $query->orderBy('awal_p', $order);
                })
                ->orderColumn('lahirp', function ($query, $order) {
                    $query->orderBy('lahir_p', $order);
                })
                ->orderColumn('lahirl', function ($query, $order) {
                    $query->orderBy('lahir_l', $order);
                })
                ->orderColumn('matil', function ($query, $order) {
                    $query->orderBy('mati_l', $order);
                })
                ->orderColumn('matip', function ($query, $order) {
                    $query->orderBy('mati_p', $order);
                })
                ->orderColumn('datangl', function ($query, $order) {
                    $query->orderBy('datang_l', $order);
                })
                ->orderColumn('datangp', function ($query, $order) {
                    $query->orderBy('datang_p', $order);
                })
                ->orderColumn('pindahl', function ($query, $order) {
                    $query->orderBy('pindah_l', $order);
                })
                ->orderColumn('pindahp', function ($query, $order) {
                    $query->orderBy('pindah_p', $order);
                })
                ->orderColumn('jumlah_kk', function ($query, $order) {
                    $query->orderBy('kk', $order);
                })
                ->rawColumns(['awall', 'awalp', 'awallp', 'lahirl', 'lahirp', 'lahirlp', 'matil', 'matip', 'matilp', 'datangl', 'datangp', 'datanglp', 'pindahl', 'pindahp', 'pindahlp', 'jumlahl', 'jumlahp', 'jumlahlp', 'jumlah_kk'])
                ->toJson();
        }
    }

    public function updatePenduduk(Request $request, $id){
        $messages = [
            'uValue.required'         => 'Nilai Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'uValue'              => 'required',
        ], $messages);

        if ($validator->fails()) {
            $d['success'] = 0;
            $d['error'] = $validator->errors()->all();
        }else{
            $current_month = Carbon::now()->month;
            if ($request->uMonth+1 > $current_month){
                $year = Carbon::now()->subYears(1)->year;
            }else{
                $year = Carbon::now()->year;
            }
            $data = Kependudukan::where('id_desa', $id)->whereYear('kependudukan_tanggal', $year)->whereMonth('kependudukan_tanggal', $request->uMonth+1)->first();
            if ($data === null) {
                Kependudukan::create([
                    'id_desa'               => $id,
                    'kependudukan_tanggal'  => Carbon::create($year, $request->uMonth+1, 1), 0,
                    $request->uField        => $request->uValue,
                ]);
            }else{
                $data->update([
                    $request->uField     => $request->uValue,
                ]);
            }
            $d['success'] = 1;
        }   
        return response()->json($d);
    }


    //Buku Perkawinan
    public function bukuPerkawinan() {
        $data_desa = DaftarDesa::select('*')->get();
        return view('pages.penduduk.perkawinan', [
            'data_desa'         => $data_desa,
        ]);
    }

    public function savePerkawinan($id){
        $data_desa = DaftarDesa::select('*')->get();
        $current_month = Carbon::now()->month;
        if ($id+1 > $current_month){
            $year = Carbon::now()->subYears(1)->year;
        }else{
            $year = Carbon::now()->year;
        }

        $months = ["JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"];
        $month = $months[$id];

        $data = Perkawinan::whereYear('perkawinan_tanggal_nikah', $year)
                            ->whereMonth('perkawinan_tanggal_nikah', $id+1)
                            ->select('*')
                            ->get();

        $pdf = PDF::loadView('pages.pdf.perkawinan',[
                                'datas'     =>$data,
                                'data_desa' =>$data_desa,
                                'month'     =>$month
                                ])->setPaper('f4', 'landscape');
        
        return $pdf->stream('Laporan Perkawinan');
    }

    public function loadPerkawinan(Request $request, $id){
        $current_month = Carbon::now()->month;
        if ($id+1 > $current_month){
            $year = Carbon::now()->subYears(1)->year;
        }else{
            $year = Carbon::now()->year;
        }

        $data = Perkawinan::join('desa as desa', 'desa.id', '=', 'perkawinan.id_desa')
                            ->whereYear('perkawinan_tanggal_nikah', $year)
                            ->whereMonth('perkawinan_tanggal_nikah', $id+1)
                            ->select('perkawinan.*', 'desa.nama_desa as nama_desa');

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Perkawinan $perkawinan){
                    $btn = '
                        <a type="button" class="edit_perkawinan btn btn-danger btn-xs" style="height: 30px; width: 30px"
                            data-id="'.$perkawinan->id.'"
                            data-id_desa="'.$perkawinan->id_desa.'"
                            data-nik="'.$perkawinan->perkawinan_nik.'"
                            data-nama="'.$perkawinan->perkawinan_nama.'"
                            data-tempat_lahir="'.$perkawinan->perkawinan_tempat_lahir.'"
                            data-tanggal_lahir="'.$perkawinan->perkawinan_tanggal_lahir.'"
                            data-tanggal_nikah="'.$perkawinan->perkawinan_tanggal_nikah.'"
                            data-buku_nikah="'.$perkawinan->perkawinan_buku_nikah.'"
                        ><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                        <a type="button" class="delete_perkawinan btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$perkawinan->id.'" data-url="/buku-perkawinan/delete/'.$perkawinan->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                    ';
                    return $btn;
                })
                ->addColumn('nama_desa', function($data){
                    return "Desa ".$data->nama_desa;
                })
                ->filterColumn('nama_desa', function ($query, $keyword) {
                    $query->whereRaw("nama_desa like ?", ["%$keyword%"]);
                })
                ->editColumn('perkawinan_buku_nikah', function (Perkawinan $perkawinan) {
                    if($perkawinan->perkawinan_buku_nikah !== null){
                        return $perkawinan->perkawinan_buku_nikah;
                    }else{
                        return "---";
                    }
                })
                ->editColumn('perkawinan_tanggal_lahir', function (Perkawinan $perkawinan) {
                    return Carbon::createFromFormat('Y-m-d', $perkawinan->perkawinan_tanggal_lahir)->format('d/m/Y');
                })
                ->editColumn('perkawinan_tanggal_nikah', function (Perkawinan $perkawinan) {
                    return Carbon::createFromFormat('Y-m-d', $perkawinan->perkawinan_tanggal_nikah)->format('d/m/Y');
                })
                ->filterColumn('perkawinan_tanggal_lahir', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(perkawinan_tanggal_lahir,'%d/%m/%Y') like ?", ["%$keyword%"]);
                })
                ->filterColumn('perkawinan_tanggal_nikah', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(perkawinan_tanggal_nikah,'%d/%m/%Y') like ?", ["%$keyword%"]);
                })
                ->rawColumns(['action', 'nama_desa'])
                ->toJson();
        }
    }

    public function addPerkawinan(Request $request){
        $messages = [
            'desa.required'         => 'Desa Tidak Boleh Kosong!',
            'tanggal_nikah.required'=> 'Tanggal Nikah Tidak Boleh Kosong!',
            'tanggal_lahir.required'=> 'Tanggal Lahir Tidak Boleh Kosong!',
            'tempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong!',
            'nik.required'          => 'NIK Tidak Boleh Kosong!',
            'nama.required'         => 'Nama Lengkap Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'desa'              => 'required',
            'tanggal_nikah'     => 'required',
            'tanggal_lahir'     => 'required',
            'tempat_lahir'      => 'required',
            'nik'               => 'required',
            'nama'              => 'required',
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {
            Perkawinan::create([
                'id_desa'           => $request->desa,
                'perkawinan_nik'    => $request->nik,
                'perkawinan_nama'   => $request->nama,
                'perkawinan_tempat_lahir'   => $request->tempat_lahir,
                'perkawinan_tanggal_lahir'  => $request->tanggal_lahir,
                'perkawinan_tanggal_nikah'  => $request->tanggal_nikah,
                'perkawinan_buku_nikah'     => $request->no_buku_nikah,
             ]);

            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function updatePerkawinan(Request $request, $id){
        $messages = [
            'uDesa.required'         => 'Desa Tidak Boleh Kosong!',
            'uTanggal_nikah.required'=> 'Tanggal Nikah Tidak Boleh Kosong!',
            'uTanggal_lahir.required'=> 'Tanggal Lahir Tidak Boleh Kosong!',
            'uTempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong!',
            'uNik.required'          => 'NIK Tidak Boleh Kosong!',
            'uNama.required'         => 'Nama Lengkap Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'uDesa'              => 'required',
            'uTanggal_nikah'     => 'required',
            'uTanggal_lahir'     => 'required',
            'uTempat_lahir'      => 'required',
            'uNik'               => 'required',
            'uNama'              => 'required',
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {
            $perkawinan = Perkawinan::find($id);
            $perkawinan->update([
                'id_desa'           => $request->uDesa,
                'perkawinan_nik'    => $request->uNik,
                'perkawinan_nama'   => $request->uNama,
                'perkawinan_tempat_lahir'   => $request->uTempat_lahir,
                'perkawinan_tanggal_lahir'  => $request->uTanggal_lahir,
                'perkawinan_tanggal_nikah'  => $request->uTanggal_nikah,
                'perkawinan_buku_nikah'     => $request->uBuku_nikah,
             ]);

            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function destroyPerkawinan($id){
        Perkawinan::find($id)->delete();
    }

    //Buku Kematian
    public function bukuKematian() {
        $data_desa = DaftarDesa::select('*')->get();
        return view('pages.penduduk.kematian', [
            'data_desa'         => $data_desa,
        ]);
    }

    public function saveKematian($id){
        $data_desa = DaftarDesa::select('*')->get();
        $current_month = Carbon::now()->month;
        if ($id+1 > $current_month){
            $year = Carbon::now()->subYears(1)->year;
        }else{
            $year = Carbon::now()->year;
        }

        $months = ["JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"];
        $month = $months[$id];

        $data = Kematian::join('desa as desa', 'desa.id', '=', 'kematian.id_desa')
                            ->whereYear('kematian_tanggal_meninggal', $year)
                            ->whereMonth('kematian_tanggal_meninggal', $id+1)
                            ->select('kematian.*', 'desa.nama_desa as nama_desa')
                            ->get();

        $pdf = PDF::loadView('pages.pdf.kematian',[
                                'datas'     =>$data,
                                'data_desa' =>$data_desa,
                                'month'     =>$month
                                ])->setPaper('f4', 'landscape');
        
        return $pdf->stream('Laporan Kematian');
    }

    public function loadKematian(Request $request, $id){
        $current_month = Carbon::now()->month;
        if ($id+1 > $current_month){
            $year = Carbon::now()->subYears(1)->year;
        }else{
            $year = Carbon::now()->year;
        }

        $data = Kematian::join('desa as desa', 'desa.id', '=', 'kematian.id_desa')
                            ->whereYear('kematian_tanggal_meninggal', $year)
                            ->whereMonth('kematian_tanggal_meninggal', $id+1)
                            ->select('kematian.*', 'desa.nama_desa as nama_desa');

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Kematian $kematian){
                    $btn = '
                        <a type="button" class="edit_kematian btn btn-danger btn-xs" style="height: 30px; width: 30px"
                            data-id="'.$kematian->id.'"
                            data-id_desa="'.$kematian->id_desa.'"
                            data-nik="'.$kematian->kematian_nik.'"
                            data-nama="'.$kematian->kematian_nama.'"
                            data-tempat_lahir="'.$kematian->kematian_tempat_lahir.'"
                            data-tanggal_lahir="'.$kematian->kematian_tanggal_lahir.'"
                            data-tanggal_meninggal="'.$kematian->kematian_tanggal_meninggal.'"
                            data-ket_kematian="'.$kematian->kematian_ket_kematian.'"
                        ><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                        <a type="button" class="delete_kematian btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$kematian->id.'" data-url="/buku-kematian/delete/'.$kematian->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                    ';
                    return $btn;
                })
                ->addColumn('nama_desa', function($data){
                    return "Desa ".$data->nama_desa;
                })
                ->filterColumn('nama_desa', function ($query, $keyword) {
                    $query->whereRaw("nama_desa like ?", ["%$keyword%"]);
                })
                ->editColumn('kematian_ket_kematian', function (Kematian $kematian) {
                    if($kematian->kematian_ket_kematian !== null){
                        return $kematian->kematian_ket_kematian;
                    }else{
                        return "---";
                    }
                })
                ->editColumn('kematian_tanggal_lahir', function (Kematian $kematian) {
                    return Carbon::createFromFormat('Y-m-d', $kematian->kematian_tanggal_lahir)->format('d/m/Y');
                })
                ->editColumn('kematian_tanggal_meninggal', function (Kematian $kematian) {
                    return Carbon::createFromFormat('Y-m-d', $kematian->kematian_tanggal_meninggal)->format('d/m/Y');
                })
                ->filterColumn('kematian_tanggal_lahir', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(kematian_tanggal_lahir,'%d/%m/%Y') like ?", ["%$keyword%"]);
                })
                ->filterColumn('kematian_tanggal_meninggal', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(kematian_tanggal_meninggal,'%d/%m/%Y') like ?", ["%$keyword%"]);
                })
                ->rawColumns(['action', 'nama_desa'])
                ->toJson();
        }
    }

    public function addKematian(Request $request){
        $messages = [
            'desa.required'         => 'Desa Tidak Boleh Kosong!',
            'tanggal_meninggal.required'    => 'Tanggal Meninggal Tidak Boleh Kosong!',
            'tanggal_lahir.required'=> 'Tanggal Lahir Tidak Boleh Kosong!',
            'tempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong!',
            'nik.required'          => 'NIK Tidak Boleh Kosong!',
            'nama.required'         => 'Nama Lengkap Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'desa'              => 'required',
            'tanggal_meninggal' => 'required',
            'tanggal_lahir'     => 'required',
            'tempat_lahir'      => 'required',
            'nik'               => 'required',
            'nama'              => 'required',
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {
            Kematian::create([
                'id_desa'           => $request->desa,
                'kematian_nik'      => $request->nik,
                'kematian_nama'     => $request->nama,
                'kematian_tempat_lahir'     => $request->tempat_lahir,
                'kematian_tanggal_lahir'    => $request->tanggal_lahir,
                'kematian_tanggal_meninggal'=> $request->tanggal_meninggal,
                'kematian_ket_kematian'     => $request->no_ket_kematian,
             ]);

            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function updateKematian(Request $request, $id){
        $messages = [
            'uDesa.required'         => 'Desa Tidak Boleh Kosong!',
            'uTanggal_meninggal.required'=> 'Tanggal Meninggal Tidak Boleh Kosong!',
            'uTanggal_lahir.required'=> 'Tanggal Lahir Tidak Boleh Kosong!',
            'uTempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong!',
            'uNik.required'          => 'NIK Tidak Boleh Kosong!',
            'uNama.required'         => 'Nama Lengkap Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'uDesa'              => 'required',
            'uTanggal_meninggal'     => 'required',
            'uTanggal_lahir'     => 'required',
            'uTempat_lahir'      => 'required',
            'uNik'               => 'required',
            'uNama'              => 'required',
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {
            $kematian = Kematian::find($id);
            $kematian->update([
                'id_desa'         => $request->uDesa,
                'kematian_nik'    => $request->uNik,
                'kematian_nama'   => $request->uNama,
                'kematian_tempat_lahir'     => $request->uTempat_lahir,
                'kematian_tanggal_lahir'    => $request->uTanggal_lahir,
                'kematian_tanggal_meninggal'=> $request->uTanggal_meninggal,
                'kematian_ket_kematian'     => $request->uKet_kematian,
             ]);

            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function destroyKematian($id){
        Kematian::find($id)->delete();
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
