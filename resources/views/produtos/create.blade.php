@extends('layouts.app')

@section('title', 'Cadastrar Produto')

@section('content')
<div class="container mt-5">

    <div class="form-box bg-white p-4 rounded shadow-sm" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
        <h1 class="text-dark fw-bold text-center mb-4" style="font-family: 'Arial', sans-serif;">Cadastrar Produto</h1>
        <hr class="my-4" style="border-top: 2px solid #ced4da;">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('produtos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nome" class="fw-bold form-label text-secondary">Nome do Produto:</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Ex: Notebook Dell Inspiron" required>
            </div>
            <div class="mb-3">
                <label for="preco" class="fw-bold form-label text-secondary">Preço:</label>
                <input type="number" id="preco" name="preco" class="form-control" step="0.01" placeholder="Ex: 4500.00" required>
            </div>
            <div class="mb-3">
                <label for="quantidade" class="fw-bold form-label text-secondary">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" class="form-control" placeholder="Ex: 5" required>
            </div>
            <div class="mb-3">
                <label for="marca" class="fw-bold form-label text-secondary">Marca:</label>
                <input type="text" id="marca" name="marca" class="form-control" placeholder="Ex: Dell" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="fw-bold form-label text-secondary">Modelo:</label>
                <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Ex: Inspiron 15 3000" required>
            </div>
            <div class="mb-3">
                <label for="processador" class="fw-bold form-label text-secondary">Processador:</label>
                <input type="text" id="processador" name="processador" class="form-control" placeholder="Ex: Intel Core i7" required>
            </div>
            <div class="mb-3">
                <label for="ram" class="fw-bold form-label text-secondary">Memória RAM:</label>
                <input type="text" id="ram" name="ram" class="form-control" placeholder="Ex: 16GB" required>
            </div>
            <div class="mb-3">
                <label for="armazenamento" class="fw-bold form-label text-secondary">Armazenamento:</label>
                <input type="text" id="armazenamento" name="armazenamento" class="form-control" placeholder="Ex: SSD 512GB" required>
            </div>
            <div class="mb-3">
                <label for="tela" class="fw-bold form-label text-secondary">Tamanho da Tela:</label>
                <input type="text" id="tela" name="tela" class="form-control" placeholder="Ex: 15.6 polegadas" required>
            </div>
            <div class="mb-3">
                <label for="sistema" class="fw-bold form-label text-secondary">Sistema Operacional:</label>
                <input type="text" id="sistema" name="sistema" class="form-control" placeholder="Ex: Windows 11" required>
            </div>

            <!-- Botão centralizado -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-dark fw-bold w-100">Cadastrar Produto</button>
            </div>
        </form>
    </div>
</div>
@endsection
