<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function save_student(){
        $student = new Student;
        $student->name = request()->name;
        $student->phone = request()->phone;
        $student->email = request()->email;
        $student->save();
        return 'ok';
    }
    public function all_student(){
        $students = Student::all();
        return response()->json( $students);
    }
    public function edit_student($id){
        $student = Student::find($id);
        return response()->json( $student);
    }
    public function update_student(){
        $student = Student::find( request()->id);
        $student->name = request()->name;
        $student->phone = request()->phone;
        $student->email = request()->email;
        $student->update();
        return 'ok';
    }
    public function delete_student($id){
        $student = Student::find($id)->delete();
        return 'ok';
    }
}
