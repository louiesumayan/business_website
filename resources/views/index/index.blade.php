@extends('index.home_master')

@section('content')

    @include('index.partials.slider')
    <!-- end hero -->
    @include('index.partials.feature')
    <!-- end content -->
    @include('index.partials.clarifies')
    <!-- end content -->
    @include('index.partials.financial')
    <!-- end content -->
    @include('index.partials.usability')
    <!-- end video -->
    @include('index.partials.testimontials')
    <!-- end testimonial -->

    @include('index.partials.faq')
    <!-- end faq -->

    @include('index.partials.money_management')

@endsection
