<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Chi tiết đơn hàng
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Chi tiết đơn hàng</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<h3 class="box-title pull-right" style='line-height: 1.7'></h3>
		<button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN ?>cart'">
			<i class="fa fa-reply" aria-hidden="true"></i> <b>Quay lại</b>
		</button>

		<?php if($_info['status']==1){ ?>
			<button type="button" class="btn btn-success btn-sm pull-right">
			<b>Đã thanh toán</b>
			</button>
		<?php }else{ ?>
			<button type="button" class="btn btn-default btn-sm pull-right" onclick="checkout(<?php echo $_info['id']?>)">
				<b>Thanh toán</b>
			</button>
		<?php } ?>
		

	</div>
	<div class='box-body'>
		<form class="form-horizontal">
            <div class="form-group">
            	<span class='col-sm-2 text-right'>Khách hàng</span>
				<b class="col-sm-10 text-left"><?php echo @$_info['fullname']?></b>				
            </div>
            <div class="form-group">
           		<span class='col-sm-2 text-right'>Điện thoại</span>
				<b class="col-sm-10 text-left"><?php echo @$_info['phone']?></b>
						
            </div>
            <div class="form-group">
				<span class="col-sm-2 text-right">Email</span>
				<b class="col-sm-10 text-left"><?php echo @$_info['email']?></b>
				
            </div>
            <div class="form-group">
				<span class="col-sm-2 text-right">Ghi chú</span>
				<b class="col-sm-10 text-left"><?php echo @$_info['note']?></b>
            </div>
            <div class="form-group">
            	<div class='col-sm-12'>
            	<table class="table table-bordered table-striped " style='width: 800px;max-width: 100%;margin: 0 auto'>
            		<thead>
            			<tr>
            				<th>Hình ảnh</th>
            				<th>Tên sản phẩm</th>
            				<th class='text-center'>Đơn giá</th>
            				<th class='text-center'>Số lượng</th>
            				<th class='text-center'>Thành tiền</th>
            			</tr>
            		</thead>
            		<tbody>
        			<?php foreach($_detail as $_d):?>
    				<tr>
        				<td style='width: 70px;'>
        					<img src='<?php echo BASE_UPLOAD."product/".$_d['image']?>' style='width: 70px;'>	
        				</td>
        				<td><b><?php echo $_d['name']?></b></td>
        				<td class='text-center'>
        					<b><?php echo number_format($_d['price'],'0',',','.') ?> VNĐ</b>
    					</td>
        				<td class='text-center'>
        					<b style='color: #0e5841'><?php echo number_format($_d['qty'],'0',',','.') ?></b>
						</td>
        				<td class='text-center'>
        					<b style='color: #0e5841'><?php echo number_format($_d['subtotal'],'0',',','.') ?> VNĐ</b>
        				</td>
        			</tr>
        			<?php endforeach; ?>
        			<tr>
        				<td colspan="4" class='text-right'><b>TỔNG ĐƠN HÀNG</b></td>
        				<td colspan="4" class='text-center'>
        					<span style='color: #b80006;font-size: 18px;'>
        						<?php echo number_format($_info['total'],'0',',','.') ?>  VNĐ
    						</span>
    					</td>
        			</tr>
            		</tbody>
            	</table>
            	</div>
            </div>
           
          
         
        </form>
	</div>
</div>
</section>