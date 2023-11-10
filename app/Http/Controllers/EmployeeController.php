<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;
use App\Models\Employee;
use App\Models\Company;
use App\Http\Requests\ValidateEmployee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data= Employee::query()->with('company');
            $search = $request->search;
            if ($search) {
                $data->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                });
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'employees.action')
                ->make(true);
        }
        return view('employees.index');
    }

    public function create()
    {
        $companies=Company::get();
        return view('employees.create',['companies'=>$companies]);
    }

    public function store(ValidateEmployee $request)
    {
        $res=Employee::create($request->except(['_token']));
        if($res){
            return redirect()->back()->with('success', 'Successfully updated the data.');
        }else{
            return redirect()->back()->with('error', 'Failed to update the data. Please try again.');
        }
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit($id)
    {
        $data=Employee::find(Crypt::decrypt($id));
        $companies=Company::get();
        return view('employees.edit',['employee'=>$data,'companies'=>$companies]);
    }

    public function update(ValidateEmployee $request, $id)
    {
        $data=Employee::find(Crypt::decrypt($id));
        $res=$data->update($request->except(['_token']));
        if($res){
            return redirect()->back()->with('success', 'Successfully updated the data.');
        }else{
            return redirect()->back()->with('error', 'Failed to update the data. Please try again.');
        }
    }

    public function destroy($id)
    {
        $data=Employee::find(Crypt::decrypt($id));
        $res=$data->delete();
        if($res){
            return response()->json(['success'=>"Data deleted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to delete the data, kindly try again!"]);
        }
    }
}
