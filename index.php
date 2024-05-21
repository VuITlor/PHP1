<?php
include_once('./DBUtil.php');

$dbHelper = new DBUntil();

$categories = $dbHelper->select("select * from categories");
$error = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['name']) || empty($_POST['name'])) {
       $error['name'] = "error";
    }
    else{
        /**
         * call insert db to untils
         */
        $isCreat = $dbHelper->insert('categories', array('name' => $_POST['name']));
        var_dump($isCreat);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        <h2>Basic Table</h2>
        <form action="index.php" method="post">
            <input type="text" name="name" placeholder="Ten Danh Muc">
            <input type="submit" class="btn btn-success" value="Them moi">
            <?php
            if (isset($error['name'])) {
                echo "<br>";
                echo "<span> $error[name]</span>";}
            ?>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>action</th>
                </tr>
            </thead>

            <?php
            foreach ($categories as $cat) {
                echo "<tr>";
                echo "<td>$cat[id]</td>";
                echo "<td>$cat[name]</td>";
                echo "<td> <a href='delete.php?id=$cat[id]'>remove</a> <a href='edit.php?id=$cat[id]'>Update</a></td>";
                echo "</tr>";
            }
            ?>
            </tr>
        </table>
    </div>

</body>

</html>