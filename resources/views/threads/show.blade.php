@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row  mb-3">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <a href="">{{$thread->creator->name}}</a>
                        {{ __('Threads') }}
                    </div>

                    <div class="card-body">
                        <h1>{{$thread->title}}</h1>
                        <p>{!! $thread->body !!}</p>

                    </div>

                </div>
                @foreach($thread->replies as $reply)
                    @include("threads.reply")
                @endforeach

                {{$replies->links()}}

                @auth()
                    <form action="{{route('add_reply',[$thread->id,$thread->channel->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body" placeholder="Add a reply" id="" cols="30" rows="10"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>

                @elseauth()
                    <p>Please sign in to reply</p>
                @endauth
            </div>

            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <p>
                            This thread was created at {{$thread->created_at->diffForHumans()}} by <a href="">{{$thread->creator->name}}</a> and currently
                            has {{$thread->replies_count}} {{\Illuminate\Support\Str::plural('comment',$thread->replies_count)}}.
                        </p>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
