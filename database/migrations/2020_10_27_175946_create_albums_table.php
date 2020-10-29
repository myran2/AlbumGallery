<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist');
            $table->unique(['title', 'artist']);
            $table->string('image');
            $table->timestamps();
        });

        DB::table('albums')->insert(array(
            array(
                "title" => "Morbid Stuff",
                "artist" => "Pup",
                "image" => "9OocwsRGEITbaCmom6G1YWO8KyVNvldkm1fuGec8.jpeg",
            ),
            array(
                "title" => "10",
                "artist" => "Tricot",
                "image" => "asWQbotBOs5jHGnqZRezNn33c8QsTQvRcfHcwPbh.jpeg",
            ),
            array(
                "title" => "No Drum and Bass in the Jazz Room",
                "artist" => "Clever Girl",
                "image" => "D8OBN2IarKOsKyiBfWdL0saGcOllFAHecAG7ZXtl.jpeg",
            ),
            array(
                "title" => "Lift Your Skinny Fists Like Antennas to Heaven",
                "artist" => "Godspeed You! Black Emperor",
                "image" => "fUQl7D6tU4DrAmT3BgRBgkS710sFm7rEQw9tRtZc.jpeg",
            ),
            array(
                "title" => "Happiness",
                "artist" => "Dance Gavin Dance",
                "image" => "nEQ8OzE3XUQOBdeuYGDFnPT9ZicAGS9d1Z2c6raZ.jpeg",
            ),
            array(
                "title" => "Holy Ghost",
                "artist" => "Modern Baseball",
                "image" => "ru6ini4b95n2Pcg7x56LO94poh1ttR6sPPEyNZG7.jpeg",
            ),
            array(
                "title" => "Run",
                "artist" => "Prawn",
                "image" => "VGWHkrWiuEpc89ZJQR6r7DD3UO43BRmPkhOfXpWP.jpeg",
            ),
            array(
                "title" => "Parting the Sea Between Brightness and Me",
                "artist" => "Touché Amoré",
                "image" => "WBzsnSDzHmNTAC85ogTjclv5KuHRlItJs3ZDtHcA.jpeg",
            ),
            array(
                "title" => "Program Music II",
                "artist" => "Kashiwa Daisuke",
                "image" => "Y3YsRC0ko2RdA0GcZ7rALKGD5QvynzGUaXISi15J.jpeg",
            ),
            array(
                "title" => "Worry",
                "artist" => "Jeff Rosenstock",
                "image" => "yucIf2UXiOrvx1BpniG32nPHaOJaUG8V6iLk9uNL.jpeg",
            ),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
