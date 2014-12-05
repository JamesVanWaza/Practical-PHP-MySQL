<?php include( 'header.php'); ?>
    <nav class="top-bar" data-topbar role="navigation" data-options="is_hover: false">
        <ul class="title-area">
            <li class="name">
                <h1><a href="index.php">Simple IDB</a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>MENU</span></a>
        </li>
    </ul>
    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
        <li><a href="logout.php">Logout</a>
        </li>
        <li><a href="register-view-users-page.php">View Members</a>
        </li>
        <li><a href="search.php">Search</a>
        </li>
        <li><a href="search-addresses.php">Addresses</a>
        </li>
        <li><a href="register-password.php">New Password</a>
        </li>
      </ul>
</section>
</nav>
<script>
document.write('<script src=js/vendor/' +
('__proto__' in {} ? 'zepto' : 'jquery') +
'.js><\/script>')
</script>
<script src="js/vendor/jquery.js"></script>
<script src="js/foundation/foundation.js"></script>
<!-- <script src="js/foundation/foundation.orbit.js"></script> -->
<!-- Updating slider settings in here -->
<script src="js/foundation.min.js"></script>
<script>
$(document).foundation();

</script>
