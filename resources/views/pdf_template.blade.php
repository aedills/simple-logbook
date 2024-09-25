<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <body style="font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
        <Strong>
            <p>Nama: {{$dataUser->nama}}</p>
        </Strong>
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
                @foreach ($dataAktifitas as $data)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px;">{{$data->tanggal}}</td>
                    <td style="padding: 12px;">{{$data->judul}}</td>
                    <td style="padding: 12px;">{{$data->keterangan}}</td>
                    <td style="padding: 12px;"><a href="{{'http://127.0.0.1:8000/assets/aktifitasimages/' . $data->foto}}">Foto</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>