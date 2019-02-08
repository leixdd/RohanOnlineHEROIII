@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Rewards @endsection

@section('content')

    <div class="d-flex justify-content-center mb-5">
        <div class="container bg-white col-10">

            <h2 class="pt-3"><i class="fa fa-user theme-text-color">&nbsp;</i> Invitation Rewards </h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mt-3">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">Reward Name</th>
                                    <th scope="col">Reward</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="model-table-body">
                                    @foreach($rewards as $reward)
                                        <tr>
                                            <td><b>{{ $reward->reward_name }}</b> [ {{ $reward->reward_desc }} ]</td>
                                            <td>[ {{ $reward->rewards }} ]</td>
                                            <td>
                                                @if($reward->countReward == 0)
                                                    <button class="btn bg-dark text-warning btn-sm" onclick="" ><span class="fa fa-gift">&nbsp;</span> Get Reward</button>
                                                @else
                                                    Already Received 
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        
                            
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>

@endsection