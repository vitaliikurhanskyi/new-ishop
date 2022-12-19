<h2> Main/index </h2>

<?php if($names): ?>
	<?php foreach ($names as $name): ?>

		<?php echo $name->name . '<br>'; ?>

	<?php endforeach; ?>
<?php endif; ?>