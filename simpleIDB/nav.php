<?php include ('html5req.php'); ?>
<nav class="top-bar" data-topbar role="navigation" data-options="is_hover: false">
    <ul class="title-area">
        <li class="name">
            <h1><a href="index.php">Simple IDB</a></h1>
        </li>
        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>MENU</span></a></li>
    </ul>
<section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
        <li><a href="page1.php" title="Return to Home Page">Home Page</a></li>
        <li><a href="page2.php" title="Page two">Page 2</a></li>
        <li><a href="page3.php" title="Page three">Page 3</a></li>
        <li><a href="page4.php" title="Page four">Page 4</a></li>
        <li><a href="page5.php" title="Page five">Page 5</a></li>
    </ul>
</section>
</nav>
<script src="js/vendor/jquery.js"></script>
<script src="js/foundation/foundation.js"></script>
<script src="js/vendor/modernizr.js"></script>
<script>
    $(document).foundation();
</script>
