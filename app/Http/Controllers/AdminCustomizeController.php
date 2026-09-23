<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminCustomizeController extends Controller
{
    private function defaultBoardMembers()
    {
        return [
            [
                'role' => 'Ketua Umum',
                'name' => 'Ahmad Ridha Sabana',
                'bio' => 'Memimpin arah Partai dan memastikan setiap program berjalan sesuai dengan misi partai.',
                'photo' => '/images/pengurus/ketum1.png',
            ],
            [
                'role' => 'Sekretaris Jenderal',
                'name' => 'Ihsan Jauhari',
                'bio' => 'Sekjen bertanggung jawab atas jalannya administrasi dan koordinasi organisasi, serta memastikan seluruh program kerja terlaksana dengan baik.',
                'photo' => '/images/pengurus/ihsan1.png',
            ],
            [
                'role' => 'Wakil Ketua Umum',
                'name' => 'Teddy Gusnaidi',
                'bio' => 'membantu Ketua Umum dalam menjalankan kepemimpinan serta mengoordinasikan pelaksanaan program di seluruh struktur partai.',
                'photo' => '/images/pengurus/tedy1.png',
            ],
            [
                'role' => 'Ketua 1',
                'name' => 'Faisal',
                'bio' => 'Mengelola struktur organisasi dan pengembangan kader agar partai memiliki sumber daya manusia yang kuat.',
                'photo' => '/images/pengurus/faisal1.png',
            ],
            [
                'role' => 'Ketua 2',
                'name' => 'Jeffry Yulianto Waisapy',
                'bio' => 'Menyusun program kerja dan kajian kebijakan yang sesuai dengan kebutuhan masyarakat dan kondisi lapangan.',
                'photo' => '/images/pengurus/jefry1.png',
            ],
            [
                'role' => 'Ketua 3',
                'name' => 'Ahmad Muhlis Fanani',
                'bio' => 'Mengelola komunikasi publik, media, dan penyampaian informasi agar pesan partai tersampaikan dengan jelas.',
                'photo' => '/images/pengurus/caklis1.png',
            ],
            [
                'role' => 'Wakil Sekretaris Jenderal',
                'name' => 'Saiful Rahman',
                'bio' => 'Membantu koordinasi pelaksanaan program kerja serta memastikan komunikasi antarbidang dan pelaksanaan kegiatan organisasi berjalan efektif.',
                'photo' => '/images/pengurus/saiful1.png',
            ],
            [
                'role' => 'Wakil Sekretaris Jenderal',
                'name' => 'Sulistianing Sasih',
                'bio' => 'Membantu Sekretaris Jenderal dalam pengelolaan administrasi, dokumentasi, serta penataan surat-menyurat organisasi agar berjalan tertib dan terstruktur.',
                'photo' => '/images/pengurus/sulistia1.png',
            ],
            [
                'role' => 'Wakil Bendahara Umum',
                'name' => 'Eka Arum Maqshuuroh',
                'bio' => 'Membantu Bendahara Umum dalam pengelolaan kas, pencatatan transaksi, dan administrasi keuangan operasional partai agar berjalan tertib dan terkontrol.',
                'photo' => '/images/pengurus/harum1.png',
            ],
            [
                'role' => 'Wakil Bendahara Umum',
                'name' => 'Tia Fathiah',
                'bio' => 'Membantu penyusunan laporan keuangan serta pengawasan administrasi keuangan untuk memastikan transparansi dan akuntabilitas pengelolaan dana partai.',
                'photo' => '/images/pengurus/tia1.png',
            ],
            [
                'role' => 'Bendahara Umum',
                'name' => 'Fajar Muhammad Faiz Rozi',
                'bio' => 'Bendahara Umum mengelola keuangan partai secara tertib, transparan, dan bertanggung jawab sesuai kebutuhan program dan kegiatan.',
                'photo' => '/images/pengurus/pfaiz1.png',
            ],
        ];
    }

    /**
     * Customize Home
     */
    public function index()
    {
        $settings = [
            'home_section_tagline' => SiteSetting::get('home_section_tagline', 'Partai Garuda'),
            'home_section_title' => SiteSetting::get('home_section_title', 'Gerakan Politik Kebangsaan Untuk Indonesia'),
            'home_section_description' => SiteSetting::get('home_section_description', 'Partai Garuda hadir sebagai wadah perjuangan politik yang berfokus pada semangat nasionalisme, kerakyatan, dan keadilan sosial. Kami berjuang dan bekerja untuk perubahan Indonesia. Dan setiap kader kami adalah patriot-patriot bangsa yang selalu siap menyingsingkan lengan baju untuk mewujudkan cita-cita para pendiri Bangsa dan Negara Kesatuan Republik Indonesia.'),
        ];

        return view('dashboard.customize.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'home_section_tagline' => 'required|string|max:255',
            'home_section_title' => 'required|string|max:255',
            'home_section_description' => 'required|string',
        ]);

        SiteSetting::set('home_section_tagline', $request->input('home_section_tagline'));
        SiteSetting::set('home_section_title', $request->input('home_section_title'));
        SiteSetting::set('home_section_description', $request->input('home_section_description'));

        return redirect()->route('dashboard.customize.index')->with('success', 'Konten Home berhasil diperbarui!');
    }

    /**
     * Customize About Us
     */
    public function about()
    {
        $settings = [
            'about_section_tagline' => SiteSetting::get('about_section_tagline', 'About Us'),
            'about_section_title' => SiteSetting::get('about_section_title', 'Gerakan Politik Kebangsaan Untuk Indonesia'),
            'about_section_description' => SiteSetting::get('about_section_description', 'Partai Garuda hadir sebagai wadah perjuangan politik yang berfokus pada semangat nasionalisme, kerakyatan, dan keadilan sosial. Kami berjuang dan bekerja untuk perubahan Indonesia.'),
        ];

        return view('dashboard.customize.about', compact('settings'));
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'about_section_tagline' => 'required|string|max:255',
            'about_section_title' => 'required|string|max:255',
            'about_section_description' => 'required|string',
        ]);

        SiteSetting::set('about_section_tagline', $request->input('about_section_tagline'));
        SiteSetting::set('about_section_title', $request->input('about_section_title'));
        SiteSetting::set('about_section_description', $request->input('about_section_description'));

        return redirect()->route('dashboard.customize.about')->with('success', 'Konten About Us berhasil diperbarui!');
    }

    /**
     * Customize Struktur
     */
    public function struktur()
    {
        $rawMembers = SiteSetting::get('struktur_board_members');
        $boardMembers = $rawMembers ? json_decode($rawMembers, true) : $this->defaultBoardMembers();

        $settings = [
            'struktur_section_tagline' => SiteSetting::get('struktur_section_tagline', 'Struktur Organisasi'),
            'struktur_section_title' => SiteSetting::get('struktur_section_title', 'Kepengurusan Partai Garuda'),
            'struktur_section_description' => SiteSetting::get('struktur_section_description', 'Struktur kepengurusan Partai Garuda dari tingkat pusat hingga daerah yang bekerja secara profesional dan berintegritas.'),
        ];

        return view('dashboard.customize.struktur', compact('settings', 'boardMembers'));
    }

    public function updateStruktur(Request $request)
    {
        $request->validate([
            'struktur_section_tagline' => 'nullable|string|max:255',
            'struktur_section_title' => 'nullable|string|max:255',
            'struktur_section_description' => 'nullable|string',
            'members' => 'nullable|array',
            'members.*.role' => 'required|string|max:255',
            'members.*.name' => 'required|string|max:255',
            'members.*.bio' => 'nullable|string',
            'members.*.photo' => 'nullable|image|max:5120',
        ]);

        if ($request->filled('struktur_section_tagline')) {
            SiteSetting::set('struktur_section_tagline', $request->input('struktur_section_tagline'));
        }
        if ($request->filled('struktur_section_title')) {
            SiteSetting::set('struktur_section_title', $request->input('struktur_section_title'));
        }
        if ($request->filled('struktur_section_description')) {
            SiteSetting::set('struktur_section_description', $request->input('struktur_section_description'));
        }

        $inputMembers = $request->input('members', []);
        $updatedMembers = [];

        foreach ($inputMembers as $index => $memberData) {
            $photoPath = $memberData['existing_photo'] ?? '/images/p1.png';

            if ($request->hasFile("members.{$index}.photo")) {
                $file = $request->file("members.{$index}.photo");
                $storedPath = $file->store('pengurus', 'public');
                $photoPath = '/storage/' . $storedPath;
            }

            $updatedMembers[] = [
                'role' => $memberData['role'],
                'name' => $memberData['name'],
                'bio' => $memberData['bio'] ?? '',
                'photo' => $photoPath,
            ];
        }

        SiteSetting::set('struktur_board_members', json_encode($updatedMembers));

        return redirect()->route('dashboard.customize.struktur')->with('success', 'Konten & Data Pengurus Struktur berhasil diperbarui!');
    }

    /**
     * Customize Media
     */
    public function media()
    {
        $settings = [
            'media_section_tagline' => SiteSetting::get('media_section_tagline', 'Media Center'),
            'media_section_title' => SiteSetting::get('media_section_title', 'Highlight Media & Dokumentasi'),
            'media_section_description' => SiteSetting::get('media_section_description', 'Ruang media ini menampilkan dokumentasi gerakan, pernyataan resmi, dan aktivitas lapangan sebagai bentuk transparansi kerja organisasi kepada publik.'),
        ];

        return view('dashboard.customize.media', compact('settings'));
    }

    public function updateMedia(Request $request)
    {
        $request->validate([
            'media_section_tagline' => 'required|string|max:255',
            'media_section_title' => 'required|string|max:255',
            'media_section_description' => 'required|string',
        ]);

        SiteSetting::set('media_section_tagline', $request->input('media_section_tagline'));
        SiteSetting::set('media_section_title', $request->input('media_section_title'));
        SiteSetting::set('media_section_description', $request->input('media_section_description'));

        return redirect()->route('dashboard.customize.media')->with('success', 'Konten Media berhasil diperbarui!');
    }

    /**
     * Endpoint API publik untuk menyajikan seluruh settings ke React / Frontend.
     */
    public function apiIndex()
    {
        $rawBoardMembers = SiteSetting::get('struktur_board_members');
        $boardMembers = $rawBoardMembers ? json_decode($rawBoardMembers, true) : $this->defaultBoardMembers();

        return response()->json([
            // Home
            'home_section_tagline' => SiteSetting::get('home_section_tagline', 'Partai Garuda'),
            'home_section_title' => SiteSetting::get('home_section_title', 'Gerakan Politik Kebangsaan Untuk Indonesia'),
            'home_section_description' => SiteSetting::get('home_section_description', 'Partai Garuda hadir sebagai wadah perjuangan politik yang berfokus pada semangat nasionalisme, kerakyatan, dan keadilan sosial. Kami berjuang dan bekerja untuk perubahan Indonesia. Dan setiap kader kami adalah patriot-patriot bangsa yang selalu siap menyingsingkan lengan baju untuk mewujudkan cita-cita para pendiri Bangsa dan Negara Kesatuan Republik Indonesia.'),
            
            // About Us
            'about_section_tagline' => SiteSetting::get('about_section_tagline', 'About Us'),
            'about_section_title' => SiteSetting::get('about_section_title', 'Gerakan Politik Kebangsaan Untuk Indonesia'),
            'about_section_description' => SiteSetting::get('about_section_description', 'Partai Garuda hadir sebagai wadah perjuangan politik yang berfokus pada semangat nasionalisme, kerakyatan, dan keadilan sosial. Kami berjuang dan bekerja untuk perubahan Indonesia.'),

            // Struktur
            'struktur_section_tagline' => SiteSetting::get('struktur_section_tagline', 'Struktur Organisasi'),
            'struktur_section_title' => SiteSetting::get('struktur_section_title', 'Kepengurusan Partai Garuda'),
            'struktur_section_description' => SiteSetting::get('struktur_section_description', 'Struktur kepengurusan Partai Garuda dari tingkat pusat hingga daerah yang bekerja secara profesional dan berintegritas.'),
            'struktur_board_members' => $boardMembers,

            // Media
            'media_section_tagline' => SiteSetting::get('media_section_tagline', 'Media Center'),
            'media_section_title' => SiteSetting::get('media_section_title', 'Highlight Media & Dokumentasi'),
            'media_section_description' => SiteSetting::get('media_section_description', 'Ruang media ini menampilkan dokumentasi gerakan, pernyataan resmi, dan aktivitas lapangan sebagai bentuk transparansi kerja organisasi kepada publik.'),
        ]);
    }
}
