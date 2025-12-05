<?php

namespace Database\Seeders;

use App\Models\Biodata;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name'              => 'yanuarius',
                'nip'               => '199301072020121007',
                'email'             => 'Yanuarius@mail.com',
                'password'          => Hash::make('199301072020121007'),    // todo role admin
            ],
            [
                'name'              => 'noldy',
                'nip'               => '197111271998031005',
                'email'             => 'noldy@mail.com',
                'password'          => Hash::make('197111271998031005'),  // todo role pegawai
            ],
            [
                'name'              => 'kosmas',
                'nip'               => '196509271990111004',
                'email'             => 'kosmas@mail.com',
                'password'          => Hash::make('196509271990111004'),  // todo role pimpinan
            ],
        ])->each( function ($item) {
            User::create($item);
        });

        $userToAdmin = User::query()->whereName('yanuarius')->get()->first();
        $userToAdmin->assignRole('admin');

        $userPegawai = User::query()->whereName('noldy')->get()->first();
        $userPegawai->assignRole('pegawai');

        $userPimpinan = User::query()->whereName('kosmas')->get()->first();
        $userPimpinan->assignRole('pimpinan');

        Biodata::create([
            'user_id'               => $userToAdmin->id,
            'nama_lengkap'          => 'Yanuarius F. Lagut , S.Par',
            'jabatan_id'            => Jabatan::latest()->get()->first()->id,
            'bidang'                => 'testing testing testing',
            'pangkat_golongan'      => 'testing testing testing testing',
            'nomor_telepon'         => '0821234567890'
        ]);
        Biodata::create([
            'user_id'               => $userPegawai->id,
            'nama_lengkap'          => 'Noldy Hosea Pellokila, S. Sos., M.M',
            'jabatan_id'            => Jabatan::latest()->get()->first()->id,
            'bidang'                => 'testing testing testing',
            'pangkat_golongan'      => 'testing testing testing testing',
            'nomor_telepon'         => '0821234567890'
        ]);
        Biodata::create([
            'user_id'               => $userPimpinan->id,
            'nama_lengkap'          => 'kosmas asd',
            'jabatan_id'            => Jabatan::latest()->get()->first()->id,
            'bidang'                => 'testing testing testing',
            'pangkat_golongan'      => 'testing testing testing testing',
            'nomor_telepon'         => '0821234567890'
        ]);
    }
}
