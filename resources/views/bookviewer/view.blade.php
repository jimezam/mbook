@extends('layouts.book')

@php
    $bookmarked = $mbook->isBookmarkedBy(Auth::user());
@endphp

@include('mbooks.bookmark_script')

@section('content')

    @include('default.views.index')

@stop