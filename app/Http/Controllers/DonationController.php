<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\User;
use App\Notifications\DonationUpdate;
use App\Notifications\NewDonationReceived;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function coordinatorApprove(Request $request, Donation $donation)
    {
        $donation->update(['approved_at' => now()]);
        $donation->user->notify(new DonationUpdate(auth()->user()->name));
        alert()->success('Success', 'Donation has been approved!');
        return back();
    }

    public function coordinatorIndex(Request $request)
    {
        $donations = Donation::get();
        $latestDonations = Donation::take(5)->latest()->get();
        return view('donations.coordinatorIndex', compact('donations', 'latestDonations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'receipt' => ['required', 'image', 'max:5000'],
            'mop' => 'required',
            'description' => 'required',
        ]);

        $data['receipt'] = $request->receipt->store('public');
        $data['user_id'] = auth()->id();
        $data['year_donated'] = Carbon::now()->format('Y');

        // send notif to the coordinators
        $coordinators = User::whereType(User::TYPE_COORDINATOR)->get();

        foreach ($coordinators as $c) {
            $c->notify(new NewDonationReceived(auth()->user()->name));
        }

        alert()->success('Success', 'Donation has been sent! your donation will be public once approved!');

        Donation::create($data);

        return redirect()->to(route('alumni.donations'));
    }
    public function index()
    {
        $donations = Donation::whereNotNull('approved_at')->latest()->get();
        return view('donations.index', compact('donations'));
    }

    public function create()
    {
        return view('donations.create');
    }

    public function adminIndex()
    {
        $users = User::whereHas('Donations')->with('donations')->latest()->get();
        return view('donations.adminIndex', compact('users'));
    }

    public function adminShow(User $user)
    {
        $user->load('donations');
        return view('donations.adminShow', compact('user'));
    }
}
