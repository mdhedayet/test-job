<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\User;
use App\Models\Reader;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        //check Already admin and menber exist 
        if(User::first()){

            User::factory(10)
            ->password('123456')
            ->isAdmin(1)
            ->create();
    
            User::factory(10)
            ->password('123456')
            ->isAdmin(0)
            ->create();

            Book::factory(10)->create();
            Reader::factory(10)->create();

        }else{

            User::factory(1)
            ->name('Supper Admin')
            ->email('admin@admin.com')
            ->password('123456')
            ->isAdmin(1)
            ->create();
    
            User::factory(1)
            ->name('Supper Member')
            ->email('member@member.com')
            ->password('123456')
            ->isAdmin(0)
            ->create();

            Book::factory(1)->create();
            Reader::factory(1)->create();
        }
        
    }
}
