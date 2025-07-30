<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'title' => 'Ayurvedic Consultation',
                'slug' => 'ayurvedic-consultation',
                'short_description' => 'Comprehensive health assessment with personalized treatment plan',
                'description' => 'Our experienced Ayurvedic doctors will assess your constitution, health concerns, and provide a personalized treatment plan.',
                'is_active' => true,
                'is_featured' => true,
                'order' => 1
            ],
            [
                'title' => 'Panchakarma Therapy',
                'slug' => 'panchakarma-therapy',
                'short_description' => 'Traditional detoxification and rejuvenation treatment',
                'description' => 'Complete panchakarma treatment including oil massage, steam therapy, and cleansing procedures.',
                'is_active' => true,
                'is_featured' => true,
                'order' => 2
            ],
            [
                'title' => 'Herbal Medicine',
                'slug' => 'herbal-medicine',
                'short_description' => 'Custom herbal formulations for various health conditions',
                'description' => 'Authentic Sri Lankan herbal medicines prepared according to traditional recipes.',
                'is_active' => true,
                'is_featured' => false,
                'order' => 3
            ],
            [
                'title' => 'Abhyanga Massage',
                'slug' => 'abhyanga-massage',
                'short_description' => 'Full body therapeutic oil massage',
                'description' => 'Traditional Ayurvedic oil massage to improve circulation and reduce stress.',
                'is_active' => true,
                'is_featured' => false,
                'order' => 4
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}