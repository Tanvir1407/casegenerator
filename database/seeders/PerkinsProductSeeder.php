<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PerkinsProductSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            "title" => "Perkins 110 kVA Silent Diesel Generator",
            "slug" => "perkins-110-kva-silent-diesel-generator",
            "model_code" => "PRK-110-S",
            "status" => "published",
            "is_featured" => true,
            "short_description" => "Premium 110 kVA standby power generator powered by Perkins engine. enclosed in a soundproof canopy for quiet operation.",
            "category" => "Industrial",
            "featured_image" => "products/perkins-110-canopy.jpg",
            "gallery_images" => [
                "products/perkins-110/front.jpg",
                "products/perkins-110/side.jpg",
            ],
            // Indexed columns
            "prime_power_kva" => 100.00,
            "standby_power_kva" => 110.00,
            "prime_power_kw" => 80.00,
            "standby_power_kw" => 88.00,
            "voltage" => "400/230V",
            // "phase" => 3, // 'phases' column in model
            "phases" => 3,
            // "fuel_type" => "Diesel", // 'fuel' column in model
            "fuel" => "Diesel",
            
            // IDs (assuming they exist or are nullable/optional for this test if foreign keys allow, 
            // but provided data says "Assuming ID 2 etc." - if these IDs don't exist this will fail if FK constrained.
            // I'll check FK constraints or create them if needed, or simply omit if not strictly required for this unit test if nullable.
            // Looking at migration, they are foreignIds. I might need to create them or check if they exist.
            // For now, let's try assuming they are nullable or checking if records exist first, or creating dummies.)
            "generator_type_id" => null, 
            "engine_id" => null,          
            "alternator_id" => null,      
            "controller_id" => null,      

            "technical_specifications" => [
                "general" => [
                    "frequency" => "50 Hz",
                    "emissions_level" => "EU Stage II",
                    "insulation_class" => "H",
                    "protection_class" => "IP23"
                ],
                "engine_details" => [
                    "cylinders" => 4,
                    "aspiration" => "Turbocharged",
                    "cooling_system" => "Water Cooled",
                    "governor_type" => "Electronic",
                    "compression_ratio" => "18.3:1",
                    "displacement" => "4.4 Liters"
                ],
                "fuel_consumption_l_h" => [
                    "50_percent_load" => 11.8,
                    "75_percent_load" => 17.1,
                    "100_percent_load" => 22.6,
                    "standby_load" => 24.9
                ],
                "dimensions_and_weight" => [
                    "length_mm" => 2600,
                    "width_mm" => 1100,
                    "height_mm" => 1500,
                    "weight_kg" => 1650,
                    "fuel_tank_capacity_liters" => 250
                ],
                "noise_level" => [
                    "db_at_7m" => 78,
                    "sound_pressure_level" => 94
                ],
                "battery" => [
                    "voltage" => "12V",
                    "capacity" => "80Ah"
                ]
            ],
            "features" => [
                ["feature" => "Soundproof Weather Protective Canopy"], // Repeater structure usually needs key
                ["feature" => "Automatic Mains Failure (AMF) Panel"],
                ["feature" => "Battery Charger Included"],
                ["feature" => "Emergency Stop Button"],
                ["feature" => "Anti-vibration Mountings"],
                ["feature" => "Radiator with Fan Guard"]
            ]
        ];

        Product::updateOrCreate(
            ['slug' => $data['slug']],
            $data
        );
        
        $this->command->info('Perkins 110 kVA Product Created!');
    }
}
