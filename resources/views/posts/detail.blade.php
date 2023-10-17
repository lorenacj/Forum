@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-center text-mute"> {{ __('Respuestas al debate :name', ['name' => $post->title]) }} </h1>

            <h4>{{ __('Autor del debate') }}: {{ $post->owner->name }}</h4>

            <a href="../forums/{{ $post->forum->id }}" class="btn btn-info pull-right">
                {{ __('Volver al foro :name', ['name' => $post->forum->name]) }}
            </a>

            <div class="clearfix"></div>

            <br />
            @forelse($replies as $reply)
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-reply">
                        <p>{{ __('Respuesta de') }}: {{ $reply->autor->name }}</p>
                    </div>

                    <div class="panel-body">
                        {{ $reply->reply }}
                    </div>
                </div>

            @empty

                <div class="alert alert-danger">
                    {{ __('No hay ninguna respuesta en este momento') }}
                </div>
            @endforelse

            @if ($replies->count())
                {{ $replies->links() }}
            @endif

            @Logged()
            <h3 class="text-muted">{{ __("Añadir un nueva respuesta al post :name", ['name' => $post->name]) }}</h3>
            @include('partials.errors')
            <form method="POST" action="../replys">
                {{ csrf_field() }}
                <input type="hidden" name="post_id" value="{{ $post->id }}"/>

                <div class="form-group">
                    <label for="title" class="col-md-12 control-label">{{ __("Título") }}</label>
                    <input id="title" class="form-control" name="title" value="{{ old('title') }}"/>
                </div>

                <div class="form-group">
                    <label for="description" class="col-md-12 control-label">{{ __("Descripción") }}</label>
                    <textarea id="description" class="form-control"
                              name="description">{{ old('description') }}</textarea>
                </div>

                 <button type="submit" name="addReply" class="btn btn-default">{{ __("Añadir reply") }}</button>
            </form>
            @else
                @include('partials.login_link', ['message' => __('Inicia sesión para crear una respuesta')])
            @endLogged
        </div>
    </div>
@endsection
