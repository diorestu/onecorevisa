import React, { useState, useMemo } from 'react';
import { 
  Search, 
  X, 
  Sparkles, 
  Clock, 
  Calendar, 
  CheckCircle2, 
  ArrowRight, 
  ChevronRight, 
  SlidersHorizontal,
  Info,
  Shield,
  HelpCircle,
  FileText
} from 'lucide-react';
import { servicesCatalog } from '../data/contentData';

export default function PreferenceFinder({ 
  lang, 
  content, 
  searchQuery, 
  setSearchQuery, 
  onSelectService 
}) {
  const t = content[lang].preferenceFinder;
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [showWizard, setShowWizard] = useState(false);
  const [expandedChecklistId, setExpandedChecklistId] = useState(null);

  // Wizard state
  const [wizardPurpose, setWizardPurpose] = useState('');
  const [wizardDuration, setWizardDuration] = useState('');

  // Handle category change
  const handleCategoryChange = (cat) => {
    setSelectedCategory(cat);
  };

  // Filter items based on query and category
  const filteredServices = useMemo(() => {
    return servicesCatalog.filter((item) => {
      // Category filter
      const matchesCategory = 
        selectedCategory === 'all' || 
        item.category === selectedCategory;

      if (!matchesCategory) return false;

      // Text search filter
      if (!searchQuery.trim()) return true;

      const q = searchQuery.toLowerCase().trim();
      const title = (lang === 'en' ? item.titleEn : item.titleId).toLowerCase();
      const desc = (lang === 'en' ? item.shortDescEn : item.shortDescId).toLowerCase();
      const code = item.code.toLowerCase();
      const whoFor = (lang === 'en' ? item.whoForEn : item.whoForId).toLowerCase();
      const tag = item.tag.toLowerCase();

      return (
        title.includes(q) ||
        desc.includes(q) ||
        code.includes(q) ||
        whoFor.includes(q) ||
        tag.includes(q)
      );
    });
  }, [searchQuery, selectedCategory, lang]);

  // Recommendation engine for wizard
  const wizardRecommendation = useMemo(() => {
    if (!wizardPurpose && !wizardDuration) return null;

    if (wizardPurpose === 'nomad') return 'remote-worker-visa';
    if (wizardPurpose === 'investor' || wizardPurpose === 'business-owner') {
      if (wizardDuration === 'long' || wizardDuration === 'permanent') return 'investor-kitas';
      return 'pt-pma-setup';
    }
    if (wizardPurpose === 'working') return 'working-kitas';
    if (wizardPurpose === 'spouse') return 'spouse-family-kitas';
    if (wizardPurpose === 'retire') return 'retirement-kitas';
    if (wizardPurpose === 'tourist') {
      if (wizardDuration === 'short') return 'evoa-express';
      return 'b211a-visit-visa';
    }
    return null;
  }, [wizardPurpose, wizardDuration]);

  const recommendedItem = useMemo(() => {
    if (!wizardRecommendation) return null;
    return servicesCatalog.find(s => s.id === wizardRecommendation);
  }, [wizardRecommendation]);

  const toggleChecklist = (id) => {
    setExpandedChecklistId(prev => prev === id ? null : id);
  };

  return (
    <section id="preference" className="py-20 bg-slate-50 relative scroll-mt-12">
      <div className="max-w-7xl mx-auto px-4 sm:px-6">
        
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto space-y-4 mb-12">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#176B9C]/10 border border-[#176B9C]/30 text-[#176B9C] text-xs font-bold tracking-wide uppercase">
            <Sparkles className="w-3.5 h-3.5 text-[#176B9C]" />
            <span>{t.sectionBadge}</span>
          </div>

          <h2 className="text-3xl sm:text-4xl font-extrabold text-[#0B2942] tracking-tight">
            {t.title}
          </h2>

          <p className="text-slate-600 text-sm sm:text-base leading-relaxed">
            {t.subtitle}
          </p>
        </div>

        {/* Search Kolom (Primary Search & Filter Bar) */}
        <div className="max-w-4xl mx-auto mb-10">
          <div className="bg-white rounded-2xl p-4 sm:p-5 shadow-xl shadow-slate-200/70 border border-slate-200/80 transition-all hover:border-[#176B9C]/40">
            
            {/* Search Input Bar */}
            <div className="relative flex items-center">
              <div className="absolute left-4 text-[#176B9C] pointer-events-none">
                <Search className="w-6 h-6" />
              </div>
              <input
                type="text"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                placeholder={t.searchPlaceholder}
                className="w-full pl-13 pr-12 py-3.5 sm:py-4 text-sm sm:text-base bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#176B9C] focus:border-transparent text-[#0B2942] placeholder:text-slate-400 font-medium transition-all"
              />
              {searchQuery && (
                <button
                  onClick={() => setSearchQuery('')}
                  className="absolute right-4 p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-200 rounded-lg transition-colors"
                  aria-label="Clear search"
                >
                  <X className="w-4 h-4" />
                </button>
              )}
            </div>

            {/* Popular Search Suggestions / Quick Pills */}
            <div className="mt-3.5 flex flex-wrap items-center gap-2 text-xs">
              <span className="text-slate-500 font-semibold flex items-center gap-1">
                <span>Popular:</span>
              </span>
              {t.popularKeywords.map((kw, idx) => (
                <button
                  key={idx}
                  onClick={() => setSearchQuery(kw)}
                  className={`px-2.5 py-1 rounded-lg border transition-all text-[11px] font-medium ${
                    searchQuery === kw
                      ? 'bg-[#176B9C] text-white border-[#176B9C]'
                      : 'bg-slate-100 text-slate-700 border-slate-200 hover:bg-[#6EA8C8]/20 hover:border-[#6EA8C8] hover:text-[#0B2942]'
                  }`}
                >
                  {kw}
                </button>
              ))}
            </div>

            {/* Category Filter Tabs */}
            <div className="mt-4 pt-4 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
              <div className="flex flex-wrap items-center gap-1.5">
                {[
                  { key: 'all', label: t.tabs.all },
                  { key: 'visas', label: t.tabs.visas },
                  { key: 'kitas', label: t.tabs.kitas },
                  { key: 'business', label: t.tabs.business },
                  { key: 'legal', label: t.tabs.legal }
                ].map((tab) => (
                  <button
                    key={tab.key}
                    onClick={() => handleCategoryChange(tab.key)}
                    className={`px-3 py-1.5 rounded-lg text-xs font-semibold transition-all ${
                      selectedCategory === tab.key
                        ? 'bg-[#0B2942] text-white shadow-sm'
                        : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'
                    }`}
                  >
                    {tab.label}
                  </button>
                ))}
              </div>

              {/* Toggle 2-Click Wizard */}
              <button
                onClick={() => setShowWizard(!showWizard)}
                className="text-xs font-semibold text-[#176B9C] hover:text-[#0B2942] flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#6EA8C8]/15 hover:bg-[#6EA8C8]/30 transition-all ml-auto"
              >
                <HelpCircle className="w-3.5 h-3.5" />
                <span>{showWizard ? 'Hide Match Wizard' : t.wizardPrompt}</span>
              </button>
            </div>

          </div>
        </div>

        {/* Interactive Guided Recommendation Wizard (Expandable) */}
        {showWizard && (
          <div className="max-w-4xl mx-auto mb-12 p-6 rounded-2xl bg-gradient-to-r from-[#0B2942] to-[#123C5E] text-white shadow-xl animate-fadeIn border border-[#6EA8C8]/40">
            <div className="flex items-center justify-between mb-4">
              <div className="flex items-center gap-2">
                <Sparkles className="w-5 h-5 text-[#6EA8C8]" />
                <h3 className="text-lg font-bold text-white">{t.wizardTitle}</h3>
              </div>
              <button
                onClick={() => {
                  setWizardPurpose('');
                  setWizardDuration('');
                }}
                className="text-xs text-[#6EA8C8] hover:text-white underline"
              >
                {t.wizardReset}
              </button>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              {/* Question 1: Purpose */}
              <div>
                <label className="block text-xs font-semibold text-slate-300 mb-2">
                  {t.wizardQ1}
                </label>
                <div className="grid grid-cols-2 gap-2 text-xs">
                  {[
                    { id: 'tourist', label: 'Holiday & Meetings' },
                    { id: 'nomad', label: 'Remote Nomad (E33G)' },
                    { id: 'investor', label: 'Investor / Founder' },
                    { id: 'working', label: 'Employed Worker' },
                    { id: 'spouse', label: 'Married to Indonesian' },
                    { id: 'retire', label: 'Retirement (55+)' },
                  ].map((p) => (
                    <button
                      key={p.id}
                      onClick={() => setWizardPurpose(p.id)}
                      className={`p-2.5 rounded-lg text-left font-medium transition-all border ${
                        wizardPurpose === p.id
                          ? 'bg-[#176B9C] border-[#6EA8C8] text-white shadow'
                          : 'bg-white/5 border-white/10 text-slate-300 hover:bg-white/10'
                      }`}
                    >
                      {p.label}
                    </button>
                  ))}
                </div>
              </div>

              {/* Question 2: Duration */}
              <div>
                <label className="block text-xs font-semibold text-slate-300 mb-2">
                  {t.wizardQ2}
                </label>
                <div className="grid grid-cols-2 gap-2 text-xs">
                  {[
                    { id: 'short', label: 'Under 60 Days' },
                    { id: 'medium', label: 'Up to 6 Months' },
                    { id: 'long', label: '1 - 2 Years' },
                    { id: 'permanent', label: '5+ Yrs / Permanent' },
                  ].map((d) => (
                    <button
                      key={d.id}
                      onClick={() => setWizardDuration(d.id)}
                      className={`p-2.5 rounded-lg text-left font-medium transition-all border ${
                        wizardDuration === d.id
                          ? 'bg-[#176B9C] border-[#6EA8C8] text-white shadow'
                          : 'bg-white/5 border-white/10 text-slate-300 hover:bg-white/10'
                      }`}
                    >
                      {d.label}
                    </button>
                  ))}
                </div>
              </div>
            </div>

            {/* Matched Recommendation Output */}
            {recommendedItem && (
              <div className="mt-6 pt-5 border-t border-white/15 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white/5 p-4 rounded-xl">
                <div>
                  <span className="text-xs uppercase tracking-wider text-emerald-400 font-bold block">
                    Recommended Solution For You:
                  </span>
                  <h4 className="text-base font-bold text-white">
                    {lang === 'en' ? recommendedItem.titleEn : recommendedItem.titleId}
                  </h4>
                  <p className="text-xs text-slate-300">
                    {lang === 'en' ? recommendedItem.shortDescEn : recommendedItem.shortDescId}
                  </p>
                </div>
                <button
                  onClick={() => onSelectService(recommendedItem)}
                  className="px-5 py-2.5 rounded-lg bg-[#6EA8C8] hover:bg-[#8ec2df] text-[#0B2942] font-bold text-xs uppercase tracking-wider shadow whitespace-nowrap"
                >
                  {t.applyBtn}
                </button>
              </div>
            )}
          </div>
        )}

        {/* Results Header Meta */}
        <div className="flex items-center justify-between text-xs text-slate-500 mb-6 px-1">
          <span>
            {t.filterResultsCount.replace('{count}', filteredServices.length)}
          </span>
          {searchQuery && (
            <span className="text-[#176B9C] font-semibold">
              Filter: "{searchQuery}"
            </span>
          )}
        </div>

        {/* Results Catalog Grid */}
        {filteredServices.length === 0 ? (
          <div className="text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300 max-w-lg mx-auto">
            <Info className="w-10 h-10 text-slate-400 mx-auto mb-3" />
            <h3 className="text-base font-bold text-slate-700">No specific match found</h3>
            <p className="text-xs text-slate-500 mt-1 max-w-xs mx-auto">
              Try searching with broader terms or speak directly with our legal consultant for custom cases.
            </p>
            <button
              onClick={() => {
                setSearchQuery('');
                setSelectedCategory('all');
              }}
              className="mt-4 px-4 py-2 rounded-lg bg-[#0B2942] text-white text-xs font-semibold"
            >
              Reset Search & Filters
            </button>
          </div>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {filteredServices.map((service) => {
              const isExpanded = expandedChecklistId === service.id;
              const title = lang === 'en' ? service.titleEn : service.titleId;
              const desc = lang === 'en' ? service.shortDescEn : service.shortDescId;
              const whoFor = lang === 'en' ? service.whoForEn : service.whoForId;

              return (
                <div
                  key={service.id}
                  className="bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-[#176B9C]/50 transition-all duration-300 flex flex-col justify-between overflow-hidden group"
                >
                  {/* Card Header */}
                  <div className="p-6 pb-4">
                    <div className="flex items-start justify-between gap-2 mb-3">
                      <span className="px-2.5 py-1 rounded-md text-[11px] font-mono font-bold bg-[#EBF3F8] text-[#176B9C] border border-[#176B9C]/20">
                        {service.code}
                      </span>
                      <span className="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#0B2942] text-[#6EA8C8]">
                        {service.highlightBadge}
                      </span>
                    </div>

                    <h3 className="text-lg font-bold text-[#0B2942] group-hover:text-[#176B9C] transition-colors leading-snug">
                      {title}
                    </h3>

                    <p className="text-xs text-slate-600 mt-2 line-clamp-3 leading-relaxed">
                      {desc}
                    </p>

                    {/* Meta Timeline & Validity */}
                    <div className="mt-4 pt-3 border-t border-slate-100 grid grid-cols-2 gap-2 text-[11px]">
                      <div className="flex items-center gap-1.5 text-slate-600">
                        <Clock className="w-3.5 h-3.5 text-[#176B9C] shrink-0" />
                        <div>
                          <span className="text-[10px] text-slate-400 block font-normal">Processing:</span>
                          <span className="font-semibold text-slate-800">{service.processingTime}</span>
                        </div>
                      </div>
                      <div className="flex items-center gap-1.5 text-slate-600">
                        <Calendar className="w-3.5 h-3.5 text-[#176B9C] shrink-0" />
                        <div>
                          <span className="text-[10px] text-slate-400 block font-normal">Validity:</span>
                          <span className="font-semibold text-slate-800">{service.duration}</span>
                        </div>
                      </div>
                    </div>

                    {/* Who is this for */}
                    <div className="mt-3 bg-slate-50 rounded-lg p-2.5 text-[11px] text-slate-600 border border-slate-100">
                      <span className="font-bold text-[#0B2942] block text-[10px] uppercase">
                        {t.whoIsThisFor}
                      </span>
                      <span className="line-clamp-2">{whoFor}</span>
                    </div>

                    {/* Expandable Checklist Section */}
                    {isExpanded && (
                      <div className="mt-4 pt-3 border-t border-slate-200 animate-fadeIn space-y-2">
                        <h4 className="text-xs font-bold text-[#0B2942] flex items-center gap-1">
                          <FileText className="w-3.5 h-3.5 text-[#176B9C]" />
                          <span>Required Documents:</span>
                        </h4>
                        <ul className="text-[11px] text-slate-600 space-y-1.5 pl-1">
                          {service.requirements.map((req, rIdx) => (
                            <li key={rIdx} className="flex items-start gap-1.5">
                              <span className="text-[#176B9C] font-bold mt-0.5">•</span>
                              <span>{req}</span>
                            </li>
                          ))}
                        </ul>

                        <h4 className="text-xs font-bold text-[#0B2942] pt-2 flex items-center gap-1">
                          <CheckCircle2 className="w-3.5 h-3.5 text-emerald-600" />
                          <span>Key Advantages:</span>
                        </h4>
                        <ul className="text-[11px] text-slate-600 space-y-1.5 pl-1">
                          {service.perks.map((prk, pIdx) => (
                            <li key={pIdx} className="flex items-start gap-1.5">
                              <span className="text-emerald-500 font-bold mt-0.5">✓</span>
                              <span>{prk}</span>
                            </li>
                          ))}
                        </ul>
                      </div>
                    )}
                  </div>

                  {/* Card Footer Actions */}
                  <div className="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between gap-2">
                    <button
                      onClick={() => toggleChecklist(service.id)}
                      className="text-xs font-semibold text-[#176B9C] hover:text-[#0B2942] underline underline-offset-2 flex items-center gap-1"
                    >
                      {isExpanded ? 'Hide Checklist' : t.viewDetailsBtn}
                    </button>

                    <button
                      onClick={() => onSelectService(service)}
                      className="px-4 py-2 rounded-lg bg-gradient-to-r from-[#176B9C] to-[#2087C2] text-white text-xs font-semibold shadow hover:brightness-110 active:scale-95 transition-all flex items-center gap-1"
                    >
                      <span>{t.applyBtn}</span>
                      <ArrowRight className="w-3.5 h-3.5" />
                    </button>
                  </div>
                </div>
              );
            })}
          </div>
        )}

      </div>
    </section>
  );
}
