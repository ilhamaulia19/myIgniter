$(function(){
	if (successMesage) {
		alertify.success(successMesage);		
	};

	$('#mini-refresh').click(function() {
		$('#btn-refresh').trigger('click');
	});

	$('.quickSearchButton').click(function(){
		$(this).closest('.flexigrid').find('.quickSearchBox').slideToggle('normal');
	});

	$('.ptogtitle').click(function(){
		if ($(this).hasClass('vsble')) {
			$(this).removeClass('vsble');
			$(this).closest('.flexigrid').find('.main-table-box').slideDown("slow");
		} else {
			$(this).addClass('vsble');
			$(this).closest('.flexigrid').find('.main-table-box').slideUp("slow");
		}
	});

	var call_fancybox = function(){
		$('.image-thumbnail').fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600,
			'speedOut'		:	200,
			'overlayShow'	:	false
		});
	};

	call_fancybox();
	add_edit_button_listener();

	$('.filtering_form').submit(function(){
		var crud_page =  parseInt($(this).closest('.flexigrid').find('.crud_page').val(), 10);
		var last_page = parseInt($(this).closest('.flexigrid').find('.last-page-number').html(), 10);

		if (crud_page > last_page) {
			$(this).closest('.flexigrid').find('.crud_page').val(last_page);
		}
		if (crud_page <= 0) {
			$(this).closest('.flexigrid').find('.crud_page').val('1');
		}

		var this_form = $(this);

		var ajax_list_info_url = $(this).attr('data-ajax-list-info-url');

		$(this).ajaxSubmit({
			 url: ajax_list_info_url,
			 dataType: 'json',
			 beforeSend: function(){
				 this_form.closest('.flexigrid').find('.ajax_refresh_and_loading').addClass('loading');
				 $('#mini-refresh i').addClass('fa-spin');
				 $('#overlayTable').show();
			 },
			 complete: function(){			 	
				this_form.closest('.flexigrid').find('.ajax_refresh_and_loading').removeClass('loading');				
			 },
			 success:    function(data){
				this_form.closest('.flexigrid').find('.total_items').html( data.total_results);
				displaying_and_pages(this_form.closest('.flexigrid'));

				this_form.ajaxSubmit({
					 success:    function(data){
						this_form.closest('.flexigrid').find('.ajax_list').html(data);
						call_fancybox();
						add_edit_button_listener();
						dataList();
					 }
				});
			 }
		});

		return false;
	});

	$('.crud_search').click(function(){
		$(this).closest('.flexigrid').find('.crud_page').val('1');
		$(this).closest('.flexigrid').find('.filtering_form').trigger('submit');
	});

	$('.search_clear').click(function(){
		$(this).closest('.flexigrid').find('.crud_page').val('1');
		$(this).closest('.flexigrid').find('.search_text').val('');
		$(this).closest('.flexigrid').find('.filtering_form').trigger('submit');
	});

	$('.per_page').change(function(){
		$(this).closest('.flexigrid').find('.crud_page').val('1');
		$(this).closest('.flexigrid').find('.filtering_form').trigger('submit');
	});

	$('.ajax_refresh_and_loading').click(function(){
		$(this).closest('.flexigrid').find('.filtering_form').trigger('submit');
	});

	$('.first-button').click(function(){
		$(this).closest('.flexigrid').find('.crud_page').val('1');
		$(this).closest('.flexigrid').find('.filtering_form').trigger('submit');
	});

	$('.prev-button').click(function(){
		if( $(this).closest('.flexigrid').find('.crud_page').val() != "1")
		{
			$(this).closest('.flexigrid').find('.crud_page').val( parseInt($(this).closest('.flexigrid').find('.crud_page').val(),10) - 1 );
			$(this).closest('.flexigrid').find('.crud_page').trigger('change');
		}
	});

	$('.last-button').click(function(){
		$(this).closest('.flexigrid').find('.crud_page').val( $(this).closest('.flexigrid').find('.last-page-number').html());
		$(this).closest('.flexigrid').find('.filtering_form').trigger('submit');
	});

	$('.next-button').click(function(){
		$(this).closest('.flexigrid').find('.crud_page').val( parseInt($(this).closest('.flexigrid').find('.crud_page').val()) + 1 );
		$(this).closest('.flexigrid').find('.crud_page').trigger('change');
	});

	$('.crud_page').change(function(){
		$(this).closest('.flexigrid').find('.filtering_form').trigger('submit');
	});

	$('.ajax_list').on('click','.field-sorting', function(){
		$(this).closest('.flexigrid').find('.hidden-sorting').val($(this).attr('rel'));

		if ($(this).hasClass('asc')) {
			$(this).closest('.flexigrid').find('.hidden-ordering').val('desc');
		} else {
			$(this).closest('.flexigrid').find('.hidden-ordering').val('asc');
		}

		$(this).closest('.flexigrid').find('.crud_page').val('1');
		$(this).closest('.flexigrid').find('.filtering_form').trigger('submit');
	});

	$('.ajax_list').on('click','.delete-row', function(){
		var delete_url = $(this).attr('href');

		var this_container = $(this).closest('.flexigrid');

		alertify.confirm( message_alert_delete ,
		  function(){
		    $.ajax({
				url: delete_url,
				dataType: 'json',
				success: function(data)
				{
					if(data.success)
					{
						this_container.find('.ajax_refresh_and_loading').trigger('click');

						alertify.success(data.success_message);
					}
					else
					{
						alertify.error(data.error_message);

					}
				}
			});
		  });

		return false;
	});

	$('.export-anchor').click(function(){
		var export_url = $(this).attr('data-url');

		var form_input_html = '';
		$.each($(this).closest('.flexigrid').find('.filtering_form').serializeArray(), function(i, field) {
		    form_input_html = form_input_html + '<input type="hidden" name="'+field.name+'" value="'+field.value+'">';
		});

		var form_on_demand = $("<form/>").attr("id","export_form").attr("method","post").attr("target","_blank")
								.attr("action",export_url).html(form_input_html);

		$(this).closest('.flexigrid').find('.hidden-operations').html(form_on_demand);

		$(this).closest('.flexigrid').find('.hidden-operations').find('#export_form').submit();
	});

	$('.print-anchor').click(function(){
		var print_url = $(this).attr('data-url');

		var form_input_html = '';
		$.each($(this).closest('.flexigrid').find('.filtering_form').serializeArray(), function(i, field) {
		    form_input_html = form_input_html + '<input type="hidden" name="'+field.name+'" value="'+field.value+'">';
		});

		var form_on_demand = $("<form/>").attr("id","print_form").attr("method","post").attr("action",print_url).html(form_input_html);

		$(this).closest('.flexigrid').find('.hidden-operations').html(form_on_demand);

		var _this_button = $(this);

		$(this).closest('.flexigrid').find('#print_form').ajaxSubmit({
			beforeSend: function(){
				_this_button.find('.fbutton').addClass('loading');
				_this_button.find('.fbutton>div').css('opacity','0.4');
			},
			complete: function(){
				_this_button.find('.fbutton').removeClass('loading');
				_this_button.find('.fbutton>div').css('opacity','1');
			},
			success: function(html_data){
				$("<div/>").html(html_data).printElement();
			}
		});
	});

	$('.crud_page').numeric();
	dataList();
});

function displaying_and_pages(this_container)
{
	if (this_container.find('.crud_page').val() == 0) {
		this_container.find('.crud_page').val('1');
	}

	var crud_page 		= parseInt( this_container.find('.crud_page').val(), 10) ;
	var per_page	 	= parseInt( this_container.find('.per_page').val(), 10 );
	var total_items 	= parseInt( this_container.find('.total_items').html(), 10 );

	this_container.find('.last-page-number').html( Math.ceil( total_items / per_page) );

	if (total_items == 0) {
		this_container.find('.page-starts-from').html( '0');
	} else {
		this_container.find('.page-starts-from').html( (crud_page - 1)*per_page + 1 );
	}

	if (crud_page*per_page > total_items) {
		this_container.find('.page-ends-to').html( total_items );
	} else {
		this_container.find('.page-ends-to').html( crud_page*per_page );
	}
}
function dataList()
{
	$('#flex1').dataTable(datatablesOptions());
	$('#mini-refresh i').removeClass('fa-spin');   
	$('#overlayTable').fadeOut(250);
	afterDatatables();	
}