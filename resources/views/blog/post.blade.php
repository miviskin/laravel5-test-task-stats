@extends('layouts.blog')

@section('app.title', 'Home')

@section('blog.content')
    <div class="blog-post">
        <h2 class="blog-post-title">{{ $title or 'Main' }}</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc feugiat, elit ut auctor dignissim, quam augue cursus elit, ut egestas tellus nisi ut nisl. Duis eget orci quis ipsum commodo scelerisque. Sed consectetur sapien orci, vitae tincidunt dolor luctus nec. Phasellus at feugiat mauris. Maecenas maximus venenatis nibh. Phasellus quis pretium elit, in hendrerit nisl. Sed ac nisl vitae enim ultricies pharetra et eget mi.</p>
        <ul>
            <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
            <li>Donec id elit non mi porta gravida at eget metus.</li>
            <li>Nulla vitae elit libero, a pharetra augue.</li>
        </ul>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
    </div><!-- /.blog-post -->
@endsection
