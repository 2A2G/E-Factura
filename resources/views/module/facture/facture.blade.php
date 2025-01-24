<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Factura</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8">
        <!-- Header -->
        <div class="text-center border-b pb-4 mb-6">
            <h1 class="text-2xl font-bold text-gray-700">E-Factura</h1>
            <p class="text-gray-500">Fecha: <?php echo date('d/m/Y'); ?></p>
        </div>

        <!-- Datos del Cliente -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Datos del Cliente</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600"><span class="font-medium">Tipo de Identidad:</span>das</p>
                    <p class="text-gray-600"><span class="font-medium">Número de Identidad:</span>33</p>
                    <p class="text-gray-600"><span class="font-medium">Nombre:</span> asdasd</p>
                </div>
                <div>
                    <p class="text-gray-600"><span class="font-medium">Correo Electrónico:</span> asdads</p>
                    <p class="text-gray-600"><span class="font-medium">Teléfono:</span> asds</p>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Productos</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Código</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Nombre</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Precio</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Cantidad</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ejemplo de fila, aquí se insertan los datos dinámicamente -->
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">12345</td>
                        <td class="border border-gray-300 px-4 py-2">Producto A</td>
                        <td class="border border-gray-300 px-4 py-2">$20.00</td>
                        <td class="border border-gray-300 px-4 py-2">2</td>
                        <td class="border border-gray-300 px-4 py-2">$40.00</td>
                    </tr>
                    <!-- Repetir filas según sea necesario -->
                </tbody>
            </table>
        </div>

        <!-- Resumen -->
        <div class="text-right">
            <p class="text-gray-700 text-lg"><span class="font-medium">Precio Total:</span> $100.00</p>
            <p class="text-gray-700 text-lg"><span class="font-medium">Valor a Pagar:</span> $100.00</p>
        </div>
    </div>
</body>

</html>
