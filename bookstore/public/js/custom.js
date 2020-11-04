//SLIDE BANNER
var banner = $("#banner .content-banner"); 
banner.owlCarousel({
	navigation : false,
	singleItem : true,
	transitionStyle : "fade",
	lazyLoad : true,
	autoPlay:5000,
	slideSpeed: 700,
	// paginationSpeed: 3000,
	pagination : false,
	// autoPlay:true,
	afterAction: function(el){
	   //remove class active
	   // this
	   // .$owlItems
	   // .removeClass('active')

	   // //add class active
	   // this
	   // .$owlItems //owl internal $ object containing items
	   // .eq(this.currentItem + 1)
	   // .addClass('active')    
    }, 
	afterInit: function(event){
		let active = this.$owlItems.eq(this.currentItem);
		let effe_2 = ['animated lightSpeedIn','animated slideInDown','animated slideInLeft','animated slideInRight','animated zoomIn'];
		let effe_p = ['animated fadeInLeft','animated fadeInRight','animated fadeInDown'];
		
		active.find('.banner-title h2').hide();
		setTimeout(function(){
			active.find('.banner-title h2').show();
			active.siblings().find('.banner-title h2').removeAttr('class');
			active.find('.banner-title h2').addClass(effe_2[getRandomInt(5)]); 
		},700);

		active.find('.banner-title p').hide();
		setTimeout(function(){
			active.find('.banner-title p').show();
			active.siblings().find('.banner-title p').removeAttr('class');
			active.find('.banner-title p').addClass(effe_p[getRandomInt(3)]); 
		},1500);
	},
	beforeMove: function(event){

	},
	afterMove: function(event){
		let active = this.$owlItems.eq(this.currentItem);
		let effe_2 = ['animated lightSpeedIn','animated slideInDown','animated zoomInDown','animated jackInTheBox','animated zoomIn'];
		let effe_p = ['animated fadeInLeft','animated fadeInRight','animated fadeInDown'];
		
		active.find('.banner-title h2').hide();
		setTimeout(function(){
			active.find('.banner-title h2').show();
			active.siblings().find('.banner-title h2').removeAttr('class');
			active.find('.banner-title h2').addClass(effe_2[getRandomInt(5)]); 
		},700);

		active.find('.banner-title p').hide();
		setTimeout(function(){
			active.find('.banner-title p').show();
			active.siblings().find('.banner-title p').removeAttr('class');
			active.find('.banner-title p').addClass(effe_p[getRandomInt(3)]); 
		},1500);

	},
});
$(".banner-next").click(function(){
	banner.trigger('owl.next');
})
$(".banner-prev").click(function(){
	banner.trigger('owl.prev');
})
function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}


//SLIDE IMAGE PRODUCT
var slide_product = $("#slide_product .list-image-product"); 
slide_product.owlCarousel({
	navigation : false,
	singleItem : true,
	// transitionStyle : "fade",
	lazyLoad : true,
	autoPlay:false,
	slideSpeed: 700,
	// paginationSpeed: 3000,
	pagination : true,
	// autoPlay:true,
	afterAction: function(el){
	     
    }, 
	afterInit: function(event){
		this.$owlItems.eq(this.currentItem).find('img').addClass('zoom_mw');
		$('.zoomContainer').remove();

		if($(window).innerWidth() > 750)
			setTimeout(function(){
				$(".zoom_mw").elevateZoom({
					scrollZoom : true,
					zoomLevel: .7,
					borderSize : 1,
					showLens  :false,
				});
			},500)	
	},
	beforeMove: function(event){
		this.$owlItems.eq(this.currentItem).find('img').removeClass('zoom_mw');
		$('.zoomContainer').remove();
	},
	afterMove: function(event){
		console.log($(window).innerWidth());
		this.$owlItems.eq(this.currentItem).find('img').addClass('zoom_mw');
		$('.zoomContainer').remove();
		if($(window).innerWidth() > 750)
			setTimeout(function(){
				$(".zoom_mw").elevateZoom({
					scrollZoom : true,
					zoomLevel: .7,
					borderSize : 1,
					showLens  :false,
				});
			},500)	
	},
});
$(".banner-next").click(function(){
	slide_product.trigger('owl.next');
})
$(".banner-prev").click(function(){
	slide_product.trigger('owl.prev');
})


//SLIDE ITEMS PRODUCT
var box_slide_product = $(".box-slide-product"); 
box_slide_product.owlCarousel({
	itemsCustom : [[0, 2], [600, 3], [768, 4],[992, 6], [1200, 6]],
	// rewindNav : false,
	lazyLoad : true,
	pagination : false,
	navigation : false,
	slideSpeed : 500,
	autoPlay:10000,	
});
// $(".new-comic .btn-next").click(function(){
// 	new_comic.trigger('owl.next');
// })
// $(".new-comic .btn-prev").click(function(){
// 	new_comic.trigger('owl.prev');
// })


