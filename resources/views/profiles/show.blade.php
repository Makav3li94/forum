@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>
                    {{$profileUser->name}}
                    <small>Since {{$profileUser->created_at ? $profileUser->created_at->diffForHumans() : ''}}</small>
                </h2>
                <hr>
                @forelse($activities as $date => $activity)
                    <h3 class="">{{$date}}</h3>
                    @foreach($activity as $record )
                        @if(view()->exists("profiles.activities.{$record->type}"))
                            @include("profiles.activities.{$record->type}",['activity'=> $record])
                        @endif
                    @endforeach
                @empty
                    No Activity
                @endforelse
                {{--                {!! $activities->subject->links() !!}--}}


            </div>

        </div>
    </div>


@endsection