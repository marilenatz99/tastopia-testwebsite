-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2024 at 08:49 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21881012_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_a_table`
--

CREATE TABLE `book_a_table` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(9) NOT NULL,
  `date` date NOT NULL,
  `time` time(5) NOT NULL,
  `people` int(2) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_a_table`
--

INSERT INTO `book_a_table` (`id`, `name`, `email`, `phone`, `date`, `time`, `people`, `message`) VALUES
(1, 'malknqkb', 'hdgdusgh@jdjdhd', 126554588, '2024-02-24', '20:05:00.00000', 5, ''),
(2, 'jhbj', 'lksd@gmail', 126554588, '2024-02-24', '12:00:00.00000', 6, ''),
(3, 'niuyfd', 'lksd@gmail.com', 126554588, '2024-02-28', '21:00:00.00000', 2, ''),
(4, 'iuuyyy', 'osnsw@jfhr', 126554588, '2024-02-28', '21:00:00.00000', 2, ''),
(5, 'hhxrts4', 'hdgdusgh@jdjdhd', 126554588, '2024-02-26', '22:00:00.00000', 5, ''),
(6, 'kmjsndh', 'lksd@gmail', 126554588, '2024-02-27', '15:00:00.00000', 5, ''),
(7, 'mar', 'mar@gmail.com', 366554547, '2024-02-29', '20:00:00.00000', 2, ''),
(8, ',m fbqwf', 'lksd@gmail', 366554547, '2024-04-17', '15:00:00.00000', 7, ''),
(9, 'malknqkb', 'hdgdusgh@jdjdhd', 126554588, '2024-02-29', '15:00:00.00000', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `menuItemId` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `paid` varchar(255) NOT NULL,
  `total_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_categories`
--

CREATE TABLE `food_categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `food_categories`
--

INSERT INTO `food_categories` (`id`, `name`) VALUES
(1, 'Starters'),
(2, 'Salads'),
(3, 'Burgers'),
(4, 'Pizza'),
(5, 'Pasta'),
(6, 'Desserts'),
(7, 'Dressing'),
(8, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `title`, `categoryId`, `ingredients`, `descr`, `price`, `image`) VALUES
(1, '3x Fried chicken wings', 1, 'Chicken, Seasoning', 'Crispy and golden-brown, fried chicken wings are a delectable treat enjoyed for their flavorful, seasoned exterior and tender, juicy meat on the inside. Whether coated in a tangy buffalo sauce or served plain with a side of dipping sauce, these savory bites are a popular and satisfying snack or meal option.', 6, 'starters0.jpg'),
(2, 'Farmers favorite', 1, 'Bread, Olive sauce, Artichoke, Mini tomatoes, Prosciutto, Arugula', 'Application specially indicated for structuring tofu and/or creating new tofu products structuring it with other ingredients like algae, dry fruits, nuts, etc.', 4, 'starters1.jpg'),
(3, 'Melitzanosalata', 1, 'Bread, Eggplant, Olive oil, Garlic, Lemon juice, Herbs , Parsley', 'Melitzanosalata is a traditional Greek dish, often served as a dip or spread. It’s primarily made from roasted eggplants, which are known for their rich, smoky flavor. The eggplants are typically mashed or blended and then combined with olive oil, garlic, lemon juice, and herbs like parsley. ', 6, 'starters2.jpg'),
(4, 'French fries', 1, 'Potatoes, Oregano, Salt', 'Golden and irresistibly crispy, French fries are a classic side dish beloved for their simple yet addictive appeal. Whether seasoned with salt, smothered in ketchup, or served alongside a juicy burger, these potato delights are a universally cherished indulgence.', 3, 'starters3.jpg'),
(5, 'Roasted potatoes', 1, 'Potatoes, Rosemary, Salt', 'Roasted potatoes, with their crispy exteriors and tender insides, offer a delightful contrast in texture and a rich, savory flavor. Whether seasoned with herbs, garlic, or simple salt and pepper, these golden-brown gems make for a comforting and versatile side dish that complements a variety of meals.', 4, 'starters4.jpg'),
(6, 'Structured Tofu With Raisins and Seaweeds', 2, 'Tofu, Tomato, Onion, Arugula, Cucumber, Purple Cabbage, Eggs, Green beans, Seasoning', 'Application specially indicated for structuring tofu and/or creating new tofu products structuring it with other ingredients like algae, dry fruits, nuts, etc.', 8, 'salads0.jpg'),
(7, 'Pasta salad', 2, 'Pasta, Tomato, Lettuce, Spinach sauce, Salt', 'Al pesto pasta. A perfect and unique basil sauce that stands out both for its taste and texture and goes perfectly with the bows.', 7, 'salads1.jpg'),
(8, 'Veggies salad', 2, 'Red onion, Walnuts, Arugula, Carrot, Olives, Grapes, Feta cheese', '`Charring the cabbage gives this sizzlin’ slaw a smoky flavour, while avocado replaces mayo in the zingy dressing`, says Derek Sarno, Tesco`s director of Plant-Based innovation. A fresh, crunchy salad that`s great for serving at your next alfresco meal, you won`t regret making this.', 5, 'salads2.jpg'),
(9, 'Like greek salad', 2, 'Feta cheese, Tomatoes, Bread, Spinach, Olive oil, Seasoning', 'Greek salad, a refreshing Mediterranean classic, combines crisp cucumbers, juicy tomatoes, briny Kalamata olives, and tangy feta cheese, all drizzled with olive oil and sprinkled with oregano. This vibrant and flavorful salad captures the essence of Greek cuisine, offering a delightful mix of textures and tastes in every bite.', 5, 'salads3.jpg'),
(10, 'Buffalo chicken burger', 3, 'Chicken, Buffalo sauce, Purple cabbage, Pink sauce, Pickles', 'A Buffalo chicken burger is a spicy and savory delight, featuring a juicy chicken patty coated in zesty buffalo sauce, topped with cool lettuce, tomato, and a creamy blue cheese dressing. The combination of heat from the buffalo sauce and the creamy richness of the blue cheese creates a mouthwatering and satisfying burger experience.', 6, 'burgers0.jpg'),
(11, 'Fish burger', 3, 'Fish, Onion, Cabbage, Mayonnaise sauce, Pickles', 'A fried fish burger is a crispy and flavorful culinary delight, showcasing a succulent fish fillet that`s deep-fried to perfection and nestled within a soft bun. Accompanied by tangy tartar sauce, crisp lettuce, and a squeeze of lemon, this seafood sensation offers a delightful harmony of textures and tastes.', 8, 'burgers1.jpg'),
(12, 'Double cheeseburger', 3, 'Beef, Cheddar, Tomato, Lettuce, Onion, Cocktail sauce', 'The double cheddar cheeseburger is a carnivore`s dream, featuring two perfectly grilled beef patties layered with gooey cheddar cheese, creating a decadent and indulgent experience. With each bite, the rich and melty cheddar adds an extra layer of savory goodness to the already juicy and flavorful burger.', 6, 'burgers2.jpg'),
(13, 'Big patty with caramelized onions', 3, 'Beef, Peppers, Cheddar, Pickles,  Onions, Special sauce, Cocktail sauce', 'The big patty with caramelized onions is a savory delight, blending a hearty grilled beef patty with the sweet richness of caramelized onions for a deliciously satisfying burger experience.', 7, 'burgers3.jpg'),
(14, 'Pineapple - chicken', 4, 'Pineapple, Chicken, Cilantro, Cheese, Tomato sauce, Onion, Spicy sauce, Seasoning', 'Pineapple-chicken pizza offers a tasty blend of savory grilled chicken and sweet, tangy pineapple, creating a uniquely delicious twist on the classic. The tropical notes from the pineapple complement the savory chicken for a flavorful pizza experience.', 9, 'pizza0.jpg'),
(15, 'Margarita - Olives - Egg', 4, 'Cheese, Tomato sauce, Olives, Egg, Oregano', 'Margarita-Olives-Egg pizza combines the classic simplicity of a Margherita pizza with the briny goodness of olives and the richness of a perfectly cooked egg. This flavorful combination elevates the traditional Margherita, offering a unique and delightful pizza experience.', 8, 'pizza1.jpg'),
(16, 'Spinach - Mozzarella', 4, 'Spinach, Mozzarella, Toma sauce, Seasoning', 'Spinach-Mozzarella pizza showcases a perfect pairing of vibrant spinach and gooey mozzarella, creating a wholesome and flavorful pizza. The earthy notes of spinach harmonize with the creamy richness of mozzarella for a deliciously satisfying slice.', 8, 'pizza2.jpg'),
(17, 'Special', 4, 'Sausage, Peppers, Olives, Mushrooms, Cheese, Tomato sauce, Oregano', 'The \"special\" pizza is a culinary masterpiece, featuring a unique blend of premium ingredients that tantalize the taste buds. With a medley of flavors and textures, each bite delivers a delightful surprise for a truly special pizza experience.', 10, 'pizza3.jpg'),
(18, 'Spaghetti Bolognese', 5, 'Ground meat, Onions, Celery, Carrots, Garlic, Tomatoes, Red wine, Broth, Oregano, Basil', 'Bolognese pasta is a comforting Italian classic, boasting a rich and hearty meat sauce that clings to the pasta, creating a satisfying and flavorful dish. The slow-cooked blend of ground meat, tomatoes, and aromatic herbs makes Bolognese pasta a timeless favorite for pasta enthusiasts.', 10, 'pasta0.jpg'),
(19, 'Spaghetti Carbonara', 5, 'Bacon, Egg, Heavy cream', 'Spaghetti carbonara is a Roman classic, featuring pasta tossed with a creamy sauce made from eggs, Pecorino Romano cheese, pancetta or guanciale, and black pepper. The simplicity of the ingredients harmonizes to create a flavorful and indulgent dish that captures the essence of Italian comfort cuisine.', 9, 'pasta1.jpg'),
(20, 'Fettuccine with pieces of calf', 5, 'Calf meat, Olive oil, Garlic, Onions, Tomatoes, White wine, Heavy cream, Parmesan cheese, Seasonings', 'Fettuccine with pieces of calf is a savory delight, showcasing tender pieces of calf meat combined with wide ribbons of pasta for a hearty and satisfying dish. The rich flavors and textures come together, creating a comforting meal that elevates the classic fettuccine pasta experience.', 10, 'pasta2.jpg'),
(21, 'Pasta with shells and red peppers', 5, 'Red bell peppers, Olive oil, Garlic, Onions, Tomato sauce, Seasoning', 'Pasta with shells and red peppers is a vibrant and flavorful dish, featuring pasta shells tossed with sautéed red bell peppers for a delicious pop of sweetness and color. The combination of tender pasta and the roasted flavor of red peppers creates a delightful and visually appealing meal.', 13, 'pasta3.jpg'),
(22, 'Pasta with shrimps', 5, 'Olive oil, Garlic, Cherry tomatoes, White wine, Lemon juice, Seasoning', 'Pasta with shrimps is a delightful seafood pasta dish, featuring succulent shrimp tossed with al dente pasta in a flavorful sauce. The combination of tender pasta and juicy shrimp creates a satisfying and elegant meal with a hint of maritime richness.', 15, 'pasta4.jpg'),
(23, 'Red velvet cupcake', 6, '', '', 6, 'desserts0.jpg'),
(24, 'Chocolate cake piece', 6, '', '', 4, 'desserts1.jpg'),
(25, '3x Donuts', 6, '', '', 5, 'desserts2.jpg'),
(26, 'Ketchup', 7, '', '', 1, 'dressing0.jpg'),
(27, 'Mustard', 7, '', '', 1, 'dressing1.jpg'),
(28, 'Coca Cola 333ml', 8, '', '', 2, 'drinks0.jpg'),
(29, 'Soda 333ml', 8, '', '', 2, 'drinks1.jpg'),
(30, 'White wine 1L', 8, '', '', 15, 'drinks2.jpg'),
(31, 'Red wine 1L', 8, '', '', 15, 'drinks3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `phone` varchar(9) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `email`, `phone`, `address`, `password`) VALUES
(1, 'mar', 'mar@gmail.com', '000000000', '3344 W Alameda Avenue, Lakewood, CO 80222', 'mar123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_a_table`
--
ALTER TABLE `book_a_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_categories`
--
ALTER TABLE `food_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_a_table`
--
ALTER TABLE `book_a_table`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`userEmail`) REFERENCES `user_info` (`email`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`menuItemId`) REFERENCES `menu_items` (`id`);

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `food_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