//FEEDBACK
var feedback = $("#feedback-owl"); 
feedback.owlCarousel({
	itemsCustom : [[0, 1], [768, 2], [992, 3], [1600, 4]],
	navigation : true,
	// rewindNav : false,
	lazyLoad : true,
	pagination : false,
	navigation : false,
	slideSpeed : 1000,
	autoPlay:10000,
});
$(".feedback .btn-next").click(function(){
	feedback.trigger('owl.next');
})
$(".feedback .btn-prev").click(function(){
	feedback.trigger('owl.prev');
})

var cartTimeout;
$(document).on('click','.btn-minus-cart',function(){
	let _this = $(this);
	let qty = parseInt(_this.closest('.input-group').find('input').val());
	let rowid = _this.closest('.input-group').find('input').attr('id');
	if(qty == 1) qty = 0;
	else qty = qty - 1;
	_this.closest('.input-group').find('input').val(qty);

	clearTimeout(cartTimeout);
	cartTimeout = setTimeout(function(){
		$.ajax({	
	        url:BASE_URL + "updCart",
	        data: {
	        	qty : qty,
	        	rowid : rowid
	        },
			type: 'POST',
	        success: function(data){
	        	data = JSON.parse(data);
	        	if(data.status == 1){
	        		_this.closest('.input-group').find('input').val(data.data.qty);
	        		_this.closest('tr').find('td.td-subtotal label').text(data.data.subtotal);
	        		_this.closest('table').find('tr td.td-total label').text(data.data.total);
	        	}else if(data.status == 2){
	        		_this.closest('tr').fadeOut(function(){
	        			$(this).remove();
	        		})
	        		_this.closest('table').find('tr td.td-total label').text(data.data.total);
	        	}else{
	        		_this.closest('tr').fadeOut(function(){
	        			$(this).remove();
	        		})
	        		_this.closest('table').find('tr td.td-total label').text(data.data.total);
	        	}
	        																					
	        },
	     	beforeSend:function(data) {    
	     		// _this.find('button[type=submit]').append('<i class="fa fa-spinner fa-pulse" style="margin-left: 5px !important;font-size: 12px;"></i>').attr('disabled','');
			},
			complete: function(data){
				// _this.find('button[type=submit]').removeAttr('disabled','').find('i.fa-spinner').remove();
			} 																										
		});

	},500)
})
$(document).on('click','.btn-plus-cart',function(){
	let _this = $(this);
	let qty = parseInt(_this.closest('.input-group').find('input').val());
	let rowid = _this.closest('.input-group').find('input').attr('id');
	if(qty > 998) qty = 999;
	else qty = qty + 1;
	_this.closest('.input-group').find('input').val(qty);

	clearTimeout(cartTimeout);
	cartTimeout = setTimeout(function(){
		$.ajax({	
	        url: BASE_URL + "updCart",
	        data: {
	        	qty : qty,
	        	rowid : rowid
	        },
			type: 'POST',
	        success: function(data){
	        	data = JSON.parse(data);
	        	if(data.status == 1){
	        		_this.closest('.input-group').find('input').val(data.data.qty);
	        		_this.closest('tr').find('td.td-subtotal label').text(data.data.subtotal);
	        		_this.closest('table').find('tr td.td-total label').text(data.data.total);
	        	}else if(data.status == 2){
	        		_this.closest('tr').fadeOut(function(){
	        			$(this).remove();
	        		})
	        		_this.closest('table').find('tr td.td-total label').text(data.data.total);
	        	}else{
	        		_this.closest('tr').fadeOut(function(){
	        			$(this).remove();
	        		})
	        		_this.closest('table').find('tr td.td-total label').text(data.data.total);
	        	}
	        																					
	        },
	     	beforeSend:function(data) {    
	     		// _this.find('button[type=submit]').append('<i class="fa fa-spinner fa-pulse" style="margin-left: 5px !important;font-size: 12px;"></i>').attr('disabled','');
			},
			complete: function(data){
				// _this.find('button[type=submit]').removeAttr('disabled','').find('i.fa-spinner').remove();
			} 																										
		});

	},500)
})
$(document).on('change','input.qty-cart',function(e){
	let _this = $(this);
	let qty = parseInt(_this.closest('.input-group').find('input').val());
	let rowid = _this.closest('.input-group').find('input').attr('id');
	clearTimeout(cartTimeout);
	cartTimeout = setTimeout(function(){
		$.ajax({	
	        url:BASE_URL + "updCart",
	        data: {
	        	qty : qty,
	        	rowid : rowid
	        },
			type: 'POST',
	        success: function(data){
	        	data = JSON.parse(data);
	        	if(data.status == 1){
	        		_this.closest('.input-group').find('input').val(data.data.qty);
	        		_this.closest('tr').find('td.td-subtotal label').text(data.data.subtotal);
	        		_this.closest('table').find('tr td.td-total label').text(data.data.total);
	        	}else if(data.status == 2){
	        		_this.closest('tr').fadeOut(function(){
	        			$(this).remove();
	        		})
	        		_this.closest('table').find('tr td.td-total label').text(data.data.total);
	        	}else{
	        		_this.closest('tr').fadeOut(function(){
	        			$(this).remove();
	        		})
	        		_this.closest('table').find('tr td.td-total label').text(data.data.total);
	        	}
	        																					
	        },
	     	beforeSend:function(data) {    
	     		// _this.find('button[type=submit]').append('<i class="fa fa-spinner fa-pulse" style="margin-left: 5px !important;font-size: 12px;"></i>').attr('disabled','');
			},
			complete: function(data){
				// _this.find('button[type=submit]').removeAttr('disabled','').find('i.fa-spinner').remove();
			} 																										
		});

	},500)
})


