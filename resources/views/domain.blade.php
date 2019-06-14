@extends('layouts.app')

@section('title', 'Domain')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">created_at</th>
            <th scope="col">updated_at</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{ $domain->id }}</th>
            <td>{{ $domain->name }}</td>
            <td>{{ $domain->created_at }}</td>
            <td>{{ $domain->updated_at }}</td>
        </tr>
    </tbody>
</table>
@endsection