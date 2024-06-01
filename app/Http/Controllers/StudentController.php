<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    //
    public function addstudent()
    {
        return view('students.add');
    }

    public function store(Request $request)
    {

       $request->validate([
           'photo' => 'nullable|mimes:png,jpg,jpeg',
       ]);
       $imageName='';
       if($image=$request->file('photo')){
           $imageName=time().uniqid().'.'.$image->getClientOriginalExtension();
           $image->move('profile/',$imageName);
       }
        $student = new Students();
        $student->full_name = $request->full_name;
        $student->gender = $request->gender;
        $student->age = $request->age;
        $student->profile = $imageName;

        $result = $student->save();
        if ($result) {
            return redirect('list')->with('success', 'Successfulyy added');
        } else {
            return redirect('add-student')->with('success', 'failed to add');

        }
    }
    public function liststudent(){
        $student=Students::all();
        return view('students.list',
        [
            'students'=>$student
        ]
        );
    }
    public function edit($id){
        $student=Students::find($id);
        return view('students.edit',
        [
            'student'=>$student
        ]
        );
    }
    public function update(Request $request,$id){
        $student=Students::find($id);
        $student->full_name=$request->full_name;
        $student->gender=$request->gender;
        $student->age=$request->age;
        if ($request->file('photo')){
            $destination='profile/'.$student->profile;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $image=$request->file('photo');
            $imageName=time().uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('profile/',$imageName);
            $student->profile=$imageName;

        }
        $result=$student->update();
        if($result){
            return redirect('list')->with('success', 'Successfully Updated');
        }else{
            return redirect('list')->with('success', 'Failed to Update');

        }

    }
    public function destroy($id){
        $student=Students::find($id);
        $result=$student->delete();
        if($result){
            return redirect('list')->with('success', 'Successfully Deleted');
        }else{
            return redirect('list')->with('success', 'Failed to Delete');

        }
    }
}
