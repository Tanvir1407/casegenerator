<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best power generators Dubai - Electrical generators</title>
    <meta name="description" content="best power generators Dubai, generator service, generator uae, generator">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="Best power generators Dubai - Electrical generators" />
    <meta property="og:description" content="best power generators Dubai, generator service, generator uae, generator" />
    <meta property="og:image" content="https://casagenerators.com/images/A4-v1-724x1024.jpg" />
    <meta property="og:image:width" content="724" />
    <meta property="og:image:height" content="1024" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Best power generators Dubai - Electrical generators" />
    <meta name="twitter:description" content="best power generators Dubai, generator service, generator uae, generator" />
    <meta name="twitter:image" content="https://casagenerators.com/images/A4-v1-724x1024.jpg" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    @include('landing.sections.header')
    
    @include('landing.sections.hero')

    @include('landing.sections.partners')
    
    @include('landing.sections.experience')
    
    @include('landing.sections.tailor-made')
    
    @include('landing.sections.generator-products')

    @include('landing.sections.why-choose-us')

     {{-- @include('landing.sections.industries') --}}
    
    @include('landing.sections.blog-cases', ['posts' => $posts])
    
    <!-- @include('landing.sections.after-sales') -->
    
    @include('landing.sections.contact-form')
    
    {{-- @include('landing.sections.newsletter') --}}
    
    @include('landing.sections.footer')
    
    <script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>
