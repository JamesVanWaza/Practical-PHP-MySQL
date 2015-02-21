<?php include 'header.php';?>
<header>
<h1>Devon Real Estate</h1>
<h2 class="text-center">Try our award-winning service</h2>
<img id="rosette" alt="Rosette" title="Rosette" height="127"
src="images/rosette-128.png" width="128">
</header>
<div class='row'>
  <div class="large-12 columns">
    <h3>Arrange a Viewing</h3>
    <strong>Address:</strong> 1 The Street, Townsville, AA6 8PF, <br />
    <b>Tel:</b> 01111 800777<br>&nbsp;
    <strong>To arrange a viewing:</strong> please use this form and click the
Send button at the bottom.
  </div>
</div>
<form action="contact-handler.php" method="post" >
<!--Start of text fields-->
  <div class="row"><!--Beginning of First Row-->
  	<div class="large-6 columns">
      <h3>Essential items are marked with an asterisk</h3>
      <label>Name
        <input id="username" type="text" name="username" size="30" maxlength="30" placeholder="Name"
      </label>
    </div>
     <div class="large-6 columns">
      <label>Email
        <input id="useremail" type="email" name="useremail" size="30" maxlength="30" placeholder="Email"
      </label>
    </div>
  </div><!--End of First Row-->
   <div class="row"><!--Beginning of Second Row-->
    <div class="large-12 columns">
      <label>Telephone
         <input id="useremail" type="tel" name="useremail" size="30" maxlength="30" placeholder="Telephone"
      </label>
    </div>
  </div><!--End of Second Row-->
   <div class="row"><!--Beginning of Third Row-->
    <div class="large-12 columns">
      <h3>Please enter the reference number of the house</h3>
      <label>House Reference Number:
         <input id="ref_num" type="text" name="ref_num" size="50" maxlength="50"placeholder="House Reference Number"
      </label>
    </div>
  </div><!--End of Third Row-->
  <div class="large-6 columns">
      <h3>Please enter your message below (optional)</h3>
      <textarea id="comment" name="comment" rows="8" cols="40"></textarea>
   </div>
      <div class="large-12 columns">
  	<input type="submit" id="sb" name="submit" class="button [radius round]" value="Submit">
  </div>
</form>
