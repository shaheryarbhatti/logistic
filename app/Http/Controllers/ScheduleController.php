<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Teacher;

class ScheduleController extends Controller
{

  /*-------------------------------------------------------------------------------
  ADD TEACHER FUNCTION
  -------------------------------------------------------------------------------*/

  public function store(Request $request)
  {
      $validated = $request->validate([
        'teacher_id' => 'required',
      ]);

      $add_data = new Schedule();
      $add_data->teacher_id = $request->teacher_id;
      $add_data->classes = $request->classes;
      $add_data->subject = $request->subject;
      $add_data->timing = $request->timing;
      $add_data->duration = $request->duration;
      if($request->breakoroff){
        $add_data->breakoroff = 1;
      }else{
        $add_data->breakoroff = 0;
      }
      $add_data->text = $request->text;
      $add_data->save();

      return response()->json([
        'status' => 'success',
      ]);
    }

    /*-------------------------------------------------------------------------------
    SHOW SCHEDULE FUNCTION
    -------------------------------------------------------------------------------*/
    public function show($id){
      $schedule_data = Schedule::with('teacher')->whereteacher_id($id)->get();
      return response()->json([
        'data' => $schedule_data,
      ]);
    }

    /*-------------------------------------------------------------------------------
    UPDATE SCHEDULE FUNCTION
    -------------------------------------------------------------------------------*/

    public function update(Request $request)
    {
      $validated = $request->validate([
        'teacher_id' => 'required',
      ]);


        if($request->breakoroff){
          $breakoroff = 1;
        }else{
          $breakoroff = 0;
        }

        $array = array(
          'teacher_id' => $request->teacher_id,
          'classes' => $request->classes,
          'subject' => $request->subject,
          'timing' => $request->timing,
          'duration' => $request->duration,
          'breakoroff' => $breakoroff,
          'text' => $request->text,
        );
        $update_data = new Schedule();
        $update_data->whereid($request->schedule_id)->update($array);

        return response()->json([
          'status' => 'success',
        ]);

      }

    /*-------------------------------------------------------------------------------
    GET ALL TEACHERS FUNCTION
    -------------------------------------------------------------------------------*/

    public function getAllSchedules(){
      $schedule_data = Schedule::with('teacher')->get();
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
        'data' => $schedule_data,
        'teacherdata' => $collection,
      ]);
    }

    /*-------------------------------------------------------------------------------
    DELETE TEACHER FUNCTION
    -------------------------------------------------------------------------------*/

    public function destroy($id){
      $data = Schedule::findOrFail($id);
      $data->delete();
      return response()->json([
        'status' => 'success',
      ]);
    }
}
