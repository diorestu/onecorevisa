<?php

namespace App\Http\Controllers;

use App\Support\SiteSeo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Get multilingual website data
     */
    protected function getData($lang = 'en')
    {
        $lang = $lang === 'id' ? 'id' : 'en';
        return [
            'categories' => [
                [
                    'id' => 'visitor-visas',
                    'title' => $lang === 'en' ? 'Visitor Visas' : 'Visa Kunjungan',
                    'subtitle' => $lang === 'en' ? 'Single & Multiple Entry' : 'Single & Multiple Entry',
                    'icon' => 'fa-plane-departure',
                ],
                [
                    'id' => 'visa-extension',
                    'title' => $lang === 'en' ? 'Visa & KITAS Extension' : 'Perpanjangan Visa & KITAS',
                    'subtitle' => $lang === 'en' ? 'Stay Permit Extensions' : 'Perpanjangan Masa Izin Tinggal',
                    'icon' => 'fa-clock-rotate-left',
                ],
                [
                    'id' => 'kitas',
                    'title' => $lang === 'en' ? 'Work & Longer Stay (KITAS)' : 'Izin Tinggal Terbatas (KITAS)',
                    'subtitle' => $lang === 'en' ? 'Investor, Worker, Nomad & Family' : 'Investor, Pekerja, Nomad & Keluarga',
                    'icon' => 'fa-id-card',
                ],
                [
                    'id' => 'kitap',
                    'title' => $lang === 'en' ? 'Permanent Residency (KITAP)' : 'Izin Tinggal Tetap (KITAP)',
                    'subtitle' => $lang === 'en' ? '5-Year & Permanent Status' : 'Status 5 Tahun & Permanen',
                    'icon' => 'fa-award',
                ],
                [
                    'id' => 'company',
                    'title' => $lang === 'en' ? 'Company Formation' : 'Pendirian Perusahaan',
                    'subtitle' => $lang === 'en' ? 'PT PMA & Local PT' : 'PT PMA & PT Lokal',
                    'icon' => 'fa-building',
                ],
            ],
            'services' => [
                [
                    'id' => 'voa-b1',
                    'thumbnail' => 'service-documents.webp',
                    'category' => 'visitor-visas',
                    'code' => 'Index B1',
                    'title' => 'Visa On Arrival / E-VOA (B1)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '30 Days (Extendable 1x for 30 Days, Max 60 Days)',
                    'processingTime' => '1 - 3 Working Days',
                    'visaValidity' => '90 Days from the issuance date of the e-VOA.',
                    'whatsAllowed' => [
                        'Tourism, vacation, family/social visits.',
                        'Attend business meetings, conventions, and exhibitions as a participant.'
                    ],
                    'whatsNotAllowed' => [
                        'Engage in paid employment or work for an Indonesian entity.',
                        'Overstay the validity period of the stay permit.'
                    ],
                    'documentRequirements' => [
                        'Passport valid for at least 6 months upon arrival.',
                        'Recent color photograph.',
                        'Return or onward flight ticket from Indonesia.'
                    ],
                    'icon' => 'fa-passport',
                    'badge' => 'Fast Entry',
                    'duration' => '30 Days (Extendable 1x for 30 Days, Max 60 Days)',
                    'requirements' => [
                        'Passport valid for at least 6 months upon arrival.',
                        'Recent color photograph.',
                        'Return or onward flight ticket from Indonesia.'
                    ],
                    'perks' => [
                        'Tourism, vacation, family/social visits.',
                        'Attend business meetings, conventions, and exhibitions as a participant.'
                    ],
                    'shortDesc' => '30 Days (Extendable 1x for 30 Days, Max 60 Days)' . ' • ' . '1 - 3 Working Days',
                    'whoFor' => 'Visa On Arrival / E-VOA (B1)',
                    'tag' => 'Index B1'
                ],
                [
                    'id' => 'c1-tourist-visa',
                    'thumbnail' => 'header-slider3.webp',
                    'category' => 'visitor-visas',
                    'code' => 'Index C1',
                    'title' => 'C1 - Tourist Visit Visa (60 Days)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '60 Days (Extendable 2x, 60 days each, up to 180 days total)',
                    'processingTime' => 'Regular: 5 - 10 Working Days • Priority: 2 - 4 Working Days',
                    'visaValidity' => 'Must be used within 90 days from the date of issuance.',
                    'whatsAllowed' => [
                        'Tourism, vacation, and visiting friends or family.',
                        'Attending cultural events, seminars, or non-commercial conferences.'
                    ],
                    'whatsNotAllowed' => [
                        'Work locally or receive a salary from an Indonesian entity.',
                        'Re-enter Indonesia with the same visa after leaving (Single Entry).'
                    ],
                    'documentRequirements' => [
                        'Passport valid for at least 6 months.',
                        'Recent passport-size color photograph.',
                        'Bank statement proving minimum funds of USD $2,000 for the last 3 months.',
                        'Return flight ticket.',
                        'Local sponsor guarantee.'
                    ],
                    'icon' => 'fa-umbrella-beach',
                    'badge' => 'Popular Tourist',
                    'duration' => '60 Days (Extendable 2x, 60 days each, up to 180 days total)',
                    'requirements' => [
                        'Passport valid for at least 6 months.',
                        'Recent passport-size color photograph.',
                        'Bank statement proving minimum funds of USD $2,000 for the last 3 months.',
                        'Return flight ticket.',
                        'Local sponsor guarantee.'
                    ],
                    'perks' => [
                        'Tourism, vacation, and visiting friends or family.',
                        'Attending cultural events, seminars, or non-commercial conferences.'
                    ],
                    'shortDesc' => '60 Days (Extendable 2x, 60 days each, up to 180 days total)' . ' • ' . 'Regular: 5 - 10 Working Days • Priority: 2 - 4 Working Days',
                    'whoFor' => 'C1 - Tourist Visit Visa (60 Days)',
                    'tag' => 'Index C1'
                ],
                [
                    'id' => 'c2-business-visa',
                    'thumbnail' => 'service-business.webp',
                    'category' => 'visitor-visas',
                    'code' => 'Index C2',
                    'title' => 'C2 - Business Visit Visa (60 Days)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '60 Days (Extendable 2x, up to 180 days total)',
                    'processingTime' => 'Regular: 5 - 10 Working Days • Priority: 2 - 4 Working Days',
                    'visaValidity' => 'Must be used within 90 days from the date of issuance.',
                    'whatsAllowed' => [
                        'Conduct business meetings, negotiations, and discussions with Indonesian partners.',
                        'Inspect business sites, attend trade fairs, and sign commercial contracts.'
                    ],
                    'whatsNotAllowed' => [
                        'Engage in hands-on operational work, manual labor, or sell goods/services locally.',
                        'Receive compensation or salary from domestic Indonesian sources.'
                    ],
                    'documentRequirements' => [
                        'Passport valid for at least 6 months.',
                        'Recent color photograph.',
                        'Business invitation letter from an Indonesian counterpart/sponsor or a sponsor guarantee.',
                        'Bank statement showing min. USD $2,000 equivalent.',
                        'Return/onward travel ticket.'
                    ],
                    'icon' => 'fa-briefcase',
                    'badge' => 'Business Meetings',
                    'duration' => '60 Days (Extendable 2x, up to 180 days total)',
                    'requirements' => [
                        'Passport valid for at least 6 months.',
                        'Recent color photograph.',
                        'Business invitation letter from an Indonesian counterpart/sponsor or a sponsor guarantee.',
                        'Bank statement showing min. USD $2,000 equivalent.',
                        'Return/onward travel ticket.'
                    ],
                    'perks' => [
                        'Conduct business meetings, negotiations, and discussions with Indonesian partners.',
                        'Inspect business sites, attend trade fairs, and sign commercial contracts.'
                    ],
                    'shortDesc' => '60 Days (Extendable 2x, up to 180 days total)' . ' • ' . 'Regular: 5 - 10 Working Days • Priority: 2 - 4 Working Days',
                    'whoFor' => 'C2 - Business Visit Visa (60 Days)',
                    'tag' => 'Index C2'
                ],
                [
                    'id' => 'c12-pre-investment-visa',
                    'thumbnail' => 'service-business.webp',
                    'category' => 'visitor-visas',
                    'code' => 'Index C12',
                    'title' => 'C12 - Pre-Investment Visit Visa (180 Days)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '180 Days (Extendable 1x for an additional 180 days)',
                    'processingTime' => 'Regular: 10 - 14 Working Days • Priority: 5 - 7 Working Days',
                    'visaValidity' => 'Must be used within 90 days from the date of issuance.',
                    'whatsAllowed' => [
                        'Carry out market research, feasibility studies, and pre-investment planning for setting up a PT PMA.',
                        'Survey property, office locations, and negotiate with prospective business partners.'
                    ],
                    'whatsNotAllowed' => [
                        'Perform operational employee duties or serve as active director prior to obtaining a KITAS.',
                        'Receive local income or wages in Indonesia.'
                    ],
                    'documentRequirements' => [
                        'Passport valid for at least 6 months.',
                        'Recent color photograph.',
                        'Proof of sufficient funds (bank statement min. USD $2,000).',
                        'Investment intent statement or study plan.'
                    ],
                    'icon' => 'fa-chart-line',
                    'badge' => '180 Days Stay',
                    'duration' => '180 Days (Extendable 1x for an additional 180 days)',
                    'requirements' => [
                        'Passport valid for at least 6 months.',
                        'Recent color photograph.',
                        'Proof of sufficient funds (bank statement min. USD $2,000).',
                        'Investment intent statement or study plan.'
                    ],
                    'perks' => [
                        'Carry out market research, feasibility studies, and pre-investment planning for setting up a PT PMA.',
                        'Survey property, office locations, and negotiate with prospective business partners.'
                    ],
                    'shortDesc' => '180 Days (Extendable 1x for an additional 180 days)' . ' • ' . 'Regular: 10 - 14 Working Days • Priority: 5 - 7 Working Days',
                    'whoFor' => 'C12 - Pre-Investment Visit Visa (180 Days)',
                    'tag' => 'Index C12'
                ],
                [
                    'id' => 'c6-social-cultural-visa',
                    'thumbnail' => 'service-family.webp',
                    'category' => 'visitor-visas',
                    'code' => 'Index C6 / C6A',
                    'title' => 'C6 / C6A - Social & Cultural Visit Visa (60 Days)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '60 Days (Extendable 2x, up to 180 days total)',
                    'processingTime' => 'Regular: 5 - 10 Working Days • Priority: 2 - 4 Working Days',
                    'visaValidity' => 'Must be used within 90 days from the date of issuance.',
                    'whatsAllowed' => [
                        'Visit family, engage in social, cultural, or educational exchange activities.',
                        'Participate in non-paid volunteering or social organization activities.'
                    ],
                    'whatsNotAllowed' => [
                        'Perform commercial work or receive local compensation.'
                    ],
                    'documentRequirements' => [
                        'Passport valid for at least 6 months.',
                        'Recent color photograph.',
                        'Bank statement (min. USD $2,000).',
                        'Social/family sponsorship document.'
                    ],
                    'icon' => 'fa-people-group',
                    'badge' => 'Social & Culture',
                    'duration' => '60 Days (Extendable 2x, up to 180 days total)',
                    'requirements' => [
                        'Passport valid for at least 6 months.',
                        'Recent color photograph.',
                        'Bank statement (min. USD $2,000).',
                        'Social/family sponsorship document.'
                    ],
                    'perks' => [
                        'Visit family, engage in social, cultural, or educational exchange activities.',
                        'Participate in non-paid volunteering or social organization activities.'
                    ],
                    'shortDesc' => '60 Days (Extendable 2x, up to 180 days total)' . ' • ' . 'Regular: 5 - 10 Working Days • Priority: 2 - 4 Working Days',
                    'whoFor' => 'C6 / C6A - Social & Cultural Visit Visa (60 Days)',
                    'tag' => 'Index C6 / C6A'
                ],
                [
                    'id' => 'c7-arts-music-visa',
                    'thumbnail' => 'header-slider2.webp',
                    'category' => 'visitor-visas',
                    'code' => 'Index C7 / C7A',
                    'title' => 'C7 / C7A - Music, Performing & Arts Visit Visa (60 Days)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '60 Days (According to event duration)',
                    'processingTime' => '7 - 14 Working Days',
                    'visaValidity' => 'Must be used within 90 days from the date of issuance.',
                    'whatsAllowed' => [
                        'Perform in concerts, cultural shows, art exhibitions, or music festivals in Indonesia.',
                        'Conduct filming or artistic activities authorized under official event sponsorship.'
                    ],
                    'whatsNotAllowed' => [
                        'Work for a local employer beyond the scope of the approved event/performance contract.'
                    ],
                    'documentRequirements' => [
                        'Passport valid for at least 6 months.',
                        'Event invitation/recommendation from Ministry of Tourism / relevant Indonesian agency.',
                        'Contract of performance & sponsor documents.'
                    ],
                    'icon' => 'fa-guitar',
                    'badge' => 'Event & Arts',
                    'duration' => '60 Days (According to event duration)',
                    'requirements' => [
                        'Passport valid for at least 6 months.',
                        'Event invitation/recommendation from Ministry of Tourism / relevant Indonesian agency.',
                        'Contract of performance & sponsor documents.'
                    ],
                    'perks' => [
                        'Perform in concerts, cultural shows, art exhibitions, or music festivals in Indonesia.',
                        'Conduct filming or artistic activities authorized under official event sponsorship.'
                    ],
                    'shortDesc' => '60 Days (According to event duration)' . ' • ' . '7 - 14 Working Days',
                    'whoFor' => 'C7 / C7A - Music, Performing & Arts Visit Visa (60 Days)',
                    'tag' => 'Index C7 / C7A'
                ],
                [
                    'id' => 'c13-medical-humanitarian-visa',
                    'thumbnail' => 'service-documents.webp',
                    'category' => 'visitor-visas',
                    'code' => 'Index C13 / C14',
                    'title' => 'C13 / C14 - Medical & Humanitarian Visit Visa (60 Days)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '60 Days (Extendable based on medical requirement)',
                    'processingTime' => '3 - 7 Working Days',
                    'visaValidity' => 'Must be used within 90 days from issuance date.',
                    'whatsAllowed' => [
                        'Undergo medical treatment, health checkups, or therapy at recognized Indonesian hospitals/clinics.',
                        'Accompany immediate family members undergoing medical treatment.'
                    ],
                    'whatsNotAllowed' => [
                        'Conduct commercial business or local employment.'
                    ],
                    'documentRequirements' => [
                        'Passport valid for at least 6 months.',
                        'Official medical recommendation letter from an Indonesian medical institution.'
                    ],
                    'icon' => 'fa-heart-pulse',
                    'badge' => 'Medical & Care',
                    'duration' => '60 Days (Extendable based on medical requirement)',
                    'requirements' => [
                        'Passport valid for at least 6 months.',
                        'Official medical recommendation letter from an Indonesian medical institution.'
                    ],
                    'perks' => [
                        'Undergo medical treatment, health checkups, or therapy at recognized Indonesian hospitals/clinics.',
                        'Accompany immediate family members undergoing medical treatment.'
                    ],
                    'shortDesc' => '60 Days (Extendable based on medical requirement)' . ' • ' . '3 - 7 Working Days',
                    'whoFor' => 'C13 / C14 - Medical & Humanitarian Visit Visa (60 Days)',
                    'tag' => 'Index C13 / C14'
                ],
                [
                    'id' => 'multiple-entry-d1-d2',
                    'thumbnail' => 'header-slider1.webp',
                    'category' => 'visitor-visas',
                    'code' => 'Index D1 / D2',
                    'title' => 'Multiple Entry Visit Visa (D1 / D2 - up to 180 days per visit)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '60 Days per entry (Extendable up to a total of 180 days per visit)',
                    'processingTime' => 'Regular: up to 14 Working Days • Priority: up to 7 Working Days',
                    'visaValidity' => 'Valid for 1, 2, or 5 Years.',
                    'whatsAllowed' => [
                        'Re-enter Indonesia multiple times during the visa validity period.',
                        'Conduct business activities, meetings, family visits, and tourism.'
                    ],
                    'whatsNotAllowed' => [
                        'Work locally for an Indonesian company or receive local salary.'
                    ],
                    'documentRequirements' => [
                        'Passport valid for at least 6 months (1 year) or longer according to visa duration.',
                        'Recent color photograph.',
                        'Personal bank statement (min USD $2,000).'
                    ],
                    'icon' => 'fa-route',
                    'badge' => 'Frequent Flyer',
                    'duration' => '60 Days per entry (Extendable up to a total of 180 days per visit)',
                    'requirements' => [
                        'Passport valid for at least 6 months (1 year) or longer according to visa duration.',
                        'Recent color photograph.',
                        'Personal bank statement (min USD $2,000).'
                    ],
                    'perks' => [
                        'Re-enter Indonesia multiple times during the visa validity period.',
                        'Conduct business activities, meetings, family visits, and tourism.'
                    ],
                    'shortDesc' => '60 Days per entry (Extendable up to a total of 180 days per visit)' . ' • ' . 'Regular: up to 14 Working Days • Priority: up to 7 Working Days',
                    'whoFor' => 'Multiple Entry Visit Visa (D1 / D2 - up to 180 days per visit)',
                    'tag' => 'Index D1 / D2'
                ],
                [
                    'id' => 'voa-extension',
                    'thumbnail' => 'service-documents.webp',
                    'category' => 'visa-extension',
                    'code' => 'Ext. Index B1',
                    'title' => 'E-Visa VOA Extension',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => 'Additional 30 Days (Total 60 Days)',
                    'processingTime' => '3 - 5 Working Days',
                    'visaValidity' => '30 Days from the approval of the extension.',
                    'whatsAllowed' => [
                        'Extend official stay permit without having to leave Indonesia.',
                        'Continue tourism and social activities.'
                    ],
                    'whatsNotAllowed' => [
                        'Be extended more than once (maximum total stay of 60 days).'
                    ],
                    'documentRequirements' => [
                        'Original passport & e-VOA file.',
                        'Recent photograph.',
                        'Return flight ticket.'
                    ],
                    'icon' => 'fa-clock-rotate-left',
                    'badge' => '+30 Days Ext.',
                    'duration' => 'Additional 30 Days (Total 60 Days)',
                    'requirements' => [
                        'Original passport & e-VOA file.',
                        'Recent photograph.',
                        'Return flight ticket.'
                    ],
                    'perks' => [
                        'Extend official stay permit without having to leave Indonesia.',
                        'Continue tourism and social activities.'
                    ],
                    'shortDesc' => 'Additional 30 Days (Total 60 Days)' . ' • ' . '3 - 5 Working Days',
                    'whoFor' => 'E-Visa VOA Extension',
                    'tag' => 'Ext. Index B1'
                ],
                [
                    'id' => 'single-entry-extension',
                    'thumbnail' => 'header-slider2.webp',
                    'category' => 'visa-extension',
                    'code' => 'Ext. C-Series',
                    'title' => 'Single Entry Visa Extension (Extension Visit Visa)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => 'Additional 60 Days per extension (Extendable up to 2x, total 180 Days)',
                    'processingTime' => '7 - 10 Working Days (Including Immigration biometric appointment)',
                    'visaValidity' => '60 Days per extension cycle.',
                    'whatsAllowed' => [
                        'Extend stay for tourism, social, or pre-investment visits in Indonesia.'
                    ],
                    'whatsNotAllowed' => [
                        'Process extension if the visa has passed its expiration date (overstay).'
                    ],
                    'documentRequirements' => [
                        'Original passport.',
                        'Proof of original e-Visa.',
                        'Attendance for photo & fingerprinting at the Immigration Office.'
                    ],
                    'icon' => 'fa-calendar-plus',
                    'badge' => '+60 Days Ext.',
                    'duration' => 'Additional 60 Days per extension (Extendable up to 2x, total 180 Days)',
                    'requirements' => [
                        'Original passport.',
                        'Proof of original e-Visa.',
                        'Attendance for photo & fingerprinting at the Immigration Office.'
                    ],
                    'perks' => [
                        'Extend stay for tourism, social, or pre-investment visits in Indonesia.'
                    ],
                    'shortDesc' => 'Additional 60 Days per extension (Extendable up to 2x, total 180 Days)' . ' • ' . '7 - 10 Working Days (Including Immigration biometric appointment)',
                    'whoFor' => 'Single Entry Visa Extension (Extension Visit Visa)',
                    'tag' => 'Ext. C-Series'
                ],
                [
                    'id' => 'multiple-entry-extension',
                    'thumbnail' => 'header-slider1.webp',
                    'category' => 'visa-extension',
                    'code' => 'Ext. D-Series',
                    'title' => 'Multiple Entry Visa Extension',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => 'Additional 60 Days (Extension of stay permit per arrival period)',
                    'processingTime' => '5 - 7 Working Days',
                    'visaValidity' => 'Subject to the remaining validity of the main visa.',
                    'whatsAllowed' => [
                        'Extend stay permit per entry up to a total of 180 days without leaving the country.'
                    ],
                    'whatsNotAllowed' => [
                        'Stay continuously beyond 180 days without making a re-entry/extension.'
                    ],
                    'documentRequirements' => [
                        'Original passport.',
                        'Proof of active Multiple Entry e-Visa.'
                    ],
                    'icon' => 'fa-arrows-rotate',
                    'badge' => '+60 Days Ext.',
                    'duration' => 'Additional 60 Days (Extension of stay permit per arrival period)',
                    'requirements' => [
                        'Original passport.',
                        'Proof of active Multiple Entry e-Visa.'
                    ],
                    'perks' => [
                        'Extend stay permit per entry up to a total of 180 days without leaving the country.'
                    ],
                    'shortDesc' => 'Additional 60 Days (Extension of stay permit per arrival period)' . ' • ' . '5 - 7 Working Days',
                    'whoFor' => 'Multiple Entry Visa Extension',
                    'tag' => 'Ext. D-Series'
                ],
                [
                    'id' => 'kitas-extension',
                    'thumbnail' => 'service-business.webp',
                    'category' => 'visa-extension',
                    'code' => 'KITAS Extension',
                    'title' => 'KITAS Extension (Working / Investor / Family / Retirement)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => 'Additional 1 Year or 2 Years',
                    'processingTime' => '10 - 15 Working Days',
                    'visaValidity' => '1 or 2 Years.',
                    'whatsAllowed' => [
                        'Continue stay permit and work/investment/retirement activities seamlessly in Indonesia.'
                    ],
                    'whatsNotAllowed' => [
                        'Be extended if the sponsoring company/penjamin is inactive or non-compliant.'
                    ],
                    'documentRequirements' => [
                        'Original passport (valid for min 18 months).',
                        'Previous KITAS / E-ITAS.',
                        'Sponsoring company documents (NIB, Deed, Tax, etc.).'
                    ],
                    'icon' => 'fa-id-card-clip',
                    'badge' => 'Annual Renewal',
                    'duration' => 'Additional 1 Year or 2 Years',
                    'requirements' => [
                        'Original passport (valid for min 18 months).',
                        'Previous KITAS / E-ITAS.',
                        'Sponsoring company documents (NIB, Deed, Tax, etc.).'
                    ],
                    'perks' => [
                        'Continue stay permit and work/investment/retirement activities seamlessly in Indonesia.'
                    ],
                    'shortDesc' => 'Additional 1 Year or 2 Years' . ' • ' . '10 - 15 Working Days',
                    'whoFor' => 'KITAS Extension (Working / Investor / Family / Retirement)',
                    'tag' => 'KITAS Extension'
                ],
                [
                    'id' => 'investor-kitas-e28a',
                    'thumbnail' => 'service-business.webp',
                    'category' => 'kitas',
                    'code' => 'Index E28A',
                    'title' => 'Investor KITAS (E28A)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '1 Year or 2 Years (Extendable)',
                    'processingTime' => '10 - 20 Working Days',
                    'visaValidity' => '1 or 2 Years.',
                    'whatsAllowed' => [
                        'Manage and lead a PT PMA company in Indonesia as Director/Commissioner.',
                        'Enter and exit Indonesia freely (Multiple Entry).',
                        'Sponsor family members (Dependent KITAS).'
                    ],
                    'whatsNotAllowed' => [
                        'Work outside the scope of the sponsoring PT PMA company.'
                    ],
                    'documentRequirements' => [
                        'Passport valid for min 18 months.',
                        'PT PMA documents (NIB, Deed, Ministry Approval, Tax ID).',
                        'Minimum shareholding of IDR 10 Billion in PT PMA.'
                    ],
                    'icon' => 'fa-money-bill-trend-up',
                    'badge' => 'Founder & Investor',
                    'duration' => '1 Year or 2 Years (Extendable)',
                    'requirements' => [
                        'Passport valid for min 18 months.',
                        'PT PMA documents (NIB, Deed, Ministry Approval, Tax ID).',
                        'Minimum shareholding of IDR 10 Billion in PT PMA.'
                    ],
                    'perks' => [
                        'Manage and lead a PT PMA company in Indonesia as Director/Commissioner.',
                        'Enter and exit Indonesia freely (Multiple Entry).',
                        'Sponsor family members (Dependent KITAS).'
                    ],
                    'shortDesc' => '1 Year or 2 Years (Extendable)' . ' • ' . '10 - 20 Working Days',
                    'whoFor' => 'Investor KITAS (E28A)',
                    'tag' => 'Index E28A'
                ],
                [
                    'id' => 'working-kitas-e23',
                    'thumbnail' => 'service-documents.webp',
                    'category' => 'kitas',
                    'code' => 'Index E23',
                    'title' => 'Working KITAS (E23)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '1 Year (Extendable annually)',
                    'processingTime' => '15 - 25 Working Days',
                    'visaValidity' => '1 Year.',
                    'whatsAllowed' => [
                        'Work and hold a paid professional position legally in an Indonesian company.',
                        'Receive local salary and open a local bank account.'
                    ],
                    'whatsNotAllowed' => [
                        'Work for another company outside the official sponsoring company.'
                    ],
                    'documentRequirements' => [
                        'Passport valid for min 18 months.',
                        'Sponsoring company documents (RPTKA, NIB, Business License).',
                        'University Degree, CV, and Work Experience of the candidate.'
                    ],
                    'icon' => 'fa-user-tie',
                    'badge' => 'Expat Professional',
                    'duration' => '1 Year (Extendable annually)',
                    'requirements' => [
                        'Passport valid for min 18 months.',
                        'Sponsoring company documents (RPTKA, NIB, Business License).',
                        'University Degree, CV, and Work Experience of the candidate.'
                    ],
                    'perks' => [
                        'Work and hold a paid professional position legally in an Indonesian company.',
                        'Receive local salary and open a local bank account.'
                    ],
                    'shortDesc' => '1 Year (Extendable annually)' . ' • ' . '15 - 25 Working Days',
                    'whoFor' => 'Working KITAS (E23)',
                    'tag' => 'Index E23'
                ],
                [
                    'id' => 'digital-nomad-e33g',
                    'thumbnail' => 'service-remote.webp',
                    'category' => 'kitas',
                    'code' => 'Index E33G',
                    'title' => 'Digital Nomad / Remote Worker Visa (E33G)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '1 Year (Extendable annually)',
                    'processingTime' => '10 - 15 Working Days',
                    'visaValidity' => '1 Year.',
                    'whatsAllowed' => [
                        'Work remotely for overseas companies/clients from Bali/Indonesia legally.',
                        'Reside and live in Indonesia for 1 year.'
                    ],
                    'whatsNotAllowed' => [
                        'Work for or sell products/services to local Indonesian clients or market.',
                        'Receive salary from domestic Indonesian sources.'
                    ],
                    'documentRequirements' => [
                        'Passport valid for min 18 months.',
                        'Employment contract from an overseas company.',
                        'Proof of income minimum USD $60,000 per year.'
                    ],
                    'icon' => 'fa-laptop-code',
                    'badge' => 'Remote Worker',
                    'duration' => '1 Year (Extendable annually)',
                    'requirements' => [
                        'Passport valid for min 18 months.',
                        'Employment contract from an overseas company.',
                        'Proof of income minimum USD $60,000 per year.'
                    ],
                    'perks' => [
                        'Work remotely for overseas companies/clients from Bali/Indonesia legally.',
                        'Reside and live in Indonesia for 1 year.'
                    ],
                    'shortDesc' => '1 Year (Extendable annually)' . ' • ' . '10 - 15 Working Days',
                    'whoFor' => 'Digital Nomad / Remote Worker Visa (E33G)',
                    'tag' => 'Index E33G'
                ],
                [
                    'id' => 'retirement-kitas-e33e',
                    'thumbnail' => 'service-retirement.webp',
                    'category' => 'kitas',
                    'code' => 'Index E33E',
                    'title' => 'Retirement KITAS (E33E)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '1 Year (Extendable up to 5 years total before converting to KITAP)',
                    'processingTime' => '10 - 15 Working Days',
                    'visaValidity' => '1 Year.',
                    'whatsAllowed' => [
                        'Live and enjoy retirement in Bali/Indonesia legally.',
                        'Lease property and open a local bank account.'
                    ],
                    'whatsNotAllowed' => [
                        'Engage in paid employment or commercial business in Indonesia.'
                    ],
                    'documentRequirements' => [
                        'Minimum age of 60 years.',
                        'Passport valid for min 18 months.',
                        'Proof of pension/funds minimum USD $3,000/month.',
                        'Lease agreement and statement to hire Indonesian domestic helper.'
                    ],
                    'icon' => 'fa-person-cane',
                    'badge' => 'Retirement 55+',
                    'duration' => '1 Year (Extendable up to 5 years total before converting to KITAP)',
                    'requirements' => [
                        'Minimum age of 60 years.',
                        'Passport valid for min 18 months.',
                        'Proof of pension/funds minimum USD $3,000/month.',
                        'Lease agreement and statement to hire Indonesian domestic helper.'
                    ],
                    'perks' => [
                        'Live and enjoy retirement in Bali/Indonesia legally.',
                        'Lease property and open a local bank account.'
                    ],
                    'shortDesc' => '1 Year (Extendable up to 5 years total before converting to KITAP)' . ' • ' . '10 - 15 Working Days',
                    'whoFor' => 'Retirement KITAS (E33E)',
                    'tag' => 'Index E33E'
                ],
                [
                    'id' => 'dependent-kitas-e31',
                    'thumbnail' => 'service-family.webp',
                    'category' => 'kitas',
                    'code' => 'Index E31',
                    'title' => 'Family of KITAS Holder (Dependent KITAS - E31)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => 'Matches the duration of the main KITAS holder (1 or 2 Years)',
                    'processingTime' => '10 - 15 Working Days',
                    'visaValidity' => 'Follows the validity of the Main KITAS.',
                    'whatsAllowed' => [
                        'Reside legally accompanying spouse / parents who hold Investor/Working/Retirement KITAS.'
                    ],
                    'whatsNotAllowed' => [
                        'Work or earn local income in Indonesia.'
                    ],
                    'documentRequirements' => [
                        'Passport valid for min 18 months.',
                        'Marriage Certificate (for spouse) / Birth Certificate (for child) translated & legalized.',
                        'Copy of Main KITAS holder\'s permit.'
                    ],
                    'icon' => 'fa-people-roof',
                    'badge' => 'Family Dependent',
                    'duration' => 'Matches the duration of the main KITAS holder (1 or 2 Years)',
                    'requirements' => [
                        'Passport valid for min 18 months.',
                        'Marriage Certificate (for spouse) / Birth Certificate (for child) translated & legalized.',
                        'Copy of Main KITAS holder\'s permit.'
                    ],
                    'perks' => [
                        'Reside legally accompanying spouse / parents who hold Investor/Working/Retirement KITAS.'
                    ],
                    'shortDesc' => 'Matches the duration of the main KITAS holder (1 or 2 Years)' . ' • ' . '10 - 15 Working Days',
                    'whoFor' => 'Family of KITAS Holder (Dependent KITAS - E31)',
                    'tag' => 'Index E31'
                ],
                [
                    'id' => 'spouse-kitas',
                    'thumbnail' => 'header-slider3.webp',
                    'category' => 'kitas',
                    'code' => 'Index E31B / Spouse',
                    'title' => 'Family of Indonesian Citizen (Spouse KITAS)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '1 Year (Extendable, eligible to apply for KITAP after 2 years of marriage)',
                    'processingTime' => '10 - 15 Working Days',
                    'visaValidity' => '1 Year.',
                    'whatsAllowed' => [
                        'Reside legally in Indonesia with Indonesian spouse.',
                        'Allowed to engage in activities to support family needs.'
                    ],
                    'whatsNotAllowed' => [
                        'Work as a formal employee without a proper work permit.'
                    ],
                    'documentRequirements' => [
                        'Official Marriage Certificate / Buku Nikah.',
                        'KTP & Family Card (KK) of Indonesian spouse.',
                        'Foreign spouse passport valid for min 18 months.'
                    ],
                    'icon' => 'fa-hand-holding-heart',
                    'badge' => 'Spouse of WNI',
                    'duration' => '1 Year (Extendable, eligible to apply for KITAP after 2 years of marriage)',
                    'requirements' => [
                        'Official Marriage Certificate / Buku Nikah.',
                        'KTP & Family Card (KK) of Indonesian spouse.',
                        'Foreign spouse passport valid for min 18 months.'
                    ],
                    'perks' => [
                        'Reside legally in Indonesia with Indonesian spouse.',
                        'Allowed to engage in activities to support family needs.'
                    ],
                    'shortDesc' => '1 Year (Extendable, eligible to apply for KITAP after 2 years of marriage)' . ' • ' . '10 - 15 Working Days',
                    'whoFor' => 'Family of Indonesian Citizen (Spouse KITAS)',
                    'tag' => 'Index E31B / Spouse'
                ],
                [
                    'id' => 'student-visa-e30a',
                    'thumbnail' => 'service-education.webp',
                    'category' => 'kitas',
                    'code' => 'Index E30A',
                    'title' => 'Student Visa (E30A)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '1 Year (According to study duration)',
                    'processingTime' => '10 - 20 Working Days',
                    'visaValidity' => '1 Year.',
                    'whatsAllowed' => [
                        'Pursue formal education/study at accredited Indonesian universities or educational institutions.'
                    ],
                    'whatsNotAllowed' => [
                        'Work commercially or run a business in Indonesia.'
                    ],
                    'documentRequirements' => [
                        'Letter of Acceptance from the educational institution.',
                        'Recommendation letter from the Ministry of Education.',
                        'Passport valid for min 18 months.'
                    ],
                    'icon' => 'fa-graduation-cap',
                    'badge' => 'Education Study',
                    'duration' => '1 Year (According to study duration)',
                    'requirements' => [
                        'Letter of Acceptance from the educational institution.',
                        'Recommendation letter from the Ministry of Education.',
                        'Passport valid for min 18 months.'
                    ],
                    'perks' => [
                        'Pursue formal education/study at accredited Indonesian universities or educational institutions.'
                    ],
                    'shortDesc' => '1 Year (According to study duration)' . ' • ' . '10 - 20 Working Days',
                    'whoFor' => 'Student Visa (E30A)',
                    'tag' => 'Index E30A'
                ],
                [
                    'id' => 'ex-wni-visa-e32a',
                    'thumbnail' => 'about-img.webp',
                    'category' => 'kitas',
                    'code' => 'Index E32A',
                    'title' => 'Ex-Indonesian Citizens Visa (E32A)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '1 Year or 2 Years',
                    'processingTime' => '10 - 15 Working Days',
                    'visaValidity' => '1 or 2 Years.',
                    'whatsAllowed' => [
                        'Reside and live back in Indonesia for former Indonesian citizens.'
                    ],
                    'whatsNotAllowed' => [
                        'Work commercially without a valid work permit.'
                    ],
                    'documentRequirements' => [
                        'Proof of former Indonesian citizenship (old Indonesian passport / Birth Certificate / Decree of citizenship cancellation).',
                        'Active foreign passport valid for min 18 months.'
                    ],
                    'icon' => 'fa-flag',
                    'badge' => 'Ex-Indonesian',
                    'duration' => '1 Year or 2 Years',
                    'requirements' => [
                        'Proof of former Indonesian citizenship (old Indonesian passport / Birth Certificate / Decree of citizenship cancellation).',
                        'Active foreign passport valid for min 18 months.'
                    ],
                    'perks' => [
                        'Reside and live back in Indonesia for former Indonesian citizens.'
                    ],
                    'shortDesc' => '1 Year or 2 Years' . ' • ' . '10 - 15 Working Days',
                    'whoFor' => 'Ex-Indonesian Citizens Visa (E32A)',
                    'tag' => 'Index E32A'
                ],
                [
                    'id' => 'golden-visa',
                    'thumbnail' => 'service-business.webp',
                    'category' => 'kitas',
                    'code' => 'Golden Visa',
                    'title' => 'Golden Visa',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '5 Years or 10 Years',
                    'processingTime' => '15 - 30 Working Days',
                    'visaValidity' => '5 or 10 Years.',
                    'whatsAllowed' => [
                        'Long-term stay permit (5-10 years) without annual extensions.',
                        'Priority immigration lanes at airports & simplified financial procedures.'
                    ],
                    'whatsNotAllowed' => [
                        'Violate the minimum investment commitment required by the government.'
                    ],
                    'documentRequirements' => [
                        'Proof of significant investment (Government Bonds, PT PMA Shares, or State Bank Deposits worth USD $350,000 - $700,000+).',
                        'Passport valid for min 36 months.'
                    ],
                    'icon' => 'fa-gem',
                    'badge' => '5 - 10 Years VIP',
                    'duration' => '5 Years or 10 Years',
                    'requirements' => [
                        'Proof of significant investment (Government Bonds, PT PMA Shares, or State Bank Deposits worth USD $350,000 - $700,000+).',
                        'Passport valid for min 36 months.'
                    ],
                    'perks' => [
                        'Long-term stay permit (5-10 years) without annual extensions.',
                        'Priority immigration lanes at airports & simplified financial procedures.'
                    ],
                    'shortDesc' => '5 Years or 10 Years' . ' • ' . '15 - 30 Working Days',
                    'whoFor' => 'Golden Visa',
                    'tag' => 'Golden Visa'
                ],
                [
                    'id' => 'investor-kitap',
                    'thumbnail' => 'service-business.webp',
                    'category' => 'kitap',
                    'code' => 'KITAP Investor',
                    'title' => 'Investor KITAP',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '5 Years (Extendable up to unlimited / permanent status)',
                    'processingTime' => '1 - 2 Months',
                    'visaValidity' => '5 Years per extension cycle.',
                    'whatsAllowed' => [
                        'Permanent long-term residency in Indonesia without annual KITAS renewal.',
                        'Hold Foreigner ID Card (KTP WNA) & SIKK.'
                    ],
                    'whatsNotAllowed' => [
                        'Abandon the PT PMA investment that serves as the foundation for the KITAP.'
                    ],
                    'documentRequirements' => [
                        'Held an Investor KITAS for at least 3-4 consecutive years.',
                        'Complete PT PMA documents actively operating.'
                    ],
                    'icon' => 'fa-crown',
                    'badge' => 'Permanent Residency',
                    'duration' => '5 Years (Extendable up to unlimited / permanent status)',
                    'requirements' => [
                        'Held an Investor KITAS for at least 3-4 consecutive years.',
                        'Complete PT PMA documents actively operating.'
                    ],
                    'perks' => [
                        'Permanent long-term residency in Indonesia without annual KITAS renewal.',
                        'Hold Foreigner ID Card (KTP WNA) & SIKK.'
                    ],
                    'shortDesc' => '5 Years (Extendable up to unlimited / permanent status)' . ' • ' . '1 - 2 Months',
                    'whoFor' => 'Investor KITAP',
                    'tag' => 'KITAP Investor'
                ],
                [
                    'id' => 'working-kitap',
                    'thumbnail' => 'service-documents.webp',
                    'category' => 'kitap',
                    'code' => 'KITAP Working',
                    'title' => 'Working KITAP',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '5 Years',
                    'processingTime' => '1 - 2 Months',
                    'visaValidity' => '5 Years.',
                    'whatsAllowed' => [
                        'Permanent residency and work in executive/expert positions at sponsoring company.'
                    ],
                    'whatsNotAllowed' => [
                        'Change employers without updating sponsor legalities.'
                    ],
                    'documentRequirements' => [
                        'Held a Working KITAS for at least 3-4 consecutive years with the same company.'
                    ],
                    'icon' => 'fa-certificate',
                    'badge' => 'Permanent Career',
                    'duration' => '5 Years',
                    'requirements' => [
                        'Held a Working KITAS for at least 3-4 consecutive years with the same company.'
                    ],
                    'perks' => [
                        'Permanent residency and work in executive/expert positions at sponsoring company.'
                    ],
                    'shortDesc' => '5 Years' . ' • ' . '1 - 2 Months',
                    'whoFor' => 'Working KITAP',
                    'tag' => 'KITAP Working'
                ],
                [
                    'id' => 'family-kitap',
                    'thumbnail' => 'service-family.webp',
                    'category' => 'kitap',
                    'code' => 'KITAP Family',
                    'title' => 'Family KITAP (Spouse / Dependent)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '5 Years (Spouse KITAP can become permanent upon extension)',
                    'processingTime' => '1 Month',
                    'visaValidity' => '5 Years.',
                    'whatsAllowed' => [
                        'Permanent residency in Indonesia accompanying Indonesian spouse.'
                    ],
                    'whatsNotAllowed' => [
                        'Divorce from Indonesian spouse (may invalidate family KITAP status).'
                    ],
                    'documentRequirements' => [
                        'Married to an Indonesian citizen for at least 2 years and held a Spouse KITAS for 2 consecutive years.'
                    ],
                    'icon' => 'fa-house-chimney-user',
                    'badge' => 'Permanent Spouse',
                    'duration' => '5 Years (Spouse KITAP can become permanent upon extension)',
                    'requirements' => [
                        'Married to an Indonesian citizen for at least 2 years and held a Spouse KITAS for 2 consecutive years.'
                    ],
                    'perks' => [
                        'Permanent residency in Indonesia accompanying Indonesian spouse.'
                    ],
                    'shortDesc' => '5 Years (Spouse KITAP can become permanent upon extension)' . ' • ' . '1 Month',
                    'whoFor' => 'Family KITAP (Spouse / Dependent)',
                    'tag' => 'KITAP Family'
                ],
                [
                    'id' => 'retirement-kitap',
                    'thumbnail' => 'service-retirement.webp',
                    'category' => 'kitap',
                    'code' => 'KITAP Retirement',
                    'title' => 'Retirement KITAP',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => '5 Years',
                    'processingTime' => '1 - 2 Months',
                    'visaValidity' => '5 Years.',
                    'whatsAllowed' => [
                        'Permanent residency for retirees without annual KITAS management.'
                    ],
                    'whatsNotAllowed' => [
                        'Engage in local paid employment in Indonesia.'
                    ],
                    'documentRequirements' => [
                        'Held a Retirement KITAS for at least 5 consecutive years.'
                    ],
                    'icon' => 'fa-champagne-glasses',
                    'badge' => 'Permanent Retiree',
                    'duration' => '5 Years',
                    'requirements' => [
                        'Held a Retirement KITAS for at least 5 consecutive years.'
                    ],
                    'perks' => [
                        'Permanent residency for retirees without annual KITAS management.'
                    ],
                    'shortDesc' => '5 Years' . ' • ' . '1 - 2 Months',
                    'whoFor' => 'Retirement KITAP',
                    'tag' => 'KITAP Retirement'
                ],
                [
                    'id' => 'pma-company',
                    'thumbnail' => 'service-business.webp',
                    'category' => 'company',
                    'code' => 'PT PMA Setup',
                    'title' => 'Foreign Investment Company (PMA)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => 'Permanent Business License (Periodic LKPM reporting required)',
                    'processingTime' => '15 - 30 Working Days (subject to ministry approval)',
                    'visaValidity' => 'Lifetime / valid for as long as the company actively operates.',
                    'whatsAllowed' => [
                        'Own 100% or partial shares in an Indonesian entity as a foreign investor.',
                        'Conduct official business operations and legal financial transactions in Indonesia.',
                        'Apply for Investor KITAS (E28A) or Working KITAS for foreign Directors/Commissioners.'
                    ],
                    'whatsNotAllowed' => [
                        'Operate in business sectors listed under the Negative Investment List (DNI) / closed to foreign capital.',
                        'Operate without satisfying the minimum foreign investment capital requirement (equivalent to IDR 10 Billion per KBLI).'
                    ],
                    'documentRequirements' => [
                        'OneCoreVisa application form.',
                        'Choice of company name (at least 3 options) & business address in Indonesia.',
                        'Selection of business category (KBLI code).',
                        'Shareholder breakdown and share percentage allocation.',
                        'Color passport scan of foreign shareholders / Corporate Deed if shareholder is a corporate entity.'
                    ],
                    'icon' => 'fa-building',
                    'badge' => '100% Foreign Owned',
                    'duration' => 'Permanent Business License (Periodic LKPM reporting required)',
                    'requirements' => [
                        'OneCoreVisa application form.',
                        'Choice of company name (at least 3 options) & business address in Indonesia.',
                        'Selection of business category (KBLI code).',
                        'Shareholder breakdown and share percentage allocation.',
                        'Color passport scan of foreign shareholders / Corporate Deed if shareholder is a corporate entity.'
                    ],
                    'perks' => [
                        'Own 100% or partial shares in an Indonesian entity as a foreign investor.',
                        'Conduct official business operations and legal financial transactions in Indonesia.',
                        'Apply for Investor KITAS (E28A) or Working KITAS for foreign Directors/Commissioners.'
                    ],
                    'shortDesc' => 'Permanent Business License (Periodic LKPM reporting required)' . ' • ' . '15 - 30 Working Days (subject to ministry approval)',
                    'whoFor' => 'Foreign Investment Company (PMA)',
                    'tag' => 'PT PMA Setup'
                ],
                [
                    'id' => 'pt-local-company',
                    'thumbnail' => 'service-documents.webp',
                    'category' => 'company',
                    'code' => 'PT PMDN Setup',
                    'title' => 'Local Investment Company (PT Local / PMDN)',
                    'price' => $lang === 'en' ? 'Request A Quote' : 'Minta Penawaran',
                    'lengthOfStay' => 'Permanent Business License',
                    'processingTime' => '10 - 20 Working Days',
                    'visaValidity' => 'Lifetime / valid for as long as the company actively operates.',
                    'whatsAllowed' => [
                        'Own and operate a company fully under Indonesian Citizen (WNI) ownership.',
                        'Conduct business in sectors restricted or exclusive to domestic capital.'
                    ],
                    'whatsNotAllowed' => [
                        'Have direct foreign shareholders (must be 100% WNI owned).',
                        'Directly issue Investor KITAS for foreigners under share ownership.'
                    ],
                    'documentRequirements' => [
                        'OneCoreVisa application form.',
                        'Choice of company name (at least 3 options) & registered address.',
                        'Selection of business category (KBLI code).',
                        'Shareholder details (WNI) and capital allocation.',
                        'Scan of KTP (Indonesian ID) & Tax ID (NPWP) of all Indonesian shareholders.'
                    ],
                    'icon' => 'fa-shop',
                    'badge' => 'Local Investment',
                    'duration' => 'Permanent Business License',
                    'requirements' => [
                        'OneCoreVisa application form.',
                        'Choice of company name (at least 3 options) & registered address.',
                        'Selection of business category (KBLI code).',
                        'Shareholder details (WNI) and capital allocation.',
                        'Scan of KTP (Indonesian ID) & Tax ID (NPWP) of all Indonesian shareholders.'
                    ],
                    'perks' => [
                        'Own and operate a company fully under Indonesian Citizen (WNI) ownership.',
                        'Conduct business in sectors restricted or exclusive to domestic capital.'
                    ],
                    'shortDesc' => 'Permanent Business License' . ' • ' . '10 - 20 Working Days',
                    'whoFor' => 'Local Investment Company (PT Local / PMDN)',
                    'tag' => 'PT PMDN Setup'
                ]
            ],
            'process' => [
                [
                    'step' => '01',
                    'title' => $lang === 'en' ? 'Tell us your plans' : 'Ceritakan rencana Anda',
                    'timeline' => $lang === 'en' ? 'Step 01' : 'Langkah 01',
                    'desc' => $lang === 'en'
                        ? 'Share your nationality, travel dates, and purpose.'
                        : 'Sampaikan kewarganegaraan, tanggal, dan tujuan perjalanan Anda.',
                    'icon' => 'fa-file-lines'
                ],
                [
                    'step' => '02',
                    'title' => $lang === 'en' ? 'Prepare your documents' : 'Siapkan dokumen Anda',
                    'timeline' => $lang === 'en' ? 'Step 02' : 'Langkah 02',
                    'desc' => $lang === 'en'
                        ? 'We check your documents and explain requirements, fees, and estimated timing.'
                        : 'Kami memeriksa dokumen serta menjelaskan persyaratan, biaya, dan estimasi waktu.',
                    'icon' => 'fa-shield-halved'
                ],
                [
                    'step' => '03',
                    'title' => $lang === 'en' ? 'Stay updated' : 'Terima kabar terbaru',
                    'timeline' => $lang === 'en' ? 'Step 03' : 'Langkah 03',
                    'desc' => $lang === 'en'
                        ? 'Get application updates and guidance on what comes next.'
                        : 'Dapatkan kabar pengajuan dan panduan langkah berikutnya.',
                    'icon' => 'fa-plane-arrival'
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
        $lang = $this->language($request);

        $data = $this->getData($lang);
        $data['lang'] = $lang;
        $data['serviceCategories'] = $this->serviceCategories();
        unset($data['serviceCategories']['company-formation']);
        $data['visaSimulatorCountries'] = config('visa_simulator.country_codes');

        return view('home', $data);
    }

    public function showService(Request $request, string $service)
    {
        $details = [
            'e-visa-voa' => [
                'name' => 'E-Visa VOA', 'title_id' => 'E-Visa VOA', 'image' => 'about-img.webp',
                'intro' => ['Prepare for your arrival in Indonesia before you travel.', 'Persiapkan kedatangan Anda di Indonesia sebelum berangkat.'],
                'overview' => ['Share your nationality, travel purpose, and expected arrival date. Our team can discuss whether E-Visa VOA fits your plans and explain what to prepare before proceeding.', 'Sampaikan kewarganegaraan, tujuan perjalanan, dan rencana tanggal kedatangan. Tim kami dapat mendiskusikan kesesuaian E-Visa VOA dengan rencana Anda dan persiapan sebelum melanjutkan.'],
                'topics' => [['Your nationality', 'Kewarganegaraan Anda'], ['Your travel purpose and arrival date', 'Tujuan perjalanan dan tanggal kedatangan'], ['Your planned length of stay', 'Rencana lama tinggal']],
            ],
            'single-entry-visas' => [
                'name' => 'Single Entry Visas', 'title_id' => 'Visa Sekali Masuk', 'image' => 'header-slider3.webp',
                'intro' => ['Explore visa assistance for a planned visit to Indonesia.', 'Kenali bantuan visa untuk kunjungan terencana ke Indonesia.'],
                'overview' => ['Tell us the purpose of your visit, your travel dates, and your intended stay. We can discuss the single-entry options relevant to your plans and the questions to resolve before applying.', 'Ceritakan tujuan kunjungan, tanggal perjalanan, dan rencana masa tinggal. Kami dapat mendiskusikan pilihan sekali masuk yang relevan serta hal yang perlu dipastikan sebelum pengajuan.'],
                'topics' => [['Your visit purpose', 'Tujuan kunjungan Anda'], ['Your arrival and departure plans', 'Rencana kedatangan dan keberangkatan'], ['Your nationality and current location', 'Kewarganegaraan dan lokasi saat ini']],
            ],
            'multiple-entry-visas' => [
                'name' => 'Multiple Entry Visas', 'title_id' => 'Visa Beberapa Kali Masuk', 'image' => 'header-slider1.webp',
                'intro' => ['Plan ahead for regular visits to Indonesia.', 'Rencanakan kunjungan rutin Anda ke Indonesia.'],
                'overview' => ['Discuss how often you plan to visit, the purpose of each visit, and your travel schedule. Our team can help you explore multiple-entry options and review what your application may involve.', 'Diskusikan frekuensi kunjungan, tujuan setiap kunjungan, dan jadwal perjalanan. Tim kami membantu mengenali pilihan beberapa kali masuk dan meninjau proses pengajuannya.'],
                'topics' => [['Your visit frequency and travel schedule', 'Frekuensi kunjungan dan jadwal perjalanan'], ['The purpose of your visits', 'Tujuan kunjungan Anda'], ['Your nationality and intended stays', 'Kewarganegaraan dan rencana masa tinggal']],
            ],
        ];

        $lang = $this->language($request);
        $data = $this->getData($lang);
        $data['lang'] = $lang;
        $data['serviceCategories'] = $this->serviceCategories();
        $details = array_merge($details, $data['serviceCategories']);
        abort_unless(isset($details[$service]), 404);

        $legacyServices = [
            'e-visa-voa' => ['voa-b1'],
            'single-entry-visas' => ['c1-tourist-visa', 'c2-business-visa', 'c12-pre-investment-visa', 'c6-social-cultural-visa', 'c7-arts-music-visa', 'c13-medical-humanitarian-visa'],
            'multiple-entry-visas' => ['multiple-entry-d1-d2'],
        ];
        $sourceCategory = $details[$service]['sourceCategory'] ?? null;
        $data['categoryServices'] = array_values(array_filter($data['services'], fn ($item) => $sourceCategory ? $item['category'] === $sourceCategory : in_array($item['id'], $legacyServices[$service] ?? [], true)
        ));
        $data['serviceDetail'] = $details[$service];

        return view('services.show', $data);
    }

    private function serviceCategories(): array
    {
        return [
            'visitor-visas' => [
                'name' => 'Visitor Visas', 'title_id' => 'Visa Kunjungan', 'sourceCategory' => 'visitor-visas', 'image' => 'bali-tanah-lot.webp',
                'intro' => ['Single and multiple-entry options for tourism, business visits, cultural activities, and other visits to Indonesia.', 'Pilihan sekali dan beberapa kali masuk untuk wisata, kunjungan bisnis, kegiatan budaya, dan kunjungan lainnya ke Indonesia.'],
                'benefits' => [['Single & Multiple Entry', 'Sekali & Beberapa Kali Masuk'], ['Tourism & Business Visits', 'Wisata & Kunjungan Bisnis']],
            ],
            'visa-extensions' => [
                'name' => 'Visa & KITAS Extension', 'title_id' => 'Perpanjangan Visa & KITAS', 'sourceCategory' => 'visa-extension', 'image' => 'bali-rice-terraces.webp',
                'intro' => ['Review the next steps for extending your visit visa or renewing your existing stay permit.', 'Tinjau langkah berikutnya untuk memperpanjang visa kunjungan atau memperbarui izin tinggal Anda.'],
                'benefits' => [['Visit Visa Extensions', 'Perpanjangan Visa Kunjungan'], ['KITAS Renewals', 'Perpanjangan KITAS']],
            ],
            'kitas' => [
                'name' => 'Work & Longer Stay (KITAS)', 'title_id' => 'Kerja & Tinggal Lebih Lama (KITAS)', 'sourceCategory' => 'kitas', 'image' => 'bali-waterfall.webp',
                'intro' => ['Explore stay permits for investment, employment, remote work, family, education, and retirement.', 'Kenali izin tinggal untuk investasi, kerja, kerja jarak jauh, keluarga, pendidikan, dan pensiun.'],
                'benefits' => [['Investor & Working KITAS', 'KITAS Investor & Kerja'], ['Family, Study & Retirement', 'Keluarga, Studi & Pensiun']],
            ],
            'kitap' => [
                'name' => 'Permanent Residency (KITAP)', 'title_id' => 'Izin Tinggal Tetap (KITAP)', 'sourceCategory' => 'kitap', 'image' => 'bali-ulun-danu.webp',
                'intro' => ['Plan a longer future in Indonesia with residency options for eligible investors, workers, families, and retirees.', 'Rencanakan masa depan di Indonesia melalui pilihan izin tinggal bagi investor, pekerja, keluarga, dan pensiunan yang memenuhi syarat.'],
                'benefits' => [['Investor & Working KITAP', 'KITAP Investor & Kerja'], ['Family & Retirement KITAP', 'KITAP Keluarga & Pensiun']],
            ],
            'company-formation' => [
                'name' => 'Company Formation', 'title_id' => 'Pendirian Perusahaan', 'sourceCategory' => 'company', 'image' => 'service-business.webp',
                'intro' => ['Prepare your business structure and incorporation documents for a foreign or locally owned company in Indonesia.', 'Siapkan struktur bisnis dan dokumen pendirian perusahaan asing maupun lokal di Indonesia.'],
                'benefits' => [['Foreign Investment (PT PMA)', 'Penanaman Modal Asing (PT PMA)'], ['Local Company (PT PMDN)', 'Perusahaan Lokal (PT PMDN)']],
            ],
        ];
    }

    public function showServiceLine(Request $request, string $category, string $service)
    {
        $lang = $this->language($request);
        $data = $this->getData($lang);
        $data['lang'] = $lang;
        $data['serviceCategories'] = $this->serviceCategories();
        $categoryDetail = $data['serviceCategories'][$category] ?? null;
        abort_unless($categoryDetail, 404);
        $item = collect($data['services'])->first(fn ($item) => $item['id'] === $service && $item['category'] === $categoryDetail['sourceCategory']);
        abort_unless($item, 404);

        $data['serviceDetail'] = ['name' => $item['title'], 'title_id' => $item['title']];
        $data['serviceLine'] = $item;
        $data['categoryDetail'] = $categoryDetail;
        $data['categorySlug'] = $category;

        return view('services.detail', $data);
    }

    /**
     * Switch language route
     */
    public function switchLang(Request $request, $locale)
    {
        if (! in_array($locale, \App\Support\SiteLanguage::LOCALES, true)) {
            return redirect()->route('home');
        }
        session(['locale' => $locale]);
        $previous = url()->previous();
        $path = parse_url($previous, PHP_URL_HOST) === $request->getHost()
            ? parse_url($previous, PHP_URL_PATH) : '/';

        return redirect()->to(url($path ?: '/').($locale === 'en' ? '' : '?lang='.$locale));
    }

    private function language(Request $request): string
    {
        $locale = $request->query('lang');

        return in_array($locale, \App\Support\SiteLanguage::LOCALES, true) ? $locale : 'en';
    }

    private function discoveryPages(): array
    {
        $pages = [['path' => '/', 'name' => 'OneCoreVisa']];
        $categories = $this->serviceCategories();
        foreach ($categories as $slug => $category) {
            $pages[] = ['path' => '/services/'.$slug, 'name' => $category['name']];
        }
        foreach (['e-visa-voa' => 'E-Visa VOA', 'single-entry-visas' => 'Single Entry Visas', 'multiple-entry-visas' => 'Multiple Entry Visas'] as $slug => $name) {
            $pages[] = ['path' => '/services/'.$slug, 'name' => $name];
        }
        foreach ($this->getData()['services'] as $service) {
            $categorySlug = collect($categories)->search(fn ($category) => $category['sourceCategory'] === $service['category']);
            if ($categorySlug !== false) {
                $pages[] = ['path' => '/services/'.$categorySlug.'/'.$service['id'], 'name' => $service['title']];
            }
        }

        return $pages;
    }

    public function sitemap()
    {
        return response()->view('seo.sitemap', ['pages' => $this->discoveryPages()])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots()
    {
        return response("User-agent: *\nAllow: /\nDisallow: /lang/\n\nSitemap: ".SiteSeo::url('/sitemap.xml')."\n")
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function llms()
    {
        return response()->view('seo.llms', ['pages' => $this->discoveryPages()])
            ->header('Content-Type', 'text/plain; charset=UTF-8');
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

        $whatsappUrl = "https://wa.me/6289672966845?text={$text}";

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Consultation inquiry received!',
                'whatsapp_url' => $whatsappUrl,
            ]);
        }

        return redirect($whatsappUrl);
    }
}
