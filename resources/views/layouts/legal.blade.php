@extends('layouts.app')

@section('content')

<section class="legal-wrapper">
    <div class="legal-card">

        <h1 class="legal-title">@yield('legal_title')</h1>

        <p class="legal-intro">
            @yield('legal_intro')
        </p>

        <div class="legal-content">
            @yield('legal_content')
        </div>

    </div>
</section>

@endsection
