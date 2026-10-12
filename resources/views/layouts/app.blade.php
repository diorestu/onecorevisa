<!DOCTYPE html>
<html lang="{{ $lang ?? 'en' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OneCoreVisa | Visa, KITAS & Business Setup Indonesia (One Step Solution)</title>
    <meta name="description" content="OneCoreVisa - One Step Solution for Indonesian Visas, KITAS, PT PMA Business Setup & Corporate Legal Assistance.">
    
    <link rel="shortcut icon" href="{{ asset('assets/images/onecore-logo.svg') }}" type="image/svg+xml">

    <!-- Framework Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-lib/bootstrap.min.css') }}">
    <!-- Font Awesome / Icon Fonts -->
    <link rel="stylesheet" href="{{ asset('assets/font-awesome-lib/icon/font-awesome.min.css') }}">
    <!-- Template Style & Responsive Theme -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <!-- Slick Slider & AOS Animation -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <!-- OneCoreVisa Brand Custom Palette Theme -->
    <link rel="stylesheet" href="{{ asset('assets/css/onecore-theme.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Site Wrapper -->
    <div class="site-wrapper">
        
        <!-- Top Advisory Bar -->
        <div class="onecore-topbar">
            <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge-official">OFFICIAL</span>
                    <span>
                        {{ ($lang ?? 'en') === 'en' 
                            ? 'Indonesian Immigration & Corporate Legal Advisory • Offices in Bali & Jakarta' 
                            : 'Konsultan Hukum Imigrasi & Pendirian PT PMA Resmi • Kantor di Bali & Jakarta' }}
                    </span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="https://wa.me/6281298765432" target="_blank" class="d-flex align-items-center gap-1">
                        <i class="fa-solid fa-phone"></i>
                        <span>+62 812-9876-5432</span>
                    </a>
                    <span class="text-secondary">|</span>
                    <div class="lang-switcher">
                        <a href="{{ route('lang.switch', 'en') }}" class="{{ ($lang ?? 'en') === 'en' ? 'active' : '' }}">EN</a>
                        <a href="{{ route('lang.switch', 'id') }}" class="{{ ($lang ?? 'en') === 'id' ? 'active' : '' }}">ID</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header / Navigation -->
        <header class="position-sticky top-0 z-3">
            <nav class="navbar container navbar-expand-lg py-2">
                <div class="container-fluid px-0">
                    <!-- Brand Logo -->
                    <a class="navbar-brand position-relative p-0 d-flex align-items-center" href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/onecore-logo-white.svg') }}" alt="OneCoreVisa Logo" height="42">
                    </a>

                    <!-- Mobile Toggler -->
                    <button class="navbar-toggler text-white border-0" id="sidebarEvent" type="button" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars fs-4 text-white"></i>
                    </button>

                    <!-- Desktop Menu -->
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav position-relative ms-auto mx-4 mb-2 mb-lg-0 d-flex gap-2 justify-content-center align-items-center">
                            <li class="nav-item">
                                <a class="nav-link active" href="#hero">
                                    {{ ($lang ?? 'en') === 'en' ? 'Home' : 'Beranda' }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link highlight-pref" href="#preference-section">
                                    <i class="fa-solid fa-magnifying-glass me-1"></i>
                                    {{ ($lang ?? 'en') === 'en' ? 'Check Preference' : 'Cek Preferensi' }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about-section">
                                    {{ ($lang ?? 'en') === 'en' ? 'About Us' : 'Tentang Kami' }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#services-section">
                                    {{ ($lang ?? 'en') === 'en' ? 'Our Services' : 'Layanan Kami' }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#process-section">
                                    {{ ($lang ?? 'en') === 'en' ? 'Our Process' : 'Proses Kami' }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#faq-section">
                                    {{ ($lang ?? 'en') === 'en' ? 'FAQ' : 'Tanya Jawab' }}
                                </a>
                            </li>
                        </ul>

                        <!-- CTA Button -->
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn-onecore-primary" data-bs-toggle="modal" data-bs-target="#consultationModal">
                                <i class="fa-solid fa-comments"></i>
                                <span>{{ ($lang ?? 'en') === 'en' ? 'Free Consultation' : 'Konsultasi Gratis' }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Sidebar Drawer for Mobile -->
            <aside>
                <div class="sidebar">
                    <div class="d-flex justify-content-between align-items-center pb-3 border-bottom border-secondary">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/images/onecore-logo.svg') }}" alt="OneCoreVisa" height="36">
                        </a>
                        <button type="button" id="closeBtn" class="btn-close" aria-label="Close"></button>
                    </div>
                    <ul class="nav-links text-start mt-3">
                        <li><a href="#hero" class="active">{{ ($lang ?? 'en') === 'en' ? 'Home' : 'Beranda' }}</a></li>
                        <li><a href="#preference-section" class="text-primary fw-bold">{{ ($lang ?? 'en') === 'en' ? 'Check Preference (Search)' : 'Cek Preferensi (Cari)' }}</a></li>
                        <li><a href="#about-section">{{ ($lang ?? 'en') === 'en' ? 'About Us' : 'Tentang Kami' }}</a></li>
                        <li><a href="#services-section">{{ ($lang ?? 'en') === 'en' ? 'Our Services' : 'Layanan Kami' }}</a></li>
                        <li><a href="#process-section">{{ ($lang ?? 'en') === 'en' ? 'Our Process' : 'Proses Kami' }}</a></li>
                        <li><a href="#faq-section">{{ ($lang ?? 'en') === 'en' ? 'FAQ' : 'Tanya Jawab' }}</a></li>
                    </ul>
                    <div class="mt-4 pt-3 border-top border-secondary">
                        <button type="button" class="btn-onecore-primary w-100 justify-content-center" data-bs-toggle="modal" data-bs-target="#consultationModal">
                            <i class="fa-solid fa-comments"></i>
                            <span>{{ ($lang ?? 'en') === 'en' ? 'Free Consultation' : 'Konsultasi Gratis' }}</span>
                        </button>
                    </div>
                </div>
            </aside>
        </header>

        <!-- Main Body Content -->
        @yield('content')

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row justify-content-between g-4">
                    
                    <!-- Col 1: Brand & Identity -->
                    <div class="col-lg-4 col-md-6">
                        <div class="mb-3">
                            <img src="{{ asset('assets/images/onecore-logo-white.svg') }}" alt="OneCoreVisa Logo" height="42">
                        </div>
                        <p class="text-secondary small mb-3">
                            {{ ($lang ?? 'en') === 'en'
                                ? 'OneCoreVisa is Indonesia\'s premier one-stop legal partner for foreign visas, KITAS residency permits, PT PMA business setup, and corporate compliance.'
                                : 'OneCoreVisa adalah mitra hukum satu pintu (One Step Solution) resmi di Indonesia untuk visa, KITAS, pendirian PT PMA 100% asing, dan kepatuhan hukum korporasi.' }}
                        </p>
                        <div class="address d-flex flex-column gap-2 text-secondary small">
                            <div class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-location-dot text-info mt-1"></i>
                                <p class="m-0 text-white-50">
                                    <strong>Jakarta:</strong> Sovereign Plaza Lt. 16, Jl. TB Simatupang, Jakarta Selatan
                                </p>
                            </div>
                            <div class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-location-dot text-info mt-1"></i>
                                <p class="m-0 text-white-50">
                                    <strong>Bali:</strong> Sunset Road No. 88, Seminyak, Kuta, Badung, Bali
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Col 2: Quick Links -->
                    <div class="col-lg-2 col-md-3 col-6">
                        <h4>{{ ($lang ?? 'en') === 'en' ? 'Quick Links' : 'Navigasi' }}</h4>
                        <div class="footer-links d-flex flex-column">
                            <a href="#hero">{{ ($lang ?? 'en') === 'en' ? 'Home' : 'Beranda' }}</a>
                            <a href="#preference-section">{{ ($lang ?? 'en') === 'en' ? 'Check Preference' : 'Cek Preferensi' }}</a>
                            <a href="#about-section">{{ ($lang ?? 'en') === 'en' ? 'About Us' : 'Tentang Kami' }}</a>
                            <a href="#services-section">{{ ($lang ?? 'en') === 'en' ? 'Our Services' : 'Layanan Kami' }}</a>
                            <a href="#process-section">{{ ($lang ?? 'en') === 'en' ? 'Our Process' : 'Proses Kami' }}</a>
                            <a href="#faq-section">{{ ($lang ?? 'en') === 'en' ? 'FAQ' : 'Tanya Jawab' }}</a>
                        </div>
                    </div>

                    <!-- Col 3: Key Solutions -->
                    <div class="col-lg-3 col-md-3 col-6">
                        <h4>{{ ($lang ?? 'en') === 'en' ? 'Core Solutions' : 'Layanan Unggulan' }}</h4>
                        <div class="footer-links d-flex flex-column small">
                            <a href="#preference-section" onclick="filterCategory('kitas')">• Investor KITAS (E28A/B)</a>
                            <a href="#preference-section" onclick="filterCategory('business')">• PT PMA 100% Foreign Owned</a>
                            <a href="#preference-section" onclick="filterCategory('visas')">• Remote Worker Visa (E33G)</a>
                            <a href="#preference-section" onclick="filterCategory('visas')">• Visit Visa B211A (180 Days)</a>
                            <a href="#preference-section" onclick="filterCategory('kitas')">• Working KITAS (E23) & RPTKA</a>
                            <a href="#preference-section" onclick="filterCategory('business')">• Virtual Office Bali & Jakarta</a>
                        </div>
                    </div>

                    <!-- Col 4: Contact & Hotline -->
                    <div class="col-lg-3 col-md-6">
                        <h4>{{ ($lang ?? 'en') === 'en' ? 'Direct Hotline' : 'Kontak Langsung' }}</h4>
                        <div class="address d-flex flex-column gap-2 small">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-phone text-info"></i>
                                <a href="https://wa.me/6281298765432" target="_blank" class="text-white">+62 812-9876-5432</a>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-envelope text-info"></i>
                                <span class="text-white-50">hello@onecorevisa.com</span>
                            </div>
                            <div class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-clock text-info mt-1"></i>
                                <span class="text-white-50">Mon - Fri: 09:00 - 18:00 WIB<br>Sat: 09:00 - 14:00 WIB</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn-onecore-primary w-100 justify-content-center" data-bs-toggle="modal" data-bs-target="#consultationModal">
                                <i class="fa-solid fa-calendar-check"></i>
                                <span>{{ ($lang ?? 'en') === 'en' ? 'Book Legal Call' : 'Jadwalkan Konsultasi' }}</span>
                            </button>
                        </div>
                    </div>

                </div>

                <hr class="border-secondary my-4">

                <!-- Sub-footer -->
                <div class="row align-items-center justify-content-between text-secondary small">
                    <div class="col-md-6 text-md-start text-center mb-md-0 mb-2">
                        <p class="m-0 text-white-50">
                            © 2026 OneCoreVisa. All Rights Reserved. One Step Solution.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end text-center">
                        <p class="m-0 text-white-50">
                            Compliance: Ditjen Imigrasi • BKPM OSS-RBA • Kemenkumham RI • PERADI
                        </p>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- End Site Wrapper -->

    <!-- Floating WhatsApp Concierge Widget -->
    <a href="https://wa.me/6281298765432?text=Halo%20OneCoreVisa,%20saya%20ingin%20konsultasi%20visa%20/%20PT%20PMA." 
       target="_blank" 
       class="floating-wa-btn" 
       title="Chat with Legal Specialist on WhatsApp"
       aria-label="WhatsApp Chat">
        <span class="floating-wa-badge">1</span>
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- Back to Top Button -->
    <button onclick="scrollToTop()" id="backToTopBtn" class="btn_hover2" aria-label="Back to Top">
        <i class="fa-solid fa-arrow-turn-up"></i>
    </button>

    <!-- Consultation / Lead Inquiry Modal -->
    <div class="modal fade" id="consultationModal" tabindex="-1" aria-labelledby="consultationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content onecore-modal shadow-lg">
                <div class="onecore-modal-header d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-info text-dark fw-bold mb-1">ONE STEP SOLUTION</span>
                        <h5 class="modal-title" id="consultationModalLabel">
                            {{ ($lang ?? 'en') === 'en' ? 'Free Legal & Visa Assessment' : 'Konsultasi Gratis Legalitas & Visa' }}
                        </h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="small text-muted mb-4">
                        {{ ($lang ?? 'en') === 'en'
                            ? 'Connect directly with our accredited in-house immigration specialists and advocates in Bali & Jakarta. 100% confidential under NDA.'
                            : 'Terhubung langsung dengan spesialis imigrasi dan advokat berlisensi kami di Bali & Jakarta. 100% rahasia.' }}
                    </p>

                    <form id="consultationForm" action="{{ route('consultation.submit') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">
                                    {{ ($lang ?? 'en') === 'en' ? 'Full Name' : 'Nama Lengkap' }} *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-user text-muted"></i></span>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. Michael Smith" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">
                                    {{ ($lang ?? 'en') === 'en' ? 'Nationality' : 'Kewarganegaraan' }} *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-globe text-muted"></i></span>
                                    <input type="text" name="nationality" class="form-control" placeholder="e.g. Australia, UK, USA" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">
                                    WhatsApp Number *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-brands fa-whatsapp text-success"></i></span>
                                    <input type="tel" name="whatsapp" class="form-control" placeholder="+62 812-xxxx" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">
                                    Email Address
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="client@company.com">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">
                                    {{ ($lang ?? 'en') === 'en' ? 'Service Interested In' : 'Layanan Yang Diminati' }}
                                </label>
                                <select name="service" id="modalServiceSelect" class="form-select">
                                    <option value="General Consultation">-- {{ ($lang ?? 'en') === 'en' ? 'Select Service / Discuss Options' : 'Pilih Layanan' }} --</option>
                                    @foreach($services as $svc)
                                        <option value="{{ $svc['title'] }}">{{ $svc['code'] }} - {{ $svc['title'] }}</option>
                                    @endforeach
                                    <option value="Custom PT PMA Corporate">PT PMA Custom Corporate Setup</option>
                                    <option value="Immigration Legal Advice">Immigration Legal Advisory</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-dark">
                                    {{ ($lang ?? 'en') === 'en' ? 'Current Location' : 'Lokasi Saat Ini' }}
                                </label>
                                <select name="location" class="form-select">
                                    <option value="Currently in Bali / Jakarta">Currently in Indonesia (Bali / Jakarta)</option>
                                    <option value="Currently Overseas">Currently Overseas (Planning Entry)</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small text-dark">
                                    {{ ($lang ?? 'en') === 'en' ? 'Notes or Specific Questions' : 'Catatan atau Pertanyaan' }}
                                </label>
                                <textarea name="notes" class="form-control" rows="2" placeholder="{{ ($lang ?? 'en') === 'en' ? 'Tell us your timeline, planned business activity, or visa requirements...' : 'Ceritakan kebutuhan atau target waktu Anda...' }}"></textarea>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mt-4 pt-3 border-top">
                            <span class="small text-muted">
                                <i class="fa-solid fa-shield-halved text-success me-1"></i>
                                Protected by Attorney-Client Privilege
                            </span>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">
                                    {{ ($lang ?? 'en') === 'en' ? 'Cancel' : 'Batal' }}
                                </button>
                                <button type="submit" class="btn-onecore-primary px-4 border-0">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    <span>{{ ($lang ?? 'en') === 'en' ? 'Send & Chat WhatsApp' : 'Kirim & Buka WhatsApp' }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts from Template -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/javascript-lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>

    <script>
        // Init AOS animations
        AOS.init({ once: true, duration: 900 });

        // Header background slider
        const slides = document.querySelectorAll('.header-slider .slide');
        let currentSlide = 0;
        if (slides.length > 0) {
            function changeSlide() {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
            }
            setInterval(changeSlide, 5000);
        }

        // Open modal with pre-selected service
        function openConsultationWithService(serviceTitle) {
            const selectEl = document.getElementById('modalServiceSelect');
            if (selectEl && serviceTitle) {
                let found = false;
                for (let i = 0; i < selectEl.options.length; i++) {
                    if (selectEl.options[i].text.includes(serviceTitle) || selectEl.options[i].value === serviceTitle) {
                        selectEl.selectedIndex = i;
                        found = true;
                        break;
                    }
                }
                if (!found) {
                    const opt = new Option(serviceTitle, serviceTitle, true, true);
                    selectEl.add(opt);
                }
            }
            const modalEl = new bootstrap.Modal(document.getElementById('consultationModal'));
            modalEl.show();
        }

        // Scroll to top
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>

    @stack('scripts')
</body>
</html>
