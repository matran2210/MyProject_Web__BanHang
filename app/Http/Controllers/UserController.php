<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DataTables;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Validator;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getViewDanhSachTaiKhoan(){
        return view('back_end.danhsach_taikhoan');
    }
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('back_end.danhsach_taikhoan');
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
        $rules = array(
            'email'    =>  'bail|required|email|unique:users,email',
            'password'     =>  'bail|required|min:3',
            'name' => 'bail|required|min:3',
            'level' => 'required'

        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {

            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'         =>  $request->get('name'),
            'email'        =>  $request->get('email'),

            'password'         => Hash::make($request->get('password')),
            'level'       => $request->get('level')


        );


        User::create($form_data);
        //có 1 điều rất là bược mình là nếu dùng cái hàm lz này thì phải khai báo đầy đủ thuộc tính của bảng
        //trong model. Thật trùng hợp làm sao  3 trường name email password lại được khai báo sẵn trong User , bảo sao thêm trường
        //level mãi mà ko được.

        return response()->json(['success' => 'Thêm dữ liệu thành công!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = User::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        $rules = array(
            'email'    =>  'bail|required|email|unique:users,email,'.$request->hidden_id,

            'name' => 'bail|required|min:3'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'         =>  $request->get('name'),
            'email'        =>  $request->get('email'),
            'level'       => $request->get('level'),

        );

        User::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $data = User::findOrFail($id);
        $data->delete();

    }
}
