@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Refactor category</h1> &nbsp; <strong>
                <a href="{{ route('admin.categories.index') }}">Categories list</a></strong>
        </div>

        <!-- Content Row -->
        <div>
            @if($errors->any())
                @foreach($errors->all() as $err)
                    <div class="alert alert-danger">
                        {{ $err }}
                    </div>
                @endforeach
            @endif
            <form action="{{ route('admin.categories.update', ['category' => $category]) }}" method="POST">
                {{--            Подписывает нашу форму, генерирует скрытое поле с токеном --}}
                @csrf
                @method('PUT')
                <div class="col-8">
                    <div class="form-group">
                        <label for="title">Category name</label>
                        <input type="text" class="form-control" placeholder="title" name="title" value="{{ $category->title }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description">{{ $category->description }}</textarea>
                        <br>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
