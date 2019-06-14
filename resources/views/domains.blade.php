@extends('layouts.app')

@section('title', 'All domains')

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
        @foreach ($domains as $domain)
        <tr>
            <th scope="row">{{ $domain->id }}</th>
            <td><a href="{{ route('showDomain', ['id' => $domain->id]) }}">{{ $domain->name }}</a></td>
            <td>{{ $domain->created_at }}</td>
            <td>{{ $domain->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $domains->links() }}
@endsection