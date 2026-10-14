<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ArtistaController extends Controller
{
    /**
     * Llista tots els artistes, ordenats per nom.
     */
    public function index(): View
    {
        // Ordenem els artistes alfabèticament pel seu nom
        $artistes = Artista::orderBy('nom')->get();

        return view('artistes.index', compact('artistes'));
    }

    /**
     * Mostra el formulari de creació.
     */
    public function create(): View
    {
        // Retorna la vista del formulari únic en estat de creació (sense $artista)
        return view('artistes.form');
    }

    /**
     * Valida i guarda un nou artista.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validació directa al controlador amb les regles de l'enunciat
        $validated = $request->validate([
            'nom'        => 'required|string|max:255',
            'pais'       => 'required|string|max:255',
            'bio'        => 'nullable|string',
            'imatge_url' => 'nullable|url',
            'actiu'      => 'sometimes|boolean',
        ]);

        // 2. Creem l'artista amb les dades netes i validades
        Artista::create($validated);

        return redirect()->route('artistes.index')->with('success', 'Artista creat correctament.');
    }

    /**
     * Mostra la fitxa d'un artista (amb els seus concerts).
     */
    public function show(Artista $artista): View
    {
        // Carreguem els concerts de l'artista (lògica del Bloc 4 / apartat 6.7)
        $artista->load(['concerts' => function ($query) {
            $query->orderBy('data_hora');
        }]);

        return view('artistes.show', compact('artista'));
    }

    /**
     * Mostra el formulari d'edició.
     */
    public function edit(Artista $artista): View
    {
        // Passem l'artista existent per reutilitzar el mateix formulari
        return view('artistes.form', compact('artista'));
    }

    /**
     * Valida i actualitza un artista existent.
     */
    public function update(Request $request, Artista $artista): RedirectResponse
    {
        // 1. Validació exacta i idèntica per a la modificació
        $validated = $request->validate([
            'nom'        => 'required|string|max:255',
            'pais'       => 'required|string|max:255',
            'bio'        => 'nullable|string',
            'imatge_url' => 'nullable|url',
            'actiu'      => 'sometimes|boolean',
        ]);

        // 2. Actualitzem el registre de l'artista existent
        $artista->update($validated);

        return redirect()->route('artistes.index')->with('success', 'Artista actualitzat correctament.');
    }
}

