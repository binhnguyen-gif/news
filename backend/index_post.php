<?php
include '../db_config.php';

if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Truy vấn để xóa bài viết từ cơ sở dữ liệu
    $delete_sql = "DELETE FROM posts WHERE id = $delete_id";
    
    if ($conn->query($delete_sql) === TRUE) {
        echo "Bài viết đã được xóa thành công.";
    } else {
        echo "Lỗi khi xóa bài viết: " . $conn->error;
    }
}
// Truy vấn danh sách bài viết từ cơ sở dữ liệu
$sql = "SELECT posts.*,categories.name as cagetory_name  FROM posts JOIN categories on categories.id = posts.category_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Hiển thị dữ liệu cho mỗi bài viết
    while ($row = $result->fetch_assoc()) {
        echo '<div class="post">';
        echo '<h2>' . $row['title'] . '</h2>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<p><strong>Ngày đăng:</strong> ' . $row['date'] . '</p>';
        echo '<p><strong>Tác giả:</strong> ' . $row['author'] . '</p>';
        echo '<p><strong>Thể loại:</strong> ' . $row['cagetory_name'] . '</p>';
        // echo '<p><a href="update_post.php?id=' . $row['id'] . '">Xem chi tiết</a></p>';
        echo '<p><a href="update_post.php?id=' . $row['id'] . '">Chỉnh sửa</a> | <a href="?delete_id=' . $row['id'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa bài viết này?\')">Xóa</a></p>';

        echo '</div>';
    }
} else {
    echo "Không có bài viết nào.";
}
$conn->close();
?>