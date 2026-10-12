<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Get multilingual website data
     */
    protected function getData($lang = 'en')
    {
        return [
            'services' => [
                [
                    'id' => 'investor-kitas',
                    'category' => 'kitas',
                    'code' => 'Index E28A / E28B',
                    'title' => $lang === 'en' ? 'Investor KITAS (Multi-Year)' : 'KITAS Investor (Multi-Tahun)',
                    'shortDesc' => $lang === 'en'
                        ? 'Long-term residency for foreign shareholders and company directors in Indonesia with zero DPKK work tax fee.'
                        : 'Izin tinggal jangka panjang bagi pemegang saham dan direktur perusahaan di Indonesia tanpa kewajiban pajak DPKK.',
                    'duration' => '1 or 2 Years (Renewable up to 5 Years)',
                    'processingTime' => '7 - 10 Business Days',
                    'whoFor' => $lang === 'en'
                        ? 'Foreign investors, PT PMA shareholders (min. IDR 1 Billion share value) and directors.'
                        : 'Investor asing, pemegang saham PT PMA (min. Rp 1 Miliar lembar saham) & jajaran direksi.',
                    'tag' => 'Most Popular for Founders',
                    'badge' => 'High Demand',
                    'icon' => 'fa-briefcase',
                    'requirements' => [
                        'Passport valid for at least 18 months',
                        'Company Akta Pendirian & Kemenkumham Decree',
                        'Nomor Induk Berusaha (NIB) & Company Tax ID (NPWP)',
                        'Proof of share ownership (min. IDR 1B in shares)',
                        'Personal bank statement (min. USD 2,000 equivalent)'
                    ],
                    'perks' => [
                        'No DPKK government fee (Save $1,200/year)',
                        'Multi-entry permit included',
                        'Eligible to open local Indonesian bank accounts',
                        'Allows buying properties under Hak Pakai',
                        'Sponsor family members on dependent KITAS'
                    ]
                ],
                [
                    'id' => 'pt-pma-setup',
                    'category' => 'business',
                    'code' => 'Foreign Direct Investment (PMA)',
                    'title' => $lang === 'en' ? 'PT PMA Establishment (100% Foreign Owned)' : 'Pendirian PT PMA (100% Kepemilikan Asing)',
                    'shortDesc' => $lang === 'en'
                        ? 'Complete foreign-owned company incorporation with full legal rights to operate and generate revenue in Indonesia.'
                        : 'Pendirian perusahaan penanaman modal asing penuh dengan hak legal lengkap untuk beroperasi dan berpenghasilan di Indonesia.',
                    'duration' => 'Perpetual Corporate Entity',
                    'processingTime' => '5 - 7 Business Days',
                    'whoFor' => $lang === 'en'
                        ? 'Entrepreneurs, global startups, and foreign corporations establishing a presence in Bali or Jakarta.'
                        : 'Wirausahawan, startup global, dan korporasi asing yang ingin ekspansi ke Bali atau Jakarta.',
                    'tag' => 'Top Corporate Solution',
                    'badge' => 'Full Ownership',
                    'icon' => 'fa-building',
                    'requirements' => [
                        'Passports of minimum 2 shareholders (Individual or Corporate)',
                        'Proposed company name (3 words in English or Indonesian)',
                        'Standard KBLI business activities selection',
                        'Office lease agreement or approved Virtual Office contract',
                        'Board of Directors and Commissioner structure'
                    ],
                    'perks' => [
                        '100% Foreign ownership across most industry sectors',
                        'Includes NIB, Corporate Tax ID (NPWP), and OSS RBA license',
                        'Enables issuing Investor KITAS for founders and staff',
                        'Corporate bank account opening assistance with tier-1 banks',
                        'Full legal deed approved by Kemenkumham'
                    ]
                ],
                [
                    'id' => 'remote-worker-visa',
                    'category' => 'visas',
                    'code' => 'Index E33G (Digital Nomad)',
                    'title' => $lang === 'en' ? 'Remote Worker Visa (Digital Nomad)' : 'Visa Pekerja Jarak Jauh (Remote Worker E33G)',
                    'shortDesc' => $lang === 'en'
                        ? 'Official 1-year residency visa for digital nomads and remote professionals earning foreign income while living in Indonesia.'
                        : 'Visa resmi 1 tahun bagi pekerja remote dan digital nomad berpenghasilan luar negeri untuk tinggal di Indonesia.',
                    'duration' => '1 Year (Renewable)',
                    'processingTime' => '5 - 7 Business Days',
                    'whoFor' => $lang === 'en'
                        ? 'Software engineers, remote consultants, online creators working for clients/employers outside Indonesia.'
                        : 'Software engineer, konsultan remote, kreator online yang bekerja untuk klien/perusahaan luar negeri.',
                    'tag' => 'Bali Nomad Favorite',
                    'badge' => 'Tax Friendly',
                    'icon' => 'fa-laptop',
                    'requirements' => [
                        'Passport valid min. 18 months',
                        'Proof of employment or contract with offshore employer',
                        'Proof of overseas annual income min. USD 60,000',
                        'Bank statement showing minimum USD 2,000',
                        'White background passport photo'
                    ],
                    'perks' => [
                        'Zero local tax on overseas salary / client income',
                        '1-year multi-entry flexibility',
                        'Legally reside in Bali, Jakarta, Lombok, etc.',
                        'Eligible for local mobile subscriptions and rentals',
                        'No Indonesian company sponsorship required'
                    ]
                ],
                [
                    'id' => 'working-kitas',
                    'category' => 'kitas',
                    'code' => 'Index E23 (Expatriate Work Permit)',
                    'title' => $lang === 'en' ? 'Working KITAS & Work Permit (E23)' : 'KITAS Kerja & Izin Kerja Tenaga Asing (E23)',
                    'shortDesc' => $lang === 'en'
                        ? 'Official work authorization and residency permit for foreign experts employed by Indonesian companies or PT PMA.'
                        : 'Izin kerja dan izin tinggal resmi bagi tenaga kerja asing (TKA) yang dipekerjakan oleh PT PMA atau perusahaan lokal.',
                    'duration' => '6 Months or 1 Year (Renewable)',
                    'processingTime' => '10 - 14 Business Days',
                    'whoFor' => $lang === 'en'
                        ? 'Expatriate managers, tech specialists, chefs, teachers, and technical advisors.'
                        : 'Manajer ekspatriat, spesialis teknis, koki, pengajar, dan konsultan profesional.',
                    'tag' => 'Corporate Essential',
                    'badge' => 'Full Work Rights',
                    'icon' => 'fa-id-card',
                    'requirements' => [
                        'Company RPTKA (Expatriate Placement Plan approval)',
                        'Applicant university degree & relevant resume/CV',
                        'Minimum 5 years of verified industry experience',
                        'Payment of DPKK ($100/month to Ministry of Manpower)',
                        'Passport valid min. 18 months'
                    ],
                    'perks' => [
                        'Full legal permission to receive local Indonesian salary',
                        'Multi-entry re-entry permit included',
                        'Spouse and children can obtain Dependent KITAS',
                        'Driver\'s license (SIM) and local banking eligibility',
                        'VIP biometric guidance at immigration'
                    ]
                ],
                [
                    'id' => 'b211a-visit-visa',
                    'category' => 'visas',
                    'code' => 'Index C1 / C2 (B211A)',
                    'title' => $lang === 'en' ? 'Visit Visa B211A (Tourism & Business)' : 'Visa Kunjungan B211A (Wisata & Bisnis)',
                    'shortDesc' => $lang === 'en'
                        ? 'The versatile 60-day single entry visa, extendable up to 180 days total without leaving Indonesia.'
                        : 'Visa kunjungan serbaguna 60 hari yang dapat diperpanjang hingga total 180 hari tanpa perlu keluar dari Indonesia.',
                    'duration' => '60 Days (Extendable 2x for 60 days each)',
                    'processingTime' => '3 - 5 Business Days (Express 24h available)',
                    'whoFor' => $lang === 'en'
                        ? 'Long-stay tourists, business meeting attendees, prospective investors scouting market opportunities.'
                        : 'Turis tinggal lama, perjalanan dinas/rapat bisnis, calon investor yang sedang riset pasar.',
                    'tag' => 'Fastest Approval',
                    'badge' => 'Up to 180 Days',
                    'icon' => 'fa-plane',
                    'requirements' => [
                        'Passport valid min. 6 months',
                        'Recent passport-style photograph',
                        'Bank statement with minimum balance of USD 2,000',
                        'Return or onward flight ticket',
                        'Local sponsor letter (OneCoreVisa provides this)'
                    ],
                    'perks' => [
                        'No border run needed for up to 6 months',
                        'Guaranteed local company sponsorship provided',
                        'Convertible onshore to KITAS in eligible categories',
                        '100% online application with digital eVisa delivery',
                        'Covers business negotiations and conferences'
                    ]
                ],
                [
                    'id' => 'evoa-express',
                    'category' => 'visas',
                    'code' => 'Electronic Visa on Arrival',
                    'title' => $lang === 'en' ? 'e-VOA Fast-Track (30/60 Days)' : 'e-VOA Kilat (30/60 Hari)',
                    'shortDesc' => $lang === 'en'
                        ? 'Instant electronic visa on arrival for citizens of 97 eligible countries. Skip airport queues completely.'
                        : 'Visa on arrival elektronik kilat untuk warga negara dari 97 negara. Bebas antrean bandara.',
                    'duration' => '30 Days (Extendable 1x for 30 days)',
                    'processingTime' => '24 Hours (Express 3 Hours)',
                    'whoFor' => $lang === 'en'
                        ? 'Short-term holiday travelers, conference attendees, and quick commercial visits.'
                        : 'Wisatawan liburan singkat, peserta seminar, dan kunjungan bisnis kilat.',
                    'tag' => 'Instant Travel',
                    'badge' => 'Skip Airport Queues',
                    'icon' => 'fa-passport',
                    'requirements' => [
                        'Passport valid min. 6 months',
                        'Digital passport bio-page scan',
                        'Flight itinerary / Return ticket',
                        'Portrait photo on light background'
                    ],
                    'perks' => [
                        'Use autogates at Jakarta & Bali airports (no immigration queue)',
                        'OneCoreVisa handles extension smoothly online',
                        'Delivered directly to WhatsApp & Email in PDF',
                        'Zero airport cash currency hassle'
                    ]
                ],
                [
                    'id' => 'spouse-family-kitas',
                    'category' => 'kitas',
                    'code' => 'Index E31A / E31B',
                    'title' => $lang === 'en' ? 'Spouse & Family KITAS' : 'KITAS Pasangan & Keluarga (Penyatuan Keluarga)',
                    'shortDesc' => $lang === 'en'
                        ? 'Residency permit for foreign nationals legally married to Indonesian citizens or dependents of KITAS holders.'
                        : 'Izin tinggal bagi WNA yang menikah sah dengan WNI atau keluarga tanggungan pemegang KITAS.',
                    'duration' => '1 Year (Renewable up to Permanent KITAP)',
                    'processingTime' => '7 - 10 Business Days',
                    'whoFor' => $lang === 'en'
                        ? 'Foreign spouses of Indonesian citizens, children, and immediate dependents.'
                        : 'Suami/istri WNA dari WNI, anak-anak, dan tanggungan langsung.',
                    'tag' => 'Family Harmony',
                    'badge' => 'Pathway to KITAP',
                    'icon' => 'fa-users',
                    'requirements' => [
                        'Official Marriage Certificate (Buku Nikah / Catatan Sipil)',
                        'Indonesian Spouse KTP, KK, and Birth Certificate',
                        'Indonesian Spouse Bank Statement',
                        'Foreign Applicant Passport valid min. 18 months',
                        'Clean criminal and health declaration'
                    ],
                    'perks' => [
                        'Right to reside peacefully with your family in Indonesia',
                        'Pathway to 5-Year Permanent Residency (KITAP) after 2 years',
                        'Exempt from DPKK work tax fee',
                        'Eligible for Indonesian driver\'s license and local bank accounts',
                        'Multi-entry travel privileges'
                    ]
                ],
                [
                    'id' => 'retirement-kitas',
                    'category' => 'kitas',
                    'code' => 'Index E33F (55+ Years Old)',
                    'title' => $lang === 'en' ? 'Retirement KITAS (Index E33F)' : 'KITAS Pensiun Lansia (Usia 55+ Tahun)',
                    'shortDesc' => $lang === 'en'
                        ? 'Enjoy your golden years living in tropical paradise with an official multi-year retirement residency permit.'
                        : 'Nikmati masa pensiun tenang di Bali dan Indonesia dengan izin tinggal resmi tahunan untuk lansia.',
                    'duration' => '1 Year (Renewable annually up to 5 Years / KITAP)',
                    'processingTime' => '7 - 10 Business Days',
                    'whoFor' => $lang === 'en'
                        ? 'Foreign citizens aged 55 or above seeking long-term living in Bali, Yogyakarta, or Lombok.'
                        : 'WNA berusia 55 tahun ke atas yang ingin menikmati masa pensiun di Bali atau wilayah Indonesia lainnya.',
                    'tag' => 'Peaceful Living',
                    'badge' => 'No Business Needed',
                    'icon' => 'fa-umbrella-beach',
                    'requirements' => [
                        'Passport valid min. 18 months',
                        'Proof of age 55 years old or older',
                        'Proof of pension / income (min. USD 3,000/month or USD 36,000 in savings)',
                        'Health & life insurance coverage in Indonesia',
                        'Rental lease agreement in Indonesia (min. 1 year)'
                    ],
                    'perks' => [
                        'Live freely across Indonesia year-round',
                        'Open local Indonesian bank accounts',
                        'Multi-entry permit included',
                        'Can hire domestic helpers / staff legally',
                        'Eligible for Indonesian driver\'s license'
                    ]
                ],
                [
                    'id' => 'virtual-office-domicile',
                    'category' => 'business',
                    'code' => 'Bali & Jakarta Prime Address',
                    'title' => $lang === 'en' ? 'Virtual Office & Domicile Registration' : 'Virtual Office & Surat Keterangan Domisili',
                    'shortDesc' => $lang === 'en'
                        ? 'Legally compliant prestigious business address required for PT PMA incorporation and tax administration.'
                        : 'Alamat bisnis bergengsi dan legal yang memenuhi syarat untuk pendirian PT PMA dan pendaftaran pajak.',
                    'duration' => '1 Year Subscription (Renewable)',
                    'processingTime' => '1 - 2 Business Days',
                    'whoFor' => $lang === 'en'
                        ? 'Digital businesses, international founders, and startups not requiring physical commercial space.'
                        : 'Bisnis digital, founder internasional, dan startup yang belum membutuhkan sewa kantor fisik penuh.',
                    'tag' => 'Cost Efficiency',
                    'badge' => 'Tax Approved',
                    'icon' => 'fa-map-location-dot',
                    'requirements' => [
                        'Company name and director details',
                        'Selected city preference (Jakarta CBD or Bali)',
                        'Intended KBLI business classification'
                    ],
                    'perks' => [
                        'Save 90% compared to physical commercial leases',
                        'Approved for OSS RBA, NIB, and NPWP registration',
                        'Mail and package handling with WhatsApp notifications',
                        'Access to meeting rooms for VIP clients',
                        'Official building domicile certificate provided'
                    ]
                ],
                [
                    'id' => 'oss-rba-nib-permits',
                    'category' => 'legal',
                    'code' => 'Online Single Submission RBA',
                    'title' => $lang === 'en' ? 'OSS RBA, NIB & Sectoral Business Licenses' : 'Perizinan Berusaha OSS-RBA, NIB & Izin Sektoral',
                    'shortDesc' => $lang === 'en'
                        ? 'Obtaining your Nomor Induk Berusaha (NIB) and risk-based sectoral licenses (Pariwisata, Perdagangan, IT, etc.).'
                        : 'Penerbitan Nomor Induk Berusaha (NIB) dan sertifikat standar izin sektoral berbasis risiko.',
                    'duration' => 'Perpetual / Subject to Industry Regulations',
                    'processingTime' => '3 - 5 Business Days',
                    'whoFor' => $lang === 'en'
                        ? 'Existing or newly formed companies requiring operational permits for villas, F&B, imports, or consulting.'
                        : 'Perusahaan baru maupun berjalan yang butuh izin operasional villa, resto, ekspor-impor, atau IT.',
                    'tag' => 'Regulatory Compliance',
                    'badge' => 'OSS Certified',
                    'icon' => 'fa-file-signature',
                    'requirements' => [
                        'Company Akta & Kemenkumham Decree',
                        'Company NPWP & Director Tax numbers',
                        'Selected KBLI codes (5-digit classification)',
                        'Location verification data'
                    ],
                    'perks' => [
                        'Operate 100% legally without risk of municipal closure',
                        'Includes Import Identification Number (API) if needed',
                        'Customs access code (Kepabeanan)',
                        'Standard Certificate compliance verification',
                        'Government audit defense support'
                    ]
                ],
                [
                    'id' => 'corporate-tax-bank',
                    'category' => 'legal',
                    'code' => 'Tax & Banking Integration',
                    'title' => $lang === 'en' ? 'Corporate Tax ID & Bank Account Opening' : 'NPWP Perusahaan & Pembukaan Rekening Bank',
                    'shortDesc' => $lang === 'en'
                        ? 'Registration of NPWP Badan, EFIN, and VIP concierge assistance to open corporate accounts in top Indonesian banks.'
                        : 'Pendaftaran NPWP Badan, aktivasi EFIN, serta pendampingan VIP pembukaan rekening bank devisa korporat.',
                    'duration' => 'Ongoing Corporate Lifecycle',
                    'processingTime' => '3 - 5 Business Days',
                    'whoFor' => $lang === 'en'
                        ? 'PT PMA companies needing foreign exchange accounts (USD/EUR/IDR) and tax compliance setup.'
                        : 'PT PMA yang memerlukan rekening giro multi-mata uang dan aktivasi pelaporan pajak resmi.',
                    'tag' => 'Essential Financials',
                    'badge' => 'Tier-1 Banks',
                    'icon' => 'fa-landmark',
                    'requirements' => [
                        'Company Akta, SK Kemenkumham, NIB',
                        'Director Passport & KITAS copy',
                        'Company Stamp & Signature Card',
                        'Initial minimum deposit'
                    ],
                    'perks' => [
                        'VIP introduction to Bank Mandiri, BCA, and Permata',
                        'Multi-currency corporate accounts (IDR, USD, EUR, AUD)',
                        'Internet banking and token setup assistance',
                        'Corporate tax compliance briefing by tax consultants',
                        'Monthly tax filing readiness'
                    ]
                ],
                [
                    'id' => 'legal-contracts-drafting',
                    'category' => 'legal',
                    'code' => 'Commercial Legal Advisory',
                    'title' => $lang === 'en' ? 'Contract Drafting & Legal Due Diligence' : 'Penyusunan Kontrak Bisnis & Uji Kelayakan Hukum',
                    'shortDesc' => $lang === 'en'
                        ? 'Bilingual drafting of shareholder pacts, employment contracts, villa lease agreements, and corporate due diligence.'
                        : 'Penyusunan perjanjian dwibahasa (pemegang saham, sewa villa, ketenagakerjaan) dan audit legalitas.',
                    'duration' => 'Project-based or Monthly Retainer',
                    'processingTime' => '3 - 5 Business Days',
                    'whoFor' => $lang === 'en'
                        ? 'Property leaseholders, foreign business partners, and employers in Indonesia.'
                        : 'Penyewa properti/tanah di Bali, mitra bisnis asing, dan pengusaha yang mempekerjakan staf.',
                    'tag' => 'Risk Protection',
                    'badge' => 'Certified Advocates',
                    'icon' => 'fa-scale-balanced',
                    'requirements' => [
                        'Commercial transaction brief or deal summary',
                        'Identification of contracting parties',
                        'Property land certificates (Sertifikat Hak Milik / HGB) if leasehold'
                    ],
                    'perks' => [
                        'Enforceable bilingual contracts (Indonesian & English)',
                        'Land title search at BPN to prevent fraud',
                        'Employment contracts compliant with Omnibus Law',
                        'Protection of shareholder dividend rights',
                        'Official legal legal opinion signed by certified lawyer'
                    ]
                ]
            ],
            'process' => [
                [
                    'step' => '01',
                    'title' => $lang === 'en' ? 'Free Strategic Assessment' : 'Konsultasi & Analisis Strategis Gratis',
                    'timeline' => $lang === 'en' ? 'Within 2 Hours' : 'Dalam 2 Jam',
                    'desc' => $lang === 'en'
                        ? 'We review your personal or corporate background, stay duration, and business goals to determine the safest, most cost-effective visa or company structure.'
                        : 'Kami mempelajari profil, durasi tinggal, atau model bisnis Anda untuk merekomendasikan opsi visa atau struktur legal yang paling hemat dan aman.',
                    'icon' => 'fa-headset'
                ],
                [
                    'step' => '02',
                    'title' => $lang === 'en' ? 'Document Verification & Preparation' : 'Verifikasi & Penyusunan Dokumen',
                    'timeline' => $lang === 'en' ? 'Day 1 - 2' : 'Hari 1 - 2',
                    'desc' => $lang === 'en'
                        ? 'Our legal team inspects your documents, performs sworn translations if required, drafts corporate resolutions, and ensures zero discrepancies before submission.'
                        : 'Tim hukum kami memeriksa kelengkapan berkas, menyusun surat sponsor resmi, terjemahan tersumpah bila dibutuhkan, memastikan berkas 100% valid.',
                    'icon' => 'fa-file-circle-check'
                ],
                [
                    'step' => '03',
                    'title' => $lang === 'en' ? 'Government Portal Filing & Processing' : 'Pengajuan ke Portal Resmi Pemerintah',
                    'timeline' => $lang === 'en' ? 'Day 3 - 7' : 'Hari 3 - 7',
                    'desc' => $lang === 'en'
                        ? 'We lodge your application directly with Ditjen Imigrasi, BKPM OSS, or the Ministry of Law and Human Rights (Kemenkumham), closely tracking every milestone.'
                        : 'Pendaftaran langsung ke sistem Ditjen Imigrasi, BKPM OSS, atau Kemenkumham, serta pemantauan status proses harian.',
                    'icon' => 'fa-paper-plane'
                ],
                [
                    'step' => '04',
                    'title' => $lang === 'en' ? 'Approval, VIP Biometrics & Handover' : 'Persetujuan, Biometrik VIP & Serah Terima',
                    'timeline' => $lang === 'en' ? 'Guaranteed SLA' : 'Sesuai SLA Garansi',
                    'desc' => $lang === 'en'
                        ? 'Your official eVisa, e-KITAS, or Corporate Deed & NIB is issued. For KITAS, we provide a VIP escort during your immigration biometric photo session.'
                        : 'eVisa / e-KITAS atau Akta & NIB resmi terbit. Kami dampingi langsung saat perekaman biometrik di kantor imigrasi hingga tuntas.',
                    'icon' => 'fa-award'
                ]
            ],
            'faqs' => [
                [
                    'q' => $lang === 'en'
                        ? 'Can foreigners own 100% of a company in Indonesia (PT PMA)?'
                        : 'Apakah warga negara asing bisa memiliki 100% saham PT PMA di Indonesia?',
                    'a' => $lang === 'en'
                        ? 'Yes! Under the Indonesian Positive Investment List (Perpres 10/2021 and Omnibus Law), the vast majority of business classifications (KBLI) allow up to 100% foreign ownership. Only a few strategic sectors (such as defense or traditional micro-retail) remain restricted. OneCoreVisa will analyze your specific KBLI codes to confirm 100% ownership eligibility before you invest.'
                        : 'Ya! Berdasarkan Perpres No. 10/2021 (Daftar Positif Investasi) dan UU Cipta Kerja, sebagian besar sektor bisnis (KBLI) kini terbuka hingga 100% kepemilikan asing. Hanya beberapa bidang khusus seperti pertahanan atau ritel tradisional yang dibatasi. Tim OneCoreVisa akan memeriksa kode KBLI bisnis Anda untuk memastikan kepemilikan penuh 100% sebelum memulai.'
                ],
                [
                    'q' => $lang === 'en'
                        ? 'What is the difference between B211A Visit Visa and KITAS?'
                        : 'Apa perbedaan antara Visa Kunjungan B211A dan KITAS?',
                    'a' => $lang === 'en'
                        ? 'A B211A is a temporary visit visa valid initially for 60 days (extendable up to 180 days), ideal for long holidays, business meetings, or exploring investments, but it does NOT permit working or receiving local salaries. A KITAS (Kartu Izin Tinggal Terbatas) is an official multi-entry residency permit (1-2 years) that grants formal rights to live, open bank accounts, invest (Investor KITAS), or work legally (Working KITAS with RPTKA).'
                        : 'B211A adalah visa kunjungan sementara berlaku 60 hari awal (bisa diperpanjang hingga total 180 hari), cocok untuk liburan panjang, survei bisnis, atau menghadiri rapat, namun TIDAK mengizinkan bekerja lokal. Sedangkan KITAS adalah Izin Tinggal Terbatas (1-2 tahun) yang memberikan hak resmi untuk tinggal, membuka rekening bank, berinvestasi (KITAS Investor), atau bekerja resmi (KITAS Kerja dengan RPTKA).'
                ],
                [
                    'q' => $lang === 'en'
                        ? 'Do I need to leave Indonesia to change from a tourist visa to a KITAS?'
                        : 'Apakah saya harus keluar dari Indonesia untuk beralih dari visa turis ke KITAS?',
                    'a' => $lang === 'en'
                        ? 'In most cases, NO! With modern Indonesian onshore visa regulations, if you hold an eligible visit visa (such as B211A), OneCoreVisa can apply for an Onshore KITAS conversion without requiring you to leave the country or perform expensive border runs to Singapore or Malaysia.'
                        : 'Pada sebagian besar kasus, TIDAK PERLU! Berdasarkan regulasi visa onshore saat ini, jika Anda memiliki visa kunjungan yang sesuai (seperti B211A), OneCoreVisa dapat memproses alih status ke KITAS Onshore secara langsung tanpa perlu Anda keluar negeri atau terbang bolak-balik ke Singapura.'
                ],
                [
                    'q' => $lang === 'en'
                        ? 'What are the advantages of the Investor KITAS (Index E28A/E28B)?'
                        : 'Apa keuntungan utama dari KITAS Investor (Index E28A/E28B)?',
                    'a' => $lang === 'en'
                        ? 'The Investor KITAS is one of the most cost-effective and flexible permits. It is issued for 1 or 2 years, allows unlimited multiple entries, exempts you from paying the mandatory $1,200/year DPKK government work tax, permits you to sponsor your family dependents, and allows you to oversee your PT PMA operations legally.'
                        : 'KITAS Investor adalah izin tinggal yang paling fleksibel dan hemat bagi founder. Berlaku 1 atau 2 tahun, multi-entry bebas keluar masuk, BEBAS dari biaya pajak tenaga kerja asing (DPKK $1.200/tahun), dapat mensponsori keluarga, dan memberi kewenangan legal penuh untuk mengawasi operasional PT PMA Anda.'
                ],
                [
                    'q' => $lang === 'en'
                        ? 'How long does it take to establish a PT PMA with OneCoreVisa?'
                        : 'Berapa lama proses pendirian PT PMA bersama OneCoreVisa?',
                    'a' => $lang === 'en'
                        ? 'With our streamlined corporate legal pipeline, complete incorporation—including Deed of Establishment, Kemenkumham Ministerial Approval, NIB (Nomor Induk Berusaha), and Corporate Tax ID (NPWP)—typically takes only 5 to 7 business days once required documents and company details are approved.'
                        : 'Dengan jalur legal korporasi OneCoreVisa, seluruh proses pendirian—termasuk Akta Notaris, SK Pengesahan Kemenkumham, NIB (Nomor Induk Berusaha), dan NPWP Badan—umumnya hanya memakan waktu 5 hingga 7 hari kerja setelah seluruh dokumen terverifikasi.'
                ]
            ],
            'testimonials' => [
                [
                    'quote' => $lang === 'en'
                        ? 'OneCoreVisa handled our PT PMA and two Investor KITAS flawlessly in less than two weeks. Their legal team is responsive, transparent with costs, and guided us directly through the biometric appointment in Denpasar.'
                        : 'OneCoreVisa menyelesaikan pendirian PT PMA dan dua KITAS Investor kami dalam waktu kurang dari 2 minggu. Tim hukumnya sangat responsif, transparan, dan mendampingi kami langsung saat sesi biometrik di Denpasar.',
                    'client' => 'Marcus Lindqvist',
                    'role' => $lang === 'en' ? 'Co-Founder, Nordic Tech Ventures' : 'Co-Founder, Nordic Tech Ventures',
                    'country' => 'Sweden 🇸🇪',
                    'service' => 'PT PMA + Investor KITAS E28A'
                ],
                [
                    'quote' => $lang === 'en'
                        ? 'Switching from my B211A to the new Remote Worker Visa (E33G) was totally painless. I did not have to fly to Singapore or deal with sketchy middlemen. OneCoreVisa is the gold standard for foreigners in Indonesia.'
                        : 'Beralih dari B211A ke Visa Pekerja Jarak Jauh (E33G) sangat mudah dan lancar. Saya tidak perlu terbang ke Singapura atau berhubungan dengan calo tidak jelas. OneCoreVisa benar-benar standar emas di Indonesia.',
                    'client' => 'Sarah Jenkins',
                    'role' => $lang === 'en' ? 'Senior UX Director & Digital Nomad' : 'Senior UX Director & Digital Nomad',
                    'country' => 'Australia 🇦🇺',
                    'service' => 'Remote Worker Visa E33G'
                ],
                [
                    'quote' => $lang === 'en'
                        ? 'Securing our company NIB, virtual office, and corporate bank account in Jakarta usually takes months. With OneCoreVisa, everything was completed in 7 days with zero hidden fees. Highly recommended!'
                        : 'Mengurus NIB perusahaan, virtual office, dan rekening bank di Jakarta biasanya makan waktu berbulan-bulan. Bersama OneCoreVisa, semuanya selesai dalam 7 hari tanpa biaya tersembunyi. Sangat direkomendasikan!',
                    'client' => 'David Chen',
                    'role' => $lang === 'en' ? 'Managing Director, APAC Logistics' : 'Managing Director, APAC Logistics',
                    'country' => 'Singapore 🇸🇬',
                    'service' => 'PT PMA Setup & Virtual Office'
                ]
            ]
        ];
    }

    /**
     * Homepage displaying all 5 sections
     */
    public function index(Request $request)
    {
        $lang = session('locale', 'en');
        if ($request->has('lang')) {
            $lang = in_array($request->lang, ['en', 'id']) ? $request->lang : 'en';
            session(['locale' => $lang]);
        }

        $data = $this->getData($lang);
        $data['lang'] = $lang;

        return view('home', $data);
    }

    /**
     * Switch language route
     */
    public function switchLang($locale)
    {
        if (in_array($locale, ['en', 'id'])) {
            session(['locale' => $locale]);
        }
        return redirect()->back();
    }

    /**
     * Submit consultation inquiry
     */
    public function submitConsultation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'whatsapp' => 'required|string|max:50',
            'email' => 'nullable|email|max:150',
            'nationality' => 'required|string|max:100',
            'service' => 'nullable|string|max:150',
            'location' => 'nullable|string|max:150',
            'notes' => 'nullable|string|max:1000',
        ]);

        $name = urlencode($validated['name']);
        $whatsapp = urlencode($validated['whatsapp']);
        $email = urlencode($validated['email'] ?? '-');
        $nationality = urlencode($validated['nationality']);
        $service = urlencode($validated['service'] ?? 'Konsultasi Visa & PT PMA');
        $location = urlencode($validated['location'] ?? 'Indonesia');
        $notes = urlencode($validated['notes'] ?? 'Mohon informasi estimasi biaya dan persyaratan.');

        $text = "Halo OneCoreVisa,%0A%0ASaya ingin konsultasi layanan:%0A- Nama: {$name}%0A- WhatsApp: {$whatsapp}%0A- Email: {$email}%0A- Kewarganegaraan: {$nationality}%0A- Layanan: {$service}%0A- Lokasi: {$location}%0A- Catatan: {$notes}%0A%0AMohon bantuan konsultan hukum OneCoreVisa. Terima kasih!";

        $whatsappUrl = "https://wa.me/6281298765432?text={$text}";

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Consultation inquiry received!',
                'whatsapp_url' => $whatsappUrl
            ]);
        }

        return redirect($whatsappUrl);
    }
}
