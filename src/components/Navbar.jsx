import React, { useState, useEffect } from 'react';
import { 
  ShieldCheck, 
  Menu, 
  X, 
  Globe, 
  MessageCircle, 
  PhoneCall, 
  ChevronRight,
  FileCheck,
  Building2
} from 'lucide-react';

export default function Navbar({ lang, setLang, content, onOpenConsultation }) {
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const t = content[lang].nav;

  const scrollTo = (id) => {
    setMobileMenuOpen(false);
    const element = document.getElementById(id);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  return (
    <>
      {/* Top Advisory Bar */}
      <div className="bg-[#0B2942] text-xs text-slate-300 py-2 border-b border-[#176B9C]/30 px-4 sm:px-6">
        <div className="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
          <div className="flex items-center gap-2 text-center sm:text-left">
            <span className="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-[#176B9C] text-white">
              Official
            </span>
            <span className="text-slate-300">
              {t.emergencyNotice}
            </span>
          </div>
          <div className="flex items-center gap-4 text-[12px]">
            <a 
              href="https://wa.me/6281298765432" 
              target="_blank" 
              rel="noopener noreferrer"
              className="flex items-center gap-1.5 text-[#6EA8C8] hover:text-white transition-colors"
            >
              <PhoneCall className="w-3.5 h-3.5" />
              <span>+62 812-9876-5432</span>
            </a>
            <span className="text-slate-500 hidden md:inline">|</span>
            <div className="flex items-center gap-1.5 text-slate-300 hidden md:flex">
              <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
              <span>Offices: Jakarta & Bali</span>
            </div>
          </div>
        </div>
      </div>

      {/* Main Sticky Header */}
      <header 
        className={`sticky top-0 z-40 transition-all duration-300 ${
          isScrolled 
            ? 'bg-[#0B2942]/95 backdrop-blur-md shadow-lg shadow-[#0B2942]/10 py-3 border-b border-[#176B9C]/20' 
            : 'bg-[#0B2942] py-4'
        }`}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between">
          {/* Brand Logo */}
          <button 
            onClick={() => scrollTo('hero')} 
            className="flex items-center gap-3 text-left group focus:outline-none"
          >
            <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#0B2942] via-[#176B9C] to-[#6EA8C8] p-[1.5px] shadow-md group-hover:scale-105 transition-transform">
              <div className="w-full h-full bg-[#0B2942] rounded-[10px] flex items-center justify-center text-white">
                <ShieldCheck className="w-6 h-6 text-[#6EA8C8] group-hover:text-white transition-colors" />
              </div>
            </div>
            <div>
              <div className="flex items-center gap-1.5">
                <span className="text-xl font-extrabold tracking-tight text-white">
                  ONECORE<span className="text-[#6EA8C8]">VISA</span>
                </span>
                <span className="text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-[#176B9C]/40 text-[#6EA8C8] border border-[#176B9C]/50">
                  Legal
                </span>
              </div>
              <p className="text-[10px] tracking-wide text-slate-300 font-medium hidden sm:block">
                One Step Solution • Visa & Corporate
              </p>
            </div>
          </button>

          {/* Desktop Navigation Links */}
          <nav className="hidden lg:flex items-center gap-1 xl:gap-2">
            <button 
              onClick={() => scrollTo('hero')} 
              className="px-3 py-2 text-sm font-medium text-slate-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors"
            >
              {t.home}
            </button>
            <button 
              onClick={() => scrollTo('preference')} 
              className="px-3 py-2 text-sm font-semibold text-[#6EA8C8] hover:text-white hover:bg-[#176B9C]/20 rounded-lg transition-colors flex items-center gap-1"
            >
              <span>{t.preference}</span>
              <span className="w-2 h-2 rounded-full bg-[#6EA8C8]"></span>
            </button>
            <button 
              onClick={() => scrollTo('about')} 
              className="px-3 py-2 text-sm font-medium text-slate-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors"
            >
              {t.about}
            </button>
            <button 
              onClick={() => scrollTo('services')} 
              className="px-3 py-2 text-sm font-medium text-slate-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors"
            >
              {t.services}
            </button>
            <button 
              onClick={() => scrollTo('process')} 
              className="px-3 py-2 text-sm font-medium text-slate-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors"
            >
              {t.process}
            </button>
            <button 
              onClick={() => scrollTo('faq')} 
              className="px-3 py-2 text-sm font-medium text-slate-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors"
            >
              {t.faq}
            </button>
          </nav>

          {/* Right Action Controls */}
          <div className="flex items-center gap-3">
            {/* Language Switcher */}
            <div className="flex items-center bg-[#071A2A] border border-[#176B9C]/40 rounded-lg p-0.5 text-xs">
              <button 
                onClick={() => setLang('en')}
                className={`px-2 py-1 rounded font-medium transition-all ${
                  lang === 'en' 
                    ? 'bg-[#176B9C] text-white shadow-sm' 
                    : 'text-slate-400 hover:text-white'
                }`}
              >
                EN
              </button>
              <button 
                onClick={() => setLang('id')}
                className={`px-2 py-1 rounded font-medium transition-all ${
                  lang === 'id' 
                    ? 'bg-[#176B9C] text-white shadow-sm' 
                    : 'text-slate-400 hover:text-white'
                }`}
              >
                ID
              </button>
            </div>

            {/* Direct Consult Button */}
            <button 
              onClick={() => onOpenConsultation()}
              className="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-[#176B9C] to-[#2087C2] text-white text-sm font-semibold shadow-md hover:shadow-lg hover:brightness-110 active:scale-95 transition-all border border-[#6EA8C8]/40"
            >
              <MessageCircle className="w-4 h-4" />
              <span>{t.consultBtn}</span>
            </button>

            {/* Mobile Hamburger Button */}
            <button
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              className="lg:hidden p-2 text-slate-300 hover:text-white rounded-lg hover:bg-white/10"
              aria-label="Toggle Navigation Menu"
            >
              {mobileMenuOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
            </button>
          </div>
        </div>

        {/* Mobile Dropdown Menu */}
        {mobileMenuOpen && (
          <div className="lg:hidden border-t border-[#176B9C]/30 bg-[#0B2942] px-4 pt-4 pb-6 shadow-xl animate-fadeIn">
            <nav className="flex flex-col space-y-2">
              <button 
                onClick={() => scrollTo('hero')} 
                className="flex items-center justify-between p-3 rounded-lg text-left text-slate-200 hover:bg-white/10 font-medium"
              >
                <span>{t.home}</span>
                <ChevronRight className="w-4 h-4 text-slate-400" />
              </button>
              <button 
                onClick={() => scrollTo('preference')} 
                className="flex items-center justify-between p-3 rounded-lg text-left text-[#6EA8C8] bg-[#176B9C]/20 font-semibold"
              >
                <span>{t.preference}</span>
                <ChevronRight className="w-4 h-4 text-[#6EA8C8]" />
              </button>
              <button 
                onClick={() => scrollTo('about')} 
                className="flex items-center justify-between p-3 rounded-lg text-left text-slate-200 hover:bg-white/10 font-medium"
              >
                <span>{t.about}</span>
                <ChevronRight className="w-4 h-4 text-slate-400" />
              </button>
              <button 
                onClick={() => scrollTo('services')} 
                className="flex items-center justify-between p-3 rounded-lg text-left text-slate-200 hover:bg-white/10 font-medium"
              >
                <span>{t.services}</span>
                <ChevronRight className="w-4 h-4 text-slate-400" />
              </button>
              <button 
                onClick={() => scrollTo('process')} 
                className="flex items-center justify-between p-3 rounded-lg text-left text-slate-200 hover:bg-white/10 font-medium"
              >
                <span>{t.process}</span>
                <ChevronRight className="w-4 h-4 text-slate-400" />
              </button>
              <button 
                onClick={() => scrollTo('faq')} 
                className="flex items-center justify-between p-3 rounded-lg text-left text-slate-200 hover:bg-white/10 font-medium"
              >
                <span>{t.faq}</span>
                <ChevronRight className="w-4 h-4 text-slate-400" />
              </button>
              <div className="pt-3">
                <button 
                  onClick={() => {
                    setMobileMenuOpen(false);
                    onOpenConsultation();
                  }}
                  className="w-full flex items-center justify-center gap-2 p-3 rounded-lg bg-gradient-to-r from-[#176B9C] to-[#2087C2] text-white font-semibold shadow"
                >
                  <MessageCircle className="w-4 h-4" />
                  <span>{t.consultBtn}</span>
                </button>
              </div>
            </nav>
          </div>
        )}
      </header>
    </>
  );
}
