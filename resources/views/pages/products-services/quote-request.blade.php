<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Quote - {{ $product['title'] }} - CasaGenerators</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .quote-request-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin-top: 50px;
        }

        .quote-request-main {
            flex: 1;
            padding: 60px 20px;
            background: white;
        }

        .quote-request-wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }

        .breadcrumb {
            margin-bottom: 30px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #0066cc;
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: #0052a3;
        }

        .quote-request-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .quote-request-header h1 {
            font-size: 42px;
            color: #1a1a1a;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .quote-request-header p {
            font-size: 18px;
            color: #666;
        }

        .quote-request-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            background: white;
            padding: 40px;
            border-radius: 0;
        }

        .product-details-section {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .product-image-wrapper {
            overflow: hidden;
            border-radius: 0;
        }

        .product-image-wrapper img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease;
        }

        .product-image-wrapper:hover img {
            transform: scale(1.05);
        }

        .product-badge {
            display: inline-block;
            background: linear-gradient(135deg, #CC3366 0%, #992147 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }

        .product-info h2 {
            font-size: 28px;
            color: #1a1a1a;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .product-info p {
            color: #555;
            line-height: 1.8;
            font-size: 16px;
            margin-bottom: 25px;
        }

        .product-features {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .product-features li {
            padding: 12px 0;
            padding-left: 30px;
            color: #555;
            font-size: 15px;
            position: relative;
            border-bottom: 1px solid #f0f0f0;
        }

        .product-features li:last-child {
            border-bottom: none;
        }

        .product-features li:before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #CC3366;
            font-weight: bold;
            font-size: 18px;
        }

        .quote-form-section {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .form-section-title {
            font-size: 24px;
            color: #1a1a1a;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #CC3366;
            background-color: white;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #CC3366 0%, #992147 100%);
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: none;
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #CC3366;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 30px;
            transition: all 0.3s;
        }

        .back-link:hover {
            gap: 12px;
            color: #CC3366;
        }

        .required {
            color: #d32f2f;
        }

        /* Header styling to make it visible */
        header {
            background: white !important;
            box-shadow: none !important;
            border-bottom: none !important;
        }

        header * {
            color: black !important;
        }

        header a {
            color: #333 !important;
        }

        @media (max-width: 768px) {
            .quote-request-content {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 25px;
            }

            .quote-request-header h1 {
                font-size: 32px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .quote-request-main {
                padding: 40px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="quote-request-container">
        @include('landing.sections.header')

        <main class="quote-request-main">
            <div class="quote-request-wrapper">

                <div class="quote-request-header">
                    <h1>Request a Quote</h1>
                    <p>Get detailed information and pricing for this product</p>
                </div>

                <div class="quote-request-content">
                    <!-- Product Details Section -->
                    <div class="product-details-section">
                        <div class="product-image-wrapper">
                            <img src="{{ asset($product['image']) }}" alt="{{ $product['title'] }}">
                        </div>

                        <div class="product-info">
                            <span class="product-badge">{{ $product['badge'] }}</span>
                            <h2>{{ $product['title'] }}</h2>
                            <p>{{ $product['description'] }}</p>

                            <h3 style="font-size: 18px; color: #1a1a1a; margin-bottom: 15px; font-weight: 600;">Key Features</h3>
                            <ul class="product-features">
                                @foreach($product['features'] as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                  
                </div>
            </div>
        </main>

        @include('landing.sections.footer')
    </div>

    <script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>
