@extends('layout.app')
@section('content')
    @include('component.MenuBar')
    @include('component.WishList')
    @include('component.Footer')
    <script>
        (async () => {
            await WishList();
            await Category();
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        })()
    </script>
@endsection





