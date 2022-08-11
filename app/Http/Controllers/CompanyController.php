<?php

namespace App\Http\Controllers;

use App\Models\Comp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompnayRequest;
use App\Models\Employee;
use Validator;
use Image;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Comp::all();
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.addCompany');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompnayRequest $request)
    {
            $data = $request->all();
            $company = new Comp;
            $company->name = $data['name'];
            $company->email = $data['email'];
            $company->website = $data['website'];
            
         if($request->hasFile('image')){
            $img_tmp =$request->file('image');
            $filename =time() . '.' .$img_tmp->getClientOriginalExtension();
            //$path = $img_tmp->store('public');
            $location=('images/'.$filename);
            Image::make($img_tmp)->resize(100,100)->save($location);
            $company->image = $location ;
         }

            $company->save();

            return redirect()->route('company.index')->with('flash_message_success','Company has been updated Successfully!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Comp $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comp  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Comp $company)
    {
        $company = Comp::find($company)->first();
        return view('company.company_edit')->with(compact('company'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comp $company)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
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
            $company = Comp::find($company)->first();
            //dd($data);
            if($company)
            {
                $company->name = $data['name'];
                $company->email = $data['email'];
                $company->website = $data['website'];
                
             if($request->hasFile('image')){
                $path = $company->image;
                if(file_exists($path)){
                    unlink($path);
                }

               $img_tmp =$request->file('image');
               $filename =time() . '.' .$img_tmp->getClientOriginalExtension();
               //$path = $img_tmp->store('public');
                $location=('images/' .$filename);
                Image::make($img_tmp)->resize(100,100)->save($location); 
                 $company->image = $location ;
             }
                $company->update();

                return redirect()->route('company.index')->with('flash_message_success','Company has been updated Successfully!!');
            }
            else
            {
                return redirect()->back()->with('flash_message_success','Company not found');
            }
        }
    
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comp $company)
    {
        {
            $company->delete();
            return redirect()->route('company.index')->with('flash_message_success','Company has been deleted Successfully!!');
        }
        
    
    }
}
