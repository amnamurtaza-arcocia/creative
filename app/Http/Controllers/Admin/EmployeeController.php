<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyEmail;
use Yajra\DataTables\Facades\DataTables;
class EmployeeController extends Controller
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
           $emp = Employee::all();
            return DataTables::of($emp)
                    ->addIndexColumn()
                    ->addColumn('name',function($row){
                        return $row->first_name.' '.$row->last_name;
                    })
                    ->addColumn('email',function($row){
                        return $row->email;
                    })
                    ->addColumn('phone',function($row){
                        return $row->phone;
                    })
                    ->addColumn('company',function($row){
                        return $row->company()->first()->name;
                    })
                    ->addColumn('action',function($row){
                        $btn2 = '';
                        $btn2 =$btn2.'<a href="' . url("admin/employee/edit/" . encrypt($row->id)) . '" class="btn btn-info shadow  mr-1"><i class="fas fa-pencil-alt text-white"></i></a>';
                        $btn2=$btn2.'<a class="btn btn-danger shadow " data-toggle="modal" data-original-title="test" data-target="#model1"><i class="fa fa-trash text-white"></i></a>
                        <div class="modal fade" id="model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Employee</h5>
                                        <button class="btn-close" type="button" data-dismiss="modal" >&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure ? You want to delete the employee. </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                                        <button class="btn btn-danger shadow  mr-1"><a href="' . url("admin/employee/delete/".encrypt($row->id)).'" style="color:white;">Delete Employee</i></a></button>
                                    </div>
                            </div>
                        </div>';
                    return $btn2;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboard.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cmp = Company::all();
        return view('dashboard.employee.create',compact('cmp'));
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
            'email' => 'required|email|unique:employees',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'phone' => 'required|min:11',
            'company_id' => 'required'
        ]);
       try{
           DB::beginTransaction();
           $emp = new Employee();
           $emp->first_name = $request->first_name;
           $emp->last_name = $request->last_name;
           $emp->phone = $request->phone;
           $emp->email = $request->email;
           $emp->company_id = $request->company_id;
           $emp->save();
            DB::Commit();
            Alert::toast('Employee Addedd in Company successfully','success');
            return redirect('admin/employee');
       }catch(\Exception $ex){
           DB::rollback();
           dd($ex->getMessage());
        //    Alert::toast('Error Occurred'.$ex->getMessage(),'error');
        //    return redirect()->back();
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
        $emp = Employee::where('id',$id)->first();
        $cmp = Company::all();
        // dd($cmp);
        return view('dashboard.employee.edit',compact('emp','cmp'));
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
            'email' => 'required|email|unique:employees,id',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'phone' => 'required|min:11',
            'company_id' => 'required'
        ]);
       try{
           DB::beginTransaction();
           $id = decrypt($id);
           $emp = Employee::find($id);
           $emp->first_name = $request->first_name;
           $emp->last_name = $request->last_name;
           $emp->phone = $request->phone;
           $emp->email = $request->email;
           $emp->company_id = $request->company_id;
           $emp->save();
            DB::Commit();
            Alert::toast('Employee Updated successfully','success');
            return redirect('admin/employee');
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
            Employee::where('id',$id)->delete();
            DB::commit();
            Alert::toast('Employee deleted successfully','success');
            return redirect()->back();

        }catch(\Exception $ex){
            DB::rollBack();
            Alert::toast('Error Occured'.$ex->getMessage(),'error');
            return redirect()->back();
        }
    }
}
