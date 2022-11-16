-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2022 at 04:12 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `we_love_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `review` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `recipe_id`, `comment`, `created_at`, `review`) VALUES
(1, 57, 89, 'Amazing recipe, great taste ! Well worth trying!', '2022-11-16 13:51:55', 5);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `summary` text NOT NULL,
  `duration` time NOT NULL,
  `ingredients` text NOT NULL,
  `recipe` text NOT NULL,
  `author` varchar(512) NOT NULL,
  `image` varchar(256) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `title`, `summary`, `duration`, `ingredients`, `recipe`, `author`, `image`, `is_enabled`) VALUES
(89, 'Chocolate brownies', 'A foolproof brownie recipe for a squidgy chocolate bake. Watch our recipe video to help you get a perfect traybake every time.', '01:00:00', '185g unsalted butter, 185g best dark chocolate, 85g plain flour, 40g cocoa powder, 50g white chocolate, 50g milk chocolate, 3 large eggs, 275g golden caster sugar', 'Cut 185g unsalted butter into small cubes and tip into a medium bowl. Break 185g dark chocolate into small pieces and drop into the bowl. Fill a small saucepan about a quarter full with hot water, then sit the bowl on top so it rests on the rim of the pan, not touching the water. Put over a low heat until the butter and chocolate have melted, stirring occasionally to mix them. Remove the bowl from the pan. Alternatively, cover the bowl loosely with cling film and put in the microwave for 2 minutes on High. Leave the melted mixture to cool to room temperature. While you wait for the chocolate to cool, position a shelf in the middle of your oven and turn the oven on to 180C/160C fan/gas 4.\r\nUsing a shallow 20cm square tin, cut out a square of non-stick baking parchment to line the base. Tip 85g plain flour and 40g cocoa powder into a sieve held over a medium bowl. Tap and shake the sieve so they run through together and you get rid of any lumps. Chop 50g white chocolate and 50g milk chocolate into chunks on a board. Break 3 large eggs into a large bowl and tip in 275g golden caster sugar. With an electric mixer on maximum speed, whisk the eggs and sugar. They will look thick and creamy, like a milk shake. This can take 3-8 minutes, depending on how powerful your mixer is. You’ll know it’s ready when the mixture becomes really pale and about double its original volume. Another check is to turn off the mixer, lift out the beaters and wiggle them from side to side. If the mixture that runs off the beaters leaves a trail on the surface of the mixture in the bowl for a second or two, you’re there. Pour the cooled chocolate mixture over the eggy mousse, then gently fold together with a rubber spatula. Plunge the spatula in at one side, take it underneath and bring it up the opposite side and in again at the middle. Continue going under and over in a figure of eight, moving the bowl round after each folding so you can get at it from all sides, until the two mixtures are one and the colour is a mottled dark brown. The idea is to marry them without knocking out the air, so be as gentle and slow as you like. Hold the sieve over the bowl of eggy chocolate mixture and resift the cocoa and flour mixture, shaking the sieve from side to side, to cover the top evenly. Gently fold in this powder using the same figure of eight action as before. The mixture will look dry and dusty at first, and a bit unpromising, but if you keep going very gently and patiently, it will end up looking gungy and fudgy. Stop just before you feel you should, as you don’t want to overdo this mixing. Finally, stir in the white and milk chocolate chunks until they’re dotted throughout. Pour the mixture into the prepared tin, scraping every bit out of the bowl with the spatula. Gently ease the mixture into the corners of the tin and paddle the spatula from side to side across the top to level it. Put in the oven and set your timer for 25 mins. When the buzzer goes, open the oven, pull the shelf out a bit and gently shake the tin. If the brownie wobbles in the middle, it’s not quite done, so slide it back in and bake for another 5 minutes until the top has a shiny, papery crust and the sides are just beginning to come away from the tin. Take out of the oven. Leave the whole thing in the tin until completely cold, then, if you’re using the brownie tin, lift up the protruding rim slightly and slide the uncut brownie out on its base. If you’re using a normal tin, lift out the brownie with the foil. Cut into quarters, then cut each quarter into four squares and finally into triangles. They’ll keep in an airtight container for a good two weeks and in the freezer for up to a month.', 'tony@stark.com', 'Brownie.6373507cdb63a.webp', 1),
(87, 'Coconut Chicken La Reunion', 'This easy an easy chicken curry recipe with coconut imparts the flavours of La Reunion, making it a firm favourite once the weather turns.', '00:45:00', '1 chicken, 400g, 1 can coconut milk, 5 cloves garlic, 8 tomato (s), 3 onion (s), 1 piece (s) ginger, salt and pepper, turmeric, thyme, oil', 'Cut the chicken into pieces. Grate the ginger, press the garlic and mix everything with salt and pepper. Dice the tomatoes and onions.\r\n Heat the oil in a saucepan, add the chicken and fry for 5-8 minutes over high heat. Then stir for 1-2 minutes. Add the onions and fry for another 5 minutes over medium heat.\r\n Add the tomatoes and the remaining spices and stew for 15 minutes on a low heat. Add the coconut milk and simmer for another 10 minutes on a low heat.\r\n Taste and let taste!', 'tony@stark.com', 'Poulet_coco_réunionnais.63734cd4ea684.webp', 1),
(86, 'Coconut Lemonade', 'This easy homemade Coconut Lemonade is over the top! You won\'t want your go-to lemonade after trying this. Perfect for making a cocktail', '00:10:00', '¼ cup sweetened condensed coconut milk, 1 cup water, ½ cup lemon juice, ¼ cup coconut milk', 'Take a small amount of the water and add sweetened condensed coconut milk. Heat in microwave for 20-30 seconds, or until sweetened condensed coconut milk is melted.\r\nAdd the rest of the water, lemon juice, and coconut milk. Mix well. Serve over ice.', 'tony@stark.com', 'Limonade_de_Coco.63734a904e25d.webp', 1),
(88, 'Mozzarella tomato and apple salad', 'A classic combination of tomato-mozzarella, redesigned in a more delicious sweet and savoury version with apples and thin slices of Parma ham. Ideal for summer picnics with friends.', '00:45:00', 'Olive oil and balsamic vinaigrette, 250g cherry tomatoes, 1 bag of small mozzarella balls, 1 apple,1 jar of onions in balsamic vinegar,1 lettuce, A few basil leaves, 8 thin slices of Parma ham.', 'Wash and dry the lettuce and cut the leaves into small pieces.\r\nFinely chop the basil leaves. Wash the cherry tomatoes and drain the onions and mozzarella.\r\nCut the apple into cubes, or balls ​​using a melon baller.\r\nSeason the lettuce leaves, mixed with the basil, with the oil and balsamic vinaigrette, then divide on your serving plates.\r\nIn a bowl, combine the apples, onions, mozzarella balls and cherry tomatoes:drizzle with some more balsamic vinaigrette and divide up on top of the lettuce.\r\nAdd two slices of thin Parma ham on each plate.', 'tony@stark.com', 'Salade_tomate,_mozzarella_et_pommes.63734e1ff1034.webp', 1),
(90, 'Pasta and tomato gratin', 'Everyone loves a rich, comforting pasta bake, and this recipe is easy enough to make for a midweek dinner. The penne pasta is cooked with a rich tomato sauce and topped with oozy, melting cheese.', '01:05:00', '1 tbsp olive oil, 1 onion, diced, 1 carrot, peeled and diced, 1 celery stalk, diced, 2 garlic cloves, finely sliced, 2 tbsp balsamic vinegar, 1 tbsp dried oregano, 2 x 400g tins chopped tomatoes, 500g penne, 100g mature Cheddar, grated, 100g red Leicester, grated', 'In a large pan, heat the oil over a medium heat. Fry the onion, carrot and celery for 5 mins, or until softened. Add in the garlic and cook for a further 2-3 mins. \r\nTurn the heat up and add in the balsamic vinegar and bubble until reduced. Add the oregano, tinned tomatoes and 350ml water and bring to the boil. Turn down the heat and simmer for 20 mins, then remove from the heat. Meanwhile, bring a pan of salted water to the boil and cook the penne following the pack instructions. Preheat the oven to gas 6, 200°C, fan 180°C. Use a handheld blender to blitz the sauce until smooth then season well. Stir in the drained pasta then transfer everything to a large baking tin. Top with the cheese and bake in the oven for 15 mins, or until golden and the sauce has reduced.', 'tony@stark.com', 'Gratin_de_pâtes_à_la_tomate.63735189d2826.webp', 1),
(91, 'Quiche lorraine', 'Quiche is a French tart consisting of pastry crust filled with savoury custard and pieces of cheese, meat, seafood or vegetables. A well-known variant is quiche Lorraine, which includes lardons or bacon. Quiche may be served hot, warm or cold', '01:25:00', '175g plain flour, 100g cold butter, cut into pieces, 1 egg yolk, For the filling, 200g pack lardons, unsmoked or smoked, 50g gruyère, 200ml carton crème fraîche, 200ml double cream, 3 eggs, well beaten, pinch ground nutmeg', 'For the pastry, put 175g plain flour, 100g cold butter, cut into pieces, 1 egg yolk and 4 tsp cold water into a food processor. Using the pulse button, process until the mix binds.\r\nTip the pastry onto a lightly floured surface, gather into a smooth ball, then roll out as thinly as you can.\r\nLine a 23 x 2.5cm loose-bottomed, fluted flan tin, easing the pastry into the base.\r\nTrim the pastry edges with scissors (save any trimmings) so it sits slightly above the tin (if it shrinks, it shouldn’t now go below the level of the tin). Press the pastry into the flutes, lightly prick the base with a fork, then chill for 10 mins.\r\nPut a baking sheet in the oven and heat oven to 200C/fan 180C/gas 6. Line pastry case with foil, shiny side down, fill with dry beans and bake on the hot sheet for 15 mins.\r\nRemove foil and beans and bake for 4-5 mins more until the pastry is pale golden. If you notice any small holes or cracks, patch up with pastry trimmings. You can make up to this point a day ahead.\r\nWhile the pastry cooks, prepare the filling. Heat a small frying pan, tip in 200g lardons and fry for a couple of mins. Drain off any liquid that comes out, then continue cooking until the lardons just start to colour, but aren’t crisp. Remove and drain on paper towels.\r\nCut three quarters of the 50g gruyère into small dice and finely grate the rest. Scatter the diced gruyère and fried lardons over the bottom of the pastry case.\r\nUsing a spoon, beat 200ml crème fraîche to slacken it then slowly beat in 200ml double cream. Mix in 3 well beaten eggs. Season (you shouldn’t need much salt) and add a pinch of ground nutmeg. Pour three quarters of the filling into the pastry case.\r\nHalf-pull the oven shelf out and put the flan tin on the baking sheet. Quickly pour the rest of the filling into the pastry case – you get it right to the top this way. Scatter the grated cheese over the top, then carefully push the shelf back into the oven.\r\nLower the oven to 190C/fan 170C/gas 5. Bake for about 25 mins, or until golden and softly set (the centre should not feel too firm).\r\nLet the quiche settle for 4-5 mins, then remove from the tin. Serve freshly baked, although it’s also good cold.', 'tony@stark.com', 'Quiche_lorraine.6373528771550.webp', 1),
(92, 'Tomato soup', 'Tomato soup is a soup with tomatoes as the primary ingredient. It can be served hot or cold, and may be made in a variety of ways. This warming soup is made using juicy, ripe tomatoes, which come into season around September. It\'s a comforting recipe to make and eat throughout the year', '01:45:00', '1-1.25kg/2lb 4oz-2lb 12oz ripe tomatoes, 1 medium onion, 1 small carrot, 1 celery stick, 2 tbsp olive oil, 2 squirts of tomato purée (about 2 tsp), a good pinch of sugar, 2 bay leaves,\r\n1.2 litres/2 pints hot vegetable stock (made with boiling water and 4 rounded tsp bouillon powder or 2 stock cubes).', 'First, prepare your vegetables. You need 1-1.25kg/2lb 4oz-2lb 12oz ripe tomatoes. If the tomatoes are on their vines, pull them off. The green stalky bits should come off at the same time, but if they don\'t, just pull or twist them off afterwards. Throw the vines and green bits away and wash the tomatoes. Now cut each tomato into quarters and slice off any hard cores (they don\'t soften during cooking and you\'d get hard bits in the soup at the end). Peel 1 medium onion and 1 small carrot and chop them into small pieces. Chop 1 celery stick roughly the same size.\r\nSpoon 2 tbsp olive oil into a large heavy-based pan and heat it over a low heat. Hold your hand over the pan until you can feel the heat rising from the oil, then tip in the onion, carrot and celery and mix them together with a wooden spoon. Still with the heat low, cook the vegetables until they\'re soft and faintly coloured. This should take about 10 minutes and you should stir them two or three times so they cook evenly and don’t stick to the bottom of the pan.\r\nHolding the tube over the pan, squirt in about 2 tsp of tomato purée, then stir it around so it turns the vegetables red. Shoot the tomatoes in off the chopping board, sprinkle in a good pinch of sugar and grind in a little black pepper. Tear 2 bay leaves into a few pieces and throw them into the pan. Stir to mix everything together, put the lid on the pan and let the tomatoes stew over a low heat for 10 minutes until they shrink down in the pan and their juices flow nicely. From time to time, give the pan a good shake – this will keep everything well mixed.\r\nSlowly pour in the 1.2 litres/2 pints of hot stock (made with boiling water and 4 rounded tsp bouillon powder or 2 stock cubes), stirring at the same time to mix it with the vegetables. Turn up the heat as high as it will go and wait until everything is bubbling, then turn the heat down to low again and put the lid back on the pan. Cook gently for 25 minutes, stirring a couple of times. At the end of cooking the tomatoes will have broken down and be very slushy-looking.\r\nRemove the pan from the heat, take the lid off and stand back for a few seconds or so while the steam escapes, then fish out the pieces of bay leaf and throw them away. Ladle the soup into your blender until it’s about three-quarters full, fit the lid on tightly and turn the machine on full. Blitz until the soup’s smooth (stop the machine and lift the lid to check after about 30 seconds), then pour the puréed soup into a large bowl. Repeat with the soup that’s left in the pan. (The soup may now be frozen for up to three months. Defrost before reheating.)\r\nPour the puréed soup back into the pan and reheat it over a medium heat for a few minutes, stirring occasionally until you can see bubbles breaking gently on the surface. Taste a spoonful and add a pinch or two of salt if you think the soup needs it, plus more pepper and sugar if you like. If the colour’s not a deep enough red for you, plop in another teaspoon of tomato purée and stir until it dissolves. Ladle into bowls and serve. Or sieve and serve chilled with some cream swirled in.', 'tony@stark.com', 'Soupe_de_tomates.637353c2cdd46.webp', 1),
(93, 'Pizza Margherita', 'Pizza is a dish of Italian origin consisting of a usually round, flat base of leavened wheat-based dough topped with tomatoes, cheese, and often various other ingredients, which is then baked at a high temperature, traditionally in a wood-fired oven', '01:00:00', '500g strong white bread flour, plus extra for dusting, 1 tsp dried yeast, 1 tsp caster sugar, 1 ½ tbsp olive oil, plus extra, For the tomato sauce: 100ml passata, 1 tbsp fresh basil, chopped (or 1/2 tsp dried oregano), 1 garlic clove, crushed. For the topping: 200g vegan mozzarella-style cheese, grated, 2 tomatoes, thinly sliced, Fresh basil or oregano leaves, chilli oil and vegan parmesan to serve (optional).', 'Put the flour, yeast and sugar in a large bowl. Measure 150ml of cold water and 150ml boiling water into a jug and mix them together – this will mean your water is a good temperature for the yeast. Add the oil and 1 tsp salt to the warm water then pour it over the flour. Stir well with a spoon then start to knead the mixture together in the bowl until it forms a soft and slightly sticky dough. If it’s too dry add a splash of cold water.\r\nDust a little flour on the work surface and knead the dough for 10 mins. Put it back in the mixing bowl and cover with cling film greased with a few drops of olive oil. Leave to rise in a warm place for 1 hr or until doubled in size.\r\nHeat oven to 220C/200C/gas 9 and put a baking sheet or pizza stone on the top shelf to heat up. Once the dough has risen, knock it back by punching it a couple of times with your fist then kneading it again on a floured surface. It should be springy and a lot less sticky. Set aside while you prepare the sauce.\r\nPut all the ingredients for the tomato sauce together in a bowl, season with salt, pepper and a pinch of sugar if you like and mix well. Set aside until needed.\r\nDivide the dough into 2 or 4 pieces (depending on whether you want to make large or small pizzas), shape into balls and flatten each piece out as thin as you can get it with a rolling pin or using your hands. Make sure the dough is well dusted with flour to stop it sticking. Dust another baking sheet with flour then put a pizza base on top – spread 4-5 tbsp of the tomato sauce on top and add some sliced tomatoes and grated vegan cheese. Drizzle with a little olive oil and bake in the oven on top of your preheated baking tray for 10-12 mins or until the base is puffed up and the vegan cheese has melted and is bubbling and golden in patches.\r\nRepeat with the rest of the dough and topping. Serve the pizzas with fresh basil leaves or chilli oil if you like and sprinkle over vegan parmesan just after baking.', 'tony@stark.com', 'Pizza.637357c01125d.webp', 1),
(94, 'lemon meringue pie', 'You can\'t go wrong with a classic lemon meringue pie, and this easy recipe is particularly good', '03:15:00', 'For the pastry: 175g plain flour, 100g cold butter, cut in small pieces, 1 tbsp icing sugar, 1 egg yolk, For the filling: 2 level tbsp cornflour, 100g golden caster sugar, 2 large lemons, zested, 125ml fresh lemon juice (from 2-3 lemons), 1 small orange, juiced, 85g butter, cut into pieces, 3 egg yolks and 1 whole egg. For the meringue:  4 egg whites, room temperature, 200g golden caster sugar, 2 tsp cornflour', 'For the pastry, put the plain flour, butter, icing sugar, egg yolk (save the white for the meringue) and 1 tbsp cold water into a food processor. Pulse until the mix starts to bind – make sure the mix is not overworked.\r\nTip the pastry onto a lightly floured surface, gather together until smooth, then roll out and line a 23 x 2.5cm loose-bottom fluted flan tin. Trim and neaten the edges. Press pastry into the flutes. The pastry is quite rich, so don’t worry if it cracks, just press it back together. Prick the base with a fork, line with foil, shiny side down, and chill for 30 mins-1 hr (or overnight).\r\nPut a baking sheet in the oven and heat the oven to 200C/180C fan/gas 6. Bake the pastry case ‘blind’ (filled with dry beans) for 15 mins, then remove the foil and bake a further 5-8 mins until the pastry is pale golden and cooked. Set aside. Can be done a day ahead. Lower the oven to 180C/160C fan/gas 4.\r\nWhile the pastry bakes, prepare the filling. Mix the cornflour, golden caster sugar and lemon zest in a medium saucepan. Strain and stir in the lemon juice gradually. Make the orange juice up to 200ml with water and strain into the pan. Cook over a medium heat, stirring constantly, until thickened and smooth.\r\nOnce the mixture bubbles, remove from the heat and beat in the butter until melted. Beat the egg yolks (save white for meringue) and the whole egg together, stir into the pan and return to a medium heat. Keep stirring vigorously for a few minutes, until the mixture thickens and plops from the spoon. (It will bubble, but doesn’t curdle.) Take off the heat and set aside while you make the meringue.\r\nPut the egg whites in a large bowl. Whisk to soft peaks, then add 100g of the golden caster sugar a spoonful at a time, whisking between each addition without overbeating. Whisk in the cornflour, then add the remaining 100g of sugar as before until smooth and thick.\r\nQuickly reheat the filling and pour it into the pastry case. Immediately put spoonfuls of meringue around the edge of the filling (if you start in the middle, the meringue may sink), then spread so it just touches the pastry (this will anchor it and help stop it sliding). Pile the rest into the centre, spreading so it touches the surface of the hot filling (and starts to cook), then give it all a swirl.\r\nReturn to the oven for 18-20 mins until the meringue is crisp and slightly coloured. Let the pie sit in the tin for 30 mins, then remove and leave for at least another 30 mins-1 hr before slicing. Eat the same day.', 'tony@stark.com', 'Tarte_au_citron.6373591fd5825.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `email` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `age`) VALUES
(57, 'Tony Stark', 'tony@stark.com', 'Password@123', 66);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
