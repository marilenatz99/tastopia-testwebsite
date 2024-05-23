<?php

// Database connection 
$conn = mysqli_connect('localhost', 'id21864427_user', 'User12345!', 'id21864427_database1');

$filename = './categories.json';
$filename2 = './menu.json';

$data = file_get_contents($filename);
$data2 = file_get_contents($filename2);

$array = json_decode($data, true);
$array2 = json_decode($data2, true);

foreach ($array as $value) {
  $sql = "INSERT INTO food_categories (id, name, image) VALUES (" . $value['id'] . ", '" . $value['name'] . "', '" . $value['image'] . "')";
  echo $sql;
  if ($conn->query($sql) === TRUE) {
    echo "Insert your food categories successfully";
  }
};

foreach ($array2 as $value) {
  $sql2 = "INSERT INTO menu_items (id, title, categoryId, ingredients, descr, price, image) VALUES (" . $value['id'] . ", '" . $value['title'] . "', " .
    $value['categoryId'] . ", '" . implode(', ', $value['ingredients']) . "', '" . $value['descr'] . "', " . $value['price'] . ", '" . $value['image'] . "')";

  if ($conn->query($sql2) === TRUE) {
    echo "Insert your menu successfully";
  }
};
