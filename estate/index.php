<?php include('html5req.php'); ?>
<?php include('nav.php'); ?>
<header>
	<h1>Devon Real Estate</h1>
	<h2>Try our award winning service</h2>
	<img src="" alt="">
</header>
<div class="row">
	<h3>Search for your dream house<br><span><strong>IMPORTANT: You must select an item in all
	<br> the fields otherwise the search will fail.</strong></span></br></h3>
</div>
<form action="found-houses.php" method="post">
	<select name="loctn">
		<option value="">--Select--</option>
		<option value="South_Devon">South Devon</option>
		<option value="Mid_Devon">Mid Devon</option>
		<option value="North_Devon">North Devon</option>
	</select>

	<select name="price">
		<option value="">--Select--</option>
		<option value="200,000">&pound;200,000</option>
		<option value="300,000">&pound;300,000</option>
		<option value="400,000">&pound;400,000</option>
	</select>

	<select name="type">
		<option value="">--Select--</option>
		<option value="Det-bung">Detached Bungalow</option>
		<option value="Semi-det-bung">Semi-detached Bungalow</option>
		<option value="Det-house">Detached House</option>
		<option value="Semi-det-house">Semi Detached House</option>
	</select>

	<select name="b_rooms">
		<option value="">--Select--</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
	</select>
	<input type="submit" id="submit" name="submit" class="button [radius round]" value="Register">
</form>
<div class="row">
	<h3>All houses are situated in the beautiful<br>green rolling countryside of Devon, England, UK<img src="" alt=""></h3>
</div>
