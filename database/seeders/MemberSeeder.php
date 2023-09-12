<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::create([
            'code' => 'M001',
            'name' => 'Angga',
        ]);
        Member::create([
            'code' => 'M002',
            'name' => 'Ferry',
        ]);
        Member::create([
            'code' => 'M003',
            'name' => 'Putri',
        ]);
       
    }
}
