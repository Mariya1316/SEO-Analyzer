@extends('layouts.app')

@section('title', 'Query history')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Response code</th>
            <th scope="col">Content length</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($domains as $domain)
        <tr>
            <th scope="row">{{ $domain->id }}</th>
            <td><a href="{{ route('showDomain', ['id' => $domain->id]) }}">{{ $domain->name }}</a></td>
            <td>{{ $domain->response_code }}</td>
            <td>{{ $domain->content_length }}</td>
            <td>{{ $domain->created_at }}</td>
            <td>{{ $domain->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $domains->links() }}
@endsection