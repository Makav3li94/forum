@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @forelse($threads as $key=> $thread)
                <div class="card mb-5">
                    <div class="card-header">
                        <div class="level">
                            <h4 class="flex">
                                <a href="{{$thread->path()}}">{{$thread->title}}</a>
                            </h4>
                            <a href="{{$thread->path()}}">
                                <strong>{{$thread->replies_count}} {{\Illuminate\Support\Str::plural('reply',$thread->replies_count)}}</strong>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                                <p>
                                    {!! $thread->body !!}
                                </p>

                    </div>

                </div>
                @empty
                    No Threads
                @endforelse
            </div>
        </div>
    </div>
@endsection
