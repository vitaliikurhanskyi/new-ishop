<?php

use core\View;

/** @var $this View */

?>

  <?php $this->getPart('parts/header'); ?>
   
  <?php //debug($this); ?>

  <?= $this->content; ?>

  <?php $this->getPart('parts/footer'); ?>

