<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDisplayRequest;

use App\Models\Display;
use Illuminate\Http\RedirectResponse;
use \Illuminate\Contracts\View\View;

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
    public function create(): View
    {
        return view('app.displays.create');
    }

    public function store(CreateDisplayRequest $request): RedirectResponse
    {
        $display = Display::create($request->validated());

        return redirect(route('displays.index'))->with('sucess', __('messages.display_created'));
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

    public function edit(Display $display): View
    {
        return view('app.displays.edit', ['display' => $display]);
    }

    public function update(CreateDisplayRequest $request, Display $display): RedirectResponse
    {
        $display->update($request->validated());

        return redirect($display->path() . '/edit')->with('sucess', __('messages.display_updated'));
    }

    public function destroy(Display $display): RedirectResponse
    {       
        $display->delete();

        return redirect()->route('displays.index')->with('sucess', __('messages.display_deleted'));
    }
}
