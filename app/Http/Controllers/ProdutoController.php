<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $produtos = Produto::all();

        return view('produtos.listagem', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $produtos = Produto::all();
        
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'processador' => 'required|string|max:255',
            'ram' => 'required|string|max:255',
            'armazenamento' => 'required|string|max:255',
            'tela' => 'required|string|max:255',
            'sistema' => 'required|string|max:255',
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.create')->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $this->authorize('product-edit');

        $produto = Produto::findOrFail($id);

        return view('produtos.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'processador' => 'required|string|max:255',
            'ram' => 'required|string|max:255',
            'armazenamento' => 'required|string|max:255',
            'tela' => 'required|string|max:255',
            'sistema' => 'required|string|max:255',
        ]);

        $produto = Produto::findOrFail($id);
        $produto->update($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    
        $this->authorize('product-delete');

        $produto = Produto::findOrFail($id);

        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto deletado com sucesso!');
    }
}
