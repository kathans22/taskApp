@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Todos App</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <a href="{{ url()->previous() ?? route('todos.index') }}" class="btn btn-sm btn-info">
                            Go Back
                        </a>
                        <br>
                        <b> your Todo title is: </b> {{ $todo->title }} <br>
                        <b>Your Todo description</b> {{ $todo->description }}



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
