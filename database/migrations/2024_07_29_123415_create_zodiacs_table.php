<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zodiacs', function (Blueprint $table) {
            $table->id();
            $table->string('zodiac_name');
            $table->string('image');
            $table->string('nature');
            $table->string('planet')->nullable();
            $table->string('colortype');
            $table->timestamps();
        });

        DB::table('zodiacs')
            ->insert(array(
                array('zodiac_name' => "Aries", 'image' => "", 'nature' => 'Fire', 'colortype' => "0"),
                array('zodiac_name' => "Taurus", 'image' => "", 'nature' => 'Earth', 'colortype' => "0"),
                array('zodiac_name' => "Gemini", 'image' => "", 'nature' => 'Air', 'colortype' => "0"),
                array('zodiac_name' => "Cancer", 'image' => "", 'nature' => 'Water', 'colortype' => "0"),
                array('zodiac_name' => "Leo", 'image' => "", 'nature' => 'Fire', 'colortype' => "0"),
                array('zodiac_name' => "Virgo", 'image' => "", 'nature' => 'Earth', 'colortype' => "0"),
                array('zodiac_name' => "Libra", 'image' => "", 'nature' => 'Air', 'colortype' => "0"),
                array('zodiac_name' => "Scorpio", 'image' => "", 'nature' => 'Water', 'colortype' => "0"),
                array('zodiac_name' => "Sagittarius", 'image' => "", 'nature' => 'Fire', 'colortype' => "0"),
                array('zodiac_name' => "Capricorn", 'image' => "", 'nature' => 'Earth', 'colortype' => "0"),
                array('zodiac_name' => "Aquarius", 'image' => "", 'nature' => 'Air', 'colortype' => "0"),
                array('zodiac_name' => "Pisces", 'image' => "", 'nature' => 'Water', 'colortype' => "0"),
            ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zodiacs');
    }
};
