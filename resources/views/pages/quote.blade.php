<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Quote - Casa Generators</title>
    <meta name="description" content="Request a quote for our generator solutions, from high-power industrial units to commercial and residential generators.">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <style>
        .quote-page {
            padding: 100px 0 80px;
            background: #ffffff;
        }

        .quote-section {
            margin-bottom: 80px;
        }

        .quote-section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #001e61;
            margin-bottom: 32px;
        }

        .info-card {
            background: #f9fafb;
            border-left: 4px solid #F99C1B;
            padding: 32px;
            border-radius: 8px;
            margin-bottom: 32px;
        }

        .info-card p {
            color: #6b7280;
            line-height: 1.8;
            font-size: 1rem;
            margin: 0;
        }

        .info-card p:first-child {
            margin-bottom: 12px;
        }

        .quote-form-container {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 48px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.875rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #F99C1B;
            box-shadow: 0 0 0 3px rgba(249, 156, 27, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .submit-btn {
            background: #F99C1B;
            color: #ffffff;
            padding: 16px 48px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .submit-btn:hover {
            background: #e88b0f;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(249, 156, 27, 0.3);
        }

        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .alert i {
            font-size: 1.25rem;
        }
    </style>
</head>
<body>
    @include('landing.sections.header')

    <section class="page-hero  flex items-center justify-center">
    <div class="hero-background w-full h-full absolute inset-0"></div>
    <div class="relative z-10 w-full flex items-center justify-center">
        <div class="text-center flex flex-col items-center justify-center">
           
            <h1 class="page-title">Qoute Request</h1>
             <div class="breadcrumb flex justify-center items-center gap-2">
                <a href="{{ route('home') }}">Home</a> <span>/</span> <span>Qoute Request</span>
            </div>
            <p>World's Leading Industry Corporation!</p>
        </div>
    </div>
</section>


    <div class="quote-page">
        <div class="container">
            
            <!-- Partnership Opportunities -->
            <section class="quote-section">
                <h2 class="quote-section-title">Partnership Opportunities</h2>
                <div class="info-card">
                    <p><strong>Are you interested in distributing PI generators in your region?</strong></p>
                    <p>Please complete this form and our partnership development team will contact you within 24 hours to discuss available opportunities.</p>
                </div>
            </section>

            <!-- Join Our Team -->
            <section class="quote-section">
                <h2 class="quote-section-title">Join Our Team</h2>
                <div class="info-card">
                    <p><strong>Looking to join PI and grow your career with us?</strong></p>
                    <p>Submit your details and our HR team will review your application and contact you if your profile matches our current openings.</p>
                </div>
            </section>

            <!-- Request a Quote -->
            <section class="quote-section">
                <h2 class="quote-section-title">Request a Quote</h2>
                <div class="info-card">
                    <p><strong>Need pricing or technical details for a specific solution?</strong></p>
                    <p>Fill out this form and our sales team will get back to you within 24 hours with a tailored quotation.</p>
                </div>

                <!-- Quote Request Form -->
                <div class="quote-form-container">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('quote.request.submit') }}" method="POST">
                        @csrf
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label" for="name">Full Name *</label>
                                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="email">Email Address *</label>
                                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-input" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="industry">Industry *</label>
                                <select id="industry" name="industry" class="form-select" required>
                                    <option value="" disabled {{ old('industry') ? '' : 'selected' }}>Select Your Industry</option>
                                    <option value="Construction" {{ old('industry') == 'Construction' ? 'selected' : '' }}>Construction</option>
                                    <option value="Manufacturing" {{ old('industry') == 'Manufacturing' ? 'selected' : '' }}>Manufacturing</option>
                                    <option value="Healthcare" {{ old('industry') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                                    <option value="Hospitality" {{ old('industry') == 'Hospitality' ? 'selected' : '' }}>Hospitality</option>
                                    <option value="Residential" {{ old('industry') == 'Residential' ? 'selected' : '' }}>Residential</option>
                                    <option value="Commercial" {{ old('industry') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                    <option value="Other" {{ old('industry') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('industry')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="message">Message / Requirements *</label>
                            <textarea id="message" name="message" class="form-textarea" required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="submit-btn">Submit Quote Request</button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Share Feedback -->
            <section class="quote-section">
                <h2 class="quote-section-title">Share Feedback</h2>
                <div class="info-card">
                    <p><strong>We value your feedback and suggestions.</strong></p>
                    <p>Submit your message and our team will review it and respond if further clarification is needed.</p>
                </div>
            </section>

        </div>
    </div>

    @include('landing.sections.footer')
</body>
</html>
