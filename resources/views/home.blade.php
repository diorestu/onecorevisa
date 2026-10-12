@extends('layouts.app')

@section('content')

    <!-- =========================================================================
         1. ONECORE VISA (One step solution) - Hero Section
         ========================================================================= -->
    <div class="position-relative overflow-hidden" id="hero">
        
        <!-- Header background slider from template -->
        <div class="header-slider">
            <div class="slide active">
                <img src="{{ asset('assets/images/index/header-slider1.webp') }}" alt="Indonesia Visa & Business Background">
            </div>
            <div class="slide">
                <img src="{{ asset('assets/images/index/header-slider2.webp') }}" alt="Bali & Jakarta Immigration">
            </div>
            <div class="slide">
                <img src="{{ asset('assets/images/index/header-slider3.webp') }}" alt="PT PMA Foreign Investment">
            </div>
        </div>

        <div class="overlay py-5">
            <div class="container py-lg-5 py-4">
                <div class="row align-items-center g-5">
                    
                    <!-- Left Hero Col -->
                    <div class="col-lg-7 text-lg-start text-center" data-aos="fade-up">
                        
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white-10 border border-info mb-3">
                            <span class="badge rounded-pill bg-info text-dark fw-bold">LEGAL HUB</span>
                            <span class="text-white small fw-bold">
                                {{ $lang === 'en' ? 'Indonesian Immigration & Corporate Advisory' : 'Konsultan Resmi Imigrasi & Bisnis Indonesia' }}
                            </span>
                        </div>

                        <!-- Main Title -->
                        <h1 class="hero-main-title">
                            ONECORE <span style="color: var(--color-skyblue);">VISA</span>
                        </h1>
                        <div class="hero-tagline-gradient mb-3">
                            ({{ $lang === 'en' ? 'One Step Solution' : 'Solusi Satu Pintu' }})
                        </div>

                        <p class="text-white-50 fs-5 mb-4 leading-relaxed max-w-xl">
                            {{ $lang === 'en'
                                ? 'Your premier accredited gateway for Indonesian Visas, KITAS, and complete Business Setup. We eliminate bureaucratic red tape with 100% legal certainty, transparent pricing, and fast-track processing.'
                                : 'Mitra hukum terpercaya untuk pengurusan Visa, KITAS, dan Pendirian PT PMA 100% asing di Indonesia. Kami hilangkan kerumitan birokrasi dengan kepastian hukum 100%, tarif transparan, dan proses kilat.' }}
                        </p>

                        <!-- Scope Pills -->
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <div class="hero-scope-box d-flex align-items-center gap-3">
                                    <div class="fs-3 text-info">
                                        <i class="fa-solid fa-passport"></i>
                                    </div>
                                    <div>
                                        <h6>Visa & KITAS Specialists</h6>
                                        <p>e-VOA, B211A, Working, Investor & Nomad</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="hero-scope-box d-flex align-items-center gap-3">
                                    <div class="fs-3" style="color: var(--color-skyblue);">
                                        <i class="fa-solid fa-building-shield"></i>
                                    </div>
                                    <div>
                                        <h6>Business Setup & Legal Assist</h6>
                                        <p>PT PMA 100% Foreign Owned, NIB, Virtual Office</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Actions -->
                        <div class="d-flex flex-wrap gap-3 justify-content-lg-start justify-content-center">
                            <a href="#preference-section" class="btn-onecore-primary">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <span>{{ $lang === 'en' ? 'Check Your Preference' : 'Cek Preferensi Anda' }}</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                            <button type="button" class="btn-onecore-outline" data-bs-toggle="modal" data-bs-target="#consultationModal">
                                <i class="fa-solid fa-comments"></i>
                                <span>{{ $lang === 'en' ? 'Free Legal Assessment' : 'Konsultasi Hukum Gratis' }}</span>
                            </button>

                            <a href="https://wa.me/6281298765432" target="_blank" class="btn-whatsapp-hero">
                                <i class="fa-brands fa-whatsapp"></i>
                                <span>WhatsApp Specialist</span>
                            </a>
                        </div>

                    </div>

                    <!-- Right Hero Col: Verified Pass Simulator -->
                    <div class="col-lg-5" data-aos="fade-left" data-aos-delay="200">
                        <div class="verified-pass-card">
                            
                            <div class="pass-header d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-shield-halved fs-3" style="color: var(--color-skyblue);"></i>
                                    <div>
                                        <div class="fw-bold small text-white">ONECORE VERIFIED PASS</div>
                                        <div class="font-monospace small" style="color: var(--color-skyblue); font-size: 11px;">ID: OCV-INA-2026-LEGAL</div>
                                    </div>
                                </div>
                                <span class="pass-badge">
                                    <i class="fa-solid fa-circle-check me-1"></i> 100% COMPLIANT
                                </span>
                            </div>

                            <div class="pass-meta-box">
                                <div class="d-flex justify-content-between small mb-2">
                                    <div>
                                        <span class="text-white-50 text-uppercase d-block" style="font-size: 10px;">Service Scope</span>
                                        <strong class="text-white">Visa, KITAS & PT PMA Setup</strong>
                                    </div>
                                    <div class="text-end">
                                        <span class="text-white-50 text-uppercase d-block" style="font-size: 10px;">Jurisdiction</span>
                                        <strong style="color: var(--color-skyblue);">Republic of Indonesia</strong>
                                    </div>
                                </div>
                                <hr class="border-secondary my-2">
                                <div class="row g-2 small text-white-50">
                                    <div class="col-6">
                                        <span class="d-block" style="font-size: 10px;">Queue System</span>
                                        <span class="text-success fw-bold"><i class="fa-solid fa-bolt"></i> Direct Govt API</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="d-block" style="font-size: 10px;">Biometrics Escort</span>
                                        <span class="text-white fw-bold">VIP Priority Bali/Jkt</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between small text-white-50 mb-2">
                                    <span>{{ $lang === 'en' ? 'Quick Jump to Preference:' : 'Pilih Cepat Preferensi:' }}</span>
                                    <span style="color: var(--color-skyblue);">Instant Filter</span>
                                </div>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <a href="#preference-section" onclick="applyQuickSearch('Investor KITAS')" class="d-block p-2 rounded bg-white-10 text-white text-decoration-none border border-secondary small hover-glow">
                                            <div class="fw-bold" style="color: var(--color-skyblue);">Investor KITAS</div>
                                            <div style="font-size: 10px;" class="text-white-50">1-2 Yrs • 0% DPKK Tax</div>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#preference-section" onclick="applyQuickSearch('PT PMA')" class="d-block p-2 rounded bg-white-10 text-white text-decoration-none border border-secondary small hover-glow">
                                            <div class="fw-bold" style="color: var(--color-skyblue);">PT PMA Setup</div>
                                            <div style="font-size: 10px;" class="text-white-50">100% Foreign Owned</div>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#preference-section" onclick="applyQuickSearch('Remote Worker')" class="d-block p-2 rounded bg-white-10 text-white text-decoration-none border border-secondary small hover-glow">
                                            <div class="fw-bold" style="color: var(--color-skyblue);">Nomad Visa E33G</div>
                                            <div style="font-size: 10px;" class="text-white-50">1 Year • Tax Friendly</div>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#preference-section" onclick="applyQuickSearch('B211A')" class="d-block p-2 rounded bg-white-10 text-white text-decoration-none border border-secondary small hover-glow">
                                            <div class="fw-bold" style="color: var(--color-skyblue);">Visit Visa B211A</div>
                                            <div style="font-size: 10px;" class="text-white-50">Up to 180 Days Stay</div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2 border-top border-secondary d-flex justify-content-between align-items-center text-white-50 small" style="font-size: 11px;">
                                <span><i class="fa-solid fa-stamp text-info me-1"></i> Ditjen Imigrasi</span>
                                <span><i class="fa-solid fa-landmark text-info me-1"></i> BKPM OSS-RBA</span>
                                <span><i class="fa-solid fa-award text-info me-1"></i> Kemenkumham RI</span>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Trust Stats Counters Bar -->
                <div class="trust-stats-bar">
                    <div class="row g-4 text-center">
                        <div class="col-lg-3 col-6 trust-stat-item">
                            <div class="stat-num">5,200+</div>
                            <div class="stat-label">{{ $lang === 'en' ? 'Visas & KITAS Issued' : 'Visa & KITAS Diterbitkan' }}</div>
                        </div>
                        <div class="col-lg-3 col-6 trust-stat-item">
                            <div class="stat-num">380+</div>
                            <div class="stat-label">{{ $lang === 'en' ? 'PT PMA Companies Formed' : 'PT PMA Berhasil Didirikan' }}</div>
                        </div>
                        <div class="col-lg-3 col-6 trust-stat-item">
                            <div class="stat-num">99.4%</div>
                            <div class="stat-label">{{ $lang === 'en' ? 'Immigration Approval Rate' : 'Tingkat Kelulusan Imigrasi' }}</div>
                        </div>
                        <div class="col-lg-3 col-6 trust-stat-item">
                            <div class="stat-num">48+</div>
                            <div class="stat-label">{{ $lang === 'en' ? 'Countries Represented' : 'Negara Klien Terlayani' }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- End Hero Section -->


    <!-- =========================================================================
         2. Check which your preference (search kolom)
         ========================================================================= -->
    <section id="preference-section">
        <div class="container">
            
            <!-- Section Title -->
            <div class="text-center max-w-3xl mx-auto mb-4" data-aos="fade-up">
                <div class="section-badge-onecore">
                    <i class="fa-solid fa-sliders"></i>
                    <span>{{ $lang === 'en' ? 'Interactive Search Engine' : 'Pencarian Preferensi Interaktif' }}</span>
                </div>
                <h2 class="section-title-onecore">
                    {{ $lang === 'en' ? 'Check Which Your Preference' : 'Cek Preferensi Anda (Pencarian Cepat)' }}
                </h2>
                <p class="text-secondary small">
                    {{ $lang === 'en'
                        ? 'Search and filter our complete catalog of visas, KITAS residency permits, and corporate legal services tailored to your stay duration and business targets.'
                        : 'Cari dan saring katalog lengkap visa, izin tinggal KITAS, dan layanan hukum korporasi sesuai durasi tinggal dan kebutuhan bisnis Anda.' }}
                </p>
            </div>

            <!-- Search Kolom Container -->
            <div class="search-kolom-card" data-aos="fade-up" data-aos-delay="100">
                
                <!-- Main Search Input Bar -->
                <div class="search-kolom-input-wrapper">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" 
                           id="searchPreferenceInput" 
                           class="search-kolom-input" 
                           placeholder="{{ $lang === 'en' ? 'Search by visa type, investor KITAS, PT PMA, business setup, virtual office, nomad...' : 'Cari jenis visa, KITAS investor, PT PMA, pendirian bisnis, sponsor...' }}">
                    <button type="button" id="searchClearBtn" class="search-kolom-clear" title="Clear Search">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <!-- Popular Keywords Chips -->
                <div class="mt-3 d-flex flex-wrap align-items-center gap-2">
                    <span class="small fw-bold text-muted">{{ $lang === 'en' ? 'Popular Searches:' : 'Pencarian Populer:' }}</span>
                    @foreach(['Investor KITAS', 'PT PMA Setup', 'Remote Worker (E33G)', 'Tourist B211A', 'Spouse KITAS', 'Virtual Office', 'NIB & OSS'] as $kw)
                        <a href="javascript:void(0)" onclick="applyQuickSearch('{{ $kw }}')" class="popular-kw-pill">
                            {{ $kw }}
                        </a>
                    @endforeach
                </div>

                <!-- Category Filters Tabs & Wizard Toggle -->
                <div class="mt-4 pt-3 border-top d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="d-flex flex-wrap gap-2" id="categoryFilterContainer">
                        <button type="button" class="category-filter-btn active" data-category="all">
                            {{ $lang === 'en' ? 'All Options' : 'Semua Pilihan' }}
                        </button>
                        <button type="button" class="category-filter-btn" data-category="visas">
                            <i class="fa-solid fa-plane-departure me-1"></i>
                            {{ $lang === 'en' ? 'Visas & Visits' : 'Visa & Kunjungan' }}
                        </button>
                        <button type="button" class="category-filter-btn" data-category="kitas">
                            <i class="fa-solid fa-id-card me-1"></i>
                            {{ $lang === 'en' ? 'KITAS & Long-Term' : 'KITAS & Izin Tinggal' }}
                        </button>
                        <button type="button" class="category-filter-btn" data-category="business">
                            <i class="fa-solid fa-building me-1"></i>
                            {{ $lang === 'en' ? 'Business Setup & PMA' : 'Pendirian PT PMA' }}
                        </button>
                        <button type="button" class="category-filter-btn" data-category="legal">
                            <i class="fa-solid fa-scale-balanced me-1"></i>
                            {{ $lang === 'en' ? 'Legal & Corporate Assist' : 'Bantuan Hukum' }}
                        </button>
                    </div>

                    <!-- Toggle Match Wizard Button -->
                    <button type="button" id="toggleWizardBtn" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                        <i class="fa-solid fa-wand-magic-sparkles me-1"></i>
                        <span>{{ $lang === 'en' ? '30-Sec Match Wizard' : 'Panduan Cepat 30 Detik' }}</span>
                    </button>
                </div>

                <!-- 2-Click Match Wizard (Expandable) -->
                <div id="wizardCollapse" class="wizard-box mt-4 d-none">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-white fw-bold mb-0">
                            <i class="fa-solid fa-compass text-info me-2"></i>
                            {{ $lang === 'en' ? 'Find Your Ideal Permit in 2 Clicks' : 'Temukan Izin Tepat dalam 2 Klik' }}
                        </h6>
                        <button type="button" onclick="resetWizard()" class="btn btn-sm text-info p-0 text-decoration-underline">
                            {{ $lang === 'en' ? 'Reset' : 'Reset' }}
                        </button>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="small text-white-50 mb-2 fw-bold d-block">
                                {{ $lang === 'en' ? '1. What is your primary purpose in Indonesia?' : '1. Apa tujuan utama Anda di Indonesia?' }}
                            </label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <button type="button" class="wizard-btn-option" onclick="selectWizard('purpose', 'nomad', this)">Remote Worker (E33G)</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="wizard-btn-option" onclick="selectWizard('purpose', 'investor', this)">Investor / Founder</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="wizard-btn-option" onclick="selectWizard('purpose', 'tourist', this)">Travel / Meetings</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="wizard-btn-option" onclick="selectWizard('purpose', 'working', this)">Employed Worker</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="small text-white-50 mb-2 fw-bold d-block">
                                {{ $lang === 'en' ? '2. Planned duration of stay or operation?' : '2. Rencana durasi tinggal atau operasional?' }}
                            </label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <button type="button" class="wizard-btn-option" onclick="selectWizard('duration', 'short', this)">Under 60 Days</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="wizard-btn-option" onclick="selectWizard('duration', 'medium', this)">Up to 180 Days</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="wizard-btn-option" onclick="selectWizard('duration', 'long', this)">1 - 2 Years</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="wizard-btn-option" onclick="selectWizard('duration', 'permanent', this)">Permanent / Business</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wizard Recommendation Alert -->
                    <div id="wizardMatchAlert" class="mt-3 p-3 rounded bg-white-10 border border-info d-none">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <div>
                                <span class="badge bg-success small mb-1">RECOMMENDED MATCH</span>
                                <h6 class="text-white fw-bold mb-0" id="wizardMatchTitle">Investor KITAS</h6>
                                <p class="text-white-50 small mb-0" id="wizardMatchDesc">Multi-year residency for shareholders.</p>
                            </div>
                            <button type="button" class="btn btn-sm btn-info fw-bold text-dark" id="wizardMatchBtn" onclick="highlightMatchedCard()">
                                {{ $lang === 'en' ? 'View This Permit' : 'Lihat Layanan Ini' }}
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Meta Count Indicator -->
            <div class="d-flex justify-content-between align-items-center small text-muted mb-4 px-1">
                <span id="preferenceCountLabel">Showing {{ count($services) }} services</span>
                <span id="preferenceActiveFilterLabel" class="text-primary fw-bold"></span>
            </div>

            <!-- Cards Catalog Grid -->
            <div class="row g-4" id="servicesGrid">
                @foreach($services as $svc)
                    <div class="col-lg-4 col-md-6 service-catalog-item" 
                         data-id="{{ $svc['id'] }}"
                         data-category="{{ $svc['category'] }}"
                         data-title="{{ strtolower($svc['title']) }}"
                         data-desc="{{ strtolower($svc['shortDesc']) }}"
                         data-code="{{ strtolower($svc['code']) }}"
                         data-tag="{{ strtolower($svc['tag']) }}">
                        
                        <div class="preference-card">
                            
                            <!-- Card Header -->
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="card-code-badge">{{ $svc['code'] }}</span>
                                    <span class="card-highlight-badge">{{ $svc['badge'] }}</span>
                                </div>

                                <h5 class="service-title">{{ $svc['title'] }}</h5>
                                <p class="service-desc">{{ $svc['shortDesc'] }}</p>

                                <!-- Meta Info Grid -->
                                <div class="preference-meta-box">
                                    <div class="row g-2 text-center">
                                        <div class="col-6 border-end">
                                            <span class="text-muted d-block" style="font-size: 10px;">{{ $lang === 'en' ? 'Processing Time' : 'Waktu Proses' }}</span>
                                            <strong class="text-dark small">{{ $svc['processingTime'] }}</strong>
                                        </div>
                                        <div class="col-6">
                                            <span class="text-muted d-block" style="font-size: 10px;">{{ $lang === 'en' ? 'Validity' : 'Masa Berlaku' }}</span>
                                            <strong class="text-dark small">{{ $svc['duration'] }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <!-- Target Audience -->
                                <div class="p-2 rounded bg-light small mb-3 border">
                                    <span class="text-muted d-block fw-bold" style="font-size: 10px; text-transform: uppercase;">
                                        {{ $lang === 'en' ? 'Target Profile:' : 'Profil Sasaran:' }}
                                    </span>
                                    <span class="small text-secondary">{{ $svc['whoFor'] }}</span>
                                </div>

                                <!-- Collapsible Checklist -->
                                <div class="collapse mb-3" id="checklist-{{ $svc['id'] }}">
                                    <div class="p-3 rounded bg-light border">
                                        <h6 class="small fw-bold text-dark mb-2">
                                            <i class="fa-solid fa-list-check text-primary me-1"></i>
                                            {{ $lang === 'en' ? 'Required Documents:' : 'Syarat Dokumen:' }}
                                        </h6>
                                        <ul class="small text-muted ps-3 mb-3">
                                            @foreach($svc['requirements'] as $req)
                                                <li>{{ $req }}</li>
                                            @endforeach
                                        </ul>

                                        <h6 class="small fw-bold text-dark mb-2">
                                            <i class="fa-solid fa-circle-check text-success me-1"></i>
                                            {{ $lang === 'en' ? 'Key Advantages:' : 'Keuntungan Utama:' }}
                                        </h6>
                                        <ul class="small text-muted ps-3 mb-0">
                                            @foreach($svc['perks'] as $prk)
                                                <li>{{ $prk }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Footer Actions -->
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                                <a class="small text-primary fw-bold text-decoration-none" 
                                   data-bs-toggle="collapse" 
                                   href="#checklist-{{ $svc['id'] }}" 
                                   role="button">
                                    {{ $lang === 'en' ? 'View Checklist' : 'Cek Dokumen' }}
                                    <i class="fa-solid fa-chevron-down ms-1" style="font-size: 10px;"></i>
                                </a>

                                <button type="button" 
                                        class="btn btn-sm btn-primary rounded-pill px-3 fw-bold"
                                        onclick="openConsultationWithService('{{ $svc['title'] }}')">
                                    <span>{{ $lang === 'en' ? 'Select & Inquire' : 'Pilih & Konsul' }}</span>
                                    <i class="fa-solid fa-arrow-right ms-1"></i>
                                </button>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>

            <!-- Empty Search State -->
            <div id="noServiceFound" class="text-center py-5 d-none">
                <i class="fa-solid fa-folder-open fs-1 text-muted mb-3"></i>
                <h5>{{ $lang === 'en' ? 'No matching services found' : 'Layanan tidak ditemukan' }}</h5>
                <p class="text-muted small">
                    {{ $lang === 'en' ? 'Try searching with different terms or consult directly with our legal advisor.' : 'Coba gunakan kata kunci lain atau hubungi konsultan kami langsung.' }}
                </p>
                <button type="button" onclick="resetSearchFilters()" class="btn btn-sm btn-outline-primary rounded-pill mt-2">
                    {{ $lang === 'en' ? 'Reset All Filters' : 'Reset Semua Filter' }}
                </button>
            </div>

        </div>
    </section>
    <!-- End Section 2 -->


    <!-- =========================================================================
         3. About Us - The One Step Solution Philosophy
         ========================================================================= -->
    <section id="about-section">
        <div class="container">
            
            <div class="row align-items-center g-5 mb-5">
                
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="section-badge-onecore">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>{{ $lang === 'en' ? 'Who We Are' : 'Tentang Kami' }}</span>
                    </div>
                    
                    <h2 class="section-title-onecore">
                        {{ $lang === 'en' ? 'About OneCoreVisa (One Step Solution)' : 'Mengenal OneCoreVisa (Solusi Satu Pintu)' }}
                    </h2>

                    <p class="text-secondary leading-relaxed mb-3">
                        {{ $lang === 'en'
                            ? 'Navigating Indonesian immigration regulations, OSS RBA business registrations, and corporate legal compliance often involves fragmented middlemen, unpredictable timelines, and hidden fees. OneCoreVisa was established to unify all immigration and corporate setup under one accredited, transparent umbrella.'
                            : 'Mengurus izin imigrasi, legalitas PT PMA, dan kepatuhan hukum di Indonesia sering kali rumit karena tersebar di banyak perantara tanpa kepastian waktu dan biaya. OneCoreVisa hadir sebagai solusi satu pintu yang menyatukan seluruh kebutuhan Anda di bawah naungan firma hukum berlisensi resmi.' }}
                    </p>

                    <p class="text-secondary leading-relaxed mb-4">
                        {{ $lang === 'en'
                            ? 'With licensed PERADI advocates, veteran immigration paralegals, and corporate notary liaisons in Jakarta and Bali, we guide your journey from your first entry eVisa to multi-million dollar corporate establishments.'
                            : 'Didukung advokat terdaftar PERADI, konsultan keimigrasian berpengalaman, dan jaringan notaris di Jakarta dan Bali, kami mendampingi langkah Anda sejak visa kedatangan awal hingga ekspansi bisnis bernilai jutaan dolar.' }}
                    </p>

                    <!-- Office Hub Badges -->
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="p-3 rounded bg-light border d-flex align-items-center gap-3">
                                <div class="fs-4 text-primary">
                                    <i class="fa-solid fa-building-columns"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold small text-dark">Jakarta Hub</h6>
                                    <span class="text-muted" style="font-size: 11px;">TB Simatupang Financial Center</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 rounded bg-light border d-flex align-items-center gap-3">
                                <div class="fs-4 text-info">
                                    <i class="fa-solid fa-umbrella-beach"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold small text-dark">Bali Expat Hub</h6>
                                    <span class="text-muted" style="font-size: 11px;">Sunset Road, Badung & Seminyak</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn-onecore-primary" data-bs-toggle="modal" data-bs-target="#consultationModal">
                        <span>{{ $lang === 'en' ? 'Meet With Our Legal Counsel' : 'Konsultasi Bersama Tim Kuasa Hukum' }}</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>

                <!-- Right Visual About Image & Credentials -->
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="position-relative">
                        <img src="{{ asset('assets/images/index/about-img.webp') }}" class="img-fluid rounded-4 shadow-lg w-100" alt="About OneCoreVisa Team">
                        
                        <div class="position-absolute bottom-0 start-0 m-4 p-3 rounded-3 bg-dark bg-opacity-90 text-white border border-secondary shadow d-flex align-items-center gap-3">
                            <i class="fa-solid fa-certificate fs-1 text-info"></i>
                            <div>
                                <div class="fw-bold small">Official Legal Credentials</div>
                                <div class="small text-white-50">PERADI • Ditjen Imigrasi • OSS RBA</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 4 Pillars of Excellence -->
            <div class="my-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-dark">{{ $lang === 'en' ? 'The 4 Pillars of Our Practice' : '4 Pilar Keunggulan OneCoreVisa' }}</h3>
                    <p class="text-muted small">{{ $lang === 'en' ? 'Built to give absolute certainty in an uncertain environment' : 'Dibangun untuk memberikan kepastian hukum dan ketenangan pikiran' }}</p>
                </div>

                <div class="row g-4">
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="about-pillars-card">
                            <div class="pillar-icon-box">
                                <i class="fa-solid fa-scale-balanced"></i>
                            </div>
                            <h5 class="fw-bold fs-6 mb-2 text-dark">{{ $lang === 'en' ? 'Legal Certainty' : 'Kepastian Hukum' }}</h5>
                            <p class="text-secondary small m-0">
                                {{ $lang === 'en'
                                    ? 'Reviewed by licensed Indonesian lawyers to adhere strictly to Law No. 6/2011 and BKPM guidelines.'
                                    : 'Setiap berkas diverifikasi advokat resmi agar patuh terhadap UU Keimigrasian No. 6/2011 dan regulasi BKPM.' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="about-pillars-card">
                            <div class="pillar-icon-box">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <h5 class="fw-bold fs-6 mb-2 text-dark">{{ $lang === 'en' ? 'VIP Fast-Track' : 'Kecepatan & VIP Escort' }}</h5>
                            <p class="text-secondary small m-0">
                                {{ $lang === 'en'
                                    ? 'Direct integration with government portals and personal escort at biometric photo checkpoints.'
                                    : 'Akses sistem resmi Ditjen Imigrasi & OSS serta pendampingan langsung saat foto biometrik imigrasi.' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="about-pillars-card">
                            <div class="pillar-icon-box">
                                <i class="fa-solid fa-building-circle-check"></i>
                            </div>
                            <h5 class="fw-bold fs-6 mb-2 text-dark">{{ $lang === 'en' ? 'Full Corporate Care' : 'Dukungan Bisnis Penuh' }}</h5>
                            <p class="text-secondary small m-0">
                                {{ $lang === 'en'
                                    ? 'From deed of incorporation to virtual offices, tax compliance, and bank account introductions.'
                                    : 'Mulai dari akta notaris, virtual office resmi, pelaporan pajak, hingga pembukaan rekening bank devisa.' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="about-pillars-card">
                            <div class="pillar-icon-box">
                                <i class="fa-solid fa-receipt"></i>
                            </div>
                            <h5 class="fw-bold fs-6 mb-2 text-dark">{{ $lang === 'en' ? 'Fixed Transparent Pricing' : 'Harga Pasti & Transparan' }}</h5>
                            <p class="text-secondary small m-0">
                                {{ $lang === 'en'
                                    ? 'Zero hidden government fee markups, fixed upfront invoices, and escrow protection.'
                                    : 'Tanpa biaya tersembunyi di tengah jalan. Penawaran resmi transparan sejak awal dengan tanda terima sah.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comparison Table: Broken Way vs OneCore Advantage -->
            <div class="comparison-container my-5" data-aos="fade-up">
                <div class="comparison-header">
                    {{ $lang === 'en' ? 'Why Choose OneCoreVisa Over Traditional Agents?' : 'Mengapa Memilih OneCoreVisa Dibanding Calo Tradisional?' }}
                </div>
                <div class="row g-0">
                    <div class="col-md-6 comparison-col-old border-end">
                        <h6 class="text-danger fw-bold mb-3">
                            <i class="fa-solid fa-circle-xmark me-2"></i>
                            {{ $lang === 'en' ? 'Traditional Broken Agent Process' : 'Agen Konvensional / Calo Tidak Berizin' }}
                        </h6>
                        <ul class="text-dark small ps-3 mb-0 d-flex flex-column gap-2">
                            <li>Multiple unverified middlemen and third-party brokers</li>
                            <li>Vague timelines with endless delays and excuses</li>
                            <li>Surprise hidden charges halfway through application</li>
                            <li>No legal liability or backup if immigration regulations shift</li>
                        </ul>
                    </div>

                    <div class="col-md-6 comparison-col-onecore">
                        <h6 class="text-success fw-bold mb-3">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            {{ $lang === 'en' ? 'The OneCoreVisa Advantage' : 'Keunggulan Solusi Satu Pintu OneCoreVisa' }}
                        </h6>
                        <ul class="text-dark small ps-3 mb-0 d-flex flex-column gap-2 fw-medium">
                            <li>Direct handling by certified lawyers and accredited immigration staff</li>
                            <li>Guaranteed SLA turnaround and real-time WhatsApp case tracking</li>
                            <li>100% upfront transparent fixed pricing with official corporate receipt</li>
                            <li>Continuous legal advisory and proactive renewal reminders</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Section 3 -->


    <!-- =========================================================================
         4. Our Service - Dual Pillars Deep Dive
         ========================================================================= -->
    <section id="services-section">
        <div class="container">
            
            <div class="text-center max-w-3xl mx-auto mb-4" data-aos="fade-up">
                <div class="section-badge-onecore">
                    <i class="fa-solid fa-briefcase"></i>
                    <span>{{ $lang === 'en' ? 'Core Business Pillars' : 'Pilar Bisnis Utama' }}</span>
                </div>
                <h2 class="section-title-onecore">
                    {{ $lang === 'en' ? 'Our Services' : 'Layanan Kami' }}
                </h2>
                <p class="text-secondary small">
                    {{ $lang === 'en'
                        ? 'Specialized immigration solutions and comprehensive corporate infrastructure designed for foreign nationals and multinational enterprises.'
                        : 'Solusi lengkap izin keimigrasian dan infrastruktur legalitas bisnis untuk warga negara asing dan perusahaan global.' }}
                </p>

                <!-- Dual Pillar Navigation Tabs -->
                <div class="mt-4">
                    <ul class="nav service-nav-tabs justify-content-center" id="servicePillarTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="visa-pillar-tab" data-bs-toggle="tab" data-bs-target="#visaPillarContent" type="button" role="tab">
                                <i class="fa-solid fa-passport me-2"></i>
                                <span>1. Visa & KITAS Services</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="business-pillar-tab" data-bs-toggle="tab" data-bs-target="#businessPillarContent" type="button" role="tab">
                                <i class="fa-solid fa-building-flag me-2"></i>
                                <span>2. Businesses Setup & Legal Assist</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content pt-4" id="servicePillarTabsContent">
                
                <!-- Pillar 1: Visa & KITAS -->
                <div class="tab-pane fade show active" id="visaPillarContent" role="tabpanel">
                    <div class="row g-4">
                        @foreach($services as $svc)
                            @if(in_array($svc['category'], ['visas', 'kitas']))
                                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                                    <div class="preference-card">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="card-code-badge">{{ $svc['code'] }}</span>
                                                <span class="card-highlight-badge">{{ $svc['tag'] }}</span>
                                            </div>
                                            <h5 class="service-title">{{ $svc['title'] }}</h5>
                                            <p class="service-desc">{{ $svc['shortDesc'] }}</p>

                                            <div class="preference-meta-box">
                                                <div class="row g-2 text-center">
                                                    <div class="col-6 border-end">
                                                        <span class="text-muted d-block" style="font-size: 10px;">{{ $lang === 'en' ? 'Processing Time' : 'Waktu Proses' }}</span>
                                                        <strong class="text-dark small">{{ $svc['processingTime'] }}</strong>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="text-muted d-block" style="font-size: 10px;">{{ $lang === 'en' ? 'Validity' : 'Masa Berlaku' }}</span>
                                                        <strong class="text-dark small">{{ $svc['duration'] }}</strong>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <span class="small fw-bold text-dark d-block mb-1">{{ $lang === 'en' ? 'Key Advantages:' : 'Keunggulan:' }}</span>
                                                <ul class="small text-muted ps-3 mb-0">
                                                    @foreach(array_slice($svc['perks'], 0, 3) as $pk)
                                                        <li>{{ $pk }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                                            <a href="#preference-section" onclick="applyQuickSearch('{{ $svc['title'] }}')" class="small text-primary fw-bold text-decoration-none">
                                                {{ $lang === 'en' ? 'Full Details' : 'Lihat Syarat' }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" onclick="openConsultationWithService('{{ $svc['title'] }}')">
                                                <span>{{ $lang === 'en' ? 'Consult Now' : 'Konsultasi' }}</span>
                                                <i class="fa-solid fa-arrow-right ms-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Pillar 2: Businesses Setup & Legal Assist -->
                <div class="tab-pane fade" id="businessPillarContent" role="tabpanel">
                    <div class="row g-4">
                        @foreach($services as $svc)
                            @if(in_array($svc['category'], ['business', 'legal']))
                                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                                    <div class="preference-card">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="card-code-badge">{{ $svc['code'] }}</span>
                                                <span class="card-highlight-badge">{{ $svc['tag'] }}</span>
                                            </div>
                                            <h5 class="service-title">{{ $svc['title'] }}</h5>
                                            <p class="service-desc">{{ $svc['shortDesc'] }}</p>

                                            <div class="preference-meta-box">
                                                <div class="row g-2 text-center">
                                                    <div class="col-6 border-end">
                                                        <span class="text-muted d-block" style="font-size: 10px;">{{ $lang === 'en' ? 'Processing Time' : 'Waktu Proses' }}</span>
                                                        <strong class="text-dark small">{{ $svc['processingTime'] }}</strong>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="text-muted d-block" style="font-size: 10px;">{{ $lang === 'en' ? 'Validity' : 'Masa Berlaku' }}</span>
                                                        <strong class="text-dark small">{{ $svc['duration'] }}</strong>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <span class="small fw-bold text-dark d-block mb-1">{{ $lang === 'en' ? 'Key Advantages:' : 'Keunggulan:' }}</span>
                                                <ul class="small text-muted ps-3 mb-0">
                                                    @foreach(array_slice($svc['perks'], 0, 3) as $pk)
                                                        <li>{{ $pk }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                                            <a href="#preference-section" onclick="applyQuickSearch('{{ $svc['title'] }}')" class="small text-primary fw-bold text-decoration-none">
                                                {{ $lang === 'en' ? 'Full Details' : 'Lihat Syarat' }}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" onclick="openConsultationWithService('{{ $svc['title'] }}')">
                                                <span>{{ $lang === 'en' ? 'Consult Now' : 'Konsultasi' }}</span>
                                                <i class="fa-solid fa-arrow-right ms-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Section 4 -->


    <!-- =========================================================================
         5. Our Process - 4 Transparent Phases
         ========================================================================= -->
    <section id="process-section">
        <div class="container">
            
            <div class="text-center max-w-3xl mx-auto mb-5" data-aos="fade-up">
                <div class="section-badge-onecore">
                    <i class="fa-solid fa-diagram-project"></i>
                    <span>{{ $lang === 'en' ? 'Clear & Predictable Journey' : 'Tahapan Kerja Jelas & Terbuka' }}</span>
                </div>
                <h2 class="section-title-onecore">
                    {{ $lang === 'en' ? 'Our 4-Step Process' : '4 Tahap Proses Kerja Kami' }}
                </h2>
                <p class="text-secondary small">
                    {{ $lang === 'en'
                        ? 'We uphold absolute transparency. Here is how we guide you seamlessly from initial consultation to final permit delivery.'
                        : 'Kami menjunjung transparansi penuh. Inilah bagaimana kami memandu Anda dari konsultasi awal hingga izin resmi diserahkan.' }}
                </p>
            </div>

            <!-- Steps Grid -->
            <div class="row g-4">
                @foreach($process as $idx => $st)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($idx + 1) * 100 }}">
                        <div class="process-step-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="process-step-badge">{{ $st['step'] }}</div>
                                <span class="process-timeline-pill">
                                    <i class="fa-solid fa-clock me-1"></i>{{ $st['timeline'] }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <i class="fa-solid {{ $st['icon'] }} fs-4 text-primary mb-2 d-block"></i>
                                <h5 class="fw-bold fs-6 text-dark mb-2">{{ $st['title'] }}</h5>
                                <p class="text-secondary small m-0 leading-relaxed">{{ $st['desc'] }}</p>
                            </div>

                            <div class="pt-3 border-top d-flex justify-content-between align-items-center small text-muted mt-auto" style="font-size: 11px;">
                                <span class="text-success fw-bold"><i class="fa-solid fa-check me-1"></i> Phase {{ $idx + 1 }}</span>
                                <span>Step {{ $idx + 1 }} of 4</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Guarantee Box -->
            <div class="process-guarantee-box" data-aos="fade-up">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-shield-halved fs-3 text-info"></i>
                            <h4 class="text-white fw-bold mb-0">The OneCoreVisa Guarantee</h4>
                        </div>
                        <p class="text-white-50 small mb-3">
                            {{ $lang === 'en'
                                ? 'We provide dedicated personal case managers for every client with transparent WhatsApp tracking and 100% document confidentiality under formal NDA.'
                                : 'Setiap klien mendapatkan Dedicated Case Manager pribadi dengan pelaporan harian via WhatsApp serta jaminan kerahasiaan berkas 100% di bawah NDA legal.' }}
                        </p>
                        <div class="row g-2 small text-white">
                            <div class="col-sm-4">
                                <i class="fa-solid fa-circle-check text-info me-1"></i> Zero Bureaucratic Stress
                            </div>
                            <div class="col-sm-4">
                                <i class="fa-solid fa-circle-check text-info me-1"></i> VIP Biometric Escort
                            </div>
                            <div class="col-sm-4">
                                <i class="fa-solid fa-circle-check text-info me-1"></i> 100% Money-Back Filing SLA
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end text-start">
                        <button type="button" class="btn-onecore-primary" data-bs-toggle="modal" data-bs-target="#consultationModal">
                            <span>{{ $lang === 'en' ? 'Start Step 1 Today' : 'Mulai Langkah 1 Sekarang' }}</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Section 5 -->


    <!-- =========================================================================
         Testimonials & FAQs
         ========================================================================= -->
    <section class="py-5 bg-light" id="faq-section">
        <div class="container py-4">
            
            <!-- Testimonials -->
            <div class="text-center max-w-2xl mx-auto mb-4" data-aos="fade-up">
                <span class="badge bg-primary text-white mb-2">CLIENT EXPERIENCES</span>
                <h3 class="fw-bold text-dark">{{ $lang === 'en' ? 'Trusted by 5,000+ Foreign Expats & Founders' : 'Dipercaya Lebih Dari 5.000 Ekspatriat & Investor' }}</h3>
            </div>

            <div class="row g-4 mb-5">
                @foreach($testimonials as $t)
                    <div class="col-md-4" data-aos="fade-up">
                        <div class="p-4 rounded-4 bg-white border h-100 d-flex flex-column justify-content-between shadow-sm">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="text-warning small">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <span class="badge bg-light text-dark">{{ $t['country'] }}</span>
                                </div>
                                <p class="small text-muted fst-italic mb-3">
                                    "{{ $t['quote'] }}"
                                </p>
                            </div>
                            <div class="pt-3 border-top">
                                <h6 class="fw-bold text-dark mb-0 small">{{ $t['client'] }}</h6>
                                <span class="text-muted" style="font-size: 11px;">{{ $t['role'] }}</span>
                                <div class="mt-1">
                                    <span class="badge bg-info bg-opacity-25 text-primary" style="font-size: 10px;">{{ $t['service'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- FAQs Accordion -->
            <div class="max-w-3xl mx-auto pt-4" data-aos="fade-up">
                <div class="text-center mb-4">
                    <span class="badge bg-secondary mb-1">CLEAR ANSWERS</span>
                    <h3 class="fw-bold text-dark">{{ $lang === 'en' ? 'Frequently Asked Questions' : 'Pertanyaan yang Sering Diajukan' }}</h3>
                </div>

                <div class="accordion shadow-sm rounded-4 overflow-hidden" id="faqAccordion">
                    @foreach($faqs as $fIdx => $f)
                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header" id="heading-{{ $fIdx }}">
                                <button class="accordion-button fw-bold text-dark {{ $fIdx === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $fIdx }}">
                                    {{ $f['q'] }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $fIdx }}" class="accordion-collapse collapse {{ $fIdx === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small leading-relaxed">
                                    {{ $f['a'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <!-- Pre-Footer Conversion Callout Banner -->
    <section class="py-5 bg-dark text-white text-center position-relative" style="background: linear-gradient(135deg, #0B2942 0%, #123C5E 50%, #071A2A 100%) !important;">
        <div class="container py-3">
            <span class="badge bg-info text-dark fw-bold mb-2">100% LEGAL ADVISORY</span>
            <h2 class="text-white fw-bold mb-2">
                {{ $lang === 'en' ? 'Ready to Start Your Indonesia Journey?' : 'Siap Memulai Perjalanan Anda di Indonesia?' }}
            </h2>
            <p class="text-white-50 small max-w-xl mx-auto mb-4">
                {{ $lang === 'en'
                    ? 'Join thousands of expatriates, tech founders, and foreign corporations who rely on OneCoreVisa for legal peace of mind.'
                    : 'Bergabunglah dengan ribuan ekspatriat, founder teknologi, dan korporasi global yang mempercayakan kebutuhan hukumnya kepada OneCoreVisa.' }}
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <button type="button" class="btn-onecore-primary" data-bs-toggle="modal" data-bs-target="#consultationModal">
                    <i class="fa-solid fa-comments"></i>
                    <span>{{ $lang === 'en' ? 'Book Free 1-on-1 Consultation' : 'Jadwalkan Konsultasi Gratis' }}</span>
                </button>
                <a href="https://wa.me/6281298765432" target="_blank" class="btn-whatsapp-hero">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>{{ $lang === 'en' ? 'Chat on WhatsApp Now' : 'Chat WhatsApp Sekarang' }}</span>
                </a>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    // Real-time Search & Filter Engine for Section 2
    let activeCategory = 'all';

    const searchInput = document.getElementById('searchPreferenceInput');
    const searchClear = document.getElementById('searchClearBtn');
    const items = document.querySelectorAll('.service-catalog-item');
    const countLabel = document.getElementById('preferenceCountLabel');
    const noResultAlert = document.getElementById('noServiceFound');
    const categoryBtns = document.querySelectorAll('.category-filter-btn');

    function filterServices() {
        const query = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        items.forEach(el => {
            const cat = el.getAttribute('data-category');
            const title = el.getAttribute('data-title');
            const desc = el.getAttribute('data-desc');
            const code = el.getAttribute('data-code');
            const tag = el.getAttribute('data-tag');

            const matchCat = (activeCategory === 'all' || cat === activeCategory);
            const matchQuery = (!query || 
                title.includes(query) || 
                desc.includes(query) || 
                code.includes(query) || 
                tag.includes(query));

            if (matchCat && matchQuery) {
                el.classList.remove('d-none');
                visibleCount++;
            } else {
                el.classList.add('d-none');
            }
        });

        // Update indicators
        countLabel.textContent = `Showing ${visibleCount} services`;
        if (visibleCount === 0) {
            noResultAlert.classList.remove('d-none');
        } else {
            noResultAlert.classList.add('d-none');
        }

        // Show/hide clear button
        if (query) {
            searchClear.classList.add('show');
        } else {
            searchClear.classList.remove('show');
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterServices);
    }

    if (searchClear) {
        searchClear.addEventListener('click', () => {
            searchInput.value = '';
            filterServices();
            searchInput.focus();
        });
    }

    // Category filter click
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            categoryBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeCategory = this.getAttribute('data-category');
            filterServices();
        });
    });

    // Quick keyword pills helper
    function applyQuickSearch(kw) {
        if (searchInput) {
            searchInput.value = kw;
            // set category to all
            categoryBtns.forEach(b => {
                if (b.getAttribute('data-category') === 'all') b.classList.add('active');
                else b.classList.remove('active');
            });
            activeCategory = 'all';
            filterServices();
            // scroll to preference section smoothly
            const el = document.getElementById('preference-section');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        }
    }

    function filterCategory(cat) {
        categoryBtns.forEach(b => {
            if (b.getAttribute('data-category') === cat) {
                b.classList.add('active');
            } else {
                b.classList.remove('active');
            }
        });
        activeCategory = cat;
        if (searchInput) searchInput.value = '';
        filterServices();
        const el = document.getElementById('preference-section');
        if (el) el.scrollIntoView({ behavior: 'smooth' });
    }

    function resetSearchFilters() {
        if (searchInput) searchInput.value = '';
        activeCategory = 'all';
        categoryBtns.forEach(b => {
            if (b.getAttribute('data-category') === 'all') b.classList.add('active');
            else b.classList.remove('active');
        });
        filterServices();
    }

    // Match Wizard Toggle
    const toggleWizardBtn = document.getElementById('toggleWizardBtn');
    const wizardCollapse = document.getElementById('wizardCollapse');
    if (toggleWizardBtn && wizardCollapse) {
        toggleWizardBtn.addEventListener('click', () => {
            wizardCollapse.classList.toggle('d-none');
        });
    }

    // Match Wizard State
    let wizardState = { purpose: '', duration: '' };

    function selectWizard(type, val, btnEl) {
        wizardState[type] = val;
        // set active styling
        const parentCol = btnEl.closest('.col-md-6');
        parentCol.querySelectorAll('.wizard-btn-option').forEach(b => b.classList.remove('selected'));
        btnEl.classList.add('selected');

        evaluateWizard();
    }

    function evaluateWizard() {
        const { purpose, duration } = wizardState;
        if (!purpose || !duration) return;

        let match = {
            id: 'investor-kitas',
            title: 'Investor KITAS (E28A/B)',
            desc: 'Multi-year residency for foreign shareholders and directors with zero DPKK work tax.'
        };

        if (purpose === 'nomad') {
            match = {
                id: 'remote-worker-visa',
                title: 'Remote Worker Visa (Digital Nomad E33G)',
                desc: '1-year residency visa for digital nomads earning offshore income.'
            };
        } else if (purpose === 'investor') {
            if (duration === 'permanent' || duration === 'long') {
                match = {
                    id: 'investor-kitas',
                    title: 'Investor KITAS (E28A/B)',
                    desc: 'Multi-year residency for PT PMA shareholders and directors.'
                };
            } else {
                match = {
                    id: 'pt-pma-setup',
                    title: 'PT PMA Establishment (100% Foreign Owned)',
                    desc: 'Incorporate your foreign-owned corporate entity in Indonesia.'
                };
            }
        } else if (purpose === 'tourist') {
            if (duration === 'short') {
                match = {
                    id: 'evoa-express',
                    title: 'e-VOA Fast-Track (30/60 Days)',
                    desc: 'Instant electronic visa on arrival for tourists and quick meetings.'
                };
            } else {
                match = {
                    id: 'b211a-visit-visa',
                    title: 'Visit Visa B211A (Up to 180 Days)',
                    desc: 'Single entry visit visa extendable up to 180 days onshore.'
                };
            }
        } else if (purpose === 'working') {
            match = {
                id: 'working-kitas',
                title: 'Working KITAS & Work Permit (E23)',
                desc: 'Full work authorization for foreign staff sponsored by Indonesian companies.'
            };
        }

        const alertBox = document.getElementById('wizardMatchAlert');
        const titleEl = document.getElementById('wizardMatchTitle');
        const descEl = document.getElementById('wizardMatchDesc');
        if (alertBox && titleEl && descEl) {
            titleEl.textContent = match.title;
            descEl.textContent = match.desc;
            alertBox.setAttribute('data-target-id', match.id);
            alertBox.classList.remove('d-none');
        }
    }

    function highlightMatchedCard() {
        const alertBox = document.getElementById('wizardMatchAlert');
        if (alertBox) {
            const targetId = alertBox.getAttribute('data-target-id');
            const targetEl = document.querySelector(`.service-catalog-item[data-id="${targetId}"]`);
            if (targetEl) {
                targetEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                targetEl.querySelector('.preference-card').style.border = '2px solid var(--color-ocean)';
                setTimeout(() => {
                    targetEl.querySelector('.preference-card').style.border = '';
                }, 3000);
            }
        }
    }

    function resetWizard() {
        wizardState = { purpose: '', duration: '' };
        document.querySelectorAll('.wizard-btn-option').forEach(b => b.classList.remove('selected'));
        const alertBox = document.getElementById('wizardMatchAlert');
        if (alertBox) alertBox.classList.add('d-none');
    }
</script>
@endpush
