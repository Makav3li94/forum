<div class="card mb-3">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a href="#">
                    {{$reply->owner->name}}
                </a>
                {{ " said " .$reply->created_at->diffForHumans()}}
            </h5>

            <div>

                <form method="post" action="{{route('reply_favorite',$reply->id)}}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-info"{{$reply->isFavorited() ? 'disabled' :''}}>
                        {{$reply->favorites()->count()}} {{\Illuminate\Support\Str::plural('Favorite',$reply->favorites()->count())}}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        <p>{!! $reply->body !!}</p>
    </div>
</div>