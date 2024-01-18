<?php
require '../includes/header.php';
require '../config/config.php';
?>

<?php


if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "SELECT * FROM topics WHERE id=:id";
	$singleTopic = $pdo->prepare($query);
	$singleTopic->execute([":id" => $id]);
	$topic = $singleTopic->fetch();

	//Number of post for every user
	$topicCountQuery = "SELECT COUNT(*) AS count_post FROM  topics WHERE username = :username";

	$topicCount = $pdo->prepare($topicCountQuery);
	$topicCount->execute([":username" => $topic->username]);
	$topicCount = $topicCount->fetch();

	//Grabbing replies
	$reply_query = "SELECT * FROM replies WHERE topic_id = :topic_id";
	$replies = $pdo->prepare($reply_query);
	$replies->execute([":topic_id" => $topic->id]);
	$replies = $replies->fetchAll();
}else{
	header("location: ../404.php");
}


//Dealing with replies


if (isset($_POST['repsubmit'])) {

	if (empty($_POST['reply'])) {
		echo "<script>alert('Reply box is empty.')</script>";
	} else {
		$repId = generateRandomStrings(8);
		$rep_body = $_POST['reply'];
		$user_id = $_SESSION['user_id'];
		$username = $_SESSION['email'];
		$user_image = $_SESSION['user_image'];
		$topic_id = $topic->id;






		$rep_query = "INSERT INTO replies (id,reply,user_id,username,user_image,topic_id) 
					VALUES(:id,:reply,:user_id,:username,:user_image,:topic_id)";

		$rep_insert = $pdo->prepare($rep_query);



		$rep_insert->execute([
			":id" => $repId,
			":reply" => $rep_body,
			":user_id" => $user_id,
			":username" => $username,
			":user_image" => $user_image,
			":topic_id" => $topic_id
		]);


		header("location: topic.php?id=" . $topic->id);



	}



}

function generateRandomStrings($length = 8)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="main-col">
				<div class="block">
					<h1 class="pull-left">
						<?php echo $topic->title; ?>
					</h1>
					<h4 class="pull-right">A Simple Forum</h4>
					<div class="clearfix"></div>
					<hr>
					<ul id="topics">
						<li id="main-topic" class="topic topic">
							<div class="row">
								<div class="col-md-2">
									<div class="user-info">
										<img class="avatar pull-left"
											src="../auth/img/<?php echo $topic->user_image; ?>" />
										<ul>
											<li><strong>
													<?php echo $topic->username ?>
												</strong></li>
											<li>Total post:
												<?php echo $topicCount->count_post; ?>
											</li>
											<li><a href="profile.php">Profile</a>
										</ul>
									</div>
								</div>
								<div class="col-md-10">
									<div class="topic-content pull-right">
										<p>
											<?php echo $topic->body; ?>
										</p>
									</div>

									<?php if (isset($_SESSION['username']) && $_SESSION['email'] == $topic->username): ?>
										<a class="btn btn-danger" href="delete.php?id=<?php echo $topic->id; ?>"
											role="button">Delete</a>
										<a class="btn btn-warning" href="update.php?id=<?php echo $topic->id; ?>"
											role="button">Update</a>
									<?php endif; ?>

								</div>
							</div>
						</li>

						<?php foreach ($replies as $reply): ?>
							<li class="topic topic">
								<div class="row">
									<div class="col-md-2">
										<div class="user-info">
											<img class="avatar pull-left"
												src="../auth/img/<?php echo $reply->user_image; ?>" />
											<ul>
												<li><strong>
														<?php echo $reply->username; ?>
													</strong></li>
												<!--<li>43 Posts</li> -->
												<li><a href="profile.php">Profile</a>
											</ul>
										</div>
									</div>
									<div class="col-md-10">
										<div class="topic-content pull-right">
											<p>
												<?php echo $reply->reply; ?>
											</p>
										</div>


										<?php if (isset($_SESSION['username']) && $_SESSION['email'] == $reply->username): ?>
											<a class="btn btn-danger"
												href="../replies/rep_delete.php?id=<?php echo $reply->id; ?>"
												role="button">Delete</a>
											<a class="btn btn-warning"
												href="../replies/rep_update.php?id=<?php echo $reply->id; ?>"
												role="button">Update</a>
										<?php endif; ?>

									</div>
								</div>
							</li>

						<?php endforeach; ?>

					</ul>
					<h3>Reply To Topic</h3>
					<form role="form" method="post" action="topic.php?id=<?php echo $topic->id; ?>">
						<div class="form-group">
							<textarea id="reply" rows="10" cols="80" class="form-control" name="reply"></textarea>
							<script>
								CKEDITOR.replace('reply');
							</script>
						</div>
						<button type="submit" name="repsubmit" class="color btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>
		<?php
		require '../includes/footer.php';

		?>