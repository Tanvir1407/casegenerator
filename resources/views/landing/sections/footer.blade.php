<footer class="main-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-column">
                <div class="footer-logo">
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('images/Logo/Casagenerators Logo (1).png') }}" alt="CasaGenerators Logo" class="logo-image">
                    </a>
                </div>
                <div class="footer-links-group">
                    <ul>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('services') }}">Business Sectors</a></li>
                        <li><a href="{{ route('about') }}#team">Our Team</a></li>
                        <li><a href="{{ route('about') }}#story">Our History</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-column">
                <h4>Products</h4>
                <ul>
                    <li><a href="{{ route('products.index') }}">Generators</a></li>
                    <li><a href="{{ route('services') }}#industries">Applications</a></li>
                    <li><a href="{{ route('products.index') }}">Brands</a></li>
                    <li><a href="{{ route('services') }}">Technologies</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="{{ route('services') }}">Rental</a></li>
                    <li><a href="{{ route('services') }}">Maintenance</a></li>
                    <li><a href="{{ route('services') }}">After-Sales Service</a></li>
                    <li><a href="{{ route('services') }}">Consulting</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Resources</h4>
                <ul>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ route('projects.index') }}">Case Studies</a></li>
                    <li><a href="{{ route('awards') }}">Awards & Certificates</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Contact Us</h4>
                <div class="contact-info">
                    <p><strong>Phone:</strong> <a href="tel:+97165300388">+971 6 5300388</a></p>
                    <p><strong>Mobile:</strong> <a href="tel:+971509624999">+971 50 9624999</a></p>
                    <p><strong>Email:</strong> <a href="mailto:casa@casagenerators.com">casa@casagenerators.com</a></p>
                    <p><strong>Address:</strong> P.O. Box 63231, Sharjah, UAE</p>
                </div>
                <div class="social-links">
                    <a href="https://www.facebook.com/casagenerators" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/company/casagenerators" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; 2026 CasaGenerators. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="{{ route('contact') }}">Privacy Policy</a>
                    <a href="{{ route('contact') }}">Terms & Conditions</a>
                    <a href="{{ route('contact') }}">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>

</footer>
