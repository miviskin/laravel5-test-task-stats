@extends('layouts.app')

@section('app.title', 'Блог')

@section('app.content')

    <div class="blog-masthead">
        <div class="container">
            <nav class="blog-nav">
                <a class="blog-nav-item active" href="/">Home</a>
                <a class="blog-nav-item" href="/admin">Admin</a>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="blog-header">
            <h1 class="blog-title">Site name</h1>
            <p class="lead blog-description">site description</p>
        </div>

        <div class="row">

            <div class="col-sm-8 blog-main">

                @yield('blog.content')

            </div><!-- /.blog-main -->

            <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
                <div class="sidebar-module">
                    <h4>Pages</h4>
                    <ol class="list-unstyled">
                        <li><a href="/page/one">One</a></li>
                        <li><a href="/page/two">Two</a></li>
                        <li><a href="/page/three">Three</a></li>
                        <li><a href="/page/four">Four</a></li>
                        <li><a href="/page/five">Five</a></li>
                        <li><a href="/page/six">Six</a></li>
                        <li><a href="/page/seven">Seven</a></li>
                        <li><a href="/page/eight">Eight</a></li>
                        <li><a href="/page/nine">Nine</a></li>
                        <li><a href="/page/ten">Ten</a></li>
                        <li><a href="/page/eleven">Eleven</a></li>
                        <li><a href="/page/twelve">Twelve</a></li>
                    </ol>
                </div>
            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->
    </div><!-- /.container -->

    <footer class="blog-footer">
        <p>
            <a href="#">Back to top</a>
        </p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
