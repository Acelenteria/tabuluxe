<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Judge;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class JudgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Contest $contest)
    {   
        $request->validate([
            'name' => 'required|string',
            'passcode' => 'required|string',
        ]);

        Judge::create([
            'name' => $request->name,
            'passcode' => $request->passcode,
            'contest_id' => $contest->id,
            'access_token' => Str::random(64),
        ]);

        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Judge $judge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Judge $judge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Judge $judge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Judge $judge)
    {
        //
    }
}
