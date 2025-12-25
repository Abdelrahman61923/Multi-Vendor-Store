<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'All kinds of electronic devices including gadgets, phones, and accessories.',
                'image' => 'https://via.placeholder.com/600x600.png?text=Electronics',
                'status' => 'active',
            ],
            [
                'name' => 'Mobile Phones',
                'description' => 'Latest smartphones and mobile phones from top brands.',
                'image' => 'https://via.placeholder.com/600x600.png?text=Mobile+Phones',
                'status' => 'active',
            ],
            [
                'name' => 'Laptops',
                'description' => 'High-performance laptops for work, gaming, and personal use.',
                'image' => 'https://via.placeholder.com/600x600.png?text=Laptops',
                'status' => 'active',
            ],
            [
                'name' => 'Clothing',
                'description' => 'Men, women, and kids clothing including fashion and casual wear.',
                'image' => 'https://via.placeholder.com/600x600.png?text=Clothing',
                'status' => 'active',
            ],
            [
                'name' => 'Shoes',
                'description' => 'Footwear for men, women, and children from top brands.',
                'image' => 'https://via.placeholder.com/600x600.png?text=Shoes',
                'status' => 'active',
            ],
            [
                'name' => 'Accessories',
                'description' => 'Fashion and tech accessories like bags, watches, and jewelry.',
                'image' => 'https://via.placeholder.com/600x600.png?text=Accessories',
                'status' => 'active',
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports equipment, fitness gear, and outdoor activity essentials.',
                'image' => 'https://via.placeholder.com/600x600.png?text=Sports',
                'status' => 'active',
            ],
            [
                'name' => 'Gaming',
                'description' => 'Consoles, games, and gaming accessories for all ages.',
                'image' => 'https://via.placeholder.com/600x600.png?text=Gaming',
                'status' => 'active',
            ],
            [
                'name' => 'Home',
                'description' => 'Home appliances, furniture, and décor items for modern living.',
                'image' => 'https://via.placeholder.com/600x600.png?text=Home',
                'status' => 'active',
            ],
            [
                'name' => 'Beauty',
                'description' => 'Cosmetics, skincare, and beauty products for men and women.',
                'image' => 'https://via.placeholder.com/600x600.png?text=Beauty',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
                'image' => $cat['image'],
                'status' => $cat['status'],
            ]);
        }
    }
}
