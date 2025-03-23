<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function index()
    {
        $tutores = Tutor::orderBy('id')->get();
        return view('tutores.index', ['tutores' => $tutores]);
    }

    public function create()
    {
        return view('tutores.create');
    }

    public function store(Request $request)
    {
        Tutor::create($request->all());
        return redirect()->route('tutores')->with('success', 'Tutor añadido correctamente');
    }

    public function show(string $id)
    {
        $tutor = Tutor::findOrFail($id);
        return view('tutores.show', compact('tutor'));
    }

    public function edit(string $id)
    {
        $tutor = Tutor::findOrFail($id);
        return view('tutores.edit', compact('tutor'));
    }

    public function update(Request $request, string $id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->update($request->all());
        return redirect()->route('tutores')->with('success', 'Tutor actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->delete();
        return redirect()->route('tutores')->with('success', 'Tutor borrado correctamente');
    }
}
