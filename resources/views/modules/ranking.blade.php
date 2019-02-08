@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Ranking @endsection


@section('content')
    <div class="container bg-white">

        <h2 class="pt-3"><i class="fa fa-list theme-text-color">&nbsp;</i>RANKING: <span class="badge badge-warning text-white">Top 50 Players</span> </h2>
        <hr>
        <div class="row">
            <div class="col-lg-12">

            <div class="table-responsive">
                <table class="table mt-3">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Class</th>
                        <th scope="col">Experience</th>
                        <th scope="col">Level</th>
                        <th scope="col">Kills</th>
                        <th scope="col">Deaths</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $c = 1; ?>
                        @foreach($ranking as $r) 
                            <tr chc0x2="{{$r->id}}">
                                <td> {{ $c++ }}</td>
                                <td><img src="{{ asset('/classes/' . $r->ctype_id . '.gif') }}"</td>
                                <td>{{ $r->name }}</td>
                                <td>{{ $r->Class }}</td>
                                <td><span class="badge badge-primary">{{ $r->exp }}</span></td>
                                <td>{{ $r->level }}</td>
                                <td><span class="badge badge-danger">{{ $r->kill_count }}</span></td>
                                <td><span class="badge badge-success">{{ $r->killed_count }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>  

            </div>
        </div>
    </div>
@endsection