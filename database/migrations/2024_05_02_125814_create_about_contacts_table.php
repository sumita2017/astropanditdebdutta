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
        Schema::create('about_contacts', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('description');
            $table->longText('homedescription');
            $table->string('image')->nullable();
            $table->string('email');
            $table->string('address');
            $table->string('phone');
            $table->string('whatsapp');
            $table->timestamps();
        });

        DB::table('about_contacts')
            ->insert(array(
                array(
                    'title' => "&lt;h3 class=&quot;font-philosopher text-xl pl-3 font-bold&quot; style=&quot;text-align: left;&quot;&gt;About Me&lt;/h3&gt;
        
        &lt;h3 class=&quot;font-dancing text-[20px] leading-9 pl-3 &quot; style=&quot;text-align: left;&quot;&gt;&lt;em&gt;&lt;span style=&quot;font-size: 12pt;&quot;&gt;Namaskar!&lt;/span&gt;&lt;/em&gt;&lt;/h3&gt;",

                    'description' => "&lt;p style=&quot;text-align: center;&quot;&gt;As I extend my warm greetings, I invite you to delve into the tapestry of my life&#039;s journey. My name is Achariya Debdutta, a seasoned professional in the realms of astrology, vastu consultancy, numerology, success coaching, and authorship. With an enriching experience spanning 21 years, I&#039;ve dedicated my life to unraveling the mysteries of existence and guiding others toward a harmonious and prosperous life.&lt;/p&gt;
                    
                   
                   &lt;p style=&quot;text-align: center;&quot;&gt;&amp;nbsp;&lt;/p&gt;
                   
                   &lt;p style=&quot;text-align: center;&quot;&gt;Born and raised in the culturally rich city of Kolkata, West Bengal, my roots are deeply embedded in the spiritual essence of India.&lt;/p&gt;
                    
                   
                   &lt;p style=&quot;text-align: center;&quot;&gt;&amp;nbsp;&lt;/p&gt;
                   
                   &lt;p style=&quot;text-align: center;&quot;&gt;From the early days of my childhood, I felt a profound connection to the metaphysical aspects of life, a calling that would shape my destiny.&lt;/p&gt;
                    
                   
                   &lt;p style=&quot;text-align: center;&quot;&gt;&amp;nbsp;&lt;/p&gt;
                   
                   &lt;p class=&quot; text-gray-700 leading-relaxed&quot; style=&quot;text-align: center;&quot;&gt;In the vibrant streets of Kolkata, amidst the hustle and bustle, I discovered my spiritual inclination. The diverse experiences and the cultural mosaic of the city fuelled my curiosity, leading me to explore the intricacies of understanding the vibes of people and places. Religious practices, a cornerstone of Indian culture, became my refuge during my formative years. Prayer and meditation emerged as pillars of solace, laying the foundation for a deeper exploration of the mystical arts. My journey into astrology began with an innate intuition that guided me to explore the intricate world of predicting personalities and glimpses into the future. The pursuit of knowledge led me to focus on astrology, a discipline that continues to be a guiding light in my life.&lt;/p&gt;
                    
                   
                   &lt;p style=&quot;text-align: center;&quot;&gt;&amp;nbsp;&lt;/p&gt;
                   
                   &lt;p style=&quot;text-align: center;&quot;&gt;In addition to my spiritual pursuits, I pursued Honours in Philosophy, enriching my understanding of life&#039;s philosophical underpinnings. The integration of academic knowledge with spiritual wisdom formed the cornerstone of my approach to life. During my college years, a natural fondness for imparting knowledge led me to give tuition at a coaching academy. This effortless exchange of knowledge laid the groundwork for what brings you and me here&amp;mdash;a shared quest for bliss.&lt;/p&gt;
                    
                   
                   &lt;p style=&quot;text-align: center;&quot;&gt;&amp;nbsp;&lt;/p&gt;
                   
                   &lt;p style=&quot;text-align: center;&quot;&gt;In the grand tapestry of existence, I acknowledge God as my eternal teacher, and the Universe as my guiding force. Insights, courage, and wisdom assimilated over the years empower me to fulfill the noble purpose of spreading knowledge. My mission is to kindle hope in humanity, offering the keys to solving life&#039;s puzzles through astrology, Vastu, and palmistry. These ancient sciences, when understood and applied, unlock abundance for all.&lt;/p&gt;
                    
                   
                   &lt;p style=&quot;text-align: center;&quot;&gt;&amp;nbsp;&lt;/p&gt;
                   
                   &lt;h3 class=&quot;font-sans italic font-bold text-xl&quot; style=&quot;text-align: center;&quot;&gt;- Astro Achariya Debdutta&lt;/h3&gt;&lt;",
                    'homedescription' => "astrology",
                    'image' => '',
                    'email' => "contact@astro.com",
                    'address' => "Flat No.713, Devika Tower 6, Nehru Place, New Delhi-110019, India",
                    'phone' => "+91 XXXXXXXXXX,+91 XXXXXXXXXX",
                    'whatsapp' => "9588456324"
                ),
            ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_contacts');
    }
};
