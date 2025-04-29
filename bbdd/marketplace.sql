-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2025 a las 17:06:13
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `marketplace`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos_postales`
--

CREATE TABLE `codigos_postales` (
  `id_codigo_postal` int(11) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `municipio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `codigos_postales`
--

INSERT INTO `codigos_postales` (`id_codigo_postal`, `codigo_postal`, `municipio`) VALUES
(225, '28001', 'Madrid'),
(226, '28002', 'Madrid'),
(227, '28003', 'Madrid'),
(228, '28004', 'Madrid'),
(229, '28005', 'Madrid'),
(230, '28006', 'Madrid'),
(231, '28007', 'Madrid'),
(232, '28008', 'Madrid'),
(233, '28009', 'Madrid'),
(234, '28010', 'Madrid'),
(235, '28011', 'Madrid'),
(236, '28012', 'Madrid'),
(237, '28013', 'Madrid'),
(238, '28014', 'Madrid'),
(239, '28015', 'Madrid'),
(240, '28016', 'Madrid'),
(241, '28017', 'Madrid'),
(242, '28018', 'Madrid'),
(243, '28019', 'Madrid'),
(244, '28020', 'Madrid'),
(245, '28021', 'Madrid'),
(246, '28022', 'Madrid'),
(247, '28023', 'Madrid'),
(248, '28024', 'Madrid'),
(249, '28025', 'Madrid'),
(250, '28026', 'Madrid'),
(251, '28027', 'Madrid'),
(252, '28028', 'Madrid'),
(253, '28029', 'Madrid'),
(254, '28030', 'Madrid'),
(255, '28031', 'Madrid'),
(256, '28032', 'Madrid'),
(257, '28033', 'Madrid'),
(258, '28034', 'Madrid'),
(259, '28035', 'Madrid'),
(260, '28036', 'Madrid'),
(261, '28037', 'Madrid'),
(262, '28038', 'Madrid'),
(263, '28039', 'Madrid'),
(264, '28040', 'Madrid'),
(265, '28041', 'Madrid'),
(266, '28042', 'Madrid'),
(267, '28043', 'Madrid'),
(268, '28044', 'Madrid'),
(269, '28045', 'Madrid'),
(270, '28046', 'Madrid'),
(271, '28047', 'Madrid'),
(272, '28048', 'Madrid'),
(273, '28049', 'Madrid'),
(274, '28050', 'Madrid'),
(275, '28051', 'Madrid'),
(276, '28052', 'Madrid'),
(277, '28053', 'Madrid'),
(278, '28054', 'Madrid'),
(279, '28055', 'Madrid'),
(280, '28100', 'Alcobendas'),
(281, '28108', 'Alcobendas'),
(282, '28109', 'Alcobendas'),
(283, '28110', 'Algete'),
(284, '28119', 'Algete'),
(285, '28120', 'Algete'),
(286, '28130', 'Valdeolmos-Alalpardo'),
(287, '28140', 'Fuente el Saz de Jarama'),
(288, '28150', 'Valdetorres de Jarama'),
(289, '28160', 'Talamanca de Jarama'),
(290, '28170', 'Valdepiélagos'),
(291, '28180', 'Torrelaguna'),
(292, '28189', 'Patones'),
(293, '28190', 'Montejo de la Sierra'),
(294, '28191', 'Prádena del Rincón'),
(295, '28192', 'El Berrueco'),
(296, '28193', 'Cervera de Buitrago'),
(297, '28194', 'Robledillo de la Jara'),
(298, '28195', 'Puentes Viejas'),
(299, '28196', 'Puentes Viejas'),
(300, '28200', 'San Lorenzo de El Escorial'),
(301, '28209', 'San Lorenzo de El Escorial'),
(302, '28210', 'Valdemorillo'),
(303, '28211', 'El Escorial'),
(304, '28212', 'Navalagamella'),
(305, '28213', 'Colmenar del Arroyo'),
(306, '28214', 'Fresnedillas de la Oliva'),
(307, '28219', 'El Escorial'),
(308, '28220', 'Majadahonda'),
(309, '28221', 'Majadahonda'),
(310, '28222', 'Majadahonda'),
(311, '28223', 'Pozuelo de Alarcón'),
(312, '28224', 'Pozuelo de Alarcón'),
(313, '28229', 'Villanueva del Pardillo'),
(314, '28231', 'Las Rozas de Madrid'),
(315, '28232', 'Las Rozas de Madrid'),
(316, '28240', 'Hoyo de Manzanares'),
(317, '28248', 'Hoyo de Manzanares'),
(318, '28250', 'Torrelodones'),
(319, '28260', 'Galapagar'),
(320, '28270', 'Colmenarejo'),
(321, '28280', 'El Escorial'),
(322, '28290', 'Las Rozas de Madrid'),
(323, '28292', 'El Escorial'),
(324, '28293', 'Zarzalejo'),
(325, '28294', 'Robledo de Chavela'),
(326, '28295', 'Valdemaqueda'),
(327, '28296', 'Santa María de la Alameda'),
(328, '28297', 'Santa María de la Alameda'),
(329, '28300', 'Aranjuez'),
(330, '28310', 'Aranjuez'),
(331, '28311', 'Aranjuez'),
(332, '28312', 'Aranjuez'),
(333, '28320', 'Pinto'),
(334, '28330', 'San Martín de la Vega'),
(335, '28341', 'Valdemoro'),
(336, '28342', 'Valdemoro'),
(337, '28343', 'Valdemoro'),
(338, '28350', 'Ciempozuelos'),
(339, '28359', 'Titulcia'),
(340, '28360', 'Villaconejos'),
(341, '28370', 'Chinchón'),
(342, '28380', 'Colmenar de Oreja'),
(343, '28390', 'Belmonte de Tajo'),
(344, '28391', 'Valdelaguna'),
(345, '28400', 'Collado Villalba'),
(346, '28410', 'Manzanares el Real'),
(347, '28411', 'Moralzarzal'),
(348, '28412', 'El Boalo'),
(349, '28413', 'El Boalo'),
(350, '28420', 'Galapagar'),
(351, '28430', 'Alpedrete'),
(352, '28440', 'Guadarrama'),
(353, '28450', 'Collado Mediano'),
(354, '28460', 'Los Molinos'),
(355, '28470', 'Cercedilla'),
(356, '28479', 'Cercedilla'),
(357, '28480', 'Guadarrama'),
(358, '28490', 'Becerril de la Sierra'),
(359, '28491', 'Navacerrada'),
(360, '28492', 'El Boalo'),
(361, '28500', 'Arganda del Rey'),
(362, '28510', 'Campo Real'),
(363, '28511', 'Valdilecha'),
(364, '28512', 'Villar del Olmo'),
(365, '28514', 'Nuevo Baztán'),
(366, '28515', 'Olmeda de las Fuentes'),
(367, '28521', 'Rivas-Vaciamadrid'),
(368, '28522', 'Rivas-Vaciamadrid'),
(369, '28523', 'Rivas-Vaciamadrid'),
(370, '28524', 'Rivas-Vaciamadrid'),
(371, '28530', 'Morata de Tajuña'),
(372, '28540', 'Perales de Tajuña'),
(373, '28550', 'Tielmes'),
(374, '28560', 'Carabaña'),
(375, '28570', 'Orusco de Tajuña'),
(376, '28580', 'Ambite'),
(377, '28590', 'Villarejo de Salvanés'),
(378, '28594', 'Valdaracete'),
(379, '28595', 'Estremera'),
(380, '28596', 'Brea de Tajo'),
(381, '28597', 'Fuentidueña de Tajo'),
(382, '28598', 'Villamanrique de Tajo'),
(383, '28600', 'Navalcarnero'),
(384, '28607', 'El Álamo'),
(385, '28609', 'Sevilla la Nueva'),
(386, '28610', 'Villamanta'),
(387, '28620', 'Aldea del Fresno'),
(388, '28630', 'Villa del Prado'),
(389, '28640', 'Cadalso de los Vidrios'),
(390, '28648', 'Cadalso de los Vidrios'),
(391, '28649', 'Rozas de Puerto Real'),
(392, '28650', 'Cenicientos'),
(393, '28660', 'Boadilla del Monte'),
(394, '28668', 'Boadilla del Monte'),
(395, '28669', 'Boadilla del Monte'),
(396, '28670', 'Villaviciosa de Odón'),
(397, '28679', 'Villaviciosa de Odón'),
(398, '28680', 'San Martín de Valdeiglesias'),
(399, '28690', 'Brunete'),
(400, '28691', 'Villanueva de la Cañada'),
(401, '28692', 'Villanueva de la Cañada'),
(402, '28693', 'Quijorna'),
(403, '28694', 'Chapinería'),
(404, '28695', 'Navas del Rey'),
(405, '28696', 'Pelayos de la Presa'),
(406, '28701', 'San Sebastián de los Reyes'),
(407, '28702', 'San Sebastián de los Reyes'),
(408, '28703', 'San Sebastián de los Reyes'),
(409, '28706', 'San Sebastián de los Reyes'),
(410, '28707', 'San Sebastián de los Reyes'),
(411, '28708', 'San Sebastián de los Reyes'),
(412, '28709', 'San Sebastián de los Reyes'),
(413, '28710', 'El Molar'),
(414, '28720', 'Bustarviejo'),
(415, '28721', 'Cabanillas de la Sierra'),
(416, '28722', 'El Vellón'),
(417, '28723', 'Pedrezuela'),
(418, '28729', 'Venturada'),
(419, '28730', 'Buitrago del Lozoya'),
(420, '28737', 'Piñuécar-Gandullas'),
(421, '28739', 'Gargantilla del Lozoya y Pinilla de Buitrago'),
(422, '28740', 'Rascafría'),
(423, '28741', 'Rascafría'),
(424, '28742', 'Lozoya'),
(425, '28743', 'Canencia'),
(426, '28749', 'Alameda del Valle'),
(427, '28750', 'San Agustín del Guadalix'),
(428, '28751', 'La Cabrera'),
(429, '28752', 'Lozoyuela-Navas-Sieteiglesias'),
(430, '28753', 'Lozoyuela-Navas-Sieteiglesias'),
(431, '28754', 'Puentes Viejas'),
(432, '28755', 'Horcajo de la Sierra-Aoslos'),
(433, '28756', 'Somosierra'),
(434, '28760', 'Tres Cantos'),
(435, '28770', 'Colmenar Viejo'),
(436, '28791', 'Soto del Real'),
(437, '28792', 'Miraflores de la Sierra'),
(438, '28793', 'Miraflores de la Sierra'),
(439, '28794', 'Guadalix de la Sierra'),
(440, '28801', 'Alcalá de Henares'),
(441, '28802', 'Alcalá de Henares'),
(442, '28803', 'Alcalá de Henares'),
(443, '28804', 'Alcalá de Henares'),
(444, '28805', 'Alcalá de Henares'),
(445, '28806', 'Alcalá de Henares'),
(446, '28807', 'Alcalá de Henares'),
(447, '28810', 'Villalbilla'),
(448, '28811', 'Corpa'),
(449, '28812', 'Pezuela de las Torres'),
(450, '28813', 'Torres de la Alameda'),
(451, '28814', 'Daganzo de Arriba'),
(452, '28815', 'Fresno de Torote'),
(453, '28816', 'Camarma de Esteruelas'),
(454, '28817', 'Los Santos de la Humosa'),
(455, '28818', 'Santorcaz'),
(456, '28821', 'Coslada'),
(457, '28822', 'Coslada'),
(458, '28823', 'Coslada'),
(459, '28830', 'San Fernando de Henares'),
(460, '28840', 'Mejorada del Campo'),
(461, '28850', 'Torrejón de Ardoz'),
(462, '28860', 'Paracuellos de Jarama'),
(463, '28861', 'Paracuellos de Jarama'),
(464, '28862', 'Paracuellos de Jarama'),
(465, '28863', 'Cobeña'),
(466, '28864', 'Ajalvir'),
(467, '28880', 'Meco'),
(468, '28890', 'Loeches'),
(469, '28891', 'Velilla de San Antonio'),
(470, '28901', 'Getafe'),
(471, '28902', 'Getafe'),
(472, '28903', 'Getafe'),
(473, '28904', 'Getafe'),
(474, '28905', 'Getafe'),
(475, '28906', 'Getafe'),
(476, '28907', 'Getafe'),
(477, '28909', 'Getafe'),
(478, '28911', 'Leganés'),
(479, '28912', 'Leganés'),
(480, '28913', 'Leganés'),
(481, '28914', 'Leganés'),
(482, '28915', 'Leganés'),
(483, '28916', 'Leganés'),
(484, '28917', 'Leganés'),
(485, '28918', 'Leganés'),
(486, '28919', 'Leganés'),
(487, '28921', 'Alcorcón'),
(488, '28922', 'Alcorcón'),
(489, '28923', 'Alcorcón'),
(490, '28924', 'Alcorcón'),
(491, '28925', 'Alcorcón'),
(492, '28931', 'Móstoles'),
(493, '28932', 'Móstoles'),
(494, '28933', 'Móstoles'),
(495, '28934', 'Móstoles'),
(496, '28935', 'Móstoles'),
(497, '28936', 'Móstoles'),
(498, '28937', 'Móstoles'),
(499, '28938', 'Móstoles'),
(500, '28939', 'Arroyomolinos'),
(501, '28941', 'Fuenlabrada'),
(502, '28942', 'Fuenlabrada'),
(503, '28943', 'Fuenlabrada'),
(504, '28944', 'Fuenlabrada'),
(505, '28945', 'Fuenlabrada'),
(506, '28946', 'Fuenlabrada'),
(507, '28947', 'Fuenlabrada'),
(508, '28950', 'Moraleja de Enmedio'),
(509, '28970', 'Humanes de Madrid'),
(510, '28971', 'Griñón'),
(511, '28976', 'Batres'),
(512, '28977', 'Casarrubuelos'),
(513, '28978', 'Cubas de la Sagra'),
(514, '28979', 'Serranillos del Valle'),
(515, '28981', 'Parla'),
(516, '28982', 'Parla'),
(517, '28984', 'Parla'),
(518, '28990', 'Torrejón de Velasco'),
(519, '28991', 'Torrejón de la Calzada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `id_datos_personales` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT 'España',
  `codigo_postal` varchar(5) DEFAULT NULL,
  `iban` varchar(35) DEFAULT NULL,
  `tarjeta` varchar(20) DEFAULT NULL,
  `update_fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id_datos_personales`, `id_usuario`, `email`, `telefono`, `direccion`, `municipio`, `pais`, `codigo_postal`, `iban`, `tarjeta`, `update_fecha`) VALUES
