@extends('layouts.register')

@section('content')
    <result-component :result="'{{$result['success']}}'" :error="'{{$result['error'] ?? ''}}'" :user="'{{$result['user'] ?? ''}}'"></result-component>
@endsection
