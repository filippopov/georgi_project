<form action="<?php echo $this->uri('token', 'generateTokenPost') ?>" method="post">
    <fieldset>
        <legend>Generate Token</legend>
        <p class="field">
            <label for="token">Token</label>
            <span class="input">
                <input type="text" value="<?= $model->getToken()?>" id="token" name="token" disabled>
                <span class="actions"></span>
                <i class="fas fa-code"></i>
            </span>
        </p>
        <input type="hidden" name="clientId" value="<?= $model->getClientId() ?>">
        <input type="submit" value="Generete Token">
    </fieldset>
</form>