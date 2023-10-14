<?php

namespace App\Http\Controllers;

use App\Models\Wow;
use Illuminate\Http\Request;

class WowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wows.index', [
            'wows' => Wow::with('user')->latest()->get()
        ]);
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255']
        ]);
    
        auth()->user()->wows()->create($validated);
        
        return to_route('wows.index')->with('status', __('Wow created!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Wow $wow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wow $wow)
    {   
        $this->authorize('update', $wow);
        return view('wows.edit', [
        'wow' => $wow
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wow $wow)
    {   
        $this->authorize('update', $wow);
        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255'],
        ]);

        $wow->update($validated);

        return to_route('wows.index')
            ->with('status', __('Wow updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wow $wow)
    {
        $this->authorize('delete', $wow);

        $wow->delete();

        return to_route('wows.index')
            ->with('status', __('Wow deleted successfully!'));
    }
}
