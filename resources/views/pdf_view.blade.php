<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .logo {
            width: 80px; /* Adjust the width as needed */
            height: auto;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
        }

        .address {
            font-size: 14px;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td>
                <img src="images/logo_government_of_makassar.png" alt="Logo" class="logo">
            </td>
            <td class="address">
                <br>
                Dinas Perindustrian dan Perdagangan Kota Makassar<br>
                Jl. Rappocini Raya No.129-225,<br>
                Banta-Bantaeng, Kec. Rappocini,<br>
                Kota Makassar, Sulawesi Selatan 90222<br>
            </td>
        </tr>
    </table>
    <br>
    <p>Berdasarkan hasil perhitungan SPK MAUT, berikut adalah rekomendasi alternatif dari yang paling direkomendasikan (rank 1) hingga yang kurang direkomendasikan (rank berikutnya) sesuai dengan preferensi dan prioritas yang telah ditetapkan.</p>
    <h6>Bantuan : {{ $bantuan_name }}</h6>
    <h6>Dicetak : {{ $created_at }}</h6>
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Score</th>
                <th>KWB</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result as $data)
            <tr>
                <td>{{ $data['rank'] }}</td>
                <td>{{ $data['score'] }}</td>
                <td>{{ $data['name_kwb'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
