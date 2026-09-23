<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminCustomizeController extends Controller
{
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
        $settings = [
            'struktur_section_tagline' => SiteSetting::get('struktur_section_tagline', 'Struktur Organisasi'),
            'struktur_section_title' => SiteSetting::get('struktur_section_title', 'Kepengurusan Partai Garuda'),
            'struktur_section_description' => SiteSetting::get('struktur_section_description', 'Struktur kepengurusan Partai Garuda dari tingkat pusat hingga daerah yang bekerja secara profesional dan berintegritas.'),
        ];

        return view('dashboard.customize.struktur', compact('settings'));
    }

    public function updateStruktur(Request $request)
    {
        $request->validate([
            'struktur_section_tagline' => 'required|string|max:255',
            'struktur_section_title' => 'required|string|max:255',
            'struktur_section_description' => 'required|string',
        ]);

        SiteSetting::set('struktur_section_tagline', $request->input('struktur_section_tagline'));
        SiteSetting::set('struktur_section_title', $request->input('struktur_section_title'));
        SiteSetting::set('struktur_section_description', $request->input('struktur_section_description'));

        return redirect()->route('dashboard.customize.struktur')->with('success', 'Konten Struktur berhasil diperbarui!');
    }

    /**
     * Customize Media
     */
    public function media()
    {
        $settings = [
            'media_section_tagline' => SiteSetting::get('media_section_tagline', 'Media Center'),
            'media_section_title' => SiteSetting::get('media_section_title', 'Highlight Media & Dokumentasi'),
            'media_section_description' => SiteSetting::get('media_section_description', 'Ruang media ini menampilkan dokumentasi gerakan, pernyataan resmi, dan aktivitas penting Partai Garuda.'),
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

            // Media
            'media_section_tagline' => SiteSetting::get('media_section_tagline', 'Media Center'),
            'media_section_title' => SiteSetting::get('media_section_title', 'Highlight Media & Dokumentasi'),
            'media_section_description' => SiteSetting::get('media_section_description', 'Ruang media ini menampilkan dokumentasi gerakan, pernyataan resmi, dan aktivitas penting Partai Garuda.'),
        ]);
    }
}
