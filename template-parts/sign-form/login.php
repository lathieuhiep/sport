<form id="login" class="ajax-auth" action="<?php echo esc_url( get_permalink() ); ?>" method="post">
    <h3>
        New to site?
        <a id="pop_signup" href="#">
            Create an Account
        </a>
    </h3>

    <h1>Login</h1>

    <p class="status"></p>

    <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>

    <label for="username">Username</label>
    <input id="username" type="text" class="required" name="username">

    <label for="password">Password</label>
    <input id="password" type="password" class="required" name="password">

    <a class="text-link" href="<?php echo wp_lostpassword_url(); ?>">
        Lost password?
    </a>

    <input class="submit_button" type="submit" value="LOGIN">

    <a class="close" href="#">
        (close)
    </a>
</form>