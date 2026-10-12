import React, { useState } from 'react';
import { 
  HelpCircle, 
  ChevronDown, 
  ChevronUp, 
  Star, 
  Quote, 
  MessageCircle, 
  ArrowRight,
  ShieldCheck,
  CheckCircle2
} from 'lucide-react';
import { faqList, clientTestimonials } from '../data/contentData';

export default function TestimonialsFAQ({ lang, content, onOpenConsultation }) {
  const [openFaqIndex, setOpenFaqIndex] = useState(0);
  const tFaq = content[lang].faq;
  const tCta = content[lang].ctaBanner;

  const toggleFaq = (idx) => {
    setOpenFaqIndex(prev => prev === idx ? -1 : idx);
  };

  return (
    <div id="faq" className="scroll-mt-12">
      
      {/* Testimonials Section */}
      <section className="py-20 bg-slate-50 border-t border-slate-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6">
          
          <div className="text-center max-w-2xl mx-auto space-y-3 mb-14">
            <span className="text-xs font-bold uppercase tracking-wider text-[#176B9C] bg-[#176B9C]/10 px-3 py-1 rounded-full">
              Client Experiences
            </span>
            <h2 className="text-3xl font-extrabold text-[#0B2942]">
              Trusted by 5,000+ Global Expats & Founders
            </h2>
            <p className="text-xs sm:text-sm text-slate-600">
              Read how international investors, remote tech talents, and corporate leaders rely on OneCoreVisa for legal peace of mind in Indonesia.
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {clientTestimonials.map((item, idx) => {
              const quote = lang === 'en' ? item.quoteEn : item.quoteId;
              const role = lang === 'en' ? item.roleEn : item.roleId;

              return (
                <div 
                  key={idx}
                  className="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-lg transition-all"
                >
                  <div className="space-y-4">
                    <div className="flex items-center justify-between">
                      <div className="flex text-amber-400 gap-1">
                        {[...Array(5)].map((_, i) => (
                          <Star key={i} className="w-4 h-4 fill-amber-400" />
                        ))}
                      </div>
                      <span className="text-xs font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                        {item.country}
                      </span>
                    </div>

                    <p className="text-xs text-slate-600 italic leading-relaxed">
                      "{quote}"
                    </p>
                  </div>

                  <div className="mt-6 pt-4 border-t border-slate-100">
                    <h4 className="text-sm font-bold text-[#0B2942]">{item.client}</h4>
                    <p className="text-[11px] text-slate-500">{role}</p>
                    <span className="mt-2 inline-block px-2 py-0.5 rounded text-[10px] font-semibold bg-[#EBF3F8] text-[#176B9C]">
                      {item.serviceUsed}
                    </span>
                  </div>
                </div>
              );
            })}
          </div>

        </div>
      </section>

      {/* FAQ Accordion Section */}
      <section className="py-20 bg-white">
        <div className="max-w-4xl mx-auto px-4 sm:px-6">
          
          <div className="text-center space-y-3 mb-12">
            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#0B2942]/10 text-[#0B2942] text-xs font-bold uppercase tracking-wider">
              <HelpCircle className="w-3.5 h-3.5 text-[#176B9C]" />
              <span>{tFaq.sectionBadge}</span>
            </div>
            <h2 className="text-3xl font-extrabold text-[#0B2942]">
              {tFaq.title}
            </h2>
            <p className="text-xs sm:text-sm text-slate-600">
              {tFaq.subtitle}
            </p>
          </div>

          <div className="space-y-4">
            {faqList.map((faq, idx) => {
              const isOpen = openFaqIndex === idx;
              const q = lang === 'en' ? faq.qEn : faq.qId;
              const a = lang === 'en' ? faq.aEn : faq.aId;

              return (
                <div
                  key={idx}
                  className={`border rounded-2xl transition-all ${
                    isOpen 
                      ? 'border-[#176B9C] bg-[#EBF3F8]/30 shadow-sm' 
                      : 'border-slate-200 bg-white hover:border-slate-300'
                  }`}
                >
                  <button
                    onClick={() => toggleFaq(idx)}
                    className="w-full py-4 px-6 text-left flex items-center justify-between gap-4 font-bold text-sm sm:text-base text-[#0B2942]"
                  >
                    <span>{q}</span>
                    <span className={`p-1.5 rounded-lg transition-transform ${isOpen ? 'bg-[#176B9C] text-white rotate-180' : 'bg-slate-100 text-slate-500'}`}>
                      <ChevronDown className="w-4 h-4" />
                    </span>
                  </button>

                  {isOpen && (
                    <div className="px-6 pb-5 pt-1 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-[#176B9C]/20 animate-fadeIn">
                      {a}
                    </div>
                  )}
                </div>
              );
            })}
          </div>

        </div>
      </section>

      {/* High-Converting Pre-Footer Banner */}
      <section className="py-16 bg-gradient-to-r from-[#0B2942] via-[#123C5E] to-[#0B2942] text-white">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 text-center space-y-6">
          <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#176B9C]/40 border border-[#6EA8C8]/50 text-[#6EA8C8] text-xs font-bold uppercase tracking-wider">
            <ShieldCheck className="w-4 h-4" />
            <span>Fast, Reliable & 100% Legal</span>
          </div>

          <h2 className="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white max-w-3xl mx-auto tracking-tight">
            {tCta.title}
          </h2>

          <p className="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            {tCta.subtitle}
          </p>

          <div className="flex flex-wrap items-center justify-center gap-4 pt-2">
            <button
              onClick={() => onOpenConsultation()}
              className="px-8 py-4 rounded-xl bg-gradient-to-r from-[#176B9C] to-[#2087C2] text-white font-bold text-sm sm:text-base shadow-xl hover:brightness-110 active:scale-95 transition-all flex items-center gap-2 border border-[#6EA8C8]/40"
            >
              <MessageCircle className="w-5 h-5 text-[#6EA8C8]" />
              <span>{tCta.buttonConsult}</span>
              <ArrowRight className="w-4 h-4" />
            </button>

            <a
              href="https://wa.me/6281298765432"
              target="_blank"
              rel="noopener noreferrer"
              className="px-6 py-4 rounded-xl bg-emerald-600/30 hover:bg-emerald-600/40 text-emerald-200 font-bold text-sm sm:text-base border border-emerald-400/30 flex items-center gap-2 transition-all"
            >
              <span className="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
              <span>{tCta.buttonWhatsApp}</span>
            </a>
          </div>
        </div>
      </section>

    </div>
  );
}
