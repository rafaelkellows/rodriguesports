$(document).ready(function() {
	//Math.random().toString(36).substring(7);

	$("#owl-banners").owlCarousel({
		navigation : false, // Show next and prev buttons
		slideSpeed : 1500,
		paginationSpeed : 1000,
		singleItem:true,
		autoPlay:8000
	});
	$("#owl-product").owlCarousel({
  	/*items:3,*/
  	itemsCustom : [
      [0, 1],
      [664, 1],
      [998, 1]
    ],
    navigation : false,
		slideSpeed : 500
  });
  var setOwls = function(){
		$("#owl-highlights").owlCarousel({
			itemsCustom : [ [0, 1], [425, 2], [664, 3], [980, 4] ],
			navigation : true,
			slideSpeed : 500,
			rewindNav : false
		});
		var owl = $("#owl-features").owlCarousel({
			items : 4, 
			itemsCustom : [ [0, 1], [470, 2], [664, 3], [980, 4] ],
			navigation : false,
			slideSpeed : 500,
			rewindNav : false
		});
		$("main section.features nav a.next").click(function(){ owl.trigger('owl.next'); });
		$("main section.features nav a.prev").first().click(function(){ owl.trigger('owl.prev'); });
	}

	$('.main_products nav dl dt span').click(function(){
		var _t = $(this);
		var _tdd = _t.parent().next('dd');
		if(_tdd.is(':visible')) return;
		_t.closest('nav').find('span').removeClass('active').parent().next('dd').hide('fast',function(){$(this).removeClass('active');});
		$(this).addClass('active');
		$(this).closest('dl').find('dd').show('fast',function(){ _t.addClass('active'); });
	});
	$('.main_products section.product_features .filtering ul li a').click(function(){
		$(this).closest('ul').find('li').removeClass('active');
		$(this).parent().addClass('active');
		$(this).closest('section').find('#owl-product_features').removeAttr('class').addClass($(this).attr('class'));
	});

	/* Filtering */
	var _arrElem = [];
	var _currNum = 0, _fnum=0;
	var orderBy = {
		_recents : function(){
			_arrElemTmp = $('<div id="arrElem">');
			for(var i=0; i<_arrElem.length;i++){
				_arrElemTmp.append( _arrElem[i][1] );
			}
			_arrElem.splice(0,_arrElem.length); //clear Array
			_elemens = _arrElemTmp.find('dl');
			_elemens.each(function(){
				_arrElem.push( [$(this).attr('data-modified'),'<dl data-modified="'+$(this).attr('data-modified')+'">'+$(this).html()+'</dl>'] );
			});
			_arrElem.sort().reverse();
			if( _arrElem.length > 0 ){
				$('#owl-product_features').fadeOut('slow',function(){
					$(this).html('');
					for( var i=0; i<_arrElem.length; i++ ){
						$('#owl-product_features').append(_arrElem[i][1]);
					}
					_arrElem.splice(0,_arrElem.length); //clear Array
					orderBy._number(_currNum,Number($('section.product_features div.filtering select#showBy').find(':selected').val()),$('#owl-product_features dl'));
				});
			}
		},
		_olders : function(){
			_arrElemTmp = $('<div id="arrElem">');
			for(var i=0; i<_arrElem.length;i++){
				_arrElemTmp.append( _arrElem[i][1] );
			}
			_arrElem.splice(0,_arrElem.length); //clear Array
			_elemens = _arrElemTmp.find('dl');
			_elemens.each(function(){
				_arrElem.push( [$(this).attr('data-modified'),'<dl data-modified="'+$(this).attr('data-modified')+'">'+$(this).html()+'</dl>'] );
			});
			_arrElem.sort();
			if( _arrElem.length > 0 ){
				$('#owl-product_features').fadeOut('slow',function(){
					$(this).html('');
					for( var i=0; i<_arrElem.length; i++ ){
						$('#owl-product_features').append(_arrElem[i][1]);
					}
					_arrElem.splice(0,_arrElem.length); //clear Array
					orderBy._number(_currNum,Number($('section.product_features div.filtering select#showBy').find(':selected').val()),$('#owl-product_features dl'));
				});
			}
		},
		_az : function(){
			_arrElemTmp = $('<div id="arrElem">');
			for(var i=0; i<_arrElem.length;i++){
				_arrElemTmp.append( _arrElem[i][1] );
			}
			_arrElem.splice(0,_arrElem.length); //clear Array
			_elemens = _arrElemTmp.find('dl');
			_elemens.each(function(){
				_arrElem.push( [$(this).find('dt a').html(),'<dl data-modified="'+$(this).attr('data-modified')+'">'+$(this).html()+'</dl>'] );
			});
			_arrElem.sort();
			if( _arrElem.length > 0 ){
				$('#owl-product_features').fadeOut('slow',function(){
					$(this).html('');
					for( var i=0; i<_arrElem.length; i++ ){
						$('#owl-product_features').append(_arrElem[i][1]);
					}
					_arrElem.splice(0,_arrElem.length); //clear Array
					orderBy._number(_currNum,Number($('section.product_features div.filtering select#showBy').find(':selected').val()),$('#owl-product_features dl'));
				});
			}
		},
		_za : function(){
			_arrElemTmp = $('<div id="arrElem">');
			for(var i=0; i<_arrElem.length;i++){
				_arrElemTmp.append( _arrElem[i][1] );
			}
			_arrElem.splice(0,_arrElem.length); //clear Array
			_elemens = _arrElemTmp.find('dl');
			_elemens.each(function(){
				_arrElem.push( [$(this).find('dt a').html(),'<dl data-modified="'+$(this).attr('data-modified')+'">'+$(this).html()+'</dl>'] );
			});
			_arrElem.sort().reverse();
			if( _arrElem.length > 0 ){
				$('#owl-product_features').fadeOut('slow',function(){
					$(this).html('');
					for( var i=0; i<_arrElem.length; i++ ){
						$('#owl-product_features').append(_arrElem[i][1]);
					}
					_arrElem.splice(0,_arrElem.length); //clear Array
					orderBy._number(_currNum,Number($('section.product_features div.filtering select#showBy').find(':selected').val()),$('#owl-product_features dl'));
				});
			}
		},
		_number : function(_n,_qnt,_e){
			_elemens = _e;
			//_arrElem = [];
			if(!Number(_arrElem.length)) { //if value = 0;
				_elemens.each(function(){
					_arrElem.push( ['<dl data-modified="'+$(this).attr('data-modified')+'">'+$(this).html()+'</dl>',$(this)] );
				});
			}
			if( _arrElem.length > 0 ){
				$('#owl-product_features').fadeOut('slow',function(){
					$(this).html('');
					for( var i=(_qnt*(_n-1)); i<(_qnt*_n); i++ ){
						if(_arrElem[i]==undefined) break;
						$('#owl-product_features').append(_arrElem[i][0]);
					}
					$(this).fadeIn('fast',function(){
						if(_fnum!=0){
							$('html, body').animate({
								scrollTop: $("main.main_products > aside > section.product_features div.filtering").offset().top
							}, 500);
						}
						_fnum=1;
					});


					checkout();
				});
			}
			_currNum = Number(_n);
		}
	};
	$('#orderBy').change(function(){
		var _v = $(this).val();
		switch(_v){
			case '1':
				orderBy._az();
			break;
			case '2':
				orderBy._za();
			break;
			case '3':
				orderBy._recents();
			break;
			case '4':
				orderBy._olders();
			break;
		}
	});
	var paging = function(elemTo,elemCount,elemSuffle){
		var _pagingContainer = $('<div class="paging">');
		var _links = '<a class="pag-first" href="javascript:void(0);" title="Primeiro"><i class="fa fa-angle-double-left"></i></a>' + 
					'<a class="pag-prev" href="javascript:void(0);" title="Anterior"><i class="fa fa-angle-left"></i></a>' +
					'<a class="pag-next" href="javascript:void(0);" title="Próximo"><i class="fa fa-angle-right"></i></a>' +
					'<a class="pag-last" href="javascript:void(0);" title="Último"><i class="fa fa-angle-double-right"></i></a>';
		var _ul = $('<ul>');
		var _totalItens = elemCount.length;							//13
		var _orderNum = Number(elemSuffle.find(':selected').val()); //0,6,12,18,24,30...
		//Remove options higher than _totalItens
		elemSuffle.find('option').each(function(){
			if( Number($(this).val()) >= _totalItens ) $(this).remove();
		});
		//remove Show by and Order By when there are less products
		if( elemSuffle.find('option').length === 1 ) { elemSuffle.closest('dl').remove(); _orderNum = 0; }
		
		elemSuffle.unbind('change').change(function(){
			_orderNum = $(this).val();
			_pagingContainer.remove();
			paging( elemTo, elemCount, elemSuffle );
		})
		//if value = 0;
		if(!_orderNum){
			_orderNum = _totalItens;
			_pagingContainer.hide();
			//return;
		}
		var _totalPages = Math.ceil(_totalItens/_orderNum);
		for(var i=1; i<=_totalPages;i++){
			_ul.append('<li><a href="javascript:void(0);" title="'+i+'">'+i+'</a></li>');
		}
		_pagingContainer.append(_links);
		_ul.insertAfter(_pagingContainer.find('.pag-prev'));
		_ul.find('a').click(function(){
			if($(this).hasClass('active')) return;
			$(this).closest('ul').find('a').removeClass('active');
			$(this).addClass('active');
			orderBy._number($(this).html(),_orderNum,elemCount);
		});
		_pagingContainer.find(">a").click(function(){
			var _v = $(this).attr('class')
			switch(_v){
				case 'pag-first':
					if(_ul.find('a').eq(0).hasClass('active')) return;
					_ul.find('a').removeClass('active');
					_ul.find('a').eq(0).addClass('active');
					orderBy._number(1,_orderNum,elemCount);
				break;
				case 'pag-prev':
					if(_ul.find('a').eq(0).hasClass('active')) return;
					orderBy._number(eval(_currNum-1),_orderNum,elemCount);
					_ul.find('a').removeClass('active');
					_ul.find('a').eq(eval(_currNum-1)).addClass('active');
				break;
				case 'pag-next':
					if(_ul.find('a').eq(_totalPages-1).hasClass('active')) return;
					orderBy._number(eval(_currNum+1),_orderNum,elemCount);
					_ul.find('a').removeClass('active');
					_ul.find('a').eq(eval(_currNum-1)).addClass('active');
				break;
				case 'pag-last':
					if(_ul.find('a').eq(_totalPages-1).hasClass('active')) return;
					_ul.find('a').removeClass('active');
					_ul.find('a').eq(_totalPages-1).addClass('active');
					orderBy._number(_totalPages,_orderNum,elemCount);
				break;
			}

		});
		_pagingContainer.insertAfter(elemTo);
		_ul.find('li:first a').click();
	};
	paging( $('#owl-product_features'), $('#owl-product_features dl'), $('section.product_features div.filtering select#showBy') ); //1-Element to Insert the Paging | 2-Elements to suffle | 3-Element that set the range of elements to Show

	/* Menu Mobile */
	$('nav a.fa-list-ul, main.main_products > nav > a').click(function(){
		console.log($(this).hasClass('active'));
		if( $(this).hasClass('active') ){
			$(this).toggleClass('active').parent().toggleClass('hide');
			return;
		}
		$('nav a.fa-list-ul, main.main_products > nav > a').removeClass('active');
		$('body > nav, main.main_products > nav').addClass('hide');
		$(this).toggleClass('active').parent().toggleClass('hide');
	});

	/* Form Orçamento */
	var form = jQuery('form#budget');
  //Apply MASK to ...
  form.find("input[name=phone]").mask("(99)9999-9999");
  form.find("input[name=cellphone]").mask("(99)99999-9999");

  //Close <p> Message
  var hideMessage = function(f,t){
		setTimeout( function(){f.find('p.msg').fadeOut('slow');}, t );
  }
	var _input, _select, _s_id, _s_title;
  var setFields = function (){	  	
		_input = $('body.chn-budget main form fieldset ul li.spinner input'),
		_select = $('body.chn-budget main form fieldset ul li select#slc_product'), 
		_s_id = _select.find(':selected').val(),
		_s_title = _select.find(':selected').text();

		if(_select.length==0){
			_select = form.find("input[name=product_name]"),
			_s_title = _select.val(),
			_s_id = form.find("input[name=product_id]").val();
		}
  }
	setFields();

	var _range = [0,50];
  form.validate({
    rules:{
			name: { required: true, minlength:5 },
			email: { required: true, email:true }
    },
  	messages : {
      name:{
        required: "Ajude-nos a te indentificar. Por favor, digite o seu <strong>Nome</strong>.",
        minlength: "Muito bom! Digite seu <strong>Nome</strong> e <strong>Sobrenome</strong> caso seja curto."
      },
      email:{
        required: "Precisamos te responder. Por favor, digite seu <strong>E-mail</strong> corretamente.",
        email: "Continue! Parece que este <strong>E-mail</strong> ainda é inválido."
      }
    },
    showErrors: function(errorMap, errorList) {
      if(errorList.length) {
          form.find('p.msg').html(errorList[0]['message']).fadeIn('slow');
					hideMessage(form,2500);
      }else{
          form.prev('p.msg').html('').fadeOut('fast');
      }
		},
		debug: true,
		success: "valid",
		submitHandler: function(e) { 
			setFields();
			//Extra Validate
			if( _s_id == 0 && form.find("textarea[name=message]").val() == '' ){
				form.find('p.msg').html('Por favor, você precisa definir ao menos um <strong>Produto</strong> ou,<br>se preferir falar sobre, utilize o campo <strong>Mensagem</strong>.').fadeIn('slow');
				hideMessage(form,5000);
				return;
			}
			//---
			form.find('input.btn-color-A').val('enviando orçamento...').attr('disabled', 'disabled');
			var product_id = _s_id, 
					product_name = _s_title,
					product_quant = _input,
					name = form.find("input[name=name]"),
					email = form.find("input[name=email]"),
					phone = form.find("input[name=phone]"),
					cellphone = form.find("input[name=cellphone]"),
					message = form.find("textarea[name=message]");
					//Disabling
					_select.attr('disabled', 'disabled'), name.attr('disabled', 'disabled'), email.attr('disabled', 'disabled'), phone.attr('disabled', 'disabled'), cellphone.attr('disabled', 'disabled'), message.attr('disabled', 'disabled');

			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'ref=facaOrcamento&name='+ name.val() + '&email='+ email.val() + '&phone='+ phone.val() + '&cellphone='+ cellphone.val() + '&message='+ message.val() + '&product_id='+ product_id + '&product_name='+ product_name + '&product_quant='+ product_quant.val();
			//console.log(dataString);
			$.ajax({
				url : 'enviarEmail.php',
				type: "POST",
				data : dataString,
				success:function(data, textStatus, jqXHR){
					console.log(data);
					if(data != '0'){
						form.find('fieldset > ul').fadeOut('slow', function(){
							form.find('p.msg').html('<strong>Formulário enviado com sucesso!</strong><br />A Equipe da Spatula agradece seu interesse.<br>Em breve retornaremos contato pelo e-mail informado: <em>'+email.val()+'</em>').fadeIn('slow');
							$(this).remove();
						});
					}else{
						form.find('fieldset > ul').fadeOut('slow', function(){
							form.find('p.msg').html('<strong>Formulário não enviado!</strong><br />Acontenceu algo errado durante o processamento. Tente novamente por favor.').fadeIn('slow');
							$(this).remove();
						});
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					console.log('Error '+jqXHR);
					form.find('fieldset > ul').fadeOut('slow', function(){
						form.find('p.msg').html('<strong>Formulário não enviado!</strong><br />Tente novamente mais tarde por favor.').fadeIn('slow');
						$(this).remove();
					});
				}
	    });
		}
	});

	/* Form Cadastre-se */
  //Close Lighbox Message
	var msgBox = $('body .msgBox');
  var hideBoxMessage = function(t){
		setTimeout( function(){
			msgBox.prev('p.msg > span').html('')
      msgBox.fadeOut('fast');
		}, t );
  }
	var formCad = jQuery('form#signin');
  formCad.find("input[name=phone]").mask("(99)9999-9999");
  formCad.find("input[name=cellphone]").mask("(99)99999-9999");
  formCad.find("input[name=cpf]").mask("999.999.999-99");
  formCad.find("input[name=postal_code]").mask("99999-999");

	formCad.validate({
    rules:{
			name: { required: true, minlength:5 },
			email: { required: true, email:true },
			login: { required: true, minlength:5 },
   		usr_password: { required: true, minlength: 5},
   		usr_confirm_password: {	required: true,	minlength: 5, equalTo: "#usr_password"},
			cellphone: { required: true },
			cpf: { required: true, minlength:11, cpf:true },
			address: { required: true, minlength:2 },
			number: { required: true, number:true },
			neightborhood: { required: true },
			postal_code: { required: true, minlength:9, cep:true },
			state: { required: true },
			city: { required: true }
    },
  	messages : {
      name:{
        required: "Ajude-nos a te indentificar.<br>Por favor, digite o seu <strong>Nome</strong>.",
        minlength: "Hmmmm, vamos digitar seu <strong>Sobrenome</strong> também já que o <strong>Nome</strong> parece ser curto."
      },
      email:{
        required: "Precisaremos nos comunicar por e-mail.<br>Por favor, digite seu <strong>E-mail</strong> corretamente.",
        email: "Continue! Parece que este <strong>E-mail</strong> ainda é inválido."
      },
      login:{
        required: "Você precisará entrar no site com um usuário.<br>Por favor, digite seu <strong>Login de Usuário</strong>.",
        minlength: "Continue! Parece que este <strong>Login/Usuário</strong> ainda é curto."
      },
      usr_password:{
        required: "Você precisará entrar no site com uma senha.<br>Por favor, digite sua <strong>Senha</strong>.",
        minlength: "Continue! Parece que esta <strong>Senha</strong> ainda está curta."
      },
      usr_confirm_password:{
        required: "Você precisa confirmar a sua senha.<br>Por favor, digite-a novamente no campo <strong>Confirmar Senha</strong>.",
        equalTo: "Poxa, os dados não coincidem.<br>Digite a mesma senha nos campos <strong>Senha</strong> e <strong>Confirmar Senha</strong> por favor."
      },
      cellphone:{
        required: "É importante cadastrar ao menos um número de <strong>Celular</strong> para completar seu cadastro.<br>Por favor, informe-o."
      },
      cpf:{
        required: "Precisaremos do seu <strong>CPF</strong> para realizar compras no site.<br>Por favor, informe o seu <strong>CPF</strong>.",
        minlength: "Estranho, parece que falta algum caractere ainda.",
        cpf: "Poxa, esses dados não parecem ser de um <strong>CPF</strong> válido.<br>Por favor, informe-os novamente."
      },
      address:{
        required: "Precisaremos do seu <strong>Endereço</strong> para entregar suas futuras compras no site.<br>Por favor, informe-o."
      },
      number:{
        required: "Seu endereço está sem <strong>Número</strong>.<br>Por favor, informe-o.",
        number: "Então, esse campo só permite <strong>Números</strong>.<br>Por favor, informe-os novamente."
      },
      neightborhood:{
        required: "Precisaremos do seu <strong>Bairro</strong> para completar seu endereço.<br>Por favor, informe-o."
      },
			postal_code:{
        required: "Precisaremos do seu <strong>CEP</strong> para completar seu <strong>Endereço</strong>.<br>Por favor, informe-o."
      },
			state:{
        required: "Precisaremos que defina o <strong>Estado</strong> para completar seu endereço.<br>Por favor, informe-o."
      },
			city:{
        required: "Precisaremos que defina a <strong>Cidade</strong> para completar seu endereço.<br>Por favor, informe-a."
      }
    },
    showErrors: function(errorMap, errorList) {
    	if(errorList.length == 0 ){
    		formCad.find('p.msg').html('').fadeOut('fast');
    		formCad.find('.error').removeClass('error');
    	}
      if(formCad.length) {
        if(errorList.length > 0 ){
		    	errorList[0].element.className = "error";
		    	//errorList[0].element.placeholder = errorList[0]['message'].replace('<br>',' ').replace('<strong>','').replace('</strong>','');
        	formCad.find('p.msg').html(errorList[0]['message']).fadeIn('fast');
        }else{
					formCad.find('.error').removeClass('error');
        }
      }else{
        formCad.find('p.msg').html('').fadeOut('fast');
    		formCad.find('.error').removeClass('error');
      }
		},
		debug: true,
		success: "valid",
		submitHandler: function(e) { 
			//---
			var name = formCad.find("input[name=name]"),
					email = formCad.find("input[name=email]"),
					login = formCad.find("input[name=login]"),
					usr_password = formCad.find("input[name=usr_password]"),
					
					phone = formCad.find("input[name=phone]"),
					cellphone = formCad.find("input[name=cellphone]"),
					cpf = formCad.find("input[name=cpf]"),

					address = formCad.find("input[name=address]"),
					number = formCad.find("input[name=number]"),
					complement = formCad.find("input[name=complement]"),
					neightborhood = formCad.find("input[name=neightborhood]"),
					postal_code = formCad.find("input[name=postal_code]"),
					state = formCad.find("select[name=state]").find(':selected'),
					city = formCad.find("select[name=city]").find(':selected');
			
			var ref = formCad.find("input[name=id_user]");
					if(ref.val() != 0 && ref.val() != ''){
						id = ref.val();
						ref = 'atualizaCadastro';
						formCad.find('input.btn-color-C').val('atualizando cadastro...').attr('disabled', 'disabled');
					}else{
						id = '';
						ref = 'cadastreSe';
						formCad.find('input.btn-color-C').val('enviando cadastro...').attr('disabled', 'disabled');
					}

					//Disabling
					name.attr('disabled', 'disabled'), email.attr('disabled', 'disabled'), login.attr('disabled', 'disabled'), usr_password.attr('disabled', 'disabled'),
					phone.attr('disabled', 'disabled'), cellphone.attr('disabled', 'disabled'), cpf.attr('disabled', 'disabled'), 
					address.attr('disabled', 'disabled'), number.attr('disabled', 'disabled'), complement.attr('disabled', 'disabled'), neightborhood.attr('disabled', 'disabled'),
					postal_code.attr('disabled', 'disabled'), state.attr('disabled', 'disabled'), city.attr('disabled', 'disabled');

			// Returns successful data submission message when the entered information is stored in database.
			var dataString = 'ref='+ref+'&id='+ id +'&name='+ name.val() + '&email='+ email.val() + '&login='+ login.val() + '&usr_password='+ usr_password.val() + '&phone='+ phone.val() + '&cellphone='+ cellphone.val() + '&cpf='+ cpf.val() + '&address='+ address.val() + '&number='+ number.val() + '&complement='+ complement.val() + '&neightborhood='+ neightborhood.val() + '&postal_code='+ postal_code.val() + '&state='+ state.val() + '&city='+ city.val();
			$.ajax({
				url : 'signin_action.php',
				type: "POST",
				data : dataString,
				success:function(data, textStatus, jqXHR){
					console.log(data);
					if(data == 3){
						formCad.find('fieldset > ul, fieldset > h3, fieldset > br').fadeOut('slow', function(){
							formCad.find('p.msg').html('<strong>E-mail já cadastrado!</strong><br />O e-mail <em>'+ email.val() +'</em> já está sendo utilizado por algum usuário. Tente outro por favor.').fadeIn('slow');
							$(this).remove();
						}).closest('article').find('>p').fadeOut('slow');
					}
					if(data == 22){
						formCad.find('fieldset > ul, fieldset > h3, fieldset > br').fadeOut('slow', function(){
							formCad.find('p.msg').html('<strong>Cadastro realizado com sucesso!</strong><br /><em>'+ name.val() +'</em>, a equipe da Spatula agradece seu interesse.<br>Você receberá no email (<strong>'+email.val()+'</strong>) um link para a <strong>Confirmação de Cadastro</strong>.').fadeIn('slow');
							$(this).remove();
						}).closest('article').find('>p').fadeOut('slow');
					}
					if(data == 2){
						formCad.find('fieldset > ul, fieldset > h3, fieldset > br').fadeOut('slow', function(){
							formCad.find('p.msg').html('<strong>Cadastro atualizado com sucesso!</strong><br /><em>'+ name.val() +'</em>, a equipe da Spatula agradece seu interesse em manter os dados atualizados.').fadeIn('slow');
							$(this).remove();
						}).closest('article').find('>p').fadeOut('slow');
					}
					if(data == 0){
						formCad.find('fieldset > ul, fieldset > h3, fieldset > br').fadeOut('slow', function(){
							formCad.find('p.msg').html('<strong>Formulário não enviado!</strong><br />Acontenceu algo errado durante o processamento. Tente novamente por favor.').fadeIn('slow');
							$(this).remove();
						}).closest('article').find('>p').fadeOut('slow');
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					//console.log('Error '+jqXHR);
					formCad.find('fieldset > ul, fieldset > h3, fieldset > br').fadeOut('slow', function(){
						formCad.find('p.msg').html('<strong>Formulário não enviado!</strong><br />Tente novamente mais tarde por favor.').fadeIn('slow');
						$(this).remove();
					}).closest('article').find('>p').fadeOut('slow');;
				}
	    });
		}
	});
	
	function addRemove(){
		$('body.chn-budget main form fieldset a, body.chn-checkout main form fieldset a').unbind('click').click(function(){
			_s = function() {
	 			if( checkOutForm.length ){
	 				return '1';
	 			}
	 			else{
	 				return _s_id;
	 			}
			}
			_s();
			( checkOutForm.length ) ? _input = $(this).parent().prev() : setFields();
			if(_s() != 0){
				if( $(this).hasClass('s-up') ){
					if( Number(_input.val()) < _range[1] ){
					_input.val( eval(Number(_input.val()) + 1) );}
				}else{
					if(_input.val()==1){
						checkOutForm.find('p.msg').html('A quantidade de itens por produto não pode ser inferior a <strong>1 unidade</strong>.<br>Utilize o botão de <strong>excluir</strong> se precisar.').fadeIn('slow');
						return;
					}
					if( Number(_input.val()) > _range[0] ){
						_input.val( eval(Number(_input.val()) - 1) );}
				}
			}else{
				form.find('p.msg').html('Por favor, você precisa definir o <strong>Produto</strong> antes.').fadeIn('slow');
				hideMessage(form,2500);
			}
		});
	}
	addRemove();
	/* Verify E-mail */
	formCad.find("input[name=email]").blur(function(){
		$.ajax({
			url : 'signin_action.php',
			type: "POST",
			data : 'ref=cadastreSe&email='+ $(this).val(),
			success:function(data, textStatus, jqXHR){
				formCad.find('p.msg').hide();
				formCad.find("input[name=email]").removeClass('error');
				console.log(data);
				if(data == 3){
					setTimeout(
					function(){
						formCad.find('p.msg').html('<strong>E-mail já cadastrado!</strong><br />O e-mail <em>'+  formCad.find("input[name=email]").val() +'</em> já está sendo utilizado por algum usuário. Tente outro por favor.').fadeIn('slow');
						formCad.find("input[name=email]").addClass('error').focus();
					},100);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log('Error '+jqXHR);
			}
    });
	});

	/* State/Cities */
	//Set States - Estados
	if( formCad.find('#state').length > 0 ){
		$.getJSON('estados_cidades.js',function(data){
			var options = '<option value="">Selecione...</option>';	
			var items = [];
			$.each( data, function( key, val ) {
			  items.push(val);
			});
			for (var i = 0; i < items[0].length; i++) {
				options += '<option value="' + items[0][i].sigla + '">' + items[0][i].nome + '</option>';
			}	
			$('#state').html(options).prop('disabled',false);
			
			//Set Cities - Cidades
			formCad.find('#state').change(function(){
				if( $(this).val() != 0 ) {
					formCad.find('#city').html('<option value="">...carregando cidades</option>').prop('disabled',false);
					var _sigla = $(this).val();
					$.getJSON('estados_cidades.js',function(data){
						var options = '<option value="">Selecione...</option>';	
						var items = [];
						$.each( data, function( key, val ) {
						  items.push(val);
						});
		  			for (var i = 0; i < items[0].length; i++) {
							if( items[0][i].sigla == _sigla ){
								for (var c = 0; c < items[0][i].cidades.length; c++) {
									options += '<option value="' + items[0][i].cidades[c] + '">' + items[0][i].cidades[c] + '</option>';
								}
							}
						}	
						$('#city').html(options).prop('disabled',false);
					});
				}else{
					formCad.find('#city').html('<option value=""><< - escolha primeiro um estado</option>').prop('disabled',true);
				}
			});

			//ON UPDATE FORM
			if( formCad.find('#h_state').val() != '' ){
				formCad.find('select#state').find('option').each(function(i){
					if( $(this).val() === formCad.find('#h_state').val() ){
						$(this).prop('selected',true).change();
						var _t = setInterval(function(){
							formCad.find('select#city').find('option').each(function(i){
								if( $(this).val() === formCad.find('#h_city').val() ){
									$(this).prop('selected',true);
									clearInterval(_t);
								}
							});
						},100);
					}
				});
			}
		});
	}

	/* Login Box */
	$('header aside ul li a.btn-login, form#checkout table tfoot tr td input.login').click(function(){
		var lForn = $('header aside form#login-form');
				lForn.fadeIn('fast',function(){
					$('header aside form#login-form fieldset a.fa-close').click(function(){
						lForn.fadeOut('fast');
					});
					$('header aside form#login-form fieldset a.fa-frown-o').click(function(){
						$('header aside form#login-form fieldset label, header aside form#login-form fieldset input, header aside form#login-form fieldset button.acao').hide().parent().find('.forget, .send').css('display','block');
						$(this).hide();
					});
				});
	});

	//Error on Login
	var _request = window.location.href;
	msgBox.find('a.btn-default.btn-color-C').click(function(){
		msgBox.fadeOut('fast');
	});


	//Checkout
	var checkOutForm = $('form#checkout'), itens, _image_preview, arrItens = [];
	function checkout(){
		checkOutForm = $('form#checkout'), itens = $('header aside ul li.block.f-right.notlogged a.fa-shopping-cart em');

		$('ul.size li, ul.color li').each(function(){
			$(this).unbind('click').click(function(e){
				$(this).parent().find('li').removeClass('active');
				$(this).addClass('active');
			});
		});

		//Add products on Clicks
		$('.btn-buy.btn-color-E, .btn-default.btn-color-E').unbind('click').click(function(e){
			e.preventDefault();
			_tmlTitle = '';
			if( !$('ul.size li').hasClass('active') ){
				$('.product').fadeIn('slow',function(){
	      			$('html,body').click(function(){
						$('.product').fadeOut('fast',function(){ $('html,body').unbind('click'); });
					})
	        	}).find('p strong').html('Atenção').parent().find('> span').html('<b>Você deve selecionar o tamanho!</b><br>A quantidade deste item você define no <b>Carrinho de Compras</b>.<br><a class="btn-default btn-color-E" style="text-align:center" href="javascript:void(0);">OK</a>');
				return;
			}else{
				_tmlTitle = $('main.main_products > aside > div input[name=title]').val() + ' - Tamanho '+ $('ul.size li.active').text();
			}		
			
			if( !$('ul.color li').hasClass('active') ){
				$('.product').fadeIn('slow',function(){
	      			$('html,body').click(function(){
						$('.product').fadeOut('fast',function(){ $('html,body').unbind('click'); });
					})
	        	}).find('p strong').html('Atenção').parent().find('> span').html('<b>Você deve selecionar a cor!</b>.<br><a class="btn-default btn-color-E" style="text-align:center" href="javascript:void(0);">OK</a>');
				return;
			}else{
				_tmlTitle += ' - Cor '+ $('ul.color li.active').text();
			}		
			$('main.main_products > aside > div input[name=title]').val(_tmlTitle);
			itens.html( eval(itens.html())+1 );
			arrItens.push( $(this).attr('href').split('&') );
			if( $(this).hasClass('btn-buy') ){
				//console.log($(this).closest('dl').find('dd img').attr('src'));
				arrItens[arrItens.length-1].push( $(this).closest('dl').find('dt').attr('id'), $(this).closest('dl').find('dt a').text(), $(this).closest('dl').find('dd span.resume').text(), $(this).closest('dl').find('dd img').attr('src'), 1);
			}else{
				arrItens[arrItens.length-1].push( $('main.main_products > aside > div input[name=id]').val(), $('main.main_products > aside > div input[name=title]').val(), $('main.main_products > aside > div input[name=resume]').val(), $('main.main_products > aside > div input[name=capa]').val(), 1);
				$(this).closest('.shopping_info').addClass('added');
				$(this).remove();
			}

			$.cookie("itens", JSON.stringify(arrItens), { path: '/', expires: 1 });
			$(this).closest('dl').addClass('added');
		});
		
		if($.cookie("itens")){
			var data = JSON.parse($.cookie("itens"));
			if( data!=undefined ){
				arrItens = data;
				itens.html(data.length);
				checkOutForm.find('table tbody').html('');
				for(var x=0; x<data.length; x=x+1){
					/*********  Itens Adicionados recebem uma classe  ***************/
					//console.log(data[x][0]);
					$('main.main_products section.product_features #owl-product_features dl').each(function(){
						//console.log( $(this).find('dt').attr('id')+" === "+data[x][3] );
						if($(this).find('dt').attr('id')===data[x][4]){
							$(this).addClass('added');
						}
					});
					$('main section.highlights dl').each(function(){
						
						if($(this).find('dt').attr('id')===data[x][4]){
							//console.log( $(this).find('dt').attr('id')+" === "+data[x][3] );
							$(this).addClass('added');
							$(this).remove();
						}
					});
					$('main section.features dl').each(function(){
						//console.log( $(this).find('dt').attr('id')+" === "+data[x][3] );
						if($(this).find('dt').attr('id')===data[x][4]){
							//$(this).find('dl').addClass('added');
							$(this).remove();
						}
					});
					if( $('main.main_products aside div input[name=id]').val() === data[x][4] ){
						$('main.main_products > aside > div > .shopping_info').addClass('added');
						$('main.main_products > aside > div > .shopping_info a.btn-default.btn-color-E').remove();
					}
					if(checkOutForm.length){
						var _tr = '<tr>';
							_tr += '	<input name="min_price" type="hidden" value="'+data[x][2].substring(data[x][2].indexOf('=')+1).replace(',','.')+'" />';
							_tr += '	<input name="max_price" type="hidden" value="'+data[x][2].substring(data[x][2].indexOf('=')+1).replace(',','.')+'" />';
							_tr += '	<input id="itemWeight'+x+'" name="itemWeight'+x+'" type="hidden" value="'+data[x][3].substring(data[x][3].indexOf('=')+1)+'">';
							_tr += '	<input name="weight" type="hidden" value="'+data[x][3].substring(data[x][3].indexOf('=')+1)+'" />';
							_tr += '	<td class="center">'+data[x][4]+' <input id="itemId'+x+'" name="itemId'+x+'" type="hidden" value="'+data[x][4]+'"></td>';
							_tr += '	<td>';
							_tr += '		<img src="'+data[x][7]+'" width="100" alt="">';
							_tr += '		<p>'+data[x][5]+'<br><span>Peso: '+data[x][3].substring(data[x][3].indexOf('=')+1)+'gr</span><input id="itemDescription'+x+'" name="itemDescription'+x+'" type="hidden" value="'+data[x][5]+'"></p>';
							_tr += '	</td>';
							_tr += '	<td>';
							_tr += '		<input id="itemQuantity'+x+'" name="itemQuantity'+x+'" type="text" value="'+data[x][8]+'">';
							_tr += '		<span>';
							_tr += '			<a href="javascript:void(0);" class="s-up" title="Clique para aumentar o valor">+</a>';
							_tr += '			<a href="javascript:void(0);" class="s-down" title="Clique para diminuir o valor">-</a>';
							_tr += '		</span>';
							_tr += '	</td>';

							_tr += '	<td class="center">R$<i>'+(( data[x][8] > 1 ) ? data[x][2].substring(data[x][2].indexOf('=')+1) : data[x][2].substring(data[x][2].indexOf('=')+1))+'</i> <input id="itemAmount'+x+'" name="itemAmount'+x+'" type="hidden" value="'+(( data[x][8] > 1 ) ? data[x][2].substring(data[x][2].indexOf('=')+1).replace(',','.') : data[x][2].substring(data[x][2].indexOf('=')+1).replace(',','.'))+'"></td>';
							_tr += '	<td><a class="btn-color-E" href="javascript:void(0);" title="Excluir produto da lista"><i class="fa fa-close"></i></a></td>';
							_tr += '</tr>';
						checkOutForm.find('table tbody').prepend(_tr);
					}
					
					setTimeout(function(){ setOwls(); },500);
						
					//main.main_products section.product_features #owl-product_features
				}
				addRemove();
				setTimeout(function(){
					$('form#checkout table tbody tr td > a').click(function(){
						for(var x=0; x<arrItens.length; x=x+1){
							if(arrItens[x][4]===$(this).closest('tr').find('td input[name^="itemId"]').val()){
								arrItens.splice(x,1);
								$.cookie("itens", JSON.stringify(arrItens), { path: '/', expires: 1 });
								break;
							}
						}
						itens.html( eval(itens.html())-1 );
						$(this).closest('tr').remove();
						calc(null);
					});
					
					//INIT Calculate
					var pattern = /^[0-9]{1,10}$/;
					var calc = function(i_val){
				    if(i_val>0){
					    if(!pattern.test(Number(i_val.val()))){
					    	i_val.val('1');
						    checkOutForm.find('p.msg').html('A quantidade deve ser apenas <strong>número</strong>.<br>Utilize o botão de <strong>+</strong> ou <strong>-</strong> para facilitar.').fadeIn('slow');
						    return;
					    }
				    }
						var _t_itens = 0, _t_prices = 0, _t_weights = 0;
						$('form#checkout table tbody tr').each(function(){
							_iQnt = $(this).find('input[name^="itemQuantity"]').val();
							_iAmt = $(this).find('input[name^="itemAmount"]').val();
							_iWgt = $(this).find('input[name^="itemWeight"]').val();
							_t_itens = ( _t_itens+Number( _iQnt ) );
							_t_prices = _t_prices+( Number(_iQnt)*Number(_iAmt));
							_t_weights = _t_weights+( Number(_iQnt)*Number(_iWgt));
							console.log( _t_prices );
						});

						$('form#checkout table tfoot tr.total td > i').html(_t_prices.toFixed(2).replace('.',','));
						$('form#checkout table tfoot tr.weight td > i').html(_t_weights.toFixed(2));
					}
					//END Calculate

					$('body.chn-budget main form fieldset a, body.chn-checkout main form fieldset span a').click(function(){
						_tr = $(this).closest('tr');
						_min = _tr.find('input[name=min_price]').val();
						_max = _tr.find('input[name=max_price]').val();
						_pricelabel = _tr.find('td > i');
						_amount = _tr.find('td > i').next('input');
						_i = $(this).parent().prev().val();
						//console.log(arrItens);
						for(var x=0; x<arrItens.length; x=x+1){
							if(arrItens[x][4]===$(this).closest('tr').find('td input[name^="itemId"]').val()){
								arrItens[x].splice(8,1,$(this).closest('tr').find('td input[name^="itemQuantity"]').val());
								$.cookie("itens", JSON.stringify(arrItens), { path: '/', expires: 1 });
								break;
							}
						}
						/*if(_i < 2){
							if(!_max)return;
						*/
							_pricelabel.html(_max.replace('.',','));
							_amount.val(_max);
						/*}else{
							_pricelabel.html(_min.replace('.',','));
							_amount.val(_min);
						}*/
						calc(_amount);
					});
					$('form#checkout table tbody tr td input[name^="itemQuantity"]').keyup(function(){
						calc($(this));
					});
					calc(null);
				},500);
				// --- Function to preview image after validation
				$(function() {
					$("body.chn-checkout main.main_content > aside form#checkout fieldset input[type=file]").change(function() {
						_image_preview = $("body.chn-checkout main.main_content > aside form#checkout fieldset div#image_preview");
						_image_preview.find("#message").empty(); // To remove the previous error message
						var file = this.files[0];
						var imagefile = file.type;
						var match= ["image/jpeg","image/png","image/jpg"];
						if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
							_image_preview.find('#previewing').attr('src','images/noimage.png');
							_image_preview.find("#message").html("Por favor, envie-nos um arquivo em JPG, JPEG ou PNG de até 300kb.");
							return false;
						}else{
							var reader = new FileReader();
							reader.onload = imageIsLoaded;
							reader.readAsDataURL(this.files[0]);
						}
					});
				});
				function imageIsLoaded(e) {
					$("body.chn-checkout main.main_content > aside form#checkout fieldset input[type=file]").css("color","green");
					_image_preview.css("display", "block");
					_image_preview.find('#previewing').attr('src', e.target.result);
				};
				// Function to preview image after validation --- 
			}else{
				console.log('Nada a trazer');
			}
		}else{
			$('body.chn-checkout main.main_content > aside form#checkout fieldset input[type=file]').prop('disabled','disabled');
			setOwls();
		}
		onSubmit();
	}
	checkout();
	function onSubmit(){
		checkOutForm.submit(function(e){
			_t=this;
			$('form#checkout table tfoot tr td input').prop('disabled','disabled');
			e.preventDefault();
			var itens = 0,
				user_id = $("body.chn-checkout input[name=user_id]"),
				file = $("body.chn-checkout input[type=file]"),
				no_image = $("body.chn-checkout input[name=no_image]"),
				currency = $("body.chn-checkout input[name=currency]"),
				reference = $("body.chn-checkout input[name=reference]"),
				senderName = $("body.chn-checkout input[name=senderName]"),
				senderAreaCode = $("body.chn-checkout input[name=senderAreaCode]"),
				senderPhone = $("body.chn-checkout input[name=senderPhone]"),
				senderEmail = $("body.chn-checkout input[name=senderEmail]"),
				shippingType = $("body.chn-checkout input[name=shippingType]"),
				shippingAddressStreet = $("body.chn-checkout input[name=shippingAddressStreet]"),
				shippingAddressNumber = $("body.chn-checkout input[name=shippingAddressNumber]"),
				shippingAddressDistrict = $("body.chn-checkout input[name=shippingAddressDistrict]"),
				shippingAddressComplement = $("body.chn-checkout input[name=shippingAddressComplement]"),
				shippingAddressPostalCode = $("body.chn-checkout input[name=shippingAddressPostalCode]"),
				shippingAddressCity = $("body.chn-checkout input[name=shippingAddressCity]"),
				shippingAddressState = $("body.chn-checkout input[name=shippingAddressState]"),
				shippingAddressCountry = $("body.chn-checkout input[name=shippingAddressCountry]");
			
				$("body.chn-checkout input[name=transReference]").val(reference.val());
				$("body.chn-checkout input[name=transUserName]").val(senderName.val());

			var dataString = 'reference='+reference.val() + '&file='+ file.val() + '&coin_currency='+ currency.val() + '&senderName='+ senderName.val() + '&senderAreaCode='+ senderAreaCode.val() +  '&senderPhone='+ senderPhone.val() +  '&senderEmail='+ senderEmail.val() +  '&shippingType='+ shippingType.val() +  '&shippingAddressStreet='+ shippingAddressStreet.val() +  '&shippingAddressNumber='+ shippingAddressNumber.val() +  '&shippingAddressDistrict='+ shippingAddressDistrict.val() +  '&shippingAddressComplement='+ shippingAddressComplement.val() +  '&shippingAddressPostalCode='+ shippingAddressPostalCode.val() +  '&shippingAddressCity='+ shippingAddressCity.val() +  '&shippingAddressState='+ shippingAddressState.val() +  '&shippingAddressCountry='+ shippingAddressCountry.val();
			
			/*Obrigando enviar imagem de Logo*/
			if( file.val().length == 0 && !no_image.is(':checked')){
          //$('form#checkout p.msg').html('Por favor, envie-nos um arquivo em JPG, JPEG ou PNG de até 300kb.').fadeIn('slow');
          $('.checkout').fadeIn('slow',function(){
        		$('html,body').click(function(){
							$('.checkout').fadeOut('fast');
						})
          }).find('p strong').html('Atenção').parent().find('> span').html('Você precisa nos enviar um arquivo em JPG, JPEG ou PNG de até 300kb.<br><br> Caso não, utilize a opção <b>Não tenho imagem para enviar</b>.<br><a style="text-align:center;" class="btn-default btn-color-C" href="javascript:void(0);">Fechar</a>');
					
					hideMessage($('form#checkout'),5000);
					
					$('form#checkout table tfoot tr td input').removeAttr('disabled');
				return;
			}

			$('form#checkout table tbody tr').each(function(index){
				dataString+="&itemId"+(index+1)+"="+$(this).find('input[name^="itemId"]').val();
				dataString+="&itemDescription"+(index+1)+"="+$(this).find('input[name^="itemDescription"]').val();
				dataString+="&itemAmount"+(index+1)+"="+$(this).find('input[name^="itemAmount"]').val();
				dataString+="&itemQuantity"+(index+1)+"="+$(this).find('input[name^="itemQuantity"]').val();
				dataString+="&itemWeight"+(index+1)+"="+$(this).find('input[name^="itemWeight"]').val();
				itens+=1;
			});
			if(itens==1){
        $('.checkout').fadeIn('slow',function(){
      		$('html,body').click(function(){
						$('.checkout').fadeOut('fast');
					})
        }).find('p strong').html('Atenção').parent().find('> span').html('Seu carrinho de compras está vazio! Veja alguns de nossos presentes clicando no botão abaixo! <a style="text-align:center;" class="btn-default btn-color-C" href="produtos.php">Nossos Presentes</a>');
        return;
			}
			dataString+="&itens="+itens+"&id_user="+user_id.val();
			console.log(dataString);
			//return;
			$('form#checkout table tfoot tr td input[type=submit]').prop('disabled','disabled').val('...carregando PagSeguro... ');
			$('.checkout').fadeIn('slow').find('p strong').html('Aguarde... carregando PagSeguro');
			
			$.ajax({
				url : 'checkout_action.php',
				data : dataString,
				success:function(data, textStatus, jqXHR){
					
					$('.checkout').find('p strong').html('Processo de Pagamento').parent().find('> span').html('Você está no ambiente de pagamento do PagSeguro.');
					//CALL PAG SEGURO LIGHTBOX
					PagSeguroLightbox(
						{ 
							code: data 
						},
						{
							success : function(transactionCode) {	
							console.log("success - transactionCode: " + transactionCode);
							$('.checkout').find('p strong').html('Processo de Transação').parent().find('> span').html('O Código do seu pedido é:'+transactionCode);
							//SENT LOGO MARCA TO SERVER
							$.ajax({
								url: "ajax_php_file.php", // Url to which the request is send
								type: "POST",             // Type of request to be send, called as method
								data: new FormData(_t), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
								contentType: false,       // The content type used when sending data to the server.
								cache: false,             // To unable request pages to be cached
								processData:false,        // To send DOMDocument or non processed data file it is set to false
								success: function(data)   // A function to be called if request succeeds
								{
									if(data!='0'&&data!='1'&&data!='2'){
										$('.checkout').find('p strong').html('Finalizando Processo de Transação').parent().find('> span').html('Inserindo os dados do seu pedido no banco da Spatula para que você possa acompanhar no link <b>meus pedidos</b>.');
										//Insert the TRANSITION on USER ACCOUNT
										$.ajax({
											method : "GET",
											url : 'transaction_action.php?tcode='+transactionCode+'&logo_path='+data+'&id_user='+user_id.val(),
											success:function(trans_data, textStatus, jqXHR){
												console.log('trans_data: '+trans_data);
												$('.checkout').find('p strong').html('Processo de Transação Finalizado').parent().find('> span').html('Você será redirecionado para a tela de <b>meus pedidos</b>. Aguarde por favor.');
												$.removeCookie('itens', { path: '/' });
												location.href = 'transaction.php';
											},
											error: function(jqXHR, textStatus, errorThrown){ console.log(data); }
								    });

									}
								}
							});
							//location.href = 'transition_action.php?tcode='+_tcode+"&id_user="+user_id;
							//$.removeCookie('itens', { path: '/' });
						},
						abort : function() {
							console.log("abort");
							$('form#checkout table tfoot tr td input').prop('disabled',false);
							$('form#checkout table tfoot tr td input[type=submit]').prop('disabled',false).val('Finalizar e comprar com PagSeguro');
							$('.checkout').fadeOut('fast');
						}
					});
				},
				error: function(jqXHR, textStatus, errorThrown){
					console.log('Erro = ' + errorThrown);
					$('form#checkout table tfoot tr td input[type=submit]').prop('disabled','disabled').val('Finalizar e comprar com PagSeguro');
				}
	    });
		});
	}
	//Transition
	$('form#transaction table tbody tr td a').click(function(e){
		e.preventDefault();
		_t = $(this);
		_t.next('div').show().html('<p><em>...carregando...</em></p>');
		_tcode = _t.text();
	  console.log(_tcode);
		$.ajax({
	    url: 'transaction_action.php?tcode='+_tcode,
	    success: function (xml) {
	    	//xmlDoc = $.parseXML( xml ),
			  //$xml = $( xmlDoc );
	    	/*console.log($xml.find('reference').text());
	    	return;
			  
			 // $transaction = $xml.find('transaction');*/
			  $xml = $( xml );
			  console.log(xml);
	    	if( $xml.find('errors').length > 0 ){
	    		_t.next('div').show().html('Não consta produto com esse Código.');
	    	}else{
	    		_p =  '<p class="code">Código da Compra | <em>'+$xml.find('reference').text()+'</em></p>';
	    		//_p +=  '<p class="code">Data/Hora da Compra PagSeguro | <em>'+$xml.find('date').text()+'</em></p>';
	    		//_p +=  '<p class="code">Data/Hora da Compra PagSeguro | <em>'+(new Date($xml.find('date').text())).toUTCString()+'</em></p>';
	    		var d = new Date($xml.find('date').text());
	    		var datestring = ("0" + d.getDate()).slice(-2) + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + d.getFullYear() + " " + ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2)+ ":" + ("0" + d.getSeconds()).slice(-2);
	    		_p +=  '<p class="code">Data/Hora da Compra PagSeguro | <em>'+datestring+'</em></p>';
	    		
          switch($xml.find("paymentMethod type").text()) {
				    case '1':
          		_p +=  '<p class="code">Meio de Pagamento | <em>Cartão de Crédito em '+$xml.find('installmentCount').text()+'X</em></p>';
			        break;
				    case '2':
          		_p +=  '<p class="code">Meio de Pagamento | <em>Boleto</em></p>';
			        break;
				    case '3':
          		_p +=  '<p class="code">Meio de Pagamento | <em>Débito Online (TEF)</em></p>';
			        break;
				    case '7':
          		_p +=  '<p class="code">Meio de Pagamento | <em>Depósito em Conta</em></p>';
			        break;
				    default:
          		_p +=  '<p class="code">Meio de Pagamento | <em>---</em></p>';
			        break;
					}

	    		$xml.find('item').each(function(){
            var id = $(this).find("id").text(),
            desc = $(this).find("description").text(),
            quant = $(this).find("quantity").text();
            amnt = $(this).find("amount").text();
		    		_p += '<p>';
            _p += '<span class="prod">'+desc+'</span>';
            _p += '<span class="qnt">Qnt. '+quant+'</span>';
            _p += '<span class="value">R$'+amnt.replace('.',',')+'</span>';
		    		_p += '</p>';
        	});
	    		_p += '<p>';
          _p += '<span class="prod">Total de R$'+$xml.find("grossAmount").text().replace('.',',')+'</span>';
          switch($xml.find("status").text()) {
				    case '1':
          		_p += '<span class="status stt_1"><em>Aguardando pagamento</em></span>';
			        break;
				    case '2':
          		_p += '<span class="status stt_2"><em>Em análise</em></span>';
			        break;
				    case '3':
          		_p += '<span class="status stt_3"><em>Paga</em></span>';
			        break;
				    case '6':
          		_p += '<span class="status stt_6"><em>Devolvida</em></span>';
			        break;
				    case '7':
          		_p += '<span class="status stt_7"><em>Cancelada</em></span>';
			        break;
				    case '8':
          		_p += '<span class="status stt_8"><em>Debitado</em></span>';
			        break;
				    default:
          		_p += '<span class="status"><em>---</em></span>';
			        break;
					}
	    		_p += '</p>';
	    		_t.next('div').show().html(_p);
	    		_t.closest('td').find('img').show();
	    	}
	    },
			error: function(jqXHR, textStatus, errorThrown){
				console.log('Deu erro!');
			}
		});

	});
	
	//var myParam = location.search.split('tcode=')[1];
	/*
	$('.product').fadeIn('slow',function () {
		$('html,body').click(function(){
			$('.product').fadeOut('fast');
		})
	});
	*/
});