<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rt;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class RtController extends Controller
{
    public function index()
    {
        return view('admin.pages.rt.index',[
            'title' => 'Data RT'
        ]);
    }

    public function data()
    {
        if(request()->ajax())
        {
            $data = Rt::with('rw')->orderBy('rw_id','ASC');
            return DataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($model){
                        $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-nomor='$model->nomor' data-rw='$model->rw_id'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-nomor='$model->nomor'><i class='fas fa fa-trash'></i> Hapus</button>";
                        return $action;
                    })
                    ->addColumn('rw', function($model){
                        return $model->rw->nomor;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nomor' => ['required',Rule::unique('rt')->where('rw_id',request('rw_id'))->ignore(request('id'))],
            'rw_id' => ['required']
        ]);

        Rt::updateOrCreate([
            'id'  => request('id')
        ],[
            'nomor' => request('nomor'),
            'rw_id' => request('rw_id')
        ]);

        if(request('id'))
        {
            $message = 'Data RT berhasil disimpan.';
        }else{
            $message = 'Data RT berhasil ditambahakan.';
        }
        return response()->json(['status'=>'succcess','message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rt::find($id)->delete();
        return response()->json(['status'=>'succcess','message' => 'Data RT berhasil dihapus.']);
    }

    public function get()
    {
       if(request()->ajax()){
        $rw_id = request('rw_id');
        $items = Rt::where('rw_id',$rw_id)->orderBy('nomor','ASC')->get();
        if($items)
        {
            return response()->json($items);
        }else{
            return response()->json([]);
        }

       }
    }
}
