@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{$profileUser->name}}
                        <small>Since {{$profileUser->created_at->diffForHumans()}}</small>
                    </div>


                    <div class="card-body">
                        @forelse($threads as $thread)
                            <article>
                                <div class="level">
                                    <h4 class="flex">
                                        <a href="{{$thread->path()}}">{{$thread->title}}</a>
                                    </h4>
                                    <a href="{{$thread->path()}}">
                                        <strong>{{$thread->replies_count}} {{\Illuminate\Support\Str::plural('reply',$thread->replies_count)}}</strong>
                                    </a>
                                </div>
                                <p>
                                    {!! $thread->body !!}
                                </p>
                            </article>
                            <hr>
                        @empty
                            No Threads
                        @endforelse
                        {!! $threads->links() !!}
                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection