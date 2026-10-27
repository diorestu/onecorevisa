<?php

// Source PDF rows are recorded where available.
return [
    'voa-b1' => ['idr' => 1000000],
    'c1-tourist-visa' => ['idr' => 3580000, 'source_rows' => [15]],
    'c2-business-visa' => ['idr' => 4200000, 'source_rows' => [16]],
    'c5-c5a-journalism-content-creator-visa' => ['idr' => 5875000, 'marker' => '*'],
    'c13-join-vessel-visa' => ['idr' => 5875000],
    'c14-filming-visa' => ['idr' => 5875000],
    'c12-pre-investment-visa' => ['idr' => 5400000, 'source_rows' => [12]],
    'c6-social-cultural-visa' => ['idr' => 5875000, 'source_rows' => [17]],
    'c7-arts-music-visa' => ['idr' => 6275000],
    'multiple-entry-d1-d2' => ['idr' => 7425000, 'basis' => ['D1 Tourist, 1 year', 'D1 Tourist, 1 tahun'], 'source_rows' => [28]],
    'voa-extension' => ['idr' => 1000000, 'source_rows' => [14]],
    'multiple-entry-extension' => ['idr' => 2430000, 'source_rows' => [30]],
    'working-kitas-extension' => [
        'idr' => 16000000, 'usd' => 1200, 'basis' => ['1 year, including IMTA (Work Permit) supplement', '1 tahun, termasuk tambahan IMTA (Izin Kerja)'],
        'options' => [
            ['idr' => 16000000, 'usd' => 1200, 'label' => ['1 Year', '1 Tahun'], 'note' => ['USD 1,200 for IMTA (Work Permit)', 'USD 1,200 untuk IMTA (Izin Kerja)']],
            ['idr' => 25000000, 'label' => ['2 Years', '2 Tahun']],
        ],
    ],
    'investor-kitas-extension' => [
        'idr' => 18900000, 'basis' => ['1-year option', 'Pilihan 1 tahun'],
        'options' => [
            ['idr' => 18900000, 'label' => ['1 Year', '1 Tahun']],
            ['idr' => 23000000, 'label' => ['2 Years', '2 Tahun']],
        ],
    ],
    'investor-kitas-e28a' => [
        'idr' => 19000000,
        'options' => [
            ['idr' => 19000000, 'label' => ['1 Year', '1 Tahun']],
            ['idr' => 25000000, 'label' => ['2 Years', '2 Tahun']],
        ],
    ],
    'working-kitas-e23' => [
        'idr' => 18000000, 'usd' => 600,
        'options' => [
            ['idr' => 18000000, 'usd' => 600, 'label' => ['6 Months', '6 Bulan']],
            ['idr' => 30000000, 'usd' => 1200, 'label' => ['1 Year', '1 Tahun']],
            ['idr' => 33000000, 'usd' => 2400, 'label' => ['2 Years', '2 Tahun']],
        ],
    ],
    'digital-nomad-e33g' => ['idr' => 17500000, 'basis' => ['1-year option', 'Pilihan 1 tahun'], 'source_rows' => [35]],
    'retirement-kitas-e33e' => ['idr' => 20000000, 'source_rows' => [10, 23]],
    'dependent-kitas-e31' => [
        'idr' => 20000000,
        'options' => [
            ['idr' => 20000000, 'label' => ['1 Year', '1 Tahun']],
            ['idr' => 25000000, 'label' => ['2 Years', '2 Tahun']],
        ],
    ],
    'spouse-kitas' => [
        'idr' => 20000000,
        'options' => [
            ['idr' => 20000000, 'label' => ['1 Year', '1 Tahun']],
            ['idr' => 25000000, 'label' => ['2 Years', '2 Tahun']],
        ],
    ],
    'student-visa-e30a' => ['idr' => 17500000],
    'investor-kitap' => ['idr' => 67000000, 'source_rows' => [24]],
    'family-kitap' => ['idr' => 53000000, 'source_rows' => [25]],
    'retirement-kitap' => ['idr' => 60000000, 'source_rows' => [26]],
    'pma-company' => ['idr' => 25000000, 'source_rows' => [46]],
    'cv-establishment' => ['idr' => 10000000],
    'pt-local-hospitality-setup' => ['idr' => 20000000],
    'pt-perorangan' => ['idr' => 5000000],
    'nib-oss-process' => ['idr' => 4000000],
    'oss-account-assistance' => ['idr' => 1500000],
    'pt-local-company' => ['idr' => 18000000, 'source_rows' => [48]],
];
