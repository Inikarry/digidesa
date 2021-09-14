<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris;
use App\Models\Cuti;
use App\Models\Keputusan;
use App\Models\Masuk;
use DataTables;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UmumController extends Controller
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
    //Buku Keputusan
    public function bukuKeputusan(Request $request) {
        $data = Keputusan::select('*');
        if ($request->ajax()) {
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function(Keputusan $keputusan){
                        $btn = '
                            <a type="button" class="btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$keputusan->id.'" data-url="/buku-keputusan/edit/'.$keputusan->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                            <a type="button" class="delete_sk btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$keputusan->id.'" data-url="/buku-keputusan/delete/'.$keputusan->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                        ';
                        return $btn;
                    })
                    ->editColumn('sk_tanggal', function (Keputusan $keputusan) {
                        return Carbon::createFromFormat('Y-m-d', $keputusan->sk_tanggal)->format('d M Y');
                    })
                    ->filterColumn('sk_tanggal', function ($query, $keyword) {
                        $query->whereRaw("DATE_FORMAT(sk_tanggal,'%d %M %Y') like ?", ["%$keyword%"]);
                    })
                    ->addColumn('foto', function (Keputusan $keputusan) {
                        if ($keputusan->sk_foto == ''){
                            return "Tidak ada foto/file";
                        }else{
                            $btn = '
                            <a type="button" class="btn btn-danger btn-xs" style="height: 30px; width: 30px" href="/buku-keputusan/download/'.$keputusan->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">save_alt</i></a>
                        ';
                        return $btn;
                        }
                    })
                    ->rawColumns(['action', 'foto'])
                    ->toJson();
        }
        return view('pages.umum.keputusan');
    }

    public function downloadSK($id){
        $data = Keputusan::find($id);
        $name = $data->sk_foto;

        return response()->download(public_path("file/sk/$name"));
    }

    public function addKeputusan(Request $request){
        $messages = [
            'sk_nomor.required'            => 'Nomor Tidak Boleh Kosong!',
            'sk_tanggal.required'          => 'Tanggal Tidak Boleh Kosong',
            'sk_perihal.required'          => 'Perihal Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'sk_perihal'      => ['required'],
            'sk_tanggal'     => ['required'],
            'sk_nomor'      => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {

            if ($image = $request->file('image')) {
                $destinationPath = 'file/sk';
                $profileImage = date('YmdHis')."_".$image->getClientOriginalName();
                $image->move($destinationPath, $profileImage);
            }else{
                $profileImage = '';
            }

            $keputusan = new Keputusan;
            $keputusan->sk_nomor        = $request->sk_nomor;
            $keputusan->sk_tanggal      = $request->sk_tanggal;
            $keputusan->sk_perihal      = $request->sk_perihal;
            $keputusan->sk_foto         = $profileImage;
            $keputusan->save();

            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function destroySK($id){
        $data = Keputusan::find($id);
        $foto = $data->sk_foto;

        if($foto !== ''){
            \File::delete(public_path("file/sk/$foto"));
        }
        $data->delete();
    }

    //Buku Inventaris
    public function bukuInventaris() {
        return view('pages.umum.inventaris');
    }

    //Buku Cuti
    public function bukuCuti(Request $request) {
        $data = Cuti::select('*');
        if ($request->ajax()) {
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function(Cuti $cuti){
                        $btn = '
                            <a type="button" class="btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$cuti->id.'" data-url="/buku-cuti/edit/'.$cuti->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                            <a type="button" class="delete_cuti btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$cuti->id.'" data-url="/buku-cuti/delete/'.$cuti->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                        ';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->editColumn('cuti_tanggal', function (Cuti $cuti) {
                        return Carbon::createFromFormat('Y-m-d', $cuti->cuti_tanggal)->format('d M Y');
                    })
                    ->editColumn('cuti_mulai', function (Cuti $cuti) {
                        return Carbon::createFromFormat('Y-m-d', $cuti->cuti_mulai)->format('d M Y');
                    })
                    ->editColumn('cuti_selesai', function (Cuti $cuti) {
                        return Carbon::createFromFormat('Y-m-d', $cuti->cuti_selesai)->format('d M Y');
                    })
                    ->filterColumn('cuti_tanggal', function ($query, $keyword) {
                        $query->whereRaw("DATE_FORMAT(cuti_tanggal,'%d %M %Y') like ?", ["%$keyword%"]);
                    })
                    ->filterColumn('cuti_mulai', function ($query, $keyword) {
                        $query->whereRaw("DATE_FORMAT(cuti_mulai,'%d %M %Y') like ?", ["%$keyword%"]);
                    })
                    ->filterColumn('cuti_selesai', function ($query, $keyword) {
                        $query->whereRaw("DATE_FORMAT(cuti_selesai,'%d %M %Y') like ?", ["%$keyword%"]);
                    })
                    ->toJson();
        }

        return view('pages.umum.cuti');
    }

    public function addCuti(Request $request){
        $messages = [
            'cuti_nama.required'            => 'Nama Tidak Boleh Kosong!',
            'nip.required'                  => 'NIP Tidak Boleh Kosong',
            'cuti_tanggal.required'         => 'Tanggal Tidak Boleh Kosong!',
            'cuti_mulai.required'           => 'Tanggal Mulai Cuti Tidak Boleh Kosong!',
            'cuti_selesai.required'         => 'Tanggal Selesai Cuti Tidak Boleh Kosong!',
            'cuti_jenis.required'           => 'Jenis Cuti Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'cuti_jenis'       => ['required'],
            'cuti_selesai'    => ['required'],
            'cuti_mulai'  => ['required'],
            'cuti_tanggal'      => ['required'],
            'nip'     => ['required'],
            'cuti_nama'      => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }else {
            $cuti = new Cuti;
            $cuti->cuti_nama    = $request->cuti_nama;
            $cuti->nip          = $request->nip;
            $cuti->cuti_tanggal = $request->cuti_tanggal;
            $cuti->cuti_mulai   = $request->cuti_mulai;
            $cuti->cuti_selesai = $request->cuti_selesai;
            $cuti->cuti_jenis   = $request->cuti_jenis;
            $cuti->keterangan   = $request->keterangan;
            $cuti->save();
        }
    }

    public function destroyCuti($id){
        Cuti::find($id)->delete();
    }
    
    //Buku Masuk
    public function bukuMasuk(Request $request) {
        $data = Masuk::select('*');
        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function(Masuk $masuk){
                        $btn = '
                            <a type="button" class="btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$masuk->id.'" data-url="/buku-masuk/edit/'.$masuk->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                            <a type="button" class="delete_masuk btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$masuk->id.'" data-url="/buku-masuk/delete/'.$masuk->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                        ';
                        return $btn;
                    })
                    ->editColumn('masuk_tanggal', function (Masuk $masuk) {
                        return Carbon::createFromFormat('Y-m-d', $masuk->masuk_tanggal)->format('d M Y');
                    })
                    ->filterColumn('masuk_tanggal', function ($query, $keyword) {
                        $query->whereRaw("DATE_FORMAT(masuk_tanggal,'%d %M %Y') like ?", ["%$keyword%"]);
                    })
                    ->addColumn('foto', function (Masuk $masuk) {
                        if ($masuk->masuk_foto == ''){
                            return "Tidak ada foto/file";
                        }else{
                            $btn = '
                            <a type="button" class="btn btn-danger btn-xs" style="height: 30px; width: 30px" href="/buku-masuk/download/'.$masuk->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">save_alt</i></a>
                        ';
                        return $btn;
                        }
                    })
                    ->rawColumns(['action', 'foto'])
                    ->toJson();
        }
        return view('pages.umum.masuk');
    }

    public function downloadMasuk($id){
        $data = Masuk::find($id);
        $name = $data->masuk_foto;

        return response()->download(public_path("file/masuk/$name"));
    }

    public function addMasuk(Request $request){
        $messages = [
            'masuk_pengirim.required'            => 'Pengirim Tidak Boleh Kosong!',
            'masuk_nomor.required'            => 'Nomor Tidak Boleh Kosong!',
            'masuk_tanggal.required'          => 'Tanggal Tidak Boleh Kosong',
            'masuk_perihal.required'          => 'Perihal Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'masuk_perihal'     => ['required'],
            'masuk_nomor'       => ['required'],
            'masuk_tanggal'     => ['required'],
            'masuk_pengirim'    => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->all();
        }else {

            if ($image = $request->file('image')) {
                $destinationPath = 'file/masuk';
                $profileImage = date('YmdHis')."_".$image->getClientOriginalName();
                $image->move($destinationPath, $profileImage);
            }else{
                $profileImage = '';
            }

            $masuk = new Masuk;
            $masuk->masuk_berkas       = $request->masuk_berkas;
            $masuk->masuk_pengirim     = $request->masuk_pengirim;
            $masuk->masuk_nomor        = $request->masuk_nomor;
            $masuk->masuk_tanggal      = $request->masuk_tanggal;
            $masuk->masuk_perihal      = $request->masuk_perihal;
            $masuk->masuk_petunjuk     = $request->masuk_petunjuk;
            $masuk->masuk_paket        = $request->masuk_paket;
            $masuk->masuk_foto         = $profileImage;
            $masuk->save();

            $data['success'] = 1;
        }
        return response()->json($data);
    }

    public function destroyMasuk($id){
        $data = Masuk::find($id);
        $foto = $data->masuk_foto;

        if($foto !== ''){
            \File::delete(public_path("file/masuk/$foto"));
        }
        $data->delete();
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
