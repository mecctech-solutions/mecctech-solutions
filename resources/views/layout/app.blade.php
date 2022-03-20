@extends('layout.app')

@section('app')
    <mecc-tech-header></mecc-tech-header>

    @yield('content')

    <footer class="fixed inset-x-0 bottom-0">
        <mecc-tech-footer></mecc-tech-footer>
    </footer>
@endsection
