<?php
ob_start();
include 'html5req.html';?>
<body>
    <div id="header">
    <h1>This is the Header</h1>
    <nav>
        <ul class="side-nav">
            <li><a href="logout.php">Logout</a></li>
            <li><a href="admin-view-users.php">View Members</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="register-password.php">New Password</a></li>
        </ul>
    </nav>
</div>
</body>
<?php ob_end_flush();?>
