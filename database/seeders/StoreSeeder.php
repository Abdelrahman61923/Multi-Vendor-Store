<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'name' => 'Tech World',
                'description' => 'Leading store for electronics and gadgets.',
                'logo_image' => 'https://via.placeholder.com/200x200.png?text=Tech+World+Logo',
                'cover_image' => 'https://via.placeholder.com/800x300.png?text=Tech+World+Cover',
            ],
            [
                'name' => 'Fashion Hub',
                'description' => 'Trendy clothing, shoes, and accessories for all ages.',
                'logo_image' => 'https://via.placeholder.com/200x200.png?text=Fashion+Hub+Logo',
                'cover_image' => 'https://via.placeholder.com/800x300.png?text=Fashion+Hub+Cover',
            ],
            [
                'name' => 'Sporty Store',
                'description' => 'All sports equipment, gear, and fitness essentials.',
                'logo_image' => 'https://via.placeholder.com/200x200.png?text=Sporty+Store+Logo',
                'cover_image' => 'https://via.placeholder.com/800x300.png?text=Sporty+Store+Cover',
            ],
            [
                'name' => 'Gamer\'s Den',
                'description' => 'Consoles, games, and gaming accessories for all ages.',
                'logo_image' => 'https://via.placeholder.com/200x200.png?text=Gamer+Den+Logo',
                'cover_image' => 'https://via.placeholder.com/800x300.png?text=Gamer+Den+Cover',
            ],
            [
                'name' => 'Home & Beauty',
                'description' => 'Home appliances, furniture, cosmetics, and beauty products.',
                'logo_image' => 'https://via.placeholder.com/200x200.png?text=Home+%26+Beauty+Logo',
                'cover_image' => 'https://via.placeholder.com/800x300.png?text=Home+%26+Beauty+Cover',
            ],
        ];

        $i = 0;
        foreach ($stores as $store) {
            Store::create([
                'name' => $store['name'],
                'slug' => Str::slug($store['name']) . '-' . $i++,
                'description' => $store['description'],
                'logo_image' => $store['logo_image'],
                'cover_image' => $store['cover_image'],
            ]);
        }
    }
}
