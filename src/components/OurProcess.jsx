import React from 'react';
import { 
  Sparkles, 
  Clock, 
  CheckCircle, 
  ShieldCheck, 
  FileCheck2, 
  Send, 
  Award, 
  UserCheck, 
  ArrowRight,
  Headphones
} from 'lucide-react';

export default function OurProcess({ lang, content, onOpenConsultation }) {
  const t = content[lang].process;

  const stepIcons = [Headphones, FileCheck2, Send, Award];

  return (
    <section id="process" className="py-20 bg-white relative scroll-mt-12 overflow-hidden">
      
      {/* Background Accent Gradients */}
      <div className="absolute top-1/2 left-0 w-72 h-72 bg-[#6EA8C8]/10 rounded-full blur-3xl pointer-events-none"></div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto space-y-4 mb-16">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#176B9C]/10 border border-[#176B9C]/30 text-[#176B9C] text-xs font-bold tracking-wide uppercase">
            <Sparkles className="w-3.5 h-3.5 text-[#176B9C]" />
            <span>{t.sectionBadge}</span>
          </div>

          <h2 className="text-3xl sm:text-4xl font-extrabold text-[#0B2942] tracking-tight">
            {t.title}
          </h2>

          <p className="text-slate-600 text-base leading-relaxed">
            {t.subtitle}
          </p>
        </div>

        {/* Process Timeline Steps */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative">
          
          {t.steps.map((step, idx) => {
            const Icon = stepIcons[idx] || CheckCircle;

            return (
              <div
                key={idx}
                className="bg-slate-50 rounded-2xl p-6 border border-slate-200 hover:border-[#176B9C] hover:bg-white hover:shadow-xl transition-all duration-300 relative flex flex-col justify-between group"
              >
                {/* Step Number Badge */}
                <div className="flex items-center justify-between mb-6">
                  <div className="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#0B2942] to-[#176B9C] text-white flex items-center justify-center font-extrabold text-lg shadow-md group-hover:scale-105 transition-transform">
                    {step.step}
                  </div>
                  
                  <span className="px-2.5 py-1 rounded-full bg-[#EBF3F8] text-[#176B9C] border border-[#176B9C]/30 text-[11px] font-bold flex items-center gap-1">
                    <Clock className="w-3 h-3" />
                    <span>{step.timeline}</span>
                  </span>
                </div>

                {/* Step Content */}
                <div className="space-y-2 mb-4">
                  <div className="w-8 h-8 rounded-lg bg-[#6EA8C8]/20 text-[#176B9C] flex items-center justify-center mb-2">
                    <Icon className="w-4 h-4" />
                  </div>

                  <h3 className="text-base font-bold text-[#0B2942] group-hover:text-[#176B9C] transition-colors leading-snug">
                    {step.title}
                  </h3>

                  <p className="text-xs text-slate-600 leading-relaxed">
                    {step.desc}
                  </p>
                </div>

                {/* Step Status Indicator */}
                <div className="pt-3 border-t border-slate-200/60 flex items-center justify-between text-[11px] text-slate-500">
                  <span className="font-semibold text-emerald-600 flex items-center gap-1">
                    <CheckCircle className="w-3.5 h-3.5" /> Phase {idx + 1}
                  </span>
                  <span className="text-[10px] text-slate-400">Step {idx + 1} of 4</span>
                </div>
              </div>
            );
          })}

        </div>

        {/* The OneCore Guarantee Box */}
        <div className="mt-16 rounded-2xl bg-gradient-to-r from-[#0B2942] via-[#123C5E] to-[#0B2942] p-8 text-white shadow-xl border border-[#6EA8C8]/30">
          <div className="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            
            <div className="md:col-span-8 space-y-3">
              <div className="flex items-center gap-2">
                <ShieldCheck className="w-6 h-6 text-[#6EA8C8]" />
                <h3 className="text-xl font-bold text-white tracking-wide">
                  {t.guarantee.title}
                </h3>
              </div>
              <p className="text-slate-300 text-sm leading-relaxed max-w-2xl">
                {t.guarantee.desc}
              </p>
              
              <div className="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2 text-xs">
                <div className="flex items-center gap-2 text-slate-200">
                  <CheckCircle className="w-4 h-4 text-[#6EA8C8] shrink-0" />
                  <span>Zero Bureaucratic Stress</span>
                </div>
                <div className="flex items-center gap-2 text-slate-200">
                  <CheckCircle className="w-4 h-4 text-[#6EA8C8] shrink-0" />
                  <span>VIP Biometric Escort</span>
                </div>
                <div className="flex items-center gap-2 text-slate-200">
                  <CheckCircle className="w-4 h-4 text-[#6EA8C8] shrink-0" />
                  <span>Real-time WhatsApp Status</span>
                </div>
              </div>
            </div>

            <div className="md:col-span-4 flex justify-start md:justify-end">
              <button
                onClick={() => onOpenConsultation()}
                className="px-6 py-3.5 rounded-xl bg-gradient-to-r from-[#176B9C] to-[#2087C2] hover:brightness-110 text-white font-bold text-xs uppercase tracking-wider shadow-lg flex items-center gap-2 active:scale-95 transition-all"
              >
                <span>Start Step 1 Today</span>
                <ArrowRight className="w-4 h-4" />
              </button>
            </div>

          </div>
        </div>

      </div>
    </section>
  );
}
