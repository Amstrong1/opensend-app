<?php

namespace App\Http\Controllers;

use App\Models\Interac;
use App\Http\Requests\StoreInteracRequest;
use App\Http\Requests\UpdateInteracRequest;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class InteracController extends Controller
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

        return view('interac');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInteracRequest $request)
    {
        $interac = new EloquentCollection();
        $interac->push([
            'tel' => $request->tel,
            'name' => $request->name,
            'bank' => $request->bank,
            'email' => $request->email,
            'amount' => $request->amount,
            'country' => $request->country,
            'type' => $request->type,
        ]);
        $interac = $interac->collapse();
        return view('confirm-interac', compact('interac'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Interac $interac)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interac $interac)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInteracRequest $request, Interac $interac)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interac $interac)
    {
        //
    }
}
