import React, { useState, useEffect } from 'react';
import { 
  X, 
  Send, 
  MessageCircle, 
  CheckCircle2, 
  ShieldCheck, 
  Clock, 
  Globe, 
  User, 
  Mail, 
  Phone
} from 'lucide-react';
import { servicesCatalog } from '../data/contentData';

export default function ConsultationModal({ isOpen, onClose, selectedService, lang }) {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    whatsapp: '',
    nationality: '',
    service: '',
    location: 'Inside Indonesia (Bali/Jakarta)',
    notes: ''
  });

  const [isSubmitted, setIsSubmitted] = useState(false);

  useEffect(() => {
    if (selectedService) {
      const title = lang === 'en' 
        ? (selectedService.titleEn || selectedService.name) 
        : (selectedService.titleId || selectedService.name);
      setFormData(prev => ({ ...prev, service: title || '' }));
    }
  }, [selectedService, lang]);

  useEffect(() => {
    const handleKeyDown = (e) => {
      if (e.key === 'Escape' && isOpen) {
        onClose();
      }
    };
    window.addEventListener('keydown', handleKeyDown);
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, [isOpen, onClose]);

  if (!isOpen) return null;

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    setIsSubmitted(true);
  };

  // WhatsApp pre-filled format
  const generateWhatsAppMessage = () => {
    const text = `Halo OneCoreVisa,%0A%0ASaya ingin konsultasi layanan:%0A- Nama: ${encodeURIComponent(formData.name || 'Calon Klien')}%0A- Email: ${encodeURIComponent(formData.email || '-')}%0A- WhatsApp: ${encodeURIComponent(formData.whatsapp || '-')}%0A- Warga Negara: ${encodeURIComponent(formData.nationality || '-')}%0A- Layanan Yang Diminati: ${encodeURIComponent(formData.service || 'Konsultasi Visa & PT PMA')}%0A- Lokasi Saat Ini: ${encodeURIComponent(formData.location)}%0A- Catatan: ${encodeURIComponent(formData.notes || 'Mohon informasi prosedur dan biaya.')}%0A%0AMohon bantuan konsultan hukum OneCoreVisa. Terima kasih!`;
    return `https://wa.me/6281298765432?text=${text}`;
  };

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto animate-fadeIn">
      {/* Dim Backdrop */}
      <div 
        className="fixed inset-0 bg-[#071A2A]/80 backdrop-blur-sm transition-opacity"
        onClick={onClose}
      ></div>

      {/* Modal Dialog Window */}
      <div className="relative bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 z-10 overflow-hidden my-auto max-h-[90vh] overflow-y-auto">
        
        {/* Top Decorative Header */}
        <div className="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-[#0B2942] via-[#176B9C] to-[#6EA8C8]"></div>

        <button
          onClick={onClose}
          className="absolute top-5 right-5 p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors"
          aria-label="Close dialog"
        >
          <X className="w-5 h-5" />
        </button>

        {isSubmitted ? (
          <div className="text-center py-8 space-y-4">
            <div className="w-16 h-16 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto">
              <CheckCircle2 className="w-10 h-10" />
            </div>

            <h3 className="text-2xl font-bold text-[#0B2942]">
              {lang === 'en' ? 'Consultation Request Received!' : 'Permintaan Konsultasi Diterima!'}
            </h3>

            <p className="text-xs sm:text-sm text-slate-600 max-w-md mx-auto leading-relaxed">
              {lang === 'en' 
                ? 'Our legal and immigration advisor will review your profile and reach out via WhatsApp/Email within 15-30 minutes.'
                : 'Konsultan hukum dan imigrasi kami akan memeriksa data Anda dan menghubungi via WhatsApp/Email dalam 15-30 menit.'}
            </p>

            <div className="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
              <a
                href={generateWhatsAppMessage()}
                target="_blank"
                rel="noopener noreferrer"
                className="w-full sm:w-auto px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold text-xs uppercase tracking-wider flex items-center justify-center gap-2 hover:bg-emerald-700 shadow"
              >
                <MessageCircle className="w-4 h-4" />
                <span>{lang === 'en' ? 'Open Directly in WhatsApp' : 'Buka Langsung di WhatsApp'}</span>
              </a>

              <button
                onClick={onClose}
                className="w-full sm:w-auto px-6 py-3 rounded-xl bg-slate-100 text-slate-700 font-semibold text-xs hover:bg-slate-200"
              >
                {lang === 'en' ? 'Done' : 'Selesai'}
              </button>
            </div>
          </div>
        ) : (
          <div>
            <div className="mb-6">
              <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#176B9C]/10 text-[#176B9C] text-xs font-bold uppercase mb-2">
                <ShieldCheck className="w-3.5 h-3.5" />
                <span>OneCoreVisa Legal Assessment</span>
              </div>
              <h3 className="text-2xl font-extrabold text-[#0B2942]">
                {lang === 'en' ? 'Free Legal & Visa Consultation' : 'Konsultasi Gratis Legal & Visa'}
              </h3>
              <p className="text-xs text-slate-500 mt-1">
                {lang === 'en'
                  ? 'Connect with our accredited in-house team in Jakarta & Bali. 100% confidential under NDA.'
                  : 'Terhubung langsung dengan tim hukum berlisensi kami di Jakarta & Bali. 100% rahasia.'}
              </p>
            </div>

            <form onSubmit={handleSubmit} className="space-y-4 text-xs">
              
              {/* Full Name & Nationality */}
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label className="block font-semibold text-slate-700 mb-1">
                    {lang === 'en' ? 'Full Name' : 'Nama Lengkap'} *
                  </label>
                  <div className="relative">
                    <User className="w-4 h-4 text-slate-400 absolute left-3 top-3" />
                    <input
                      type="text"
                      name="name"
                      required
                      placeholder={lang === 'en' ? 'e.g. Michael Smith' : 'Nama lengkap Anda'}
                      value={formData.name}
                      onChange={handleChange}
                      className="w-full pl-9 pr-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#176B9C] bg-slate-50 focus:bg-white text-slate-800 font-medium"
                    />
                  </div>
                </div>

                <div>
                  <label className="block font-semibold text-slate-700 mb-1">
                    {lang === 'en' ? 'Nationality / Citizenship' : 'Kewarganegaraan'} *
                  </label>
                  <div className="relative">
                    <Globe className="w-4 h-4 text-slate-400 absolute left-3 top-3" />
                    <input
                      type="text"
                      name="nationality"
                      required
                      placeholder={lang === 'en' ? 'e.g. United Kingdom, USA, Australia...' : 'Contoh: Australia, Jerman, Indonesia...'}
                      value={formData.nationality}
                      onChange={handleChange}
                      className="w-full pl-9 pr-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#176B9C] bg-slate-50 focus:bg-white text-slate-800 font-medium"
                    />
                  </div>
                </div>
              </div>

              {/* WhatsApp & Email */}
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label className="block font-semibold text-slate-700 mb-1">
                    WhatsApp Number *
                  </label>
                  <div className="relative">
                    <Phone className="w-4 h-4 text-slate-400 absolute left-3 top-3" />
                    <input
                      type="tel"
                      name="whatsapp"
                      required
                      placeholder="+62 812-xxxx / +1 xxx"
                      value={formData.whatsapp}
                      onChange={handleChange}
                      className="w-full pl-9 pr-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#176B9C] bg-slate-50 focus:bg-white text-slate-800 font-medium"
                    />
                  </div>
                </div>

                <div>
                  <label className="block font-semibold text-slate-700 mb-1">
                    Email Address
                  </label>
                  <div className="relative">
                    <Mail className="w-4 h-4 text-slate-400 absolute left-3 top-3" />
                    <input
                      type="email"
                      name="email"
                      placeholder="name@company.com"
                      value={formData.email}
                      onChange={handleChange}
                      className="w-full pl-9 pr-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#176B9C] bg-slate-50 focus:bg-white text-slate-800 font-medium"
                    />
                  </div>
                </div>
              </div>

              {/* Service of Interest */}
              <div>
                <label className="block font-semibold text-slate-700 mb-1">
                  {lang === 'en' ? 'Service or Visa Preference' : 'Layanan atau Preferensi Visa'}
                </label>
                <select
                  name="service"
                  value={formData.service}
                  onChange={handleChange}
                  className="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#176B9C] bg-slate-50 focus:bg-white text-slate-800 font-medium"
                >
                  <option value="">
                    {lang === 'en' ? '-- Select a service or discuss open options --' : '-- Pilih layanan atau konsultasi terbuka --'}
                  </option>
                  {servicesCatalog.map((svc) => (
                    <option key={svc.id} value={lang === 'en' ? svc.titleEn : svc.titleId}>
                      {svc.code} - {lang === 'en' ? svc.titleEn : svc.titleId}
                    </option>
                  ))}
                  <option value="General Immigration Advice">General Immigration Advisory</option>
                  <option value="PT PMA Custom Advisory">PT PMA Custom Corporate Setup</option>
                </select>
              </div>

              {/* Current Location */}
              <div>
                <label className="block font-semibold text-slate-700 mb-1">
                  {lang === 'en' ? 'Current Physical Location' : 'Lokasi Saat Ini'}
                </label>
                <div className="grid grid-cols-2 gap-2">
                  {[
                    'Currently in Indonesia (Bali/Jakarta)',
                    'Currently Abroad (Planning to enter)'
                  ].map((loc, lIdx) => (
                    <button
                      type="button"
                      key={lIdx}
                      onClick={() => setFormData(prev => ({ ...prev, location: loc }))}
                      className={`p-2.5 rounded-xl text-left border transition-all ${
                        formData.location === loc
                          ? 'border-[#176B9C] bg-[#EBF3F8] text-[#0B2942] font-bold'
                          : 'border-slate-200 text-slate-600 hover:bg-slate-50'
                      }`}
                    >
                      {loc}
                    </button>
                  ))}
                </div>
              </div>

              {/* Notes */}
              <div>
                <label className="block font-semibold text-slate-700 mb-1">
                  {lang === 'en' ? 'Additional Questions / Details' : 'Pertanyaan Tambahan / Catatan'}
                </label>
                <textarea
                  name="notes"
                  rows={2}
                  placeholder={lang === 'en' ? 'Share your timeline, questions, or specific requirements...' : 'Ceritakan target waktu atau kebutuhan khusus Anda...'}
                  value={formData.notes}
                  onChange={handleChange}
                  className="w-full p-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-[#176B9C] bg-slate-50 focus:bg-white text-slate-800"
                ></textarea>
              </div>

              {/* Form Buttons */}
              <div className="pt-2 flex flex-col sm:flex-row items-center gap-3">
                <button
                  type="submit"
                  className="w-full sm:flex-1 py-3 px-6 rounded-xl bg-gradient-to-r from-[#176B9C] to-[#2087C2] text-white font-bold text-xs uppercase tracking-wider shadow-md hover:brightness-110 active:scale-95 transition-all flex items-center justify-center gap-2"
                >
                  <Send className="w-4 h-4" />
                  <span>{lang === 'en' ? 'Submit Inquiry' : 'Kirim Permintaan'}</span>
                </button>

                <a
                  href={generateWhatsAppMessage()}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="w-full sm:w-auto py-3 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider shadow-md flex items-center justify-center gap-2 transition-all whitespace-nowrap"
                >
                  <MessageCircle className="w-4 h-4" />
                  <span>{lang === 'en' ? 'Instant WhatsApp' : 'Chat WhatsApp'}</span>
                </a>
              </div>

              <div className="text-center pt-2">
                <span className="text-[10px] text-slate-400 flex items-center justify-center gap-1">
                  <ShieldCheck className="w-3.5 h-3.5 text-emerald-500" />
                  <span>Your information is strictly protected under Indonesian Attorney-Client Privilege.</span>
                </span>
              </div>

            </form>
          </div>
        )}

      </div>
    </div>
  );
}
