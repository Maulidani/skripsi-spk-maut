<!DOCTYPE html>
<html>
<head>
    <title>PDF View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .logo {
            width: 100px; /* Adjust the width as needed */
            height: auto;
            margin-right: 20px;
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
    <div class="header">
        <div>
            <img src="path_to_logo.png" alt="Logo" class="logo">
        </div>
        <div class="address">
            Your Company Name<br>
            Street Address<br>
            City, State, Zip Code<br>
            Phone: (123) 456-7890<br>
            Email: info@example.com
        </div>
    </div>
    <p>ini adalah bla bla bla {{ $bantuan_name }}</p>
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
