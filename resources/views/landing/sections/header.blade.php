<header class="main-header">
    <div class="container">
        <nav class="navbar">
            <a href="/" class="logo">
                <img src="{{ asset('images/Logo/Casagenerators Logo.png') }}" alt="Casagenerators Logo" class="logo-image">
            </a>
            <ul class="nav-menu">
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('products-services') }}">Products & Services</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <li><a href="{{ route('awards') }}">Awards & Certificates</a></li>
                <li><a href="{{ route('faq') }}">FAQ</a></li>
                <li> <a href="{{ route('contact') }}" >
                            Contact
                    </a></li>
            </ul>
            <a href="{{ route('home') }}#contact-form" class="btn btn-primary">Request a Quote</a>
        </nav>
    </div>
</header>
