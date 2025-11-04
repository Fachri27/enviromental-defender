@extends('layouts.main')

@section('content')
@php
$locale = app()->getLocale();
@endphp

<section class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 md:py-16 py-20 px-6 md:px-12">
    <!-- KIRI: Judul -->
    <div class="border-b-2 md:border-b-0 md:border-r-2 border-green-900 md:pr-10">
        <h2 class="text-green-900 font-extrabold text-3xl md:text-4xl leading-tight uppercase">
            @if($locale == 'id')
            TENTANG KAMI
            @else
            ABOUT US
            @endif
        </h2>
    </div>

    <!-- KANAN: Konten -->
    <div class="prose prose-sm max-w-none text-justify text-gray-800 leading-relaxed">
        @if($locale == 'id')
        <p>Situs ini dibangun dan dikembangkan oleh <a href="https://auriga.or.id/">Auriga Nusantara</a>, sebuah lembaga yang bergerak pada isu pelestarian sumberdaya alam hayati. Sebagai lembaga yang mengedepankan objektivitas pada tema yang digelutinya, Auriga kerap bersuara kritis sehingga sangat mungkin menjadi bagian dari pembela lingkungan yang menghadapi ancaman atau tekanan.
        </p>
        @else
        <p>
            This site was created and developed by <a href="https://auriga.or.id/">Auriga Nusantara</a>, an organization involved in biodiversity and natural resources conservation issues. As an organization advancing objectivity in the themes it embraces, Auriga is frequently a critical voice, meaning it may well become one of the environmental defenders faced with threats or pressure.
        </p>
        @endif
    </div>

    {{-- mobile --}}
    <div class="md:pr-10 md:hidden border-b-2 md:border-b-0 md:border-r-2 border-green-900">
        <h2 class="text-green-900 font-extrabold text-3xl md:text-4xl leading-tight uppercase">
            @if($locale == 'id')
            APA YANG KAMI KERJAKAN
            @else
            WHAT WE DO
            @endif
        </h2>
    </div>

    <!-- KIRI: Judul -->
    <div
        class="prose prose-sm max-w-none text-justify text-gray-800 leading-relaxed pr-10 md:border-b-0 md:border-r-2 border-green-900">

        @if($locale == 'id')
        <p>
           Indonesia belum meratifikasi Deklarasi Pembela HAM. Meski di beberapa regulasi terknis tersirat, namun perlindungan hukum terhadap pembela lingkungan masih sangat lemah di Indonesia. Di sisi lain, penikmat manfaat dari bisinis pertambangan, ekspansi perkebunan, reklamasi, kehutanan, dan proyek-proyek tertentu kerap memakai cara-cara represif untuk membungkam pembela lingkungan. Sebutlah intimidasi/ancaman, kriminalisasi, penganiayaan, hingga penghilangan nyawa.
        </p>

        <p>
            Berada pada situasi seperti ini, Auriga Nusantara mendorong perbaikan regulasi dengan tujuan adanya jaminan hukum terhadap keselamatan pembela lingkungan. Menyadari bahwa prosedur dan protokol di kementerian atau lembaga negara terkait, termasuk penegak hukum, masih belum berpihak pada jaminan keamanan pembela lingkungan, Auriga Nusantara juga sedang merancang serangkaian aktivitas yang mendorong perbaikan prosedur/protokol tersebut.
        </p>
        <P>
            Menimbang lemahnya perlindungan hukum maupun kelembagaan pemerintahan, keselamatan pembela lingkungan dapat ditingkatkan melalui peningkatan kesadaran, pengetahuan, dan keterampilan terkati oleh pembela lingkungan itu sendiri. Karenanya, Auriga Nusantara secara aktif berjejaring dan bertukar pengetahuan dengan para pembela lingkungan lainnya, termasuk dengan menyusun <a href="https://auriga.or.id/cms/uploads/pdf_id/report/6/7/protokol_keamanan_faweb_1_9_id.pdf">protokol keselamatan pembela lingkungan.</a>
        </P>
        @else
        <p>
            Indonesia has yet to ratify the Declaration on Human Rights Defenders. Despite it being implied in several technical regulations, legal protection for environmental defenders remains extremely weak in Indonesia. Conversely, those enjoying benefits from mining, plantation expansion, reclamation and forestry businesses, as well as specific projects frequently use repressive means – intimidation, threats, criminalization, assaults, and even taking lives – to silence environmental defenders.
        </p>
        <p>
            Being in such a situation, Auriga Nusantara is encouraging regulatory improvements for legal assurances over the safety of environmental defenders. Aware that procedures and protocols in ministries and associated state agencies, including law enforcers, have yet to side with environmental defenders, Auriga Nusantara is in the process of designing a series of activities pushing for improvements in such procedures and protocols.
        </p>
        <p>
            Considering the weak protections afforded by the law and government institutions, environmental defender safety can be enhanced by environmental defenders themselves through pertinent awareness raising, knowledge, and skills. Accordingly, Auriga Nusantara actively networks and exchanges knowledge with other environmental defenders, including on preparing <a href="https://auriga.or.id/cms/uploads/pdf_id/report/6/7/protokol_keamanan_faweb_1_9_id.pdf">security protocols for environmental defenders.</a>
        </p>
        @endif
    </div>

    <!-- KANAN: Konten -->
    <div class="md:pr-10 hidden md:block">
        <h2 class="text-green-900 font-extrabold text-3xl md:text-4xl leading-tight uppercase">
            @if($locale == 'id')
            APA YANG KAMI KERJAKAN
            @else
            WHAT WE DO
            @endif
        </h2>
    </div>
</section>

@endsection