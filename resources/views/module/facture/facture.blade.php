<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            border-radius: 12px;
            overflow: hidden;
        }

        .header {
            text-align: center;
            font-size: 36px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .separator {
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 30px;
        }

        .info-top {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .invoice-info,
        .client-info {
            font-size: 16px;
            color: #7b7b7b;
            flex: 1;
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .client-info {
            text-align: right;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .products-table th,
        .products-table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #e2e8f0;
        }

        .products-table th {
            background-color: #f1f5f9;
            color: #2c3e50;
            font-weight: 600;
        }

        .products-table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .summary {
            display: flex;
            font-size: 20px;
            font-weight: 600;
            color: #333;
            text-align: right;
            margin: 7px
        }

        .summary .label {
            font-weight: bold;
            color: #2c3e50;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #7b7b7b;
        }

        .footer-message {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            E-FACTURA
        </div>

        <div class="separator"></div>

        <div class="info-top">
            <div class="invoice-info">
                <p>Fecha: {{ $bill->created_at->format('d/m/Y') }}</p>
                <p>Número de Factura: {{ $bill->id }}</p>
            </div>

            <div class="client-info">
                <p><strong>Cliente:</strong> {{ $client->name_client }}</p>
                <p><strong>Número de Identidad:</strong> {{ $client->number_identity }}</p>
                <p><strong>Teléfono:</strong> {{ $client->phone_client }}</p>
            </div>
        </div>

        <table class="products-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre del Producto</th>
                    <th>Cantidad</th>
                    <th>Valor Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->product->code_product }}</td>
                        <td>{{ $order->product->name_product }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>{{ $order->product->price_product }}</td>
                        <td>${{ number_format($order->total_price, 3) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <p><span class="label">Total:</span> ${{ number_format($totalValue, 3) }}</p>
        </div>

        <div class="footer-message">
            Todos los cheques se extenderán a nombre de E-Factura Col
        </div>

        <div class="footer-message">
            Gracias por tu confianza
        </div>

        <div class="footer">
            <p>Gracias por su compra. ¡Nos alegra servirle!</p>
        </div>
    </div>
</body>

</html>
