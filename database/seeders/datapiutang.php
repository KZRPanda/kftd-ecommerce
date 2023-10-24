<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\data_piutang;

class datapiutang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            "id_piutang" => "134235421",
            "id_pesanan" => "76342343",
            "username" => "mamang12",
            "total" => "39923431"
        ],[
            "id_piutang" => "7544208541",
            "id_pesanan" => "0834523",
            "username" => "mamang12",
            "total" => "999999"
        ]];

        data_piutang::insert($data);
    }
}
