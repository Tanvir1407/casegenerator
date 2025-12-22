<section class="contact-two-column-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Get In Touch</h2>
            <div class="section-divider"></div>
            <p class="section-subtitle">We’re here to help with quotes, support, and general inquiries.</p>
        </div>

        <div class="contact-grid">
            <div class="contact-form-card">
                <form class="contact-form-light" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name" placeholder="Your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" placeholder="you@example.com" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input id="phone" type="tel" name="phone" placeholder="Optional">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input id="subject" type="text" name="subject" placeholder="How can we help?">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Write your message here" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>

            <div class="contact-map-card">
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968524467!3d40.74844097932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1589393673991!5m2!1sen!2sus" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>