<?php

namespace App\Http\Controllers;

use App\Models\PublikasiMandiri;
use App\Http\Requests\StorePublikasiMandiriRequest;
use App\Http\Requests\UpdatePublikasiMandiriRequest;

class PublikasiMandiriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('publikasi_mandiri.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePublikasiMandiriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublikasiMandiriRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PublikasiMandiri  $publikasiMandiri
     * @return \Illuminate\Http\Response
     */
    public function show(PublikasiMandiri $publikasiMandiri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublikasiMandiri  $publikasiMandiri
     * @return \Illuminate\Http\Response
     */
    public function edit(PublikasiMandiri $publikasiMandiri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePublikasiMandiriRequest  $request
     * @param  \App\Models\PublikasiMandiri  $publikasiMandiri
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePublikasiMandiriRequest $request, PublikasiMandiri $publikasiMandiri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublikasiMandiri  $publikasiMandiri
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublikasiMandiri $publikasiMandiri)
    {
        //
    }
}
