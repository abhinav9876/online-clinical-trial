@extends('layouts.app-smo')

@section('content')
    <header class="header">
        <h1 class="header__title">@lang('smo/posts.edit.header')</h1>
    </header>
    <section class="section">
        <form action="{{ route('update_smo_project_post', ['project_id' => $project_id, 'post_id' => $post->id]) }}" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            @include('smo.posts.form', ['post' => $post])
            <button type="submit" class="btn btn-primary">@lang('smo/posts.edit.submit')</button>
        </form>
    </section>
@endsection