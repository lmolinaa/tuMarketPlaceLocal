function avisoEliminar(id_usuario_ofrece, id_usuario) {
    if (confirm("¿Estás seguro de que quieres eliminar esta oferta de servicio, no se realizará devolución de ningún tipo? Atención: ¡Esta acción no se puede deshacer!")) {
        window.location.href = "/marketplace/app/controllers/userController.php?id_card_delete=" + encodeURIComponent(id_usuario_ofrece) + "&action=eliminarCard&id_usuario=" + encodeURIComponent(id_usuario);
        //alert(id_usuario_ofrece + " - " + id_usuario);
    }
}