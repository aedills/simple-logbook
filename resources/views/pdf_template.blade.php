<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        </style>
</head>
<body style="font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <strong>
        <p>Nama: {{$dataUser->nama}}</p>
    </strong>
    
    @foreach ($listTanggal as $week => $dates)
        <strong>{{ $week }}</strong>

        <table style="border-collapse: collapse; width: 100%; max-width: 600px; background-color: white; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
            <thead>
                <tr style="background-color: #4CAF50; color: white;">
                    <th style="padding: 12px; text-align: left;">Tanggal</th>
                    <th style="padding: 12px; text-align: left;">Kegiatan</th>
                    <th style="padding: 12px; text-align: left;">Deskripsi</th>
                    <th style="padding: 12px; text-align: left;">Foto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dates as $date)
                    @php
                        $formattedDate = (new DateTime($date))->format('Y-m-d');
                        $activities = $dataAktifitas->where('tanggal', $formattedDate);
                    @endphp

                    @if ($activities->isNotEmpty())
                        @foreach ($activities as $index => $activity)    
                            <tr style="border-bottom: 1px solid #ddd;">
                                @if ($index == 0)
                                    <td style="padding: 12px;" rowspan="{{ $activities->count() }}">{{ $date }}</td>
                                @endif
                                <td style="padding: 12px;">{{ $activity->judul }}</td>
                                <td style="padding: 12px;">{{ $activity->keterangan }}</td>
                                <td style="padding: 12px;">
                                    <a href="{{ url('assets/aktifitasimages/' . $activity->foto) }}">Foto</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 12px;">{{ $date }}</td>
                            <td style="padding: 12px;" colspan="3">Tidak ada kegiatan</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
                
        <div class="page-break"></div>
    @endforeach
</body>

</html>