<?php include "header.php";?>
<div class="row">
	<h2 class="text-center">Search for a Record</h2>
	<h3>Enter the Reference Number</h3>
</div>
<form action="view-found-record.php" method="post">
	<div class="row"><!--Beginning of First Row-->
  	<div class="large-6 medium-6 small-12 columns">
      <label>Reference Number
        <input id="ref_num" type="text" name="ref_num" size="6" maxlength="6" placeholder="Reference Number" value="<?php if (isset($_POST['ref_num'])) {echo $_POST['ref_num'];
}
?>"/>
      </label>
    </div>
    <div class="large-12 small-12 columns">
  	<input type="submit" id="submit" name="submit" class="button [radius round]" value="Search">
  </div>
  </div><!--End of Row-->
</form>
