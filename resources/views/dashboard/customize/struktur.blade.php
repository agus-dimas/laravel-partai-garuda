@extends('layouts.app')

@section('content')
    <div class="flex flex-col lg:flex-row min-h-screen bg-zinc-100">
        <x-dashboard-sidebar />

        <main class="flex-1 px-6 py-10 pt-24">
            <div class="mx-auto max-w-4xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold text-zinc-900">Customize Struktur Organisasi</h1>
                        <p class="text-sm text-zinc-500 mt-1">Kelola data kepengurusan (Role, Nama, Bio, Foto) serta informasi header.</p>
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

                <form action="{{ route('dashboard.customize.updateStruktur') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    
                    <!-- Section Header Info -->
                    <div class="rounded-2xl bg-white shadow p-6">
                        <h2 class="text-lg font-semibold text-zinc-900 mb-4 pb-2 border-b border-zinc-100">Header Halaman Struktur</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-1">Tagline / Sub-Judul</label>
                                <input type="text" name="struktur_section_tagline"
                                    value="{{ old('struktur_section_tagline', $settings['struktur_section_tagline']) }}"
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-200" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-1">Judul Section</label>
                                <input type="text" name="struktur_section_title"
                                    value="{{ old('struktur_section_title', $settings['struktur_section_title']) }}"
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-200" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-1">Deskripsi Section</label>
                                <textarea name="struktur_section_description" rows="2"
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-200">{{ old('struktur_section_description', $settings['struktur_section_description']) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Section Board Members -->
                    <div class="rounded-2xl bg-white shadow p-6">
                        <div class="flex items-center justify-between mb-4 pb-2 border-b border-zinc-100">
                            <div>
                                <h2 class="text-lg font-semibold text-zinc-900">Daftar Pengurus</h2>
                                <p class="text-xs text-zinc-500">Edit Jabatan, Nama, Bio, dan Upload Foto Pengurus.</p>
                            </div>
                            <button type="button" id="add-member-btn"
                                class="inline-flex items-center rounded-lg bg-zinc-900 px-3 py-1.5 text-xs font-semibold text-white shadow hover:bg-zinc-800">
                                + Tambah Pengurus
                            </button>
                        </div>

                        <div id="members-container" class="space-y-6">
                            @foreach ($boardMembers as $index => $member)
                                <div class="member-card rounded-xl border border-zinc-200 bg-zinc-50/50 p-4 relative transition-all">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-xs font-bold uppercase tracking-wider text-red-600 member-number">Pengurus #{{ $index + 1 }}</span>
                                        <button type="button" onclick="removeMember(this)"
                                            class="text-xs font-semibold text-red-600 hover:text-red-800 px-2 py-1 rounded bg-red-50 hover:bg-red-100 border border-red-200">
                                            Hapus
                                        </button>
                                    </div>

                                    <input type="hidden" name="members[{{ $index }}][existing_photo]" value="{{ $member['photo'] ?? '/images/p1.png' }}">

                                    <div class="grid md:grid-cols-[120px_1fr] gap-4 items-start">
                                        <!-- Foto Preview & Upload -->
                                        <div class="flex flex-col items-center">
                                            <div class="w-24 h-28 rounded-lg overflow-hidden border border-zinc-300 bg-zinc-200 mb-2 relative group">
                                                <img src="{{ asset($member['photo'] ?? 'images/p1.png') }}" alt="{{ $member['name'] }}"
                                                    class="w-full h-full object-cover member-photo-preview">
                                            </div>
                                            <label class="cursor-pointer text-[11px] font-semibold text-zinc-700 hover:text-red-600 bg-white border border-zinc-200 rounded px-2 py-1 shadow-sm text-center w-full">
                                                Ganti Foto
                                                <input type="file" name="members[{{ $index }}][photo]" accept="image/*" class="hidden" onchange="previewPhoto(this)">
                                            </label>
                                        </div>

                                        <!-- Form Inputs -->
                                        <div class="space-y-3">
                                            <div class="grid sm:grid-cols-2 gap-3">
                                                <div>
                                                    <label class="block text-xs font-medium text-zinc-700 mb-1">Jabatan / Role</label>
                                                    <input type="text" name="members[{{ $index }}][role]" value="{{ $member['role'] }}" required
                                                        class="w-full rounded-lg border border-zinc-200 px-3 py-1.5 text-sm focus:border-red-500 focus:ring-red-200" placeholder="Contoh: Ketua Umum">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-zinc-700 mb-1">Nama Lengkap</label>
                                                    <input type="text" name="members[{{ $index }}][name]" value="{{ $member['name'] }}" required
                                                        class="w-full rounded-lg border border-zinc-200 px-3 py-1.5 text-sm focus:border-red-500 focus:ring-red-200" placeholder="Nama Pengurus">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-zinc-700 mb-1">Bio / Deskripsi Tugas</label>
                                                <textarea name="members[{{ $index }}][bio]" rows="2"
                                                    class="w-full rounded-lg border border-zinc-200 px-3 py-1.5 text-sm focus:border-red-500 focus:ring-red-200" placeholder="Deskripsi peranan...">{{ $member['bio'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-end pt-6 mt-4 border-t border-zinc-100">
                            <button type="submit"
                                class="inline-flex items-center rounded-lg bg-[#b3181f] px-6 py-2.5 text-sm font-semibold text-white shadow hover:bg-[#99141b] transition-colors">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                const container = input.closest('.member-card');
                const img = container.querySelector('.member-photo-preview');
                reader.onload = function(e) {
                    img.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeMember(btn) {
            const card = btn.closest('.member-card');
            const container = document.getElementById('members-container');
            if (container.children.length <= 1) {
                alert('Minimal harus ada 1 pengurus.');
                return;
            }
            if (confirm('Apakah Anda yakin ingin menghapus pengurus ini?')) {
                card.remove();
                updateMemberNumbers();
            }
        }

        function updateMemberNumbers() {
            const cards = document.querySelectorAll('.member-card');
            cards.forEach((card, index) => {
                const numLabel = card.querySelector('.member-number');
                if (numLabel) numLabel.textContent = 'Pengurus #' + (index + 1);

                // Update input name indexes
                const inputs = card.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        const newName = name.replace(/members\[\d+\]/, 'members[' + index + ']');
                        input.setAttribute('name', newName);
                    }
                });
            });
        }

        document.getElementById('add-member-btn').addEventListener('click', function() {
            const container = document.getElementById('members-container');
            const index = container.children.length;

            const newCard = document.createElement('div');
            newCard.className = 'member-card rounded-xl border border-zinc-200 bg-zinc-50/50 p-4 relative transition-all';
            newCard.innerHTML = `
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-red-600 member-number">Pengurus #${index + 1}</span>
                    <button type="button" onclick="removeMember(this)"
                        class="text-xs font-semibold text-red-600 hover:text-red-800 px-2 py-1 rounded bg-red-50 hover:bg-red-100 border border-red-200">
                        Hapus
                    </button>
                </div>
                <input type="hidden" name="members[${index}][existing_photo]" value="/images/p1.png">
                <div class="grid md:grid-cols-[120px_1fr] gap-4 items-start">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-28 rounded-lg overflow-hidden border border-zinc-300 bg-zinc-200 mb-2 relative group">
                            <img src="/images/p1.png" alt="Preview Foto" class="w-full h-full object-cover member-photo-preview">
                        </div>
                        <label class="cursor-pointer text-[11px] font-semibold text-zinc-700 hover:text-red-600 bg-white border border-zinc-200 rounded px-2 py-1 shadow-sm text-center w-full">
                            Pilih Foto
                            <input type="file" name="members[${index}][photo]" accept="image/*" class="hidden" onchange="previewPhoto(this)">
                        </label>
                    </div>
                    <div class="space-y-3">
                        <div class="grid sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-zinc-700 mb-1">Jabatan / Role</label>
                                <input type="text" name="members[${index}][role]" required
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-1.5 text-sm focus:border-red-500 focus:ring-red-200" placeholder="Contoh: Ketua Umum">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-zinc-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="members[${index}][name]" required
                                    class="w-full rounded-lg border border-zinc-200 px-3 py-1.5 text-sm focus:border-red-500 focus:ring-red-200" placeholder="Nama Pengurus">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-zinc-700 mb-1">Bio / Deskripsi Tugas</label>
                            <textarea name="members[${index}][bio]" rows="2"
                                class="w-full rounded-lg border border-zinc-200 px-3 py-1.5 text-sm focus:border-red-500 focus:ring-red-200" placeholder="Deskripsi peranan..."></textarea>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(newCard);
        });
    </script>
@endsection
