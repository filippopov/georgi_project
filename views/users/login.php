<form action="<?php echo $this->uri('users', 'loginPost') ?>" method="post">
    <fieldset>
        <legend>Login</legend>

        <p class="field">
            <label for="username">Username</label>
            <span class="input">
                <input type="text" name="username" id="username">
                <span class="actions"></span>
                <i class="fas fa-user"></i>
            </span>
        </p>

        <p class="field">
            <label for="password">Password</label>
            <span class="input">
                <input type="password" name="password" id="password">
                <span class="actions"></span>
                <i class="fas fa-key"></i>
            </span>
        </p>

        <input type="submit" value="Login">
    </fieldset>
</form>