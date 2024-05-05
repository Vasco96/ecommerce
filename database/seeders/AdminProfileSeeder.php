<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@gmail.com')->first();

        $vendor = new Vendor();
        $vendor->user_id = $user->id;
        $vendor->banner = 'uploads/1343.jpg';
        $vendor->phone = '123456789';
        $vendor->email = 'admin@gmail.com';
        $vendor->address = 'ita';
        $vendor->description = 'shop description';
        $vendor->save();

    }
}
