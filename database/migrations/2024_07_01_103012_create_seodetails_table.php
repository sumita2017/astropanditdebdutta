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
        Schema::create('seodetails', function (Blueprint $table) {
            $table->id();
            //page name like service, aboutus, home
            $table->string('page');
            //if page is related to any id like service id, blog id
            $table->integer('relatedid')->default('0');
            $table->longText('title');
            $table->longText('keyword');
            $table->longText('description');
            $table->longText('metadata');
            $table->timestamps();
        });

        DB::table('seodetails')
            ->insert(array(
                array(
                    'page' => "home",
                    'relatedid' => "0",
                    'title' => 'This is a home page of astro achariya debdutta website',
                    'keyword' => 'Best Astrologer in India | Kundli | Consultation - Astro Achariya Debdutta',
                    'description' => "Astro Achariya debdutta is Best astrologer in India. Get Kundli report, consultation, courses in astrology, numerology &amp; vastu.",
                    'metadata' => json_encode(array('<meta property="og:url" content="https://astroachariyadebdutta.com/" />'))
                ),
                array(
                    'page' => "appointment",
                    'relatedid' => "0",
                    'title' => 'This is a home page of astro achariya debdutta website',
                    'keyword' => 'Best Astrologer in India | Kundli | Consultation - Astro Achariya Debdutta',
                    'description' => "Astro Achariya debdutta is Best astrologer in India. Get Kundli report, consultation, courses in astrology, numerology &amp; vastu.",
                    'metadata' => json_encode(array('<meta property="og:url" content="https://astroachariyadebdutta.com/" />'))
                ),
                array(
                    'page' => "chambers",
                    'relatedid' => "0",
                    'title' => 'This is a Chamber detail page of astro achariya debdutta website',
                    'keyword' => 'Best Astrologer in India | Kundli | Consultation - Astro Achariya Debdutta',
                    'description' => "Astro Achariya debdutta is Best astrologer in India. Get Kundli report, consultation, courses in astrology, numerology &amp; vastu.here is the chambers where you can visit Astro Achariya debdutta ",
                    'metadata' => json_encode(array('<meta property="og:url" content="https://astroachariyadebdutta.com/chambers" />'))
                ),
                array(
                    'page' => "aboutus",
                    'relatedid' => "0",
                    'title' => 'This is a About us page of astro achariya debdutta website',
                    'keyword' => 'Best Astrologer in India | Kundli | Consultation - Astro Achariya Debdutta',
                    'description' => "Astro Achariya debdutta is Best astrologer in India. Get Kundli report, consultation, courses in astrology, numerology &amp; vastu.Here you can know about Astro Achariya debdutta",
                    'metadata' => json_encode(array('<meta property="og:url" content="https://astroachariyadebdutta.com/aboutus" />'))
                ),
                array(
                    'page' => "contactus",
                    'relatedid' => "0",
                    'title' => 'This is a home page of astro achariya debdutta website',
                    'keyword' => 'Best Astrologer in India | Kundli | Consultation - Astro Achariya Debdutta',
                    'description' => "Astro Achariya debdutta is Best astrologer in India. Get Kundli report, consultation, courses in astrology, numerology &amp; vastu.",
                    'metadata' => json_encode(array('<meta property="og:url" content="https://astroachariyadebdutta.com/contactus" />'))
                ),
                array(
                    'page' => "terms_conditions",
                    'relatedid' => "0",
                    'title' => 'This is a home page of astro achariya debdutta website',
                    'keyword' => 'Best Astrologer in India | Kundli | Consultation - Astro Achariya Debdutta',
                    'description' => "Astro Achariya debdutta is Best astrologer in India. Get Kundli report, consultation, courses in astrology, numerology &amp; vastu.",
                    'metadata' => json_encode(array('<meta property="og:url" content="https://astroachariyadebdutta.com/terms_conditions" />'))
                ),
                array(
                    'page' => "privacy_policy",
                    'relatedid' => "0",
                    'title' => 'This is a home page of astro achariya debdutta website',
                    'keyword' => 'Best Astrologer in India | Kundli | Consultation - Astro Achariya Debdutta',
                    'description' => "Astro Achariya debdutta is Best astrologer in India. Get Kundli report, consultation, courses in astrology, numerology &amp; vastu.",
                    'metadata' => json_encode(array('<meta property="og:url" content="https://astroachariyadebdutta.com/privacy_policy" />'))
                ),
                array(
                    'page' => "refund_policy",
                    'relatedid' => "0",
                    'title' => 'This is a home page of astro achariya debdutta website',
                    'keyword' => 'Best Astrologer in India | Kundli | Consultation - Astro Achariya Debdutta',
                    'description' => "Astro Achariya debdutta is Best astrologer in India. Get Kundli report, consultation, courses in astrology, numerology &amp; vastu.",
                    'metadata' => json_encode(array('<meta property="og:url" content="https://astroachariyadebdutta.com/refund_policy" />'))
                ),
                array(
                    'page' => "shipping_policy",
                    'relatedid' => "0",
                    'title' => 'This is a home page of astro achariya debdutta website',
                    'keyword' => 'Best Astrologer in India | Kundli | Consultation - Astro Achariya Debdutta',
                    'description' => "Astro Achariya debdutta is Best astrologer in India. Get Kundli report, consultation, courses in astrology, numerology &amp; vastu.",
                    'metadata' => json_encode(array('<meta property="og:url" content="https://astroachariyadebdutta.com/shipping_policy" />'))
                )
            ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seodetails');
    }
};
