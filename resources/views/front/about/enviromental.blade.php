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
            Apa Itu Pembela Lingkungan
            @else
            What is<br>Environmental Defender
            @endif
        </h2>
    </div>

    <!-- KANAN: Konten -->
    <div class="prose prose-sm max-w-none text-justify text-gray-800 leading-relaxed">
        @if($locale == 'id')
        <p><em>“Saya langsung ditabrak, dibacok dengan menggunakan celurit dan juga cangkul.
                Tetapi atas pertolongan Allah, saya berhasil diselamatkan dengan cara pura-pura sudah meninggal.”</em>
            petikan kesaksian Tosan, warga Desa Selok Awar-Awar, Kecamatan Pasirian, Kabupaten Lumajang, Jawa Timur,
            <a href="#" class="text-red-500 hover:text-green-700 font-medium">pada persidangan pembunuhan Salim
                Kancil</a>
            di Pengadilan Negeri Surabaya.
        </p>

        <p>Ternyata, tidak hanya pada Tosan. Empat puluhan penyerangnya tersebut lantas
            <a href="#" class="text-red-500 hover:text-green-700 font-medium">mendatangi Salim Kancil</a>, sejawat Tosan
            di desa yang sama.
            Salim Kancil yang saat itu ditemukan sedang menggendong cucunya lantas diikat dan dibawa ke Balai Desa Selok
            Awar-Awar.
            Di sana dia disiksa. Disetrum. Dipukul dengan benda-benda keras seperti batu. Salim Kancil pun meninggal.
        </p>

        <p>Naas pada 26 Desember 2015 itu dialami Tosan dan Salim Kancil karena mereka gigih menolak praktik
            pertambangan pasir di desanya.
            Selain menghabiskan persawahan warga, tambang-tambang pasir ini lingkungan desanya.
            Selok Awar-Awar memang satu dari banyak desa di kaki Gunung Semeru yang menjadi sasaran pertambangan pasir
            demi proyek-proyek pembangunan.
            Pasir dari kaki gunung ini dipakai tidak hanya untuk pembangunan sekitar atau proyek-proyek raksasa di Jawa
            Timur,
            tapi juga diekspor ke manca negara.</p>

        <p>Tosan dan Salim Kancil adalah pembela lingkungan (environmental defender). Mereka berdua, atau siapapun, yang
            secara sukarela maupun profesional
            bekerja atau beraktivitas melindungi lingkungan hidup dari eksploitasi berlebihan adalah pembela lingkungan.
            Eksploitasi lingkungan berlebihan sendiri dapat berupa berbagai bentuk, seperti pertambangan, penebangan
            hutan, reklamasi, proyek tertentu,
            dan aktivitas lainnya yang merusak lingkungan.</p>
        @else
        <p><em>“I was run over, slashed with ‘celurit’s and beaten with mattocks. But by playing dead, with Allah’s help
                I managed to survive,
                I survived by pretending to be dead.”</em> said Tosan, a resident of Selok Awar-Awar Village, Pasirian
            Subdistrict, Lumajang Regency, East Java,
            <a href="#" class="text-red-500 hover:text-green-700 font-medium">during the trial for the murder of Salim
                Kancil</a>
            at the Surabaya District Court.
        </p>

        <p>It turned out that not only Tosan was attacked. Around forty assailants later
            <a href="#" class="text-red-500 hover:text-green-700 font-medium">came for Salim Kancil</a>, Tosan’s fellow
            villager.
            Salim Kancil, who was then carrying his grandchild, was tied and taken to the Selok Awar-Awar Village Hall,
            where he was tortured, electrocuted, and beaten with hard objects like stones — until he died.
        </p>

        <p>The tragic event on December 26, 2015, happened because Tosan and Salim Kancil persistently opposed
            sand mining activities in their village. These mining operations destroyed rice fields and damaged the
            environment.
            Selok Awar-Awar, located at the foot of Mount Semeru, became one of many villages exploited for sand mining
            to
            support construction projects. The sand from this region is not only used locally but also exported abroad.
        </p>

        <p>Tosan and Salim Kancil are environmental defenders — individuals who, voluntarily or professionally,
            dedicate their work to protecting the environment from overexploitation. Such exploitation takes many forms:
            mining, deforestation, reclamation, large-scale development, and other destructive activities.</p>
        @endif
    </div>

    {{-- mobile --}}
    <div class="md:pr-10 border-b-2 md:border-b-0 md:border-r-2 border-green-900 md:hidden">
        <h2 class="text-green-900 font-extrabold text-3xl md:text-4xl leading-tight uppercase">
            @if($locale == 'id')
            SIAPA YANG DISEBUT ENVIRONMENTAL DEFENDER
            @else
            WHO DO WE LABEL ENVIRONMENTAL DEFENDER
            @endif
        </h2>
    </div>
    <!-- KIRI: Judul -->
    <div
        class="prose prose-sm max-w-none text-justify text-gray-800 leading-relaxed pr-10 md:border-b-0 md:border-r-2 border-green-900">

        @if($locale == 'id')
        <p>
            Pembela lingkungan bisa siapa saja, secara profesi, jabatan, atau keseharian.
            Pembela lingkungan dapat dilakukan pemimpin masyarakat adat, petani, nelayan, aktivis,
            mahasiswa, pengacara, jurnalis, dan sebagainya.
            Pendek kata, siapapun yang menaruh perhatian dan secara praksis melestarikan sumberdaya alam hayati
            dan menjaga keseimbangan lingkungan hidup adalah pembela lingkungan.
        </p>

        <p>
            Pembela lingkungan kerap dikelompokkan sebagai bagian dari pembela hak asasi manusia (Pembela HAM),
            yang masuk dalam kerangka perlindungan global melalui
            Deklarasi Pembela HAM (<a href="https://www.ohchr.org/en/special-procedures/sr-human-rights-defenders/declaration-human-rights-defenders#:~:text=The%20Declaration%20emphasizes%20that%20everyone,the%20human%20rights%20of%20others.">Declaration on Human Rights Defender</a>)
            yang, setelah <em>negosiasi 13 tahun</em>,
            ditetapkan oleh Majelis Umum Perserikatan Bangsa-Bangsa pada 9 Desember 1998.
        </p>
        @else
        <p>Environmental defenders can be anyone; professionals, people in office, or regular people.
            They can be customary community leaders, farmers, fisherfolk, activists, students, lawyers, journalists,
            etc.
            Basically, anyone concerned with and practicing biodiversity and natural resources conservation
            and maintaining environmental balance is an environmental defender.</p>

        <p>Environmental defenders are often categorized as human rights defenders,
            which are included in the global protection framework under the (<a href="https://www.ohchr.org/en/special-procedures/sr-human-rights-defenders/declaration-human-rights-defenders#:~:text=The%20Declaration%20emphasizes%20that%20everyone,the%20human%20rights%20of%20others.">Declaration on Human Rights Defender</a>),
            which after <a href="https://www.universal-rights.org/the-un-declaration-on-human-rights-defenders-its-history-and-drafting-process/#_ftn2">13 years of negotiations</a>, was adopted by the United Nations General Assembly on 9 December 1998.
        </p>
        @endif
    </div>

    <!-- KANAN: Konten -->
    <div class="md:pr-10 hidden md:block">
        <h2 class="text-green-900 font-extrabold text-3xl md:text-4xl leading-tight uppercase">
            @if($locale == 'id')
            SIAPA YANG DISEBUT ENVIRONMENTAL DEFENDER
            @else
            WHO DO WE LABEL ENVIRONMENTAL DEFENDER
            @endif
        </h2>
    </div>
</section>

@include('front.components.floating')

@endsection