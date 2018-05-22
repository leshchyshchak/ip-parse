<?php

use Illuminate\Database\Seeder;
use App\UserIpList;

class UserIpListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserIpList::create([
            'ip' => '1.1.1.255',
            'user_id' => 1,
        ]);
        UserIpList::create([
            'ip' => '1.1.1.0',
            'user_id' => 1,
        ]);
        UserIpList::create([
            'ip' => '1.1.1.1',
            'user_id' => 1,
        ]);
        UserIpList::create([
            'ip' => '1.1.1.2',
            'user_id' => 1,
        ]);
    }
}
