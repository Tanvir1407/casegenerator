<section class="tailor-made-section">
    <style>
        .tailor-made-section {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            position: relative;
            overflow: hidden;
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            min-height: 650px;
        }

        /* Left Side */
        .tm-left {
            flex: 1;
            flex-basis: 50%;
            min-width: 320px;
            /* Gradient based on #CC3366 */
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 5rem 5rem 8rem 5rem; /* Large bottom padding to accommodate marquee */
            position: relative;
        }

        /* Right Side */
        .tm-right {
            flex: 1;
            flex-basis: 50%;
            min-width: 320px;
            position: relative;
            min-height: 400px;
        }

        .tm-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        /* Content Styling */
        .tm-content {
            max-width: 600px;
            position: relative;
            z-index: 30; /* Ensure text is above the marquee */
        }

        .tm-title {
            font-size: 3rem;
            font-weight: 500;
            line-height: 1.1;
            margin-bottom: 2rem;
            letter-spacing: -0.02em;
        }

        .tm-text {
            font-size: 1.125rem;
            line-height: 1.6;
            margin-bottom: 3.5rem;
            font-weight: 400;
            opacity: 0.95;
            max-width: 90%;
        }

        .tm-highlight {
            color: #fbbf24; /* Amber-400 equivalent for visibility */
            font-weight: 700;
        }

        /* Button */
        .tm-btn {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: 10px 10px 10px 24px;
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .tm-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: #fff;
            transform: translateY(-2px);
        }

        .tm-btn-icon-circle {
            background-color: #ffffff;
            color: #CC3366;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }
        
        .tm-btn:hover .tm-btn-icon-circle {
            transform: translateX(4px);
        }

        /* Marquee / Scrolling Text */
        .tm-marquee {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 10; /* Behind content, over background */
            padding-bottom: 0.5rem;
            pointer-events: none; /* Let clicks pass through */
        }

        .tm-marquee-inner {
            display: flex;
            white-space: nowrap;
            overflow: hidden;
        }

        .tm-marquee-content {
            display: flex;
            animation: marquee-scroll 12s linear infinite; /* Faster speed */
        }

        .tm-marquee-item {
            font-size: 5rem; /* Large impact text */
            font-weight: 600;
            text-transform: uppercase;
            color: transparent;
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.6);
            margin-right: 0;
            display: flex;
            color:rgba(255, 255, 255, 0.311);
            align-items: center;
            line-height: 1;
        }

        .tm-separator {
            color: #fbbf24;
            font-size: 2rem;
            margin: 0 1.5rem;
            vertical-align: middle;
            display: inline-block;
            /* Creating a hollow circle effect or similar to the screenshot if possible, or just a solid dot */
            /* Screenshot shows a solid yellow circle with a hole or a nut icon. Solid circle is safer. */
            content: "●";
        }
        
        .tm-separator svg {
            width: 24px;
            height: 24px;
            fill: currentColor;
        }

        @keyframes marquee-scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .tm-title { font-size: 2.5rem; }
            .tm-left { padding: 4rem 3rem 6rem 3rem; }
            .tm-marquee-item { font-size: 3.5rem; }
        }

        @media (max-width: 768px) {
            .tailor-made-section { flex-direction: column; }
            .tm-left, .tm-right { flex-basis: 100%; width: 100%; }
            .tm-right { min-height: 300px; height: 300px; }
            .tm-left { padding: 3rem 1.5rem 5rem 1.5rem; }
            .tm-title { font-size: 2rem; }
            .tm-marquee-item { font-size: 2.5rem; }
        }
    </style>
    <div class="tailor-made-section">
    <div class="tm-left">
        <div class="tm-content">
            <h2 class="tm-title">Do you need a tailor-made energy solution?</h2>
            <p class="tm-text">
                We translate your needs into technical specifications to design and
                manufacture the ideal generator set for your project.<br>
                And after that, <span class="tm-highlight">we stay by your side to make sure everything runs smoothly.</span>
            </p>
            <a href="#contact" class="tm-btn">
                I want to know more
                <span class="tm-btn-icon-circle">
                    <!-- Simple arrow right icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </span>
            </a>
        </div>
    </div>
    
    <div class="tm-right">
        <img src="{{ asset('images/landing/Casablanca_Vission-1-1.png') }}" alt="Casablanca Night View">
    </div>
    
    </div>
    <!-- Scrolling Marquee -->
    <div class="tm-marquee">
        <div class="tm-marquee-inner">
            <div class="tm-marquee-content">
                <!-- Repeated content for seamless scroll -->
                @for ($i = 0; $i < 4; $i++)
                <div class="tm-marquee-item">
                    <span>Custom Energy Solutions</span>
                    <span class="tm-separator">
                         <svg viewBox="0 0 24 24" fill="currentColor">
                             <circle cx="12" cy="12" r="6" stroke="currentColor" stroke-width="4" fill="none"/>
                         </svg>
                    </span>
                </div>
                @endfor
            </div>
        </div>
    </div>
</section>
