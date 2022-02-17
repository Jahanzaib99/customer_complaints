<?php

namespace App\Http\Controllers;

use App\Jobs\ComplaintStatusJob;
use App\Models\Complaint;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auth_user = auth()->user();
        if ($request->ajax()) {
            
            $data = Complaint::where(function($where) use ($auth_user){
                if($auth_user->hasRole('csr')) {
                    $where->where('user_id', $auth_user->id);
                }
            })->orderBy('created_at', 'desc')->get();
            // dd($data);
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('select_complaints', static function ($row) {
                        return '<input type="checkbox" class="select-checkbox" name="registrations" value="'. $row->id .'"/>';
                    })
                    ->rawColumns(['select_complaints'])
                    ->make(true);
        }
        
        return view('complaints.index');
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
    public function update(Request $request)
    {
        try {
            $complaints = Complaint::whereIn('id', $request->id)->get();
            ComplaintStatusJob::dispatch($complaints, $request->status);
        } catch(Exception $th) {
            throw $th;
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
