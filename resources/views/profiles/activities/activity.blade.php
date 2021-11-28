<div class="card mb-5">
    <div class="card-header">
        <span class="flex">
            {!! $heading !!}
        </span>
    </div>
    <div class="card-body">
        <article>
            <div class="level">

                {{-- <a href="{{$thread->path()}}">--}}
                {{-- <strong>{{$thread->replies_count}} {{\Illuminate\Support\Str::plural('reply',$thread->replies_count)}}</strong>--}}
                {{--    </a>--}}
            </div>
            <p>
                {!! $body !!}
            </p>
        </article>
        <hr>
    </div>

</div>