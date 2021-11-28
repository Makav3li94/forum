<div id="reply-{{$reply->id}}" class="card mb-3">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a href="{{route('user_profile',$reply->owner->name)}}">
                    {{$reply->owner->name}}
                </a>
                {{ " said " .$reply->created_at->diffForHumans()}}
            </h5>

            <div>
                @auth()

                    <form method="post" action="{{route('reply_favorite',$reply->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-info"{{$reply->isFavorited() ? 'disabled' :''}}>
                            {{$reply->favorites_count}} {{\Illuminate\Support\Str::plural('Favorite',$reply->favorites_count)}}
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>

    <div class="card-body">
        <p>{!! $reply->body !!}</p>
    </div>

    @can('delete',$reply)
        <div class="card-footer">
            <form action="{{route('replies.destroy',$reply->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </div>
    @endcan
</div>