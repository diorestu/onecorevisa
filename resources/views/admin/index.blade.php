@extends('admin.layout')
@section('actions')
@if(!in_array($module,['copywriting','content']))<a class="btn btn-primary" href="{{ route('admin.cms.create',$module) }}">Tambah {{ $title }}</a>@endif
@endsection
@section('content')
<div class="card">
<div class="card-header"><form class="row g-2 w-100" method="get"><div class="col-md"><label class="form-label visually-hidden" for="q">Cari {{ $title }}</label><input class="form-control" id="q" type="search" name="q" value="{{ request('q') }}" placeholder="Cari {{ strtolower($title) }}"></div>
@if(in_array($module,['articles','services']))
<div class="col-md-auto"><label for="category-filter" class="visually-hidden">Kategori</label><select class="form-select" name="category_id" id="category-filter"><option value="">Semua kategori</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(request('category_id')==$category->id)>{{ $category->title('id') }}</option>@endforeach</select></div>
<div class="col-md-auto"><label for="status-filter" class="visually-hidden">Status</label><select class="form-select" id="status-filter" name="status"><option value="">Semua status</option><option value="draft" @selected(request('status')==='draft')>Draft</option><option value="published" @selected(request('status')==='published')>Published</option></select></div>
@endif
@if($module==='categories')<div class="col-md-auto"><label class="visually-hidden" for="type-filter">Jenis kategori</label><select class="form-select" name="type" id="type-filter"><option value="">Semua jenis</option><option value="article" @selected(request('type')==='article')>Artikel</option><option value="service" @selected(request('type')==='service')>Layanan</option></select></div>@endif
<div class="col-auto"><button class="btn" type="submit">Cari</button></div><div class="col-auto"><a class="btn btn-ghost-secondary" href="{{ route('admin.cms.index',$module) }}">Reset</a></div></form></div>
<div class="table-responsive"><table class="table table-vcenter card-table"><thead><tr><th>Nama / English</th><th>Indonesia</th><th>{{ $module==='categories'?'Jenis':'Status / Bagian' }}</th>@if($module==='categories')<th>Landing page</th>@endif<th>Diperbarui</th><th class="w-1">Aksi</th></tr></thead><tbody>
@forelse($records as $record)
<tr><td><a class="fw-semibold" href="{{ route('admin.cms.edit',[$module,$record->id]) }}">{{ in_array($module,['copywriting','content']) ? $record->label : $record->title('en') }}</a>@if($record->slug)<div class="text-secondary small">{{ $record->slug }}</div>@endif</td>
<td class="cms-list-copy">{{ \Illuminate\Support\Str::limit($module==='copywriting' ? $record->translations['id'] : ($module==='content' ? 'EN / ID' : $record->title('id')),85) }}</td>
<td>@if($record->status)<span class="badge {{ $record->status==='published'?'bg-green-lt':'bg-secondary-lt' }}">{{ $record->status }}</span>@elseif($module==='categories'){{ $record->type==='article'?'Artikel':'Layanan' }} · {{ $record->is_active?'Aktif':'Nonaktif' }}@else<span class="text-secondary">{{ $record->group }}</span>@endif</td>
@if($module==='categories')
@php($locations=$record->is_active?($landingPageLocations[$record->slug]??[]):[])
<td><span class="badge {{ $locations?'bg-green-lt':'bg-secondary-lt' }}">{{ $locations?'Tampil':'Tidak tampil' }}</span><div class="text-secondary small mt-1">{{ $locations?implode(', ',$locations):($record->is_active?'Belum digunakan di landing page':'Kategori nonaktif') }}</div></td>
@endif
<td class="text-secondary small text-nowrap">{{ $record->updated_at->format('d M Y H:i') }}</td><td><a class="btn btn-sm" href="{{ route('admin.cms.edit',[$module,$record->id]) }}">Edit</a></td></tr>
@empty<tr><td colspan="{{ $module==='categories'?6:5 }}"><div class="empty"><p class="empty-title">Belum ada {{ strtolower($title) }}{{ request('q')?' yang sesuai pencarian':'' }}.</p><p class="empty-subtitle text-secondary">{{ in_array($module,['copywriting','content'])?'Impor konten awal dengan perintah cms:import.':'Tambahkan data baru atau ubah filter pencarian.' }}</p></div></td></tr>@endforelse
</tbody></table></div><div class="card-footer">{{ $records->links('pagination::bootstrap-5') }}</div></div>
@endsection
