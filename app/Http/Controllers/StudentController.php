<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Student model
        $student = Student::all();
        return view('Students.view',compact('student'));
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
    public function store(Request $request,Student $student)
    {

        $validator = Validator::make($request->all(),[
            'roll' => 'required|unique:students,roll,'.$student->roll.'|numeric',
            'fname' => 'required|min:3|max:60',
            'lname' => 'required|min:3|max:60',
            'phone' => 'nullable|digits:10',
            'email' => 'required|unique:students,email,'.$student->email.'',
            
        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }


        Student::create([

            'roll' => $request['roll'],
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'phone' => $request['phone'],
            'email' => $request['email'],
        ]); 
            return redirect('view');

            
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the current id and store tha all data in student variable after send the data in edit page
        $student = Student::find($id);
        return view('Students.edit',compact('student'));

       // return view('Students/{student}/edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student,$id)
    {

        $validator = Validator::make($request->all(),[
            'roll' => 'required|unique:students,roll,'.$student->roll.'|numeric',
            'fname' => 'required|min:3|max:60',
            'lname' => 'required|min:3|max:60',
            'phone' => 'nullable|digits:10',
            'email' => 'required|unique:students,email,'.$student->email.'',
            
        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }



        $student = Student::find($id);
        Student::where('id',$student->id)->update([

            'roll' => $request['roll'],
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'phone' => $request['phone'],
            'email' => $request['email'],
           
        ]);  
            return redirect('view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student,$id)
    {
        // $student->delete();
        Student::where('id',$id)->delete();
        return redirect('view');
    
    }
}
