<?php
$select = $pdo->prepare("SELECT COUNT(*) AS all_topics FROM topics;");
$select->execute();
$allTopics = $select->fetch();

//Number of posts of inside every category

$category_query = "SELECT 
categories.id AS id, 
categories.name AS name, 
COALESCE(COUNT(topics.category), 0) AS count_category
FROM categories
LEFT JOIN topics ON categories.name = topics.category
GROUP BY categories.name;
";
$category = $pdo->prepare($category_query);
$category->execute();
$allCategories = $category->fetchAll();

//forum stats

//User count
$user_query = "SELECT COUNT(*) AS count_users FROM users";
$users = $pdo->prepare($user_query);
$users->execute();

$allUsers = $users->fetch();

//Topic count
$topics_query = "SELECT COUNT(*) AS count_topics FROM topics";
$topics = $pdo->prepare($topics_query);
$topics->execute();

$totalTopics = $topics->fetch();

//Categoris count
$cat_query = "SELECT COUNT(*) AS count_cats FROM categories";
$cats = $pdo->prepare($cat_query);
$cats->execute();

$totalCats = $cats->fetch();
?>

<div class="col-md-4">
    <div class="sidebar">


        <div class="block">
            <h3>Categories</h3>
            <div class="list-group block ">
                <a href="#" class="list-group-item active">All Topics <span class="badge pull-right">
                        <?php echo $allTopics->all_topics; ?>
                    </span></a>
                <?php foreach ($allCategories as $row): ?>
                    <a href="/forum/categories/show.php?name=<?php echo urlencode($row->name); ?>"
                        class="list-group-item">
                        <?php echo $row->name; ?><span class="color badge pull-right">
                            <?php echo $row->count_category; ?>
                        </span>
                    </a>

                <?php endforeach; ?>
            </div>
        </div>

        <div class="block" style="margin-top: 20px;">
            <h3 class="margin-top: 40px">Forum Statistics</h3>
            <div class="list-group">
                <a href="#" class="list-group-item">Total Number of Users:<span
                        class="color badge pull-right"><?php echo $allUsers->count_users; ?></span></a>
                <a href="#" class="list-group-item">Total Number of Topics:<span
                        class="color badge pull-right"><?php echo $totalTopics->count_topics; ?></span></a>
                <a href="#" class="list-group-item">Total Number of Categories: <span
                        class="color badge pull-right"><?php echo $totalCats->count_cats; ?></span></a>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div><!-- /.container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/forum/js/bootstrap.js"></script>
</body>

</html>