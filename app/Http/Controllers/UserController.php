<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = User::select('*');

            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '';
                $button .= '<a type="button" id="'.$data->id.'" nama="'.substr($data->name, 0, 15).'" class="edit blue-text mr-1 ml-1"><i class="material-icons tiny">border_color</i></a>';
                $button .= '<a type="button" id="'.$data->id.'" nama="'.substr($data->name, 0, 15).'" class="delete red-text mr-1 ml-1"><i class="material-icons tiny">delete</i></a>';
                $button .= '<a type="button" id="'.$data->id.'" nama="'.substr($data->name, 0, 15).'" class="show green-text mr-1 ml-1"><i class="material-icons tiny">visibility</i></a>';
                return $button;
            })
            ->editColumn('name', function($data){
                $name = $data->name;
                if(strlen($name) > 15) {
                    $name = substr($name, 0, 11);
                    $name = str_pad($name,  15, ".");
                }

                return "<span data-toggle='tooltip' title='$data->name'>$name</span>";
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at;
            })
            ->editColumn('updated_at', function ($query) {
                return $query->updated_at;
            })
            ->rawColumns(['action', 'name'])
            ->make(true);
        }
        return view('Users.index');
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
        if(request()->ajax()){
            User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make(123456)
            ]);
            return response()->json(['success' => "Data berhasil disimpan."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(request()->ajax()){
            $data = User::find($id);
            return response()->json(['success' => $data]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax()){
            $data = User::find($id);
            return response()->json(['success' => $data]);
        }
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
        if(request()->ajax()){
            $data = User::find($id);
            $data->update([
                'name' => $request->nama,
                'email' => $request->email
            ]);
            return response()->json(['success' => "Data berhasil diupdate."]);
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
        if(request()->ajax()){
            $data = User::find($id);
            $data->delete();
            return response()->json(['success' => 'Data berhasil dihapus.']);
        }
    }
}
