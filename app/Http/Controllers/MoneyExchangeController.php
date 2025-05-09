<?php

namespace App\Http\Controllers;

use App\Models\moneyExchange;
use Illuminate\Http\Request;

class MoneyExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.moneyExchange.create')
;    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\moneyExchange  $moneyExchange
     * @return \Illuminate\Http\Response
     */
    public function show(moneyExchange $moneyExchange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\moneyExchange  $moneyExchange
     * @return \Illuminate\Http\Response
     */
    public function edit(moneyExchange $moneyExchange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\moneyExchange  $moneyExchange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, moneyExchange $moneyExchange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\moneyExchange  $moneyExchange
     * @return \Illuminate\Http\Response
     */
    public function destroy(moneyExchange $moneyExchange)
    {
        //
    }
}
