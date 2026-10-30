@php
    $fieldId='f-'.str_replace(['.','*'],['-','x'],$path);
    $name=collect(explode('.',$path))->reduce(fn($carry,$piece)=>$carry===''?$piece:$carry.'['.$piece.']','');
    $value=old($path,$value);
    $type=$field['type'];
@endphp
@if($type==='object')
<fieldset class="mb-4">@if($field['label'])<legend class="h3 border-bottom pb-2">{{ $field['label'] }}</legend>@endif
@foreach($field['fields'] as $key=>$child)
@include('admin.field',['field'=>$child,'path'=>ltrim($path.'.'.$key,'.'),'value'=>is_array($value)?($value[$key]??null):null])
@endforeach
</fieldset>
@elseif($type==='list')
@php($rowToken='__ROW_'.substr(hash('sha256',$path),0,10).'__')
<fieldset class="mb-4" data-repeater data-path="{{ $path }}" data-token="{{ $rowToken }}" @if(str_ends_with($path,'.included')) data-legal-field @endif data-next="{{ is_array($value) && count($value) ? max(array_map('intval',array_keys($value)))+1 : 0 }}"><legend class="form-label">{{ $field['label'] }}</legend><div data-items>
@foreach(is_array($value)?$value:[] as $index=>$item)
<fieldset class="cms-repeater-item" data-item><legend>Item {{ $loop->iteration }}</legend>@include('admin.field',['field'=>$field['item'],'path'=>$path.'.'.$index,'value'=>$item])<button class="btn btn-sm btn-outline-danger" type="button" data-remove>Hapus item</button></fieldset>
@endforeach
</div><template data-template><fieldset class="cms-repeater-item" data-item><legend>Item baru</legend>@include('admin.field',['field'=>$field['item'],'path'=>$path.'.'.$rowToken,'value'=>null])<button class="btn btn-sm btn-outline-danger" type="button" data-remove>Hapus item</button></fieldset></template><button class="btn btn-sm btn-outline-primary" type="button" data-add>Tambah item</button></fieldset>
@else
<div class="mb-3" @if(in_array($path,['details.group','details.legalIcon'])) data-legal-field @endif @if($type==='markdown') data-markdown @endif>
<label class="form-label" for="{{ $fieldId }}">{{ $field['label'] }} @if($field['required']??false)<span class="text-danger" aria-hidden="true">*</span><span class="visually-hidden">wajib</span>@endif</label>
@if($type==='markdown')
<div class="cms-toolbar" role="group" aria-label="Format artikel"><button class="btn btn-sm" type="button" data-format="bold">Tebal</button><button class="btn btn-sm" type="button" data-format="italic">Miring</button><button class="btn btn-sm" type="button" data-format="heading">Subjudul</button><button class="btn btn-sm" type="button" data-format="list">Daftar</button><button class="btn btn-sm" type="button" data-format="link">Tautan</button></div>
<textarea class="form-control cms-editor @error($path) is-invalid @enderror" name="{{ $name }}" id="{{ $fieldId }}" rows="14" @required($field['required']??false) aria-describedby="{{ $fieldId }}-hint">{{ $value }}</textarea><div class="form-hint" id="{{ $fieldId }}-hint">Gunakan tombol format atau Markdown. HTML mentah tidak ditampilkan. Simpan artikel untuk melihat pratinjau.</div>
@elseif($type==='textarea')
<textarea class="form-control @error($path) is-invalid @enderror" name="{{ $name }}" id="{{ $fieldId }}" rows="3" @required($field['required']??false)>{{ $value }}</textarea>
@elseif(in_array($type,['legal-group','icon']))
<select class="form-select" name="{{ $name }}" id="{{ $fieldId }}">@foreach($type==='legal-group'?['formation'=>'Pendirian dan perizinan','corporate'=>'Korporasi dan bisnis']:\App\Support\CmsForm::icons() as $option=>$label)<option value="{{ $option }}" @selected($value===$option)>{{ $label }}</option>@endforeach</select>
@elseif($type==='image')
<input class="form-control" name="{{ $name }}" id="{{ $fieldId }}" value="{{ $value }}" readonly aria-describedby="{{ $fieldId }}-hint"><div class="form-hint" id="{{ $fieldId }}-hint">Gambar saat ini. Upload gambar baru untuk menggantinya (JPG, PNG, WebP, maksimal 5 MB).</div>
@if($value)<img class="cms-image my-2" src="{{ \App\Support\CmsContent::image($value) }}" alt="Gambar saat ini" loading="lazy">@endif
<label class="form-label mt-2" for="{{ $fieldId }}-upload">Upload {{ strtolower($field['label']) }}</label><input class="form-control" id="{{ $fieldId }}-upload" type="file" name="uploads[{{ str_replace('.','__',$path) }}]" accept="image/jpeg,image/png,image/webp">
@else
<input class="form-control @error($path) is-invalid @enderror" name="{{ $name }}" id="{{ $fieldId }}" type="{{ $type==='number'?'number':'text' }}" value="{{ $value }}" @if($type==='number') min="0" step="0.01" @endif @required($field['required']??false)>
@endif
@error($path)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>
@endif
