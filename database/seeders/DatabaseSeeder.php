<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('user')->insert([
            [
                'nameUser' => 'Nguyễn Thành Luân',
                'birthday' => '2002-04-22',
                'phone' => '0349904429',
                'address' => 'Hải Phòng',
                'email' => 'ntluangoc@gmail.com',
                'avatar' => 'luan.jpg'
            ],
            [
                'nameUser' => 'Nguyễn Kim Thành',
                'birthday' => '2002-12-25',
                'phone' => '0111111111',
                'address' => 'Hải Dương',
                'email' => 'thanhpc@gmail.com',
                'avatar' => 'thanh.jpg'
            ],
            [
                'nameUser' => 'Dương Văn Tuyến',
                'birthday' => '2002-04-06',
                'phone' => '0222222222',
                'address' => 'Thanh Hóa',
                'email' => 'tuyengu@gmail.com',
                'avatar' => 'tuyen.jpg'
            ],
            [
                'nameUser' => 'Trần Công Đoàn',
                'birthday' => '2023-07-17',
                'phone' => '0123456789',
                'address' => 'Nam Định',
                'email' => 'doanghien@gmail.com',
                'avatar' => 'doan.jpg'
            ]
        ]);
        DB::table('account')->insert([
            [
                'idUser' => '1',
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'role' => 'ADMIN'
            ],
            [
                'idUser' => '2',
                'username' => '0111111111',
                'password' => bcrypt('123456'),
                'role' => 'EMPLOYEE'
            ],
            [
                'idUser' => '3',
                'username' => '0222222222',
                'password' => bcrypt('123456'),
                'role' => 'EMPLOYEE'
            ],
            [
                'idUser' => '4',
                'username' => '0123456789',
                'password' => bcrypt('17072023'),
                'role' => 'CUSTOMER'
            ]
        ]);
        DB::table('employee')->insert([
            [
                'idUser' => '2',
                'salary' => '25.5',
                'position' => 'Employee'
            ],
            [
                'idUser' => '3',
                'salary' => '20.5',
                'position' => 'Chef'
            ]
        ]);
        DB::table('customer')->insert([
           [
               'idUser' => '4'
           ]
        ]);
        DB::table('food')->insert([
           [
               'nameFood' => 'Set Sushi Small',
               'priceFood' => '14.99',
               'typeFood' => 'Main Course',
               'forPerson' => '4',
               'amountFood' => '20',
               'imgFood' => '1_30062023_2009_set_sashimi_small.jpg'
           ],
           [
               'nameFood' => 'Tuna - Nigiri Sushi',
               'priceFood' => '2.99',
               'typeFood' => 'Main Course',
               'forPerson' => '1',
               'amountFood' => '100',
               'imgFood' => '1_30062023_2009_nishin.jpg'
           ],
            [
                'nameFood' => 'Ebi - Nigiri Sushi',
                'priceFood' => '1.99',
                'typeFood' => 'Main Course',
                'forPerson' => '1',
                'amountFood' => '100',
                'imgFood' => '1_30062023_2010_ebi.jpg'
            ],
            [
                'nameFood' => 'Dragon - Nigiri Sushi',
                'priceFood' => '2.99',
                'typeFood' => 'Main Course',
                'forPerson' => '1',
                'amountFood' => '80',
                'imgFood' => '1_30062023_2011_dragon.jpg'
            ],
            [
                'nameFood' => 'Uni - Nigiri Sushi',
                'priceFood' => '2.99',
                'typeFood' => 'Main Course',
                'forPerson' => '1',
                'amountFood' => '80',
                'imgFood' => '1_30062023_2011_uni.jpg'
            ],
            [
                'nameFood' => 'Tako - Nigiri Sushi',
                'priceFood' => '1.99',
                'typeFood' => 'Starter',
                'forPerson' => '1',
                'amountFood' => '100',
                'imgFood' => '1_30062023_2011_tako.jpg'
            ],
            [
                'nameFood' => 'Tamango - Nigiri Sushi',
                'priceFood' => '0.99',
                'typeFood' => 'Starter',
                'forPerson' => '1',
                'amountFood' => '150',
                'imgFood' => '1_30062023_2011_tamango.jpg'
            ],
            [
                'nameFood' => 'Miso Soup',
                'priceFood' => '0.99',
                'typeFood' => 'Starter',
                'forPerson' => '1',
                'amountFood' => '100',
                'imgFood' => '1_30062023_2012_miso_soup.jpg'
            ],
            [
                'nameFood' => 'Pork Udon Noodle',
                'priceFood' => '2.99',
                'typeFood' => 'Starter',
                'forPerson' => '1',
                'amountFood' => '100',
                'imgFood' => '1_30062023_2012_pork_udon.jpg'
            ],
            [
                'nameFood' => 'Avocado Salad',
                'priceFood' => '1.99',
                'typeFood' => 'Starter',
                'forPerson' => '1',
                'amountFood' => '100',
                'imgFood' => '1_30062023_2012_salad_1.jpg'
            ],
            [
                'nameFood' => 'Ebi Furai',
                'priceFood' => '1.59',
                'typeFood' => 'Starter',
                'forPerson' => '1',
                'amountFood' => '100',
                'imgFood' => '1_30062023_2015_tom_chien.jpg'
            ],
            [
                'nameFood' => 'Fried Chicken',
                'priceFood' => '2.99',
                'typeFood' => 'Starter',
                'forPerson' => '2',
                'amountFood' => '70',
                'imgFood' => '1_30062023_2016_fried_chicken.jpg'
            ],
            [
                'nameFood' => 'Salmon Avocado Maki',
                'priceFood' => '2.99',
                'typeFood' => 'Main Course',
                'forPerson' => '2',
                'amountFood' => '100',
                'imgFood' => '1_30062023_2016_salmon_avocado.jpg'
            ],
            [
                'nameFood' => 'Salmon Maki Sushi',
                'priceFood' => '1.59',
                'typeFood' => 'Main Course',
                'forPerson' => '2',
                'amountFood' => '100',
                'imgFood' => '1_30062023_2018_salmon.jpg'
            ],
            [
                'nameFood' => 'Salmon Tobiko',
                'priceFood' => '1.29',
                'typeFood' => 'Main Course',
                'forPerson' => '2',
                'amountFood' => '50',
                'imgFood' => '1_30062023_2018_salmon_tobiko.jpg'
            ],
            [
                'nameFood' => 'Sake Sashimi',
                'priceFood' => '1.29',
                'typeFood' => 'Main Course',
                'forPerson' => '2',
                'amountFood' => '100',
                'imgFood' => '1_30062023_2018_sake_sashimi.jpg'
            ],
            [
                'nameFood' => 'Kanpachi Sashimi',
                'priceFood' => '1.99',
                'typeFood' => 'Starter',
                'forPerson' => '2',
                'amountFood' => '70',
                'imgFood' => '1_30062023_2019_kanpachi_sashimi.jpg'
            ],
            [
                'nameFood' => 'Chutoro Sashimi',
                'priceFood' => '2.99',
                'typeFood' => 'Starter',
                'forPerson' => '2',
                'amountFood' => '50',
                'imgFood' => '1_30062023_2019_chutoro_sashimi.jpg'
            ],
            [
                'nameFood' => 'Hokkigai Sashimi',
                'priceFood' => '2.99',
                'typeFood' => 'Starter',
                'forPerson' => '2',
                'amountFood' => '50',
                'imgFood' => '1_30062023_2019_hokkigai_sashimi.jpg'
            ],
            [
                'nameFood' => 'Set Sashimi Medium',
                'priceFood' => '18.99',
                'typeFood' => 'Main Course',
                'forPerson' => '4',
                'amountFood' => '75',
                'imgFood' => '1_30062023_2019_set_sashimi_medium.jpg'
            ],
            [
                'nameFood' => 'Set Sushi Medium',
                'priceFood' => '15.59',
                'typeFood' => 'Main Course',
                'forPerson' => '3',
                'amountFood' => '60',
                'imgFood' => '1_30062023_2019_set_sushi_medium.jpg'
            ],
            [
                'nameFood' => 'Set Sushi Big',
                'priceFood' => '24.99',
                'typeFood' => 'Main Course',
                'forPerson' => '5',
                'amountFood' => '75',
                'imgFood' => '1_30062023_2020_set_sushi_big.jpg'
            ],
            [
                'nameFood' => 'Ice-cream',
                'priceFood' => '0.99',
                'typeFood' => 'Dessert',
                'forPerson' => '1',
                'amountFood' => '150',
                'imgFood' => '1_30062023_2020_icecream.jpg'
            ],
            [
                'nameFood' => 'Mizu Shingen Mochi',
                'priceFood' => '1.59',
                'typeFood' => 'Dessert',
                'forPerson' => '1',
                'amountFood' => '100',
                'imgFood' => '1_30062023_2020_Mizu_Shingen_Mochi.jpg'
            ],
            [
                'nameFood' => 'Dorayaki',
                'priceFood' => '0.99',
                'typeFood' => 'Dessert',
                'forPerson' => '1',
                'amountFood' => '100',
                'imgFood' => '1_30062023_2020_dorayaki.jpg'
            ],
            [
                'nameFood' => 'Manju',
                'priceFood' => '1.29',
                'typeFood' => 'Dessert',
                'forPerson' => '2',
                'amountFood' => '60',
                'imgFood' => '1_30062023_2020_Manju.jpg'
            ],
            [
                'nameFood' => 'Namagashi',
                'priceFood' => '0.99',
                'typeFood' => 'Dessert',
                'forPerson' => '2',
                'amountFood' => '70',
                'imgFood' => '1_30062023_2021_Namagashi.jpg'
            ],
            [
                'nameFood' => 'Anmitsu',
                'priceFood' => '1.29',
                'typeFood' => 'Dessert',
                'forPerson' => '1',
                'amountFood' => '60',
                'imgFood' => '1_30062023_2021_Anmitsu.jpg'
            ],
            [
                'nameFood' => 'Coconut',
                'priceFood' => '1.29',
                'typeFood' => 'Dessert',
                'forPerson' => '1',
                'amountFood' => '100',
                'imgFood' => '1_30062023_1745_coconut.jpg'
            ]
        ]);
        DB::table('table')->insert([
            [
                'typeTable' => '2',
                'amountTable' => '20',
                'imgTable' => '1_03072023_0954_2.jpg',
            ],
            [
                'typeTable' => '4',
                'amountTable' => '20',
                'imgTable' => '1_03072023_0954_4.jpg',
            ],
            [
                'typeTable' => '6',
                'amountTable' => '20',
                'imgTable' => '1_03072023_0954_6.jpg',
            ],
            [
                'typeTable' => '8',
                'amountTable' => '20',
                'imgTable' => '1_03072023_0954_8.jpg',
            ]
        ]);
        DB::table('restaurant')->insert([
            [
                'nameRestaurant' => 'Sushi A+',
                'timeOpen' => '09:00',
                'timeClose' => '23:30'
            ]
        ]);
    }
}
