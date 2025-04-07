@extends('layouts.app')

@php
  $hideHeader = true;
@endphp
 
@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}" />
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
@endsection 

@section('content')

 <div class="container">
        <div class="message">
            <p class="contact-thank-you">お問い合わせありがとうございました</p>
        </div>
        <div class="thank-you-background">
            <p class="thank-you-text">Thank you</p>
        </div>
        <a href="{{ url('/') }}" class="home-button">HOME</a>
    </div>

@endsection