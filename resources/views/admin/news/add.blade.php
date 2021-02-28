@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add news</h1> &nbsp; <strong>
                <a href="{{ route('admin.news.index') }}">News list</a></strong>
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
            <form action="{{ route('admin.news.store') }}" method="POST">
                {{--            Подписывает нашу форму, генерирует скрытое поле с токеном --}}
                @csrf
                <div class="col-8">
                    <div class="form-group">
                        <label for="categories">Categories</label>
                        <select class="form-control" name="category_id" id="categories">
                            <option value="">Choose</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">News title</label>
                        <input type="text" class="form-control" id="title" placeholder="title" name="title"
                               value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="description">News description</label>
                        <textarea class="form-control" id="description"
                                  name="description">{{ old('description') }}</textarea>

                    </div>
                    <div class="form-group">
                        <label for="img">News image</label>
                        <input type="file" class="form-control" id="img" placeholder="title" name="image">
                    </div>
                    <div class="form-group">
                        <label for="statuses">News statuses</label>
                        <select class="form-control" name="status" id="statuses">
                            <option value="">Choose</option>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Save</button>

                </div>
            </form>
        </div>
    </div>
@endsection
