//Checkout
var checkOutForm = $('form#checkout'), itens, arrItens = [];
function checkout(){
	checkOutForm = $('form#checkout'), itens = $('header aside ul li.block.f-right.notlogged a.fa-shopping-cart em');
	//Add products on Clicks
	$('.btn-buy.btn-color-E, .btn-default.btn-color-E').unbind('click').click(function(e){
		e.preventDefault();
		itens.html( eval(itens.html())+1 );
		arrItens.push( $(this).attr('href').split('&') );
		if( $(this).hasClass('btn-buy') ){
			arrItens[arrItens.length-1].push( $(this).closest('dl').find('dt').attr('id'), $(this).closest('dl').find('dt a').text(), $(this).closest('dl').find('dd a.desc').text(), $(this).closest('dl').find('dd a img').attr('src'), 1);
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
					if($(this).find('dt').attr('id')===data[x][3]){
						$(this).addClass('added');
					}
				});
				$('main section.highlights dl').each(function(){
					
					if($(this).find('dt').attr('id')===data[x][3]){
						//console.log( $(this).find('dt').attr('id')+" === "+data[x][3] );
						$(this).addClass('added');
						$(this).remove();
					}
				});
				$('main section.features dl').each(function(){
					//console.log( $(this).find('dt').attr('id')+" === "+data[x][3] );
					if($(this).find('dt').attr('id')===data[x][3]){
						//$(this).find('dl').addClass('added');
						$(this).remove();
					}
				});
				if( $('main.main_products aside div input[name=id]').val() === data[x][3] ){
					$('main.main_products > aside > div > .shopping_info').addClass('added');
					$('main.main_products > aside > div > .shopping_info a.btn-default.btn-color-E').remove();
				}
				if(checkOutForm.length){
					var _tr = '<tr>';
						_tr += '	<input name="min_price" type="hidden" value="'+data[x][2].substring(data[x][2].indexOf('=')+1).replace(',','.')+'" />';
						_tr += '	<input name="max_price" type="hidden" value="'+data[x][2].substring(data[x][2].indexOf('=')+1).replace(',','.')+'" />';
						_tr += '	<td class="center">'+data[x][3]+' <input id="itemId'+x+'" name="itemId'+x+'" type="hidden" value="'+data[x][3]+'"></td>';
						_tr += '	<td>';
						_tr += '		<img src="'+data[x][6]+'" width="100" alt="">';
						_tr += '		<p>'+data[x][4]+' <input id="itemDescription'+x+'" name="itemDescription'+x+'" type="hidden" value="'+data[x][4]+'"></p>';
						_tr += '	</td>';
						_tr += '	<td>';
						_tr += '		<input id="itemQuantity'+x+'" name="itemQuantity'+x+'" type="text" value="'+data[x][7]+'">';
						_tr += '		<span>';
						_tr += '			<a href="javascript:void(0);" class="s-up" title="Clique para aumentar o valor">+</a>';
						_tr += '			<a href="javascript:void(0);" class="s-down" title="Clique para diminuir o valor">-</a>';
						_tr += '		</span>';
						_tr += '	</td>';

						_tr += '	<td class="center">R$<i>'+(( data[x][7] > 1 ) ? data[x][2].substring(data[x][2].indexOf('=')+1) : data[x][2].substring(data[x][2].indexOf('=')+1))+'</i> <input id="itemAmount'+x+'" name="itemAmount'+x+'" type="hidden" value="'+(( data[x][7] > 1 ) ? data[x][2].substring(data[x][2].indexOf('=')+1).replace(',','.') : data[x][2].substring(data[x][2].indexOf('=')+1).replace(',','.'))+'"></td>';
						_tr += '	<td><a class="btn-color-E" href="javascript:void(0);" title="Excluir produto da lista"><i class="fa fa-close"></i></a></td>';
						_tr += '	<input id="itemWeight'+x+'" name="itemWeight'+x+'" type="hidden" value="1000">';
						_tr += '</tr>';
					checkOutForm.find('table tbody').prepend(_tr);
				}
				
				setTimeout(function(){
						$("#owl-highlights").owlCarousel({
							itemsCustom : [ [0, 1], [664, 2], [998, 3] ],
    					navigation : true,
							slideSpeed : 500,
							rewindNav : false
	  				});
						var owl = $("#owl-features").owlCarousel({
							items : 4, 
							itemsCustom : [ [0, 1], [470, 2], [664, 3], [998, 4] ],
							navigation : false,
							slideSpeed : 500,
							rewindNav : false
						});
						$("main section.features nav a").click(function(){ owl.trigger('owl.next'); });
						$("main section.features nav a").first().click(function(){ owl.trigger('owl.prev'); });
				},500);
					
				//main.main_products section.product_features #owl-product_features
			}
			addRemove();
			setTimeout(function(){
				$('form#checkout table tbody tr td > a').click(function(){
					for(var x=0; x<arrItens.length; x=x+1){
						if(arrItens[x][3]===$(this).closest('tr').find('td input[name^="itemId"]').val()){
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
					var _t_itens = 0, _t_prices = 0;
					$('form#checkout table tbody tr').each(function(){
						_iQnt = $(this).find('input[name^="itemQuantity"]').val();
						_iAmt = $(this).find('input[name^="itemAmount"]').val();
						_t_itens=( _t_itens+Number( _iQnt ) );
						_t_prices = _t_prices+( Number(_iQnt)*Number(_iAmt));
						//console.log( _t_prices );
					});

					$('form#checkout table tfoot tr td > i').html(_t_prices.toFixed(2).replace('.',','));
				}
				//END Calculate

				$('body.chn-budget main form fieldset a').click(function(){
					_tr = $(this).closest('tr');
					_min = _tr.find('input[name=min_price]').val();
					_max = _tr.find('input[name=max_price]').val();
					_pricelabel = _tr.find('td > i');
					_amount = _tr.find('td > i').next('input');
					_i = $(this).parent().prev().val();
					//console.log(arrItens);
					for(var x=0; x<arrItens.length; x=x+1){
						if(arrItens[x][3]===$(this).closest('tr').find('td input[name^="itemId"]').val()){
							arrItens[x].splice(7,1,$(this).closest('tr').find('td input[name^="itemQuantity"]').val());
							$.cookie("itens", JSON.stringify(arrItens), { path: '/', expires: 1 });
							break;
						}
					}
					if(_i < 2){
						_pricelabel.html(_max.replace('.',','));
						_amount.val(_max);
					}else{
						_pricelabel.html(_min.replace('.',','));
						_amount.val(_min);
					}
					calc(_amount);
				});
				$('form#checkout table tbody tr td input[name^="itemQuantity"]').keyup(function(){
					calc($(this));
				});
				calc(null);

			},500);

		}else{
			console.log('Nada a trazer');
		}
	}
}
checkout();
