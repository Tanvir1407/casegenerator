<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CasaGenerators - Customised Energy Solutions</title>
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
