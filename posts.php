<?php
require_once 'trending.php';
// Truy vấn danh sách bài viết từ cơ sở dữ liệu
$sql_init = "SELECT posts.* FROM posts LIMIT 3";
if(isset($_GET['category'])) {
    $category_slug = $_GET['category'];
    $sql_init = "SELECT posts.*, categories.name as category_name FROM posts JOIN categories ON categories.id = posts.category_id WHERE categories.slug = '$category_slug' LIMIT 3";
}
// $sql = "SELECT posts.*,categories.name as category_name  FROM posts JOIN categories on categories.id = posts.category_id";

$postsPerPage = 5;

// Xác định trang hiện tại
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = intval($_GET['page']);
} else {
    $currentPage = 1;
}



// Tính vị trí bắt đầu của danh sách bài viết trên trang hiện tại
$startFrom = ($currentPage - 1) * $postsPerPage;

$sql = "SELECT posts.*, categories.name as category_name FROM posts JOIN categories ON categories.id = posts.category_id LIMIT $startFrom, $postsPerPage";

if(isset($_GET['category'])) {
    $category_slug = $_GET['category'];
$sql = "SELECT posts.*, categories.name as category_name FROM posts JOIN categories ON categories.id = posts.category_id WHERE categories.slug = '$category_slug' LIMIT $startFrom, $postsPerPage";
}


$result_init = $conn->query($sql_init);
$result = $conn->query($sql);

$postInit = [];
$postList = [];

if ($result_init && $result_init->num_rows > 0) {
    // Lưu dữ liệu vào mảng
    while ($row = $result_init->fetch_assoc()) {
        $postInit[] = $row;
    }
} 

if ($result && $result->num_rows > 0) {
    // Lưu dữ liệu vào mảng
    while ($row = $result->fetch_assoc()) {
        $postList[] = $row;
    }
} 
?>

<main class="main-body__news">
    <div class="grid wide">
        <h1 class="main-heading">
            News
        </h1>
        <div class="crossbar">
        </div>
        <div class="main-about">
            <div class="row">
                <div class="col c-8">
                    <img src="assets/images/<?= $postInit[0]['image_url'] ?? '' ?>" class="thumbnail-img" alt="">
                    <h3 class="news-about__title">
                        <a href="<?php echo getCleanURL($current_url) . '?action=detail&slug=' . $postInit[0]['slug'] ?? ''  ?>" class="news-right__link">
                            <?= $postInit[0]['title'] ?? '' ?> </a>
                    </h3>
                    <a href="" class="news-btn">News</a>
                </div>
                <div class="col c-4">
                    <div class="post-thumbnail">
                        <img src="assets/images/<?= $postInit[1]['image_url'] ?? '' ?>" class="thumbnail-img" alt="">
                        <h3 class="news-about__title">
                            <a href="<?php echo getCleanURL($current_url) . '?action=detail&slug=' . $postInit[1]['slug'] ?? ''  ?>" class="news-left__link">
                                <?= $postInit[1]['title'] ?? '' ?> </a>
                        </h3>
                        <a href="" class="news-btn">News</a>
                    </div>
                    <div class="post-thumbnail">
                        <img src="assets/images/<?= $postInit[2]['image_url'] ?? '' ?>" class="thumbnail-img" alt="">
                        <h3 class="news-about__title">
                            <a href="<?php echo getCleanURL($current_url) . '?action=detail&slug=' . $postInit[2]['slug'] ?? ''  ?>" class="news-left__link">

                                <?= $postInit[2]['title'] ?? '' ?> </a>
                        </h3>
                        <a href="" class="news-btn">News</a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="news-crossbar">

        <div class="news-lists">
            <div class="row">
                <div class="col c-8">
                    <?php foreach ($postList as $post) { ?>
                    <div class="row mt-12">
                        <div class="col c-4">
                            <img src="assets/images/<?= $post['image_url']  ?>" class="thumbnail-img" alt="">
                        </div>
                        <div class="col c-7">
                            <a href="<?php echo getCleanURL($current_url) . '?action=detail&slug=' . $post['slug']  ?>" class="card-title">
                                <?= $post['title']  ?>
                            </a>
                            <p class="card-desc">
                                <?= $post['description']  ?>
                            </p>
                            <div class="card-category">
                                <a href="" class="card-category__title">
                                    <?= $post['category_name']  ?>
                                </a>
                                <a href="" class="card-category__author"><?= $post['author']  ?></a>
                                <a href="" class="card-category__time"><?= convertDateToAgo($post['date'])  ?></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php
                        require_once 'pagination.php';
                    ?>

                </div>
                <div class="col c-4">
                    <div class="trending">
                        <h3 class="trending-list">
                            Trending
                        </h3>
                        <div class="crossbar">
                        </div>

                        <?php foreach($postListTrending as $postTrending){ ?>
                        <div class="row mt-12">
                            <div class="col c-4">
                                <img src="assets/images/<?= $postTrending['image_url'] ?>" class="thumbnail-img" alt="">
                            </div>
                            <div class="col c-7">
                                <a href="<?php echo getCleanURL($current_url) . '?action=detail&slug=' . $postTrending['slug']  ?>" class="trending-title">
                                    <?= $postTrending['title'] ?>
                                </a>
                                <br>
                                <p class="trending-desc">
                                    <?= $postTrending['category_name'] ?>
                                </p>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
</main>