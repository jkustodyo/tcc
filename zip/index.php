<?php
include 'banco/conexao.php';

// Teste - pegando os dados do submit (botão)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Restante do código permanece o mesmo...


// Teste - pegando os dados do submit (botão)
if (isset($_POST['add'])) {
    $quantity = $_POST['quantity'];
    $hidden_image = $_POST['hidden_image'];
    $hidden_name = $_POST['hidden_name'];
    $hidden_price = $_POST['hidden_price'];

    // Inserindo - utilizando prepared statements
    $stmt = $conn->prepare("INSERT INTO cart (description, image, price) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $hidden_name, $hidden_image, $hidden_price);

    if ($stmt->execute()) {
        // Inserção bem-sucedida
        echo "Produto adicionado ao carrinho com sucesso.";
    } else {
        // Erro na inserção
        echo "Erro ao adicionar produto ao carrinho: " . $stmt->error;
    }

    $stmt->close();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>

    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="nav container">
            <a href="#" class="logo"> Comercio </a>

            <i class='bx bx-shopping-bag' id="cart-icon"></i>
            <div class="cart">
                <h2 class="cart-title"> Seu Carrinho</h2>

                <div class="cart-content">
<div class="cart-box">

</div>
                </div>

                <div class="total">
                    <div class="total-title">valor total</div>
                    <div class="total-price">$0.00</div>
                </div>

                <button type="button" class="btn-buy">Comprar agora</button>
                <i class="bx bx-x" id="close-cart"></i>
            </div>
        </div>
    </header>
    <br><br>
    <br><br>
    <section class="shop container">
        <h2 class="section-title"> Produtos </h2>

        <!-- produtos apareceram aqui -->
        <div class="shop-content">
            <main>
            <div class="product-box">
            <div class="container">
            <?php
            $query = "SELECT * FROM product_first ORDER BY id ASC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <div class="product">
                        <form action="index.php?action=add&id=<?php echo $row["id"] ?>" method="post">
                            <img src="img/<?php echo $row["image"]; ?>" alt="">
                            <h3><?php echo $row["description"] ?></h3>
                            <p>R$<?php echo $row["price"] ?></p>
                            <input type="text" id="quantity" name="quantity" value="1">
                            <input type="hidden" name="hidden_image" value="<?php echo $row["image"]; ?>">
                            <input type="hidden" name="hidden_name" value="<?php echo $row["description"]; ?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                            <input type="submit" name="add" value="adicionar ao carrinho">
                        </form>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        </main>
            </div>
        </div>
    </section>

    <script src="js/main.js"></script>

</body>
</html>