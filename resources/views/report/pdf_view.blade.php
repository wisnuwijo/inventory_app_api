<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <style>
        table {
            width: 100%;
        }

        table, th, td {
            border-collapse: collapse;
            border: 1px solid black;
        }

        thead {
            background-color: rgb(202, 202, 202);
        }
    </style>
</head>
<body>
    <h1>Daftar Inventory</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach($inventory as $i)
                <tr>
                    <td>{{ $no }}.</td>
                    <td>{{ $i->name }}</td>
                    <td>{{ $i->stock }}</td>
                    <td>{{ $i->unit }}</td>
                    <td>{{ $i->note }}</td>
                </tr>
                <?php $no++ ?>
            @endforeach
        </tbody>
    </table>
</body>
</html>