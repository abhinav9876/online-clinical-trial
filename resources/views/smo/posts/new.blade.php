@extends('layouts.app-smo')

@section('content')
    <header class="header">
        <h1 class="header__title">@lang('smo/posts.new.header')</h1>
    </header>
    <section class="section">
        <form action="{{ route('create_smo_project_post', ['project_id' => $project_id]) }}" method="POST">
            {{ csrf_field() }}
            @include('smo.posts.form', ['post' => $post])
            <button type="submit" class="btn btn-primary">@lang('smo/posts.new.submit')</button>
        </form>
    </section>
@endsection