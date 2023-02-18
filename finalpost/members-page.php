<?php
ob_start();
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)) {
	header("Location: login.php");
	exit();
}
include 'header-members.php';
echo '<h2 class="text-center">Welcome to the Members Page';
if (isset($_SESSION['fname'])) {
	echo " " . "{$_SESSION['fname']}";
}
echo '</h2>';
ob_end_flush();
?>
<h3>Members Events</h3>
<p>
	<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt aspernatur qui voluptatum voluptate, corporis cupiditate doloribus nesciunt, sapiente vitae facilis, ad quis soluta! Deleniti, in, perferendis minima voluptate aperiam beatae.</span>
	<span>Odio veritatis voluptas, ab odit, eaque provident mollitia rem aspernatur illum, deleniti ea ad nostrum doloremque aliquid molestiae error cum! Sint repellendus molestiae ad asperiores expedita. Voluptatem eos dicta atque.</span>
	<span>Deserunt possimus commodi dolorum vitae veniam, expedita totam, at voluptatem eum autem officiis sit ipsa deleniti odio officia perspiciatis pariatur ipsum distinctio repellat rem soluta id qui alias sequi! Alias.</span>
	<span>Saepe animi sit sed ipsam tempora, modi, non beatae molestias dicta, iusto, sint assumenda eum delectus. Labore vitae libero consequatur similique repellat accusamus, unde in voluptatibus incidunt eaque, voluptatum, modi.</span>
	<span>Accusantium, voluptate! Fugiat tempora, corrupti voluptatibus laborum blanditiis officia adipisci sed unde itaque inventore perferendis id, nemo neque. Dicta quas cumque consequatur quis placeat rem corrupti, rerum tempora tempore, odio.</span>
</p>
