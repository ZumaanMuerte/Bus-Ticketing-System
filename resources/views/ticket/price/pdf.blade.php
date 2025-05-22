<!DOCTYPE html>
<html>
<head>
    <title>Ticket Prices PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Ticket Price List</h2>
    <table>
        <thead>
            <tr>
                <th>Bus Type</th>
                <th>Bus Stop</th>
                <th>Base Fare</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $price)
                <tr>
                    <td>{{ $price->bus_type }}</td>
                    <td>{{ $price->bus_stop }}</td>
                    <td>{{ $price->base_fare }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
