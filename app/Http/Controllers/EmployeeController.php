<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EmployeeRequest;
use App\Models\Comp;
use Validator;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::get();
        
        $employees = DB::table('employees')
        ->join('comps','employees.companyId','comps.id')
        ->select('employees.*','comps.name')
        ->get();
        //$company = Comp::all();
        return view('company.employee',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Comp::all();
        return view('company.addEmployee',compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->all();
            $employee = new Employee;
            $employee->firstname = $data['firstname'];
            $employee->lastname = $data['lastname'];
            $employee->email = $data['email'];
            $employee->phone = $data['phone'];
            $employee->companyId = $data['companyId'];
            $employee->save();
            return redirect()->route('employee.index')->with('flash_message_success','employee has been updated Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $employee = Employee::find($employee)->first();
        //dd($employee);
        $companies = Comp::all();
        if($employee)
        {
            return view('company.employee_edit')->with(compact('employee', 'companies'));
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Iemployeelluminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'firstname'=> 'required',
            'lastname'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $data= $request->all();
            $employee = Employee::find($employee)->first();
            if($employee)
            {
                $employee->firstname = $data['firstname'];
                $employee->lastname = $data['lastname'];
                $employee->email = $data['email'];
                $employee->phone = $data['phone'];
                $employee->companyId = $data['companyId'];
                $employee->update();

                return redirect()->route('employee.index')->with('flash_message_success','employe has been updated Successfully!!');
            }
           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy (Employee $employee)
    {
        $employee = Employee::find($employee)->first();
        //dd($employee);
        if($employee)
        {
            $employee->delete();
            return redirect()->route('employee.index')->with('flash_message_success','employee has been deleted Successfully!!');
        }
        
    
    }
}
