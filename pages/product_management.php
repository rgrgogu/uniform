<?php
session_start();
include('../PHP Database/dbcon.php');

$newAdmin = $_SESSION['object'];

$query = "SELECT * FROM uniform_db.product_list";
$query_run = mysqli_query($con, $query);

$arr = array();

$name_query = "SELECT product_name FROM product_list";
$name_queryRun = mysqli_query($con, $name_query);
$data = mysqli_fetch_all($name_queryRun);

for ($x = 0; $x < mysqli_num_rows($name_queryRun); $x++) {
    array_push($arr, $data[$x][0]);
}

// print_r($arr);

$query1 = "SELECT COUNT(product_id) FROM `product_list`;";
$query_run1 = mysqli_query($con, $query1);
$count = $query_run1->fetch_assoc()['COUNT(product_id)'];
$arr1 = array();

if ($count > 0) {
    for ($x = 0; $x < $count; $x++) {
        $pr_query = "SELECT `size_type`, `stocks`, `price` FROM `$arr[$x]`;";
        $query_run2 = mysqli_query($con, $pr_query);

        array_push($arr1, mysqli_fetch_all($query_run2));
    }
}

$_SESSION['arr'] = $arr1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="../dist/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Product Management | E-Shop</title>
    <style>
        .img {
            height: 250px;
            width: 900px;
        }

        .card {
            margin: 0 5px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body class="bg-gradient-to-t from-white to-[#2E849F]">

    <header id="navbar-container">
        <nav class="lg:container lg:mx-auto flex items-center justify-between sm:p-4 lg:p-6">
            <div id="logo" class="sm:w-40 lg:w-60">
                <a href="../">
                    <img src="../src/assets/plm-logo--with-header.png" alt="">
                </a>
            </div>
            <div id="search" class="w-96 sm:hidden lg:block">
                <div class="input-group relative flex flex-nowrap items-stretch w-full">
                    <input type="search" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded-tl-lg rounded-bl-lg transition ease-in-out m-0" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-tr-lg rounded-br-lg flex items-center">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="sm:hidden lg:flex lg:items-center">
                <div id="home" class="lg:mr-6">
                    <a href="./order_management.php">
                        <button class="text-white">Home</button>
                    </a>
                </div>
                <div id="login" class="lg:mr-6">
                    <a href="./profiles.php">
                        <button class="text-white">My Profile</button>
                    </a>
                </div>
                <div id="register" class="lg:mr-6">
                    <a href="../index.php">
                        <button class="text-white">Logout</button>
                    </a>
                </div>
                <!-- <div id="cart" class="">
                    <span class="material-symbols-outlined text-3xl cursor-pointer">
                        shopping_bag
                    </span>
                </div> -->
            </div>
            <div id="menu" class="cursor-pointer lg:hidden">
                <span class="material-symbols-outlined pointer-events-none">
                    menu
                </span>
            </div>
        </nav>
        <aside id="sidebar" class="bg-blue-500 p-4 text-white sm:hidden">
            <div id="search" class="w-full mb-4">
                <div class="input-group relative flex flex-nowrap items-stretch w-full">
                    <input type="search" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded-tl-lg rounded-bl-lg transition ease-in-out m-0" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-tr-lg rounded-br-lg flex items-center">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div id="home" class="lg:mr-6">
                <a href="./order_management.php">
                    <button class="text-white">Home</button>
                </a>
            </div>
            <div id="register" class="sm:mb-2">
                <a href="./profiles.php">
                    <button class="text-white">My Profile</button>
                </a>
            </div>
            <div id="login" class="">
                <a href="../login.php">
                    <button class="text-white">Logout</button>
                </a>
            </div>
        </aside>
        <aside id="sidebar-menu" class="bg-[#2E849F] p-4 text-white sm:hidden lg:block">
            <section class="lg:container lg:mx-auto lg:flex lg:items-stretch lg:justify-around">

                <div id="page1" class="hover:text-purple-900">
                    <a href="order_management.php">
                        <button class="text-white">Order Management</button>
                    </a>
                </div>
                <div id="page2" class="hover:text-purple-900">
                    <a href="product_management.php">
                        <button class="text-white">Products</button>
                    </a>
                </div>

            </section>
        </aside>
    </header>

    <main id="bulletin" class="sm:p-6 lg:p-12">
        <aside class=" flex items-center flex-col lg:container lg:mx-auto">
            <div class="container-fluid px-4 ">
                <h4 class="">ADMIN</h4>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item">Product</li>
                </ol>

                <?php include('../PHP Database/messages.php'); ?>

                <div class="mb-5 rounded text-dark " style="background-color: #eee;">
                    <div class="card-header">
                        <h4 class="p-3">Products
                            <a href="add_product.php" id="create_new" class="btn btn-primary float-end"><span class="fas fa-plus"></span> Add New Product</a>
                        </h4>
                    </div>
                    <div class="px-3 py-3 row" style="justify-content: center;">
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            $table = 0;
                            while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>

                                <div class="card  text-dark  bg-info  " style="width: 18rem;">
                                    <?php
                                    echo "<img class='card-img-top img  mt-3 rounded-3 ' src='../src/assets/" . $row['product_img'] . "' >";
                                    ?>
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold uppercase"><?php echo $row['product_name']; ?></h5>
                                        <p class="card-text">Stocks:</p>
                                        <p class="card-text">
                                            <?php
                                            for ($i = 0; $i <= mysqli_num_rows($name_queryRun); $i++) {
                                                echo $arr1[$table][$i][0] . " - " . $arr1[$table][$i][1] . " = " . $arr1[$table][$i][2] . "<br>";
                                            }
                                            $table++;
                                            ?></p>
                                        <div class="col-12 mt-2 d-flex justify-content-center align-items-center pt-1 pb-1 row p-1" style="margin-left:-3px">
                                            <a class="btn btn-primary btn-marg" href="update_product.php?product_id=<?php echo $row['product_id']; ?>">Update</a>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center pt-1 pb-1 row p-1" style="margin-left:-3px">
                                            <a class="btn btn-danger btn-marg" href="delete_product.php?product_id=<?php echo $row['product_id']; ?>">Delete</a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- <table class="table table-light  table-hover">
                <thead>
                    <tr>
           
                </tr>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Items/Bought</th>
                        <th>Payment Method</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM uniform_db.client_info";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $rows) {
                    ?>
                            <tr>
                                <td><?= $rows['order_id']; ?></td>
                                <td><?= $rows['Firstname']; ?></td>
                                <td><?= $rows['product_type']; ?></td>
                                <td><?= $rows['total_price']; ?></td>
                                <td><?= $rows['status']; ?></td>

                                <td><a href="edit-registeredusers.php?id=<?= $rows['ID']; ?>" class="btn btn-success ">Edit</a></td>
                                <td>
                                    <form action="code.php" method="POST">
                                        <button type="submit" name="delete_registered_btn" value="<?= $rows['ID']; ?>" class="btn btn-danger">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7">No Record Found</td>
                        </tr>

                    <?php
                    }
                    ?>

                </tbody>
            </table> -->
            <!-- NO CONTENTS -->
            <!-- <div id="dropdown-menu">
                <div class="border-inherit shadow-xl p-6 md:w-[30rem] lg:w-[40rem] rounded-xl cursor-pointer">
                    <div id="dropdown" class="flex items-center justify-between">
                        <span class="font-bold text-xl">Shipping & Delivery</span>
                        <i class="material-symbols-outlined">expand_more</i>
                    </div>
                    <div id="drop-content" class="sm:hidden">
                        <h2>How long before my orders get delivered?</h2>
                        <p>Standard Shipping: Metro Manila - 1 to 3 working days</p>
                        <p>Provincial Areas - 7 to 14 working days</p>
                    </div>
                </div>
                <div class="border-inherit shadow-xl p-6 md:w-[30rem] lg:w-[40rem] rounded-xl cursor-pointer">
                    <div id="dropdown2" class="flex items-center justify-between">
                        <span class="font-bold text-xl">Payment Methods</span>
                        <i class="material-symbols-outlined">expand_more</i>
                    </div>
                    <div id="drop-content2" class="sm:hidden">
                        <h2 class="font-bold">GCASH: (+63)967-205-2107</h2>
                        <p>Send screenshot of payment thru out email: plmcoop@plm.edu.ph</p>
                        <h2 class="font-bold">Cash on Delivery</h2>
                        <h2 class="font-bold">Store Pick Up</h2>
                        <p>Present the QR Code that given to you by our staffs</p>
                    </div>
                </div>
            </div> -->
        </aside>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../src/DOM.js"></script>
</body>

</html>