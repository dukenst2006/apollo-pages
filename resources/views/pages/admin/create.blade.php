@extends('apollo-pages::layouts.admin.master')

@section('content')

    <h1>Admin: Create Page</h1>

    <form method="POST" action="{{ route('admin.pages.store') }}">
        {{ csrf_field() }}

        @if (count($errors) > 0)
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label>Title:</label>
            <input type="text" name="title" value="{{ old('title') }}" autofocus />
        </div>

        <div>
            <label>Slug:</label>
            <input type="text" name="slug" value="{{ old('slug') }}" />
        </div>

        <div>
            <label>Parent page:</label>
            <input type="text" name="parent_id" value="{{ old('parent_id') }}" />
        </div>

        <div>
            <label>Body:</label>
            <textarea name="body" value="{{ old('body') }}" rows="10" cols="50"></textarea>
        </div>

        <div>
            <input type="submit" value="Submit">
            <a href="{{ route('admin.pages.index') }}">Cancel</a>
        </div>
    </form>

@endsection
