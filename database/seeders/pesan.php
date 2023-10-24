<?php

namespace Database\Seeders;

use App\Models\pesan_barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pesan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            "id_pesanan" => "123",
            "id_obat" => "11000000",
            "nama_obat" => "ACYCLOVIR 200 MG (DUS 100 TAB)",
            "username" => "ajid20",
            "jum_pesanan" => 1,
            "harga_pesanan" => 10000
        ],[
            "id_pesanan" => "123",
            "id_obat" => "11000002",
            "nama_obat" => "ACYCLOVIR 400 MG (DUS 100 TAB)",
            "username" => "ajid20",
            "jum_pesanan" => 1,
            "harga_pesanan" => 15000
        ]];

        pesan_barang::insert($data);
    }

}
