function initialize(name)
{
	var address = name;
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({
    'address': address
    }, function(results, status) {
        var lat=results[0].geometry.location.lat();
        var lng=results[0].geometry.location.lng();
        var center = new google.maps.LatLng(lat,lng);
        var image = 'http://i.stack.imgur.com/orZ4x.png';
        var userLatLng = new google.maps.LatLng(lat, lng);
        var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 3,
			center: center,
			mapTypeId: google.maps.MapTypeId.ROADMAP

		});
		var marker = new google.maps.Marker({
        position: userLatLng,
        title: name,
        map: map
    });
    });
}

jQuery(document).ready(function() {
	var name = '<?php echo $this->item[0]->country_name;?>';
	initialize(name);
	jQuery('.category').children('dt').click();
	jQuery('.categories_faqs span.ltr').hide();
	jQuery('.category_head').hide();
	jQuery('.faq_container').find('dl:first dd').show();
	jQuery('.faq_container').find('dl:first dt span').addClass('show_standart_ltr');
	jQuery('.collapseall').hide();
	jQuery('.expandall').click(function() {
			jQuery('.faq_standart').children('dd').slideDown();
			jQuery('.faq_container').find('.standart_title_ltr').addClass('show_standart_ltr');
			jQuery('.expandall').hide();
			jQuery('.collapseall').show();
	});

	jQuery('.collapseall').click(function() {
		jQuery('.faq_standart').children('dd').slideUp();
		jQuery('.faq_container').find('.standart_title_ltr').removeClass('show_standart_ltr');
		jQuery('.collapseall').hide();
		jQuery('.expandall').show();
	});


	jQuery(".overview_more").click(function(){
		if(jQuery(".overview_more_content").css("display") == "none"){
				jQuery(".overview_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".overview_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_HIDE');?>')});
		}else{
			jQuery(".overview_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".overview_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_SHOW_MORE');?>')});
		}
	});

	jQuery(".measures_more").click(function(){
		if(jQuery(".measures_more_content").css("display") == "none"){
				jQuery(".measures_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".measures_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_HIDE');?>')});
		}else{
			jQuery(".measures_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".measures_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_SHOW_MORE');?>')});
		}
	});

	jQuery(".knowledge_more").click(function(){
		if(jQuery(".knowledge_more_content").css("display") == "none"){
				jQuery(".knowledge_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".knowledge_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_HIDE');?>')});
		}else{
			jQuery(".knowledge_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".knowledge_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_SHOW_MORE');?>')});
		}
	});

	jQuery(".unredd_more").click(function(){
		if(jQuery(".unredd_more_content").css("display") == "none"){
				jQuery(".unredd_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".unredd_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_HIDE');?>')});
		}else{
			jQuery(".unredd_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".unredd_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_SHOW_MORE');?>')});
		}
	});

	jQuery(".announcements_more").click(function(){
		if(jQuery(".announcements_more_content").css("display") == "none"){
				jQuery(".announcements_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".announcements_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_HIDE');?>')});
		}else{
			jQuery(".announcements_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".announcements_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_SHOW_MORE');?>')});
		}
	});

	jQuery(".useful_more").click(function(){
		if(jQuery(".useful_more_content").css("display") == "none"){
				jQuery(".useful_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".useful_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_HIDE');?>')});
		}else{
			jQuery(".useful_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".useful_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_SHOW_MORE');?>')});
		}
	});

	jQuery(".socialfeeds_more").click(function(){
		if(jQuery(".socialfeeds_more_content").css("display") == "none"){
				jQuery(".socialfeeds_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".socialfeeds_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_HIDE');?>')});
		}else{
			jQuery(".socialfeeds_more_content").animate({
				height: 'toggle'
			}, 500, function(){jQuery(".socialfeeds_more").html('<?php echo JText::_('COM_UNSUBJECTS_OVERVIEW_SHOW_MORE');?>')});
		}
	});
