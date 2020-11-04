<!--Content Header (Page header) -->
<section class="content-header">
	<h1>
		Banner
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Banner</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN ?>banner/add'">
			<i class="fa fa-plus-circle" aria-hidden="true" style=''></i> <b>Tạo mới</b>
		</button>

		<button id='delete' data-id='' class="btn btn-default btn-sm pull-right" onclick='deleteID(this,"banner/delete")'>Xóa Yêu cầu</button>
	</div>
	<div class='box-body'>
		<table class="table table-striped table-bordered datatables table-banner">
		    <thead>
		        <tr>
		            <th style='width: 25px;'><input type="checkbox" class='uniform ckball'></th>
		            <th style='width: 180px'></th>
		            <th style='width: 20%'>Tiêu đề</th>		            	           
		            <th style=''>Mô tả ngắn</th>		            	           
		            <th style='width: 100px'>Ngày tạo</th>	
		            <th style='width: 90px;'>Trạng Thái</th>		           
		            <th style='width: 50px;'></th>
		            
		        </tr>
		    </thead>
		    <tbody>
		    <?php foreach($_data as $d): ?>
		    	<tr>
		           	<td><input type="checkbox" class='uniform ckb' value="<?php echo $d['id']?>"></td>
		           	<td style='padding-right: 2px'><img src='<?php echo BASE_UPLOAD."banner/".$d['image']?>' style='width: 180px;'/></td>
		            <td style='vertical-align: middle;'><a href="<?php echo BASE_URL_ADMIN."banner/add/".$d['id'] ?>"><?php echo $d['title']?></a></td>
		            <td style='vertical-align: middle;'><?php echo $d['description']?></td>
		           
		            <td style='vertical-align: middle;'><?php echo $d['created_at']?></td>
		            
		            <td style='vertical-align: middle;'>
		            <?php 
			            if($d['status']==0) echo'<span class="label bg-red" style="display:block">Ẩn</span>';
			            else echo'<span class="label bg-light-blue-active btn-block"style="display:block">Hiện</span>';
		            ?> 	
		            </td>
		            <td class='text-center' style='    vertical-align: middle;'>
		            	<i class="fa fa-trash-o delete-record" onclick='deleteOne(this,<?php echo $d['id']?>,"banner/delete")' style='margin : 0;display: block'></i>
		            </td>
		            
		        </tr>

		    <?php endforeach; ?>	            
           	</tbody>
	     </table>
	</div>
</div>
</section><!-- /.content -->