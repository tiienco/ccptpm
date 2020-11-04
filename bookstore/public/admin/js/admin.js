

function column(n,abc){
	var a ="[";
	for(var i=0;i<n;i++){
		if($.inArray( i, abc )== -1) a += 'null,';
		else a+= '{ "bSortable": false },';
	}
	a = a.substring(0,a.length-1);	
	a+="]";
	return a;	
}

function check_exists_comic(itme){
	var _this = $(itme);
	var name = $('input[name=title]').val();
	var slug = $('input[name=slug]').val();
	if(name.trim() == ''){
		alert('Mày đùa tao à! grr.');return false;
	}
	if(slug.trim() == ''){
		alert('Mày đùa tao à! grr.');return false;
	}
	$.ajax({    
        url:BASE_URL_ADMIN + "comic/check_exists_comic",
        type: "POST",
        data :{
        	'name' : name.trim(),
        	'slug' : slug.trim()
        },
        success: function(data){   
        	data = JSON.parse(data);
        	if(data.status == 'true'){
        		alert("Truyện trùng tên : " + data.comic.title);
        	}else{
        		alert('Thoải mái đi man. :D');
        	}                                                                                        
        },
        beforeSend:function(data) {    
            _this.append('<i class="fa fa-spinner fa-pulse" style="margin-left: 5px !important;font-size: 12px;"></i>').attr('disabled','disabled');
        },
        complete: function(data){
            _this.removeAttr('disabled').find('i.fa-spinner').remove();
        }                                                                                                       
    });
}


$(document).ready(function() {
	$('.uniform').uniform();
	$('input.title_alias').keyup(function(){
		$('input[name=slug]').val(alias($(this).val()));
	});	
	$('input.price').mask('#.##0',{reverse:true});
	
	if($('.datatables').length==1){
		var count_th = $(".datatables thead tr th" ).length;
	}else 	var count_th = 3;
    $('.table-default').dataTable({
        "sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-4'l><'col-xs-4'i><'col-xs-4'p>>",        
        // aaSorting: [[1, 'desc']],
		"aoColumns":$.parseJSON(column(count_th,[0,count_th-1])),
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_",
            "sSearch": ""
        },
        "drawCallback": function(settings){
            $.uniform.update('input[type=checkbox]');
            $('.uniform').uniform();
            
        },
    });
    $('.table-img').dataTable({
        "sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-4'l><'col-xs-4'i><'col-xs-4'p>>",        
        aaSorting: [[2, 'desc']],
		"aoColumns":$.parseJSON(column(count_th,[0,1,count_th-1])),
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_",
            "sSearch": ""
        },
        "drawCallback": function(settings){
            $.uniform.update('input[type=checkbox]');
            $('.uniform').uniform();
            
        },
    });
    $('.table-new').dataTable({
        "sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-4'l><'col-xs-4'i><'col-xs-4'p>>",        
        // aaSorting: [[4, 'desc']],
		"aoColumns":$.parseJSON(column(count_th,[0,1,count_th-1])),
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_",
            "sSearch": ""
        },
        "drawCallback": function(settings){
            $.uniform.update('input[type=checkbox]');
            $('.uniform').uniform();
            
        },
    });

    $('.table-comic').dataTable({
        "sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-4'l><'col-xs-4'i><'col-xs-4'p>>",        
        // aaSorting: [[4, 'desc']],
		"aoColumns":$.parseJSON(column(count_th,[0,1,count_th-1,count_th-2])),
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_",
            "sSearch": ""
        },
        "drawCallback": function(settings){
            $.uniform.update('input[type=checkbox]');
            $('.uniform').uniform();
            
        },
    });
    $('.table-feedback').dataTable({
        "sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-4'l><'col-xs-4'i><'col-xs-4'p>>",        
        // aaSorting: [[4, 'desc']],
		"aoColumns":$.parseJSON(column(count_th,[0,1,count_th-1])),
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_",
            "sSearch": ""
        },
        "drawCallback": function(settings){
            $.uniform.update('input[type=checkbox]');
            $('.uniform').uniform();
            
        },
    });
    // $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search...');
    $('.dataTables_length select').addClass('form-control');    

	$('.datatables thead input.uniform').on('click', function(){
		if($(this).is(':checked'))
			$(this).closest('thead').next().find('input[type=checkbox]').prop('checked',true);
		else $(this).closest('thead').next().find('input[type=checkbox]').prop('checked',false);

		$.uniform.update('input[type=checkbox]');
		fadeButton();
	});
	$('.datatables').on('click', 'tbody input.uniform', function() {
		$(this).closest('tbody').prev().find('input[type=checkbox]').prop('checked',false);
		$.uniform.update('input[type=checkbox]');
		fadeButton();
	});


	$(document).on('click','.box-img',function(){
		$('input[name=image]').click();
	})
	
});
function deleteImg(a,url,id,name){
	var con = confirm('Bạn có muốn xóa ảnh này không ?');
	if(con == true){			
		$.ajax({
			type:"POST",
			data:{
				"name":name,
				'id':id
			},

			url:BASE_URL_ADMIN + url + "/deleteImg",			
			success:function(data){
				$(a).parent().fadeOut();
			}
		});		
	}		
}
function deleteID(a,url){
	var id = $(a).attr('data-id');
	var url = url;
	var count = $('input.ckb:checked').length;
	if(confirm('Bạn có muốn xóa ('+count+') dòng này không ?')==true){
		$.ajax({
			url : BASE_URL_ADMIN+url,
			type: "POST",
			data:{'id':id},
			success: function(data){
				if(data==1){
					$('input.ckb:checked').closest('tr').fadeOut();
					setTimeout(function(){ $('input.ckb:checked').closest('tr').remove() }, 1000);
					$(a).hide();
				}else alert('Vui lòng reload lại website');				
			}
		});
	}
}
function deleteOne(a,id,url){
	var count = $('input.ckb:checked').length;
	if(confirm('Bạn có muốn xóa dòng này không ?')==true){
		$.ajax({
			url : BASE_URL_ADMIN+url,
			type: "POST",
			data:{'id':id},
			success: function(data){
				if(data==1){
					$(a).closest('tr').fadeOut();
					setTimeout(function(){ $(a).closest('tr').remove() }, 1000);
				}else alert('Vui lòng reload lại website');				
			}
		});
	}
}
function delGallery(a,id,url){
	var count = $('input.ckb:checked').length;
	if(confirm('Bạn có muốn xóa dòng này không ?')==true){
		$.ajax({
			url : BASE_URL_ADMIN+url,
			type: "POST",
			data:{'id':id},
			success: function(data){
				if(data==1){
					$(a).closest('.box-main').fadeOut();
					setTimeout(function(){ $(a).closest('.box-main').remove() }, 1000);
				}else alert('Vui lòng reload lại website');				
			}
		});
	}
}
function fadeButton(){
	var a = $('input.ckb:checked').map(function(){return $(this).val();}).get();
	var count = $('input.ckb:checked').length;
	if($('input[type=checkbox]').is(':checked'))				
		$('#delete').attr('data-id',a).html('Xóa yêu cầu ('+count+')').fadeIn();
	else $('#delete').hide();
}

