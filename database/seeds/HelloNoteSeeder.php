<?php

use Illuminate\Database\Seeder;

use App\Models\Note;

class HelloNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hello_note = new Note;
        $hello_note->title = 'Hello World Note';
        $hello_note->subtitle = 'Just a hello world note';
        $hello_note->content = 'Hello World!';
        $hello_note->save();
    }
}
