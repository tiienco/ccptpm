<img src="<?php echo BASE_IMAGE ?>banner.jpg ?>" style="max-height: 250px;width: 100%;object-fit: cover;object-position: 50% 65%;">


<div class='container'>
	<div class="row">
		<div class="col-sm-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
				<li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>tin-tuc">Tin tức</a></li>
				<li class="breadcrumb-item active"><?php echo $_detail['title']?></li>
			</ol>
		</div>
	</div>
</div>

<div class='container'>
	<div class='row'>
		<div class='col-sm-12'>
			<div class='tour-left'>		
				<h1 class='title-news margin_bottom_10'><?php echo $_detail['title']?></h1>
				<div class="datetime-news pull-right">					
					<i>Ngày đăng: <?php echo date('d/m/Y H:i a',strtotime($_detail['created_at']))?></i>
				</div>	
				<div class='share pull-left'>
					<div class="fb-like" data-href="<?php echo BASE_URL."tin-tuc/".$_detail['slug']?>.html" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
				</div>

				<div class='clearfix'></div>
				<div class='content-description margin_bottom_20'>
					<b><?php echo $_detail['description']?></b>
				</div>

				<div class='content-news margin_bottom_40'>
					<?php echo $_detail['content']?>
				</div>

			</div>

			<div class='tour-right hidden-xs hidden-sm'>
				<div class='box-tour-related'>
					<header><h2>TIN LIÊN QUAN</h2></header>
					<ul class='ul-list-tour ul-list-new'>
						<?php 
						foreach ($posts_others as $key => $value) {
							echo '<li>
									<a href="'.BASE_URL.'tin-tuc/'.$value['slug'].'.html">
										<img class="cover" ogi-src="'.BASE_UPLOAD.'posts/'.$value['image'].'" alt="'.$value['title'].'" title="'.$value['title'].'">
									</a>
									<div class="title">
										<a href="'.BASE_URL.'tin-tuc/'.$value['slug'].'.html">
											'.$value['title'].'
										</a>
										<span class="clock">'.date('M d, Y',strtotime($value['created_at'])).'</span>
									</div>
								</li>';
						}
						?>
					</ul>
				</div>

				
			</div>
		</div>
	</div>


</div>