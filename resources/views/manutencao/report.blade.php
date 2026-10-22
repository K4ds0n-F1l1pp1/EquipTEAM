<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        h2 { text-align: center; margin-bottom: 5px; }
        .date { text-align: right; font-size: 10px; margin-bottom: 20px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>{{ $titulo }}</h2>
    <div class="date">Emitido em: {{ $date }}</div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Equipamento</th>
                <th>Descrição</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->equipamento->nome ?? 'N/A' }}</td>
                <td>{{ $item->descricao ?? 'N/A' }}</td>
                <td>{{ $item->data ?? $item->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>