<?php
/**
 * @var \Georgi\Core\ViewInterface $this
 * @var \Georgi\Models\View\User\UserRegistrationViewModel $model
 */
?>
<form action="<?php echo $this->uri('users', 'registerPost') ?>" method="post">
    <fieldset>
        <legend>Registration</legend>

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
        
        <p class="field">
            <label for="role">Role</label>
            <span class="input">
                <select id="role" name="role">
                    <?php foreach ($model->getRoles() as $role) :?>
                        <option value="<?= $role->getId(); ?>"><?= $role->getName(); ?></option>
                    <?php endforeach; ?>
                </select>
            </span>
        </p>

        <input type="submit" value="Register">
    </fieldset>
</form>

