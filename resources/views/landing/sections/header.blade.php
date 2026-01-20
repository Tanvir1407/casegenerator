<header class="main-header">
    <div class="container">
        <nav class="navbar">
            <a href="/" class="logo">
                <img src="{{ asset('images/Logo/Casagenerators Logo (1).png') }}" alt="Casagenerators Logo" class="logo-image">
            </a>
            <ul class="nav-menu">
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a href="{{ route('services') }}">Services</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <li><a href="{{ route('awards') }}">Awards & Certificates</a></li>
                <li><a href="{{ route('faq') }}">FAQ</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <div class="nav-actions">
                <a href="{{ route('home') }}#contact-form" class="btn btn-primary">Request a Quote</a>
                <button class="mobile-menu-toggle" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </nav>
    </div>
</header>

