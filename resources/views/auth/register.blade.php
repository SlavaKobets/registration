@extends('layouts.register')

@section('content')
    <form  method="POST" action="{{ route('register') }}">
        @csrf
        <example-component :errors="{{$errors}}" :countries="{{$countries}}"></example-component>
    </form>
@endsection
