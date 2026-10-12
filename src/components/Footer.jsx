import React from 'react';
import { 
  ShieldCheck, 
  MapPin, 
  PhoneCall, 
  Mail, 
  Clock, 
  ArrowRight,
  ExternalLink
} from 'lucide-react';

export default function Footer({ lang, content, onOpenConsultation }) {
  const t = content[lang].footer;

  const scrollTo = (id) => {
    const el = document.getElementById(id);
    if (el) {
      el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  return (
    <footer className="bg-[#071A2A] text-slate-300 border-t border-[#176B9C]/30 text-xs">
      
      {/* Main Footer Container */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">
          
          {/* Brand & Mission (Col 1 - 4) */}
          <div className="lg:col-span-4 space-y-4">
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#0B2942] via-[#176B9C] to-[#6EA8C8] p-[1.5px] shadow">
                <div className="w-full h-full bg-[#0B2942] rounded-[10px] flex items-center justify-center text-white">
                  <ShieldCheck className="w-6 h-6 text-[#6EA8C8]" />
                </div>
              </div>
              <div>
                <span className="text-xl font-extrabold tracking-tight text-white">
                  ONECORE<span className="text-[#6EA8C8]">VISA</span>
                </span>
                <p className="text-[10px] text-[#6EA8C8] uppercase font-bold tracking-wider">
                  One Step Solution
                </p>
              </div>
            </div>

            <p className="text-slate-400 text-xs leading-relaxed max-w-sm">
              {t.description}
            </p>

            <div className="pt-2 text-slate-300 space-y-2">
              <div className="flex items-start gap-2.5">
                <MapPin className="w-4 h-4 text-[#6EA8C8] shrink-0 mt-0.5" />
                <span className="text-[11px] leading-tight text-slate-300">{t.officeJakarta}</span>
              </div>
              <div className="flex items-start gap-2.5">
                <MapPin className="w-4 h-4 text-[#6EA8C8] shrink-0 mt-0.5" />
                <span className="text-[11px] leading-tight text-slate-300">{t.officeBali}</span>
              </div>
            </div>
          </div>

          {/* Quick Links (Col 5 - 6) */}
          <div className="lg:col-span-2 space-y-3">
            <h4 className="text-sm font-bold text-white uppercase tracking-wider">
              {lang === 'en' ? 'Quick Links' : 'Navigasi'}
            </h4>
            <ul className="space-y-2 text-slate-400">
              <li>
                <button onClick={() => scrollTo('hero')} className="hover:text-white transition-colors">
                  {lang === 'en' ? 'Home' : 'Beranda'}
                </button>
              </li>
              <li>
                <button onClick={() => scrollTo('preference')} className="hover:text-[#6EA8C8] transition-colors font-medium">
                  {lang === 'en' ? 'Check Preference' : 'Cek Preferensi'}
                </button>
              </li>
              <li>
                <button onClick={() => scrollTo('about')} className="hover:text-white transition-colors">
                  {lang === 'en' ? 'About Us' : 'Tentang Kami'}
                </button>
              </li>
              <li>
                <button onClick={() => scrollTo('services')} className="hover:text-white transition-colors">
                  {lang === 'en' ? 'Our Services' : 'Layanan Kami'}
                </button>
              </li>
              <li>
                <button onClick={() => scrollTo('process')} className="hover:text-white transition-colors">
                  {lang === 'en' ? 'Our Process' : 'Proses Kami'}
                </button>
              </li>
              <li>
                <button onClick={() => scrollTo('faq')} className="hover:text-white transition-colors">
                  {lang === 'en' ? 'FAQ' : 'Tanya Jawab'}
                </button>
              </li>
            </ul>
          </div>

          {/* Services Scope (Col 7 - 9) */}
          <div className="lg:col-span-3 space-y-3">
            <h4 className="text-sm font-bold text-white uppercase tracking-wider">
              {lang === 'en' ? 'Key Solutions' : 'Layanan Utama'}
            </h4>
            <ul className="space-y-2 text-slate-400">
              <li>
                <button onClick={() => scrollTo('preference')} className="hover:text-white text-left">
                  • Investor KITAS (Index E28A/B)
                </button>
              </li>
              <li>
                <button onClick={() => scrollTo('preference')} className="hover:text-white text-left">
                  • PT PMA 100% Foreign Owned
                </button>
              </li>
              <li>
                <button onClick={() => scrollTo('preference')} className="hover:text-white text-left">
                  • Remote Worker Visa (E33G)
                </button>
              </li>
              <li>
                <button onClick={() => scrollTo('preference')} className="hover:text-white text-left">
                  • Visit Visa B211A (Up to 180 Days)
                </button>
              </li>
              <li>
                <button onClick={() => scrollTo('preference')} className="hover:text-white text-left">
                  • Working KITAS (E23) & RPTKA
                </button>
              </li>
              <li>
                <button onClick={() => scrollTo('preference')} className="hover:text-white text-left">
                  • Virtual Office & Domicile Bali
                </button>
              </li>
              <li>
                <button onClick={() => scrollTo('preference')} className="hover:text-white text-left">
                  • OSS-RBA & NIB Business Licensing
                </button>
              </li>
            </ul>
          </div>

          {/* Contact & Hours (Col 10 - 12) */}
          <div className="lg:col-span-3 space-y-3">
            <h4 className="text-sm font-bold text-white uppercase tracking-wider">
              {lang === 'en' ? 'Direct Hotline' : 'Kontak Langsung'}
            </h4>
            
            <div className="space-y-2.5 text-slate-300">
              <div className="flex items-center gap-2">
                <PhoneCall className="w-4 h-4 text-[#6EA8C8] shrink-0" />
                <a href="https://wa.me/6281298765432" target="_blank" rel="noopener noreferrer" className="hover:text-white">
                  {t.phone}
                </a>
              </div>
              <div className="flex items-center gap-2">
                <Mail className="w-4 h-4 text-[#6EA8C8] shrink-0" />
                <a href="mailto:hello@onecorevisa.com" className="hover:text-white">
                  {t.email}
                </a>
              </div>
              <div className="flex items-start gap-2">
                <Clock className="w-4 h-4 text-[#6EA8C8] shrink-0 mt-0.5" />
                <span className="text-[11px] text-slate-400">{t.hours}</span>
              </div>
            </div>

            <div className="pt-2">
              <button
                onClick={() => onOpenConsultation()}
                className="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-[#176B9C] to-[#2087C2] text-white font-bold text-xs shadow hover:brightness-110 transition-all flex items-center justify-center gap-2"
              >
                <span>{lang === 'en' ? 'Schedule Legal Call' : 'Jadwalkan Konsultasi'}</span>
                <ArrowRight className="w-3.5 h-3.5" />
              </button>
            </div>
          </div>

        </div>

        {/* Legal Disclaimer */}
        <div className="mt-12 pt-8 border-t border-white/10 text-[11px] text-slate-500 leading-relaxed space-y-3">
          <p>{t.disclaimer}</p>
          <div className="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2 text-slate-400">
            <div>{t.rights}</div>
            <div className="flex items-center gap-4 text-[11px]">
              <span className="hover:text-white cursor-pointer">Privacy Policy</span>
              <span>•</span>
              <span className="hover:text-white cursor-pointer">Terms of Legal Service</span>
              <span>•</span>
              <span className="hover:text-white cursor-pointer">Anti-Corruption & KYC Policy</span>
            </div>
          </div>
        </div>

      </div>
    </footer>
  );
}
