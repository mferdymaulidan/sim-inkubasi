<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pelanggaran Siswa</title>
    <style>
        @page {
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 10px;
            margin-right: 10px;
        }
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; }
        h3 { text-align: center; margin-bottom: 20px; }
        p { margin:0;}
    </style>
</head>
<body>
    <img src="{{ public_path('/storage/Kop Cyber Class.jpg') }}" alt="Gambar Kop" style="width: 100%; height: auto; margin-bottom: 5px;">
<div style="margin-left: 20px; margin-right: 20px;">
    <table style="width: fit-content; border-style: none; margin-bottom: 20px;">
        <tr>
            <td>Nomor</td>
            <td> : </td>
            <td>{{ $pelanggaran->nomor_surat }}</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td> : </td>
            @if($pelanggaran->bukti)
            <td>1</td>
            @else
            <td>-</td>
            @endif
        </tr>
        <tr>
            <td>Perihal</td>
            <td> : </td>
            <td>Surat Pelanggaran Siswa</td>
        </tr>
    </table>

    <p style="margin-left: 40px;">Kepada</p>
    <p style="margin-left: 40px; margin-top:10px">{{ $pelanggaran->nama_siswa }}</p>
    <p style="margin-left: 40px;">Di Tempat</p>

    <p style="font-style: italic; margin-top: 20px;">Assalamu'alaikum Warahmatullahi Wabarakatuh</p>
    <p style="text-indent: 40px; margin-top:10px">Salam silaturrahim kami haturkan, teriring do'a semoga ananda senantiasa mendapatkan rahmat, hidayah, inayah serta ma'unah Allah SWT, sehingga dalam menjalankan aktifitas sehari-hari dapat terlaksana dengan sebaik-baiknya, Amin</p>
    <p style="text-indent: 40px; margin-top:10px">Sehubungan dengan pelanggaran yang Saudara {{ $pelanggaran->nama_siswa }} lakukan, dalam hal ini telah terbukti melakukan {{ $pelanggaran->pelanggaran }}, kami menilai Saudara telah melakukan tindakan yang melanggar tata tertib sekolah.</p>
    <p style="text-indent: 40px; margin-top:10px">Sehubungan dengan hal tersebut, Cyber Class SMK IT Asy-Syadzili memutuskan untuk memberikan sanksi berupa:</p>
    <p style="text-indent: 80px;">
        <ul style="margin-left:40px; text-indent: 20px;">
            <li>{{ $pelanggaran->hukuman }}</li>
        </ul>
    </p>
    <p style="text-indent: 40px; margin-top:10px;">Demikian surat pelanggaran ini kami sampaikan, atas perhatian Saudara kami sampaikan terima kasih.</p>
    <p style="font-style: italic; margin-top: 20px;">Wallahul Muwafiq Ila Aqwamit Thariq</p>
    <p style="font-style: italic;">Wassalamu'alaikum Warahmatullahi Wabarakatuh</p>
    <p style="text-align: right;">Pakis, {{ \Carbon\Carbon::parse($pelanggaran->tanggal_keputusan)->locale('id')->translatedFormat('d F Y') }}</p>
</div>
    <p style="text-align: center; margin-top:10px;">Mengetahui,</p>
    <table style="text-align: center; width: 100%; height: auto;">
        <tr>
            <td style="width: 50%;">Kepala SMK IT Asy-Syadzili</td>
            <td style="width: 50%;">Wali Kelas Cyber Class</td>
        </tr>
        <tr><td style="height: 80px;"></td><td style="height: 80px;"></td></tr>
        <tr>
            <td>Avi Hendratmoko, S.Kom</td>
            <td>M. Irfaur Rizki</td>
        </tr>
    </table>

    @if($pelanggaran->bukti)
    <div class="section" style="page-break-before: always;">
        <img src="{{ public_path('/storage/Kop Cyber Class.jpg') }}" alt="Gambar Kop" style="width: 100%; height: auto; margin-bottom: 5px;">
        <p>Lampiran 1</p>
        <p>Nomor : {{ $pelanggaran->nomor_surat }}</p>
        <p style="margin-top: 10px; font-weight: bold; text-align: center;">BUKTI PELANGGARAN</p>
        <div style="width: 100%; text-align: center;">
            <img src="{{ public_path('storage/pelanggaran/' . $pelanggaran->bukti) }}" alt="Bukti Pelanggaran" style="max-width: 200mm; max-height: 250mm; margin-top: 10px; align-item: center;">
        </div>
    </div>
    @endif
</body>
</html>
