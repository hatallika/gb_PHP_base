<?php
function getCatalog()
{
    return getAssocResult("SELECT id, name, price, image, description FROM products");
}

function getProduct($id)
{
    return getOneResult("SELECT id, name, price, image, description FROM products WHERE id = {$id}");
}

function getCart ($session_id) {
    return getAssocResult("SELECT c.id as cart_id, c.product_id, p.name, p.price, p.image , c.quantity 
                        FROM products p JOIN cart c 
                        WHERE c.product_id = p.id AND c.session_id = '{$session_id}'");
}

function countCartProducts ($session_id){
    return getOneResult("SELECT SUM(quantity) as count FROM cart WHERE session_id = '{$session_id}'");
}

function addToCart($id, $session_id){
    //если товар уже есть в корзине, увеличим его количество, иначе добавим его в корзину.
    $result = mysqli_query(getDb(), "SELECT product_id FROM cart WHERE session_id = '{$session_id}' && product_id = '{$id}'" );
    if(mysqli_num_rows($result) == 0) {
        executeSql("INSERT INTO cart (session_id, product_id) VALUES ('{$session_id}', '{$id}')");
    } else {
        executeSql("UPDATE cart SET quantity = quantity + 1 WHERE session_id = '{$session_id}' && product_id = '{$id}'");
    }
}

function deleteFromCart($id, $session_id){
    executeSql("DELETE FROM cart WHERE id = {$id} AND session_id = '{$session_id}'"); //Сессия не нужна так как id уникальный
}

function totalPrice($session_id){
    return getOneResult("SELECT SUM(p.price * c.quantity) as summ FROM products p 
                            JOIN cart c WHERE c.product_id = p.id AND session_id = '{$session_id}'");
}

function addOrder($session_id, $params){
    executeSql("INSERT INTO orders (name, phone, cart_session_id) VALUES ('{$params['name']}','{$params['phone']}', '{$session_id}')");
}

function addOneItem($session_id, $product_id){

    executeSql("UPDATE cart SET quantity = quantity + 1 WHERE product_id={$product_id} AND session_id = '{$session_id}'");
}

function deleteOneItem($session_id, $product_id){
    $result = getOneResult("SELECT quantity, id FROM cart WHERE product_id = {$product_id} AND session_id = '{$session_id}'");

    if ($result['quantity'] > 1){
        executeSql("UPDATE cart SET quantity = quantity - 1 WHERE product_id = {$product_id} AND session_id = '{$session_id}'");
    } else {
        deleteFromCart($result['id'], $session_id);
    }
}

function doCartAction($action, $cart_id){};
