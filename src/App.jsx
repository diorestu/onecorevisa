import React, { useState } from 'react';
import Navbar from './components/Navbar';
import Hero from './components/Hero';
import PreferenceFinder from './components/PreferenceFinder';
import AboutUs from './components/AboutUs';
import OurService from './components/OurService';
import OurProcess from './components/OurProcess';
import TestimonialsFAQ from './components/TestimonialsFAQ';
import ConsultationModal from './components/ConsultationModal';
import WhatsAppFloating from './components/WhatsAppFloating';
import Footer from './components/Footer';
import { contentData } from './data/contentData';

export default function App() {
  const [lang, setLang] = useState('en');
  const [searchQuery, setSearchQuery] = useState('');
  const [isConsultationOpen, setIsConsultationOpen] = useState(false);
  const [selectedService, setSelectedService] = useState(null);

  // Quick search handler from Hero or other sections
  const handleQuickSearch = (term) => {
    setSearchQuery(term);
    const el = document.getElementById('preference');
    if (el) {
      el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  // Open modal with specific pre-selected service
  const handleSelectService = (service) => {
    setSelectedService(service);
    setIsConsultationOpen(true);
  };

  // Open general consultation modal
  const handleOpenConsultation = () => {
    setSelectedService(null);
    setIsConsultationOpen(true);
  };

  return (
    <div className="min-h-screen bg-slate-50 flex flex-col font-sans text-slate-800">
      {/* Top Navbar */}
      <Navbar 
        lang={lang} 
        setLang={setLang} 
        content={contentData} 
        onOpenConsultation={handleOpenConsultation} 
      />

      {/* Main Content Area */}
      <main className="flex-grow">
        {/* Section 1: ONECORE VISA (One step solution) */}
        <Hero 
          lang={lang} 
          content={contentData} 
          onOpenConsultation={handleOpenConsultation}
          onQuickSearch={handleQuickSearch}
        />

        {/* Section 2: Check which your preference (search kolom) */}
        <PreferenceFinder 
          lang={lang} 
          content={contentData} 
          searchQuery={searchQuery}
          setSearchQuery={setSearchQuery}
          onSelectService={handleSelectService}
        />

        {/* Section 3: About us */}
        <AboutUs 
          lang={lang} 
          content={contentData} 
          onOpenConsultation={handleOpenConsultation}
        />

        {/* Section 4: Our service */}
        <OurService 
          lang={lang} 
          content={contentData} 
          onSelectService={handleSelectService}
        />

        {/* Section 5: Our process */}
        <OurProcess 
          lang={lang} 
          content={contentData} 
          onOpenConsultation={handleOpenConsultation}
        />

        {/* Client Reviews, FAQ & Pre-footer CTA */}
        <TestimonialsFAQ 
          lang={lang} 
          content={contentData} 
          onOpenConsultation={handleOpenConsultation}
        />
      </main>

      {/* Footer */}
      <Footer 
        lang={lang} 
        content={contentData} 
        onOpenConsultation={handleOpenConsultation}
      />

      {/* Floating WhatsApp Action Button */}
      <WhatsAppFloating lang={lang} />

      {/* Interactive Consultation / Lead Modal */}
      <ConsultationModal 
        isOpen={isConsultationOpen}
        onClose={() => setIsConsultationOpen(false)}
        selectedService={selectedService}
        lang={lang}
      />
    </div>
  );
}
