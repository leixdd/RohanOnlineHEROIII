@extends('templates.IndexTemplate')


@section('title') ROHAN WORLD | News @endsection


@section('content')

    <div class="container-fluid">
        <div class="row">
            
            <div class="col-3">
                <div class="card card-primary" style="border: 0">
                    <div class="card-header bg-dark text-warning"><b>List of News and Announcements</b></div>
                    <div class="card-body">
                        @foreach($cms as $c) 
                            <a href="/news/{{STR_ENC::exec('encrypt', $c->id )}}" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1">{{ $c->post_title }}</h5>
                                    <small>{{ $c->created_at }}</small>
                                </div>
                                <small>Posted by: Game Master</small>
                            </a>
                        @endforeach
                    </div>
                    
                </div>
            </div>

            <div class="col-9">
                <div class="card card-primary">
                    <div class="card-body">
                        <h1>{{ $news[0]->post_title }}</h1>
                        <small>Posted by: Game Master, {{ $news[0]->created_at }}</small>
                        <hr>
                        <p>{!! $news[0]->post_content !!}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection