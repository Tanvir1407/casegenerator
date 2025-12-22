<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - CasaGenerators</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="page-contact">
    @include('landing.sections.header')
    
    @include('pages.contact.sections.hero')
    
    @include('pages.contact.sections.contact-info')
    
    @include('pages.contact.sections.form-and-map')
    
    @include('landing.sections.footer')
    
    <script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>
