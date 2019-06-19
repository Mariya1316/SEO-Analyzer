@extends('layouts.app')

@section('title', 'Domain')

@section('content')
<table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Response code</th>
            <th scope="col">Content length</th>
            <th scope="col">Heading h1</th>
            <th scope="col">Keywords</th>
            <th scope="col">Description</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{ $domain->id }}</th>
            <td>{{ $domain->name }}</td>
            <td>{{ $domain->response_code }}</td>
            <td>{{ $domain->content_length }}</td>
            <td>{{ $domain->h1 }}</td>
            <td>{{ $domain->keywords }}</td>
            <td>{{ $domain->description }}</td>
            <td>{{ $domain->created_at }}</td>
            <td>{{ $domain->updated_at }}</td>
        </tr>
    </tbody>
</table>
@endsection