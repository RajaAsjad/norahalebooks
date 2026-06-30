<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class NoraHaleSeeder extends Seeder
{
    public function run(): void
    {
        Book::updateOrCreate(['slug' => 'castor-oil-for-life'], [
            'title' => 'Castor Oil for Life',
            'subtitle' => 'Unlock Nature\'s Secrets to Radiant Skin, Thicker Hair, a Healthier Gut and a Stronger Immune System',
            'description' => "Unlock nature's secrets to radiant skin, thicker hair, a healthier gut, and a stronger immune system. Grounded in real medical insight, this book bridges science and natural healing with step-by-step guidance you can trust.\n\nWith science-backed benefits, practical recipes, and inspiring insights, Nora guides readers through the many ways castor oil can transform beauty, health, and vitality.",
            'amazon_url' => 'https://www.amazon.com/s?k=Castor+Oil+for+Life+Nora+Hale',
            'featured' => true,
            'sort_order' => 1,
            'status' => true,
            'meta_title' => 'Castor Oil for Life by Nora Hale',
            'meta_description' => 'Science-backed castor oil guide for radiant skin, healthy gut, and natural wellness by registered nurse Nora Hale.',
        ]);

        Book::updateOrCreate(['slug' => 'simple-habits-vibrant-life'], [
            'title' => 'Simple Habits for a Vibrant Life',
            'subtitle' => 'Small Changes, Big Results for Energy, Focus & Joy',
            'description' => "Nora's passion for wellness and decades of healthcare experience come together in this delightful, practical guide. Feeling energized, focused, and joyful doesn't require drastic life overhauls — just simple, science-backed habits that make a world of difference.",
            'amazon_url' => 'https://www.amazon.com/s?k=Simple+Habits+Vibrant+Life+Nora+Hale',
            'featured' => true,
            'sort_order' => 2,
            'status' => true,
            'meta_title' => 'Simple Habits for a Vibrant Life by Nora Hale',
            'meta_description' => 'Practical wellness habits for energy and joy at any age, by author and registered nurse Nora Hale.',
        ]);

        BlogPost::updateOrCreate(['slug' => 'welcome-to-nora-hale-books'], [
            'title' => 'Welcome to Nora Hale Books',
            'excerpt' => 'Discover science-backed wellness, natural recipes, and simple habits for vibrant living.',
            'body' => "<p>Welcome! I'm Nora Hale — retired Registered Nurse, wellness author, and believer that the most powerful health solutions are often the simplest ones.</p><p>On this site you'll find my books, blog posts, recipes, and favorite products. Join my newsletter for bonus recipes and early access to new releases.</p>",
            'author' => 'Nora Hale',
            'published_at' => now(),
            'featured' => true,
            'status' => true,
        ]);

        Recipe::updateOrCreate(['slug' => 'castor-oil-hair-mask'], [
            'title' => 'Nourishing Castor Oil Hair Mask',
            'excerpt' => 'A simple overnight treatment for thicker, healthier-looking hair.',
            'ingredients' => "2 tbsp cold-pressed castor oil\n1 tbsp coconut oil\n3 drops rosemary essential oil (optional)",
            'instructions' => "Warm oils slightly between palms.\nApply to scalp and hair, massaging gently for 5 minutes.\nCover with a shower cap or warm towel.\nLeave overnight or at least 2 hours.\nShampoo thoroughly and condition as usual.",
            'prep_time' => '5 min',
            'cook_time' => '2+ hours',
            'servings' => 1,
            'featured' => true,
            'status' => true,
        ]);

        Product::updateOrCreate(['slug' => 'cold-pressed-castor-oil'], [
            'title' => 'Cold-Pressed Castor Oil',
            'description' => 'Nora\'s go-to pure castor oil for hair, skin, and wellness routines.',
            'category' => 'Wellness',
            'amazon_url' => 'https://www.amazon.com/s?k=cold+pressed+castor+oil+organic',
            'featured' => true,
            'sort_order' => 1,
            'status' => true,
        ]);
    }
}
