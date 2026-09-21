@extends('layouts.app')

@section('content')
    <div class="flex flex-col lg:flex-row min-h-screen bg-zinc-100">
        <x-dashboard-sidebar />

        <main class="flex-1 px-6 py-10 pt-24">
            <div class="mx-auto max-w-3xl rounded-2xl bg-white p-6 shadow">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-semibold text-zinc-900">Edit Berita</h1>
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-zinc-600 hover:text-zinc-900">
                        &larr; Kembali
                    </a>
                </div>

                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-50 p-4 border border-red-200">
                        <ul class="list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $news->title) }}"
                            class="w-full rounded-lg border border-zinc-200 px-3 py-2 focus:border-red-500 focus:ring-red-200"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Kategori</label>
                        <input list="categories" name="category" value="{{ old('category', $news->category) }}" placeholder="Pilih atau ketik kategori baru"
                            class="w-full rounded-lg border border-zinc-200 px-3 py-2 focus:border-red-500 focus:ring-red-200"
                            required>
                        <datalist id="categories">
                            <option value="Politik"></option>
                            <option value="Nasional"></option>
                            <option value="Teknologi"></option>
                        </datalist>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Gambar</label>
                        @if($news->image)
                            <div class="mb-3">
                                <span class="block text-xs text-zinc-500 mb-1">Gambar saat ini:</span>
                                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="h-32 w-48 object-cover rounded-lg border border-zinc-200">
                            </div>
                        @endif
                        <input type="file" name="image"
                            class="w-full rounded-lg border border-zinc-200 px-3 py-2 file:mr-4 file:rounded-md file:border-0 file:bg-zinc-900 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-zinc-800">
                        <span class="block text-xs text-zinc-400 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Isi Berita</label>
                        <textarea name="content" rows="6"
                            class="w-full rounded-lg border border-zinc-200 px-3 py-2 focus:border-red-500 focus:ring-red-200"
                            required>{{ old('content', $news->content) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <a href="{{ route('dashboard') }}"
                            class="rounded-lg border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-600 hover:bg-zinc-50">
                            Batal
                        </a>
                        <button type="submit"
                            class="rounded-lg bg-[#b3181f] px-4 py-2 text-sm font-semibold text-white shadow hover:bg-[#99141b]">
                            Update Berita
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection
