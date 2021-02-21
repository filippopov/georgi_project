<form action="<?php echo $this->uri('coments', 'comentPost') ?>" method="post">
    <fieldset>
        <legend>Rating</legend>
        <p class="field">
            <label for="rating">Rating</label>
            <span class="input">
                <select id="rating" name="rating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </span>
        </p>
        
        <p class="field">
            <label for="token">Token</label>
            <span class="input">
                <input type="text" value="" id="token" name="token">
                <span class="actions"></span>
                <i class="fas fa-code"></i>
            </span>
        </p>
        
        <input type="hidden" name="buisnesId" value="<?= $model->getBuisnesId() ?>">
        <input type="submit" value="Rating">
    </fieldset>
</form>

