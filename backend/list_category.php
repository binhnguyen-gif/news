<?php 
$sql_category = "SELECT categories.* FROM categories";
$resultCategories = $conn->query($sql_category);

$categories = [];

if ($resultCategories && $resultCategories->num_rows > 0) {
// Lưu dữ liệu vào mảng
while ($row = $resultCategories->fetch_assoc()) {
    $categories[] = $row;
}
} else {
echo "Không có bài viết nào.";
}


?>