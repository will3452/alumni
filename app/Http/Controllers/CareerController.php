<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CareerController extends Controller
{
    public function index()
    {
        return Inertia::render('Careers/List', [
            'careers' => Career::latest()->paginate(5),
        ]);
    }

    public function create()
    {
        return Inertia::render('Careers/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course' => ['required', 'unique:careers,course'],
            'description' => ['required', 'max:255'],
        ]);

        Career::create($data);

        return redirect('/careers');
    }

    public function show(Request $request, Career $career)
    {
        $career->load('items');
        return Inertia::render('Careers/Details', ['career' => $career]);
    }

    public function storeItem(Request $request)
    {

        // dd($request->all());
        $data = $request->validate([
            'career_id' => ['required', 'exists:careers,id'],
            'title' => ['required'],
            'level' => ['required'],
            'description' => ['required'],
        ]);
        CareerItem::create($data);
        return redirect("/careers/" . $data['career_id']);
    }

    public function deleteItem(Request $request, CareerItem $careerItem)
    {
        $careerId = $careerItem->career_id;
        $careerItem->delete();
        return redirect("/careers/$careerId");
    }
}
