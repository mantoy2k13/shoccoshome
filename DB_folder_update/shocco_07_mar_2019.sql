-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2019 at 02:44 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shocconew`
--

-- --------------------------------------------------------

--
-- Table structure for table `sh_albums`
--

CREATE TABLE `sh_albums` (
  `album_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `album_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `album_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `album_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sh_albums`
--

INSERT INTO `sh_albums` (`album_id`, `user_id`, `album_name`, `album_desc`, `album_img`, `created_at`) VALUES
(1, 13, 'album', '2121', '', '2019-03-01 05:35:09'),
(4, 18, 'album', 'asdasd', '', '2019-03-01 07:56:46'),
(6, 19, 'My Album', '123', '', '2019-03-01 09:51:58'),
(7, 19, 'My Album2', 'My Album', '', '2019-03-01 09:57:33'),
(8, 14, 'album', '12312ss', '', '2019-03-05 04:11:22'),
(9, 17, 'album', '123', '', '2019-03-05 04:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `sh_book`
--

CREATE TABLE `sh_book` (
  `book_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sh_breeds`
--

CREATE TABLE `sh_breeds` (
  `breed_id` int(11) NOT NULL,
  `breed_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sh_breeds`
--

INSERT INTO `sh_breeds` (`breed_id`, `breed_name`, `cat_id`) VALUES
(1, 'Colies', 1),
(2, 'Cranes, Rails Relatives', 1),
(3, 'Cuckoos Relatives', 1),
(4, 'Game Birds - Ground Feeders', 1),
(5, 'Grebes - Lobed Toes', 1),
(6, 'Kingfisher', 1),
(7, 'Long-legged Waddling Birds', 1),
(8, 'Loons - Webbed Toes', 1),
(9, 'Nightjars Relatives', 1),
(10, 'Owls', 1),
(11, 'Parrots', 1),
(12, 'Pelicans Relatives', 1),
(13, 'Penguins', 1),
(14, 'Perching Birds', 1),
(15, 'BoPigeons Dovesmbay', 1),
(16, 'Ratites - Flightless Birds', 1),
(17, 'Shorebirds, Gulls, Auks', 1),
(18, 'Swifts Hummingbirds', 1),
(19, 'Tinamous - Ground-dwelling, Weak Fliers', 1),
(20, 'Tube-nosed Marine Birds', 1),
(21, 'Waterfowl', 1),
(22, 'Abyssinian', 2),
(23, 'American Bobtail', 2),
(24, 'American Curl', 2),
(25, 'American Ringtail', 2),
(26, 'American Shorthair', 2),
(27, 'American Wirehair', 2),
(28, 'Anatolian', 2),
(29, 'Australian Mist', 2),
(30, 'Bengal', 2),
(31, 'Birman', 2),
(32, 'Bombay', 2),
(33, 'Breed Unknown', 2),
(34, 'British Shorthair', 2),
(35, 'Burmese', 2),
(36, 'California Spangled Cat', 2),
(37, 'Chantilly', 2),
(38, 'Chartreux', 2),
(39, 'Colorpoint Shorthair', 2),
(40, 'Cornish Rex', 2),
(41, 'Devon Rex', 2),
(42, 'Domestic Long Hair', 2),
(43, 'Domestic Medium Hair', 2),
(44, 'Domestic Shorthair', 2),
(45, 'Don Hairless', 2),
(46, 'Egyptian Mau', 2),
(47, 'European Burmese', 2),
(48, 'European Shorthair', 2),
(49, 'Exotic Shorthair', 2),
(50, 'Havana Brown', 2),
(51, 'Himalayan', 2),
(52, 'Japanese Bobtail', 2),
(53, 'Javanese', 2),
(54, 'Khao Manee', 2),
(55, 'Korat', 2),
(56, 'LaPerm', 2),
(57, 'Maine Coon', 2),
(58, 'Manx', 2),
(59, 'Minskin', 2),
(60, 'Nebelung', 2),
(61, 'Norwegian Forest Cat', 2),
(62, 'Ocicat', 2),
(63, 'Oriental', 2),
(64, 'Persian', 2),
(65, 'Peterbald', 2),
(66, 'Pixie-Bob', 2),
(67, 'Ragamuffin', 2),
(68, 'Ragdoll', 2),
(69, 'Russian Blue', 2),
(70, 'Savannah', 2),
(71, 'Scottish Fold', 2),
(72, 'Selkirk Rex', 2),
(73, 'Siamese', 2),
(74, 'Siberian', 2),
(75, 'Singapura', 2),
(76, 'Snowshoe', 2),
(77, 'Sokoke', 2),
(78, 'BSomaliombay', 2),
(79, 'Sphynx', 2),
(80, 'Tiffanie', 2),
(81, 'Tonkinese', 2),
(82, 'Toyger', 2),
(83, 'Turkish Angora', 2),
(84, 'Turkish Van', 2),
(85, 'Afghan Hound', 3),
(86, 'Ainu Dog', 3),
(87, 'Airedale Terrier', 3),
(88, 'Akbash', 3),
(89, 'Akita', 3),
(90, 'Alaskan Malamute', 3),
(91, 'American Eskimo Dog', 3),
(92, 'American Foxhound', 3),
(93, 'American Pit Bull', 3),
(94, 'American Staffordshire Terrier', 3),
(95, 'American Water Spaniel', 3),
(96, 'Anatolian Shepherd Dog', 3),
(97, 'Anglo-Francais De Petite Venerie', 3),
(98, 'Appenzell Mountain Dog', 3),
(99, 'Australian Cattle Dog', 3),
(100, 'Australian Kelpie', 3),
(101, 'Australian Shepherd', 3),
(102, 'Australian Shorthaired Pinscher', 3),
(103, 'Australian Stumpy Tail Cattle Dog', 3),
(104, 'Australian Terrier', 3),
(105, 'Azawakh', 3),
(106, 'Barbet', 3),
(107, 'Basenji', 3),
(108, 'Basset Bleu Gascogne', 3),
(109, 'Basset Hound', 3),
(110, 'Beagle', 3),
(111, 'Bearded Collie', 3),
(112, 'Beauceron', 3),
(113, 'Bedlington Terrier', 3),
(114, 'Belgian Malinois', 3),
(115, 'Belgian Sheepdog', 3),
(116, 'Belgian Shepherd Groenendael', 3),
(117, 'Belgian Shepherd Laekenois', 3),
(118, 'Belgian Tervuren', 3),
(119, 'Bergamasco', 3),
(120, 'Berger Picard', 3),
(121, 'Bernese Mountain Dog', 3),
(122, 'Bichon Frise', 3),
(123, 'Biewer Yorkie', 3),
(124, 'Black and Tan Coonhound', 3),
(125, 'Black Mouth Cur', 3),
(126, 'Black Russian Terrier', 3),
(127, 'Bloodhound', 3),
(128, 'Blue Gascony Griffon', 3),
(129, 'Blue Heeler', 3),
(130, 'Blue Nose Pit Bull', 3),
(131, 'Blue Tick Coonhound', 3),
(132, 'Boerboel', 3),
(133, 'Border Collie', 3),
(134, 'Border Terrier', 3),
(135, 'Borzoi', 3),
(136, 'Boston Terrier', 3),
(137, 'Bouvier des Flandres', 3),
(138, 'Boxer', 3),
(139, 'Boykin', 3),
(140, 'Bracco Italiano', 3),
(141, 'Brazilian Terrier', 3),
(142, 'Breed Unknown', 3),
(143, 'Briard', 3),
(144, 'Brittany', 3),
(145, 'Brussels Griffon', 3),
(146, 'Bukovina Sheepdog', 3),
(147, 'Bull Terrier', 3),
(148, 'Bulldog', 3),
(149, 'Bullmastiff', 3),
(150, 'Cairn Terrier', 3),
(151, 'Canaan Dog', 3),
(152, 'Canadian Eskimo Dog', 3),
(153, 'Cane Corso', 3),
(154, 'Cardigan Welsh Corgi', 3),
(155, 'Carolina Dog', 3),
(156, 'Carpathian Sheepdog', 3),
(157, 'Caucasian Ovcharka', 3),
(158, 'Cavalier King Charles Spaniel', 3),
(159, 'Central Asian Ovcharka', 3),
(160, 'Central Asian Shepherd Dog', 3),
(161, 'Cesky Terrier', 3),
(162, 'Chart Polski', 3),
(163, 'Chesapeake Bay Retriever', 3),
(164, 'Chihuahua', 3),
(165, 'Chinese Crested', 3),
(166, 'Chinese Shar-Pei', 3),
(167, 'Chinook', 3),
(168, 'Chow Chow', 3),
(169, 'Cirneco Dell Etna', 3),
(170, 'Clumber Spaniel', 3),
(171, 'Cocker Spaniel', 3),
(172, 'Collie', 3),
(173, 'Coton de Tulear', 3),
(174, 'Curly-Coated Retriever', 3),
(175, 'Czechoslovakian Wolfdog', 3),
(176, 'Dachshund', 3),
(177, 'Dalmatian', 3),
(178, 'Dandie Dinmont Terrier', 3),
(179, 'Danish Swedish Farmdog', 3),
(180, 'Dingo', 3),
(181, 'Doberman Pinscher', 3),
(182, 'Dogo Argentino', 3),
(183, 'Dogue de Bordeaux', 3),
(184, 'Drever', 3),
(185, 'Dutch Partridge Dog', 3),
(186, 'Dutch Shepherd', 3),
(187, 'English Cocker Spaniel', 3),
(188, 'English Coonhound', 3),
(189, 'English Foxhound', 3),
(190, 'English Pointer', 3),
(191, 'English Setter', 3),
(192, 'English Shepherd', 3),
(193, 'English Springer Spaniel', 3),
(194, 'English Toy Spaniel', 3),
(195, 'English Mountain Dog', 3),
(196, 'Entelbucher', 3),
(197, 'Estonian Hound', 3),
(198, 'Estrela Mountain Dog', 3),
(199, 'Eurasier', 3),
(200, 'Feist', 3),
(201, 'Field Spaniel', 3),
(202, 'Fila Brasileiro', 3),
(203, 'Finnish Lapphund', 3),
(204, 'Finnish Spitz', 3),
(205, 'Flat-Coated Retriever', 3),
(206, 'French Brittany', 3),
(207, 'French Bulldog', 3),
(208, 'French Spaniel', 3),
(209, 'German Coolie', 3),
(210, 'German Hunt Terrier', 3),
(211, 'German Pinscher', 3),
(212, 'German Shepherd', 3),
(213, 'German Shorthaired Pointer', 3),
(214, 'German Spitz', 3),
(215, 'German Wirehaired Pointer', 3),
(216, 'Giant Schnauzer', 3),
(217, 'Glen of Imaal Terrier', 3),
(218, 'Golden Retriever', 3),
(219, 'Gordon Setter', 3),
(220, 'Grand Basset Griffon Vendeen', 3),
(221, 'Great Dane', 3),
(222, 'Great Gascony Blue', 3),
(223, 'Great Japanese Dog', 3),
(224, 'Great Pyrenees', 3),
(225, 'Greater Swiss Mountain Dog', 3),
(226, 'Greyhound', 3),
(227, 'Harrier', 3),
(228, 'Havanese', 3),
(229, 'Hovawart', 3),
(230, 'AkHungarian Wirehaired Vizslaita', 3),
(231, 'Ibizan Hound', 3),
(232, 'Icelandic Sheepdog', 3),
(233, 'Irish Red and White Setter', 3),
(234, 'Irish Setter', 3),
(235, 'Irish Terrier', 3),
(236, 'Irish Water Spaniel', 3),
(237, 'Irish Wolfhound', 3),
(238, 'Italian Greyhound', 3),
(239, 'Jack Russell Terrier', 3),
(240, 'Jagdterrier', 3),
(241, 'Japanese Chin', 3),
(242, 'Japanese Spitz', 3),
(243, 'Japanese Terrier', 3),
(244, 'Kai Ken', 3),
(245, 'Kangal Dog', 3),
(246, 'Karelian Bear Dog', 3),
(247, 'Keeshond', 3),
(248, 'Kerry Blue Terrier', 3),
(249, 'Kishu', 3),
(250, 'Komondor', 3),
(251, 'Kooikerhondje', 3),
(252, 'Korean Jindo', 3),
(253, 'Kuvasz', 3),
(254, 'Kyi Leo', 3),
(255, 'Labrador Retriever', 3),
(256, 'Lagotto Romagnolo', 3),
(257, 'Lakeland Terrier', 3),
(258, 'Lancashire Heeler', 3),
(259, 'Large Munsterlander', 3),
(260, 'Leonberger', 3),
(261, 'Lhasa Apso', 3),
(262, 'Lowchen', 3),
(263, 'Lurcher', 3),
(264, 'Maltese', 3),
(265, 'Manchester Terrier - Standard', 3),
(266, 'Manchester Terrier - Toy', 3),
(267, 'Maremma', 3),
(268, 'Mastiff', 3),
(269, 'Mastin Espanol', 3),
(270, 'McNab', 3),
(271, 'Mexican Hairless', 3),
(272, 'Miniature Australian Shepherd', 3),
(273, 'Miniature Bull Terrier', 3),
(274, 'Miniature Dachshund', 3),
(275, 'Miniature Fox Terrier', 3),
(276, 'Miniature Pinscher', 3),
(277, 'Miniature Poodle', 3),
(278, 'Miniature Schnauzer', 3),
(279, 'Miniature Spitz', 3),
(280, 'Mixed Breed', 3),
(281, 'Mountain Cur', 3),
(282, 'Mudi', 3),
(283, 'Native American Indian Dog', 3),
(284, 'Neapolitan Mastiff', 3),
(285, 'New Guinea Singing Dog', 3),
(286, 'Norfolk Terrier', 3),
(287, 'Norrbottenspets', 3),
(288, 'North American Miniature Australian', 3),
(289, 'North American Shepherd', 3),
(290, 'Norwegian Buhund', 3),
(291, 'Norwegian Lundehund', 3),
(292, 'Norwich Terrier', 3),
(293, 'Old English Sheepdog', 3),
(294, 'Otterhound', 3),
(295, 'Papillon', 3),
(296, 'Parson Russell Terrier', 3),
(297, 'Patterdale Terrier', 3),
(298, 'Pekingese', 3),
(299, 'Pembroke Welsh Corgi', 3),
(300, 'Petit Basset Griffon Vendeen', 3),
(301, 'Pharaoh Hound', 3),
(302, 'Plott', 3),
(303, 'Pointer', 3),
(304, 'Polish Lowland Sheepdog', 3),
(305, 'Pomeranian', 3),
(306, 'Poodle', 3),
(307, 'Portuguese Podengo Pequeno', 3),
(308, 'Portuguese Water Dog', 3),
(309, 'Prazsky Krysarik', 3),
(310, 'Presa Canario', 3),
(311, 'Pudelpointer', 3),
(312, 'Pug', 3),
(313, 'Puli', 3),
(314, 'Pumi', 3),
(315, 'Pyrenean Shepherd', 3),
(316, 'Rat Terrier', 3),
(317, 'Red Heeler', 3),
(318, 'Redbone Coonhound', 3),
(319, 'Redtick Coonhound', 3),
(320, 'Rhodesian Ridgeback', 3),
(321, 'Romanian Mioritic Shepherd Dog', 3),
(322, 'Rottweiler', 3),
(323, 'Running Walker Foxhound', 3),
(324, 'Russian Spaniel', 3),
(325, 'Russian Toy Terrier', 3),
(326, 'Russian-European Laika', 3),
(327, 'Ryukyu', 3),
(328, 'Saint Bernard', 3),
(329, 'Saluki', 3),
(330, 'Samoyed', 3),
(331, 'Sarloos Wolfhound', 3),
(332, 'Sato', 3),
(333, 'Schapendoes', 3),
(334, 'Schipperke', 3),
(335, 'Scottish Deerhound', 3),
(336, 'Scottish Terrier', 3),
(337, 'Sealyham Terrier', 3),
(338, 'Shetland Sheepdog', 3),
(339, 'Shiba Inu', 3),
(340, 'Shih Tzu', 3),
(341, 'Shikoku', 3),
(342, 'Shiloh Shepherd', 3),
(343, 'Siberian Husky', 3),
(344, 'Silken Windhound', 3),
(345, 'Silky Terrier', 3),
(346, 'Skye Terrier', 3),
(347, 'Smooth Fox Terrier', 3),
(348, 'Soft Coated WheatenTerrier', 3),
(349, 'Spinone Italiano', 3),
(350, 'Staffordshire Bull Terrier', 3),
(351, 'Standard Schnauzer', 3),
(352, 'Sussex Spaniel', 3),
(353, 'Swedish Vallhund', 3),
(354, 'Teddy Roosevelt Terrier', 3),
(355, 'Tenterfield Terrier', 3),
(356, 'Texas Blue Lacy', 3),
(357, 'Thai Bangkaew Dog', 3),
(358, 'Thai Ridgeback', 3),
(359, 'Tibetan Mastiff', 3),
(360, 'Tibetan Spaniel', 3),
(361, 'Tibetan Terrier', 3),
(362, 'Toy Fox Terrier', 3),
(363, 'Transylvanian Hound', 3),
(364, 'Treeing Walker Coonhound', 3),
(365, 'Valley Bulldog', 3),
(366, 'Vizsla', 3),
(367, 'Volpino Italiano', 3),
(368, 'Weimaraner', 3),
(369, 'Welsh Springer Spaniel', 3),
(370, 'Welsh Terrier', 3),
(371, 'West Highland Terrier', 3),
(372, 'Wheaten Terrier', 3),
(373, 'Whippet', 3),
(374, 'White Shepherd Dog', 3),
(375, 'Wire Fox Terrier', 3),
(376, 'Wirehaired Dachshund', 3),
(377, 'Wirehaired Pointing Griffon', 3),
(378, 'Yorkshire Terrier', 3),
(379, 'Betta Fish', 4),
(380, 'Goldfish', 4),
(381, 'Achilles Tang', 4),
(382, 'Fantail goldfish', 4),
(383, 'Siamese Fighting Fish', 4),
(384, 'Glow Light Tetra', 4),
(385, 'Red Platy', 4),
(386, 'Molly', 4),
(387, 'Common goldfish', 4),
(388, 'Angelfish', 4),
(389, 'Afra Cichlid', 4),
(390, 'Black Moor Goldfish', 4),
(391, 'Sucker-Mouth Catfish', 4),
(392, 'Neon Tetra', 4),
(393, 'Plecostomus', 4),
(394, 'Oranda', 4),
(395, 'Corydoras paleatus', 4),
(396, 'Gold Angelfish', 4),
(397, 'Butterfly Koi', 4),
(398, 'Black Balloon Molly', 4),
(399, 'Silver dollar fish', 4),
(400, 'Oscar', 4),
(401, 'Tiger Barb', 4),
(402, 'Bristlenose Pleco', 4),
(403, 'Tiger Oscar', 4),
(404, 'White Cloud Mountain Minnow', 4),
(405, 'African butter catfish', 4),
(406, 'Emerald catfish', 4),
(407, 'Dwarf Lionfish', 4),
(408, 'Rummy-nose tetra', 4),
(409, 'Gold Gourami', 4),
(410, 'Flowerhorn', 4),
(411, 'Teira Batfish', 4),
(412, 'Butterfly tail (goldfish)', 4),
(413, 'Black Phantom Tetra', 4),
(414, 'Yellow boxfish', 4),
(415, 'Gold barb', 4),
(416, 'Silver Angelfish', 4),
(417, 'Ghost Catfish', 4),
(418, 'Black Tetra', 4),
(419, 'Ruyunion', 4),
(420, 'Crystal eyed catfish', 4),
(421, 'Sarasa Comet Goldfish', 4),
(422, 'Black Molly', 4),
(423, 'Marble Molly', 4),
(424, 'Spotted Grouper', 4),
(425, 'American Rock', 4),
(426, 'Clown Fish', 4),
(427, 'African Butterfly Fish', 4),
(428, 'Green neon tetra', 4),
(429, 'Ryukin goldfish', 4),
(430, 'Gold Mickey Mouse Platy', 4),
(431, 'Red Marlboro Discus', 4),
(432, 'Yellow tang', 4),
(433, 'Albino Cory', 4),
(434, 'Bartletts anthias', 4),
(435, 'Albino Angelfish', 4),
(436, 'Guppies', 4),
(437, 'Orange chromide', 4),
(438, 'Koi Angelfish', 4),
(439, 'Scooter blenny', 4),
(440, 'Clown sailfin pleco', 4),
(441, 'Mickey Mouse Platty', 4),
(442, 'Clown barb ', 4),
(443, 'Acuelo Creole', 5),
(444, 'Akhal Teke', 5),
(445, 'Altai', 5),
(446, 'Andalusian', 5),
(447, 'Appaloosa', 5),
(448, 'Arabian', 5),
(449, 'Australian Brumby', 5),
(450, 'Australian Stock Horse', 5),
(451, 'Barb', 5),
(452, 'Boerperd', 5),
(453, 'Buckskin', 5),
(454, 'Camargue', 5),
(455, 'Canadian', 5),
(456, 'Cayuse', 5),
(457, 'Chilean Corralero', 5),
(458, 'Clydesdale', 5),
(459, 'Connemara Pony', 5),
(460, 'Criollo/Crioulo', 5),
(461, 'Fell Pony', 5),
(462, 'Friesian', 5),
(463, 'Haflinger', 5),
(464, 'Hanoverian', 5),
(465, 'Hungarian Sport Horse', 5),
(466, 'Iberian', 5),
(467, 'Icelandic', 5),
(468, 'Kisber Felver', 5),
(469, 'Lipizzan', 5),
(470, 'Lusitano', 5),
(471, 'Mangalarga Marchador', 5),
(472, 'Maremmano', 5),
(473, 'Marwari', 5),
(474, 'Missouri Fox Trotting', 5),
(475, 'Mongolian', 5),
(476, 'Morgan', 5),
(477, 'Mustang', 5),
(478, 'Paint', 5),
(479, 'Paso Fino', 5),
(480, 'Peruvian Paso', 5),
(481, 'Pinto', 5),
(482, 'Przewalski', 5),
(483, 'Quarter Horse', 5),
(484, 'Rocky Mountain Horse', 5),
(485, 'Saddlebred', 5),
(486, 'Selle Francais', 5),
(487, 'Shagya', 5),
(488, 'Spanish', 5),
(489, 'Tennessee Walking', 5),
(490, 'Thoroughbred', 5),
(491, 'Trakehner', 5),
(492, 'Welsh Pony and Cob', 5),
(493, 'Anole', 6),
(494, 'Ants', 6),
(495, 'Aquatic Turtle', 6),
(496, 'Bearded Dragon', 6),
(497, 'Box Turtle', 6),
(498, 'Chameleon', 6),
(499, 'Cricket', 6),
(500, 'Frog', 6),
(501, 'Gecko', 6),
(502, 'Hermit Crab', 6),
(503, 'Iguana', 6),
(504, 'Lizard', 6),
(505, 'Monitor', 6),
(506, 'Newt', 6),
(507, 'Reptile', 6),
(508, 'Salamander', 6),
(509, 'Skink', 6),
(510, 'Snake', 6),
(511, 'Tegu', 6),
(512, 'Tortoise', 6),
(513, 'Tree Frog', 6),
(514, 'Turtle', 6),
(515, 'Water Dragon', 6),
(516, 'Chinchila', 7),
(517, 'Dedgehog', 7),
(518, 'Degu', 7),
(519, 'Dwarf Hamster', 7),
(520, 'Dwarf Rabbit', 7),
(521, 'Ferret', 7),
(522, 'Gerbil', 7),
(523, 'Guinea Pig', 7),
(524, 'Hamster', 7),
(525, 'Mouse', 7),
(526, 'Other Small Pet', 7),
(527, 'Prairie Dog', 7),
(528, 'Rabbit', 7),
(529, 'Rat', 7),
(530, 'Sugar Glider', 7);

-- --------------------------------------------------------

--
-- Table structure for table `sh_category`
--

CREATE TABLE `sh_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sh_category`
--

INSERT INTO `sh_category` (`cat_id`, `cat_name`) VALUES
(1, 'Bird'),
(2, 'Cat'),
(3, 'Dog'),
(4, 'Fish'),
(5, 'Horse'),
(6, 'Reptile/Amphibian'),
(7, 'Small Animal');

-- --------------------------------------------------------

--
-- Table structure for table `sh_color`
--

CREATE TABLE `sh_color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sh_color`
--

INSERT INTO `sh_color` (`color_id`, `color_name`) VALUES
(1, 'Black'),
(2, 'Blue'),
(3, 'Brown'),
(4, 'Gray'),
(5, 'Green'),
(18, 'Bi-color'),
(19, 'Tri-color'),
(20, 'Earth'),
(21, 'Gray Tabby'),
(22, 'Orange'),
(23, 'Orange Tabby'),
(24, 'Red'),
(25, 'Silver'),
(26, 'Silver Tabby'),
(27, 'Tortoise Shell'),
(28, 'White'),
(29, 'Yellow'),
(30, 'Yellow Tabby');

-- --------------------------------------------------------

--
-- Table structure for table `sh_friends`
--

CREATE TABLE `sh_friends` (
  `f_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `friend_id` int(255) NOT NULL,
  `friend_since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sh_friends`
--

INSERT INTO `sh_friends` (`f_id`, `user_id`, `friend_id`, `friend_since`) VALUES
(1, 13, 14, '2019-02-20 03:45:22'),
(2, 14, 13, '2019-02-20 03:45:22'),
(3, 16, 15, '2019-02-21 09:38:57'),
(4, 15, 16, '2019-02-21 09:38:57'),
(5, 18, 14, '2019-02-28 11:59:20'),
(6, 14, 18, '2019-02-28 11:59:20'),
(7, 17, 14, '2019-03-01 05:36:28'),
(8, 14, 17, '2019-03-01 05:36:28'),
(9, 19, 13, '2019-03-01 09:11:34'),
(10, 13, 19, '2019-03-01 09:11:34'),
(11, 17, 13, '2019-03-02 08:24:59'),
(12, 13, 17, '2019-03-02 08:24:59'),
(13, 18, 13, '2019-03-05 13:01:36'),
(14, 13, 18, '2019-03-05 13:01:36'),
(15, 13, 20, '2019-03-06 02:27:04'),
(16, 20, 13, '2019-03-06 02:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `sh_friend_request`
--

CREATE TABLE `sh_friend_request` (
  `req_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `user_req_to` int(255) NOT NULL,
  `date_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sh_images`
--

CREATE TABLE `sh_images` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `date_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sh_mail`
--

CREATE TABLE `sh_mail` (
  `mail_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `mail_to` int(255) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `notify` tinyint(1) NOT NULL,
  `drft_by_uid` tinyint(1) NOT NULL,
  `drft_by_mailto` tinyint(1) NOT NULL,
  `parent_id` int(255) NOT NULL,
  `del_by_uid` tinyint(1) NOT NULL,
  `del_by_mailto` tinyint(1) NOT NULL,
  `date_send` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sh_mail`
--

INSERT INTO `sh_mail` (`mail_id`, `user_id`, `mail_to`, `subject`, `message`, `is_read`, `notify`, `drft_by_uid`, `drft_by_mailto`, `parent_id`, `del_by_uid`, `del_by_mailto`, `date_send`) VALUES
(27, 14, 13, 'My Subject', 'My Subject\r\n\r\nMy Subject', 1, 1, 0, 1, 0, 0, 0, '2019-02-21 06:57:02'),
(28, 14, 13, 'My New Fonts devices', 'My New Fonts devices', 1, 1, 0, 0, 0, 0, 0, '2019-02-21 07:01:47'),
(29, 14, 13, 'My Subject', 'My Subject', 1, 1, 0, 0, 0, 0, 0, '2019-02-21 07:45:23'),
(30, 14, 13, 'Daryl', 'Gwapo', 1, 1, 0, 1, 0, 0, 0, '2019-02-21 08:18:43'),
(31, 16, 15, 'dota', 'pro', 1, 1, 0, 0, 0, 0, 0, '2019-02-21 09:39:22'),
(32, 16, 15, 'dota', 'clinks', 1, 1, 0, 1, 0, 0, 0, '2019-02-21 09:40:57'),
(33, 15, 16, 'dota', 'loser', 1, 1, 0, 1, 31, 0, 0, '2019-02-21 09:42:14'),
(34, 15, 16, 'dota', 'asdasdasdasd', 0, 0, 0, 0, 31, 0, 0, '2019-02-25 12:53:15'),
(35, 14, 13, 'Album bame', 'Descrittion', 1, 1, 0, 0, 0, 0, 0, '2019-02-28 11:14:02'),
(36, 14, 18, 'Hi', 'Welcome to the club', 1, 1, 0, 0, 0, 0, 0, '2019-02-28 11:59:45'),
(37, 18, 14, 'Hi', 'Thanks', 1, 1, 0, 0, 36, 0, 0, '2019-02-28 12:01:09'),
(38, 13, 19, 'Welcome Bro', 'Hello', 1, 1, 0, 0, 0, 0, 0, '2019-03-01 09:13:54'),
(39, 19, 13, 'Welcome Bro', 'Thank you bro', 1, 1, 0, 0, 38, 0, 0, '2019-03-01 09:15:05'),
(40, 13, 19, 'Bro', 'How are you bro', 1, 1, 0, 0, 0, 0, 0, '2019-03-01 09:24:57'),
(41, 14, 13, 'MJ', 'Mj', 1, 1, 0, 0, 0, 0, 0, '2019-03-01 14:17:30'),
(42, 13, 14, '12', '123', 1, 1, 0, 0, 0, 0, 0, '2019-03-05 04:43:14'),
(43, 13, 19, '12', '123', 1, 1, 0, 0, 0, 0, 0, '2019-03-05 04:43:14'),
(44, 13, 14, '123', '1233asass', 1, 1, 0, 0, 0, 0, 0, '2019-03-05 04:43:22'),
(45, 13, 19, '123', '1233', 1, 1, 0, 0, 0, 0, 0, '2019-03-05 04:43:22'),
(46, 13, 17, '123', '1233', 0, 1, 0, 0, 0, 0, 0, '2019-03-05 04:43:22'),
(47, 19, 13, '123', '', 1, 1, 0, 0, 45, 0, 1, '2019-03-05 05:09:08'),
(48, 19, 13, '12', 'yeahs', 1, 1, 0, 0, 43, 0, 1, '2019-03-05 05:09:42'),
(49, 14, 13, '12', 'ghgfhfgh', 1, 1, 0, 0, 42, 0, 0, '2019-03-05 05:12:59'),
(50, 13, 14, '12', 'wewew', 1, 1, 0, 0, 49, 0, 0, '2019-03-06 02:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `sh_pets`
--

CREATE TABLE `sh_pets` (
  `pet_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `pet_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pet_images` text COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(255) NOT NULL,
  `breed_id` int(255) NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color_id` int(255) NOT NULL,
  `height` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `fav_food` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `skills` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vet_clinic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `located` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adoptable` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `health_issues` text COLLATE utf8_unicode_ci NOT NULL,
  `medications` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` int(255) NOT NULL,
  `vaccination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vaccination_date` date NOT NULL,
  `primary_pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activate_notice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notice_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chip_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `collar_tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reward` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lost_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lost_date` date NOT NULL,
  `other_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt_contact_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sh_pets`
--

INSERT INTO `sh_pets` (`pet_id`, `user_id`, `pet_name`, `pet_images`, `cat_id`, `breed_id`, `tags`, `gender`, `color_id`, `height`, `weight`, `dob`, `fav_food`, `skills`, `vet_clinic`, `located`, `adoptable`, `health_issues`, `medications`, `description`, `country`, `state`, `city`, `street`, `zip_code`, `vaccination`, `vaccination_date`, `primary_pic`, `activate_notice`, `notice_title`, `chip_no`, `collar_tag`, `reward`, `lost_location`, `lost_date`, `other_info`, `contact_info`, `alt_contact_info`, `date_added`) VALUES
(5, 13, 'Affenpinscher', '[\"assets\\/img\\/pet\\/5c6e37ca3976e.png\",\"assets\\/img\\/pet\\/5c6e37ca40f8a.png\"]', 3, 87, 'Tag tags', 'Male', 28, '12', '12', '2018-01-20', 'Dog Food', 'Jumping', 'None', 'At Home', 'Yes', '', '', 'The hounds are the original hunting dogs, many pre-dating the gun-assisting hunters in their sporting group. There is a great deal of diversity, both behavioral and physical, within this group, a history of hunting assistance often being the only common b', 'Philippines', 'CEB', 'Mandaue', 'H Abellana Street', 6014, 'Rabbies', '2019-03-01', '5c6e37ca40f8a.png', 'No', 'None', '', '1231', '1231', 'Mandaue', '2018-01-20', '', '123', '124', '2019-02-21 05:31:54'),
(6, 15, 'kathy', '[\"assets\\/img\\/pet\\/5c6e8aaea3c11.png\",\"assets\\/img\\/pet\\/5c6e8aaea4e25.png\",\"assets\\/img\\/pet\\/5c6e8aaea62cd.png\",\"assets\\/img\\/pet\\/5c6e8aaea7cf7.png\"]', 2, 39, '123', 'female', 1, '213123', '12321312', '2019-02-21', '123213', '123213', '213123', 'atshelter', 'No', '', '', 'k;lasdlkashjkdh', 'Azerbaijan', 'DAS', '213123', '213213', 6000, '', '0000-00-00', '5c6e8aaea3c11.png', 'Yes', '', '', '', '', '', '0000-00-00', '', '', '', '2019-02-21 11:25:34'),
(7, 13, 'Alizza', '[\"assets\\/img\\/pet\\/5c7747c3e33e0.png\",\"assets\\/img\\/pet\\/5c7747c3e697c.png\"]', 2, 38, 'No Tags', 'Male', 24, '12', '12', '2019-02-27', 'Fish', 'Sleeping', 'None', 'At Home', 'Yes', '', '', 'My pet is cat her name is alizza', 'Philippines', 'CEB', 'Mandaue', 'H Abellana Street', 6014, 'Rabbies', '2019-02-14', '5c7747c3e697c.png', 'Yes', '', '', '', '', '', '0000-00-00', '', '', '', '2019-02-27 08:21:25'),
(8, 13, 'Chow Chow', '[\"assets\\/img\\/pet\\/5c7745ccc1c1f.png\"]', 3, 98, 'No tags', 'Male', 1, '12', '12', '2019-02-27', 'Bones', 'Jumps', 'None', 'At Home', 'Yes', '', '', 'My Description', 'Philippines', 'CEB', 'Mandaue', 'H Abellana Street', 6014, 'Rabbies', '2019-12-31', '5c7745ccc1c1f.png', 'Yes', '', '', '', '', '', '0000-00-00', '', '', '', '2019-02-27 08:54:19'),
(9, 14, 'Affenpinscher', '[\"assets\\/img\\/pet\\/5c7652d941965.png\",\"assets\\/img\\/pet\\/5c7662f2beb8b.png\"]', 1, 1, 'Tag tags', 'Male (neutered)', 3, '12', '12', '2018-12-26', 'Dog Food', 'Jumping', 'None', 'At Shelter', 'Yes', 'My Description', 'My Description', 'My Description', 'Philippines', 'CEB', 'Mandaue Cityss', 'H Abellana Street', 6014, 'Parvovirus (CPV)', '2018-01-26', '5c7662f2beb8b.png', 'Yes', '', '', '', '', '', '0000-00-00', '', '', '', '2019-02-27 09:05:29'),
(10, 13, 'Tiger', '[\"assets\\/img\\/pet\\/5c78dac9511a5.png\"]', 3, 226, 'Tag tags', 'Female', 2, '12', '12', '2018-01-31', 'Dog Food', 'Jumping', 'None', 'At Shelter', 'No', '', '', 'My pet description', 'Philippines', 'CEB', 'Mandaue', 'H Abellana Street', 6014, 'rabbies', '2018-01-31', '5c78dac9511a5.png', 'Yes', 'None', '', '1231', '1231', 'mandaue', '2018-01-31', 'None', '123', '124', '2019-03-01 07:10:01'),
(11, 18, 'Tigersss', '[\"assets\\/img\\/pet\\/5c7e7d243ebdc.png\",\"assets\\/img\\/pet\\/5c7e7d2444e8f.png\"]', 2, 22, 'Tag tags', 'Female (NOT spayed)', 2, '12', '12', '2018-01-04', 'Dog Foof', 'Jumping', 'None', 'At Shelter', 'No', 'None so far', 'Yes pedia', 'Handsome', 'Philippines', 'CAG', 'Mandaue City', 'H Abellana Street', 6014, 'Canine adenovirus (CAV)', '2018-01-04', '5c7e7d243ebdc.png', 'Yes', 'None', '', '1231', '1231', 'mandaue', '2018-12-04', '', '123', '124', '2019-03-05 13:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `sh_pet_list`
--

CREATE TABLE `sh_pet_list` (
  `book_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `book_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sh_posts`
--

CREATE TABLE `sh_posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `pl_id` int(255) NOT NULL,
  `post_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sh_users`
--

CREATE TABLE `sh_users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `street` varchar(250) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `bio` text NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `cover_photo` varchar(255) NOT NULL,
  `is_complete` tinyint(1) NOT NULL COMMENT '0 Not Complete, 1 Complete, 2 CompleteLater',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sh_users`
--

INSERT INTO `sh_users` (`id`, `fullname`, `occupation`, `email`, `password`, `mobile_number`, `gender`, `address`, `country`, `state`, `city`, `street`, `zip_code`, `bio`, `user_img`, `cover_photo`, `is_complete`, `date_created`) VALUES
(13, 'Toms', 'Web Analys', 'tom@yopmail.com', '202cb962ac59075b964b07152d234b70', 12311, 'male', '', 'Philippines', 'CEB', 'Mandaue', 'H Abellana Street', '6014', 'About myself', 'pp_1551430238.jpg', '', 1, '2019-02-19 06:42:48'),
(14, 'Tom2', 'Business Man', 'tom2@yopmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 12333, 'female', '', 'Philippines', 'CEB', 'Mandaue Cityss', 'H Abellana Street', '6014', 'Featured snippet from the web\r\nClick on the table you want to work with, which will take you to the list of columns in the table. Underneath the list of columns, where is says \"add 1 column(s)\" click the Go button to add 1 column. Define the column by entering the following information: Name the Column.', 'pp_1550634089.jpg', '', 1, '2019-02-20 03:37:36'),
(15, 'testing', 'occuipation', 'test@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1234, 'female', '', 'Philippines', '00', 'guadalupedddd', 'singson', '6000', 'asdasdasd', '', '', 0, '2019-02-21 09:34:38'),
(16, '', '', 'test2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0, '', '', '', '', '0', '0', '0', '', '', '', 0, '2019-02-21 09:36:47'),
(17, 'Tom 3', 'Web Analys', 'tom3@yopmail.com', '202cb962ac59075b964b07152d234b70', 123, 'male', '', 'Philippines', 'MAG', 'Mandaue', 'H Abellana Street', '6014', 'About me and you dudesssss', 'pp_1551270087.jpg', '', 1, '2019-02-27 10:59:33'),
(18, 'My Tom 4', 'Web Analys', 'tom4@yopmail.com', '202cb962ac59075b964b07152d234b70', 123, 'male', '', 'Philippines', 'CAG', 'Mandaue City', 'H Abellana Street', '6014', 'I and me is ones and for all.', '', '', 1, '2019-02-27 13:02:44'),
(19, 'Tom 5 is here', 'Parlor Shop', 'tom5@yopmail.com', '202cb962ac59075b964b07152d234b70', 12311, 'male', '', 'Philippines', 'CEB', 'Mandaue', 'H Abellana Street', '6014', 'Mandaue H Abellana Street', '', '', 1, '2019-03-01 08:39:06'),
(20, '', '', 'tom6@yopmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '', '', '', '', '', '', '', '', '', 2, '2019-03-02 08:49:53'),
(21, '', '', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '', '', '', '', '', '', '', '', '', 2, '2019-03-05 05:11:50'),
(24, 'Mark Joseph Pino', '', 'spymyway@yahoo.com', '', 0, '', '', '', '', '', '', '', '', 'pp_1551864906.png', '', 0, '2019-03-06 09:35:03'),
(25, 'Mark Joseph Pino', '123', 'spymyway6@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 12123, 'female', '', 'Philippines', 'CEB', 'Mandaue', 'H Abellana Streets', '6014', '1231', 'pp_1551875049.png', '', 1, '2019-03-06 12:24:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sh_albums`
--
ALTER TABLE `sh_albums`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `sh_book`
--
ALTER TABLE `sh_book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `sh_breeds`
--
ALTER TABLE `sh_breeds`
  ADD PRIMARY KEY (`breed_id`);

--
-- Indexes for table `sh_category`
--
ALTER TABLE `sh_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `sh_color`
--
ALTER TABLE `sh_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `sh_friends`
--
ALTER TABLE `sh_friends`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `sh_friend_request`
--
ALTER TABLE `sh_friend_request`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `sh_images`
--
ALTER TABLE `sh_images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `sh_mail`
--
ALTER TABLE `sh_mail`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `sh_pets`
--
ALTER TABLE `sh_pets`
  ADD PRIMARY KEY (`pet_id`);

--
-- Indexes for table `sh_pet_list`
--
ALTER TABLE `sh_pet_list`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `sh_posts`
--
ALTER TABLE `sh_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `sh_users`
--
ALTER TABLE `sh_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sh_albums`
--
ALTER TABLE `sh_albums`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sh_book`
--
ALTER TABLE `sh_book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sh_breeds`
--
ALTER TABLE `sh_breeds`
  MODIFY `breed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=531;

--
-- AUTO_INCREMENT for table `sh_category`
--
ALTER TABLE `sh_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sh_color`
--
ALTER TABLE `sh_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sh_friends`
--
ALTER TABLE `sh_friends`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sh_friend_request`
--
ALTER TABLE `sh_friend_request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sh_images`
--
ALTER TABLE `sh_images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `sh_mail`
--
ALTER TABLE `sh_mail`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sh_pets`
--
ALTER TABLE `sh_pets`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sh_pet_list`
--
ALTER TABLE `sh_pet_list`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sh_posts`
--
ALTER TABLE `sh_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sh_users`
--
ALTER TABLE `sh_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
