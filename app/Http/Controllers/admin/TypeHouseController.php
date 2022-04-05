<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\TypeHouse;
use Illuminate\Support\Facades\DB;

class TypeHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $row = json_decode(json_encode([
            "title" => "Categories",
            "desc" => "Danh mục sản phẩm"
        ]));
        $type = TypeHouse::orderBy('id','DESC')->get();
        return view('admin.typeHouse.index',compact('type','row'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $row = json_decode(json_encode([
            "title" => "Thêm thể loại",
            "desc" => "Thêm thể loại"
        ]));
        return view('admin.typeHouse.add', compact('row'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|unique:types_house,title|max:255',
            'status' => 'required'
        ],[
                "title.required" => "Vui lòng nhập thể loại",
                "title.unique" => "Thể loại đã tồn tại đã tồn tại",
                "title.max" => "Tên danh mục không quá 255 ký tự",
                "status.required" => "Vui lòng chọn trạng thái"
        ]);

        $type = new TypeHouse();
        $type->title = $request->title;
        $type->status = $request->status;
        
        if($type->save()){
            return redirect()->back()->with(["type"=>"success","message"=>"Thêm danh mục thành công"]);
        }else{
            return back()->withInput()->with(["type"=>"danger","message"=>"Thêm danh mục thất bại"]);
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
        
        $type = TypeHouse::find($id);
        if(isset($type)){
            $row = json_decode(json_encode([
                "title" => "Cập nhật thể loại",
                "desc" => "Cập nhật - " . $type->title
            ]));
            return view('admin.typeHouse.edit', compact('type','row'));
        }
        return abort(404);
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
        $type = TypeHouse::find($id);
        $this->validate($request, [
            'title' => 'required|unique:types_house,title,'.$type->id.'|max:255',
            'status' => 'required'
        ],[
                "title.required" => "Vui lòng nhập thể loại",
                "title.unique" => "Thể loại đã tồn tại",
                "title.max" => "Tên thể loại không quá 255 ký tự",
                "status.required" => "Vui lòng chọn trạng thái"
        ]);
       
        $type->title = $request->title;
        $type->status = $request->status;
        
        if($type->save()){
            return redirect()->back()->with(["type"=>"success","message"=>"Cập nhật danh mục thành công"]);
        }else{
            return back()->withInput()->with(["type"=>"danger","message"=>"Cập nhật danh mục thất bại"]);
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
        $type = TypeHouse::find($id);
        if($type->delete()){
            return response()->json([
                'status' => 1,
                'msg' => 'Xóa danh mục thành công'
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'msg' => 'Xóa danh mục thất bại'
            ]);
        }
    }

    public function noiBac($id,$noiBac)
    {
        $category = Category::find($id);
        $category->noi_bac = $noiBac;
        if ($category->save()) {
            return response()->json([
                "status" => 1,
                "msg" => "cập nhật thành công"
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "msg" => "cập nhật thất bại"
            ]);
        }
    }

    public function status($id,$status)
    {
        $type = TypeHouse::find($id);
        $type->status = $status;
        if ($type->save()) {
            return response()->json([
                "status" => 1,
                "msg" => "cập nhật thành công"
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "msg" => "cập nhật thất bại"
            ]);
        }
    }

    public function deleteAll($id = "") {
        $list_id = json_decode($id);
        //var_dump($list_id);
        //die();
        if (!isset($list_id[0]->id)) {
            return back()->withInput()->with(["type" => "danger", "message" => "Không có dữ liệu để xóa."]);
        }
        if (count($list_id) == 1 && isset($list_id[0]->id)) {
            $category = TypeHouse::find($list_id[0]->id);
            if ($category->delete()) {
                return redirect()->route("admin.type.house.index")->with(["type" => "success", "message" => "Xoá thành công!"]);
            } else {
                return back()->withInput()->with(["type" => "danger", "message" => "Đã xảy ra lỗi, vui lòng thử lại."]);
            }
        } else {
            foreach ($list_id as $key => $value) {
                $category = TypeHouse::find($value->id);
                
                $category->delete();
            }
            return redirect()->route("admin.type.house.index")->with(["type" => "success", "message" => "Xóa thành công!"]);
        }
    }

    public function resortPosition(Request $request){
        $data = $request->array_id;
        //dd($data);
        foreach ($data as $key => $value) {
            $category = Category::find($value);
            $category->stt = $key;
            $category->save();
        }

    }
}
