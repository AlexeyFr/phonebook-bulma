<?php

use Illuminate\Database\Seeder;

class PhonebooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Phonebooks')->delete();

        $phones = array (
            array(
                'name' => 'Фролов Алексей',
                'phone' => '380968888888',
                'email' => 'asfrolov1983@gmail.com',
                'description' => 'Front-end developer, I have more than four years of experience in commercial development of web front-end development: layouts (Photoshop-PSD, Figma-sketch and zeplin); layout on tables(mails), floats and flexs; ajax, api and etc. Extensive experience in adaptive (for mobile and smartphones) cross-browser layout. I always make every effort to achieve the best result. English — Pre-intermediate.',
            ),
            array(
                'name' => 'Test',
                'phone' => '380999999999',
                'email' => 'test@gmail.com',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti ullam iure vitae minima, sit voluptas. Quod consequatur hic nihil, inventore repellendus obcaecati fugiat amet, eaque autem magnam non, suscipit. Officia.',
            )
        );
        DB::table('Phonebooks')->insert($phones);
    }
}