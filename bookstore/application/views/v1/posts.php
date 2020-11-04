<img src="<?php echo BASE_IMAGE ?>banner-non-2.jpg" style="max-height: 250px;width: 100%;object-fit: cover;object-position: 50% 65%;">



<div class='container'>
	<div class="row">
		<div class="col-sm-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
				<li class="breadcrumb-item active">Tin tức</li>
			</ol>
		</div>
	</div>
</div>

<div class='container'>
	<div class='contain-post'>
		<div class='row'>
			<?php 
				foreach ($data as $key => $value) {
					echo'<div class="col-sm-6 box-contain">
							<div class="box-news display-table mg-b-20">
								<a href="'.BASE_URL.'tin-tuc/'.$value['slug'].'.html">
									<img src="'.BASE_UPLOAD.'posts/'.$value['image'].'">
								</a>
								<div class="content">
									<a href="'.BASE_URL.'tin-tuc/'.$value['slug'].'.html" class="title">'.$value['title'].'
									</a>
									<span class="datetime">Đăng lúc: '.date('d/m/Y H:i a',strtotime($value['created_at'])).'</span>
									<div class="description">'.$this->myfunctions->charLimit($value['description'],150).'</div>
								</div>
							</div>
						</div>';
				}
			?>
		</div>
		<div class='row'>
			<div class='col-sm-12'>
				<div class='pull-right'>
					<ul class="pagination">
					<?php echo $this->pagination->create_links(); // tạo link phân trang  ?>						
					</ul>
				</div>
			</div>	
		</div>
	</div>
</div>