function review_image(f){
	var reader = new FileReader();
	reader.onload = function (e) {
		var img = document.getElementById("image-review");
		img.src = e.target.result;
		img.style.display = "inline";
	};
	reader.readAsDataURL(f.files[0]);
}

function review_album(f){
	if (typeof (FileReader) != "undefined") {
		var dvPreview = $("#dvPreview");
		dvPreview.html("");
		var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
		$($(f)[0].files).each(function () {
			var file = $(this);
			if (regex.test(file[0].name.toLowerCase())) {
				var reader = new FileReader();
				reader.onload = function (e) {
					var img = $("<img />");
					img.attr("style", "height:100px;margin:10px;");
					img.attr("src", e.target.result);
					dvPreview.append(img);
				}
				reader.readAsDataURL(file[0]);
			} else {
				alert(file[0].name + " is not a valid image file.");
				dvPreview.html("");
				return false;
			}
		});
	} else {
		alert("This browser does not support HTML5 FileReader.");
	}
};

function checkout(id){
	if(confirm('Bạn có chắc chắn không ??')==true){
		window.location=BASE_URL_ADMIN +'cart/details/'+id;
	}else return false;
}

var i_price = 100;
function addPrice(){
	//đếm số lượnq tự thêm vào
	var div = '<div class="row form-group" id="delPri"><div class="col-sm-4"><input name="price['+i_price+'][qty]" class="form-control" required="required" placeholder="Số lượng"></div><div class="col-sm-4"><input name="price['+i_price+'][price]" class="form-control price" required="required" placeholder="Đơn giá" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true,\'rightAlign\':false"></div><div class="col-sm-4"><button type="button" class="btn btn-danger btn-sm" onclick="delPrice(this)">Xóa</button></div></div>';
	$('#box-price').append(div);	
	$('input.price').mask('#.##0',{reverse:true});
	i_price++ ;
}
function delPrice(a){
	$(a).closest('#delPri').remove();
}


