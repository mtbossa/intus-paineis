<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDisplayRequest;

use App\Models\Display;
use Illuminate\Http\RedirectResponse;

class DisplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('app.displays.index', [
            'displays' => Display::paginate(15),
        ]);
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

    public function store(CreateDisplayRequest $request): RedirectResponse
    {
        $display = Display::create($request->validated());

        return redirect($display->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(CreateDisplayRequest $request, Display $display): RedirectResponse
    {
        $display->update($request->validated());

        return redirect($display->path());
    }

    public function destroy(Display $display): RedirectResponse
    {
        $display->delete();

        return redirect()->route('displays.index');
    }
}
