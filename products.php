<?php 
include "header.php";
include "config.php";
?>
<div id="main">
    <div id="products">
        <?php 
        foreach ($products as $key => $value) {
            echo "
            <div id='products-101' class='product'>
            <img src='./images/$value[image]'>
            <h3 class='title'><a href='#'>$value[name]</a></h3>
            <span>Price:$value[price]</span>
            <form id='contact-form' action='' method='post'>
            <input type='text' name='data' value='$value[id]' hidden>
            <input type='submit' class='add' name='submit' value='Add to Product'>
            </form>
            </div>
            ";
        }
        ?>
    </div>
    <?php 
if (!setset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if ($_SERVER["REQUEST METHOD"] == "POST") {
    $data = $_POST["data"];
    $flag = 0;
    foreach ($products as $key => $value) {
        if ($value["id"] == $data) {
            if(empty($_SESSION['cart'])) {
                $q=1;
                $t_price=$q*$value["price"];
                $pro = array("id" => $value["id"],"name" => $value["name"],
                "image" => $value["image"], "price"=>$value["price"], "quantity"=>$q, "total"=>$t_price);
                array_push($_SESSION['cart'], $pro);
            }else{
                foreach($_SESSION['cart'] as $a => $p) {
                    if ($p['id'] == $data) {
                        $_SESSION['cart'][$a]["quantity"] = $p["quantity"] + 1;
                        $flag=1;
                    }
                }
            }
            if($flag==0) {
                $q=1;
                $t_price=$q*$value["price"];
                $pro = array("id" => $value["id"],"name" => $value["name"],
                "image" => $value["image"], "price"=>$value["price"], "quantity"=>$q, "total"=>$t_price);
                array_push($_SESSION['cart'], $pro);
            }
        }
    }
};
?>
<div class="mycart" id="mycart">
    <h1 style="text-align: center;">My Cart</h1>
    <div id="table">
        <table id="mycart_table">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Remove</th>
</tr>
<?php 
foreach ($_SESSION['cart'] as $key => $value) {
    echo "<tr>
    <td>$value[id]</td>
    <td>$value[name]</td>
    <td>$value[price]</td>
    <td>$value[quantity]</td>
    <td class='total'>$value[total]</td>
    <td class='remove'><a href='remove.php?id=$value[id]'>X</a></td>
    </tr>";
};
?>
</table>
</div>
</div>
</div>