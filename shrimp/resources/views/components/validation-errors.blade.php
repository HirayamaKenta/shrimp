@props(['errors'])

@if ($errors->any())
<div {{ $attributes }}>
  <div class="font-medium text-red-600">
    {{ __('Whoops! Something went wrong.') }}
  </div>

  <ul class="mt-3 list-disc list-inside text-sm text-red-600">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach

    {{-- ↓画像ファイルに対するメッセージ --}}
    @if (empty($errors->first("image")))
    <li>画像ファイルがあれば、再度、選択してください。
    </li>
    @endif
    {{-- ↑画像ファイルに対するメッセージ --}}
  </ul>
</div>
@endif