(7, 7, 'juan@juan.es', '910005566', 'Calle lirios 2', 'Alcorcón', 'España', '28922', 'ES7621000418450200051362', NULL, NULL),
(8, 9, 'ana@ana.es', '916665544', 'Calle mariposa 8', 'Alcorcón', 'España', '28922', NULL, NULL, NULL),
(9, 10, 'ramon@ramon.es', '610225533', 'Calle Nardo 102', 'Alcorcón', 'España', '28922', NULL, '4532750123456789', NULL),
(10, 11, 'jhon@jhon.es', '650232323', 'Calle Don Ramón de la Cruz 122', 'Alcorcón', 'España', '28922', NULL, NULL, NULL),
(11, 12, 'adam@adam.com', '915223365', 'Calle de la economía S/N', 'Alcorcón', 'España', '28922', 'ES2565987452125632541256', '', '2025-01-20'),
(12, 13, 'eva@eva.com', '655789852', 'Calle Madrid 8', 'Alcorcón', 'España', '28922', '', '4532750123456999', '2025-04-05'),
(13, 14, 'nadie@nadie.com', '912223344', 'Calle del olvido 8', 'Alcorcón', 'España', '28921', 'ES7621000418450200062234', NULL, NULL),
(14, 15, 'luis@luis.es', '610571180', 'Calle Madrid 8', 'Alcorcón', 'España', '28921', '4532750123456703', '', '2025-01-18'),
(15, 16, 'rosa@rosa.es', '912225544', 'Calle Nardo 25', 'Alcorcón', 'España', '28922', 'ES7621000418450200151123', NULL, NULL),
(16, 17, 'ramona@ramona.es', '610699669', 'Calle Porto Lisboa 50', 'Madrid', 'España', '28003', 'ES7621000418450200073345', NULL, NULL),
(17, 18, 'patricio@patricio.com', '610252428', 'Calle Fondo del mar S/N', 'Madrid', 'España', '28003', NULL, NULL, NULL),
(18, 19, 'leo@leo.com', '652147896', 'Av. Filipinas 22', 'Madrid', 'España', '28003', NULL, NULL, NULL),
(19, 20, 'lili@lili.es', '6235458789', 'Calle Don Ramón de la Cruz 1', 'Madrid', 'España', '28003', 'ES7621000418450200084456', NULL, NULL),
(20, 21, 'alfa@alfa.com', '915224488', 'Calle Maestro de esgrima 1', 'Madrid', 'España', '28003', NULL, NULL, NULL),
(21, 22, 'pepe@pepe.es', '610252627', 'Calle del agua fresca 3', 'Madrid', 'España', '28015', '', '4532750123458756', '2025-01-19'),
(22, 23, 'rodri@rodri.es', '610252428', 'Calle Madrid 8', 'Alcorcón', 'España', '28921', NULL, NULL, NULL),
(24, 25, 'german@german.es', '610252525', 'Calle geranios 8', 'Alcorcón', 'España', '28921', NULL, NULL, NULL),
(27, 30, 'lolo@lolo.es', '912589632', '', 'Aranjuez', 'España', '28310', NULL, NULL, NULL),
(28, 31, 'nono@nono.es', '91254874', 'C/Perdida 122', 'Leganés', 'España', '28911', NULL, NULL, NULL),
(29, 32, 'nala@nala.es', '910065757', 'Calle Madrid 8', 'Alcorcón', 'España', '28922', NULL, NULL, NULL),
(30, 33, 'manoli@manoli.es', '915778458', 'Calle Cartagena 61', 'Madrid', 'España', '28021', NULL, NULL, NULL),
(33, 36, 'pepa@pepa.es', '912032524', 'Calle Juan Varela 9', 'Alcalá de Henares', 'España', '28802', 'ES7621000418450200095567', NULL, NULL),
(34, 37, 'romu@romu.com', '912562423', 'Calle Amatista 222', 'Alcalá de Henares', 'España', '28801', 'ES7621000418450200106678', NULL, NULL),
(35, 38, 'ramon@ramon.com', '915223634', 'Calle Arenal 23', 'Madrid', 'España', '28015', 'ES7621000418450200117789', NULL, NULL),
(36, 39, 'paca@paca.es', '915856321', 'Calle Madris 12', 'Alcorcón', 'España', '28921', 'ES7621000418450200128890', NULL, NULL),
(37, 40, 'lisa@lisa.es', '610252426', 'Calle Anarosa 23', 'Aranjuez', 'España', '28310', 'ES7621000418450200139901', NULL, NULL),
(38, 41, 'jaime@yahoo.es', '610252426', 'Calle Ventorro el Cano S/N', 'Boadilla del Monte', 'España', '28669', 'ES7621000418450200141012', NULL, NULL),
(40, 43, 'ramiro@gmail.com', '610515253', 'Calle Electricistas 15', 'Arroyomolinos', 'España', '28939', 'ES7621000418450200162234', NULL, NULL),
(41, 44, 'ros@gmail.com', '919875541', 'Calle Música Rock S/N', 'Alcorcón', 'España', '28923', 'ES7621000418450200173345', NULL, NULL),
(42, 45, 'nicasio@yahoo.es', '610585964', 'Calle Cartagena 66', 'Algete', 'España', '28119', 'ES7621000418450200184456', NULL, NULL),
(43, 46, 'isa@hotmail.com', '678552321', 'Calle Guadarrama 25', 'Guadarrama', 'España', '28440', 'ES7621000418450200195567', NULL, NULL),
(44, 47, 'helena@yahoo.com', '675414145', 'Calle Aquiles 2', 'Alcorcón', 'España', '28923', 'ES7621000418450200206678', NULL, NULL),
(45, 48, 'cris@cris.com', '654858785', 'AV. Burgos 125', 'Madrid', 'España', '28003', 'ES7621000418450200217789', NULL, NULL),
(46, 49, 'rosi@yahoo.es', '610252428', 'AV. La paz 26', 'Arganda del Rey', 'España', '28500', 'ES7621000418450200228890', '', '2025-01-17'),
(47, 50, 'ralegre@hotmail.com', '678599632', 'Calle Sagasta 128', 'Madrid', 'España', '28030', 'ES7621000418450200239901', NULL, NULL),
(48, 57, 'pepito@yahoo.es', '612548796', 'Calle Rios Rosas 33', 'Ajalvir', 'España', '28864', NULL, NULL, NULL),
(49, 58, 'ana@gmail.com', '612585759', 'Calle Lisboa 2', 'Alcorcón', 'España', '28923', 'ES7621000418450200241012', NULL, NULL),
(50, 59, 'maluises@yahoo.es', '610571180', 'Avenida de San Luis 166', 'Madrid', 'España', '28033', 'ES7621000418450200251123', NULL, NULL),
(51, 60, 'marketplacelma@customerlma.com', '9069751793', 'Calle la Prueba S/N', 'Madrid', 'España', '28003', NULL, NULL, NULL),
(52, 61, 'isabella@gmail.com', '678525859', 'Calle Pintor Rosales 14', 'Madrid', 'España', '28019', '', '9999999999999999999', '2025-01-20'),
(53, 62, 'marcoses@yahoo.com', '678956365', 'Calle Postas 32', 'Boadilla del Monte', 'España', '28668', 'ES2365478965412365478965', '', '2025-01-20'),
(54, 63, 'anton@anton.es', '623585457', 'Calle Reina Cristina 158', 'Madrid', 'España', '28048', NULL, NULL, NULL),
(55, 64, 'seve@seve.com', '612454878', 'Calle Golf 9 ', 'Boadilla del Monte', 'España', '28660', '', '4532750123456708', '2025-03-13'),
(56, 65, 'juanB@juan.com', '678445522', 'Calle río Jordan s/n', 'Algete', 'España', '28110', NULL, NULL, NULL),
(57, 66, 'jesus@jesus.com', '610252426', 'Calle cielo azul eterno, 100', 'Brea de Tajo', 'España', '28596', NULL, NULL, NULL),
(58, 67, 'leon@leon.com', '654236699', 'Calle del libro ruso nº320', 'Algete', 'España', '28120', '', '8565478996554123333', '2025-04-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_suscripciones`
--

CREATE TABLE `historial_suscripciones` (
  `id_historial` int(11) NOT NULL,
  `id_suscripcion` int(11) NOT NULL,
  `tiempo_suscripcion` int(2) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `fecha_suscripcion` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_ofrece` int(11) NOT NULL,
  `fecha_historial` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_suscripciones`
--

INSERT INTO `historial_suscripciones` (`id_historial`, `id_suscripcion`, `tiempo_suscripcion`, `valor`, `fecha_suscripcion`, `id_usuario`, `id_usuario_ofrece`, `fecha_historial`) VALUES
(1, 1, 3, 40.00, '2025-01-17', 49, 29, '2025-04-24 15:00:00'),
(2, 5, 3, 40.00, '2025-01-18', 12, 5, '2025-04-24 15:00:00'),
(3, 6, 1, 15.00, '2025-01-18', 14, 6, '2025-04-24 15:00:00'),
(4, 8, 3, 40.00, '2025-01-18', 20, 9, '2025-04-24 15:00:00'),
(5, 9, 1, 15.00, '2025-01-18', 36, 10, '2025-04-24 15:00:00'),
(6, 12, 1, 15.00, '2025-01-18', 39, 13, '2025-04-24 15:00:00'),
(7, 13, 3, 40.00, '2025-01-18', 40, 14, '2025-04-24 15:00:00'),
(8, 16, 1, 15.00, '2025-01-18', 43, 18, '2025-04-24 15:00:00'),
(9, 18, 3, 40.00, '2025-01-18', 45, 20, '2025-04-24 15:00:00'),
(10, 20, 1, 15.00, '2025-01-18', 47, 22, '2025-04-24 15:00:00'),
(11, 23, 3, 40.00, '2025-01-18', 50, 25, '2025-04-24 15:00:00'),
(12, 25, 1, 15.00, '2025-01-18', 59, 27, '2025-04-24 15:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `id_emisor` int(11) NOT NULL,
  `id_receptor` int(11) NOT NULL,
  `titulo` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `mensaje` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fecha_envio` datetime NOT NULL DEFAULT current_timestamp(),
  `leido` int(1) NOT NULL COMMENT '0 si no leído y 1 si leído',
  `id_respuesta` int(11) DEFAULT NULL COMMENT 'se relaciona con el id_mensaje de origen'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `id_emisor`, `id_receptor`, `titulo`, `mensaje`, `fecha_envio`, `leido`, `id_respuesta`) VALUES
(4, 15, 13, 'Conserjes de fincas', 'Estoy interesado en contratar este servicio. Por favor, ponte en contacto conmigo en el 610571180. Estoy disponible a cualquier hora todos los días de la semana.\r\nUn saludo.', '2025-04-11 13:58:14', 1, 0),
(5, 9, 13, 'Especialistas en Bonsáis', 'Hola, me llamo Ana y tengo un pequeño jardín de bonsáis. Estaría muy interesada en que contactases conmigo para poder llegar a un acuerdo y que me ayudes con ellos. Mi teléfono es el 678552325.\r\nMuchas gracias y un saludo.', '2025-04-11 14:00:57', 1, 0),
(7, 13, 15, 'Re: Conserjes de fincas', 'Hola Luis, de acuerdo, mañana te intento localizar y hablamos.\r\nUn saludo.', '2025-04-13 13:51:32', 1, 4),
(8, 13, 9, 'Re: Especialistas en Bonsáis', 'Hola Ana, Te llamo mañana y hablamos sobre días y precios.\r\nUn saludo.', '2025-04-13 14:13:23', 1, 0),
(9, 12, 13, 'Especialistas en Bonsáis', 'Hola, buenos días, necesitamos una persona que cuide nuestro jardín de la empresa Adam&Asociados. Llámeme al 10215148\r\nUn saludo.', '2025-04-13 14:16:29', 1, 0),
(10, 13, 12, 'Re: Especialistas en Bonsáis', 'Buenas, de acuerdo, te llamo y lo vemos.\r\nMuchas gracias y un saludo.', '2025-04-13 14:22:11', 0, 0),
(11, 12, 13, 'Re: Re: Especialistas en Bonsáis', 'Muchas gracias, Eva, espero tu llamada.\r\nUn saludo.', '2025-04-13 14:23:00', 1, 0),
(12, 15, 61, 'Fotografía paisajística', 'Estoy interesado en que me hagas un reportaje fotográfico para mi boda. Me puedes llamar por las mañana hasta las 15\'h al 612232323\r\nUn saludo.', '2025-04-13 19:46:33', 0, 0),
(13, 9, 47, 'Entrenadora a domicilio', 'Buenas, estoy interesada en recibir clases a domicilio para perder peso y estar en mejor forma. Dime cómo quedamos.\r\nUn saludo.', '2025-04-13 19:49:09', 0, 0),
(14, 9, 13, 'Jardinería en general', 'Cuando puedas me contactas para ver condiciones más precisas. Tlf: 610252426.\r\nUn saludo.', '2025-04-13 19:50:14', 1, 0),
(15, 13, 44, 'Grupo de música Rock', 'Hola Rosendo,\r\nLlámame al 91252426 y hablamos para un concierto en la sala Galileo para el mes que viene.\r\nUn abrazo.', '2025-04-13 19:52:32', 0, 0),
(16, 13, 49, 'Peluquero profesional a domicilio', 'Hola Rosario,\r\nte llamo mañana y quedamos para que vengas a casa a cortarle el pelo a Javi.\r\nUn saludo.', '2025-04-13 19:53:35', 0, 0),
(17, 15, 13, 'Re: Re: Conserjes de fincas', 'De acuerdo, cuando quieras, pero no te olvides.\r\nUn saludo.', '2025-04-13 20:26:22', 0, 7),
(18, 13, 12, 'Re: Re: Re: Especialistas en Bonsáis', 'De acuerdo, te llamo en cuanto pueda y lo vemos, gracias.', '2025-04-13 20:28:28', 0, 11),
(19, 13, 9, 'Re: Jardinería en general', 'Ok, te llamo y lo hablamos tranquilamente. Muchas gracias por tu interés. Un saludo.', '2025-04-13 20:29:03', 0, 14),
(20, 67, 13, 'Fotógrafa profesional', 'Hola, Soy León y estaría interesado en que me hicieses un reportaje fotográfico de mis trabajos de pintura. Llámame al 648525252.\r\nUn saludo.', '2025-04-22 12:35:24', 1, 0),
(21, 13, 67, 'Re: Fotógrafa profesional', 'Hola León,\r\nde acuerdo, te llamo mañana y concretamos.\r\nUn saludo.', '2025-04-22 12:37:16', 1, 20),
(22, 67, 13, 'Especialistas en Bonsáis', 'Estoy interesado en que me arreglen el jardín de mi comunidad. Soy presidente de una comunidad de vecinos con jardín de bonsáis y necesitan un arreglo. ¿Podrías ponerte en contacto conmigo para hablarlo?\r\nUn saludo.', '2025-04-22 17:03:16', 0, 0),
(23, 13, 67, 'Re: Especialistas en Bonsáis', 'De acuerdo, tenemos mucho trabajo estos días, pero me pongo en contacto contigo a lo largo de esta semana.\r\nUn saludo.', '2025-04-22 17:07:13', 1, 22),
(24, 67, 13, 'Seguridad integral', 'Buenas tardes,\nme llamó León y soy presidente de una comunidad de vecinos. Estamos interesados en su servicio de seguridad. Cuando pueda llámeme y lo hablamos.\nUn saludo.', '2025-04-22 17:22:57', 1, 0),
(25, 13, 12, 'Acuda de alarmas', 'Buenas Adam, estoy interesada en la contratación de una acuda de alarmas para mi negocio. ¿Cuándo podemos hablar? Llámame al 610252426 cuando puedas.\r\nUn saludo.', '2025-04-23 17:47:20', 0, 0),
(26, 13, 67, 'Re: Especialistas en Bonsáis', 'Buenas León,\r\nde acuerdo, un compañero mío se pondrá en breve en contacto contigo para hablarlo.\r\nUn saludo.', '2025-04-23 18:10:27', 0, 22),
(27, 12, 22, 'Ayudo a preparar exámenes a domicilio', 'Hola Pepe,\r\nme gustaría que ayudases a mi hijo con sus exámenes de la ESO. Llámame y concretamos.\r\nUn saludo.', '2025-04-23 18:21:23', 0, 0),
(28, 13, 15, 'Re: Re: Re: Conserjes de fincas', 'De acuerdo Luis, llámame y lo vemos.', '2025-04-23 18:26:40', 0, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'administrador'),
(2, 'Ofrezco servicio'),
(3, 'Busco servicio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `fecha_publicacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

CREATE TABLE `suscripciones` (
  `id_suscripcion` int(11) NOT NULL,
  `tiempo_suscripcion` int(2) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `fecha_suscripcion` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_ofrece` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `suscripciones`
--

INSERT INTO `suscripciones` (`id_suscripcion`, `tiempo_suscripcion`, `valor`, `fecha_suscripcion`, `id_usuario`, `id_usuario_ofrece`) VALUES
(1, 3, 40.00, '2025-04-24', 49, 29),
(2, 12, 140.00, '2025-01-18', 7, 1),
(3, 6, 75.00, '2025-01-18', 10, 2),
(4, 12, 140.00, '2025-01-18', 10, 4),
(5, 3, 40.00, '2025-04-24', 12, 5),
(6, 1, 15.00, '2025-04-24', 14, 6),
(7, 6, 75.00, '2025-01-18', 17, 8),
(8, 3, 40.00, '2025-04-24', 20, 9),
(9, 1, 15.00, '2025-04-24', 36, 10),
(10, 12, 140.00, '2025-01-18', 37, 11),
(11, 6, 75.00, '2025-01-18', 38, 12),
(12, 1, 15.00, '2025-04-24', 39, 13),
(13, 3, 40.00, '2025-04-24', 40, 14),
(14, 12, 140.00, '2025-01-18', 41, 15),
(15, 6, 75.00, '2025-01-18', 16, 16),
(16, 1, 15.00, '2025-04-24', 43, 18),
(17, 12, 140.00, '2025-01-18', 44, 19),
(18, 3, 40.00, '2025-04-24', 45, 20),
(19, 6, 75.00, '2025-01-18', 46, 21),
(20, 1, 15.00, '2025-04-24', 47, 22),
(21, 12, 140.00, '2025-01-18', 48, 23),
(22, 6, 75.00, '2025-01-18', 49, 24),
(23, 3, 40.00, '2025-04-24', 50, 25),
(24, 12, 140.00, '2025-01-18', 58, 26),
(25, 1, 15.00, '2025-04-24', 59, 27),
(27, 12, 140.00, '2025-01-18', 15, 30),
(29, 12, 140.00, '2025-01-18', 13, 32),
(30, 12, 140.00, '2025-01-19', 22, 33),
(31, 6, 75.00, '2025-01-20', 61, 34),
(32, 6, 75.00, '2025-01-20', 62, 35),
(33, 12, 140.00, '2025-01-20', 12, 36),
(34, 12, 140.00, '2025-03-11', 15, 31),
(36, 6, 75.00, '2025-03-13', 64, 38),
(38, 12, 140.00, '2025-03-24', 13, 40),
(39, 12, 140.00, '2025-03-24', 13, 41),
(40, 12, 140.00, '2025-03-24', 13, 42),
(41, 6, 75.00, '2025-04-05', 13, 43),
(42, 6, 75.00, '2025-04-05', 13, 44),
(44, 12, 140.00, '2025-04-22', 67, 46),
(45, 6, 75.00, '2025-04-22', 67, 47);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `password`, `fecha_registro`, `id_rol`) VALUES
(7, 'Juan', 'Listo la Isla', '$2y$10$St8ZWBTeFJ/YCqYEETAYy.zB5.bdeJwWaVaqgLxW5a5iBWSbR489S', '2024-12-24 10:09:09', 2),
(9, 'Ana', 'Botín', '$2y$10$3xvkoPAx7leh7BpYM4.0mu2n1HNBk6uiD6eoY/l9AJEBytc6t26Ti', '2024-12-24 10:15:04', 3),
(10, 'Ramón', 'Del Nido', '$2y$10$e4hkPJq/IlCQLA1GB5eZ0.mkwRsi.BxmoU.MZ1F71h2wBBxnyK.Ce', '2024-12-24 16:48:09', 2),
(11, 'Jhon', 'Smith', '$2y$10$4kIG80wNPx4vtOKEXcAuFOMJOGLFBb9hh1Ez0LWJHfDdGhxErsGde', '2024-12-24 17:00:03', 3),
(12, 'Adam', 'Smith', '$2y$10$8LOw71/U4N/SDnFJbf9yBOZnmuIHbTL4Q71ql2nqphTXChEQRyCgG', '2024-12-26 11:00:53', 2),
(13, 'Eva María', 'De los Santos Inocentes', '$2y$10$YD301244fTcABYyx3Nwji.7rRlFwpuJjFu8AI2VRhBR8k76mSTkSu', '2024-12-26 11:30:55', 2),
(14, 'Nadie', 'Importante', '$2y$10$PZv2QVGmK1lQkF.mQ6KziemRCcn1oZV9nGAA1KGkHbvRM3F5yzXz6', '2024-12-26 19:18:38', 2),
(15, 'Luis', 'Molina Aguirre', '$2y$10$bB7UNyfRXYm2NA6f105dH.9UtlfbzBanI/QiWmZ3ivwni9rmziiyy', '2024-12-27 10:55:52', 1),
(16, 'Rosa', 'María Pérez', '$2y$10$4PGYpFIJXwXE4PThScCrmeCwp.TxjNO6c96h2DxoCuUOGEF3YlA1a', '2024-12-27 11:27:20', 2),
(17, 'Ramona', 'Pechugona', '$2y$10$7VHCZ4PcEf1PA4Imv/zzeejhYxSBHwcbwR/qf26YZ4ReKK0KP.8UO', '2024-12-27 11:41:31', 2),
(18, 'Patricio', 'Estrella', '$2y$10$m4dBjQbYkDriW2kOlSu4y.9stjt56kN1.ytN8FTKWPDTEyJ/55sSO', '2024-12-27 11:45:11', 3),
(19, 'Leo', 'Leoncio', '$2y$10$.JSNNuhSQDOI9g3BxMp79.1Z5QzA.Ge97Gw94SwH.RtTxnfx9Jyoi', '2024-12-27 11:51:26', 3),
(20, 'Lili', 'Manceba', '$2y$10$cildvJzWJMZFXbRB6gC83u8CGpoRFCdpIuOFV4FPT5T4PJh8.TxdC', '2024-12-27 11:58:05', 2),
(21, 'Alfa', 'Romeo', '$2y$10$y9UnAgjSsAG9xDoxwpwvou0SBOzR7mULy.Zt86dMbGzAxosABiGTy', '2024-12-27 12:04:41', 3),
(22, 'Pepe', 'Pótamo', '$2y$10$HMtIM2oHzMxLaTnm5iwOG.ByFW3lcba7MGM0ocaLaO1v6aJJHjEH2', '2024-12-27 14:19:18', 2),
(23, 'Rodri', 'Mol Agu', '$2y$10$VKji1mAAbwahjBz/X0GXQej8GR0HgvetRK0YIRatgoJXQ6miEcNkC', '2024-12-27 18:34:00', 3),
(25, 'Germán', 'Paredes del Bosque', '$2y$10$FdI..jYQsYNdnyaYINNToelBmwnlb86k20Mb4QE2aU4UXR92dwUx2', '2025-01-05 09:44:36', 2),
(26, 'Rosa', 'María Sardá', '$2y$10$T4zWFtoykIbwsj6KCztKgeJ7rMh5L/rE8oXC2VM78ux2WG7nVWlIi', '2025-01-05 16:47:22', 3),
(27, 'Hipo', 'Potamo', '$2y$10$cCCuJ8Ewb3ETXbnSJL.I5uKEs8lCf9DQetU4V/.AO/wwErfkhJUqm', '2025-01-05 17:01:44', 3),
(28, 'Lily', 'De Cacharel', '$2y$10$uBtrqZNiwTVqZMAdX/8HS.iy6FKKCf2Av3jaSC0YEUIkVNG3HoHDC', '2025-01-05 17:29:58', 3),
(30, 'Lolo', 'Fernández de la O', '$2y$10$nV5moafVIDqF7Y2GRXCp5OwFkd3LmlbU5z3FJqz8XKrh8eSyk4EZe', '2025-01-05 17:46:49', 3),
(31, 'Nono', 'Pérez Mol', '$2y$10$VWz1YKCXbEP7iShJXdOHv.6Cgj66r4tiOgtIXu79cHAyztQZcEaEy', '2025-01-05 17:56:55', 3),
(32, 'Nala', 'Molina', '$2y$10$dg.kxj.zFzEJCV6F5mIRTOSLP.kc/BbGs4nWmPlQnfyzTHZGkKXhW', '2025-01-05 18:11:56', 3),
(33, 'Manoli', 'Calero', '$2y$10$5Ypzy716LFXDcCtdFfuoWetfQUy9qHUF1jqm2F1TuoGJImRTDKlBK', '2025-01-05 19:36:54', 3),
(36, 'Pepita', 'Jiménez', '$2y$10$YsCbKUVlsAUOiCuLRwi48OM/wIxnoPbQYlgLSvjHYEfZbuGxOW0z.', '2025-01-06 13:14:01', 2),
(37, 'Romualdo', 'García García', '$2y$10$nGyFwIEY/WdWSchIquRzkuDaVvd.YspbwljcBryzcqFwj/FU5kdW.', '2025-01-07 17:33:51', 2),
(38, 'Ramón', 'López Fernández', '$2y$10$eJmCMIf2VhdniesymlyFLupk87HS3LzfP6TcYOztEEe2gBHPrnGTO', '2025-01-07 18:43:30', 2),
(39, 'Francisca', 'Aguirre Guitiérrez', '$2y$10$YUiZi.d0DW7p7j/hfChwZOK04Wx3B6rwPfQyHoJNkjiMCoejT9kEu', '2025-01-07 18:51:55', 2),
(40, 'Lisa', 'Fernández Rojas', '$2y$10$Hq2iRNNAP9AiK6N5qnHq8.U8e3sLK17PsYoyOcAoBPezCCuFr7qAe', '2025-01-07 18:58:25', 2),
(41, 'Jaime', 'Guitiérrez Sánz', '$2y$10$y84EByras4i4Cq0s79Hr7.mpxNe9UVvHG73HoBeO/VH.CvOi918tS', '2025-01-08 14:09:14', 2),
(43, 'Ramiro', 'De Maeztu', '$2y$10$BZmT2FhzgszeThvIIBflYOiIEpne3hktQ2aiAXU2IOnoKKSEErXiW', '2025-01-11 11:16:09', 2),
(44, 'Rosendo', 'Martínez De Miguel', '$2y$10$zVk1vQP037egUuEPRrmrzO0MzCo7CHutpmze/S.aq9BE/DAkuL6dK', '2025-01-14 13:32:20', 2),
(45, 'Nicasio', 'Molina Hernández', '$2y$10$Q7bsRQkh8X1XV6l0WA65KeAubWO0TWHhaa.h5LbypzhK.fMgbkK3K', '2025-01-14 17:31:31', 2),
(46, 'Isabel', 'San Martín', '$2y$10$rDXHI7cbKIDrA6DT6FbfEOn.OlCWWDjYrAn60Vj6tPZVzhFPC6ghy', '2025-01-14 17:54:58', 2),
(47, 'Helena', 'De Troya', '$2y$10$lcdyWYMq/DNQXqy1zTwqMe0YT/pHn4Kc73Z0S9gAOFl1csZnrvJS.', '2025-01-14 19:19:35', 2),
(48, 'Cris', 'Ronaldo', '$2y$10$.9hh9p.na.jE6/46Mm/IlO0l1CiKmGxKj0Pj7VVXT6lssXtEf8692', '2025-01-14 19:23:41', 2),
(49, 'Rosario', 'Malpica de Paz', '$2y$10$83l2KTD/ecgNZ4OwgGYe2OA3/w5NChIAL8arH3Gy.GbK3rT02Bf/O', '2025-01-15 12:41:39', 2),
(50, 'Rocio', 'Alegre de la Vida', '$2y$10$c30agvWa4m8d/QIOI1tzWO1ENrOs5TWxi0vgAUAwxbaM7.LZkJmrK', '2025-01-15 17:01:57', 2),
(57, 'pepito', 'Grillo', '$2y$10$4B1mm1gEuH/wCNKmYyjgnuYFApI58eoAOoUWns3JmCz4aDS96BQkC', '2025-01-15 18:51:26', 3),
(58, 'Ana Rosa', 'María de las Mercedes', '$2y$10$K/YJjUchPaFF/rkOqHvW5utOabHK6bEK.TrBkf1auuwIhXxkJ9Rg6', '2025-01-15 18:55:36', 2),
(59, 'Luis', 'Morales Aguirre', '$2y$10$J79bqs8WXMucpbUfs3KBneFbRghgSGChApnOxJ0eHACx9DKpb6PQi', '2025-01-16 16:42:35', 2),
(60, 'Luis', 'Pruebas', '$2y$10$5lL1Tbem4tOYIOt722YLKeAXAnKTbv.DwOyECHYac8vIJ9AjXjMRS', '2025-01-19 10:30:08', 3),
(61, 'Isabella', 'Amaral del Amo', '$2y$10$i0lCBOEt3bMhpPFi/CymZ.vibIndmUqb2JyN1JZvLt18Cyay2m77m', '2025-01-20 09:36:47', 2),
(62, 'Marcos', 'De Madrid López', '$2y$10$qbMdO5DX7Ogzc2QFoL/03OxiZrAqNFVVGsLsxHrXZtfOab.vpci2W', '2025-01-20 10:33:30', 2),
(63, 'Antón', 'Maraver Aguirre', '$2y$10$uHulZSyur4Q1FDFTtAEZ../Xd.t5JrQKw0KmTM5qwI2okn8r3TajC', '2025-01-20 10:40:29', 3),
(64, 'Severiano', 'Ballesteros', '$2y$10$yv2ZLDmjlrNPnM8zx6HK2uwKZJFC2teGDUe.5wXcAzy87Kra7i95C', '2025-03-13 12:02:06', 2),
(65, 'Juan', 'El Bautista', '$2y$10$KFj13CuafxOelRb4IoQ6TOJwB5M3q04NdMSInLNaYY48F1Yg02qvy', '2025-04-06 10:24:29', 3),
(66, 'Jesús', 'de Nazaret', '$2y$10$3VzvAa6KnFaryHDwqN4FC.riotYNcmGc116Qbj3y2YSbS8Afd.0rS', '2025-04-06 11:09:38', 2),
(67, 'León', 'Tolstoi', '$2y$10$.qgT8sSaCfOSllyyeB12iOnasu.mG9uvBntD5OZFIW7X.tjGP5.jq', '2025-04-22 12:24:27', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_ofrece`
--

CREATE TABLE `usuario_ofrece` (
  `id_usuario_ofrece` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `servicio` varchar(100) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `detalle` text NOT NULL,
  `empresa` varchar(75) DEFAULT NULL,
  `imagen` varchar(255) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `precio` varchar(20) DEFAULT NULL,
  `municipio` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario_ofrece`
--

INSERT INTO `usuario_ofrece` (`id_usuario_ofrece`, `id_usuario`, `categoria`, `servicio`, `titulo`, `detalle`, `empresa`, `imagen`, `fecha`, `precio`, `municipio`) VALUES
(1, 7, 'Servicios del hogar', 'Limpieza del hogar', 'Limpieza a domicilio', 'Caballero se ofrece para hacer limpieza en domicilios, comunidades, oficinas... muy profesional y educado.\r\nPrecio: 20€/h', NULL, '/marketplace/public/files/images/limpiezaDomicilio1.jpg', '2024-12-28 09:43:50', '20.00', 'Madrid'),
(2, 10, 'Otros servicios', 'Reparación de electrodomésticos', 'Reparación de electrodomésticos en general', 'Reparamos todo tipo de aparatos electrónicos a buen precio. Acudimos a casa.', NULL, '/marketplace/public/files/images/reparaElectrodomestico1.jpg', '2024-12-28 09:43:50', '80.00', 'Alcobendas'),
(4, 10, 'Reparaciones', 'Fontanería', 'Reparación de tuberías y grifos', 'Servicios de fontanería para hogares y oficinas.', NULL, '/marketplace/public/files/images/fontanero1.jpg', '2025-01-05 00:00:00', '80.00', 'Alcobendas'),
(5, 12, 'Cuidado personal', 'Masajistas/Fisioterapeuta/Osteópata', 'Masajes relajantes y fisioterapia', 'Servicio profesional de masajes en domicilio.', NULL, '/marketplace/public/files/images/Masajista1.jpg', '2025-01-05 00:00:00', '60.00', 'El Escorial'),
(6, 14, 'Educación y formación', 'Clases particulares (matemáticas, idiomas, música, etc.)', 'Clases particulares de idiomas', 'Imparto clases de inglés y francés a todos los niveles.', NULL, '/marketplace/public/files/images/maestro1.jpg', '2025-01-05 00:00:00', '40.00', 'Majadahonda'),
(8, 17, 'Transportes y mudanzas', 'Servicios de mudanza y transporte', 'Mudanzas y transporte económico', 'Realizo mudanzas pequeñas y medianas con cuidado.', NULL, '/marketplace/public/files/images/mudanzas1.jpg', '2025-01-05 00:00:00', '120.00', 'Alcorcón'),
(9, 20, 'Otros servicios', 'Fotografía y video para eventos', 'Fotografía profesional para eventos', 'Capturo momentos especiales en bodas, cumpleaños y eventos.', NULL, '/marketplace/public/files/images/fotografo1.jpg', '2025-01-05 00:00:00', '150.00', 'Móstoles'),
(10, 36, 'Cuidado personal', 'General/todo', 'Cuidado integral de pesonas', 'Me ofrezco para cuidado de todo tipo de personas y cualquier edad. El precio es por horas...', NULL, '/marketplace/public/files/images/9788446010029.jpg', '2025-01-07 00:00:00', '20.00', 'Madrid'),
(11, 37, 'Servicios para mascotas', 'Paseo de perros', 'Paseo de cualquier animal', 'Se pasean todo tipo de animales. Soy serio y cobro poco. Toda la comunidad de Madrid, pero principalmente en Alcalá de Henares. El precio es el mismo independientemente del número de animales a pasear.', NULL, '/marketplace/public/files/images/perros_paseo.jpg', '2025-01-08 00:00:00', '25.00', 'Alcorcón'),
(12, 38, 'Servicios para mascotas', 'Paseo de perros', 'Paseo perros en moto', 'Soy un amante de los animales, en especial de los perros y creo que ellos también tienen derecho a disfrutar de las motos. Ofrezco mis servicios para pasear perros por toda la comunidad de Madrid a precios muy competitivos. Tu perro no se arrepentirá. (Máximo tres perros por paseo de 2 horas)', NULL, '/marketplace/public/files/images/perrosMoto.jpg', '2025-01-08 00:00:00', '50.00', 'Madrid'),
(13, 39, 'Servicios del hogar', 'Planchar ropa/colada', 'Plancho fenomenal y barato', 'Plancho ropa y coso, y hago la colada de forma increíble y a precios muy baratos.', NULL, '/marketplace/public/files/images/coserPlanchar.jpg', '2025-01-06 00:00:00', '22.00', 'Alcorcón'),
(14, 40, 'Servicios del hogar', 'Limpieza del hogar', 'Limpio de todo en el hogar', 'Llevo toda mi vida limpiando casas, tengo 55 años y es lo que mejor sé hacer. Me ofrezco por poco dinero 15€/h. Solo zona Aranjuez.', NULL, '/marketplace/public/files/images/lipiezaHogar1.jpg', '2025-01-07 00:00:00', '15.00', 'Aranjuez'),
(15, 41, 'Servicios del hogar', 'Limpieza del hogar', 'Ofrezco servicio de limpieza del hogar', 'Realizo limpieza profunda en casas y departamentos a muy buen precio', NULL, '/marketplace/public/files/images/servicioHogar1.jpg', '2025-01-07 00:00:00', '50.00', 'Boadilla del Monte'),
(16, 16, 'Servicios para mascotas', 'Paseo de perros', 'Paseo de perros personalizado', 'Paseo a tu mascota por parques y zonas verdes. No solo perros, también gatos, hámsteres, hurones... Especializado en paseo a cerditos.', NULL, '/marketplace/public/files/images/cerdoPasea.jpg', '2025-01-05 00:00:00', '25.00', 'Alcorcón'),
(18, 43, 'Reparaciones', 'Electricidad', 'Electricista a domicilio', 'Somos electricistas de toda la vida y damos servicio en el municipio y en toda la Comunidad de Madrid. Hacemos descuentos especiales a los vecinos de Arroyomolinos.', NULL, '/marketplace/public/files/images/electricista1pg.jpg', '2025-01-11 00:00:00', '50.00', 'Arroyomolinos'),
(19, 44, 'Otros servicios', 'Organización de eventos y celebraciones', 'Grupo de música Rock', 'Nos gusta el Rock, soy Rosendo cantante de toda la vida de los Madriles,y montamos fiestuquis por ahí para todo el que esté interesado contactar conmigo, tengo la agenda apretada, pero seguro que hago un hueco para un vecino chachi como tú.', NULL, '/marketplace/public/files/images/imagesRosendo.jpg', '2025-01-14 00:00:00', '100.00', 'Alcorcón'),
(20, 45, 'Reparaciones', 'Albañilería', 'Albañiles profesionales', 'Somos una empresa que prestamos servicios de obras integrales en toda la Comunidad de Madrid, con especial dedicación a los vecinos de Algete a los que les hacemos un 20% de descuento', 'Nicasio S.L', '/marketplace/public/files/images/albañil1.jpg', '2025-01-14 00:00:00', 'Indeterminado', 'Algete'),
(21, 46, 'Educación y formación', 'Preparación para exámenes', 'Clases a domicilio', 'Me ofrezco para dar clases particulares a niños de primaria, para cualquier asignatura. Guadarrama y alrededores.', '', '/marketplace/public/files/images/maestra1.jpg', '2025-01-14 00:00:00', '15/h', 'Guadarrama'),
(22, 47, 'Cuidado personal', 'Entrenadores personales', 'Entrenadora a domicilio', 'Entreno a personas a domicilio, precios muy competitivo. Todas las edades', 'EPforYuo', '/marketplace/public/files/images/entrenadora1.jpg', '2025-01-14 00:00:00', '35/h', 'Alcorcón'),
(23, 48, 'Reparaciones', 'Albañilería', 'Obras en general en todo Madrid', 'Trabajamos en toda la Comunidad de Madrid haciendo rehabilitaciones integrales de edificios u obras pequeñas en viviendas.', 'Cris&Son', '/marketplace/public/files/images/obrero2.jpg', '2025-01-14 00:00:00', '', 'Madrid'),
(24, 49, 'Reparaciones', 'Electricidad', 'Hacemos todo tipo de obras', 'Hacemos todo tipo de obras, especializados en temas eléctricos del hogar.', 'Todo electricidad S.L', '/marketplace/public/files/images/obrero4.jpg', '2025-01-15 00:00:00', '1.000', 'Arganda del Rey'),
(25, 50, 'Reparaciones', 'General/todo', 'Chapuzas del hogar', 'Hacemos todo tipo de chapuzas del hogar, desde montar muebles hasta reformas integrales. Solo en Madrid capital.', 'Rocio y asociados S.L', '/marketplace/public/files/images/obrero5.jpg', '2025-01-16 00:00:00', 'Indeterminado', 'Madrid'),
(26, 58, 'Reparaciones', 'Albañilería', 'Arreglamos de todo en el hogar', 'Somos una empresa con amplia experiencia en el mundo de la construcción. Precios muy competitivos con descuentos especiales para vecinos de Alcorcón', 'Alcor Hogar', '/marketplace/public/files/images/obrero3.jpg', '2025-01-15 00:00:00', 'Indeterminado', 'Alcorcón'),
(27, 59, 'Transportes y mudanzas', 'Servicios de mudanza y transporte', 'Transporte de muebles y electrodomésticos', 'Hago portes dentro de la Comunidad de Madrid, preferiblemente dentro del municipio de Madrid. Disponible a cualquier hora y día, incluso festivos.', 'Luis y Hermanos', '/marketplace/public/files/images/mudanzas.jpg', '2025-01-16 00:00:00', '100/Por porte', 'Madrid'),
(29, 49, 'Cuidado personal', 'Peluquería a domicilio', 'Peluquero profesional a domicilio', 'Peluquero profesional a domicilio muy profesional', '', '/marketplace/public/files/images/peluquero1.jpg', '2025-01-17 00:00:00', '15 y 70 €', 'Ajalvir'),
(30, 15, 'Educación y formación', 'Clases de tecnología (uso de ordenadores, software, etc.)', 'Clases de programación a domicilio baratas', 'Doy clases de programación a domicilio, especiales ofertas para vecinos de Alcorcón. Solo Comunidad de Madrid.', 'LMA', '/marketplace/public/files/images/informatico1.jpg', '2025-01-18 00:00:00', '45\'h', 'Alcorcón'),
(31, 15, 'Otros servicios', 'Asistencia informática (reparación y mantenimiento)', 'Reparación de ordenadores a domicilio', 'Reparación de ordenadores a domicilio y a cualquier hora. Todo tipo de ordenadores, tablets, móviles...', 'LMA', '/marketplace/public/files/images/informatico2.jpg', '2025-01-18 00:00:00', '250€', 'Alcorcón'),
(32, 13, 'Otros servicios', 'Fotografía y video para eventos', 'Fotógrafa profesional', 'Fotógrafa profesional desde hace 15 años. Trabajo toda la Comunidad de Madrid, pero hago descuentos especiales a los vecinos de Brunete', '', '/marketplace/public/files/images/fotografa1.jpg', '2025-01-18 00:00:00', '250€', 'Brunete'),
(33, 22, 'Educación y formación', 'Preparación para exámenes', 'Ayudo a preparar exámenes a domicilio', 'Preparo todo tipo de exámenes de secundaria, acudo a la casa o en la mía.', '', '/marketplace/public/files/images/examenes1.jpg', '2025-01-20 00:00:00', '15\'h', 'Aranjuez'),
(34, 61, 'Otros servicios', 'Fotografía y video para eventos', 'Fotografía paisajística', 'Hacemos fotorreportajes enfocados al paisaje natural o urbano. Nuestros profesionales están altamente cualificados.', 'Foto Paisajes S.A', '/marketplace/public/files/images/fotografo2.jpg', '2025-01-20 00:00:00', '100/día', 'Madrid'),
(35, 62, 'Cuidado personal', 'Entrenadores personales', 'Entreno a todo tipo de personas y edades', 'Entrenador profesional con dedicación plena desde hace 10 años. Da igual edad y estado físico, te pongo en forma en dos meses, garantizado.', 'Coach Marcos', '/marketplace/public/files/images/entrenador1.jpg', '2025-01-26 00:00:00', 'distintos precios', 'Boadilla del Monte'),
(36, 12, 'Seguridad', 'Alarmas', 'Acuda de alarmas', 'Servicio de acuda de alarmas. Conecta tu alarma a nuestra centrar y tendrás un servicio de vigilancia las 24\'h del día a un precio increíble.', 'Adam Security', '/marketplace/public/files/images/alarma01.jpg', '2025-01-20 00:00:00', '15€/h', 'Móstoles'),
(38, 64, 'Seguridad', 'Vigilantes', 'Vigilantes de seguridad 24\'h', 'Empresa de seguridad ofrece servicios de vigilancia las 24 horas del día, con precios especiales para los vecinos de Boadilla', 'SecureMad S.L', '/marketplace/public/files/images/seguridad.jpg', '2025-03-13 00:00:00', '150\'h', 'Boadilla del Monte'),
(40, 13, 'Servicios del hogar', 'Jardinería', 'Jardinería en general', 'Realizamos todo tipo de jardinería. Cuidad y mantenimiento de jardines a todo tipo, incluido bonsáis.', 'TuJardín SL', '/marketplace/public/files/images/jardineria1.jpg', '2025-03-24 00:00:00', '50\'h', 'Alcorcón'),
(41, 13, 'Servicios del hogar', 'Jardinería', 'Cuidado integral de jardines en Madrid', 'Hacemos todo tipo de trabajos de jardinería en Madrid. Consulta nuestros precios.', 'TuJardín SL', '/marketplace/public/files/images/jardineria2.jpg', '2025-03-24 00:00:00', '50\'h', 'Brunete'),
(42, 13, 'Servicios del hogar', 'Jardinería', 'Especialistas en Bonsáis', 'Cuidamos y recuperamos tu jardín de bonsáis como nunca antes lo habías imaginado. Precios especiales para vecinos de Brunete', 'TuJardín SL', '/marketplace/public/files/images/jardineria3.jpg', '2025-03-24 00:00:00', '100\'h', 'Brunete'),
(43, 13, 'Seguridad', 'Conserjes', 'Conserjes de fincas', 'Somos conserjes, conserjas y conserjos', 'YoConserja', '/marketplace/public/files/images/conserje1.jpg', '2025-03-31 00:00:00', '110\'h', 'Alcorcón'),
(44, 13, 'Seguridad', 'Vigilantes', 'Seguridad integral', 'Ofrecemos una seguridad integral en todos los sentidos a precios únicos.', 'YoConserja', '/marketplace/public/files/images/seguridad.jpg', '2025-04-05 00:00:00', '50\'h', 'Alcorcón'),
(46, 67, 'Reparaciones', 'Pintura y decoración', 'Pinto casas a precios imbatibles ', 'Somos una empresa pequeña de Algete que nos dedicamos a pintar casas, naves, empresas... Todo a precios imbatibles, contáctanos y compruébalo tú mismo.', 'Pinto que te pinto S.L', '/marketplace/public/files/images/pinto_casas1.jpg', '2025-04-22 00:00:00', '250', 'Algete'),
(47, 67, 'Reparaciones', 'Pintura y decoración', 'Pinto casas Madrid', 'Tenemos precios increíbles para pintar casas solo en el municipio de Madrid', 'Pinto que te pinto S.L', '/marketplace/public/files/images/pinto_casas2.jpg', '2025-04-22 00:00:00', '200 - 60m2', 'Madrid');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `codigos_postales`
--
ALTER TABLE `codigos_postales`
  ADD PRIMARY KEY (`id_codigo_postal`),
  ADD UNIQUE KEY `codigo_postal` (`codigo_postal`);

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`id_datos_personales`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `historial_suscripciones`
--
ALTER TABLE `historial_suscripciones`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_suscripcion` (`id_suscripcion`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `id_emisor` (`id_emisor`),
  ADD KEY `id_receptor` (`id_receptor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD PRIMARY KEY (`id_suscripcion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_usuario_ofrece` (`id_usuario_ofrece`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `usuario_ofrece`
--
ALTER TABLE `usuario_ofrece`
  ADD PRIMARY KEY (`id_usuario_ofrece`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codigos_postales`
--
ALTER TABLE `codigos_postales`
  MODIFY `id_codigo_postal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=520;

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id_datos_personales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `historial_suscripciones`
--
ALTER TABLE `historial_suscripciones`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  MODIFY `id_suscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `usuario_ofrece`
--
ALTER TABLE `usuario_ofrece`
  MODIFY `id_usuario_ofrece` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD CONSTRAINT `datos_personales_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`id_emisor`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`id_receptor`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `servicios_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD CONSTRAINT `suscripciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `suscripciones_ibfk_2` FOREIGN KEY (`id_usuario_ofrece`) REFERENCES `usuario_ofrece` (`id_usuario_ofrece`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

--
-- Filtros para la tabla `usuario_ofrece`
--
ALTER TABLE `usuario_ofrece`
  ADD CONSTRAINT `usuario_ofrece_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `renueva_suscripciones` ON SCHEDULE EVERY 1 DAY STARTS '2025-04-24 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
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
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
