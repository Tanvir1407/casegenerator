<section class="contact-two-column-section">
    <div class="container">
        <div class="section-header  text-center">
            <h2 class="cat-section-title">Request a Quote</h2>
            <p class="section-subtitle">We’re here to help with quotes, support, and general inquiries.</p>
        </div>

        <div class="contact-grid">
            <div class="contact-form-card">
                <form class="contact-form-light" action="{{ route('contact') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input id="name" type="text" name="name" placeholder="Your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email*</label>
                            <input type="email" id="email" name="email" placeholder="Email" required>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" placeholder="Phone">
                        </div>
                        <div class="form-group">
                                <label for="industry">Select Your Industry</label>
                                <select id="industry" name="industry">
                                    <option value="">Select Your Industry</option>
                                    <option value="construction">Construction</option>
                                    <option value="manufacturing">Manufacturing</option>
                                    <option value="healthcare">Healthcare</option>
                                    <option value="hospitality">Hospitality</option>
                                    <option value="residential">Residential</option>
                                    <option value="commercial">Commercial</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="4" placeholder="Additional Details!"></textarea>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Quote Request</button>
                </form>
            </div>

            <div class="contact-map-cards">
                           <img src="{{ asset('images/Product_Services/2-3-1-1.png') }}" alt="Company Brochure" class="company-brochure">

                <section class="faq-contact-section">
    <div class="container">
        <div class="faq-support-card">
            <div class="support-content">
                <h2 class="support-title">Dedicated Customer Teams & An Agile Services</h2>
                <p class="support-text">Our worldwide presence ensures the timeliness, cost efficiency and compliance adherence required to ensure your production timelines are met.</p>
            </div>
            <div class="section-action">
                <a href="{{ asset('images/Product_Services/Company-Brochure.pdf') }}" download class="btn btn-primary btn-large">
                    Download Brochure
                    <i class="fa-solid fa-download"></i>
                </a>
            </div>
        </div>
    </div>
</section>


                {{-- <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968524467!3d40.74844097932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1589393673991!5m2!1sen!2sus" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div> --}}
            </div>
        </div>
    </div>
</section>