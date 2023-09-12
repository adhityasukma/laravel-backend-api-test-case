<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'code'=> "JK-45",
            'title'=> "Harry Potter",
            'author'=> "J.K Rowling",
            'stock'=> 1
        ]);
        Book::create([
            'code'=> "SHR-1",
            'title'=> "A Study in Scarlet",
            'author'=> "Arthur Conan Doyle",
            'stock'=> 1
        ]);
        Book::create([
            'code'=> "TW-11",
            'title'=> "Twilight",
            'author'=> "Stephenie Meyer",
            'stock'=> 1
        ]);
        Book::create([
            'code'=> "HOB-83",
            'title'=> "The Hobbit, or There and Back Again",
            'author'=> "J.R.R. Tolkien",
            'stock'=> 1
        ]);
        Book::create([
            'code'=> "NRN-7",
            'title'=> "The Lion, the Witch and the Wardrobe",
            'author'=> "C.S. Lewis",
            'stock'=> 1
        ]);
    }
}