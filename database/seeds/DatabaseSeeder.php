<?php
use CodePress\CodeCategory\Models\Category;
use CodePress\CodeTag\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(Category::class, 5)->create();
        factory(Tag::class, 5)->create();
    }
}
