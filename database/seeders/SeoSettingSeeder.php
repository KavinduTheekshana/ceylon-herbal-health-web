<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'default',
                'page_name' => 'Default SEO Settings',
                'title' => 'Ceylon Herbal Health - Authentic Ceylon Ayurveda & Wellness in the UK',
                'meta_description' => 'Experience authentic Ceylon Ayurveda healing and wellness treatments at Ceylon Herbal Health. Book your personalized consultation with our qualified practitioners in the United Kingdom.',
                'meta_keywords' => 'Ayurveda UK, Ceylon Ayurveda, Herbal Medicine, Natural Healing, Wellness Treatment, Ayurvedic Consultation, Traditional Medicine, Holistic Health, Ayurveda United Kingdom',
                'og_title' => 'Ceylon Herbal Health - Authentic Ceylon Ayurveda',
                'og_description' => 'Experience authentic Ceylon Ayurveda healing and wellness treatments at Ceylon Herbal Health.',
                'og_type' => 'website',
                'twitter_title' => 'Ceylon Herbal Health - Authentic Ceylon Ayurveda',
                'twitter_description' => 'Experience authentic Ceylon Ayurveda healing and wellness treatments.',
                'robots' => 'index, follow',
                'is_active' => true,
            ],
            [
                'key' => 'home',
                'page_name' => 'Homepage',
                'title' => 'Ceylon Herbal Health - Authentic Ceylon Ayurveda & Wellness in the UK',
                'meta_description' => 'Experience authentic Ceylon Ayurveda healing and wellness treatments at Ceylon Herbal Health. Book your personalized consultation with our qualified practitioners in the United Kingdom. Natural herbal remedies and traditional healing methods.',
                'meta_keywords' => 'Ayurveda UK, Ceylon Ayurveda, Herbal Medicine UK, Natural Healing, Ayurvedic Treatment, Traditional Medicine, Holistic Health, Wellness Center UK, Ayurvedic Consultation, Herbal Therapy',
                'og_title' => 'Ceylon Herbal Health - Authentic Ceylon Ayurveda in the UK',
                'og_description' => 'Discover natural healing through authentic Ceylon Ayurveda. Book your personalized wellness consultation today.',
                'og_type' => 'website',
                'robots' => 'index, follow',
                'is_active' => true,
            ],
            [
                'key' => 'services',
                'page_name' => 'Services Page',
                'title' => 'Our Ayurvedic Services - Ceylon Herbal Health',
                'meta_description' => 'Explore our range of authentic Ceylon Ayurvedic treatments including herbal therapies, wellness consultations, massage therapies, and traditional healing services in the United Kingdom.',
                'meta_keywords' => 'Ayurvedic Services UK, Herbal Treatments, Wellness Services, Ayurveda Therapies, Traditional Healing, Panchakarma, Abhyanga, Shirodhara, Ayurvedic Massage',
                'og_title' => 'Ayurvedic Services - Ceylon Herbal Health UK',
                'og_description' => 'Discover our comprehensive range of authentic Ceylon Ayurvedic treatments and wellness services. Book your healing session today.',
                'og_type' => 'website',
                'robots' => 'index, follow',
                'is_active' => true,
            ],
            [
                'key' => 'about',
                'page_name' => 'About Us Page',
                'title' => 'About Us - Ceylon Herbal Health | Authentic Ceylon Ayurveda in the UK',
                'meta_description' => 'Learn about Ceylon Herbal Health and our mission to bring authentic Ceylon Ayurveda to the United Kingdom. Meet our qualified practitioners, discover our healing philosophy, and understand our traditional approach to wellness.',
                'meta_keywords' => 'About Ceylon Herbal Health, Ayurveda Practitioners UK, Ceylon Healing, Traditional Medicine Experts, Ayurvedic Clinic UK, Our Team, Wellness Philosophy',
                'og_title' => 'About Ceylon Herbal Health - Authentic Ayurveda Practitioners',
                'og_description' => 'Discover our story, meet our expert practitioners, and learn about our commitment to authentic Ceylon Ayurvedic healing.',
                'og_type' => 'website',
                'robots' => 'index, follow',
                'is_active' => true,
            ],
            [
                'key' => 'contact',
                'page_name' => 'Contact Us Page',
                'title' => 'Contact Us - Ceylon Herbal Health | Get in Touch',
                'meta_description' => 'Contact Ceylon Herbal Health for inquiries about our Ayurvedic treatments and wellness services in the United Kingdom. Call us, visit our clinic, or send us a message. We\'re here to help you on your journey to better health.',
                'meta_keywords' => 'Contact Ceylon Herbal Health, Ayurveda Clinic UK, Book Ayurveda Appointment, Wellness Center Contact, Get in Touch, Ayurvedic Consultation Enquiry',
                'og_title' => 'Contact Ceylon Herbal Health - Get in Touch',
                'og_description' => 'Reach out to Ceylon Herbal Health for personalized Ayurvedic consultations and wellness treatments in the UK.',
                'og_type' => 'website',
                'robots' => 'index, follow',
                'is_active' => true,
            ],
            [
                'key' => 'appointment',
                'page_name' => 'Book Appointment Page',
                'title' => 'Book Appointment - Ceylon Herbal Health | Online Booking',
                'meta_description' => 'Book your personalized Ayurvedic consultation online at Ceylon Herbal Health. Choose from our qualified therapists, select your preferred date and time, and begin your journey to natural wellness.',
                'meta_keywords' => 'Book Ayurveda Appointment UK, Online Ayurvedic Booking, Schedule Consultation, Wellness Appointment, Herbal Medicine Booking, Ayurveda Therapist Booking',
                'og_title' => 'Book Your Ayurvedic Appointment - Ceylon Herbal Health',
                'og_description' => 'Schedule your personalized Ayurvedic consultation with our experienced practitioners. Easy online booking with flexible time slots.',
                'og_type' => 'website',
                'robots' => 'index, follow',
                'is_active' => true,
            ],
        ];

        foreach ($settings as $setting) {
            SeoSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
