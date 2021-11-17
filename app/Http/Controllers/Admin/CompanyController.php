<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyEmail;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $cmp = Company::all();
            return DataTables::of($cmp)
                    ->addIndexColumn()
                    ->addColumn('name',function($row){
                        return $row->name;
                    })
                    ->addColumn('email',function($row){
                        return $row->email;
                    })
                    ->addColumn('action',function($row){
                        $btn2 = '';
                        $btn2 =$btn2.'<a href="' . url("admin/company/edit/" . encrypt($row->id)) . '" class="btn btn-info shadow  mr-1"><i class="fas fa-pencil-alt text-white"></i></a>';
                        $btn2=$btn2.'<a class="btn btn-danger shadow " data-toggle="modal" data-original-title="test" data-target="#model1"><i class="fa fa-trash text-white"></i></a>
                        <div class="modal fade" id="model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Company</h5>
                                        <button class="btn-close" type="button" data-dismiss="modal" >&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure ? You want to delete the company. </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                                        <button class="btn btn-danger shadow  mr-1"><a href="' . url("admin/company/delete/".encrypt($row->id)).'" style="color:white;">Delete Company</i></a></button>
                                    </div>
                            </div>
                        </div>';
                    return $btn2;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboard.company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('ok');
        request()->validate([
            'email' => 'required|email|unique:companies',
            'name' => 'required|min:3',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=100,height=100',
        ]);
       try{
           DB::beginTransaction();
            if($request->hasFile('logo')){
                $file = Storage::put('upload',$request->file('logo'));
            }
            $cmp = new Company();
            $cmp->create([
                'name' => $request->name,
                'email' => $request->email,
                'logo' => $file,
            ]);
            DB::Commit();
            Mail::to(request('email'))->send(new CompanyEmail($request->email,url('/')));
            Alert::toast('Company created successfully','success');
            return redirect('admin/company');
       }catch(\Exception $ex){
           DB::rollback();
        //    dd($ex->getMessage());
            Alert::toast('Error Occurred'.$ex->getMessage(),'error');
            return redirect()->back();
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
        $id = decrypt($id);
        $cmp = Company::find($id);
        return view('dashboard.company.edit',compact('cmp'));
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
        request()->validate([
            'email' => 'required|email|unique:companies,id',
            'name' => 'required|min:3',
        ]);
       try{
           DB::beginTransaction();
            $id = decrypt($id);
            $cmp = Company::find($id);
            $cmp->name = $request->name;
            $cmp->email = $request->email;
            if($request->hasFile('logo')){
                $file = Storage::put('upload',$request->file('logo'));
                $cmp->logo = $file;
            }
            $cmp->save();
            DB::Commit();
            Alert::toast('Company Updated successfully','success');
            return redirect('admin/company');
       }catch(\Exception $ex){
           DB::rollback();
        //    dd($ex->getMessage());
            Alert::toast('Error Occurred'.$ex->getMessage(),'error');
            return redirect()->back();
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try{
            DB::beginTransaction();
            $id = decrypt($id);
            $cmp = Company::where('id',$id)->delete();
            DB::commit();
            Alert::toast('Company deleted successfully','success');
            return redirect()->back();

        }catch(\Exception $ex){
            DB::rollBack();
            Alert::toast('Error Occured'.$ex->getMessage(),'error');
            return redirect()->back();
        }
    }
}
