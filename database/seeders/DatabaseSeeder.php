<?php

use App\Models\NFT;
use App\Models\Collections;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // $collection = Collections::create([
        //     'name' => 'Kernel Gods'
        // ]);
        // $collection = Collections::create([
        //     'name' => 'Python Is Overrated'
        // ]);
        // $collection = Collections::create([
        //     'name' => 'Chickens And Roads'
        // ]);
        // $collection = Collections::create([
        //     'name' => 'Picasso'
        // ]);


        // $collection = Collections::where('name', 'Kernel Gods')->first();
        // $collection->nft()->create([
        //     'name'=>'1',
        //     'file_path'=>'/images/collections/kernel_gods/1.jpg'
        // ]);
        // for ($i=2; $i<=10;$i++) {
        //     $collection->nft()->create([
        //         'name'=>strval($i),
        //         'file_path'=>'/images/collections/kernel_gods/'.strval($i).'.jpg'
        //     ]);
        // }

        // $collection = Collections::where('name', 'Python Is Overrated')->first();
        // for ($i=1; $i<=10;$i++) {
        //     $collection->nft()->create([
        //         'name'=>strval($i),
        //         'file_path'=>'/images/collections/python_is_overrated/'.strval($i).'.jpg'
        //     ]);
        // }

        // $collection = Collections::where('name', 'Chickens And Roads')->first();
        // for ($i=1; $i<=10;$i++) {
        //     $collection->nft()->create([
        //         'name'=>strval($i),
        //         'file_path'=>'/images/collections/chickens_and_roads/'.strval($i).'.jpg'
        //     ]);
        // }

        // $collection = Collections::where('name', 'Picasso')->first();
        // for ($i=1; $i<=10;$i++) {
        //     $collection->nft()->create([
        //         'name'=>strval($i),
        //         'file_path'=>'/images/collections/picasso/'.strval($i).'.jpg'
        //     ]);
        // }

        $collection = Collections::where('name', 'Kernel Gods')->first();
        $collection->initial_price = 20.00;
        $collection->save();
        $collection = Collections::where('name', 'Python Is Overrated')->first();
        $collection->initial_price = 20.00;
        $collection->save();
        $collection = Collections::where('name', 'Chickens And Roads')->first();
        $collection->initial_price = 20.00;
        $collection->save();
        $collection = Collections::where('name', 'Picasso')->first();
        $collection->initial_price = 20.00;
        $collection->save();



        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
