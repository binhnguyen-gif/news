<?php
$sql1 = "SELECT posts.*,categories.name as category_name  FROM posts JOIN categories on categories.id = posts.category_id ORDER BY view DESC LIMIT 5";
$result1 = $conn->query($sql1);

$postListTrending = [];

if ($result1 && $result1->num_rows > 0) {
    // Lưu dữ liệu vào mảng
    while ($row = $result1->fetch_assoc()) {
        $postListTrending[] = $row;
    }
} else {
    echo "Không có bài viết nào.";
}