<?php

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
        factory(App\Models\admin::class, 50)->create();
        factory(App\Models\category::class, 20)->create();
        factory(App\Models\clinic::class, 20)->create();
        factory(App\Models\nurse::class, 50)->create();
        factory(App\Models\Patient::class, 200)->create();
        factory(App\Models\comment::class, 500)->create();
        factory(App\Models\material::class, 500)->create();
        factory(App\Models\prescription::class, 500)->create();
        factory(App\Models\receipt::class, 400)->create();
        factory(App\Models\reservation::class, 600)->create();
        factory(App\Models\worker::class, 200)->create();
        // factory(App\Models\image::class, 500)->create();
    }
}