$('#video-youtube').keyup(function(){
	var a = $(this).val();
	a = a.split('?');
	if(a.length == 1){
		a = a[0].split('/');
	}else{
		a = a[1].split('=');
	}
	$('#img-1 img').attr('src','http://i3.ytimg.com/vi/'+a[a.length-1]+'/hqdefault.jpg');
	console.log(a[a.length-1]);
	// console.log(a);
})
// $(document).on('#video-youtube','keypress',function(){
// 	console.log('fdg');
// })





$(document).on('keyup','.list-link-img .input-group:last-child input',function(){
	let _this = $(this);
	let value = _this.val();
	let pos   = parseInt(_this.closest('.input-group').find('span').text());
	let input = '<div class="input-group">\
					<span class="input-group-addon">'+(pos + 1)+'</span>\
					<input type="text" class="form-control" name="link[]" placeholder="link">\
					<img src="">\
				</div>';
	if(value.length > 5)
	_this.closest('.list-link-img').append(input);
})

$(document).on('keyup','.list-link-img .input-group input',function(){
	let _this = $(this);
	let value = _this.val();
	_this.parent().find('img').attr('src',value);
})

//===================================//
//========== DATATABLE  ============//
var listDT = {
	'table_comic' : [],
	'table_chapter' : [],
	'report_error' : [],
}

function changeSort(table,type='default'){
	let param = {
		'searched' : $('input[name=searched]').val(),
		'namesort' : $('select[name=namesort]').val(),
		'typesort' : $('select[name=typesort]').val(),
	}	
	if(type=='detail'){
		listDT[table]['data'].ajax.url(listDT[table]['url']+"&"+jQuery.param(param)).load(function(){},false);
	}else{
		listDT[table]['data'].ajax.url(listDT[table]['url']+"?"+jQuery.param(param)).load(function(){},false);
	}
	
}
//==== table_comic
listDT['table_comic']['url'] = BASE_URL_ADMIN + "comic/getDataComic/";
listDT['table_comic']['data'] = $('#table_comic').DataTable({ 
	"retrieve": true,
	"ajax": {
		'url' : listDT['table_comic']['url'],
		// 'type' : 'POST',
		'data' : {
			// 'searched' : $('input[name=searched]').val(),
			// 'namesort' : $('select[name=namesort]').val(),
			// 'typesort' : $('select[name=typesort]').val(),
		}
	} ,
	"serverSide": true,
	"order": [[ 0, "desc" ]],
	"aoColumns":[		
		// {"data":"checkbox","name":"", "bSortable": false,"width": "20px"},
		{"title": "","data":"image","name":"image", "bSortable": true,"width": "90px"},
		{"title": "Thông tin truyện","data":"info","name":"info", "bSortable": true,},	

		{"title": "T.Thái","data":"status","name":"status", "bSortable": true,"width": "55px"},	
		{"title": "Ngày tạo","data":"created","name":"created_at", "bSortable": true,"width": "150px"},				
		{"title": "","data":"config","name":"config", "bSortable": false,"width": "120px"},		
	],
	"dom": "<'row'<'col-sm-6 col-search'><'col-sm-6 btn-add'>>" +
			"<'row'<'col-sm-12'<'box-datatable'tr>>>" +
			"<'row'<'col-sm-5'li><'col-sm-7 text-right'p>>",		
	// "searching": false,
	"autoWidth": false,
	"lengthChange": true,
	"lengthMenu": [ 10, 25, 50, 75, 100 ],
	"info" : true,
	"bPaginate" : true,
	"bSort" : false,
	"pageLength": 10,
	"language":{
	    "paginate": {
	        "first":      "Đầu",
	        "last":       "Cuối",
	        "next":       "Sau",
	        "previous":   "Trước",
	    },
	    "sSearch" : '',
	    "searchPlaceholder": "Tìm theo từ khóa",
	    "lengthMenu":     "_MENU_",
	    "info":           "Hiện thị _START_ đến _END_ của _TOTAL_ chương",
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
    	// $('.box-datatable table').css({'width': 'max-content' , 'min-width' : 'calc(100% - 2px)'});
   		// $('.box-datatable').css({'overflow-x': 'scroll'});
    },
    "rowCallback": function( row, data, index ) {
    	// console.log(data);
  	},
});

