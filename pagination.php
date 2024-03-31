<?php 

// Truy vấn danh sách bài viết từ cơ sở dữ liệu dựa trên phân trang
$sql = "SELECT COUNT(*) AS total FROM posts";
if(isset($_GET['category'])) {
    $category_slug = $_GET['category'];
    $sql = "SELECT COUNT(*) AS total FROM posts JOIN categories ON categories.id = posts.category_id WHERE categories.slug = '$category_slug'";
}
$totalResult = $conn->query($sql);
$totalPosts = $totalResult->fetch_assoc()['total'];
$conn->close();
$totalPages = ceil($totalPosts / $postsPerPage);

echo '<div class="pagination">';
echo '<div class="paginate-list">';
$category_slug = isset($category_slug) ? ('&category='. $category_slug) : '';
for ($i = 1; $i <= $totalPages; $i++) {
    $activeClass = ($i === $currentPage) ? 'paginate-active' : '';
    echo '<a href="?action=posts'. $category_slug .'&page=' . $i . '" class="paginate-link ' . $activeClass . '">' . $i . '</a>';
}
echo '</div>';

if ($currentPage < $totalPages) {
    $nextPage = $currentPage + 1;
    echo '<a href="?action=posts'. $category_slug .'&page=' . $nextPage . '" class="paginate-link">Next Page</a>';
}

echo '</div>';

?>