@extends('layouts.app')

@section('title', 'Main')

@section('content')
<div class="jumbotron .jumbotron-fluid">
    <div class="container-fluid">
        <h1 class="display-4">Free Website SEO Score</h1>
        <p class="lead">Explore any web page for SEO features.</p>
        <form method="post" action="{{ route('addDomain') }}">
            <div class="form-group">
                <label for="InputURL">Website URL</label>
                <input type="text" class="form-control col-3" id="InputURL" name="url"
                    placeholder="Example: http://site.com" value="{{ $url }}">
            </div>
            @if (isset($errorMessage))
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
            @endif
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection