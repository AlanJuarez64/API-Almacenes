<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de Datos de Almacenes</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Inventario de Almacén</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Lote</th>
                    <th>Producto</th>
                </tr>
            </thead>
            <tbody id="tabla-almacenes">
                <!-- Aquí se generarán las filas con datos de la API -->
            </tbody>
        </table>
    </main>
    <footer>
        <p>© 2023 QUICKCARRY. Todos los derechos reservados.</p>
    </footer>

    <script>
        // Hacer una solicitud GET a la API
        fetch('')
            .then(response => response.json())
            .then(data => {
                const tablaDeAlmacenes = document.getElementById('tabla-almacenes');

                // Generar filas para cada almacén en la tabla
                data.forEach(almacen => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${almacen.id}</td>
                        <td>${almacen.lote}</td>
                        <td>${almacen.producto}</td>
                    `;
                    tablaDeAlmacenes.appendChild(row);
                });
            })
            .catch(error => console.error('Error al obtener los datos de la API:', error));
    </script>
</body>

</html>