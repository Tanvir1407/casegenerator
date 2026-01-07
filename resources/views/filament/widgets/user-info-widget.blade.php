<div class="user-info-widget">
    <style>
        .user-info-widget {
            --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #a855f7 50%, #ec4899 100%);
            --card-gradient: linear-gradient(135deg, #ffffff 0%, #f5f7fa 100%);
            --card-dark-gradient: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }

        .user-info-widget * {
            box-sizing: border-box;
        }

        .user-info-card {
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 16px;
            padding: 32px;
            display: flex;
            flex-direction: column;
        }

        @media (prefers-color-scheme: dark) {
            .user-info-card {
                background: white;
                border-color: #374151;
            }
        }

        .user-header {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        @media (min-width: 768px) {
            .user-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 24px;
            flex: 1;
        }

        .avatar-wrapper {
            position: relative;
            flex-shrink: 0;
        }

        .avatar-glow {
            position: absolute;
            inset: 0;
            background: var(--primary-gradient);
            border-radius: 50%;
            opacity: 0.4;
        }

        .avatar {
            position: relative;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 700;
            color: white;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-label {
            font-size: 12px;
            font-weight: 600;
            color: #5a5f7a;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 4px;
            display: block;
        }

        @media (prefers-color-scheme: dark) {
            .user-label {
                color: #9ca3af;
            }
        }

        .user-name {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        @media (min-width: 768px) {
            .user-name {
                font-size: 28px;
            }
        }

        @media (prefers-color-scheme: dark) {
            .user-name {
                color: #9ca3af;
            }
        }

        .user-email {
            font-size: 14px;
            color: #556575;
            margin: 8px 0 0 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        @media (prefers-color-scheme: dark) {
            .user-email {
                color: #9ca3af;
            }
        }

        .button-wrapper {
            flex-shrink: 0;
            width: 100%;
        }

        @media (min-width: 768px) {
            .button-wrapper {
                width: auto;
            }
        }

        .button-wrapper form {
            width: 100%;
            display: contents;
        }

        .logout-button {
            width: 100%;
            padding: 12px 32px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        @media (min-width: 768px) {
            .logout-button {
                width: auto;
            }
        }

        .button-icon {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .divider {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #d1d5db;
        }

        @media (prefers-color-scheme: dark) {
            .divider {
                border-top-color: #374151;
            }
        }

        .footer-text {
            font-size: 12px;
            color: #5a5f7a;
            text-align: center;
            margin: 0;
        }

        @media (prefers-color-scheme: dark) {
            .footer-text {
                color: #9ca3af;
            }
        }

        .contacts-container {
            background: var(--card-gradient);
            border: 1px solid #d1d5db;
            border-radius: 16px;
            padding: 32px;
            margin-top: 24px;
            display: flex;
            flex-direction: column;
        }

        @media (prefers-color-scheme: dark) {
            .contacts-container {
                background: white;
                border-color: #374151;
            }
        }

        .contacts-title {
            color:black;
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 20px 0;
        }

        @media (prefers-color-scheme: dark) {
            .contacts-title {
                color: #ffffff;
            }
        }

        .view-button {
            display: inline-block;
            padding: 6px 16px;
            background: linear-gradient(135deg, #F99C1B 0%, #d97706 100%);
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(249, 156, 27, 0.3);
        }

        .view-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(249, 156, 27, 0.4);
            color: white;
        }
        .contacts-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .contacts-table thead {
            border-bottom: 2px solid #d1d5db;
        }

        @media (prefers-color-scheme: dark) {
            .contacts-table thead {
                border-bottom-color: #374151;
            }
        }

        .contacts-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #000000;
           
        }

        @media (prefers-color-scheme: dark) {
            .contacts-table th {
                color: #9ca3af;
            }
        }

        .contacts-table td {
            padding: 12px;
            border-bottom: 1px solid #d1d5db;
            color: #000000;
        }

        @media (prefers-color-scheme: dark) {
            .contacts-table td {
                border-bottom-color: #374151;
                color: #000000;
            }
        }

        .contact-name {
            font-weight: 600;
            color: #000000;
        }

        @media (prefers-color-scheme: dark) {
            .contact-name {
                color: #ffffff;
            }
        }

        .contact-email {
            color: #000000;
            word-break: break-all;
        }

        @media (prefers-color-scheme: dark) {
            .contact-email {
                color: #9ca3af;
            }
        }

        .no-contacts {
            padding: 20px;
            text-align: center;
            color: #000000;
            font-size: 14px;
        }

        @media (prefers-color-scheme: dark) {
            .no-contacts {
                color: #9ca3af;
            }
        }
    </style>

    <div class="user-info-card">
        <div class="user-header">
            <!-- User Info Section -->
            <div class="user-section">
                <!-- Avatar -->
                <div class="avatar-wrapper">
                    <div class="avatar-glow"></div>
                    <div class="avatar">
                        {{ strtoupper(substr($this->getUser()->name, 0, 1)) }}
                    </div>
                </div>
                
                <!-- User Details -->
                <div class="user-details">
                    <label class="user-label">Welcome Back,</label>
                    <h2 class="user-name">{{ $this->getUser()->name }}</h2>
                    <p class="user-email">{{ $this->getUser()->email }}</p>
                </div>
            </div>

            <!-- Logout Button -->
            <div class="button-wrapper">
                <form action="{{ route('filament.admin.auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button">
                        <svg class="button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Divider -->
        <div class="divider">
            <p class="footer-text">
                Logged in as {{ $this->getUser()->email }} • Last login: {{ now()->format('M d, Y H:i') }}
            </p>
        </div>
    </div>

    <!-- Contacts List Section -->
    <div class="contacts-container">
        <h3 class="contacts-title">Recent Contacts</h3>
        @php
            $contacts = \App\Models\Contact::latest()->limit(5)->get();
        @endphp
        @if($contacts->isNotEmpty())
            <table class="contacts-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td class="contact-name">{{ $contact->name }}</td>
                            <td class="contact-email">{{ $contact->email }}</td>
                            <td>{{ Str::limit($contact->subject ?? 'N/A', 30) }}</td>
                            <td>{{ $contact->created_at->format('M d, Y') }}</td>
                            <td class="actions-button">
                                <a href="{{ route('filament.admin.resources.contacts.view', $contact) }}" class="view-button">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-contacts">No contacts available</div>
        @endif
    </div>