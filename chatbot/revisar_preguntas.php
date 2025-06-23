<?php
require '../vendor/autoload.php';

$client = new MongoDB\Client("mongodb+srv://rolando98alex1234:soIo8NyYxaCRr9dR@cluster0.xt7xsuv.mongodb.net/chat");
$db = $client->selectDatabase('chat');

// Búsqueda y paginación
$filtro = ['procesada' => false];
if (!empty($_GET['search'])) {
    $filtro['pregunta'] = new MongoDB\BSON\Regex($_GET['search'], 'i');
}

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 0;
$options = [
    'sort' => ['fecha' => -1],
    'skip' => $pagina * 10,
    'limit' => 10
];

$preguntasNuevas = $db->preguntas_nuevas->find($filtro, $options);
$totalPreguntas = $db->preguntas_nuevas->countDocuments($filtro);
$totalPaginas = ceil($totalPreguntas / 10);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Preguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #00A99D;
            --color-primary-dark: #00857a;
            --color-bg: #f5f7fa;
            --color-text: #333;
            --color-border: #e0e0e0;
            --color-success: #28a745;
            --color-warning: #ffc107;
            --color-danger: #dc3545;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--color-bg);
            color: var(--color-text);
            line-height: 1.6;
        }

        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--color-border);
        }

        h1 {
            color: var(--color-primary);
            margin: 0;
        }

        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-box input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid var(--color-border);
            border-radius: 6px;
            font-size: 16px;
        }

        .search-box button {
            background: var(--color-primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .search-box button:hover {
            background: var(--color-primary-dark);
        }

        .preguntas-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: var(--shadow);
            border-radius: 8px;
            overflow: hidden;
        }

        .preguntas-table th {
            background: var(--color-primary);
            color: white;
            padding: 15px;
            text-align: left;
        }

        .preguntas-table td {
            padding: 15px;
            border-bottom: 1px solid var(--color-border);
            vertical-align: top;
        }

        .preguntas-table tr:last-child td {
            border-bottom: none;
        }

        .preguntas-table tr:hover {
            background-color: rgba(0, 169, 157, 0.05);
        }

        .pregunta-text {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .pregunta-meta {
            font-size: 0.85rem;
            color: #666;
        }

        .form-respuesta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .form-respuesta input,
        .form-respuesta select {
            padding: 8px 12px;
            border: 1px solid var(--color-border);
            border-radius: 4px;
            font-size: 14px;
        }

        .form-respuesta input[type="text"] {
            flex: 1;
            min-width: 200px;
        }

        .form-respuesta select {
            min-width: 150px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition);
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background: var(--color-primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--color-primary-dark);
        }

        .btn-danger {
            background: var(--color-danger);
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            gap: 5px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 16px;
            border: 1px solid var(--color-border);
            border-radius: 4px;
            text-decoration: none;
            color: var(--color-primary);
        }

        .pagination a:hover {
            background: rgba(0, 169, 157, 0.1);
        }

        .pagination .active {
            background: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        .empty-state i {
            font-size: 50px;
            color: #ccc;
            margin-bottom: 20px;
        }

        .empty-state p {
            color: #666;
            font-size: 18px;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            background: #e9e9e9;
            color: #555;
        }

        @media (max-width: 768px) {

            .preguntas-table th,
            .preguntas-table td {
                padding: 10px;
                font-size: 14px;
            }

            .form-respuesta {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-respuesta input,
            .form-respuesta select {
                width: 100%;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-question-circle text-blue-500"></i> Preguntas Pendientes
            </h1>

            <!-- Barra de búsqueda -->
            <form method="GET" class="mb-6">
                <div class="flex">
                    <input type="text" name="search" placeholder="Buscar preguntas..."
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                        class="flex-grow px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </form>

            <!-- Lista de preguntas -->
            <?php
            $totalPreguntas = $db->preguntas_nuevas->countDocuments($filtro);
            $totalPaginas = ceil($totalPreguntas / 10);

            // Convertir el cursor a un array para poder contar y recorrerlo sin errores
            $preguntasCursor = $db->preguntas_nuevas->find($filtro, $options);
            $preguntasNuevas = iterator_to_array($preguntasCursor, false); // false = mantiene orden y no reindexa
            ?>
            <?php if (count($preguntasNuevas) > 0): ?>
                <?php foreach ($preguntasNuevas as $pregunta): ?>
                    <div class="border rounded-lg p-4 hover:bg-gray-50 transition mb-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium text-gray-800"><?= htmlspecialchars($pregunta['pregunta']) ?></p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="far fa-clock"></i>
                                    <?= date('d/m/Y H:i', $pregunta['fecha']->toDateTime()->getTimestamp()) ?>
                                    | ID Usuario: <?= substr($pregunta['usuario_id'], 0, 8) ?>...
                                </p>
                            </div>
                            <form action="marcar_procesada.php" method="POST">
                                <input type="hidden" name="id" value="<?= $pregunta['_id'] ?>">
                                <button type="submit" class="text-green-500 hover:text-green-700" title="Marcar como procesada">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </form>
                        </div>

                        <form action="../chatbot/agregar_respuestas.php" method="POST" class="mt-3 flex flex-col md:flex-row gap-2">
                            <input type="hidden" name="pregunta_id" value="<?= $pregunta['_id'] ?>">
                            <input type="hidden" name="pregunta_texto" value="<?= htmlspecialchars($pregunta['pregunta']) ?>">

                            <input type="text" name="respuesta" placeholder="Escribe la respuesta..." required
                                class="flex-grow px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

                            <select name="categoria" required
                                class="px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Categoría</option>
                                <option value="General">General</option>
                                <option value="Citas">Citas</option>
                                <option value="Emergencias">Emergencias</option>
                                <option value="Tratamientos">Tratamientos</option>
                                <option value="Precios">Precios</option>
                                <option value="Higiene">Higiene</option>
                            </select>

                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>

                <!-- Paginación -->
                <div class="mt-6 flex justify-center space-x-2">
                    <?php for ($i = 0; $i < $totalPaginas; $i++): ?>
                        <?php
                        $queryParams = $_GET;
                        $queryParams['pagina'] = $i;
                        $url = '?' . http_build_query($queryParams);
                        ?>
                        <a href="<?= $url ?>"
                            class="px-4 py-2 border rounded <?= $i === $pagina ? 'bg-blue-500 text-white' : 'text-blue-500 hover:bg-blue-100' ?>">
                            <?= $i + 1 ?>
                        </a>
                    <?php endfor; ?>
                </div>

            <?php else: ?>
                <div class="text-center py-20 bg-white rounded shadow">
                    <i class="fas fa-inbox text-5xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">No hay preguntas pendientes por procesar.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>