<div class="card mb-3">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a href="{{route('user_profile',$reply->owner->name)}}">
                    {{$reply->owner->name}}
                </a>
                {{ " said " .$reply->created_at->diffForHumans()}}
            </h5>

            <div>

                <form method="post" action="{{route('reply_favorite',$reply->id)}}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-info"{{$reply->isFavorited() ? 'disabled' :''}}>
                        {{$reply->favorites_count}} {{\Illuminate\Support\Str::plural('Favorite',$reply->favorites_count)}}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        <p>{!! $reply->body !!}</p>
    </div>
</div>