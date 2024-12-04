@extends('layouts.app')

@section('title', 'Tabela de Produtos')

@section('content')
<div class="container mt-5">

    <h1 class="text-black fw-bold text-center mb-4">Tabela de Produtos</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive bg-white p-4 rounded shadow" style="max-height: 500px; overflow-y: auto; overflow-x: auto;">
        <table class="table table-bordered text-center align-middle">
            <thead class="bg-black text-secondary">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Processador</th>
                    <th scope="col">RAM</th>
                    <th scope="col">Armazenamento</th>
                    <th scope="col">Tela</th>
                    <th scope="col">Sistema</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>
                        <td>{{ $produto->nome }}</td>
                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td>{{ $produto->quantidade }}</td>
                        <td>{{ $produto->marca }}</td>
                        <td>{{ $produto->modelo }}</td>
                        <td>{{ $produto->processador }}</td>
                        <td>{{ $produto->ram }}</td>
                        <td>{{ $produto->armazenamento }}</td>
                        <td>{{ $produto->tela }}</td>
                        <td>{{ $produto->sistema }}</td>
                        <td>
                         
                            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-dark btn-sm text-white w-100 mb-2" style="min-width: 100px;">Editar</a>
                            <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100" style="min-width: 100px;">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">Nenhum produto cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
