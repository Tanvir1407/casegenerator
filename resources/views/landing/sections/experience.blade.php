<section class="experience-section">
    <div class="container-experience">
        <div class="experience-content-wrapper">
            <!-- Left Column: Image with Floating Badge -->
            <div class="experience-left">
                <!-- Decorative Elements from Screenshot -->
                <div class="quote-icon">“</div>
                <div class="floating-ring-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>

                <div class="experience-header-image">
                    <img src="{{ asset('images/landing/generator_1.webp') }}" alt="Leading Diesel Generator Team" class="professional-image">
                    
                    <!-- Floating Stats Badge (Screenshot Style) -->
                    <div class="floating-stat-card">
                        <div class="stat-card-header">
                            <div class="stat-card-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <circle cx="12" cy="12" r="10"></circle>
  <polyline points="12 6 12 12 16 14"></polyline>
</svg>

                            </div>
                            <div class="stat-card-value">24/7</div>
                        </div>
                        <div class="stat-card-divider"></div>
                        <div class="stat-card-text">
                            <strong>Highly</strong> <br> Technical Support <br> All Customers
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Content -->
            <div class="experience-right">
                <p class="section-subtitle">Our Services</p>
                
                <h2 class="section-title">Leading Diesel Generator<br>
                    Serving <span class="highlight-text">since 2008</span>
                </h2>
                
                <div class="section-description-wrapper">
                    <p class="section-description">
                        Casablanca Electrical Generators & Equipment Trading is a leading company in the field of power generators, based in the UAE. We are an authorised Perkins-UK/ Cummins-UK reseller and distributor of all sizes of diesel power generators inside and outside of the UAE. Our diesel generators come in a large variety of sizes ranging from 9 KVA to 2000KVA and feature big power with low emission levels and world-class fuel efficiency for prime, continuous, and standby applications.
                    </p>
                 
                </div>
                
                <!-- Tabs Navigation -->
                <div class="tabs-navigation">
                    <button class="tab-btn active" data-tab="tab1">Our Vision</button>
                    <button class="tab-btn" data-tab="tab2">Power Leaders</button>
                    <button class="tab-btn" data-tab="tab3">After-Sales</button>
                    <button class="tab-btn" data-tab="tab4">Authorized Partner</button>
                     <button class="tab-btn" data-tab="tab5">Quality Solutions</button>
                </div>
                
                <!-- Tabs Content -->
                <div class="tabs-content">
                    <div class="tab-panel active" id="tab1">
                        <p>We were born in UAE and became one of the Leading companies in the same field.We are an authorised Perkins-UK/ Cummins-UK reseller and distributor of all sizes of diesel power generators inside and outside of the UAE.</p>
                    </div>
                    
                    <div class="tab-panel" id="tab2">
                        <p>Our diesel generators come in a large variety of sizes ranging from 9 KVA to 2000KVA and feature big power with low emission levels and world-class fuel efficiency.</p>
                    </div>
                    
                    <div class="tab-panel" id="tab3">
                        <p>Well known for its after sales services by offering up to Two year warranty and highly trained maintenance team 24 hours 7 days a week.</p>
                    </div>
                    
                    <div class="tab-panel" id="tab4">
                        <p>We are an authorised Perkins-UK/ Cummins-UK reseller and distributor of all sizes of diesel power generators inside and outside of the UAE.
                           Manufactures High Quality Power Generators & Equipment Trading Services</p>
                    </div>
                     <div class="tab-panel" id="tab5">
                        <p>Our list of clients includes government and semi-government organisations as well as high-profile big contracting companies in the UAE. We are confident our company will meet your requirements, and look forward to doing business with your company.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.container-experience {
    max-width: 1800px;
    margin-left: 0;
    padding: 0 60px;
}

.experience-section {
    padding: 140px 0;
    background: #fff;
    font-family: 'Inter', sans-serif;
}

.experience-content-wrapper {
    display: grid;
    grid-template-columns: 0.9fr 1.1fr;
    gap: 120px;
    align-items: center;
    margin-bottom: 60px;
}

/* Left Column */
.experience-left {
    position: relative;
    padding-top: 20px;
    padding-left: 20px;
}

.experience-header-image {
    position: relative;
    border-radius: 40px; /* More rounded like the screenshot */
    z-index: 1;
}

/* Offset Background Plate (Matches the green shape in screenshot) */
.experience-header-image::before {
    content: '';
    position: absolute;
    top: -15px;
    left: -15px;
    width: 100%;
    height: 100%;
    background: var(--primary-color);
    border-radius: 40px;
    z-index: -1;
    transform: rotate(-3deg);
    opacity: 1;
    animation: plateFloat 6s ease-in-out infinite alternate;
}

@keyframes plateFloat {
    0% {
        transform: rotate(-3deg) translateY(0);
    }
    100% {
        transform: rotate(-3deg) translateY(-15px);
    }
}

/* Decorative Concentric Rings */
.experience-header-image::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 130%;
    aspect-ratio: 1/1;
    border: 1px dashed rgba(204, 51, 102, 0.2);
    border-radius: 50%;
    z-index: -2;
    pointer-events: none;
    animation: rotateCircle 40s linear infinite;
}

