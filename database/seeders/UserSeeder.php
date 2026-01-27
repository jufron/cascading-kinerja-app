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
            // [
            //     'name'              => 'yanuarius',
            //     'nip'               => '199301072020121007',
            //     'email'             => 'Yanuarius@mail.com',
            //     'password'          => Hash::make('199301072020121007'),    // todo role admin
            // ],
            // [
            //     'name'              => 'noldy',
            //     'nip'               => '197111271998031005',
            //     'email'             => 'noldy@mail.com',
            //     'password'          => Hash::make('197111271998031005'),  // todo role pegawai
            // ],
            // [
            //     'name'              => 'kosmas',
            //     'nip'               => '196509271990111004',
            //     'email'             => 'kosmas@mail.com',
            //     'password'          => Hash::make('196509271990111004'),  // todo role pimpinan
            // ],

            [
                'name'              => 'noldy',
                'nip'               => '197111271998031005',
                'email'             => 'noldy@mail.com',
                'password'          => Hash::make('197111271998031005'),  // todo role admin or pimpinan
            ],
            [
                'name'              => 'yanuarius',
                'nip'               => '199301072020121007',
                'email'             => 'yanuarius@mail.com',
                'password'          => Hash::make('199301072020121007'),  // todo role admin
            ],
            [
                'name'              => 'agustinus',
                'nip'               => '196908221991011001',
                'email'             => 'agustinus@mail.com',
                'password'          => Hash::make('196908221991011001'),  // todo role pimpinan
            ],
            [
                'name'              => 'wilhelm',
                'nip'               => '196908221991011001',
                'email'             => 'wilhelm@mail.com',
                'password'          => Hash::make('196908221991011001'),  // todo role pegawai
            ],
        ])->each( function ($item) {
            User::create($item);
        });

        // $userToAdmin = User::query()->whereName('yanuarius')->get()->first();
        // $userToAdmin->assignRole('admin');

        // $userPegawai = User::query()->whereName('noldy')->get()->first();
        // $userPegawai->assignRole('pegawai');

        // $userPimpinan = User::query()->whereName('kosmas')->get()->first();
        // $userPimpinan->assignRole('pimpinan');

        $userAdminYanuarius = User::query()->whereName('yanuarius')->get()->first();
        $userAdminYanuarius->assignRole('admin');

        $userPimpinanNoldy = User::query()->whereName('noldy')->get()->first();
        $userPimpinanNoldy->assignRole('pimpinan');

        $userPimpinanAgustinus = User::query()->whereName('agustinus')->get()->first();
        $userPimpinanAgustinus->assignRole('pimpinan');

        $userPegawaiWilhelm = User::query()->whereName('wilhelm')->get()->first();
        $userPegawaiWilhelm->assignRole('pegawai');


        // Biodata::create([
        //     'user_id'               => $userToAdmin->id,
        //     'nama_lengkap'          => 'Yanuarius F. Lagut , S.Par',
        //     'jabatan_id'            => Jabatan::latest()->get()->first()->id,
        //     'bidang'                => 'testing testing testing',
        //     'pangkat_golongan'      => 'testing testing testing testing',
        //     'nomor_telepon'         => '0821234567890'
        // ]);
        // Biodata::create([
        //     'user_id'               => $userPegawai->id,
        //     'nama_lengkap'          => 'Noldy Hosea Pellokila, S. Sos., M.M',
        //     'jabatan_id'            => Jabatan::latest()->get()->first()->id,
        //     'bidang'                => 'testing testing testing',
        //     'pangkat_golongan'      => 'testing testing testing testing',
        //     'nomor_telepon'         => '0821234567890'
        // ]);
        // Biodata::create([
        //     'user_id'               => $userPimpinan->id,
        //     'nama_lengkap'          => 'kosmas asd',
        //     'jabatan_id'            => Jabatan::latest()->get()->first()->id,
        //     'bidang'                => 'testing testing testing',
        //     'pangkat_golongan'      => 'testing testing testing testing',
        //     'nomor_telepon'         => '0821234567890'
        // ]);

        // yanuarius admin
        Biodata::create([
            'user_id'               => $userAdminYanuarius->id,
            'nama_lengkap'          => 'Yanuarius F. Lagut, S.Par',
            'jabatan_id'            => Jabatan::query()->where('nama_jabatan', 'staf')->first()->id,
            'bidang'                => '-',
            'pangkat_golongan'      => 'Pranata Md Tk.I (III/b)',
            'nomor_telepon'         => '080000000000'
        ]);
        // noldy pimpinan
        Biodata::create([
            'user_id'               => $userPimpinanNoldy->id,
            'nama_lengkap'          => 'Noldy Hosea Pellokila, S. sos,. M.M',
            'jabatan_id'            => Jabatan::query()->where('nama_jabatan', 'Kepala Dinas')->first()->id,
            'bidang'                => '-',
            'pangkat_golongan'      => 'Pembina Utama (IV/c)',
            'nomor_telepon'         => '080000000000'
        ]);
        // agustinus pimpinan
        Biodata::create([
            'user_id'               => $userPimpinanAgustinus->id,
            'nama_lengkap'          => 'Agustinus Haki Bano S.IP., M.Si',
            'jabatan_id'            => Jabatan::query()->where('nama_jabatan', 'sekertaris')->first()->id,
            'bidang'                => '-',
            'pangkat_golongan'      => 'Pembina Tk.I (IV/b)',
            'nomor_telepon'         => '080000000000'
        ]);
        // agustinus pimpinan
        Biodata::create([
            'user_id'               => $userPegawaiWilhelm->id,
            'nama_lengkap'          => 'Wilhelm A. Hermanus, S.T., M.Si',
            'jabatan_id'            => Jabatan::query()->where('nama_jabatan', 'Kabid Destinasi dan Industri Pariwisata')->first()->id,
            'bidang'                => '-',
            'pangkat_golongan'      => 'Pembina Tk.I (IV/b)',
            'nomor_telepon'         => '080000000000'
        ]);
    }
}
