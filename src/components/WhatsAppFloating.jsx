import React, { useState } from 'react';
import { MessageCircle, X, Send } from 'lucide-react';

export default function WhatsAppFloating({ lang }) {
  const [showTooltip, setShowTooltip] = useState(false);

  const defaultMsg = lang === 'en'
    ? "Halo OneCoreVisa, I would like to consult about Indonesian Visa / KITAS / PT PMA setup."
    : "Halo OneCoreVisa, saya ingin konsultasi mengenai pengurusan Visa / KITAS / PT PMA di Indonesia.";

  const waUrl = `https://wa.me/6281298765432?text=${encodeURIComponent(defaultMsg)}`;

  return (
    <div className="fixed bottom-6 right-6 z-40 flex flex-col items-end">
      
      {/* Quick Tooltip Popover */}
      {showTooltip && (
        <div className="mb-3 p-4 bg-white rounded-2xl shadow-2xl border border-slate-200 max-w-xs animate-fadeIn text-xs relative">
          <button 
            onClick={() => setShowTooltip(false)}
            className="absolute top-2 right-2 text-slate-400 hover:text-slate-600"
          >
            <X className="w-4 h-4" />
          </button>
          <div className="flex items-center gap-2 mb-1.5">
            <span className="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
            <span className="font-bold text-[#0B2942]">
              {lang === 'en' ? 'Online Legal Specialist' : 'Spesialis Legal Online'}
            </span>
          </div>
          <p className="text-slate-600 mb-3 text-[11px] leading-relaxed">
            {lang === 'en' 
              ? 'Have questions about Visa requirements or company setup? We are ready to help.'
              : 'Punya pertanyaan seputar syarat visa atau pendirian PT PMA? Kami siap membantu.'}
          </p>
          <a
            href={waUrl}
            target="_blank"
            rel="noopener noreferrer"
            className="w-full py-2 px-3 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] flex items-center justify-center gap-1.5 shadow"
          >
            <span>{lang === 'en' ? 'Start Chat' : 'Mulai Chat'}</span>
            <Send className="w-3 h-3" />
          </a>
        </div>
      )}

      {/* Main WhatsApp Button */}
      <a
        href={waUrl}
        target="_blank"
        rel="noopener noreferrer"
        onMouseEnter={() => setShowTooltip(true)}
        className="w-14 h-14 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center shadow-xl hover:scale-110 active:scale-95 transition-all group relative border-2 border-white"
        aria-label="Chat on WhatsApp"
      >
        <span className="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-rose-500 text-[10px] text-white flex items-center justify-center font-bold">
          1
        </span>
        <MessageCircle className="w-7 h-7 fill-white/20 group-hover:scale-105 transition-transform" />
      </a>
    </div>
  );
}
