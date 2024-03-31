<?php
include '../db_config.php';
include 'list_category.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_post'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = date('Y-m-d'); // Lấy ngày hiện tại
    $author = $_POST['author'];
    $category_id = $_POST['category_id'];
    $details = $_POST['details'];
    $slug = create_slug($title);

   // Kiểm tra xem người dùng đã upload ảnh chưa
   if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $target_dir = dirname(__DIR__) . '/assets/images/';

    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra định dạng ảnh cho phép
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($imageFileType, $allowed_types)) {
        echo "Xin lỗi, chỉ cho phép tải lên các tệp JPG, JPEG, PNG & GIF.";
        exit();
    }

    // Kiểm tra kích thước tệp
    if ($_FILES["image"]["size"] > 500000) {
        echo "Xin lỗi, tệp quá lớn.";
        exit();
    }

    // Di chuyển tệp upload vào thư mục lưu trữ
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_url = $_FILES["image"]["name"];

        // Thêm bài viết vào cơ sở dữ liệu với đường dẫn ảnh
        $sql = "INSERT INTO posts (title, description, date, author, category_id, image_url, slug, details) VALUES ('$title', '$description', '$date', '$author', '$category_id', '$image_url', '$slug', '$details')";
        if ($conn->query($sql) === TRUE) {
            echo "Bài viết đã được thêm thành công.";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Có lỗi khi tải lên tệp của bạn.";
    }
} else {
    echo "Vui lòng chọn ảnh để tải lên.";
}
}
$conn->close();
?>

<h1>Thêm bài viết mới</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <label for="title">Tiêu đề:</label><br>
    <input type="text" id="title" name="title" required><br>

    <label for="description">Mô tả:</label><br>
    <textarea id="description" name="description" rows="4" cols="50" required></textarea><br>

    <label for="description">Chi tiết bài viết:</label><br>
    <textarea id="details" name="details" rows="4" cols="100" required></textarea><br>

    <label for="author">Tác giả:</label><br>
    <input type="text" id="author" name="author" required><br>

    <label for="image">Chọn ảnh:</label><br>
    <input type="file" id="image" name="image" accept="image/*" required><br><br>


    <label for="category_id">Thể loại:</label><br>
    <select name="category_id" >
        <option value="" selected>Chọn thể loại</option>
        <?php foreach($categories as $category) { ?>
            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php } ?>
    </select>
    <!-- <input type="text" id="category_id" name="category_id" required><br><br> -->
    <div style="margin-bottom: 32px;"></div>
    <button type="submit" name="create_post" value="Thêm bài viết">Thêm bài viết</button>
</form>