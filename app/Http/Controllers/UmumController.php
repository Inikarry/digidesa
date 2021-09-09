<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris;
use App\Models\Cuti;
use App\Models\Keputusan;
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
    
    public function peraturanDesa() {
        return view('pages.umum_peraturan_desa');
    }

    public function bukuKeputusan(Request $request) {
        $data = Keputusan::select('*');
        if ($request->ajax()) {
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function(Keputusan $keputusan){
                        $btn = '
                            <a type="button" class="btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$keputusan->id.'" data-url="/buku-keputusan/edit/'.$keputusan->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                            <a type="button" class="delete_cuti btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$keputusan->id.'" data-url="/buku-keputusan/delete/'.$keputusan->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                        ';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->editColumn('sk_tanggal', function (Keputusan $keputusan) {
                        return Carbon::createFromFormat('Y-m-d', $keputusan->sk_tanggal)->format('d M Y');
                    })
                    ->filterColumn('sk_tanggal', function ($query, $keyword) {
                        $query->whereRaw("DATE_FORMAT(sk_tanggal,'%d %M %Y') like ?", ["%$keyword%"]);
                    })
                    ->editColumn('sk_foto', function (Keputusan $keputusan) {
                        if ($keputusan->sk_foto == ''){
                            return "Tidak ada foto/file";
                        }else{
                            return $keputusan->sk_foto;
                        }
                    })
                    ->toJson();
        }
        return view('pages.umum.keputusan');
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
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
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

    public function bukuInventaris() {
        return view('pages.umum.inventaris');
    }

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
    
    public function bukuAgenda() {
        return view('pages.umum_buku_agenda');
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
