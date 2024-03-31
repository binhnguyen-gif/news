<?php
require_once 'trending.php';

if(isset($_GET['slug'])) {
    $slug = $_GET['slug'];
}
$sql_detail = "SELECT posts.*, categories.name as category_name  
               FROM posts 
               JOIN categories ON categories.id = posts.category_id 
               WHERE posts.slug = '$slug' 
               LIMIT 1";
$result_detail = $conn->query($sql_detail);

$postDetail = [];

if ($result_detail && $result_detail->num_rows > 0) {
    // Lấy dữ liệu của bản ghi duy nhất
    $postDetail = $result_detail->fetch_assoc();
} else {
    echo "Không có bài viết nào.";
}
?>

<main class="main-body__news">
    <div class="grid wide">
        <div class="news-lists">
            <div class="row">
                <div class="col c-8">
                    <img src="assets/images/<?= $postDetail['image_url'] ?>" class="new-img__detail" alt="">
                    <span class="note-info__img">(Photo credit: Oleksii Karamanov / Getty Images)</span>

                    <div class="news-content__detail">
                        <h1><?= $postDetail['title'] ?></h1>
                        <div class="author">
                            By <span><?= $postDetail['author'] ?></span>
                        </div>
                        <p>
                            <?= $postDetail['description'] ?>
                        </p>
                        <div>
                            <?= $postDetail['details'] ?>
                        </div>
                    </div>
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
                                <a href="" class="trending-title">
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