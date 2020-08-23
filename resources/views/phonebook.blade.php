@extends('app')
@section('content')

    <header ref="header">
        <header-component></header-component>
    </header>

    <main ref="container" class="container">
        <router-view></router-view>
    </main>

    <footer ref="footer" class="footer">
        <footer-component functional></footer-component>
    </footer>

@endsection