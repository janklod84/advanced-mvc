<?php $this->start('body'); ?>
<h1 class="text-center red">Welcome to JanKlod MVC Framework</h1>
<?= inputBlock('text', 'Favorit Color:', 'favorite_color', 'red', [
   // 'srOnly' => false
   'class' => 'form-control'
], [
  // 'data-id' => 1
	'class' => 'form-group'
]); ?>

<?= submitBlock("Save", [
 'class' => 'btn btn-primary'
], [
  'class' => 'text-right'
]) ?>

<?= submitTag("Save", [
 'class' => 'btn btn-primary'
]) ?>
<?php $this->end(); ?>
