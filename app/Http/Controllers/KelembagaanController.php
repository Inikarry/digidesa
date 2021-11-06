<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Gaji;
use App\Models\DaftarPangkat;
use App\Models\Jabatan;
use App\Models\RekomendasiMasuk;
use App\Models\KenaikanPegawai;
use App\Models\KenaikanTahun;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\RekomendasiKeluar;

class KelembagaanController extends Controller
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
    //Buku Kepangkatan
    public function bukuPangkat(Request $request) {
        $data = DaftarPangkat::join('jabatan as jbt', 'jbt.id', '=', 'daftar_pangkat.jabatan_id')
                                ->select('daftar_pangkat.*', 'jbt.jabatan_nama as jabatan_nama');

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(DaftarPangkat $pangkat){
                    $diklatBulanTahun = explode('/', $pangkat->diklat_bulan_tahun);
                    if(array_key_exists(0,$diklatBulanTahun)){
                        $diklatBulan = $diklatBulanTahun[0];
                    }else{
                        $diklatBulan = 0;
                    }
                    if(array_key_exists(1,$diklatBulanTahun)){
                        $diklatTahun = $diklatBulanTahun[1];
                    }else{
                        $diklatTahun = '';
                    }
                    $btn = '
                        <a type="button" class="edit_pangkat btn btn-danger btn-xs" style="height: 30px; width: 30px"
                            data-id="'.$pangkat->id.'"
                            data-nama="'.$pangkat->pangkat_nama.'"
                            data-tempat_lahir="'.$pangkat->pangkat_tempat_lahir.'"
                            data-tanggal_lahir="'.$pangkat->pangkat_tanggal_lahir.'"
                            data-nip="'.$pangkat->pangkat_nip.'"
                            data-karpeg="'.$pangkat->pangkat_karpeg.'"
                            data-pangkat_gol="'.$pangkat->pangkat_gol.'"
                            data-pangkat_tnt="'.$pangkat->pangkat_tmt.'"
                            data-jabatan_nama="'.$pangkat->jabatan_id.'"
                            data-jabatan_tnt="'.$pangkat->jabatan_tmt.'"
                            data-jabatan_eselon="'.$pangkat->jabatan_eselon.'"
                            data-masa_kerja_tahun="'.$pangkat->masa_kerja_tahun.'"
                            data-masa_kerja_bulan="'.$pangkat->masa_kerja_bulan.'"
                            data-diklat_nama="'.$pangkat->diklat_nama.'"
                            data-diklat_bulan="'.$diklatBulan.'"
                            data-diklat_tahun="'.$diklatTahun.'"
                            data-diklat_jam="'.$pangkat->diklat_jam.'"
                            data-pendidikan_nama="'.$pangkat->pendidikan_nama.'"
                            data-pendidikan_lulus="'.$pangkat->pendidikan_tahun.'"
                            data-pendidikan_tingkat="'.$pangkat->pendidikan_tingkat.'"
                            data-usia_tahun="'.$pangkat->usia_tahun.'"
                            data-usia_bulan="'.$pangkat->usia_bulan.'"
                            data-keterangan="'.$pangkat->pangkat_keterangan.'"
                        ><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                        <a type="button" class="delete_pangkat btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$pangkat->id.'" data-url="/buku-pangkat/delete/'.$pangkat->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                    ';
                    return $btn;
                })
                ->addColumn('nama_ttl', function(DaftarPangkat $pangkat){
                    return $pangkat->pangkat_nama.'<br>'.$pangkat->pangkat_tempat_lahir.','.Carbon::createFromFormat('Y-m-d', $pangkat->pangkat_tanggal_lahir)->format('d/m/Y');
                })
                ->addColumn('nip_karpeg', function(DaftarPangkat $pangkat){
                    return $pangkat->pangkat_nip.'<br>'.$pangkat->pangkat_karpeg;
                })
                ->addColumn('thn_bln', function(DaftarPangkat $pangkat){
                    return $pangkat->masa_kerja_tahun.'/'.$pangkat->masa_kerja_bulan;
                })
                ->addColumn('nama_jabatan', function($data){
                    return $data->jabatan_nama;
                })
                ->filterColumn('nama_jabatan', function ($query, $keyword) {
                    $query->whereRaw("jabatan_nama like ?", ["%$keyword%"]);
                })
                ->editColumn('pangkat_tmt', function (DaftarPangkat $pangkat) {
                    return Carbon::createFromFormat('Y-m-d', $pangkat->pangkat_tmt)->format('d/m/Y');
                })
                ->editColumn('jabatan_tmt', function (DaftarPangkat $pangkat) {
                    return Carbon::createFromFormat('Y-m-d', $pangkat->jabatan_tmt)->format('d/m/Y');
                })
                ->filterColumn('pangkat_tmt', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(pangkat_tmt,'%d/%m/%Y') like ?", ["%$keyword%"]);
                })
                ->filterColumn('jabatan_tmt', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(jabatan_tmt,'%d/%m/%Y') like ?", ["%$keyword%"]);
                })
                ->filterColumn('thn_bln', function ($query, $keyword) {
                    $query->whereRaw("concat(masa_kerja_tahun,'/',masa_kerja_bulan) like ?", ["%$keyword%"]);
                })
                ->filterColumn('nama_ttl', function ($query, $keyword) {
                    $query->whereRaw("pangkat_nama like ?", ["%$keyword%"])
                          ->orWhereRaw("pangkat_tempat_lahir like ?", ["%$keyword%"])
                          ->orWhereRaw("DATE_FORMAT(pangkat_tanggal_lahir,'%d/%m/%Y') like ?", ["%$keyword%"]);
                })
                ->filterColumn('nip_karpeg', function ($query, $keyword) {
                    $query->whereRaw("pangkat_nip like ?", ["%$keyword%"])
                          ->orWhereRaw("pangkat_karpeg like ?", ["%$keyword%"]);
                })
                ->orderColumn('nama_ttl', function ($query, $order) {
                    $query->orderBy('pangkat_nama', $order);
                })
                ->orderColumn('nip_karpeg', function ($query, $order) {
                    $query->orderBy('pangkat_karpeg', $order);
                })
                ->orderColumn('nama_jabatan', function ($query, $order) {
                    $query->orderBy('jabatan_id', $order);
                })
                ->orderColumn('thn_bln', function ($query, $order) {
                    $query->orderBy('masa_kerja_tahun', $order);
                })
                ->rawColumns(['action', 'nama_ttl', 'nip_karpeg', 'thn_bln', 'nama_jabatan'])
                ->toJson();
        }
        $data_jabatan = Jabatan::select('*')->get();
        return view('pages.kelembagaan.kepangkatan', [
            'data_jabatan'      => $data_jabatan,
        ]);
    }

    public function addPangkat(Request $request){
        $messages = [
            'usia_bulan.required'    => 'Usia Per Bulan Des(Bulan) Tidak Boleh Kosong!',
            'usia_tahun.required'    => 'Usia Per Bulan Des(Tahun) Tidak Boleh Kosong!',
            'pendidikan_ijazah.required'    => 'Tingkat Ijazah Pendidikan Tidak Boleh Kosong!',
            'pendidikan_lulus.required'     => 'Tahun Lulus Pendidikan Tidak Boleh Kosong!',
            'pendidikan_nama.required'      => 'Nama Jurusan Pendidikan Tidak Boleh Kosong!',
            'diklat_jabatan_jam.required'   => 'Jumlah Jam Diklat jabatan Tidak Boleh Kosong!',
            'diklat_jabatan_tahun.required' => 'Tahun Diklat Jabatan Tidak Boleh Kosong!',
            'diklat_jabatan_bulan.required' => 'Bulan Diklat Jabatan Tidak Boleh Kosong!',
            'diklat_jabatan_nama.required'  => 'Nama Diklat Jabatan Tidak Boleh Kosong!',
            'masa_kerja_bulan.required' => 'Masa Kerja(Bulan) Tidak Boleh Kosong!',
            'masa_kerja_tahun.required' => 'Masa Kerja(Tahun) Tidak Boleh Kosong!',
            'jabatan_eselon.required'   => 'Eselon Jabatan Tidak Boleh Kosong!',
            'jabatan_tnt.required'      => 'TNT Jabatan Tidak Boleh Kosong!',
            'jabatan_nama.unique'       => 'Jabatan Telah Ada!',
            'jabatan_nama.required'     => 'Nama Jabatan Tidak Boleh Kosong!',
            'pangkat_tnt.required'      => 'TNT Pangkat Tidak Boleh Kosong!',
            'pangkat_gol.required'      => 'Golongan Pangkat Tidak Boleh Kosong!',
            'karpeg.required'    => 'KARPEG Tidak Boleh Kosong!',
            'nip.required'       => 'NIP Tidak Boleh Kosong!',
            'tanggal_lahir.required'    => 'Tanggal Lahir Tidak Boleh Kosong!',
            'tempat_lahir.required'     => 'Tempat Lahir Tidak Boleh Kosong!',
            'nama.required'             => 'Nama Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'usia_bulan'       => 'required',
            'usia_tahun'       => 'required',
            'pendidikan_ijazah'     => 'required',
            'pendidikan_lulus'      => 'required',
            'pendidikan_nama'       => 'required',
            'diklat_jabatan_jam'    => 'required',
            'diklat_jabatan_tahun'  => 'required',
            'diklat_jabatan_bulan'  => 'required',
            'diklat_jabatan_nama'   => 'required',
            'masa_kerja_bulan'  => 'required',
            'masa_kerja_tahun'  => 'required',
            'jabatan_eselon'    => 'required',
            'jabatan_tnt'       => 'required',
            'jabatan_nama'      => 'required|unique:daftar_pangkat,jabatan_id',
            'pangkat_tnt'       => 'required',
            'pangkat_gol'       => 'required',
            'karpeg'            => 'required',
            'nip'               => 'required',
            'tanggal_lahir'     => 'required',
            'tempat_lahir'      => 'required',
            'nama'              => 'required',
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {
            DaftarPangkat::create([
                'pangkat_nama'              => $request->nama,
                'pangkat_tempat_lahir'      => $request->tempat_lahir,
                'pangkat_tanggal_lahir'     => $request->tanggal_lahir,
                'pangkat_nip'               => $request->nip,
                'pangkat_karpeg'            => $request->karpeg,
                'pangkat_gol'               => $request->pangkat_gol,
                'pangkat_tmt'               => $request->pangkat_tnt,
                'jabatan_id'                => $request->jabatan_nama,
                'jabatan_tmt'               => $request->jabatan_tnt,
                'jabatan_eselon'            => $request->jabatan_eselon,
                'masa_kerja_tahun'          => $request->masa_kerja_tahun,
                'masa_kerja_bulan'          => $request->masa_kerja_bulan,
                'diklat_nama'               => $request->diklat_jabatan_nama,
                'diklat_bulan_tahun'        => $request->diklat_jabatan_bulan."/".$request->diklat_jabatan_tahun,
                'diklat_jam'                => $request->diklat_jabatan_jam,
                'pendidikan_nama'           => $request->pendidikan_nama,
                'pendidikan_tahun'          => $request->pendidikan_lulus,
                'pendidikan_tingkat'        => $request->pendidikan_ijazah,
                'usia_tahun'                => $request->usia_tahun,
                'usia_bulan'                => $request->usia_bulan,
                'pangkat_keterangan'        => $request->keterangan,
             ]);

            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function updatePangkat(Request $request, $id){
        $messages = [
            'Uusia_bulan.required'    => 'Usia Per Bulan Des(Bulan) Tidak Boleh Kosong!',
            'Uusia_tahun.required'    => 'Usia Per Bulan Des(Tahun) Tidak Boleh Kosong!',
            'Upendidikan_ijazah.required'    => 'Tingkat Ijazah Pendidikan Tidak Boleh Kosong!',
            'Upendidikan_lulus.required'     => 'Tahun Lulus Pendidikan Tidak Boleh Kosong!',
            'Upendidikan_nama.required'      => 'Nama Jurusan Pendidikan Tidak Boleh Kosong!',
            'Udiklat_jabatan_jam.required'   => 'Jumlah Jam Diklat jabatan Tidak Boleh Kosong!',
            'Udiklat_jabatan_tahun.required' => 'Tahun Diklat Jabatan Tidak Boleh Kosong!',
            'Udiklat_jabatan_bulan.required' => 'Bulan Diklat Jabatan Tidak Boleh Kosong!',
            'Udiklat_jabatan_nama.required'  => 'Nama Diklat Jabatan Tidak Boleh Kosong!',
            'Umasa_kerja_bulan.required' => 'Masa Kerja(Bulan) Tidak Boleh Kosong!',
            'Umasa_kerja_tahun.required' => 'Masa Kerja(Tahun) Tidak Boleh Kosong!',
            'Ujabatan_eselon.required'   => 'Eselon Jabatan Tidak Boleh Kosong!',
            'Ujabatan_tnt.required'      => 'TNT Jabatan Tidak Boleh Kosong!',
            'Ujabatan_nama.unique'       => 'Jabatan Telah Ada!',
            'Ujabatan_nama.required'     => 'Nama Jabatan Tidak Boleh Kosong!',
            'Upangkat_tnt.required'      => 'TNT Pangkat Tidak Boleh Kosong!',
            'Upangkat_gol.required'      => 'Golongan Pangkat Tidak Boleh Kosong!',
            'Ukarpeg.required'    => 'KARPEG Tidak Boleh Kosong!',
            'Unip.required'       => 'NIP Tidak Boleh Kosong!',
            'Utanggal_lahir.required'    => 'Tanggal Lahir Tidak Boleh Kosong!',
            'Utempat_lahir.required'     => 'Tempat Lahir Tidak Boleh Kosong!',
            'Unama.required'             => 'Nama Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'Uusia_bulan'       => 'required',
            'Uusia_tahun'       => 'required',
            'Upendidikan_ijazah'     => 'required',
            'Upendidikan_lulus'      => 'required',
            'Upendidikan_nama'       => 'required',
            'Udiklat_jabatan_jam'    => 'required',
            'Udiklat_jabatan_tahun'  => 'required',
            'Udiklat_jabatan_bulan'  => 'required',
            'Udiklat_jabatan_nama'   => 'required',
            'Umasa_kerja_bulan'  => 'required',
            'Umasa_kerja_tahun'  => 'required',
            'Ujabatan_eselon'    => 'required',
            'Ujabatan_tnt'       => 'required',
            'Ujabatan_nama'      => 'required|unique:daftar_pangkat,jabatan_id,'.$id,
            'Upangkat_tnt'       => 'required',
            'Upangkat_gol'       => 'required',
            'Ukarpeg'            => 'required',
            'Unip'               => 'required',
            'Utanggal_lahir'     => 'required',
            'Utempat_lahir'      => 'required',
            'Unama'              => 'required',
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {
            $pangkat = DaftarPangkat::find($id);
            $pangkat->update([
                'pangkat_nama'              => $request->Unama,
                'pangkat_tempat_lahir'      => $request->Utempat_lahir,
                'pangkat_tanggal_lahir'     => $request->Utanggal_lahir,
                'pangkat_nip'               => $request->Unip,
                'pangkat_karpeg'            => $request->Ukarpeg,
                'pangkat_gol'               => $request->Upangkat_gol,
                'pangkat_tmt'               => $request->Upangkat_tnt,
                'jabatan_id'                => $request->Ujabatan_nama,
                'jabatan_tmt'               => $request->Ujabatan_tnt,
                'jabatan_eselon'            => $request->Ujabatan_eselon,
                'masa_kerja_tahun'          => $request->Umasa_kerja_tahun,
                'masa_kerja_bulan'          => $request->Umasa_kerja_bulan,
                'diklat_nama'               => $request->Udiklat_jabatan_nama,
                'diklat_bulan_tahun'        => $request->Udiklat_jabatan_bulan."/".$request->Udiklat_jabatan_tahun,
                'diklat_jam'                => $request->Udiklat_jabatan_jam,
                'pendidikan_nama'           => $request->Upendidikan_nama,
                'pendidikan_tahun'          => $request->Upendidikan_lulus,
                'pendidikan_tingkat'        => $request->Upendidikan_ijazah,
                'usia_tahun'                => $request->Uusia_tahun,
                'usia_bulan'                => $request->Uusia_bulan,
                'pangkat_keterangan'        => $request->Uketerangan,
            ]);
            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function destroyPangkat($id){
        $data = DaftarPangkat::find($id);
        $data->delete();
    }

    //Buku Kenaikan Gaji Berkala
    public function bukuGaji(Request $request) {
        $data = Gaji::select('*');
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Gaji $gaji){
                    $btn = '
                        <a type="button" class="edit_gaji btn btn-danger btn-xs" style="height: 30px; width: 30px"
                            data-id="'.$gaji->id.'"
                            data-nomor="'.$gaji->gaji_nomor.'"
                            data-tujuan="'.$gaji->gaji_tujuan.'"
                            data-tanggal="'.$gaji->gaji_tanggal.'"
                            data-nama="'.$gaji->gaji_nama.'"
                            data-foto="'.$gaji->gaji_foto.'"
                        ><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                        <a type="button" class="delete_gaji btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$gaji->id.'" data-url="/buku-gaji/delete/'.$gaji->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                    ';
                    return $btn;
                })
                ->editColumn('gaji_tanggal', function (Gaji $gaji) {
                    return Carbon::createFromFormat('Y-m-d', $gaji->gaji_tanggal)->format('d M Y');
                })
                ->editColumn('gaji_nomor', function (Gaji $gaji) {
                    if($gaji->gaji_nomor == ''){
                        return "---";
                    }else{
                        return $gaji->gaji_nomor;
                    }
                })
                ->filterColumn('gaji_tanggal', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(gaji_tanggal,'%d %M %Y') like ?", ["%$keyword%"]);
                })
                ->addColumn('foto', function (Gaji $gaji) {
                    if ($gaji->gaji_foto == ''){
                        return "Tidak ada foto/file";
                    }else{
                        $btn = '
                        <a type="button" class="btn btn-danger btn-xs" style="height: 30px; width: 30px" href="/buku-gaji/download/'.$gaji->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">save_alt</i></a>
                    ';
                    return $btn;
                    }
                })
                ->rawColumns(['action', 'foto'])
                ->toJson();
        }

        return view('pages.kelembagaan.gaji');
    }
    
    public function addGaji(Request $request){
        $messages = [
            'gaji_tujuan.required'            => 'Alamat Tujuan Tidak Boleh Kosong!',
            'gaji_tanggal.required'          => 'Tanggal Tidak Boleh Kosong',
            'gaji_nama.required'          => 'Nama Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'gaji_nama'        => ['required'],
            'gaji_tanggal'     => ['required'],
            'gaji_tujuan'      => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {
            if ($image = $request->file('image')) {
                $destinationPath = 'file/kenaikanGaji';
                $profileImage = date('YmdHis')."_".$image->getClientOriginalName();
                $image->move($destinationPath, $profileImage);
            }else{
                $profileImage = '';
            }

            $gaji = new Gaji;
            $gaji->gaji_nomor           = $request->gaji_nomor;
            $gaji->gaji_tujuan          = $request->gaji_tujuan;
            $gaji->gaji_tanggal         = $request->gaji_tanggal;
            $gaji->gaji_nama            = $request->gaji_nama;
            $gaji->gaji_foto            = $profileImage;
            $gaji->save();

            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function updateGaji(Request $request, $id){
        $messages = [
            'uTujuan.required'            => 'Alamat Tujuan Tidak Boleh Kosong!',
            'uTanggal.required'           => 'Tanggal Tidak Boleh Kosong',
            'uNama.required'              => 'Nama Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'uNama'        => ['required'],
            'uTanggal'     => ['required'],
            'uTujuan'      => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {
            $gaji = Gaji::find($id);
            if($gaji->gaji_foto == ''){
                if ($image = $request->file('uImage')) {
                    $destinationPath = 'file/kenaikanGaji';
                    $profileImage = date('YmdHis')."_".$image->getClientOriginalName();
                    $image->move($destinationPath, $profileImage);
                }else{
                    $profileImage = '';
                }
                $gaji->update([
                    'gaji_nomor'                => $request->uNomor,
                    'gaji_tanggal'              => $request->uTanggal,
                    'gaji_tujuan'               => $request->uTujuan,
                    'gaji_nama'                 => $request->uNama,
                    'gaji_foto'                 => $profileImage,
                ]);
            }else{
                if($request->deleteImage == "true"){
                    \File::delete(public_path("file/kenaikanGaji/$gaji->gaji_foto"));

                    if ($image = $request->file('uImage')) {
                        $destinationPath = 'file/kenaikanGaji';
                        $profileImage = date('YmdHis')."_".$image->getClientOriginalName();
                        $image->move($destinationPath, $profileImage);
                    }else{
                        $profileImage = '';
                    }
                    $gaji->update([
                        'gaji_nomor'                => $request->uNomor,
                        'gaji_tanggal'              => $request->uTanggal,
                        'gaji_tujuan'               => $request->uTujuan,
                        'gaji_nama'                 => $request->uNama,
                        'gaji_foto'                 => $profileImage,
                        ]);
                }else{
                    $gaji->update([
                        'gaji_nomor'                => $request->uNomor,
                        'gaji_tanggal'              => $request->uTanggal,
                        'gaji_tujuan'               => $request->uTujuan,
                        'gaji_nama'                 => $request->uNama,
                ]);
                }
            }
            
            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function destroyGaji($id){
        $data = Gaji::find($id);
        $foto = $data->gaji_foto;

        if($foto !== ''){
            \File::delete(public_path("file/kenaikanGaji/$foto"));
        }
        $data->delete();
    }

    public function downloadGaji($id){
        $data = Gaji::find($id);
        $name = $data->gaji_foto;

        return response()->download(public_path("file/kenaikanGaji/$name"));
    }

    //Buku Kenaikan Pegawai
    public function bukuKP(Request $request){
        return view('pages.kelembagaan.kenaikanPegawai');
    }

    public function loadKP(Request $request, $id){
        $data = KenaikanPegawai::leftJoin('kenaikan_tahun as kt', function ($join) use ($id) {
                                    $join->on('kt.kt_id_pegawai', '=', 'kenaikan_pegawai.id')
                                         ->where('kt.kt_tahun', $id);
                                })
                                ->select('kenaikan_pegawai.*', 'kt.kt_reg', 'kt.kt_pil', 'kt.kt_ijazah', 'kt.kt_apr', 'kt.kt_oct', 'kt.id as kt_id');

        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function(KenaikanPegawai $kenaikanPegawai){
                        $btn = '
                            <a type="button" class="edit_kp btn btn-danger btn-xs" style="height: 30px; width: 30px"
                                data-id="'.$kenaikanPegawai->id.'"
                                data-nama="'.$kenaikanPegawai->kp_nama.'"
                                data-nip="'.$kenaikanPegawai->kp_nip.'"
                                data-dari="'.$kenaikanPegawai->kp_dari.'"
                                data-dari_tmt="'.$kenaikanPegawai->kp_dari_tanggal.'"
                                data-ke="'.$kenaikanPegawai->kp_ke.'"
                                data-ke_tmt="'.$kenaikanPegawai->kp_ke_tanggal.'"
                                data-jabatan="'.$kenaikanPegawai->kp_jabatan.'"
                                data-jabatan_tmt="'.$kenaikanPegawai->kp_jabatan_tanggal.'"
                                data-pendidikan="'.$kenaikanPegawai->kp_pendidikan.'"
                            ><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                            <a type="button" class="delete_kp btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$kenaikanPegawai->id.'" data-url="/buku-kenaikan-pegawai/delete/'.$kenaikanPegawai->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                        ';
                        return $btn;
                    })
                    ->addColumn('nama_nip', function(KenaikanPegawai $kenaikanPegawai){
                        return $kenaikanPegawai->kp_nama.'<br>NIP.'.$kenaikanPegawai->kp_nip;
                    })
                    ->addColumn('dari', function(KenaikanPegawai $kenaikanPegawai){
                        if($kenaikanPegawai->kp_dari_tanggal !== null){
                            return $kenaikanPegawai->kp_dari.'<br>'.Carbon::createFromFormat('Y-m-d', $kenaikanPegawai->kp_dari_tanggal)->format('d/m/Y');
                        }else{
                            return $kenaikanPegawai->kp_dari;
                        }
                    })
                    ->addColumn('ke', function(KenaikanPegawai $kenaikanPegawai){
                        if($kenaikanPegawai->kp_ke_tanggal !== null){
                            return $kenaikanPegawai->kp_ke.'<br>'.Carbon::createFromFormat('Y-m-d', $kenaikanPegawai->kp_ke_tanggal)->format('d/m/Y');
                        }else{
                            return $kenaikanPegawai->kp_ke;
                        }
                    })
                    ->addColumn('jabatan', function(KenaikanPegawai $kenaikanPegawai){
                        if($kenaikanPegawai->kp_jabatan_tanggal !== null){
                            return $kenaikanPegawai->kp_jabatan.'<br>'.Carbon::createFromFormat('Y-m-d', $kenaikanPegawai->kp_jabatan_tanggal)->format('d/m/Y');
                        }else{
                            return $kenaikanPegawai->kp_jabatan;
                        }
                    })
                    ->filterColumn('nama_nip', function ($query, $keyword) {
                        $query->whereRaw("kp_nama like ?", ["%$keyword%"])
                              ->orWhereRaw("kp_nip like ?", ["%$keyword%"]);
                    })
                    ->filterColumn('dari', function ($query, $keyword) {
                        $query->whereRaw("kp_dari like ?", ["%$keyword%"])
                              ->orWhereRaw("DATE_FORMAT(kp_dari_tanggal,'%d/%m/%Y') like ?", ["%$keyword%"]);
                    })
                    ->filterColumn('ke', function ($query, $keyword) {
                        $query->whereRaw("kp_ke like ?", ["%$keyword%"])
                              ->orWhereRaw("DATE_FORMAT(kp_ke_tanggal,'%d/%m/%Y') like ?", ["%$keyword%"]);
                    })
                    ->filterColumn('jabatan', function ($query, $keyword) {
                        $query->whereRaw("kp_jabatan like ?", ["%$keyword%"])
                              ->orWhereRaw("DATE_FORMAT(kp_jabatan_tanggal,'%d/%m/%Y') like ?", ["%$keyword%"]);
                    })
                    ->orderColumn('nama_nip', function ($query, $order) {
                        $query->orderBy('kp_nama', $order);
                    })
                    ->orderColumn('dari', function ($query, $order) {
                        $query->orderBy('kp_dari', $order);
                    })
                    ->orderColumn('ke', function ($query, $order) {
                        $query->orderBy('kp_ke', $order);
                    })
                    ->orderColumn('jabatan', function ($query, $order) {
                        $query->orderBy('kp_jabatan', $order);
                    })
                    ->addColumn('reg', function($data){
                        if($data->kt_reg == 1){
                            return '<a type="button" class="kt_remove btn btn-light btn-xs" data-url="/buku-kenaikan-pegawai/kt-remove/'.$data->id.'" data-field="kt_reg" style="height: 30px; width: 30px"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">check</i></a>';
                        }else{
                            return '<a type="button" class="kt_add btn btn-light btn-xs" data-url="/buku-kenaikan-pegawai/kt-add/'.$data->id.'" data-field="kt_reg" style="height: 30px; width: 30px"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">remove</i></a>';
                        }
                    })
                    ->addColumn('pil', function($data){
                        if($data->kt_pil == 1){
                            return '<a type="button" class="kt_remove btn btn-light btn-xs" data-url="/buku-kenaikan-pegawai/kt-remove/'.$data->id.'" data-field="kt_pil" style="height: 30px; width: 30px"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">check</i></a>';
                        }else{
                            return '<a type="button" class="kt_add btn btn-light btn-xs" data-url="/buku-kenaikan-pegawai/kt-add/'.$data->id.'" data-field="kt_pil" style="height: 30px; width: 30px"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">remove</i></a>';
                        }
                    })
                    ->addColumn('ijazah', function($data){
                        if($data->kt_ijazah == 1){
                            return '<a type="button" class="kt_remove btn btn-light btn-xs" data-url="/buku-kenaikan-pegawai/kt-remove/'.$data->id.'" data-field="kt_ijazah" style="height: 30px; width: 30px"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">check</i></a>';
                        }else{
                            return '<a type="button" class="kt_add btn btn-light btn-xs" data-url="/buku-kenaikan-pegawai/kt-add/'.$data->id.'" data-field="kt_ijazah" style="height: 30px; width: 30px"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">remove</i></a>';
                        }
                    })
                    ->addColumn('apr', function($data){
                        if($data->kt_apr == 1){
                            return '<a type="button" class="kt_remove btn btn-light btn-xs" data-url="/buku-kenaikan-pegawai/kt-remove/'.$data->id.'" data-field="kt_apr" style="height: 30px; width: 30px"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">check</i></a>';
                        }else{
                            return '<a type="button" class="kt_add btn btn-light btn-xs" data-url="/buku-kenaikan-pegawai/kt-add/'.$data->id.'" data-field="kt_apr" style="height: 30px; width: 30px"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">remove</i></a>';
                        }
                    })
                    ->addColumn('okt', function($data){
                        if($data->kt_oct == 1){
                            return '<a type="button" class="kt_remove btn btn-light btn-xs" data-url="/buku-kenaikan-pegawai/kt-remove/'.$data->id.'" data-field="kt_oct" style="height: 30px; width: 30px"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">check</i></a>';
                        }else{
                            return '<a type="button" class="kt_add btn btn-light btn-xs" data-url="/buku-kenaikan-pegawai/kt-add/'.$data->id.'" data-field="kt_oct" style="height: 30px; width: 30px"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">remove</i></a>';
                        }
                    })
                    ->rawColumns(['action', 'nama_nip', 'dari', 'ke', 'jabatan', 'reg', 'pil', 'ijazah', 'apr', 'okt'])
                    ->toJson();
        }
    }

    public function addKP(Request $request){
        $messages = [
            'pendidikan.required'   => 'Pendidikan Tidak Boleh Kosong!',
            'jabatan.required'      => 'Jabatan Tidak Boleh Kosong!',
            'ke.required'           => 'Ke Pangkat Tidak Boleh Kosong!',
            'dari.required'         => 'Dari Pangkat Tidak Boleh Kosong!',
            'nip.required'          => 'NIP Pegawai Tidak Boleh Kosong!',
            'nama.required'         => 'Nama Pegawai Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'pendidikan'        => 'required',
            'jabatan'           => 'required',
            'ke'                => 'required',
            'dari'              => 'required',
            'nip'               => 'required',
            'nama'              => 'required',
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {
            KenaikanPegawai::create([
                'kp_nama'           => $request->nama,
                'kp_nip'            => $request->nip,
                'kp_dari'           => $request->dari,
                'kp_dari_tanggal'   => $request->dari_tmt,
                'kp_ke'             => $request->ke,
                'kp_ke_tanggal'     => $request->ke_tmt,
                'kp_jabatan'        => $request->jabatan,
                'kp_jabatan_tanggal'=> $request->jabatan_tmt,
                'kp_pendidikan'     => $request->pendidikan,
                'kp_tanggal'        => Carbon::now(),
             ]);

            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function updateKP(Request $request, $id){
        $messages = [
            'uPendidikan.required'   => 'Pendidikan Tidak Boleh Kosong!',
            'uJabatan.required'      => 'Jabatan Tidak Boleh Kosong!',
            'uKe.required'           => 'Ke Pangkat Tidak Boleh Kosong!',
            'uDari.required'         => 'Dari Pangkat Tidak Boleh Kosong!',
            'uNip.required'          => 'NIP Pegawai Tidak Boleh Kosong!',
            'uNama.required'         => 'Nama Pegawai Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'uPendidikan'        => 'required',
            'uJabatan'           => 'required',
            'uKe'                => 'required',
            'uDari'              => 'required',
            'uNip'               => 'required',
            'uNama'              => 'required',
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {
            $kp = KenaikanPegawai::find($id);
            $kp->update([
                'kp_nama'           => $request->uNama,
                'kp_nip'            => $request->uNip,
                'kp_dari'           => $request->uDari,
                'kp_dari_tanggal'   => $request->uDari_tmt,
                'kp_ke'             => $request->uKe,
                'kp_ke_tanggal'     => $request->uKe_tmt,
                'kp_jabatan'        => $request->uJabatan,
                'kp_jabatan_tanggal'=> $request->uJabatan_tmt,
                'kp_pendidikan'     => $request->uPendidikan,
            ]);
            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function addKT(Request $request, $id){
        $data = KenaikanTahun::where('kt_id_pegawai', $id)->where('kt_tahun', $request->year)->first();
        if ($data === null) {
            KenaikanTahun::create([
                'kt_id_pegawai'     => $id,
                'kt_tahun'          => $request->year,
                $request->field     => 1,
             ]);
        }else{
            $data->update([
                $request->field     => 1,
            ]);
        }
        $d['success'] = 1;
        return response()->json($d);
    }

    public function removeKT(Request $request, $id){
        $data = KenaikanTahun::where('kt_id_pegawai', $id)->where('kt_tahun', $request->year);
        $data->update([
            $request->field     => 0,
        ]);
        $d['success'] = 1;
        return response()->json($d);
    }

    public function destroyKP($id){
        KenaikanTahun::where('kt_id_pegawai',$id)->delete();
        KenaikanPegawai::find($id)->delete();
    }

    //Buku Rekomendasi Kenaikan Pangkat
    public function bukuRekomendasimasuk(Request $request) {
        $data = RekomendasiMasuk::select('*');
        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function(RekomendasiMasuk $rekomendasimasuk){
                        $btn = '
                            <a type="button" class="btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$rekomendasimasuk->id.'" data-url="/buku-cuti/edit/'.$rekomendasimasuk->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                            <a type="button" class="delete_rm btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$rekomendasimasuk->id.'" data-url="/buku-rekomendasimasuk/delete/'.$rekomendasimasuk->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                        ';
                        return $btn;
                    })
                     ->editColumn('rm_status', function (RekomendasiMasuk $rekomendasimasuk) {
                        if ($rekomendasimasuk->rm_status == '') {
                           return "belum di proses";
                        }else{
                            return "telah di proses";
                        }
                        return Carbon::createFromFormat('Y-m-d', $keputusan->sk_tanggal)->format('d M Y');
                    })
                    ->addColumn('foto', function (RekomendasiMasuk $rekomendasimasuk) {
                        if ($rekomendasimasuk->rm_foto == ''){
                            return "Tidak ada foto/file";
                        }else{
                            $btn = '
                            <a type="button" class="btn btn-danger btn-xs" style="height: 30px; width: 30px" href="/buku-rekomendasimasuk/download/'.$rekomendasimasuk->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">save_alt</i></a>
                        ';
                        return $btn;
                        }
                    })

                    ->rawColumns(['action','foto'])
                    ->toJson();
            }
        return view('pages.kelembagaan.rekomendasimasuk');
    }

    public function downloadRM($id){
        $data = RekomendasiMasuk::find($id);
        $name = $data->rm_foto;

        return response()->download(public_path("file/rm/$name"));
    }

    public function addRM (Request $request) {
        $messages = [
            'rm_nomor.required'            => 'Nomor Tidak Boleh Kosong!',
            'rm_tanggal.required'          => 'Tanggal Tidak Boleh Kosong',
            'rm_AlamatPengirim.required'          => 'Alamat Pengirim Tidak Boleh Kosong!',
            'rm_perihal.required'          => 'Perihal Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'rm_perihal'      => ['required'],
            'rm_AlamatPengirim'     => ['required'],
            'rm_tanggal'     => ['required'],
            'rm_nomor'      => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {

            if ($image = $request->file('image')) {
                $destinationPath = 'file/rm';
                $profileImage = date('YmdHis')."_".$image->getClientOriginalName();
                $image->move($destinationPath, $profileImage);
            }else{
                $profileImage = '';
            }

            $rekomendasimasuk = new RekomendasiMasuk;
            $rekomendasimasuk->rm_nomor        = $request->rm_nomor;
            $rekomendasimasuk->rm_tanggal      = $request->rm_tanggal;
            $rekomendasimasuk->rm_perihal      = $request->rm_perihal;
            $rekomendasimasuk->rm_pengirim      = $request->rm_AlamatPengirim;
            $rekomendasimasuk->rm_foto         = $profileImage;
            $rekomendasimasuk->save();

            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function destroyRM($id){
        $data = RekomendasiMasuk::find($id);
        $foto = $data->rm_foto;

        if($foto !== ''){
            \File::delete(public_path("file/rm/$foto"));
        }
        $data->delete();
    }


    public function bukuRekomendasikeluar(Request $request) {
         $data = RekomendasiKeluar::select('*');
        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function(RekomendasiKeluar $rekomendasikeluar){
                        $btn = '
                            <a type="button" class="btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$rekomendasikeluar->id.'" data-url="/buku-cuti/edit/'.$rekomendasikeluar->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                            <a type="button" class="delete_cuti btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$rekomendasikeluar->id.'" data-url="/buku-cuti/delete/'.$rekomendasikeluar->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                        ';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->toJson();
            }
        return view('pages.kelembagaan.rekomendasikeluar');
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
