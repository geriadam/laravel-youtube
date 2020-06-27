@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form action="">
                        <input type="text" name="search" class="form-control" placeholder="Search Videos and Channel">
                    </form>
                </div>
            </div>
            @if($channels->count() != 0)
                <div class="card mt-5">
                    <div class="card-header">
                        Channels
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>Link</th>
                            </thead>
                            <tbody>
                                @foreach($channels as $channel)
                                    <tr>
                                        <td>{{ $channel->name }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('channels.show', $channel->id) }}">
                                                View Channel
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row justify-content-center">
                            {!! $channels->append(request()->query())->links() !!}
                        </div>
                    </div>
                </div>
            @endif

            @if($videos->count() != 0)
                <div class="card mt-5">
                    <div class="card-header">
                        Videos
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Title</th>
                                <th>Link</th>
                            </thead>
                            <tbody>
                                @foreach($videos as $video)
                                    <tr>
                                        <td>{{ $video->title }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('video.show', $video->id) }}">
                                                View Video
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row justify-content-center">
                            {!! $videos->append(request()->query())->links() !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
