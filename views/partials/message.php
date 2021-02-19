<div class="container">
        <?php foreach (\Georgi\Core\MVC\Message::returnMessages() AS $value) : ?>
            <?php if ($value->type == \Georgi\Core\MVC\Message::POSITIVE_MESSAGE) :?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php echo $value->text ?></strong>
                </div>
            <?php endif; ?>
        <?php endforeach;?>
        <?php foreach (\Georgi\Core\MVC\Message::returnMessages() AS $value) : ?>
            <?php if ($value->type == \Georgi\Core\MVC\Message::NEGATIVE_MESSAGE) :?>
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php echo $value->text ?></strong>
                </div>
            <?php endif; ?>
        <?php endforeach;?>
</div>


