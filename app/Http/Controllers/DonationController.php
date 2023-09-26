<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DonationController extends Controller
{
    public function index()
    {
        return Inertia::render('Donations/List', [
            'donations' => Donation::with('user')->latest()->paginate(5),
        ]);
    }

    public function create()
    {
        return Inertia::render('Donations/Create');
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'description' => ['required', 'max:200'],
            'mop' => ['required'],
            'reference_no' => ['required', 'unique:donations,reference_no'],
            'amount' => ['required'],
        ]);

        // dd($payload);

        $payload['user_id'] = auth()->id();
        Donation::create($payload);
        return redirect('/donations');
    }

    public function show(Request $request, Donation $donation)
    {
        $donation->load('user');
        return Inertia::render('Donations/Details', [
            'donation' => $donation,
        ]);
    }

    public function update(Request $request, Donation $donation)
    {
        $donation->update($request->all());
        return redirect()->to('/donations');
    }
}
