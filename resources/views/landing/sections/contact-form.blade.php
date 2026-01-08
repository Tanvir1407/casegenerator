<section id="contact-form" class="contact-form-section">
    <div class="contact-background">
        <div class="container">
            <div class="contact-content">
                <div class="contact-badge">
                    <span>Request A Quote</span>
                </div>
                <h2 class="section-title-white">
                                Complete control ensures the best quality, pricing, and service.                </h2>

                @if($errors->any())
                    <div style="background-color: #ef4444; color: white; padding: 1rem; margin-bottom: 1rem; border-radius: 0.5rem;">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form class="contact-form" action="{{ route('quote.request.submit') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-row">
                        <input type="tel" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                        <select name="industry" class="form-select" required>
                            <option value="" disabled {{ old('industry') ? '' : 'selected' }}>Select your industry</option>
                            <option value="industry_one" {{ old('industry') == 'industry_one' ? 'selected' : '' }}>Industry One</option>
                            <option value="industry_two" {{ old('industry') == 'industry_two' ? 'selected' : '' }}>Industry Two</option>
                            <option value="industry_four" {{ old('industry') == 'industry_four' ? 'selected' : '' }}>Industry Four</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <textarea name="message" rows="4" placeholder="Additional Details!" required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary-black">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    @if(session('success'))
    <div id="successModal" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 100000; align-items: flex-start; justify-content: center; overflow-y: auto; padding: 1rem; box-sizing: border-box;">
        <div style="background: white; padding: 2rem; border-radius: 1rem; max-width: 400px; width: 100%; text-align: center; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2); animation: slideIn 0.3s ease-out; margin: auto; position: relative;">
            <div style="width: 60px; height: 60px; background-color: #F99C1B; border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;">
                <svg style="width: 30px; height: 30px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 style="color: #1f2937; font-size: 1.5rem; margin-bottom: 0.5rem; font-weight: 600;">Success!</h3>
            <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">{{ session('success') }}</p>
            <button onclick="closeModal()" style="background-color: #F99C1B; color: white; padding: 0.75rem 2rem; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; font-size: 1rem; transition: background-color 0.2s;">
                OK
            </button>
        </div>
    </div>

    <style>
        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

    <script>
        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
        }
        
        // Close modal when clicking outside
        document.getElementById('successModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
    @endif
</section>
