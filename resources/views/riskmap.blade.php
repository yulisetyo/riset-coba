@extends('layouts.master')

@section('title', 'Zigzag Bar')

@section('content')
<table class="" style="border:1px solid #000000;">
    <tbody>
        <tr>{!! $td1 !!}</tr>
        <tr>{!! $td2 !!}</tr>\
        <tr>{{-- $td3 --}}</tr>
        <tr>{{-- $td4 --}}</tr>
        <tr>{{-- $td5 --}}</tr>
    </tbody>
</table>
@endsection