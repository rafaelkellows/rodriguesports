$(function() {
	//===== File uploader =====//	
	$("#uploader").pluploadQueue({
		runtimes : 'html5,html4',
		url : 'php/upload.php',
		max_file_size : '5mb',
		unique_names : true,
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Zip files", extensions : "zip"}
		]
	});

	var options = { 
			target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       afterSuccess,  // post-submit callback 
			uploadProgress: OnProgress, //upload progress callback 
			resetForm: true        // reset the form after successful submit 
		}; 
	
	$('#bannerUploadForm').submit(function(e) {
		if( $(this).attr('action') === 'pages/banner_action.php' ) return;
	 	$(this).ajaxSubmit(options);  			
		// always return false to prevent standard browser submit and page navigation 
		return false; 
	});
	$("#btUploadImage").click(function(){
		$('#bannerUploadForm').attr('action','processupload.php?pag=banners').attr('enctype','multipart/form-data').submit();
	});

	$('#bannerUploadForm input[type=submit]').click(function(){
		$('#bannerUploadForm').attr('action','pages/banner_action.php').removeAttr('enctype').submit();
	});
	$('#bannersList input[name=status]').click(function(){
		switch($(this).val()){
			case 'all': 
                $('#bannersList .pics ul li').fadeIn('fast');
                $('#bannersList .widget .rowElem').eq(1).fadeIn('fast');
                $('.pics> ul > li > .jqTransformSelectWrapper').fadeIn('fast');
                break;
			case '0': 
                $('#bannersList .pics ul li.status_1').fadeOut('fast');
                $('#bannersList .pics ul li.status_0').fadeIn('fast');
                $('#bannersList .widget .rowElem').eq(1).fadeOut('fast');
                $('.pics> ul > li > .jqTransformSelectWrapper').fadeOut('fast');
                break;
			case '1': 
                $('#bannersList .pics ul li.status_1').fadeIn('fast');
                $('#bannersList .pics ul li.status_0').fadeOut('fast');
                $('#bannersList .widget .rowElem').eq(1).fadeOut('fast');
                $('.pics> ul > li > .jqTransformSelectWrapper').fadeOut('fast');
                break;
            default:
				return false
        }
	});
	$('#bannersList input[name=orderBanners]').click(function(){
		switch($(this).val()){
			case '0': 
                $('#bannersList .pics').removeClass('thumbs');
                break;
			case '1': 
                $('#bannersList .pics').addClass('thumbs');
                break;
            default:
				return false
        }
	});
	//Image with Crop
	var crop_options = { 
			target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       crop_afterSuccess,  // post-submit callback 
			uploadProgress: OnProgress, //upload progress callback 
			resetForm: false        // reset the form after successful submit 
		}; 
	$('#productUploadForm').submit(function(e) {
		if( $(this).attr('action') === 'pages/item_action.php' ) return;
	 	$(this).ajaxSubmit(crop_options);  			
		// always return false to prevent standard browser submit and page navigation 
		return false; 
	});
	$("#btUploadMultiImages").click(function(){
		$('#productUploadForm').attr('action','croptoupload.php').attr('enctype','multipart/form-data').submit();
	});
	$('#productUploadForm input[type=submit]').click(function(){
		$('#productUploadForm').attr('action','pages/item_action.php').removeAttr('enctype').submit();
	});

	var cat_exist = setInterval(function(){
		if($('select[name=category]').length) {
			clearInterval(cat_exist);
			$('select[name=category]').prev('ul').find('a').click(function(){
				$('input[name=i_subcategory]').val( 'subcategory_' + $('select[name=category] option:selected').val() );
 				$(this).closest('.rowElem').next('div').find('.jqTransformSelectWrapper').hide().find('ul li:first a').click();
 				if( $(this).attr('index')-1 >= 0){
					$(this).closest('.rowElem').next('div').show().find('.jqTransformSelectWrapper').eq($(this).attr('index')-1).show();
				}else{
					$(this).closest('.rowElem').next('div').hide();
				}
			});
			$("select[name^='subcategory_']").prev('ul').find('a').click(function(){
				$('input[name=i_subcategory]').val( 'subcategory_' + $('select[name=category] option:selected').val() );
			});
			//on ready document
			$('select[name=category] option').each(function(){
				if( $(this).is(':selected') ){
					$(this).closest('.rowElem').next('div').find('.jqTransformSelectWrapper').hide();
					$(this).closest('.rowElem').next('div').find('.jqTransformSelectWrapper').eq($(this).index()-1).show();
				}
			});
			if( $('select[name=category]').prev('ul').find('li:first a').hasClass('selected') ) {
				$('select[name=category]').prev('ul').find('li:first a').click();
			}
		}

	},100);

	var link_item = setInterval(function(){
		if($('select[name=link]').length) {
			clearInterval(link_item);
			$('select[name=link]').prev('ul').find('a').click(function(){
 				if( $(this).attr('index') > 0){
					$(this).closest('.rowElem').next('div').addClass('hide');
				}else{
					$(this).closest('.rowElem').next('div').removeClass('hide');
				}
			});

			//on ready document
			//if( $('select[name=link]').prev('ul').find('li:first a').hasClass('selected') ) $('select[name=link]').prev('ul').find('li:first a').click();
		}

	},100);

	var lbl_color = setInterval(function(){
		if($('select[name=lbl_color]').length){
			clearInterval(lbl_color);
			$('select[name=lbl_color]').prev('ul').find('a').click(function(){
 				if( $(this).attr('index') > 0){
					var _color = $(this).closest('ul').next('select').find('option:selected').val();
					$(this).closest('div').parent().find('>input').val(_color);
					$(this).closest('div').parent().find('>span').attr('style','background-color:#'+_color);
				}else{
					$(this).closest('.rowElem').next('div').removeClass('hide').find('input[type=text]').val('');
				}
			});

			//on ready document
			//if( $('select[name=link]').prev('ul').find('li:first a').hasClass('selected') ) $('select[name=link]').prev('ul').find('li:first a').click();
		}

	},100);



	//===== Categories Manager =====//
	$('.widgets.categories > .widget > .head').each(function(){
		if( $(this).next('.body').has('div').length ){
			//$(this).find('.actions .delete_category').hide();
		}
	});

	$('.widgets.categories .widget .head h5').click(function(){
		if( $(this).find('input').attr('disabled') ){
			$(this).parent().toggleClass('inactive').next('.body').fadeToggle(500);
		}
		else{
			$('#new_subcategory').focusout();
		}
	});

	//===== Categories Form Vars Action Definition =====//

	// Submit on Save Press Button
    $('#categoriesForm').live('submit', function(e) {
        return;
        e.preventDefault();
        $(this).ajaxSubmit({
            target: '#output',
            success: function(){ 
            	setTimeout(
            		function(){ 
            			$('#output > div').fadeOut(200,function(){
            				$(this).remove();
            			})
            		},2500); 
            },
            resetForm: false
        });
    });

    var categoryEvent = function(){
    	var _form = $("#categoriesForm");
    	
    	var _add_item = function(_level,_cid){
			jPrompt('Digite abaixo um título para o novo item e clique em OK para cadastrar<br>ou em CANCEL para sair dessa janela.', '', 'ADICIONAR ITEM', function(_name) {
				if( _name ){
					if(_level == "subcat"){
						_form.find('input[name=cid]').val(_cid);
					}
					_form.find('input[name=nvg]').val('add');
					_form.find('input[name=title]').val(_name);
					_form.submit();
				}
			});
		}
		//Add Category
    	_form.find('a.add_category').click(function(){ 
    		_add_item('cat', 0); 
    	});
		//Add Subcategory
    	_form.find('.widgets.categories .actions > a.add_subcategory').click(function(){ 
    		var _cid = $(this).closest('.head').find('input').attr('id').replace('cat_','');
    		_add_item('subcat', _cid); 
    	});

    	var _edit_item = function(_id){
			var _item = $('#'+_id);
			var _cid = ( _id.indexOf('subcat') != -1 ) ? _item.closest('.body').prev('.head').find('h5 input').attr('id').replace('cat_','') : _item.closest('.head').find('input').attr('id').replace('cat_','');
			var _sid = ( _id.indexOf('subcat') != -1 ) ? _item.closest('.head').find('input').attr('id').replace('subcat_','') : 0;

			jPrompt('Edite abaixo o título do item e clique em OK para cadastrar<br>ou em CANCEL para sair dessa janela.', _item.val(), 'Prompt Dialog', function(_name) {
				if( _name ){
					_form.find('input[name=nvg]').val('edit');
					_form.find('input[name=cid]').val(_cid);
					_form.find('input[name=sid]').val(_sid);
					_form.find('input[name=title]').val(_name);
					_form.submit();
				}
			});
		}
		//Edit Category and SubCategory
    	_form.find('a.edit_category, .widgets.categories .actions > a.edit_subcategory').click(function(){
    		var _id = $(this).closest('.head').find('input').attr('id');
    		_edit_item(_id); 
    	});

    	var _delete_item = function(_id){
			var _item = $('#'+_id);
			var _cid = ( _id.indexOf('subcat') != -1 ) ? _item.closest('.body').prev('.head').find('h5 input').attr('id').replace('cat_','') : _item.closest('.head').find('input').attr('id').replace('cat_','');
			var _sid = ( _id.indexOf('subcat') != -1 ) ? _item.closest('.head').find('input').attr('id').replace('subcat_','') : 0;
			

			if( _cid > 0 && _sid == 0 ){
				if( _item.closest('.head').next('.body').has('div').length > 0 ){
					jConfirm('<strong style="color:#eac572; font-size:15px">ATENÇÂO:</strong><br><strong>'+_item.val()+'</strong> possui itens atrelado a ele e que <br>não poderão ser recuperados após confirmar essa ação.<br> Você deseja realmente excluir este item?', 'Excluir Item?', function(_index) {
						if(_index){
							_form.find('input[name=nvg]').val('delete');
							_form.find('input[name=cid]').val(_cid);
							_form.find('input[name=sid]').val(-1);
							_form.find('input[name=title]').val(_item.val());
							_form.submit();
						}
					});
				}else{
					jConfirm('Você deseja realmente excluir <strong>'+_item.val()+'</strong>?', 'Excluir Item?', function(_index) {
						if(_index){
							_form.find('input[name=nvg]').val('delete');
							_form.find('input[name=cid]').val(_cid);
							_form.find('input[name=sid]').val(_sid);
							_form.find('input[name=title]').val(_item.val());
							_form.submit();
						}
					});
				}
			}else{
				jConfirm('Você deseja realmente excluir <strong>'+_item.val()+'</strong>?', 'Excluir Item?', function(_index) {
					if(_index){
						_form.find('input[name=nvg]').val('delete');
						_form.find('input[name=cid]').val(_cid);
						_form.find('input[name=sid]').val(_sid);
						_form.find('input[name=title]').val(_item.val());
						_form.submit();
					}
				});
			}
		}
		//Edit Category and SubCategory
    	_form.find('a.delete_category, .widgets.categories .actions > a.delete_subcategory').click(function(){
    		var _id = $(this).closest('.head').find('input').attr('id');
    		_delete_item(_id); 
    	});

    }
	categoryEvent();

    var saveCategory = function(_i_e){ //Input Element
		var _t_input = _t.closest('.head').find('h5 input');
		var _f = _t.closest('#categoriesForm');
			if(_t_input.attr('id') === "new_subcategory"){
				_s = _t.closest('.body').prev('.head').find('h5 input').attr('id');
				_f.find('input[name=sid]').val(_s);
			}
			_f.find('input[name=cid]').val(_t_input.attr('id'));
			_f.find('input[name=nvg]').val('category');
			var chn =  (_t_input.attr('id').indexOf('sub') != -1) ? 'subcat':'cat'; 
			_f.find('input[name=chn]').val(chn);
			_f.find('input[name=title]').val(_t_input.val());
			//_f.submit();
	}

	$('.pics.preview.products .actions a.delete').click(function(){
		var elemThis = jQuery(this);
		jConfirm('Você quer realmente excluir este Produto?', 'Excluir Produto?', function(r) {
			if(r){
				elemThis.closest('li').fadeOut('slow',function(){
					if( elemThis.closest('ul').find('li').length === 0 ){
						elemThis.closest('ul').append('<li class="none"><p style="padding:5px; text-align:center;font-size:11px;">Nenhuma imagem cadastrada.</p></li>');
					}
					$(this).remove();
				})
			}
		});
	});

	//===== File manager =====//		
	$('#fileManager').elfinder({
		url : 'php/connector.php',
	})

	//===== Alert windows =====//
	$(".bAlert").click( function() {
		jAlert('This is a custom alert box. Title and this text can be easily editted', 'Alert Dialog Sample');
	});
	
	$(".bConfirm").click( function() {
		jConfirm('Can you confirm this?', 'Confirmation Dialog', function(r) {
			//jAlert('Confirmed: ' + r, 'Confirmation Results');
			if(r){
				$(this).closest('#frm_User').find('input.nvg').val('delete_user').closest('#frm_User').submit();
			}
		});
	});

	$(".deleteUser").click( function() {
		var elemThis = jQuery(this);
		jConfirm('Você quer realmente excluir este Usuário?', 'Excluir Usuário?', function(r) {
			if(r){
				elemThis.closest('#frm_User').find('input[name=nvg]').val('delete_user').closest('#frm_User').submit(); 
			}
		});
	});	
	
	$(".deleteBanner").click( function() {
		var elemThis = jQuery(this);
		jConfirm('Você quer realmente excluir este Banner?', 'Excluir Banner?', function(r) {
			if(r){
				elemThis.closest('form').find('input[name=nvg]').val('delete_banner').closest('form').submit();
			}
		});
	});

	$(".deleteProduct").click( function() {
		var elemThis = jQuery(this);
		jConfirm('Você quer realmente excluir este Produto?', 'Excluir Produto?', function(r) {
			if(r){
				elemThis.closest('form').find('input[name=nvg]').val('delete_product').closest('form').submit();
			}
		});
	});
	$('#productUploadForm input[name=orderProducts]').click(function(){
		switch($(this).val()){
			case '0': 
                $('#productsPreview').removeClass('thumbs');
                break;
			case '1': 
                $('#productsPreview').addClass('thumbs');
                break;
            default:
				return false
        }
	});
	
	$(".pics .actions a.deleteBanner").click( function() {
		var elemThis = jQuery(this);
		jConfirm('Você quer realmente excluir este Banner?', 'Excluir Banner?', function(r) {
			if(r){
				elemThis.closest('form').find('input[name=nvg]').val('delete_banner').closest('form').find('input[name=bid]').val(elemThis.attr('bid')).closest('form').submit();
			}
		});
	});
	
	$(".bPromt").click( function() {
		jPrompt('Type something:', 'Prefilled value', 'Prompt Dialog', function(r) {
			if( r ) alert('You entered ' + r);
		});
	});
	
	$(".bHtml").click( function() {
		jAlert('You can use HTML, such as <strong>bold</strong>, <em>italics</em>, and <u>underline</u>!');
	});


	//===== Accordion =====//		
	
	$('div.menu_body:eq(0)').show();
	$('.acc .head:eq(0)').show();
	
	$(".acc .head").click(function() {	
		$(this).css({color:"#B55D5C"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().css({color:"#424242"});
	});

	//===== WYSIWYG editor =====//
	
	$('.wysiwyg').wysiwyg({
		iFrameClass: "wysiwyg-input",
		controls: {
			bold          : { visible : true },
			italic        : { visible : true },
			underline     : { visible : true },
			strikeThrough : { visible : false },
			
			justifyLeft   : { visible : false },
			justifyCenter : { visible : false },
			justifyRight  : { visible : false },
			justifyFull   : { visible : false },
			
			indent  : { visible : false },
			outdent : { visible : false },
			
			subscript   : { visible : false },
			superscript : { visible : false },
			
			undo : { visible : true },
			redo : { visible : true },

			insertOrderedList    : { visible : false },
			insertUnorderedList  : { visible : false },
			insertHorizontalRule : { visible : false },

			highlight: { visible : false },

			createLink: { visible : false },
			insertImage: { visible : false },
			insertTable: { visible : false },
			code: { visible : false },

			h1: {
			visible: false,
			className: 'h1',
			command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
			arguments: ($.browser.msie || $.browser.safari) ? '<h1>' : 'h1',
			tags: ['h1'],
			tooltip: 'Header 1'
			},
			h2: {
			visible: false,
			className: 'h2',
			command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
			arguments: ($.browser.msie || $.browser.safari) ? '<h2>' : 'h2',
			tags: ['h2'],
			tooltip: 'Header 2'
			},
			h3: {
			visible: false,
			className: 'h3',
			command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
			arguments: ($.browser.msie || $.browser.safari) ? '<h3>' : 'h3',
			tags: ['h3'],
			tooltip: 'Header 3'
			},
			h4: {
			visible: false,
			className: 'h4',
			command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
			arguments: ($.browser.msie || $.browser.safari) ? '<h4>' : 'h4',
			tags: ['h4'],
			tooltip: 'Header 4'
			},
			h5: {
			visible: false,
			className: 'h5',
			command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
			arguments: ($.browser.msie || $.browser.safari) ? '<h5>' : 'h5',
			tags: ['h5'],
			tooltip: 'Header 5'
			},
			h6: {
			visible: false,
			className: 'h6',
			command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
			arguments: ($.browser.msie || $.browser.safari) ? '<h6>' : 'h6',
			tags: ['h6'],
			tooltip: 'Header 6'
			},
			
			cut   : { visible : false },
			copy  : { visible : false },
			paste : { visible : false },
			html  : { visible: true },
			increaseFontSize : { visible : false },
			decreaseFontSize : { visible : false },
			},
		events: {
			click: function(event) {
				if ($("#click-inform:checked").length > 0) {
					event.preventDefault();
					alert("You have clicked jWysiwyg content!");
				}
			}
		}
	});
	
	//$('.wysiwyg').wysiwyg("insertHtml", "Sample code");

	//===== ToTop =====//

	$().UItoTop({ easingType: 'easeOutQuart' });	
	
	
	//===== Spinner options =====//
	
	var itemList = [
		{url: "http://ejohn.org", title: "John Resig"},
		{url: "http://bassistance.de/", title: "J&ouml;rn Zaefferer"},
		{url: "http://snook.ca/jonathan/", title: "Jonathan Snook"},
		{url: "http://rdworth.org/", title: "Richard Worth"},
		{url: "http://www.paulbakaus.com/", title: "Paul Bakaus"},
		{url: "http://www.yehudakatz.com/", title: "Yehuda Katz"},
		{url: "http://www.azarask.in/", title: "Aza Raskin"},
		{url: "http://www.karlswedberg.com/", title: "Karl Swedberg"},
		{url: "http://scottjehl.com/", title: "Scott Jehl"},
		{url: "http://jdsharp.us/", title: "Jonathan Sharp"},
		{url: "http://www.kevinhoyt.org/", title: "Kevin Hoyt"},
		{url: "http://www.codylindley.com/", title: "Cody Lindley"},
		{url: "http://malsup.com/jquery/", title: "Mike Alsup"}
	];

	var opts = {
		's1': {decimals:2},
		's2': {stepping: 0.25},
		's3': {currency: '$'},
		's4': {},
		's5': {
			//
			// Two methods of adding external items to the spinner
			//
			// method 1: on initalisation call the add method directly and format html manually
			init: function(e, ui) {
				for (var i=0; i<itemList.length; i++) {
					ui.add('<a href="'+ itemList[i].url +'" target="_blank">'+ itemList[i].title +'</a>');
				}
			},

			// method 2: use the format and items options in combination
			format: '<a href="%(url)" target="_blank">%(title)</a>',
			items: itemList
		}
	};

	for (var n in opts)
		$("#"+n).spinner(opts[n]);

	$("button").click(function(e){
		var ns = $(this).attr('id').match(/(s\d)\-(\w+)$/);
		if (ns != null)
			$('#'+ns[1]).spinner( (ns[2] == 'create') ? opts[ns[1]] : ns[2]);
	});


	//===== Contacts list =====//
	
	$('#myList').listnav({ 
		initLetter: 'all', 
		includeAll: true, 
		includeOther: true, 
		flagDisabled: true, 
		noMatchText: 'Nothing matched your filter, please click another letter.', 
		prefixes: ['the','a'] ,
	});


	//===== ShowCode plugin for <pre> tag =====//

	$('.showCode').sourcerer('js html css php'); // Display all languages
	$('.showCodeJS').sourcerer('js'); // Display JS only
	$('.showCodeHTML').sourcerer('html'); // Display HTML only
	$('.showCodePHP').sourcerer('php'); // Display PHP only
	$('.showCodeCSS').sourcerer('css'); // Display CSS only


	//===== Calendar =====//

	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		editable: true,
		events: [
			{
				title: 'All day event',
				start: new Date(y, m, 1)
			},
			{
				title: 'Long event',
				start: new Date(y, m, 5),
				id: 999,
				title: 'Repeating event',
				start: new Date(y, m, 2, 16, 0),
				end: new Date(y, m, 3, 18, 0),
				allDay: false
			},
			{
				id: 999,
				end: new Date(y, m, 8)
			},
			{
				title: 'Repeating event',
				start: new Date(y, m, 9, 16, 0),
				end: new Date(y, m, 10, 18, 0),
				allDay: false
			},
			{
				title: 'Actually any color could be applied for background',
				start: new Date(y, m, 30, 10, 30),
				end: new Date(y, m, d+1, 14, 0),
				allDay: false,
				color: '#B55D5C'
			},
			{
				title: 'Lunch',
				start: new Date(y, m, 14, 12, 0),
				end: new Date(y, m, 15, 14, 0),
				allDay: false
			},
			{
				title: 'Birthday PARTY',
				start: new Date(y, m, 18),
				end: new Date(y, m, 20),
				allDay: false
			},
			{
				title: 'Click for Google',
				start: new Date(y, m, 27),
				end: new Date(y, m, 29),
				url: 'http://google.com/'
			}
		]
	});
	
	
	//===== Dynamic data table =====//
	oTable = $('#example').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""f>t<"F"lp>'
	});
	
	
	//===== Form elements styling =====//
	
	$('form').jqTransform({imgPath:'../images/forms'});
	
	
	//===== Form validation engine =====//

	$("#frm_User, #bannerUploadForm, #productUploadForm").validationEngine();
	

	//===== Datepickers =====//

	$( ".datepicker" ).datepicker({ 
		defaultDate: +7,
		autoSize: true,
		appendText: '(dd-mm-yyyy)',
		dateFormat: 'dd-mm-yy',
	});	

	$( ".datepickerInline" ).datepicker({ 
		defaultDate: +7,
		autoSize: true,
		appendText: '(dd-mm-yyyy)',
		dateFormat: 'dd-mm-yy',
		numberOfMonths: 1
	});	


	//===== Progressbar (Jquery UI) =====//

	$( "#progressbar" ).progressbar({
			value: 37
	});
		
		
	//===== Tooltip =====//
		
	$('.leftDir').tipsy({fade: true, gravity: 'e'});
	$('.rightDir').tipsy({fade: true, gravity: 'w'});
	$('.topDir').tipsy({fade: true, gravity: 's'});
	$('.botDir').tipsy({fade: true, gravity: 'n'});

		
	//===== Information boxes =====//
		
	$(".hideit").click(function() {
		$(this).fadeOut(400);
	});
	

	//=====Resizable table columns =====//
	
	var onSampleResized = function(e){
		var columns = $(e.currentTarget).find("th");
		var msg = "columns widths: ";
		columns.each(function(){ msg += $(this).width() + "px; "; })
	};	

	$(".resize").colResizable({
		liveDrag:true, 
		gripInnerHtml:"<div class='grip'></div>", 
		draggingClass:"dragging", 
		onResize:onSampleResized});


	//===== Left navigation submenu animation =====//	
		
	$("ul.sub li a").hover(function() {
	$(this).stop().animate({ color: "#3a6fa5" }, 400);
	},function() {
	$(this).stop().animate({ color: "#494949" }, 400);
	});
	
	
	//===== Image gallery control buttons =====//

	 $(".pics ul li").hover(
		  function() { $(this).children(".actions").show("fade", 200); },
		  function() { $(this).children(".actions").hide("fade", 200); }
	 );
	var categoriesHover = function(){
		$(".widgets.categories .widget .head").hover(
		  function() { $(this).children(".actions").show("fade", 200); },
		  function() { $(this).children(".actions").hide("fade", 200); }
		);
	};
	categoriesHover();
	

	//===== Color picker =====//

	var getColorpick = function(){
		$('.colorpick').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
				$(el).next().next().attr('style','background-color:#'+hex);
				$(el).closest('li').find('.jqTransformSelectWrapper ul li:first a').click();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
		$('.moreFields.colors ul li a.remove').live('click',function(){
			$(this).parent().prev().remove();
			$(this).parent().next().remove();
			$(this).parent().remove();
		});
	}
	getColorpick();

	$('.moreFields.colors ul li a.add').live('click',function(){
		var _liID = $(this).closest('ul').find('li.line').length+1;
		var _li =  '<li><input type="text" name="colors[]" class="colorpick" id="colorpickerFieldN_'+_liID+'" value=""><label for="colorpickerFieldN_'+_liID+'" class="pick"></label><span>&nbsp;</span>';
			//_li += '<input class="color_label" type="text" placeholder="Defina aqui um nome para essa cor" name="color_label[]" value="" />';
			_li += '</li>'
			_li += '<li class="sep"><a class="remove" href="javascript:void(0);"><img src="images/icons/dark/close.png" alt="Remover cor"></a></li>';
			_li += '<li class="line">&nbsp;</li>';
			$(_li).insertBefore( $(this).parent() );
			getColorpick();
	});

	/*
	$('.moreFields.colors ul li a').live('click',function(){
		var clone = $(this).closest('ul').find('li').first().clone();
		var cloneIdNew = clone.find('input').attr('id') + $(this).closest('ul').find('li').length;
			clone.find('input').val('').attr('id',cloneIdNew);
			clone.find('label').attr('for',cloneIdNew);
			clone.insertAfter( $(this).closest('ul').find('li').eq(eval( $(this).closest('ul').find('li').length-2 )) );
			$('#'+cloneIdNew).ColorPicker({
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).val(hex);
					$(el).ColorPickerHide();
				},
				onBeforeShow: function () {
					$(this).ColorPickerSetColor(this.value);
				}
			})
			.bind('keyup', function(){
				$(this).ColorPickerSetColor(this.value);
			});
	});*/
	
	
	//===== Autogrowing textarea =====//
	
	$(".auto").autoGrow();
	

	//===== Autotabs. Inline data rows =====//

	$('.onlyNums input').autotab_magic().autotab_filter('numeric');
	$('.onlyText input').autotab_magic().autotab_filter('text');
	$('.onlyAlpha input').autotab_magic().autotab_filter('alpha');
	$('.onlyRegex input').autotab_magic().autotab_filter({ format: 'custom', pattern: '[^0-9\.]' });
	$('.allUpper input').autotab_magic().autotab_filter({ format: 'alphanumeric', uppercase: true });
	
	
	//===== jQuery UI sliders =====//	
	
	$( ".uiSlider" ).slider();
	
	$( ".uiSliderInc" ).slider({
		value:100,
		min: 0,
		max: 500,
		step: 50,
		slide: function( event, ui ) {
			$( "#amount" ).val( "$" + ui.value );
		}
	});
	$( "#amount" ).val( "$" + $( ".uiSliderInc" ).slider( "value" ) );
		
	$( ".uiRangeSlider" ).slider({
		range: true,
		min: 0,
		max: 500,
		values: [ 75, 300 ],
		slide: function( event, ui ) {
			$( "#rangeAmount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		}
	});
	$( "#rangeAmount" ).val( "$" + $( ".uiRangeSlider" ).slider( "values", 0 ) +" - $" + $( ".uiRangeSlider" ).slider( "values", 1 ));
			
	$( ".uiMinRange" ).slider({
		range: "min",
		value: 37,
		min: 1,
		max: 700,
		slide: function( event, ui ) {
			$( "#minRangeAmount" ).val( "$" + ui.value );
		}
	});
	$( "#minRangeAmount" ).val( "$" + $( ".uiMinRange" ).slider( "value" ) );
	
	$( ".uiMaxRange" ).slider({
		range: "max",
		min: 1,
		max: 100,
		value: 20,
		slide: function( event, ui ) {
			$( "#maxRangeAmount" ).val( ui.value );
		}
	});
	$( "#maxRangeAmount" ).val( $( ".uiMaxRange" ).slider( "value" ) );	
	
	
	
	$( "#eq > span" ).each(function() {
		// read initial values from markup and remove that
		var value = parseInt( $( this ).text(), 10 );
		$( this ).empty().slider({
			value: value,
			range: "min",
			animate: true,
			orientation: "vertical"
		});
	});
	
	
	//===== Breadcrumbs =====//	

	$("#breadCrumb").jBreadCrumb();
	
	
	//===== Autofocus =====//	
	
	$('.autoF').focus();


	//===== Tabs =====//
		
	$.fn.simpleTabs = function(){ 
	
		//Default Action
		$(this).find(".tab_content").hide(); //Hide all content
		$(this).find("ul.tabs li:first").addClass("activeTab").show(); //Activate first tab
		$(this).find(".tab_content:first").show(); //Show first tab content
	
		//On Click Event
		$("ul.tabs li").click(function() {
			$(this).parent().parent().find("ul.tabs li").removeClass("activeTab"); //Remove any "active" class
			$(this).addClass("activeTab"); //Add "active" class to selected tab
			$(this).parent().parent().find(".tab_content").hide(); //Hide all tab content
			var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
			$(activeTab).show(); //Fade in the active content
			return false;
		});
	
	};//end function

	$("div[class^='widget']").simpleTabs(); //Run function on any div with class name of "Simple Tabs"


	//===== Placeholder for all browsers =====//
	
	$("input").each(
		function(){
			if($(this).val()=="" && $(this).attr("placeholder")!=""){
			$(this).val($(this).attr("placeholder"));
			$(this).focus(function(){
				if($(this).val()==$(this).attr("placeholder")) $(this).val("");
			});
			$(this).blur(function(){
				if($(this).val()=="") $(this).val($(this).attr("placeholder"));
			});
		}
	});


	//===== User nav dropdown =====//		

	$('.dd').click(function () {
		$('ul.menu_body').slideToggle(100);
	});
	
	$('.acts').click(function () {
		$('ul.actsBody').slideToggle(100);
	});
	
	
	//===== Collapsible elements management =====//
	
	/*$('.active').collapsible({
		defaultOpen: 'current',
		cookieName: 'nav',
		speed: 300
	});
	
	$('.exp').collapsible({
		defaultOpen: 'current',
		cookieName: 'navAct',
		cssOpen: 'active',
		cssClose: 'inactive',
		speed: 300
	});*/
	$('.exp').live('click',function(){
		$(this).next().toggleClass('hide');
	});

	$('.opened').collapsible({
		defaultOpen: 'opened,toggleOpened',
		cssOpen: 'inactive',
		cssClose: 'normal',
		speed: 200
	});

	$('.closed').collapsible({
		defaultOpen: '',
		cssOpen: 'inactive',
		cssClose: 'normal',
		speed: 200
	});
	
	




	//===== Flot settings. You can place your own flot settings here =====//


	/* Lines */
	
	$(function () {
    var sin = [], cos = [];
    for (var i = 0; i < 10; i += 0.5) {
       // sin.push([i, Math.sin(i)]);
        //cos.push([i, Math.cos(i)]);
    }
	sin.push([0, 5]);sin.push([1, 7]);sin.push([2, 6]);
	cos.push([0, 1]);
    var plot = $.plot($(".chart"),
           [ { data: sin, label: "Minhas"}, { data: cos, label: "Turma/Classe" } ], {
               series: {
                   lines: { show: true },
                   points: { show: true }
               },
               grid: { hoverable: true, clickable: true },
               yaxis: { min: 0, max: 10 },
			   xaxis: { min: 0, max: 4 }
             });

    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            border: '1px solid #000',
            padding: '2px',
			'z-index': '9999',
            'background-color': '#202020',
			'color': '#fff',
			'font-size': '11px',
            opacity: 0.8
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    $(".chart").bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(2));
        $("#y").text(pos.y.toFixed(2));

        if ($("#enableTooltip:checked").length > 0) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    
                    showTooltip(item.pageX, item.pageY,
                                item.series.label + " of " + x + " = " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
        }
    });

    $(".chart").bind("plotclick", function (event, pos, item) {
        if (item) {
            $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
            plot.highlight(item.series, item.datapoint);
        }
    });
});



	/* Lines with autodrowing */

	$(function () {
		// we use an inline data source in the example, usually data would
		// be fetched from a server
		var data = [], totalPoints = 200;
		function getRandomData() {
			if (data.length > 0)
				data = data.slice(1);
	
			// do a random walk
			while (data.length < totalPoints) {
				var prev = data.length > 0 ? data[data.length - 1] : 50;
				var y = prev + Math.random() * 10 - 5;
				if (y < 0)
					y = 0;
				if (y > 100)
					y = 100;
				data.push(y);
			}
	
			// zip the generated y values with the x values
			var res = [];
			for (var i = 0; i < data.length; ++i)
				res.push([i, data[i]])
			return res;
		}
	
		// setup control widget
		var updateInterval = 1000;
		$("#updateInterval").val(updateInterval).change(function () {
			var v = $(this).val();
			if (v && !isNaN(+v)) {
				updateInterval = +v;
				if (updateInterval < 1)
					updateInterval = 1;
				if (updateInterval > 2000)
					updateInterval = 2000;
				$(this).val("" + updateInterval);
			}
		});
	
		// setup plot
		var options = {
			yaxis: { min: 0, max: 100 },
			xaxis: { min: 0, max: 100 },
			colors: ["#afd8f8"],
			series: {
					   lines: { 
							lineWidth: 2, 
							fill: true,
							fillColor: { colors: [ { opacity: 0.6 }, { opacity: 0.2 } ] },
							//"#dcecf9"
							steps: false
	
						}
				   }
		};
		var plot = $.plot($(".autoUpdate"), [ getRandomData() ], options);
	
		function update() {
			plot.setData([ getRandomData() ]);
			// since the axes don't change, we don't need to call plot.setupGrid()
			plot.draw();
			
			setTimeout(update, updateInterval);
		}
	
		update();
	});



	/* Bars */

	$(function () {
    var d2 = [[0.6, 29], [2.6, 13], [4.6, 46], [6.6, 30], [8.6, 48], [10.6, 22], [12.6, 40], [14.6, 32], [16.6, 39], [18.6, 16], [20.6, 27], [22.6, 22], [24.6, 2], [26.6, 45], [28.6, 23], [30.6, 28], [32.6, 30], [34.6, 40], [36.6, 20], [38.6, 47], [40.6, 12], [42.6, 49], [44.6, 28], [46.6, 15], [48.6, 24]];
	
    var plot = $.plot($(".bars"),
           [ { data: d2} ], {
               series: {
                   bars: { 
					show: true,
					lineWidth: 0.5,
					barWidth: 0.85, 
					fill: true,
					fillColor: { colors: [ { opacity: 0.8 }, { opacity: 1 } ] },
					align: "left", 
					horizontal: false,
				   },
               },
               grid: { hoverable: true, clickable: true },
               yaxis: { min: 0, max: 50 },
			   xaxis: { min: 0, max: 50 },
             });

	});






	/* Pie charts */
	
	$(function () {
		var data = [];
		var series = Math.floor(Math.random()*3)+1;
		for( var i = 0; i<series; i++)
		{
			data[i] = { label: "Series "+(i+1), data: Math.floor(Math.random()*100)+1 }
		}
	
	$.plot($("#graph1"), data, 
	{
			series: {
				pie: { 
					show: true,
					radius: 1,
					label: {
						show: true,
						radius: 2/3,
						formatter: function(label, series){
							return '<div style="font-size:11px;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
						},
						threshold: 0.1
					}
				}
			},
			legend: {
				show: false
			},
			grid: {
				hoverable: false,
				clickable: true
			},
	});
	$("#interactive").bind("plothover", pieHover);
	$("#interactive").bind("plotclick", pieClick);
	
	$.plot($("#graph2"), data, 
	{
			series: {
				pie: { 
					show: true,
					radius:300,
					label: {
						show: true,
						formatter: function(label, series){
							return '<div style="font-size:11px;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
						},
						threshold: 0.1
					}
				}
			},
			legend: {
				show: false
			},
			grid: {
				hoverable: false,
				clickable: true
			}
	});
	$("#interactive").bind("plothover", pieHover);
	$("#interactive").bind("plotclick", pieClick);
	});
	
	function pieHover(event, pos, obj) 
	{
		if (!obj)
					return;
		percent = parseFloat(obj.series.percent).toFixed(2);
		$("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
	}
	function pieClick(event, pos, obj) 
	{
		if (!obj)
					return;
		percent = parseFloat(obj.series.percent).toFixed(2);
		alert(''+obj.series.label+': '+percent+'%');
	}

	
});