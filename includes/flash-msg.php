<?php
// message ephemere
if(isset($_SESSION['flash'])) {
    foreach($_SESSION['flash'] as $type => $message) {
    ?>
    <div class="alert alert-<?= $type; ?>">
        <?= $message; ?>
    </div>
    <?php
    }
    unset($_SESSION['flash']);
}