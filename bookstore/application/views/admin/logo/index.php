
<section class="content-header">
	<h1>
		Logo
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Logo</li>
	</ol>
</section>


<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN ?>logo/add'">
			<i class="fa fa-plus-circle" aria-hidden="true" style=''></i> <b>Tạo mới</b>
		</button>
		<button id='delete' data-id='' class="btn btn-default btn-sm pull-right" onclick='deleteID(this,"logo/delete")'>Xóa Yêu cầu</button>
	</div>
	<div class='box-body'>
		<table class="table table-striped table-bordered datatables table-logo">
		    <thead>
		        <tr>
		            <th style='width: 25px;'><input type="checkbox" class='uniform ckball'></th>
		            <th style='width: 50px;'>Logo</th>
		            <th style='width: 130px;'>Khách hàng</th>
		            <th>Link</th>            
		            <th style='width: 50px;'>Ưu Tiên</th>
		            <th style='width: 70px;'>Trạng thái</th>
		            <th style='width: 100px;'>Ngày tạo</th>		            		           
		          	<th style='width: 30px;'></th>	
		        </tr>
		    </thead>
		    <tbody>
		    <?php foreach($_data as $key =>  $d): ?>
		    	<tr>
		           	<td><input type="checkbox" class='uniform ckb' value="<?php echo $d['id']?>"></td>
		           	<td><img src="<?php echo BASE_UPLOAD.'logo/'.$d['image'] ?>" style="width: 50px;"></td>
		            <td><a href='<?php echo BASE_URL_ADMIN."logo/add/".$d['id'] ?>'><?php echo $d['title']?></a></td>			            
		           	<td style="word-break: break-all;"><?php echo $d['link']?></td>
		           	<td><?php echo $d['sort']?></td>
		            <td>
		            <?php 
			            if($d['status']==0) echo'<span class="label bg-red" style="display:block">Ẩn</span>';
			            else echo'<span class="label bg-light-blue-active btn-block"style="display:block">Hiển thị</span>';
		            ?> 	
		            </td>
		            <td><?php echo @date('d/m/Y H:i',@strtotime($d['created_at']))?></td>		            	            
		            <td class='text-center'>
		            	<i class="fa fa-trash-o delete-record" onclick='deleteOne(this,<?php echo $d['id']?>,"logo/delete")'></i>
		            </td>
		            
		        </tr>

		    <?php endforeach; ?>	            
           	</tbody>
	     </table>
	</div>
</div>
</section>
<script type="text/javascript">
$('.table-logo').dataTable({    
	"dom": "<'row'<'col-sm-6 col-search'f><'col-sm-6 btn-add'>>" +
			"<'row'<'col-sm-12'<'box-datatable'tr>>>" +
			"<'row'<'col-sm-5'li><'col-sm-7 text-right'p>>",	
	"order": [[ 4, "desc" ]],		
	"aoColumns":[		
		{"bSortable": false},	
		{"bSortable": false},	
		{"bSortable": true},	
		{"bSortable": true},	
		{"bSortable": true},			
		{"bSortable": true},	
		{"bSortable": true},	
		{"bSortable": false}	
	],			
	// "searching": false,
	"autoWidth": false,
	"lengthChange": true,
	"lengthMenu": [ 10, 25, 50, 75, 100 ],
	"info" : true,
	"bPaginate" : true,
	"bSort" : true,
	"pageLength": 10,
	"language":{
	    "paginate": {
	        "first":      "Đầu",
	        "last":       "Cuối",
	        "next":       "Sau",
	        "previous":   "Trước",
	    },
	    "sSearch" : '',
	    "searchPlaceholder": "Tìm kiếm..",
	    "lengthMenu":     "_MENU_",
	    "info":           "Hiện thị _START_ đến _END_ của _TOTAL_ dòng",
	    "infoEmpty":      "",
	    "emptyTable":     "Không có dữ liệu",
	    "infoPostFix":    "",
	},

	"drawCallback": function(settings){			
		$('.uniform').uniform();
		// $('[data-toggle="tooltip"]').tooltip(); 
		// $('.load-datatable').addClass('hide');
    },
    "initComplete": function (a) {
    	$('.dataTables_filter').css('text-align','left').find('input').css('margin','0');
    	$('.dataTables_length').css('display','inline-block');
    	$('.dataTables_info').css('display','inline-block').css('margin-left','10px');
    },
    "rowCallback": function( row, data, index ) {
    	// console.log(data);
  	},
});	
</script>