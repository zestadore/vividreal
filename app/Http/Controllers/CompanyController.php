<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use App\Models\Company;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ValidateCompany;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data= Company::query();
            $search = $request->search;
            if ($search) {
                $data->where(function ($query) use ($search) {
                    $query->where('company_name', 'like', '%' . $search . '%');
                });
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'companies.action')
                ->make(true);
        }
        return view('companies.index');
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(ValidateCompany $request)
    {
        $image=Null;
        if($request->file('logo')){
            $file= $request->file('logo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/logos'), $filename);
            $image= $filename;
        }
        $res=Company::create($request->except(['logo','_token'])+['logo'=>$image]);
        if($res){
            return redirect()->back()->with('success', 'Successfully updated the data.');
        }else{
            return redirect()->back()->with('error', 'Failed to update the data. Please try again.');
        }
    }

    public function show(Company $company)
    {
        //
    }

    public function edit($id)
    {
        $data=Company::find(Crypt::decrypt($id));
        return view('companies.edit',['company'=>$data]);
    }

    public function update(ValidateCompany $request, $id)
    {
        $company=Company::find(Crypt::decrypt($id));
        $image=$company->logo??null;
        if($request->file('logo')){
            if($company->logo!=null){
                $d=unlink(public_path('uploads/logos/'. $company->logo));
            }
            $file= $request->file('logo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/logos'), $filename);
            $image= $filename;
        }
        $res=$company->update($request->except(['logo','_token'])+['logo'=>$image]);
        if($res){
            return redirect()->back()->with('success', 'Successfully updated the data.');
        }else{
            return redirect()->back()->with('error', 'Failed to update the data. Please try again.');
        }
    }

    public function destroy($id)
    {
        $data=Company::find(Crypt::decrypt($id));
        $res=$data->delete();
        if($res){
            return response()->json(['success'=>"Data deleted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to delete the data, kindly try again!"]);
        }
    }
}
