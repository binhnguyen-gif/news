<?php
include '../db_config.php';
include 'list_category.php';

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Kiểm tra xem có tham số id của bài viết được truyền qua URL không
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    
    // Truy vấn bài viết cần sửa từ cơ sở dữ liệu
    $sql = "SELECT posts.*,categories.name as cagetory_name  FROM posts JOIN categories on categories.id = posts.category_id WHERE posts.id = $post_id";
    $result = $conn->query($sql);
   
    if ($result && $result->num_rows == 1) {
        // Lấy thông tin của bài viết từ kết quả truy vấn
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
        $author = $row['author'];
        $category_id = $row['category_id'];
        $details = $row['details'];
        $cagetory_name = $row['cagetory_name'];
    } else {
        echo "Không tìm thấy bài viết.";
        exit();
    }
} else {
    echo "Tham số id bài viết không được truyền.";
    exit();
}

// Xử lý cập nhật bài viết khi người dùng nhấn nút "Lưu"
if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['update_post'])) {
    $new_title = $_POST['title'];
    $new_description = $_POST['description'];
    $new_author = $_POST['author'];
    $new_category_id = $_POST['category_id'];
    $slug = create_slug($new_title);

     // Kiểm tra nếu có upload ảnh mới
     if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Xử lý upload ảnh mới
        $target_dir = dirname(__DIR__) . '/assets/images/';
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra kích thước tệp
        if ($_FILES["image"]["size"] > 500000) {
            echo "Xin lỗi, tệp quá lớn.";
            $uploadOk = 0;
        }

        // Kiểm tra định dạng ảnh cho phép
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Xin lỗi, chỉ cho phép tải lên các tệp JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            // Nếu mọi thứ đều ổn, thực hiện lưu ảnh mới
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_url = $_FILES["image"]["name"];
                // Cập nhật đường dẫn ảnh mới vào cơ sở dữ liệu
                $update_sql = "UPDATE posts SET title='$title', description='$description', author='$author', category_id='$category_id', image_url='$image_url', slug='$slug', 'details='$details' WHERE id=$post_id";

                if ($conn->query($update_sql) === TRUE) {
                    echo "Bài viết đã được cập nhật thành công.";
                    // Redirect hoặc thực hiện hành động khác sau khi cập nhật thành công
                    header("Location: index.php");
        
                } else {
                    echo "Lỗi khi cập nhật bài viết: " . $conn->error;
                }
            } else {
                echo "Có lỗi khi tải lên ảnh mới.";
            }
        }
    } else {
        // Nếu không có upload ảnh mới, chỉ cập nhật thông tin khác của bài viết
        $update_sql = "UPDATE posts SET title='$title', description='$description', author='$author', category_id='$category_id' WHERE id=$post_id";

        if ($conn->query($update_sql) === TRUE) {
            echo "Bài viết đã được cập nhật thành công.";
        } else {
            echo "Lỗi khi cập nhật bài viết: " . $conn->error;
        }
    }

}
$conn->close();
?>

<h1>Sửa bài viết</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $post_id; ?>" method="post"
    enctype="multipart/form-data">
    <label for="title">Tiêu đề:</label><br>
    <input type="text" id="title" name="title" value="<?php echo $title; ?>" required><br>

    <label for="description">Mô tả:</label><br>
    <textarea id="description" name="description" rows="4" cols="50" required><?php echo $description; ?></textarea><br>

    <label for="description">Chi tiết bài viết:</label><br>
    <textarea id="details" name="details" rows="4" cols="100" required><?php echo $details; ?></textarea><br>

    <label for="author">Tác giả:</label><br>
    <input type="text" id="author" name="author" value="<?php echo $author; ?>" required><br>

    <label for="image">Chọn ảnh:</label><br>
    <input type="file" id="image" name="image" accept="image/*" required><br><br>

    <label for="category_id">Thể loại:</label><br>
    <select name="category_id">
        <option value="" selected>Chọn thể loại</option>
        <?php foreach($categories as $category) { ?>
        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php } ?>
    </select>
    <div style="margin-bottom: 32px;"></div>
    <!-- <input type="text" id="category_id" name="category_id" value="<?php echo $category_id; ?>" required><br><br> -->

    <button type="submit" name="update_post" value="Lưu bài viết">Lưu bài viết</button>
</form>