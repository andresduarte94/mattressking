@extends('layouts.app')

@section('content')
    <div style="width: 80%" class="mx-auto mt-3 ">
        <ul class="nav nav-pills mb-3 bg-dark text-white nav-justified rounded" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link @if($data['active'] == 0) active @endif" id="pills-productos-tab" data-toggle="pill" href="#pills-productos" role="tab" aria-controls="pills-home" aria-selected="true">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($data['active'] == 1) active @endif" id="pills-usuarios-tab" data-toggle="pill" href="#pills-usuarios" role="tab" aria-controls="pills-profile" aria-selected="false">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($data['active'] == 2) active @endif" id="pills-categoria-tab" data-toggle="pill" href="#pills-categoria" role="tab" aria-controls="pills-contact" aria-selected="false">Categorias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($data['active'] == 3) active @endif" id="pills-subcategoria-tab" data-toggle="pill" href="#pills-subcategoria" role="tab" aria-controls="pills-contact" aria-selected="false">Subcategorias</a>
            </li>
        </ul>
        <div class="tab-content" style="margin-top: -1.5%" id="pills-tabContent">
            <div class="tab-pane fade @if($data['active'] == 0) show active @endif" id="pills-productos" role="tabpanel" aria-labelledby="pills-home-tab">@include('admin.productos')</div>
            <div class="tab-pane fade @if($data['active'] == 1) show active @endif" id="pills-usuarios" role="tabpanel" aria-labelledby="pills-profile-tab">@include('admin.users')</div>
            <div class="tab-pane fade @if($data['active'] == 2) show active @endif" id="pills-categoria" role="tabpanel" aria-labelledby="pills-contact-tab">@include('admin.categorias')</div>
            <div class="tab-pane fade @if($data['active'] == 3) show active @endif" id="pills-subcategoria" role="tabpanel" aria-labelledby="pills-contact-tab">@include('admin.subcategorias')</div>
        </div>
    </div>
@endsection