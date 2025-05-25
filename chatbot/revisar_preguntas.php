<?php
include 'db.php';

$sql = "SELECT * FROM preguntas_nuevas ORDER BY fecha DESC";
$result = $conn->query($sql);
?>

<h2>Preguntas Nuevas</h2>
<table border="1">
    <tr><th>Pregunta</th><th>Acción</th></tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row["pregunta"]); ?></td>
            <td>
                <form action="agregar_respuestas.php" method="POST">
                    <input type="hidden" name="pregunta" value="<?php echo htmlspecialchars($row["pregunta"]); ?>">
                    <input type="text" name="respuesta" placeholder="Escribe la respuesta">
                    <input type="text" name="categoria" placeholder="Categoría">
                    <button type="submit">Guardar</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
