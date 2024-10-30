<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse; // tambahkan ini
use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // tambahkan ini
use Illuminate\View\View;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(): Response // ubah dari ini
    public function index(): View // ke ini
    {
        // return view('chirps.index'); // ubah dari ini
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
        ]); // ke ini
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
    // public function store(Request $request) // ubah dari ini
    public function store(Request $request): RedirectResponse // ke ini
    {
        // lalu tambahkan ini
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $request->user()->chirps()->create($validated);
 
        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Chirp $chirp) // ubah dari ini
    public function edit(Chirp $chirp): View // ke ini
    {
        // lalu tambahkan ini
        Gate::authorize('update', $chirp);
 
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Chirp $chirp) // ubah dari ini
    public function update(Request $request, Chirp $chirp): RedirectResponse // ke ini
    {
        // lalu tambahkan ini
        Gate::authorize('update', $chirp);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $chirp->update($validated);
 
        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Chirp $chirp) // ubah dari ini
    public function destroy(Chirp $chirp): RedirectResponse // ke ini
    {
        // tambahkan juga ini
        Gate::authorize('delete', $chirp);
 
        $chirp->delete();
 
        return redirect(route('chirps.index'));
    }
}