/* Floating Icon on the Ring (Matches the star/fork icons in screenshot) */
.experience-left .floating-ring-icon {
    position: absolute;
    top: 10%;
    right: -10%;
    width: 40px;
    height: 40px;
    background: #FF9933; /* Matches the orange star icon in screenshot */
    color: #fff;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 5;
    box-shadow: 0 10px 20px rgba(255, 153, 51, 0.3);
    animation: floatingCard 4s ease-in-out infinite alternate;
}

/* Decorative Quote Icon (Top Left in screenshot) */
.experience-left .quote-icon {
    position: absolute;
    top: -10px;
    left: 0;
    font-size: 60px;
    color: rgba(204, 51, 102, 0.1);
    font-family: serif;
    line-height: 1;
    z-index: 2;
}

/* Second Inner Ring */
.experience-left::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 110%;
    height: 110%;
    border: 1px solid rgba(204, 51, 102, 0.08);
    border-radius: 50%;
    z-index: -3;
    pointer-events: none;
}

.professional-image {
    width: 100%;
    height: auto;
    object-fit: cover;
    display: block;
    border-radius: 40px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.12);
    filter: brightness(0.85);
    transition: filter 0.3s ease;
}

@keyframes rotateCircle {
    from { transform: translate(-50%, -50%) rotate(0deg); }
    to { transform: translate(-50%, -50%) rotate(360deg); }
}

/* Floating Stat Card (Golden/Orange) */
.floating-stat-card {
    position: absolute;
    bottom: -77px; /* Overlapping bottom */
    right: -45px; /* Overlapping right */
    background: var(--primary-color); 
    padding: 30px;
    border-radius: 27px;
    width: 200px; /* Approximate width */
    color: #fff;
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    animation: floatingCard 5s ease-in-out infinite; /* Added gentle floating animation */
}

.stat-card-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.stat-card-icon {
    color: rgba(255,255,255,0.7);
    display: flex;
    align-items: center;
}

.stat-card-value {
    font-size: 36px;
    font-weight: 800;
    line-height: 1;
}

.stat-card-divider {
    width: 100%;
    height: 1px;
    background: rgba(255,255,255,0.2);
    margin-bottom: 15px;
}

.stat-card-text {
    font-size: 16px;
    line-height: 1.4;
    color: #fff;
}

.stat-card-text strong {
    font-weight: 800;
}

/* Right Column */
.experience-right {
    padding-top: 0;
    text-align: left;
}

.section-subtitle {
    display: inline-block;
    color: var(--primary-color);
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 15px;
    background: rgba(204, 51, 102, 0.08);
    padding: 6px 12px;
    border-radius: 30px;
    text-align: left;
}

.section-title {
    font-size: 52px;
    font-weight: 800;
    color: #1a1a1a;
    line-height: 1.2;
    margin-bottom: 30px;
    letter-spacing: -1.5px;
    text-align: left;
}

.highlight-text {
    color: var(--primary-color);
    position: relative;
    display: inline-block;
}

.section-description-wrapper {
    margin-bottom: 40px;
}

.section-description {
    color: #555;
    font-size: 18px;
    line-height: 1.8;
    margin-bottom: 20px;
    font-weight: 400;
    text-align: left;
    max-width: 100%;
}

.section-description:last-child {
    margin-bottom: 0;
}

/* Tabs Navigation */
.tabs-navigation {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
    flex-wrap: nowrap; /* Forced one line */
    overflow-x: auto;
    padding-bottom: 5px;
    justify-content: flex-start;
    -webkit-overflow-scrolling: touch;
}

.tabs-navigation::-webkit-scrollbar {
    height: 4px;
}
.tabs-navigation::-webkit-scrollbar-thumb {
    background: #e0e0e0;
    border-radius: 4px;
}

.tab-btn {
    background: none;
    border: none;
    padding: 15px 0;
    margin-right: 15px;
    font-size: 15px;
    font-weight: 600;
    color: #888;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    text-align: left;
    white-space: nowrap; /* Prevent text wrap */
    flex-shrink: 0;
}

.tab-btn:after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 0;
    height: 3px;
    background: var(--primary-color);
    transition: width 0.3s ease;
}

.tab-btn:hover {
    color: var(--primary-color);
}

.tab-btn.active {
    color: var(--primary-color);
}

.tab-btn.active:after {
    width: 100%;
}

/* Tabs Content */
.tabs-content {
    min-height: 120px;
    padding-top: 10px;
    text-align: left;
}

.tab-panel {
    display: none;
    animation: fadeIn 0.4s ease-out;
}

.tab-panel.active {
    display: block;
}

.tab-panel p {
    color: #444;
    font-size: 15px;
    line-height: 1.7;
    margin: 0;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Floating Animation Keyframes */
@keyframes floatingCard {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0px);
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .experience-content-wrapper {
        grid-template-columns: 1fr;
        gap: 50px;
    }

    .experience-header-image {
        max-width: 600px;
        margin: 0 auto;
        margin-bottom: 60px; /* Extra space for badge */
    }
    
    .floating-stat-card {
        right: 0;
        bottom: -30px;
    }
}

@media (max-width: 768px) {
    .section-title {
        font-size: 32px;
    }
    
    .tab-btn {
        padding: 12px 0;
    }
    
    .floating-stat-card {
        position: static;
        margin-top: -20px;
        margin-left: auto;
        margin-right: 20px;
        width: auto;
        max-width: 250px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and panels
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanels.forEach(p => p.classList.remove('active'));
            
            // Add active class to clicked button and corresponding panel
            this.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });
});
</script>
