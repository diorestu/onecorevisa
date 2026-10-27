        <aside class="service-consultation-panel" aria-labelledby="service-enquiry-title">
            <div class="service-consultation-card">
                <p class="section-label">One Step Solution</p>
                <h2 id="service-enquiry-title">{{ $t('Plan Your Application', 'Rencanakan Pengajuan Anda') }}</h2>
                <p class="service-consultation-copy">{{ $serviceLine['category'] === 'company' ? $t('Tell us about your business, the support you need, and your timeline.', 'Ceritakan bisnis Anda, bantuan yang dibutuhkan, dan rencana waktunya.') : $t('Share your nationality, current location, and intended stay.', 'Sampaikan kewarganegaraan, lokasi saat ini, dan rencana masa tinggal Anda.') }}</p>
                <div class="service-quote-info">
                    <p>{{ $t('Service Fee', 'Biaya Layanan') }}</p>
                    @if($servicePricing)
                        @if(!empty($servicePricing['options']))
                            <dl class="service-price-options">
                                @foreach($servicePricing['options'] as $option)
                                    <div>
                                        <dt>{{ $t(...$option['label']) }}</dt>
                                        <dd>
                                            <p class="service-starting-price">Rp{{ number_format($option['idr'], 0, ',', '.') }}@if(isset($option['usd']))<span> + USD {{ number_format($option['usd'], 0, '.', ',') }}</span>@endif</p>
                                            @if(isset($option['note']))<p class="service-price-basis">{{ $t(...$option['note']) }}</p>@endif
                                        </dd>
                                    </div>
                                @endforeach
                            </dl>
                        @else
                            <p class="service-starting-label">Start from</p>
                            <p class="service-starting-price">Rp{{ number_format($servicePricing['idr'], 0, ',', '.') }}{{ $servicePricing['marker'] ?? '' }}@if(isset($servicePricing['usd']))<span> + USD {{ number_format($servicePricing['usd'], 0, '.', ',') }}</span>@endif</p>
                            @if(isset($servicePricing['basis']))<p class="service-price-basis">{{ $t(...$servicePricing['basis']) }}</p>@endif
                        @endif
                    @else
                        <p>{{ $t('Quoted For Your Application', 'Penawaran Sesuai Pengajuan Anda') }}</p>
                    @endif
                </div>
                <button class="button primary" type="button" data-consultation="{{ $serviceLine['title'] }}"><x-icon name="chat" class="cta-icon" />{{ $t('Request A Quote', 'Minta Penawaran') }}</button>
                <p class="service-consultation-note">{{ $t('We will confirm eligibility, requirements, fees, and processing estimates before you proceed.', 'Kami akan mengonfirmasi kelayakan, persyaratan, biaya, dan estimasi waktu proses sebelum Anda melanjutkan.') }}</p>
            </div>
            @if(!empty($serviceLine['documentRequirements']))
            <a class="text-link service-requirements-link" href="#service-documents"><x-icon name="document" class="cta-icon" />{{ $t('View Document Requirements', 'Lihat Persyaratan Dokumen') }}</a>
            @endif
        </aside>
