-- Activamos eventos
SET GLOBAL event_scheduler = ON;

-- Job(evento) programado para actualizar suscripciones automáticamente
DELIMITER //

DROP EVENT IF EXISTS marketplace.renueva_suscripciones//
CREATE EVENT marketplace.renueva_suscripciones
ON SCHEDULE
  EVERY 1 DAY
  STARTS CONCAT(CURDATE(), ' 00:00:00')   -- se ejecuta cada día a la hora señalada
DO
BEGIN
  -- Insertar en histórico las suscripciones caducadas
  INSERT INTO historial_suscripciones
    (id_suscripcion, tiempo_suscripcion, valor, fecha_suscripcion,
     id_usuario, id_usuario_ofrece)
  SELECT
    s.id_suscripcion,
    s.tiempo_suscripcion,
    s.valor,
    s.fecha_suscripcion,
    s.id_usuario,
    s.id_usuario_ofrece
  FROM suscripciones AS s
  WHERE DATE_ADD(s.fecha_suscripcion, INTERVAL s.tiempo_suscripcion MONTH) < NOW();
  -- Actualizar fecha_suscripcion para renovarlas
  UPDATE suscripciones AS s
  SET s.fecha_suscripcion = CURDATE()
  WHERE DATE_ADD(s.fecha_suscripcion, INTERVAL s.tiempo_suscripcion MONTH) < NOW();
END//

DELIMITER ;
