<?php switch($model->getRole()): 
    case 'client': ?>
        <table>
            <thead>
                <tr>
                    <th>Firm name</th>
                    <th>Add Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->getOtherUsers() as $userData): ?>
                    <?php
                        $userDataId = isset($userData['id']) ? $userData['id'] : 0;
                        $userDataName = isset($userData['username']) ? $userData['username'] : ''
                    ?>
                    <tr>
                        <td data-label="Firm name"><?= $userDataName ?></td>
                        <td data-label="Add Comment"><a href="<?php echo $this->uri('coments', 'coment', [$userDataId]) ?>">Add Comment</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Firm name</th>
                    <th>Your rating</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->getComments() as $comment): ?>
                    <?php
                        $busnes_username = isset($comment['busnes_username']) ? $comment['busnes_username'] : '';
                        $rating = isset($comment['rating']) ? $comment['rating'] : '';
                    ?>
                    <tr>
                        <td data-label="Firm name"><?= $busnes_username ?></td>
                        <td data-label="Your rating"><?= $rating ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php break; ?>
    <?php case 'business': ?>
        <table>
            <thead>
                <tr>
                    <th>Client name</th>
                    <th>Add Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->getOtherUsers() as $userData): ?>
                    <?php
                        $userDataId = isset($userData['id']) ? $userData['id'] : 0;
                        $userDataName = isset($userData['username']) ? $userData['username'] : ''
                    ?>
                    <tr>
                        <td data-label="Client name"><?= $userDataName ?></td>
                        <td data-label="Generate code"><a href="<?php echo $this->uri('token', 'generateToken', [$userDataId]) ?>">Generate Code</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Client name</th>
                    <th>Client rating</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->getComments() as $comment): ?>
                    <?php
                        $client_ussername = isset($comment['client_ussername']) ? $comment['client_ussername'] : '';
                        $rating = isset($comment['rating']) ? $comment['rating'] : '';
                    ?>
                    <tr>
                        <td data-label="Client name"><?= $client_ussername ?></td>
                        <td data-label="Client rating"><?= $rating ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php break; ?>
<?php endswitch; ?>