$(document).ready(function(){
	$("#adsense").on('hide.bs.modal', function () {
    	$('#adsense input').val('');
	});

	$(document).on('change', '#select-province', function(e) {
		var name = $(this).val();
		$.ajax({
			type:"POST",
			data:{"name":name},
			url:BASE_URL+"getDistrict",
			success:function(data){
				if(data!='end'){
					$("#select-district").html("<option value=''>- Quận huyện -</option>");
					$("#select-district").append(data);					
				}else{
					$("#select-district").html("<option value=''>- Quận huyện -</option>");					
				}
			}
		});
	});
})

$('.refresh-captcha').click(function(){
	$.ajax({
        type: "POST",
        url: BASE_URL +"refreshCaptcha",
        success: function(res) {
        if (res)
            $(".captcha span").html(res);
            
        }
    });
})
function submitContact(itme){
	let _this = $(itme);
	var postData = new FormData(_this[0]);
	$.ajax({	
        url:BASE_URL + "submitForm?type=contact",
        data: postData,
        processData: false,
		contentType: false,
		type: 'POST',
        success: function(data){
        	data = JSON.parse(data);
        	var result = data.message.replace(/<br>/g , '\n');
        	if(data.status == 'true'){
        		$(itme)[0].reset();
				alert(result);
        	}else{
        		alert(result);        		
        	}
        	$('.refresh-captcha').click();        																					
        },
     	beforeSend:function(data) {    
     		_this.find('button[type=submit]').append('<i class="fa fa-spinner fa-pulse" style="margin-left: 5px !important;font-size: 12px;"></i>').attr('disabled','');
		},
		complete: function(data){
			_this.find('button[type=submit]').removeAttr('disabled','').find('i.fa-spinner').remove();
		} 																										
	});
}
function submitAdsense(itme){
	let _this = $(itme);
	var postData = new FormData(_this[0]);
	$.ajax({	
        url:BASE_URL + "submitForm?type=adsense",
        data: postData,
        processData: false,
		contentType: false,
		type: 'POST',
        success: function(data){
        	data = JSON.parse(data);
        	var result = data.message.replace(/<br>/g , '\n');
        	if(data.status == 'true'){
        		$(itme)[0].reset();
				alert(result);
        	}else{
        		alert(result);        		
        	}	
        	$('#adsense').modal('hide');																			
        },
     	beforeSend:function(data) {    
     		_this.find('button[type=submit]').append('<i class="fa fa-spinner fa-pulse" style="margin-left: 5px !important;font-size: 12px;"></i>').attr('disabled','');
		},
		complete: function(data){
			_this.find('button[type=submit]').removeAttr('disabled','').find('i.fa-spinner').remove();
		} 																										
	});
}

function submitCart(itme){
	let _this = $(itme);
	var postData = new FormData(_this[0]);
	$.ajax({	
        url:BASE_URL + "submitCart",
        data: postData,
        processData: false,
		contentType: false,
		type: 'POST',
        success: function(data){
        	data = JSON.parse(data);
        	var result = data.message.replace(/<br>/g , '\n');
        	if(data.status == 'true'){
        		$(itme)[0].reset();
				alert(result);
				window.location = BASE_URL;
        	}else{
        		alert(result);        		
        	}       																					
        },
     	beforeSend:function(data) {    
     		_this.find('button[type=submit]').append('<i class="fa fa-spinner fa-pulse" style="margin-left: 5px !important;font-size: 12px;"></i>').attr('disabled','');
		},
		complete: function(data){
			_this.find('button[type=submit]').removeAttr('disabled','').find('i.fa-spinner').remove();
		} 																										
	});
}
$(document).on('keyup','.box-filter input[name=name]',function(e){
	if(e.keyCode == 13) {
    	changeFilter($(this))
    }
})
function changeFilter(itme){
	let _this = $(itme);

	let status   = $('.box-filter select[name=status]').val();
	let material = $('.box-filter select[name=material]').val();
	let color    = $('.box-filter select[name=color]').val();
	let price    = $('.box-filter select[name=price]').val();
	let name     = $('.box-filter input[name=name]').val();

	var param = {};
	if(status) param['status']     = status;
	if(material) param['material'] = material;
	if(color) param['color']       = color;
	if(price) param['price']       = price;
	if(name) param['name']         = name;

	if(Object.keys(param).length > 0){
		param = "?"+jQuery.param(param);
		history.pushState(null, null, param);
	}else{
		history.pushState(null, null, window.location.origin + window.location.pathname);
	}
	
	

}
