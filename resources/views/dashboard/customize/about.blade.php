@extends('layouts.app')

@section('content')
    <div class="flex flex-col lg:flex-row min-h-screen bg-zinc-100">
        <x-dashboard-sidebar />

        <main class="flex-1 px-6 py-10 pt-24">
            <div class="mx-auto max-w-3xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold text-zinc-900">Customize About Us</h1>
                        <p class="text-sm text-zinc-500 mt-1">Kelola dan atur konten tampilan halaman About Us.</p>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-700 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('dashboard.customize.updateAbout') }}" method="POST" class="mt-6 space-y-6">
                    @csrf

                    <!-- Section About Us -->
                    <div class="rounded-2xl bg-white shadow p-6">
                        <h2 class="text-lg font-semibold text-zinc-900 mb-4 pb-2 border-b border-zinc-100">Section About Us
                        </h2>
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-1">Tagline / Sub-Judul</label>
                                <input type="text" name="about_section_tagline"
                                    value="{{ old('about_section_tagline', $settings['about_section_tagline']) }}" required
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-200" />
                                <p class="mt-1 text-xs text-zinc-400">Teks kecil di bagian atas section (Default: About Us)
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-1">Judul Section</label>
                                <input type="text" name="about_section_title"
                                    value="{{ old('about_section_title', $settings['about_section_title']) }}" required
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-200" />
                                <p class="mt-1 text-xs text-zinc-400">Judul utama section About Us</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-1">Isi Deskripsi Konten</label>
                                <textarea name="about_section_description" rows="4" required
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-200">{{ old('about_section_description', $settings['about_section_description']) }}</textarea>
                                <p class="mt-1 text-xs text-zinc-400">Paragraf penjelasan yang akan tampil di halaman About
                                    Us.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section Visi & Misi -->
                    <div class="rounded-2xl bg-white shadow p-6">
                        <h2 class="text-lg font-semibold text-zinc-900 mb-4 pb-2 border-b border-zinc-100">Section Visi &
                            Misi</h2>
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-1">Deskripsi Visi</label>
                                <input type="text" name="visi_section_tagline"
                                    value="{{ old('visi_section_tagline', $settings['visi_section_tagline']) }}" required
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-200" />
                                <p class="mt-1 text-xs text-zinc-400">Teks penjelasan di bawah judul Visi & Misi pada
                                    halaman About Us.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-1">Deskripsi Misi #1</label>
                                <input type="text" name="misi1_section_tagline"
                                    value="{{ old('misi1_section_tagline', $settings['misi1_section_tagline']) }}" required
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-200" />
                                <p class="mt-1 text-xs text-zinc-400">Teks penjelasan di bawah judul Visi & Misi pada
                                    halaman About Us.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-1">Deskripsi Misi #2</label>
                                <input type="text" name="misi2_section_tagline"
                                    value="{{ old('misi2_section_tagline', $settings['misi2_section_tagline']) }}" required
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-200" />
                                <p class="mt-1 text-xs text-zinc-400">Teks penjelasan di bawah judul Visi & Misi pada
                                    halaman About Us.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-1">Deskripsi Misi #3</label>
                                <input type="text" name="misi3_section_tagline"
                                    value="{{ old('misi3_section_tagline', $settings['misi3_section_tagline']) }}" required
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-200" />
                                <p class="mt-1 text-xs text-zinc-400">Teks penjelasan di bawah judul Visi & Misi pada
                                    halaman About Us.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-1">Deskripsi Misi #4</label>
                                <input type="text" name="misi4_section_tagline"
                                    value="{{ old('misi4_section_tagline', $settings['misi4_section_tagline']) }}" required
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-200" />
                                <p class="mt-1 text-xs text-zinc-400">Teks penjelasan di bawah judul Visi & Misi pada
                                    halaman About Us.</p>
                            </div>


                        </div>
                    </div>

                    <div class="flex justify-end pt-2 pb-10">
                        <button type="submit"
                            class="inline-flex items-center rounded-lg bg-[#b3181f] px-6 py-2.5 text-sm font-semibold text-white shadow hover:bg-[#99141b] transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
        </main>
    </div>
@endsection