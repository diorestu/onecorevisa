import React, { useState } from 'react';
import { 
  FileText, 
  Building2, 
  Clock, 
  Calendar, 
  CheckCircle2, 
  ArrowRight, 
  Sparkles, 
  ShieldCheck, 
  Briefcase, 
  Scale, 
  Landmark, 
  Plane, 
  Compass, 
  ChevronDown, 
  ChevronUp
} from 'lucide-react';
import { servicesCatalog } from '../data/contentData';

export default function OurService({ lang, content, onSelectService }) {
  const t = content[lang].services;
  const [activeTab, setActiveTab] = useState('visas');
  const [expandedId, setExpandedId] = useState(null);

  // Group services
  const visaServices = servicesCatalog.filter(s => s.category === 'visas' || s.category === 'kitas');
  const businessServices = servicesCatalog.filter(s => s.category === 'business' || s.category === 'legal');

  const displayedList = activeTab === 'visas' ? visaServices : businessServices;

  const toggleAccordion = (id) => {
    setExpandedId(prev => prev === id ? null : id);
  };

  return (
    <section id="services" className="py-20 bg-slate-50 relative scroll-mt-12">
      <div className="max-w-7xl mx-auto px-4 sm:px-6">
        
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto space-y-4 mb-12">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#176B9C]/10 border border-[#176B9C]/30 text-[#176B9C] text-xs font-bold tracking-wide uppercase">
            <Briefcase className="w-3.5 h-3.5 text-[#176B9C]" />
            <span>{t.sectionBadge}</span>
          </div>

          <h2 className="text-3xl sm:text-4xl font-extrabold text-[#0B2942] tracking-tight">
            {t.title}
          </h2>

          <p className="text-slate-600 text-base leading-relaxed">
            {t.subtitle}
          </p>

          {/* Master Tabs Switcher */}
          <div className="pt-4 flex justify-center">
            <div className="inline-flex p-1.5 rounded-2xl bg-white border border-slate-200 shadow-sm max-w-xl w-full">
              <button
                onClick={() => {
                  setActiveTab('visas');
                  setExpandedId(null);
                }}
                className={`flex-1 py-3 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all flex items-center justify-center gap-2 ${
                  activeTab === 'visas'
                    ? 'bg-[#0B2942] text-white shadow-md'
                    : 'text-slate-600 hover:text-[#0B2942] hover:bg-slate-50'
                }`}
              >
                <Plane className="w-4 h-4 text-[#6EA8C8]" />
                <span>{t.tabVisa}</span>
              </button>

              <button
                onClick={() => {
                  setActiveTab('business');
                  setExpandedId(null);
                }}
                className={`flex-1 py-3 px-4 rounded-xl text-xs sm:text-sm font-bold transition-all flex items-center justify-center gap-2 ${
                  activeTab === 'business'
                    ? 'bg-[#0B2942] text-white shadow-md'
                    : 'text-slate-600 hover:text-[#0B2942] hover:bg-slate-50'
                }`}
              >
                <Building2 className="w-4 h-4 text-[#6EA8C8]" />
                <span>{t.tabBusiness}</span>
              </button>
            </div>
          </div>

          <p className="text-xs text-slate-500 pt-2">
            {activeTab === 'visas' ? t.visaDescription : t.businessDescription}
          </p>
        </div>

        {/* Services Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {displayedList.map((service) => {
            const isExpanded = expandedId === service.id;
            const title = lang === 'en' ? service.titleEn : service.titleId;
            const desc = lang === 'en' ? service.shortDescEn : service.shortDescId;
            const whoFor = lang === 'en' ? service.whoForEn : service.whoForId;

            return (
              <div
                key={service.id}
                className="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-[#176B9C]/50 transition-all duration-300 flex flex-col justify-between overflow-hidden group"
              >
                {/* Top Section */}
                <div className="p-6">
                  
                  <div className="flex items-center justify-between gap-2 mb-3">
                    <span className="px-2.5 py-1 rounded-md text-[11px] font-mono font-bold bg-[#EBF3F8] text-[#176B9C]">
                      {service.code}
                    </span>
                    <span className="px-2 py-0.5 rounded text-[10px] font-bold bg-[#0B2942] text-[#6EA8C8]">
                      {service.tag}
                    </span>
                  </div>

                  <h3 className="text-lg font-bold text-[#0B2942] group-hover:text-[#176B9C] transition-colors leading-snug">
                    {title}
                  </h3>

                  <p className="text-xs text-slate-600 mt-2 leading-relaxed">
                    {desc}
                  </p>

                  {/* Highlights Grid */}
                  <div className="mt-4 pt-3 border-t border-slate-100 grid grid-cols-2 gap-2 text-[11px]">
                    <div className="bg-slate-50 p-2 rounded-lg">
                      <span className="text-[10px] text-slate-400 block font-medium">Processing Time</span>
                      <span className="font-bold text-[#0B2942]">{service.processingTime}</span>
                    </div>
                    <div className="bg-slate-50 p-2 rounded-lg">
                      <span className="text-[10px] text-slate-400 block font-medium">Validity / Term</span>
                      <span className="font-bold text-[#0B2942]">{service.duration}</span>
                    </div>
                  </div>

                  {/* Top 3 Perks preview */}
                  <div className="mt-4 space-y-1.5">
                    <span className="text-[10px] font-bold text-slate-500 uppercase tracking-wider block">
                      Included Advantages:
                    </span>
                    {service.perks.slice(0, 3).map((perk, pIdx) => (
                      <div key={pIdx} className="flex items-start gap-1.5 text-xs text-slate-700">
                        <CheckCircle2 className="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5" />
                        <span>{perk}</span>
                      </div>
                    ))}
                  </div>

                  {/* Expandable Checklist Details */}
                  {isExpanded && (
                    <div className="mt-4 pt-4 border-t border-slate-100 text-xs space-y-3 animate-fadeIn">
                      <div>
                        <span className="text-[11px] font-bold text-[#0B2942] block mb-1">
                          Required Documents:
                        </span>
                        <ul className="space-y-1 text-slate-600 pl-1">
                          {service.requirements.map((req, rIdx) => (
                            <li key={rIdx} className="flex items-start gap-1.5 text-[11px]">
                              <span className="text-[#176B9C] font-bold">•</span>
                              <span>{req}</span>
                            </li>
                          ))}
                        </ul>
                      </div>

                      <div className="p-2.5 rounded-lg bg-[#EBF3F8] text-[#0B2942] text-[11px]">
                        <strong>Target Profile:</strong> {whoFor}
                      </div>
                    </div>
                  )}

                </div>

                {/* Bottom Actions */}
                <div className="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between gap-2">
                  <button
                    onClick={() => toggleAccordion(service.id)}
                    className="text-xs font-semibold text-[#176B9C] hover:text-[#0B2942] flex items-center gap-1"
                  >
                    <span>{isExpanded ? t.hideChecklist : t.viewChecklist}</span>
                    {isExpanded ? <ChevronUp className="w-3.5 h-3.5" /> : <ChevronDown className="w-3.5 h-3.5" />}
                  </button>

                  <button
                    onClick={() => onSelectService(service)}
                    className="px-4 py-2 rounded-lg bg-[#176B9C] hover:bg-[#12577F] text-white text-xs font-bold shadow transition-all flex items-center gap-1"
                  >
                    <span>{t.bookConsultation}</span>
                    <ArrowRight className="w-3.5 h-3.5" />
                  </button>
                </div>

              </div>
            );
          })}
        </div>

        {/* Legal Assurance Bar */}
        <div className="mt-12 p-6 rounded-2xl bg-[#0B2942] text-white flex flex-col md:flex-row items-center justify-between gap-6">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 rounded-xl bg-[#176B9C] flex items-center justify-center text-white shrink-0">
              <ShieldCheck className="w-7 h-7" />
            </div>
            <div>
              <h4 className="text-base font-bold text-white">Custom Corporate or Multi-Entry Needs?</h4>
              <p className="text-xs text-slate-300 mt-0.5">
                We handle specialized Golden Visas, Second Home Visas, large-scale expatriate quotas (RPTKA), and corporate cross-border restructuring.
              </p>
            </div>
          </div>
          <button
            onClick={() => onSelectService({ titleEn: 'Custom Legal / Corporate Inquiry', titleId: 'Konsultasi Khusus Legal / Korporat' })}
            className="px-6 py-3 rounded-xl bg-gradient-to-r from-[#176B9C] to-[#6EA8C8] text-white font-bold text-xs uppercase tracking-wider hover:brightness-110 shadow-lg whitespace-nowrap"
          >
            Request Custom Legal Proposal
          </button>
        </div>

      </div>
    </section>
  );
}
