@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Selling Character @endsection

@section('content')

    <div class="d-flex justify-content-center mb-5">
        <div class="container bg-white col-10">

            <h2 class="pt-3"><i class="fa fa-user theme-text-color">&nbsp;</i>Selling Character</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">

                    <h4><i>Character Information</i></h4>
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
                                @foreach($Character as $r) 
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
                    
                    <div class="card mt-3">
                        <div class="card-header text-warning bg-dark">Selling Information</div>
                        <div class="card-body">

                            @if(Session::has('ErrorMessage'))
                                <div class="alert alert-danger">
                                    {{ Session::get('ErrorMessage') }}
                                </div>
                            @endif
                            
                            <form method="post" action="/User/sellCharacter">
                                @csrf
                                
                                <input type="text" hidden value="{{ STR_ENC::exec('encrypt', $Character[0]->id) }}" name="0xCH" />

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input class="form-control" name="char_price" required type="number"/>
                                </div>

                                <div class="form-group">
                                    <label for="description">Character Description</label>
                                    <textarea maxlength="50" class="form-control" name="char_description" required type="text"></textarea>
                                </div>

                                <input type="submit" value="Sell this Character" class="btn btn-lg bg-dark text-warning mb-3"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection