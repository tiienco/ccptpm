<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Đơn hàng
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Đơn hàng</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<button type="button" class="btn btn-primary btn-sm" disabled="">
			<i class="fa fa-plus-circle" aria-hidden="true" style=''></i> <b>Tạo mới</b>
		</button>

		<button id='delete' data-id='' class="btn btn-default btn-sm pull-right" onclick='deleteID(this,"cart/delete")'>Xóa Yêu cầu</button>
	</div>
	<div class='box-body'>
		<table class="table table-striped table-bordered datatables table-menu">
		    <thead>
		        <tr>
		            <th style='width: 25px;'><input type="checkbox" class='uniform ckball'></th>		     
		            <th>ID</th>
		            <th>Họ tên</th>
		            <th>Email</th> 
		            <th>Phone</th>
		            <th>Tổng giá trị</th>
		            <th style='width: 100px;'>Thanh toán</th>
		            <th style='width: 150px;'>Ngày tạo</th>
		            <th></th>
		            
		        </tr>
		    </thead>
		    <tbody>
		    <?php foreach($_data as $d): ?>
		    	<tr>
		           	<td><input type="checkbox" class='uniform ckb' value="<?php echo $d['id']?>"></td>	         
		            <td><?php echo $d['id']?></td>
		            <td><?php echo $d['fullname']?></td>
		            <td><?php echo $d['email']?></td>	
		            <td><?php echo $d['phone']?></td>
		            <td><?php echo number_format($d['total'], 0, '.', '.') ?></td>		          
		           	<td>
		            <?php 
			            if($d['status']==0) echo'<span class="label bg-gray">Chưa thanh toán</span>';
			            else echo'<span class="label bg-green">Đã thanh toán</span>';
		            ?> 	
		            </td>
		           	  <td><?php echo $d['created_at']?></td>
		            
		      
		            <td class='text-center'>
		            	<i class="fa fa-pencil-square-o edit-record" aria-hidden="true" onclick="window.location='<?php echo BASE_URL_ADMIN."cart/detail/".$d['id'] ?>'"></i>
		            	<i class="fa fa-trash-o delete-record" onclick='deleteOne(this,<?php echo $d['id']?>,"cart/delete")'></i>
		            </td>
		            
		        </tr>

		    <?php endforeach; ?>	            
           	</tbody>
	     </table>
	</div>
</div>
</section><!-- /.content -->