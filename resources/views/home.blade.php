@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>Date</th>
                            <th>Content</th>
                            <th>Amount</th>
                            <th>Type</th>
                        </tr>
                        @foreach($transaction as $t)
                            <tr>
                                <td>{{date('d/m/Y H:s:i', strtotime($t->date))}}</td>
                                <td>{{$t->content}}</td>
                                <td>{{number_format($t->amount)}}</td>
                                <td>{{$t->type}}</td>
                            </tr>
                        @endforeach
                        @if(count($transaction) == 0)
                            <tr>
                                <td colspan="4">Empty Data</td>
                            </tr>
                        @endif
                    </table>

                    {{$transaction->onEachSide(1)->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
