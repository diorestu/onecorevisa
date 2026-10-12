import React from 'react';
import { 
  ShieldCheck, 
  CheckCircle, 
  XCircle, 
  Scale, 
  Zap, 
  Building, 
  BadgePercent, 
  MapPin, 
  Users, 
  Award,
  Clock,
  ArrowRight
} from 'lucide-react';

export default function AboutUs({ lang, content, onOpenConsultation }) {
  const t = content[lang].about;

  return (
    <section id="about" className="py-20 bg-white relative scroll-mt-12 overflow-hidden">
      
      {/* Decorative side accent */}
      <div className="absolute top-0 right-0 w-80 h-80 bg-[#176B9C]/5 rounded-bl-[100px] pointer-events-none"></div>
      <div className="absolute bottom-0 left-0 w-64 h-64 bg-[#6EA8C8]/10 rounded-tr-[100px] pointer-events-none"></div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto space-y-4 mb-16">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#0B2942]/10 border border-[#0B2942]/20 text-[#0B2942] text-xs font-bold tracking-wide uppercase">
            <ShieldCheck className="w-3.5 h-3.5 text-[#176B9C]" />
            <span>{t.sectionBadge}</span>
          </div>

          <h2 className="text-3xl sm:text-4xl font-extrabold text-[#0B2942] tracking-tight">
            {t.title}
          </h2>

          <p className="text-slate-600 text-base leading-relaxed">
            {t.subtitle}
          </p>
        </div>

        {/* Mission & Story Split */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20">
          
          <div className="lg:col-span-6 space-y-6">
            <h3 className="text-2xl sm:text-3xl font-extrabold text-[#0B2942] leading-tight">
              {t.missionTitle}
            </h3>

            <p className="text-slate-600 leading-relaxed text-sm sm:text-base">
              {t.missionDesc}
            </p>

            <p className="text-slate-600 leading-relaxed text-sm sm:text-base">
              {t.story}
            </p>

            {/* Strategic Office Badges */}
            <div className="pt-2 grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
              <div className="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200">
                <div className="p-2 rounded-lg bg-[#0B2942] text-[#6EA8C8]">
                  <MapPin className="w-4 h-4" />
                </div>
                <div>
                  <h4 className="font-bold text-[#0B2942]">Jakarta Corporate Hub</h4>
                  <p className="text-[11px] text-slate-500">TB Simatupang Financial District</p>
                </div>
              </div>

              <div className="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200">
                <div className="p-2 rounded-lg bg-[#176B9C] text-white">
                  <MapPin className="w-4 h-4" />
                </div>
                <div>
                  <h4 className="font-bold text-[#0B2942]">Bali Expat & Nomad Hub</h4>
                  <p className="text-[11px] text-slate-500">Sunset Road, Badung & Seminyak</p>
                </div>
              </div>
            </div>

            <div className="pt-2">
              <button
                onClick={() => onOpenConsultation()}
                className="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#0B2942] hover:bg-[#123C5E] text-white font-semibold text-sm shadow-md transition-all group"
              >
                <span>Schedule a Meeting with Our Counsel</span>
                <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
              </button>
            </div>
          </div>

          {/* Visual Trust Dashboard */}
          <div className="lg:col-span-6">
            <div className="rounded-2xl bg-gradient-to-br from-[#0B2942] to-[#123C5E] p-8 text-white shadow-2xl relative">
              <div className="space-y-6">
                
                <div className="flex items-center justify-between border-b border-white/10 pb-4">
                  <div>
                    <h4 className="text-lg font-bold text-white">OneCoreVisa Legal Credentials</h4>
                    <p className="text-xs text-[#6EA8C8]">Accredited Indonesian Legal Practice</p>
                  </div>
                  <Award className="w-8 h-8 text-[#6EA8C8]" />
                </div>

                <div className="grid grid-cols-2 gap-4 text-xs">
                  <div className="p-3 rounded-xl bg-white/5 border border-white/10">
                    <span className="text-[10px] text-slate-400 block uppercase">Immigration Portal</span>
                    <span className="font-bold text-white text-sm">Ditjen Imigrasi Approved</span>
                    <p className="text-[10px] text-emerald-400 mt-1">Direct API submission access</p>
                  </div>

                  <div className="p-3 rounded-xl bg-white/5 border border-white/10">
                    <span className="text-[10px] text-slate-400 block uppercase">Corporate Law</span>
                    <span className="font-bold text-white text-sm">PERADI Licensed</span>
                    <p className="text-[10px] text-[#6EA8C8] mt-1">Court-recognized attorneys</p>
                  </div>

                  <div className="p-3 rounded-xl bg-white/5 border border-white/10">
                    <span className="text-[10px] text-slate-400 block uppercase">Ministry System</span>
                    <span className="font-bold text-white text-sm">OSS RBA & BKPM</span>
                    <p className="text-[10px] text-emerald-400 mt-1">Risk-based licenses expedited</p>
                  </div>

                  <div className="p-3 rounded-xl bg-white/5 border border-white/10">
                    <span className="text-[10px] text-slate-400 block uppercase">Client Satisfaction</span>
                    <span className="font-bold text-white text-sm">99.4% Approval Rate</span>
                    <p className="text-[10px] text-[#6EA8C8] mt-1">5,000+ files processed</p>
                  </div>
                </div>

                <div className="p-4 rounded-xl bg-[#176B9C]/30 border border-[#6EA8C8]/40 flex items-center justify-between">
                  <div className="flex items-center gap-3">
                    <div className="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></div>
                    <span className="text-xs font-medium text-slate-200">
                      Average response time for new inquiries: <strong>under 15 minutes</strong>
                    </span>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>

        {/* 4 Pillars of Excellence */}
        <div className="mb-20">
          <div className="text-center max-w-xl mx-auto mb-10">
            <h3 className="text-2xl font-bold text-[#0B2942]">The 4 Pillars of Our Practice</h3>
            <p className="text-xs text-slate-500 mt-1">Built to provide absolute certainty in an uncertain environment</p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {t.pillars.map((pillar, idx) => {
              const icons = [Scale, Zap, Building, BadgePercent];
              const Icon = icons[idx] || ShieldCheck;

              return (
                <div 
                  key={idx}
                  className="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-[#176B9C] hover:bg-white hover:shadow-lg transition-all group"
                >
                  <div className="w-12 h-12 rounded-xl bg-[#0B2942] text-[#6EA8C8] group-hover:bg-[#176B9C] group-hover:text-white flex items-center justify-center mb-4 transition-colors">
                    <Icon className="w-6 h-6" />
                  </div>
                  <h4 className="text-base font-bold text-[#0B2942] mb-2">
                    {pillar.title}
                  </h4>
                  <p className="text-xs text-slate-600 leading-relaxed">
                    {pillar.desc}
                  </p>
                </div>
              );
            })}
          </div>
        </div>

        {/* Comparison: The Old Way vs The OneCore Advantage */}
        <div className="max-w-4xl mx-auto rounded-2xl border border-slate-200 shadow-xl overflow-hidden">
          <div className="bg-[#0B2942] py-4 px-6 text-center">
            <h3 className="text-lg font-bold text-white tracking-wide">
              {t.comparison.title}
            </h3>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-slate-200">
            
            {/* The Old Way */}
            <div className="p-6 sm:p-8 bg-red-50/30 space-y-4">
              <div className="flex items-center gap-2 text-rose-600 font-bold text-sm">
                <XCircle className="w-5 h-5 shrink-0" />
                <span>{t.comparison.oldWayTitle}</span>
              </div>
              <ul className="space-y-3 text-xs text-slate-700">
                {t.comparison.oldWayPoints.map((pt, pIdx) => (
                  <li key={pIdx} className="flex items-start gap-2">
                    <span className="text-rose-500 font-bold mt-0.5">✕</span>
                    <span>{pt}</span>
                  </li>
                ))}
              </ul>
            </div>

            {/* The OneCore Way */}
            <div className="p-6 sm:p-8 bg-emerald-50/40 space-y-4">
              <div className="flex items-center gap-2 text-emerald-700 font-bold text-sm">
                <CheckCircle className="w-5 h-5 shrink-0" />
                <span>{t.comparison.oneCoreTitle}</span>
              </div>
              <ul className="space-y-3 text-xs text-slate-800 font-medium">
                {t.comparison.oneCorePoints.map((pt, pIdx) => (
                  <li key={pIdx} className="flex items-start gap-2">
                    <span className="text-emerald-600 font-bold mt-0.5">✓</span>
                    <span>{pt}</span>
                  </li>
                ))}
              </ul>
            </div>

          </div>
        </div>

      </div>
    </section>
  );
}
