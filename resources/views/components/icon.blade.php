@props(['name' => 'chat'])
<svg {{ $attributes }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
@switch($name)
    @case('plane')<path d="m22 2-7 20-4-9-9-4 20-7ZM11 13 22 2"/>@break
    @case('briefcase')<rect x="3" y="7" width="18" height="14" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 12a20 20 0 0 0 18 0M12 11v3"/>@break
    @case('id-card')<rect x="3" y="5" width="18" height="14" rx="2"/><circle cx="8" cy="10" r="2"/><path d="M5 16c0-3 6-3 6 0m3-6h4m-4 4h4"/>@break
    @case('sun')<circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M2 12h2m16 0h2M5 5l1.5 1.5m11 11L19 19M5 19l1.5-1.5m11-11L19 5"/>@break
    @case('users')<circle cx="9" cy="8" r="3"/><path d="M3 21v-2a6 6 0 0 1 12 0v2m2-16a3 3 0 0 1 0 6m1 4a5 5 0 0 1 3 4v2"/>@break
    @case('book')<path d="M12 5c-3-2-7-2-10-1v15c3-1 7-1 10 1 3-2 7-2 10-1V4c-3-1-7-1-10 1Zm0 0v15"/>@break
    @case('badge')<circle cx="12" cy="8" r="5"/><path d="m8 12-1 9 5-3 5 3-1-9"/>@break
    @case('music')<path d="M9 18V5l12-3v13M9 9l12-3"/><ellipse cx="6" cy="18" rx="3" ry="3"/><ellipse cx="18" cy="15" rx="3" ry="3"/>@break
    @case('home')<path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V10Zm6 11v-8h6v8"/>@break
    @case('star')<path d="m12 3 2.8 5.7 6.3.9-4.6 4.5 1.1 6.3-5.6-3-5.6 3 1.1-6.3L3 9.6l6.2-.9L12 3Z"/>@break
    @case('sparkles')<path d="m12 3 2.6 6.4L21 12l-6.4 2.6L12 21l-2.6-6.4L3 12l6.4-2.6L12 3Zm8-1v4m-2-2h4M4 18v4m-2-2h4"/>@break
    @case('globe')<circle cx="12" cy="12" r="9"/><ellipse cx="12" cy="12" rx="4" ry="9"/><path d="M3 12h18"/>@break
    @case('building')<rect x="5" y="3" width="14" height="18" rx="1"/><path d="M9 7h1m4 0h1M9 11h1m4 0h1M9 21v-6h6v6"/>@break
    @case('passport')<rect x="5" y="2" width="15" height="20" rx="2"/><path d="M3 6h2m-2 6h2m-2 6h2m4 0h7"/><circle cx="12.5" cy="9" r="4"/><path d="M8.5 9h8m-4-4a8 8 0 0 1 0 8 8 8 0 0 1 0-8"/>@break
    @case('arrow-right')<path d="M4 12h16m-6-6 6 6-6 6"/>@break
    @default<path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8v.5Z"/>
@endswitch
</svg>
