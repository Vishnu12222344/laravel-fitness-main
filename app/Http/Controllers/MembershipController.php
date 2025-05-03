<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Membership;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memberships = Membership::get();
        return view('membership', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $memberships = Membership::get();
        $membership = Membership::find($id);
        $auth = \Illuminate\Support\Facades\Auth::user();


        return view('membership-register', compact('memberships', 'id', 'membership', 'auth'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'gender' => 'required|in:male,female',
            'current_weight' => 'required|numeric',
            'weight_unit' => 'required|in:lbs,kg',
            'height' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'plan' => 'required',
            'agree' => 'required',
        ]);

        $member = new Members();
        $member->first_name = $validatedData['first_name'];
        $member->last_name = $validatedData['last_name'] ?? '';
        $member->gender = $validatedData['gender'];
        $member->current_weight = $validatedData['current_weight'];
        $member->weight_unit = $validatedData['weight_unit'];
        $member->desired_weight = $validatedData['desired_weight'] ?? null;
        $member->height = $validatedData['height'];
        $member->height_unit = $validatedData['height_unit'];
        $member->branch = $validatedData['branch'];
        $member->email = $validatedData['email'];
        $member->phone = $validatedData['phone'];
        $member->plan_id = $validatedData['plan'];
        $member->save();

        return redirect()->back()->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
