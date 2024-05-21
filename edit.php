<?php
include_once('./DBUtil.php');

$dbHelper = new DBUntil();


$error = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['name']) || empty($_POST['name'])) {
       $error['name'] = "error";
    }
    else {
        // Lấy dữ liệu từ form và thực hiện cập nhật
        $id = $_POST['id'];
        $name = $_POST['name'];
        $isUpdated = $dbHelper->update('categories', ['name' => $name], "id = $id");
        if ($isUpdated) {
            header("Location: index.php");
            exit;
        } else {
            $error['database'] = "Không thể cập nhật danh mục. Vui lòng thử lại.";
        }
    }
}

$id = $_GET['id'];
$category = $dbHelper->select("SELECT * FROM categories WHERE id = $id")[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chỉnh sửa danh mục</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        <h2>Chỉnh sửa danh mục</h2>
        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $category['name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <?php
            if (isset($error['name'])) {
                echo "<br><span class='text-danger'>$error[name]</span>";
            }
            if (isset($error['database'])) {
                echo "<br><span class='text-danger'>$error[database]</span>";
            }
            ?>
        </form>
    </div>

</body>

</html>