<?php /* @var $this Controller */ ?>
<?php
	if (!Yii::app()->user->isGuest) {
		$this->beginContent('//layouts/main');
	} else
		$this->beginContent('//layouts/guestmain');
 ?>
<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<?php
if (!Yii::app()->user->isGuest) {
	$this->endContent();
} else
	$this->endContent();
?>
