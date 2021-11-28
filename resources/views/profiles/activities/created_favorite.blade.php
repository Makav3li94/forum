@component("profiles.activities.activity")
    @slot('heading')
        <a href="{{$activity->subject->favorited->path()}}">
            {{$profileUser->name}} Favorited a reply
        </a>
    @endslot

    @slot('body')
        {!! $activity->subject->favorited->body !!}
    @endslot
@endcomponent

