<?php

namespace Database\Seeders;

use App\Models\CubeData;
use App\Services\CubeService;
use Illuminate\Database\Seeder;

class CubeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CubeData::query()->create([
            'matrix' => app(CubeService::class)->getInitialMatrix(),
            'direction' => 'horizontal',
            'degree' => '90',
            'side' => 'U',
        ]);
    }
}
