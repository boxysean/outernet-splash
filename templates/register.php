<?php include_once "header.php"; ?>

        <div class="container">
            <div class="row">
                <div class="span4">
                    <div class="blurb shadow-small">
                        <h2>FAQ</h2>
                        <p>Q: Do I need to register for Outernet?</p>
                        <p>A: No. Registering will allow you to post items on Outernet classifieds and give you your own Outernet mailbox.</p>
                        <p>Q: What does Outernet do with my optiona lcontact information?</p>
                        <p>A: It fills in your information into forms that require those information.</p>
                    </div>
                </div>
                <div class="span8">
                    <div class="blurb shadow-small">
<form class="form-horizontal" id="registration-form" name="registration-form" action="actions/register.php" method="post">
<fieldset>

<!-- Form Name -->
<legend>Registration</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Username</label>
  <div class="controls">
    <input id="username" name="username" placeholder="Jay-Z600" class="input-xlarge" required="" type="text" min-length="4">
    <p class="help-block"><i>Required.</i> Your name across all of Outernet</p>
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label">Password</label>
  <div class="controls">
    <input id="password" name="password" placeholder="" class="input-xlarge" required="" type="password">
    <p class="help-block"><i>Required.</i> Your password for all of Outernet</p>
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label">Re-type Password</label>
  <div class="controls">
    <input id="password2" name="password2" placeholder="" class="input-xlarge" required="" type="password">
    <p class="help-block"><i>Required.</i> Type your password again</p>
  </div>
</div>

<legend>Optional information</legend>
<!-- Text input-->
<div class="control-group">
  <label class="control-label">Email Address</label>
  <div class="controls">
    <input id="email" name="email" placeholder="jayz@rapgame.com" class="input-xlarge email" type="text">
    <p class="help-block">In case we need to get in touch with you on the Internet</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Phone Number</label>
  <div class="controls">
    <input id="phone" name="phone" placeholder="212-555-5555" class="input-xlarge phone" type="text">
    <p class="help-block">For your personal profile</p>
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label"></label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-default">Register</button>
  </div>
</div>

<div id="error-message">
</div>

</fieldset>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- build:js scripts/register.js -->
    <script data-main="scripts/register" src="components/requirejs/require.js"></script>
    <!-- endbuild -->

<?php include_once "footer.php"; ?>
