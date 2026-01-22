<section class="ceo-message-section">
    <!-- Decorative dots left -->
    <div class="dots-decoration left-dots">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- Decorative dots right -->
    <div class="dots-decoration right-dots">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- Decorative curves right -->
    <div class="curves-decoration">
        <svg viewBox="0 0 300 400" preserveAspectRatio="none">
            <path d="M 0 100 Q 100 150 150 200 T 300 300" stroke="var(--primary-color)" stroke-width="3" fill="none" opacity="0.3"/>
            <circle cx="260" cy="280" r="40" fill="var(--primary-color)" opacity="0.2"/>
            <circle cx="280" cy="310" r="25" fill="var(--primary-color)" opacity="0.15"/>
            <circle cx="240" cy="330" r="15" fill="var(--primary-color)" opacity="0.1"/>
        </svg>
    </div>

    <div class="container">
        <div class="ceo-message-wrapper">
            <!-- Header Section -->
            <div class="section-header">
                <h1 class="section-title">Message from the CEO</h1>
            </div>

            <!-- Main Content -->
            <div class="ceo-content-wrapper">
               

                <!-- Content Right -->
                <div class="ceo-message-content">
                    <p class="ceo-message-text">
                        Casablanca Electrical Generators & Equipment Trading is a leading company in the field of power generators, based in the United Arab Emirates since the early 2000s. Our diesel generators come with a large variety of sizes ranging from 9KVA to 2500KVA and feature big power with low emission and world-class fuel efficiency for prime, continuous, and standby applications.
                    </p>
                    <p class="ceo-message-text">
                        This is the sample dummy text insert. Your Desired Text here because This is the dummy text. This is the sample dummy text insert. Your Desired Text here because This is the dummy text.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* ==================== MAIN SECTION STYLES ==================== */
.ceo-message-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #f5f5f5 0%, #fafafa 100%);
    position: relative;
    overflow: hidden;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ==================== DECORATIVE ELEMENTS ==================== */
.dots-decoration {
    position: absolute;
    display: flex;
    flex-direction: column;
    gap: 15px;
    z-index: 1;
}

.left-dots {
    left: 40px;
    top: 50%;
    transform: translateY(-50%);
}

.right-dots {
    right: 40px;
    top: 50%;
    transform: translateY(-50%);
}

.dots-decoration span {
    width: 12px;
    height: 12px;
    background:var(--primary-color);
    border-radius: 50%;
    opacity: 0.6;
}

.curves-decoration {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 300px;
    height: 400px;
    z-index: 1;
}

/* ==================== HEADER SECTION ==================== */
.section-header {
    text-align: left;
    margin-bottom: 60px;
    position: relative;
    z-index: 2;
}

.section-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 10px 0;
    letter-spacing: -1px;
    line-height: 1.1;
}

.section-subtitle {
    font-size: 1rem;
    color: #999;
    margin: 0;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

/* ==================== MAIN CONTENT WRAPPER ==================== */
.ceo-message-wrapper {
    position: relative;
    z-index: 2;
}


/* ==================== PROFILE SECTION ==================== */
.ceo-profile-section {
    display: flex;
    justify-content: center;
    align-items: center;
}

.ceo-avatar-container {
    position: relative;
    width: 350px;
    height: 350px;
}

.ceo-profile-image {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 8px solid white;
    display: block;
}

.profile-overlay {
    position: absolute;
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    border: 3px solid rgba(249, 156, 27, 0.3);
    border-radius: 50%;
    pointer-events: none;
}

/* ==================== MESSAGE CONTENT SECTION ==================== */
.ceo-message-content {
    padding-left: 40px;
}

.ceo-name {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 10px 0;
    letter-spacing: -0.5px;
    text-transform: uppercase;
}

.ceo-title-role {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--primary-color);
    margin: 0 0 30px 0;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

.ceo-message-text {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #555;
    margin: 0 0 20px 0;
    text-align: justify;
}

.ceo-message-text:last-child {
    margin-bottom: 0;
}

/* ==================== RESPONSIVE DESIGN ==================== */
@media (max-width: 1024px) {
    .ceo-message-section {
        padding: 80px 0;
    }

    .section-title {
        font-size: 3rem;
    }



    .ceo-avatar-container {
        width: 300px;
        height: 300px;
    }

    .ceo-name {
        font-size: 2.2rem;
    }

    .ceo-message-content {
        padding-left: 30px;
    }

    .dots-decoration {
        display: none;
    }

    .curves-decoration {
        display: none;
    }
}

@media (max-width: 768px) {
    .ceo-message-section {
        padding: 60px 0;
    }

    .section-header {
        margin-bottom: 50px;
    }

    .section-title {
        font-size: 2.2rem;
    }



    .ceo-profile-section {
        order: -1;
    }

    .ceo-avatar-container {
        width: 280px;
        height: 280px;
    }

    .ceo-message-content {
        padding-left: 0;
        text-align: center;
    }

    .ceo-name {
        font-size: 1.8rem;
    }

    .ceo-message-text {
        text-align: center;
    }
}

@media (max-width: 480px) {
    .ceo-message-section {
        padding: 40px 0;
    }

    .section-title {
        font-size: 1.8rem;
    }

    .section-subtitle {
        font-size: 0.9rem;
    }

    .ceo-avatar-container {
        width: 250px;
        height: 250px;
    }

    .ceo-name {
        font-size: 1.5rem;
        margin-bottom: 8px;
    }

    .ceo-title-role {
        font-size: 1rem;
        margin-bottom: 20px;
    }

    .ceo-message-text {
        font-size: 0.95rem;
        line-height: 1.6;
    }
}
</style>
