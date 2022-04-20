<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DaftarDesa;
use DataTables;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Rules\MatchOldPassword;

class UserController extends Controller
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

    public function daftarUser(Request $request){
        $data_desa = DaftarDesa::select('*')->get();
        $data = User::select('*');
        if ($request->ajax()) {
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function(User $user){
                        $btn = '
                            <a type="button" class="edit_user btn btn-danger btn-xs" style="height: 30px; width: 30px"
                            data-id="'.$user->id.'"
                            data-nama="'.$user->name.'"
                            data-nip="'.$user->nip.'"
                            data-role="'.$user->role.'"
                            data-password="'.$user->password.'"
                            ><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">mode_edit</i></a>
                            <a type="button" class="delete_user btn btn-danger btn-xs" style="height: 30px; width: 30px" data-id="'.$user->id.'" data-url="/daftar-user/delete/'.$user->id.'"><i class="material-icons-outlined" style="vertical-align: middle; font-size: 18px">delete</i></a>
                        ';
                        return $btn;
                    })
                    ->editColumn('last_login', function (User $user) {
                        if($user->last_login == ''){
                            return "---";
                        }else{
                            return $user->last_login;
                        }
                    })
                    ->rawColumns(['action'])
                    ->toJson();
        }
        return view('pages.user', [
            'data_desa'         => $data_desa,
        ]);
    }

    public function addUser(Request $request){
        $messages = [
            'nip.unique'   => 'NIP Telah Ada Sebelumnya!',
            'nip.required'   => 'NIP Tidak Boleh Kosong!',
            'user_nama.required'   => 'Nama Tidak Boleh Kosong!',
            'password.confirmed'=> 'Password yang Dimasukkan Tidak Sama!',
            'user_role.required'     => 'Role Harus Dipilih!',
            'password.required' => 'Password Tidak Boleh Kosong!',
            'password.min' => 'Password Minimal 8 Karakter!',
            ];

        $validator = \Validator::make($request->all(), [
            'user_role'     => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nip' => ['required', 'string', 'max:255', 'unique:users'],
            'user_nama'     => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }else {
            $user = new User;
            $user->name = $request->user_nama;
            $user->nip = $request->nip;
            $user->role = $request->user_role;
            $user->password = Hash::make($request->password);
            $user->save();
        }
    }

    public function updateUser(Request $request, $id){
        $messages = [
            'nip.unique'   => 'NIP Telah Ada Sebelumnya!',
            'nip.required'   => 'NIP Tidak Boleh Kosong!',
            'uNama.required'   => 'Nama Tidak Boleh Kosong!',
            'password.confirmed'=> 'Password yang Dimasukkan Tidak Sama!',
            'password.min' => 'Password Minimal 8 Karakter!',
            ];

        $validator = \Validator::make($request->all(), [
            'password' => ['nullable', 'min:8', 'confirmed'],
            'nip' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($request->uId)],
            'uNama'     => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }else {
            $user = User::where('id', $id);
            if($request->password == null){
                $user->update([
                    'name'                  => $request->uNama,
                    'nip'                   => $request->nip,
                    'role'                  => $request->uRole,
                ]);
            }else{
                $user->update([
                    'name'                  => $request->uNama,
                    'nip'                   => $request->nip,
                    'role'                  => $request->uRole,
                    'password'              => Hash::make($request->password),
                ]);
            }
        }
    }

    public function destroyUser($id){
        User::find($id)->delete();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $messages = [
            'nip.unique'   => 'NIP Telah Ada Sebelumnya!',
            'nip.required'   => 'NIP Tidak Boleh Kosong!',
            'name.required'   => 'Nama Tidak Boleh Kosong!',
            ];

        $validator = \Validator::make($request->all(), [
            'nip' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($request->id)],
            'name'     => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }else {
            $user = User::where('id', $id);
            $user->update([
                'name'                  => $request->name,
                'nip'                   => $request->nip,
            ]);
        }
    }

    public function changePassword(Request $request, $id)
    {
        $messages = [
            'current_password.required' => 'Current Password Tidak Boleh Kosong!',
            'new_password.required'     => 'New Password Tidak Boleh Kosong!',
            'confirm_password.required' => 'Confirm Password Tidak Boleh Kosong!',
            'confirm_password.same'     => 'Password Yang Dimasukkan Tidak Sama',
            'new_password.different'    => 'Current Password Dan New Password Harus Berbeda',
            'new_password.min'          => 'Password Minimal 8 Karakter!',
            ];

        $validator = \Validator::make($request->all(), [
            'confirm_password' => ['required', 'same:new_password'],
            'new_password'     => ['required', 'min:8', 'different:current_password'],
            'current_password' => ['required', new MatchOldPassword],
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }else {
            $user = User::where('id', $id);
            $user->update([
                'password'          => Hash::make($request->new_password),
            ]);
        }
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
