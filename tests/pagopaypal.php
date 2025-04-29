<!--
https://developer.paypal.com/home/
marketplacelma@businesslma.com (lmamarketplace) - vendedor
marketplacelma@customerlma.com (luismarketplace) - comprador pass en marketplace: marketplace
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pruebas paypal</title>
  </head>
<body>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <!-- Obligatorio -->
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="marketplacelma@businesslma.com">
    <input type="hidden" name="item_name" value="Suscripción 1 mes">
    <input type="hidden" name="amount" value="10.00">
    <input type="hidden" name="currency_code" value="EUR">

    <!-- Aquí hay que poner la url cuando esté online la app -->
    <input type="hidden" name="return" value="http://localhost:8080/marketplace/tests/sucesoPago.php?pago=El pago de la suscripción se ha realizado con éxito.">
    <input type="hidden" name="cancel_return" value="http://localhost:8080/marketplace/tests/sucesoPago.php?pago=Se ha producido un error en el pago, por favor inténtelo más tarde.">

    <!-- Botón -->
    <input type="submit" value="Pagar con PayPal">
</form>
</body>
</html>
