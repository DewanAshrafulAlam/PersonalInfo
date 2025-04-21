<!DOCTYPE html>
<html>
<head>
    <title>Search Results PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        th {
            background: #f0f0f0;
        }
        img {
            max-width: 80px;
        }
    </style>
</head>
<body>
    <h2>Search Results for "{{ $query }}"</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result->id }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->designation }}</td>
                    <td>{{ $result->mobile }}</td>
                    <td>{{ $result->email }}</td>
                    <td>
                        @if($result->image)
                            <img src="{{ public_path('images/' . $result->image) }}" alt="">
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