//==== table_chapter
listDT['table_chapter']['url'] = BASE_URL_ADMIN + "comic/getDataChapter"+$(location).attr('search');
listDT['table_chapter']['data']= $('#table_chapter').DataTable({ 
	"retrieve": true,
	"ajax": {
		'url' : listDT['table_chapter']['url'],
		// 'type' : 'POST',
	} ,
	"serverSide": true,
	"order": [[ 0, "desc" ]],
	"aoColumns":[		
		// {"data":"checkbox","name":"", "bSortable": false,"width": "20px"},
		{"data":"sort","name":"sort", "bSortable": false,"width": "30px"},
		{"data":"chapter","name":"chapter", "bSortable": false,},
		{"data":"view","name":"view", "bSortable": false,"width": "100px"},
		{"data":"status","name":"status", "bSortable": false,"width": "55px"},
		{"data":"created_at","name":"created_at", "bSortable": false,"width": "150px"},			
		{"data":"config","name":"config", "bSortable": false,"width": "55px"},		
	],
	"dom": "<'row'<'col-sm-6 col-search'><'col-sm-6 btn-add'>>" +
			"<'row'<'col-sm-12'<'box-datatable'tr>>>" +
			"<'row'<'col-sm-5'li><'col-sm-7 text-right'p>>",		
	// "searching": false,
	"autoWidth": false,
	"lengthChange": true,
	"lengthMenu": [ 10, 25, 50, 75, 100 ],
	"info" : true,
	"bPaginate" : true,
	"bSort" : false,
	"pageLength": 10,
	"language":{
	    "paginate": {
	        "first":      "Đầu",
	        "last":       "Cuối",
	        "next":       "Sau",
	        "previous":   "Trước",
	    },
	    "sSearch" : '',
	    "searchPlaceholder": "Tìm theo từ khóa",
	    "lengthMenu":     "_MENU_",
	    "info":           "Hiện thị _START_ đến _END_ của _TOTAL_ chương",
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
    	// $('.box-datatable table').css({'width': 'max-content' , 'min-width' : 'calc(100% - 2px)'});
   		// $('.box-datatable').css({'overflow-x': 'scroll'});
    },
    "rowCallback": function( row, data, index ) {
    	// console.log(data);
  	},
}); 

//==== report_error
listDT['report_error']['url'] = BASE_URL_ADMIN + "report_error/getDataReportError"+$(location).attr('search');
listDT['report_error']['data']= $('#report_error').DataTable({ 
	"retrieve": true,
	"ajax": {
		'url' : listDT['report_error']['url'],
		// 'type' : 'POST',
	} ,
	"serverSide": true,
	"order": [[ 1, "desc" ]],
	"aoColumns":[		
		{"data":"checkbox","name":"", "bSortable": false,"width": "20px"},
		{"data":"id","name":"id", "bSortable": true,"width": "30px"},
		{"data":"link","name":"link", "bSortable": true,},
		{"data":"content","name":"content", "bSortable": true,"width": "100px"},
		{"data":"status","name":"status", "bSortable": true,"width": "55px"},
		{"data":"created_at","name":"created_at", "bSortable": true,"width": "150px"},			
		{"data":"config","name":"config", "bSortable": false,"width": "55px"},		
	],
	"dom": "<'row'<'col-sm-6 col-search'><'col-sm-6 btn-add'>>" +
			"<'row'<'col-sm-12'<'box-datatable'tr>>>" +
			"<'row'<'col-sm-5'li><'col-sm-7 text-right'p>>",		
	// "searching": false,
	"autoWidth": false,
	"lengthChange": true,
	"lengthMenu": [ 10, 25, 50, 75, 100 ],
	"info" : true,
	"bPaginate" : true,
	"bSort" : true,
	"pageLength": 25,
	"language":{
	    "paginate": {
	        "first":      "Đầu",
	        "last":       "Cuối",
	        "next":       "Sau",
	        "previous":   "Trước",
	    },
	    "sSearch" : '',
	    "sSearchPlaceholder": "Tìm theo từ khóa",
	    "lengthMenu":     "_MENU_",
	    "info":           "Hiện thị _START_ đến _END_ của _TOTAL_ chương",
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
    	// $('.box-datatable table').css({'width': 'max-content' , 'min-width' : 'calc(100% - 2px)'});
   		// $('.box-datatable').css({'overflow-x': 'scroll'});
    },
    "rowCallback": function( row, data, index ) {
    	// console.log(data);
  	},
}); 

function check_json(itme){
	try {		
		let data = $('textarea[name=json_link]').val();
		data = JSON.parse(data);
		let list_link = $('.list-link-img');
		list_link.html('');
		let pos = 0;
		data.forEach(function(item,index) {
			var input = '<div class="input-group">\
							<span class="input-group-addon">'+(index + 1)+'</span>\
							<input type="text" class="form-control" name="link[]" placeholder="link" value="'+item+'">\
							<img src="'+item+'">\
						</div>';
			list_link.append(input);
			pos++;			
		});

		var input = '<div class="input-group">\
						<span class="input-group-addon">'+(pos + 1)+'</span>\
						<input type="text" class="form-control" name="link[]" placeholder="link" value="">\
						<img src="">\
					</div>';
		list_link.append(input);
	}catch(err) {
		alert(err.message);
	}
}
