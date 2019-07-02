<form id="register" class="ajax-auth"  action="register" method="post">
    <h3>Already have an account? <a id="pop_login"  href="">Login</a></h3>
    <hr />
    <h1>Signup</h1>
    <p class="status"></p>
    <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>
    <label for="signonname">Username</label>
    <input id="signonname" type="text" name="signonname" class="required">
    <label for="email">Email</label>
    <input id="email" type="text" class="required email" name="email">
    <label for="signonpassword">Password</label>
    <input id="signonpassword" type="password" class="required" name="signonpassword" >
    <label for="password2">Confirm Password</label>
    <input type="password" id="password2" class="required" name="password2">
    <input class="submit_button" type="submit" value="SIGNUP">
    <a class="close" href="">(close)</a>
</form>