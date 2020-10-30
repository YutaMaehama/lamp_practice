SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- テーブルの構造 `orders`
--

CREATE TABLE `orders` (
  `order_id` INT AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  primary key(`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- テーブルの構造 `purchase_items`
--

CREATE TABLE `purchase_items` (
  `order_id` INT NOT NULL,
  `purchase_name` VARCHAR(100) NOT NULL,
  `purchase_price` INT NOT NULL DEFAULT 0 ,
  `amount` INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

