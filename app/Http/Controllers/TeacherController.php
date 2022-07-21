<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{

  /*-------------------------------------------------------------------------------
  GET ALL TEACHERS FUNCTION
  -------------------------------------------------------------------------------*/

  public function getTeachers(){
    $teacher_data = Teacher::all();
    $collection = collect();
    foreach($teacher_data as $teacher){
      $array = array(
        'id' => $teacher->id,
        'text' => ucfirst($teacher->name),
      );
      $collection->push($array);
    }

    return response()->json([
      'teacherdata' => $collection,
    ]);
  }

  /*-------------------------------------------------------------------------------
  ADD TEACHER FUNCTION
  -------------------------------------------------------------------------------*/

  public function store(Request $request)
  {
      $validated = $request->validate([
        'name' => 'required',
        'qualification' => 'required',
        'timing' => 'required',
      ]);

      $add_data = new Teacher();
      $add_data->name = $request->name;
      $add_data->qualification = $request->qualification;
      $add_data->timing = $request->timing;
      $add_data->save();

      return response()->json([
        'status' => 'success',
      ]);
    }


    /*-------------------------------------------------------------------------------
    UPDATE TEACHER FUNCTION
    -------------------------------------------------------------------------------*/

    public function update(Request $request)
    {
        $validated = $request->validate([
          'name' => 'required',
          'qualification' => 'required',
          'timing' => 'required',
        ]);

        $array = array(
          'name' => $request->name,
          'qualification' => $request->qualification,
          'timing' => $request->timing,
        );
        $update_data = new Teacher();
        $update_data->whereid($request->teacher_id)->update($array);

        return response()->json([
          'status' => 'success',
        ]);
      }

    /*-------------------------------------------------------------------------------
    GET ALL TEACHERS FUNCTION
    -------------------------------------------------------------------------------*/

    public function getAllTeachers(){
      $teacher_data = Teacher::all();
      return response()->json([
        'data' => $teacher_data,
      ]);
    }

    /*-------------------------------------------------------------------------------
    DELETE TEACHER FUNCTION
    -------------------------------------------------------------------------------*/

    public function destroy($id){
      $data = Teacher::findOrFail($id);
      $data->delete();
      return response()->json([
        'status' => 'success',
      ]);
    }
}
