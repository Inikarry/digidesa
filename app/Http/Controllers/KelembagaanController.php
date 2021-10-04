<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Gaji;
use App\Models\RekomendasiMasuk;
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

    public function dataPKK() {
        return view('pages.kelembagaan_data_pkk');
    }

    public function bukuGaji(Request $request) {
        $data = Gaji::select('*');
        if ($request->ajax()) {
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function(Gaji $gaji){
                        $btn = '
                            <a type="button" class="btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$gaji->id.'" data-url="/buku-cuti/edit/'.$gaji->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                            <a type="button" class="delete_cuti btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$gaji->id.'" data-url="/buku-cuti/delete/'.$gaji->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                        ';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->toJson();
        }

        return view('pages.kelembagaan.gaji');
    }

    public function dataPosyandu() {
        return view('pages.kelembagaan_data_posyandu');
    }
    
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
