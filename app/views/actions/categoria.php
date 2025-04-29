<!-- Cabecera -->
<?php
    include '../../../public/plantillas/cabecera.php'; // Incluir el archivo cabecera.php
    
// Verificar si el parámetro 'categoria' está presente en la URL
if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    echo "Categoría seleccionada: " . htmlspecialchars($categoria);
} else {
    echo "No se ha seleccionado ninguna categoría.";
}
?>

<!-- Pie de página -->
<footer>
        <p>
            <?php
                include '../../../public/plantillas/pie.php';
            ?>
        </p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>