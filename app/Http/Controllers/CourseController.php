<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Step;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function showStep(Request $request, Step $step)
    {
        return view('view-steps', compact('step'));
    }

    public function edit(Request $request, Course $course) {
        return view('courses.edit', compact('course')); 
    }
    public function deleteConfirm(Request $request, Course $course) {
        return view('courses.deleteConfirm', compact('course')); 
    }

    public function update(Request $request, Course $course) {

        $data = $request->validate([
            'name' => 'required',
            'descriptions' => 'required',
        ]);

        $course->update($data);

        alert()->success('Success', 'Course Successfully updated!!');
        return redirect()->to('/courses/');
    }

    public function destroy(Request $request, Course $course) {
        Step::whereCourseId($course->id)->delete(); 
        $course->delete(); 
        alert()->success('Success', 'Course has been deleted!');
        return redirect()->to('/courses/');
    }
    public function removeStep(Request $request, Step $step)
    {
        $step->delete();
        alert()->success('Success', 'Step has been removed!');
        return back();
    }
    public function index()
    {
        $courses = Course::get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'descriptions' => 'required',
        ]);

        Course::create($data);

        alert()->success('Success', 'Course Successfully created!');
        return redirect()->to('/courses/');
    }

    public function storeStep(Request $request)
    {
        $data = $request->validate([
            'requirements' => 'required',
            'descriptions' => 'required',
            'sq' => 'required',
            'course_id' => 'required',
        ]);

        Step::create($data);
        alert()->success('Success', 'step has been added!');
        return back();
    }

    public function show(Request $request, Course $course)
    {
        $course->load('steps');
        return view('courses.show', compact('course'));
    }
}
