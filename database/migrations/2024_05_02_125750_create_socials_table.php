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
        Schema::create('socials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('icon')->nullable();
            $table->enum('visibility', ['0', '1'])->comment('0=hide, 1=show');
            $table->timestamps();
        });

        DB::table('socials')
            ->insert(array(
                array('name' => "Facebook", 'url' => "", 'icon' => '<i class="fa-brands fa-facebook fa-xl" style="color: #0f4b99; font-size:30px;"></i>', 'visibility' => "0"),
                array('name' => "Youtube", 'url' => "", 'icon' => '<i class="fa-brands fa-square-youtube fa-xl" style="color: #f00f0f; font-size:30px;"></i>', 'visibility' => "0"),
                array('name' => "WhatsApp", 'url' => "", 'icon' => '<i class="fa-brands fa-whatsapp fa-xl" style="color: #25D366; font-size:30px;" aria-hidden="true"></i>', 'visibility' => "0"),
                array('name' => "Instagram", 'url' => "", 'icon' => '<i class="fa-brands fa-instagram fa-xl" style="color: #d63384; font-size:30px;" aria-hidden="true"></i>', 'visibility' => "0"),
                array('name' => "Linkedin", 'url' => "", 'icon' => '<i class="fa-brands fa-linkedin fa-xl" style="color: #0072b1; font-size:30px;" aria-hidden="true"></i>', 'visibility' => "0"),
                array('name' => "Twitter", 'url' => "", 'icon' => '<i class="fa-brands fa-x-twitter" style="font-size:30px;" aria-hidden="true"></i>', 'visibility' => "0"),

            ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socials');
    }
};
