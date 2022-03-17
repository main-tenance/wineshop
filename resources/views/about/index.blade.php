@extends('layouts.my-app')

@section('title', 'About')

@section('content')
<h1>{{__('about.h1')}}</h1>
<div class="about-page page_content">
    <img src="/images/about.jpg" width="500px" class="leftimg" style="margin-top: 0.2em">
    <div>
        @foreach(__('about.paragraphs') as $p)
            <p>{{$p}}</p>
        @endforeach
    </div>
</div>
@endsection
