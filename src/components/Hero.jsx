import React from 'react';
import { 
  ShieldCheck, 
  ArrowRight, 
  Sparkles, 
  CheckCircle2, 
  Search, 
  MessageCircle, 
  Building2, 
  FileCheck2, 
  Stamp, 
  Award,
  Globe2
} from 'lucide-react';

export default function Hero({ lang, content, onOpenConsultation, onQuickSearch }) {
  const t = content[lang].hero;

  const scrollToSection = (id) => {
    const el = document.getElementById(id);
    if (el) {
      el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  return (
    <section id="hero" className="relative bg-[#0B2942] text-white pt-12 pb-20 md:pt-16 md:pb-28 overflow-hidden">
      {/* Background Decorative Gradients & Grid */}
      <div className="absolute inset-0 opacity-15 pointer-events-none">
        <div className="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-[#176B9C] blur-[120px]"></div>
        <div className="absolute top-1/2 -left-20 w-80 h-80 rounded-full bg-[#6EA8C8] blur-[100px]"></div>
        <div className="absolute bottom-0 right-1/4 w-72 h-72 rounded-full bg-[#176B9C] blur-[90px]"></div>
        {/* Subtle grid pattern */}
        <div 
          className="w-full h-full"
          style={{
            backgroundImage: `radial-gradient(circle at 1px 1px, rgba(110, 168, 200, 0.15) 1px, transparent 0)`,
            backgroundSize: '36px 36px'
          }}
        ></div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
          
          {/* Left Column: Core Value Proposition */}
          <div className="lg:col-span-7 text-left space-y-6">
            
            {/* Top Pill Badge */}
            <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#176B9C]/25 border border-[#6EA8C8]/30 backdrop-blur-sm">
              <span className="w-2 h-2 rounded-full bg-[#6EA8C8] animate-ping"></span>
              <span className="text-xs sm:text-sm font-semibold text-[#6EA8C8] tracking-wide">
                {t.badge}
              </span>
            </div>

            {/* Main Brand Title & One Step Solution */}
            <div className="space-y-2">
              <h1 className="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                {t.title}
              </h1>
              <div className="inline-block">
                <span className="text-2xl sm:text-3xl lg:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-[#6EA8C8] via-white to-[#6EA8C8]">
                  ({t.tagline})
                </span>
              </div>
            </div>

            {/* Subtitle */}
            <p className="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl font-normal">
              {t.subtitle}
            </p>

            {/* Service Scope Pills */}
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
              <div className="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/5 border border-[#176B9C]/40 backdrop-blur-sm">
                <div className="p-2 rounded-lg bg-[#176B9C] text-white">
                  <FileCheck2 className="w-4 h-4" />
                </div>
                <div>
                  <h4 className="text-xs font-bold text-white">Visa & KITAS Specialists</h4>
                  <p className="text-[11px] text-slate-300">e-VOA, B211A, Working, Investor & Nomad</p>
                </div>
              </div>

              <div className="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/5 border border-[#176B9C]/40 backdrop-blur-sm">
                <div className="p-2 rounded-lg bg-[#6EA8C8] text-[#0B2942]">
                  <Building2 className="w-4 h-4" />
                </div>
                <div>
                  <h4 className="text-xs font-bold text-white">Business Setup & Legal Assist</h4>
                  <p className="text-[11px] text-slate-300">PT PMA 100% Foreign Owned, NIB, Virtual Office</p>
                </div>
              </div>
            </div>

            {/* Call To Actions */}
            <div className="flex flex-wrap items-center gap-3 pt-2">
              <button
                onClick={() => scrollToSection('preference')}
                className="flex items-center gap-2.5 px-6 py-3.5 rounded-xl bg-gradient-to-r from-[#176B9C] to-[#2087C2] text-white font-semibold text-sm sm:text-base shadow-lg shadow-[#176B9C]/30 hover:shadow-xl hover:scale-[1.02] active:scale-95 transition-all border border-[#6EA8C8]/40"
              >
                <Search className="w-4 h-4 text-[#6EA8C8]" />
                <span>{t.ctaPrimary}</span>
                <ArrowRight className="w-4 h-4" />
              </button>

              <button
                onClick={() => onOpenConsultation()}
                className="flex items-center gap-2 px-6 py-3.5 rounded-xl bg-[#0B2942] hover:bg-[#123C5E] text-white font-semibold text-sm sm:text-base border border-[#6EA8C8]/50 hover:border-[#6EA8C8] transition-all"
              >
                <MessageCircle className="w-4 h-4 text-[#6EA8C8]" />
                <span>{t.ctaSecondary}</span>
              </button>

              <a
                href="https://wa.me/6281298765432"
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-center gap-2 px-4 py-3.5 rounded-xl bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-300 font-semibold text-sm border border-emerald-500/30 transition-all"
              >
                <span className="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span>{t.ctaWhatsApp}</span>
              </a>
            </div>

            {/* Quick Feature Checklist */}
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-2 text-xs text-slate-300">
              {t.features.map((feat, idx) => (
                <div key={idx} className="flex items-center gap-2">
                  <CheckCircle2 className="w-4 h-4 text-[#6EA8C8] shrink-0" />
                  <span>{feat}</span>
                </div>
              ))}
            </div>

          </div>

          {/* Right Column: Interactive Trust Card & Pass Simulator */}
          <div className="lg:col-span-5">
            <div className="relative">
              
              {/* Outer Glow */}
              <div className="absolute -inset-1 rounded-3xl bg-gradient-to-r from-[#176B9C] via-[#6EA8C8] to-[#176B9C] opacity-40 blur-xl"></div>

              {/* Main Card */}
              <div className="relative rounded-2xl bg-gradient-to-b from-[#0F3554] to-[#071A2A] border border-[#6EA8C8]/30 p-6 shadow-2xl space-y-6">
                
                {/* Card Top: Government & Pass Branding */}
                <div className="flex items-center justify-between border-b border-white/10 pb-4">
                  <div className="flex items-center gap-3">
                    <div className="w-10 h-10 rounded-xl bg-[#176B9C]/30 border border-[#6EA8C8]/40 flex items-center justify-center text-[#6EA8C8]">
                      <ShieldCheck className="w-6 h-6" />
                    </div>
                    <div>
                      <h4 className="text-sm font-bold text-white tracking-wide">ONECORE VERIFIED PASS</h4>
                      <p className="text-[11px] text-[#6EA8C8] font-mono">ID: OCV-INA-2026-LEGAL</p>
                    </div>
                  </div>
                  <span className="px-2.5 py-1 rounded-full bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-[11px] font-bold flex items-center gap-1">
                    <span className="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    100% Compliant
                  </span>
                </div>

                {/* Simulated Pass Body */}
                <div className="bg-[#0B2942]/80 rounded-xl p-4 border border-[#176B9C]/30 space-y-3">
                  <div className="flex justify-between items-start text-xs">
                    <div>
                      <span className="text-[10px] text-slate-400 uppercase tracking-wider block">Service Category</span>
                      <span className="font-semibold text-white text-sm">Visa, KITAS & PT PMA Setup</span>
                    </div>
                    <div className="text-right">
                      <span className="text-[10px] text-slate-400 uppercase tracking-wider block">Jurisdiction</span>
                      <span className="font-semibold text-[#6EA8C8]">Republic of Indonesia</span>
                    </div>
                  </div>

                  <div className="grid grid-cols-2 gap-3 pt-2 text-xs border-t border-white/5">
                    <div>
                      <span className="text-[10px] text-slate-400 block">Fast-Track Status</span>
                      <span className="font-medium text-emerald-300 flex items-center gap-1">
                        <CheckCircle2 className="w-3.5 h-3.5" /> Direct Government Queue
                      </span>
                    </div>
                    <div>
                      <span className="text-[10px] text-slate-400 block">Biometric Escort</span>
                      <span className="font-medium text-white">VIP Priority (Bali & Jakarta)</span>
                    </div>
                  </div>

                  <div className="pt-2 border-t border-white/5 flex items-center justify-between text-xs">
                    <div>
                      <span className="text-[10px] text-slate-400 block">Direct Assistance</span>
                      <span className="font-semibold text-slate-200">Certified Advocate (PERADI)</span>
                    </div>
                    <div className="px-2 py-1 rounded bg-[#176B9C]/40 text-[#6EA8C8] text-[11px] font-mono">
                      SLA: 3-7 Days
                    </div>
                  </div>
                </div>

                {/* Popular Services Direct Launch */}
                <div className="space-y-2">
                  <div className="flex items-center justify-between text-xs">
                    <span className="text-slate-300 font-medium">Quick Select Preference:</span>
                    <span className="text-[11px] text-[#6EA8C8]">Instant Match</span>
                  </div>
                  <div className="grid grid-cols-2 gap-2 text-xs">
                    <button
                      onClick={() => onQuickSearch('Investor KITAS')}
                      className="p-2.5 rounded-lg bg-white/5 hover:bg-[#176B9C]/30 border border-white/10 hover:border-[#6EA8C8] text-left transition-all group"
                    >
                      <div className="font-semibold text-white group-hover:text-[#6EA8C8] transition-colors">
                        Investor KITAS
                      </div>
                      <div className="text-[10px] text-slate-400">1-2 Yrs • 0% DPKK Tax</div>
                    </button>

                    <button
                      onClick={() => onQuickSearch('PT PMA')}
                      className="p-2.5 rounded-lg bg-white/5 hover:bg-[#176B9C]/30 border border-white/10 hover:border-[#6EA8C8] text-left transition-all group"
                    >
                      <div className="font-semibold text-white group-hover:text-[#6EA8C8] transition-colors">
                        PT PMA Setup
                      </div>
                      <div className="text-[10px] text-slate-400">100% Foreign Owned</div>
                    </button>

                    <button
                      onClick={() => onQuickSearch('Remote Worker')}
                      className="p-2.5 rounded-lg bg-white/5 hover:bg-[#176B9C]/30 border border-white/10 hover:border-[#6EA8C8] text-left transition-all group"
                    >
                      <div className="font-semibold text-white group-hover:text-[#6EA8C8] transition-colors">
                        Nomad Visa E33G
                      </div>
                      <div className="text-[10px] text-slate-400">1 Year • Tax Friendly</div>
                    </button>

                    <button
                      onClick={() => onQuickSearch('B211A')}
                      className="p-2.5 rounded-lg bg-white/5 hover:bg-[#176B9C]/30 border border-white/10 hover:border-[#6EA8C8] text-left transition-all group"
                    >
                      <div className="font-semibold text-white group-hover:text-[#6EA8C8] transition-colors">
                        Visit Visa B211A
                      </div>
                      <div className="text-[10px] text-slate-400">Up to 180 Days Stay</div>
                    </button>
                  </div>
                </div>

                {/* Bottom Trust Accreditation Logos */}
                <div className="pt-2 border-t border-white/10 flex items-center justify-between text-[11px] text-slate-400">
                  <span className="flex items-center gap-1">
                    <Stamp className="w-3.5 h-3.5 text-[#6EA8C8]" />
                    <span>Ditjen Imigrasi</span>
                  </span>
                  <span className="flex items-center gap-1">
                    <Building2 className="w-3.5 h-3.5 text-[#6EA8C8]" />
                    <span>BKPM / OSS RBA</span>
                  </span>
                  <span className="flex items-center gap-1">
                    <Award className="w-3.5 h-3.5 text-[#6EA8C8]" />
                    <span>Kemenkumham RI</span>
                  </span>
                </div>

              </div>
            </div>
          </div>

        </div>

        {/* Bottom Metrics Bar */}
        <div className="mt-16 pt-10 border-t border-[#176B9C]/30">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            {t.stats.map((item, idx) => (
              <div key={idx} className="p-4 rounded-xl bg-white/[0.03] border border-white/5 backdrop-blur-sm">
                <div className="text-3xl sm:text-4xl font-extrabold text-[#6EA8C8] tracking-tight">
                  {item.value}
                </div>
                <div className="text-xs sm:text-sm text-slate-300 font-medium mt-1">
                  {item.label}
                </div>
              </div>
            ))}
          </div>
        </div>

      </div>
    </section>
  );
}
