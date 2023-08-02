<!DOCTYPE html>
<html>
<head>
    <title>PDF View</title>
    <style>
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
    <h1>{{ $bantuan_name }}</h1>
    <p>{{ $created_at }}</p>
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>KWB</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result as $data)
            <tr>
                <td>{{ $data['rank'] }}</td>
                <td>{{ $data['name_kwb'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
