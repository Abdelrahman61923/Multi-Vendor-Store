<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name'=>'iPhone 14','description'=>'Latest Apple smartphone with A15 chip and excellent camera.','image'=>'https://via.placeholder.com/600x600.png?text=iPhone+14','price'=>999,'compare_price'=>1099,'quantity'=>50,'featured'=>1,'status'=>'active'],
            ['name'=>'Samsung Galaxy S23','description'=>'High-end Android smartphone with amazing display and camera.','image'=>'https://via.placeholder.com/600x600.png?text=Galaxy+S23','price'=>899,'compare_price'=>999,'quantity'=>40,'featured'=>1,'status'=>'active'],
            ['name'=>'Nike Air Max 2023','description'=>'Comfortable and stylish running shoes for men and women.','image'=>'https://via.placeholder.com/600x600.png?text=Nike+Air+Max+2023','price'=>150,'compare_price'=>300,'quantity'=>60,'featured'=>0,'status'=>'active'],
            ['name'=>'MacBook Pro 16"','description'=>'High-performance laptop for professionals and creatives.','image'=>'https://via.placeholder.com/600x600.png?text=MacBook+Pro+16','price'=>2499,'compare_price'=>2699,'quantity'=>30,'featured'=>1,'status'=>'active'],
            ['name'=>'Canon EOS R6','description'=>'Professional mirrorless camera with high-speed autofocus.','image'=>'https://via.placeholder.com/600x600.png?text=Canon+EOS+R6','price'=>1999,'compare_price'=>2199,'quantity'=>20,'featured'=>0,'status'=>'active'],
            ['name'=>'Sony WH-1000XM5','description'=>'Noise-cancelling wireless headphones with long battery life.','image'=>'https://via.placeholder.com/600x600.png?text=Sony+WH-1000XM5','price'=>399,'compare_price'=>499,'quantity'=>35,'featured'=>1,'status'=>'active'],
            ['name'=>'Adidas Ultraboost','description'=>'High-performance running shoes with Boost cushioning.','image'=>'https://via.placeholder.com/600x600.png?text=Adidas+Ultraboost','price'=>180,'compare_price'=>220,'quantity'=>45,'featured'=>0,'status'=>'active'],
            ['name'=>'iPad Pro 12.9"','description'=>'Powerful tablet for professionals and creatives.','image'=>'https://via.placeholder.com/600x600.png?text=iPad+Pro+12.9','price'=>1099,'compare_price'=>1199,'quantity'=>25,'featured'=>1,'status'=>'active'],
            ['name'=>'Samsung QLED TV 65"','description'=>'4K Smart TV with vibrant colors and HDR support.','image'=>'https://via.placeholder.com/600x600.png?text=Samsung+QLED+65','price'=>1499,'compare_price'=>1699,'quantity'=>15,'featured'=>1,'status'=>'active'],
            ['name'=>'PlayStation 5','description'=>'Next-gen gaming console with ultra-fast SSD and stunning graphics.','image'=>'https://via.placeholder.com/600x600.png?text=PS5','price'=>499,'compare_price'=>599,'quantity'=>30,'featured'=>1,'status'=>'active'],
            ['name'=>'Xbox Series X','description'=>'Powerful gaming console for immersive experiences.','image'=>'https://via.placeholder.com/600x600.png?text=Xbox+Series+X','price'=>499,'compare_price'=>599,'quantity'=>30,'featured'=>1,'status'=>'active'],
            ['name'=>'Apple Watch Series 9','description'=>'Smartwatch with fitness tracking and health monitoring.','image'=>'https://via.placeholder.com/600x600.png?text=Apple+Watch+Series+9','price'=>399,'compare_price'=>449,'quantity'=>50,'featured'=>1,'status'=>'active'],
            ['name'=>'Google Pixel 7','description'=>'Pure Android experience with excellent camera and performance.','image'=>'https://via.placeholder.com/600x600.png?text=Pixel+7','price'=>599,'compare_price'=>699,'quantity'=>40,'featured'=>0,'status'=>'active'],
            ['name'=>'Fitbit Charge 6','description'=>'Advanced fitness tracker with heart rate and sleep tracking.','image'=>'https://via.placeholder.com/600x600.png?text=Fitbit+Charge+6','price'=>149,'compare_price'=>199,'quantity'=>60,'featured'=>0,'status'=>'active'],
            ['name'=>'Dyson V15 Detect','description'=>'High-power cordless vacuum cleaner with laser detection.','image'=>'https://via.placeholder.com/600x600.png?text=Dyson+V15+Detect','price'=>699,'compare_price'=>799,'quantity'=>20,'featured'=>1,'status'=>'active'],
            ['name'=>'Bose QuietComfort Earbuds','description'=>'Noise-cancelling true wireless earbuds with deep sound.','image'=>'https://via.placeholder.com/600x600.png?text=Bose+QC+Earbuds','price'=>279,'compare_price'=>329,'quantity'=>40,'featured'=>0,'status'=>'active'],
            ['name'=>'Kindle Paperwhite','description'=>'E-reader with high-resolution display and adjustable light.','image'=>'https://via.placeholder.com/600x600.png?text=Kindle+Paperwhite','price'=>129,'compare_price'=>149,'quantity'=>50,'featured'=>0,'status'=>'active'],
            ['name'=>'GoPro HERO11','description'=>'Action camera with 5K video recording and stabilization.','image'=>'https://via.placeholder.com/600x600.png?text=GoPro+HERO11','price'=>499,'compare_price'=>549,'quantity'=>25,'featured'=>1,'status'=>'active'],
            ['name'=>'Logitech MX Master 3','description'=>'Ergonomic wireless mouse with precision tracking.','image'=>'https://via.placeholder.com/600x600.png?text=Logitech+MX+Master+3','price'=>99,'compare_price'=>129,'quantity'=>60,'featured'=>0,'status'=>'active'],
            ['name'=>'HP Spectre x360','description'=>'Convertible laptop with touchscreen and sleek design.','image'=>'https://via.placeholder.com/600x600.png?text=HP+Spectre+x360','price'=>1299,'compare_price'=>1399,'quantity'=>25,'featured'=>1,'status'=>'active'],
            ['name'=>'Dell XPS 13','description'=>'Compact high-performance laptop with InfinityEdge display.','image'=>'https://via.placeholder.com/600x600.png?text=Dell+XPS+13','price'=>1099,'compare_price'=>1199,'quantity'=>30,'featured'=>1,'status'=>'active'],
            ['name'=>'JBL Flip 6','description'=>'Portable Bluetooth speaker with rich sound.','image'=>'https://via.placeholder.com/600x600.png?text=JBL+Flip+6','price'=>129,'compare_price'=>159,'quantity'=>50,'featured'=>0,'status'=>'active'],
            ['name'=>'Samsung Galaxy Tab S8','description'=>'High-performance Android tablet for work and entertainment.','image'=>'https://via.placeholder.com/600x600.png?text=Galaxy+Tab+S8','price'=>649,'compare_price'=>749,'quantity'=>25,'featured'=>1,'status'=>'active'],
            ['name'=>'Canon PIXMA G7020','description'=>'All-in-one printer with refillable ink system.','image'=>'https://via.placeholder.com/600x600.png?text=Canon+PIXMA+G7020','price'=>249,'compare_price'=>299,'quantity'=>40,'featured'=>0,'status'=>'active'],
            ['name'=>'Nintendo Switch OLED','description'=>'Gaming console with OLED screen and versatile play modes.','image'=>'https://via.placeholder.com/600x600.png?text=Nintendo+Switch+OLED','price'=>349,'compare_price'=>399,'quantity'=>35,'featured'=>1,'status'=>'active'],
            ['name'=>'Sony Alpha a7 IV','description'=>'Full-frame mirrorless camera for professional photography.','image'=>'https://via.placeholder.com/600x600.png?text=Sony+Alpha+a7+IV','price'=>2499,'compare_price'=>2699,'quantity'=>15,'featured'=>1,'status'=>'active'],
            ['name'=>'Razer BlackWidow V3','description'=>'Mechanical gaming keyboard with RGB lighting.','image'=>'https://via.placeholder.com/600x600.png?text=Razer+BlackWidow+V3','price'=>139,'compare_price'=>179,'quantity'=>40,'featured'=>0,'status'=>'active'],
            ['name'=>'Anker PowerCore 26800','description'=>'High-capacity portable charger for smartphones and tablets.','image'=>'https://via.placeholder.com/600x600.png?text=Anker+PowerCore+26800','price'=>79,'compare_price'=>99,'quantity'=>60,'featured'=>0,'status'=>'active'],
            ['name'=>'Garmin Forerunner 965','description'=>'Advanced GPS running watch with heart rate monitor.','image'=>'https://via.placeholder.com/600x600.png?text=Garmin+Forerunner+965','price'=>599,'compare_price'=>699,'quantity'=>25,'featured'=>1,'status'=>'active'],
            ['name'=>'Sony Bravia 55"','description'=>'4K Smart TV with HDR and motion processing.','image'=>'https://via.placeholder.com/600x600.png?text=Sony+Bravia+55','price'=>1199,'compare_price'=>1299,'quantity'=>15,'featured'=>1,'status'=>'active'],
            ['name'=>'Apple AirPods Pro 2','description'=>'Wireless earbuds with active noise cancellation.','image'=>'https://via.placeholder.com/600x600.png?text=AirPods+Pro+2','price'=>249,'compare_price'=>299,'quantity'=>50,'featured'=>1,'status'=>'active'],
            ['name'=>'Samsung Galaxy Buds 2','description'=>'True wireless earbuds with premium sound quality.','image'=>'https://via.placeholder.com/600x600.png?text=Galaxy+Buds+2','price'=>149,'compare_price'=>199,'quantity'=>50,'featured'=>0,'status'=>'active'],
            ['name'=>'Microsoft Surface Laptop 5','description'=>'Sleek and powerful laptop for work and study.','image'=>'https://via.placeholder.com/600x600.png?text=Surface+Laptop+5','price'=>1299,'compare_price'=>1399,'quantity'=>30,'featured'=>1,'status'=>'active'],
            ['name'=>'Logitech G502 Hero','description'=>'High-performance gaming mouse with programmable buttons.','image'=>'https://via.placeholder.com/600x600.png?text=Logitech+G502+Hero','price'=>79,'compare_price'=>99,'quantity'=>60,'featured'=>0,'status'=>'active'],
            ['name'=>'Lenovo ThinkPad X1 Carbon','description'=>'Business laptop with lightweight design and durability.','image'=>'https://via.placeholder.com/600x600.png?text=ThinkPad+X1+Carbon','price'=>1499,'compare_price'=>1599,'quantity'=>25,'featured'=>1,'status'=>'active'],
            ['name'=>'Beats Studio3','description'=>'Noise-cancelling over-ear headphones with premium sound.','image'=>'https://via.placeholder.com/600x600.png?text=Beats+Studio3','price'=>299,'compare_price'=>349,'quantity'=>40,'featured'=>0,'status'=>'active'],
            ['name'=>'Apple iMac 24"','description'=>'All-in-one desktop computer with M1 chip.','image'=>'https://via.placeholder.com/600x600.png?text=iMac+24','price'=>1299,'compare_price'=>1399,'quantity'=>20,'featured'=>1,'status'=>'active'],
            ['name'=>'Samsung Galaxy Watch 6','description'=>'Smartwatch with fitness and health tracking.','image'=>'https://via.placeholder.com/600x600.png?text=Galaxy+Watch+6','price'=>399,'compare_price'=>449,'quantity'=>50,'featured'=>1,'status'=>'active'],
            ['name'=>'Dell Alienware x15','description'=>'High-end gaming laptop with RTX graphics.','image'=>'https://via.placeholder.com/600x600.png?text=Alienware+x15','price'=>2499,'compare_price'=>2699,'quantity'=>15,'featured'=>1,'status'=>'active'],
            ['name'=>'Sony SRS-XB43','description'=>'Portable Bluetooth speaker with extra bass.','image'=>'https://via.placeholder.com/600x600.png?text=Sony+SRS-XB43','price'=>149,'compare_price'=>179,'quantity'=>50,'featured'=>0,'status'=>'active'],
            ['name'=>'Google Nest Hub','description'=>'Smart display with Google Assistant for home control.','image'=>'https://via.placeholder.com/600x600.png?text=Google+Nest+Hub','price'=>99,'compare_price'=>129,'quantity'=>50,'featured'=>0,'status'=>'active'],
        ];

        $i = 0;
        foreach ($products as $product) {
            Product::create([
                'category_id' => Category::inRandomOrder()->first()->id,
                'store_id' => Store::inRandomOrder()->first()->id,
                'name' => $product['name'],
                'slug' => Str::slug($product['name']) . '-' . $i++,
                'description' => $product['description'],
                'image' => $product['image'],
                'price' => $product['price'],
                'compare_price' => $product['compare_price'],
                'quantity' => $product['quantity'],
                'featured' => $product['featured'],
                'status' => $product['status'],
            ]);
        }
    }
}
