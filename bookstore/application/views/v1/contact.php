<img src="<?php echo BASE_IMAGE ?>banner-non-2.jpg" style="max-height: 250px;width: 100%;object-fit: cover;object-position: 50% 65%;">

<?php 
	$content = json_decode(@$_data['content'],true);
	if (!is_array($content) && !($content instanceof Traversable)) $content = array();
?>
<div class='container'>
	<div class='row info-first'>		
		<div class='col-sm-12'>
			<?php echo $content['description']?>
		</div>
	</div>
</div>
<br>
<br>
<div class='container'>
	<div class='row'>
		<div class='map-google'>
			<?php echo $content['google_map']; ?>
		</div>
	</div>
</div>


<br>
<br>