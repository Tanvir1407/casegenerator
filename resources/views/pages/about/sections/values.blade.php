<section class="values-section">
    <div class="container">
        <div class="section-header">
            <div class="title-logo">
                <div class="logo-text">
                    <h2 class="main-title">What We Offers</h2>
                    
                </div>
            </div>
            <p class="section-subtitle">The principles that guide everything we do</p>
        </div>

        <div class="values-grid">
            <div class="value-card">
                <div class="service-icon"><i class="fa-solid fa-gears"></i></div>
                <h3 class="value-title">Advanced & Reliable Products</h3>
                <p class="value-text">We are confident in meeting your requirements and serving government, semi-government, and leading contracting companies across the UAE.</p>
            </div>
            <div class="value-card">
                <div class="service-icon"><i class="fa-solid fa-bolt"></i></div>
                <h3 class="value-title">Energy Optimization</h3>
                <p class="value-text">CASABLANCA offers competitive maintenance contracts with original spare parts, both within and beyond warranty.</p>
            </div>
            <div class="value-card">
                <div class="service-icon"><i class="fa-solid fa-users"></i></div>
                <h3 class="value-title">Dedicated Technical Support Team</h3>
                <p class="value-text">Our expert technicians provide fast, reliable support to ensure uninterrupted performance.</p>
            </div>
            <div class="value-card">
                <div class="service-icon"><i class="fa-solid fa-chart-bar"></i></div>
                <h3 class="value-title">Analytics Engineering</h3>
                <p class="value-text">CASABLANCA provides 24/7 technical support across the UAE and conducts training seminars to enhance customer knowledge</p>
            </div>
            <div class="value-card">
                <div class="service-icon"><i class="fa-solid fa-wrench"></i></div>
                <h3 class="value-title">After Sale Support Service</h3>
                <p class="value-text">Reliable after-sales support ensuring smooth operation and long-term performance.</p>
            </div>
            <div class="value-card">
                <div class="service-icon"><i class="fa-solid fa-arrows-spin"></i></div>
                <h3 class="value-title">Analytics Optimization</h3>
                <p class="value-text">CASABLANCA is well known for its after sales services by offering up to Two year warranty and highly trained maintenance team 24 hours 7 days a week.</p>
            </div>
        </div>
    </div>
</section>

<style>
.values-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.section-header {
    text-align: center;
    margin-bottom: 60px;
}

.title-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    gap: 20px;
}

.logo-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #C33162, #a0264c);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    color: white;
    border: 3px solid white;
}

.logo-text {
    position: relative;
}

.main-title {
    font-size: 3rem;
    font-weight: 800;
    color: #2c3e50;
    margin: 0;
    letter-spacing: -1px;
    text-transform: uppercase;
    background: #001B44;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.title-accent {
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, #C33162, #a0264c);
    margin: 10px auto 0;
    border-radius: 2px;
    position: relative;
}

.title-accent::after {
    content: '';
    position: absolute;
    top: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 20px;
    height: 8px;
    background: #C33162;
    border-radius: 50%;
    opacity: 0.8;
}

.section-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    margin: 0;
    font-weight: 400;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.value-card {
    background: white;
    padding: 40px 30px;
    border-radius: 20px;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    position: relative;
    overflow: hidden;
}

.value-card:hover {
    transform: translateY(-10px);
}

/* Ensure icons are centered in the card */
.values-section .service-icon {
    margin: 0 auto 25px;
}

.value-card:hover .service-icon {
    background: var(--primary-color);
    color: var(--white);
    transform: rotate(10deg);
}

.value-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 15px 0;
    letter-spacing: -0.3px;
}

.value-text {
    font-size: 1rem;
    line-height: 1.6;
    color: #6c757d;
    margin: 0;
    text-align: justify;
}

@media (max-width: 768px) {
    .title-logo {
        flex-direction: column;
        gap: 15px;
    }

    .logo-icon {
        width: 60px;
        height: 60px;
        font-size: 28px;
    }

    .main-title {
        font-size: 2.2rem;
    }

    .values-grid {
        grid-template-columns: 1fr;
        gap: 20px;
        margin-top: 30px;
    }

    .value-card {
        padding: 30px 20px;
    }

    .section-header {
        margin-bottom: 40px;
    }
}

@media (max-width: 480px) {
    .values-section {
        padding: 40px 0;
    }

    .main-title {
        font-size: 1.8rem;
    }

    .section-subtitle {
        font-size: 1rem;
    }

    .values-section .service-icon {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }

    .value-title {
        font-size: 1.2rem;
    }
}
</style>
