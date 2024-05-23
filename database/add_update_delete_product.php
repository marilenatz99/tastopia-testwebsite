<?php
ob_start();

session_start();

if ($_POST['case'] == 'add')
    addProduct();
else if ($_POST['case'] == 'update')
    updateCart($_POST['quantity'], $_POST['price'], $_POST['id']);
else if ($_POST['case'] == 'delete')
    deleteProduct($_POST['id']);
else {
    echo 'case error';
}

function addProduct()
{
    include 'config.php';

    $email = $_SESSION['email'];

    $menuItemId = $_POST['menuItemId'];
    
    // Checks if the food alredy exists in the cart
    $query = "SELECT * FROM cart c WHERE c.userEmail='$email' AND c.menuItemId=" . $menuItemId;

    $result = mysqli_query($db, $query);
    
    // if exists updates the quantity
    if (mysqli_num_rows($result) > 0) 
    {
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $quant = intval($row['quantity']) + 1;
            updateCart($quant, $price, $row['id']);
        }
    } else 
    {
        // SQL QUERY 
        $query1 = "SELECT * FROM `menu_items` WHERE id=" . $menuItemId; 
          
        // FETCHING DATA FROM DATABASE 
        $result1 = $db->query($query1); 
          
        if ($result1->num_rows > 0)  
        { 
            // OUTPUT DATA OF EACH ROW 
            while($row = $result1->fetch_assoc()) 
            { 
                $total_price = 1 * intval($row['price']);
                
                $sql = "INSERT INTO cart VALUES (null, " . $menuItemId . ", 1, '" . $email  . "', 'no', " . $total_price . ")";

                if (mysqli_query($db, $sql)) {
                    echo 'Food added successfully';
                } else {
                    echo 'Error: ' . $sql . '<br>' . mysqli_error($db);
                }
            } 
        }  
        else { 
            echo "0 results"; 
        } 
    }
}

function updateCart($quantity, $price, $id)
{
    include 'config.php';

    $email = $_SESSION['email'];

    $total_price = $quantity * $price;

    $sql = "UPDATE cart SET quantity='$quantity', total_price='$total_price' WHERE id='$id' and userEmail='$email'";
    echo $sql;
    if (mysqli_query($db, $sql)) {
        echo 'Food updated successfully';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}

function deleteProduct($id)
{
    include 'config.php';

    $email = $_SESSION['email'];

    $sql = "DELETE FROM cart WHERE userEmail='$email' and id='$id'";
    if (mysqli_query($db, $sql)) {
        echo 'Food removed successfully';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}
?>