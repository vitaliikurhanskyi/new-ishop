<?php
use wfm\View;
/** $var $this View */
?>

<?= $this->getPart('parts/header'); ?>

<?php echo $this->content; ?>

<?php $this->getPart('parts/footer'); ?>




