@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create A New Threads') }}</div>

                    <div class="card-body">
                        <form action="{{route('threads.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">title</label>
                                <input type="text" value="{{old('title')}}" class="form-control" required name="title">
                            </div>

                            <div class="form-group">
                                <label for="title">Channel</label>
                                <select name="channel_id" class="form-control" id="channel_id" required>
                                    <option value="">Choose One</option>
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}"{{old('channel_id') == $channel->id ? 'selected' :''}}>{{$channel->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" required class="form-control" cols="30" rows="8">{{old('body')}}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @if(count($errors))
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
