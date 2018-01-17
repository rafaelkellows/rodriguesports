	//function after succesful file upload (when server response)
	function afterSuccess(){
		$('#btUploadImage').show(); //hide submit button
		$('#loading-img').hide(); //hide submit button
		$('#uploadProgress').delay( 1000 ).fadeOut(); //hide progress bar
		if( $('#bannerPreview img').attr('src') ){
			$('#bannerPreview img').attr('src','../'+$("#output").html());
		}else{
			$('#bannerPreview ul li').html('<img src="../'+$("#output").html()+'" alt="">');
		}
		$('#fileUploader #src').val($("#output").html());
		$("#output").html('<em style="font-size:11px;"><font style="font-style:normal;">Importante:</font> essa imagem só será armazenada após clicar no botão "Salvar Dados"</em>');

	}

	//function to check file size before uploading.
	function beforeSubmit(){
	   //check whether browser fully supports all File API
	   if (window.File && window.FileReader && window.FileList && window.Blob)
		{
			
			if( !$('#FileInput').val() ) //check empty input filed
			{
				$("#output").html('<em style="font-size:11px;"><font style="font-style:normal;">Ops, </font>você precisa selecionar alguma imagem.</em>'); 
				return false
			}
			
			var fsize = $('#FileInput')[0].files[0].size; //get file size
			var ftype = $('#FileInput')[0].files[0].type; // get file type
			

			//allow file types 
			switch(ftype)
	        {
				case 'image/jpeg': 
	                break;
	            default:
	                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
					return false
	        }
			
			//Allowed file size is less than 5 MB (1048576)
			if(fsize>5242880) 
			{
				$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
				return false
			}
					
			$('#btUploadImage').hide(); //hide submit button
			$('#loading-img').show(); //hide submit button
			$("#output").html("");  
		}
		else
		{
			//Output error to older unsupported browsers that doesn't support HTML5 File API
			$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
			return false;
		}
	}

	//progress bar function
	function OnProgress(event, position, total, percentComplete){
	    //Progress bar
		$('#uploadProgress').show();
	    $("#uploadProgress").progressbar({ value: percentComplete });

	    /*
	    $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
	    $('#statustxt').html(percentComplete + '%'); //update status text
	    if(percentComplete>50)
	        {
	            $('#statustxt').css('color','#000'); //change status text to white after 50%
	        }
	    */
	}

	//function to format bites bit.ly/19yoIPO
	function bytesToSize(bytes) {
	   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	   if (bytes == 0) return '0 Bytes';
	   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
	};

	function crop_afterSuccess(){
		$("#output").hide();
		$('#btUploadImage').show(); //hide submit button
		$('#loading-img').hide(); //hide submit button
		$('#uploadProgress').delay( 1000 ).fadeOut(); //hide progress bar

		_jcrop_html =  '<div id="div-jcrop">';
		_jcrop_html += '	<p>Ajuste sua imagem antes de salvar:</p><br>';
		_jcrop_html += '	<div id="div-preview"><img id="preview" src="'+$("#output").find('img').attr('src')+'" width="'+$("#output").find('img').attr('width')+'" height="'+$("#output").find('img').attr('height')+'" /></div>';
		_jcrop_html += '	<img id="jcrop" src="'+$("#output").find('img').attr('src')+'" width="'+$("#output").find('img').attr('width')+'" height="'+$("#output").find('img').attr('height')+'" /><br>';
		_jcrop_html += '	<input type="button" value="Salvar Imagem" id="btn-crop" />';
		_jcrop_html += '</div>';
		_jcrop_html += '<div id="debug">';
		_jcrop_html += '	<input type="hidden" id="x" size="5" disabled /><input type="hidden" id="x2" size="5" disabled />';
		_jcrop_html += '	<input type="hidden" id="y" size="5" disabled /><input type="hidden" id="y2" size="5" disabled />';
		_jcrop_html += '	<p><strong>Dimensões</strong> <input type="text" id="h" size="5" disabled /> x <input type="text" id="w" size="5" disabled /></p>';
		_jcrop_html += '</div>';

 		$("#output").html(_jcrop_html);
 		$("#output").show();

		var img = $("#output").find('img').attr('src');
	
		$(function(){
			$('#jcrop').Jcrop({
				onChange: exibePreview,
				onSelect: exibePreview,
				aspectRatio: 1
			});
			$('#btn-crop').click(function(){
				$.post( 'crop.php', {
					img: img, 
					x: $('#x').val(), 
					y: $('#y').val(), 
					w: $('#w').val(), 
					h: $('#h').val()
				}, function(){
					var m_random = Math.random();
					var _inputChecked = ( $('#productsPreview ul li:first input[type=radio]').length === 0 ) ? ' checked' : '';
					var _li =  '<li>';
					    _li += '	<input type="hidden" name="gallery[]" value="' + img.replace('../','') + '?' + m_random + '">';
					    _li += '	<a href="javascript:void(0);">';
					    _li += '		<img src="' + img + '?' + m_random + '" alt="" />';
					    _li += '	</a>';
					    _li += '	<input type="radio" name="capa" value="' + img + '?' + m_random + '"'+_inputChecked+' />'; 
					    _li += '	<div class="actions" style="display: none;">';
					    _li += '		<a class="delete" href="javascript:void(0);" title=""><img src="images/delete.png" alt=""></a></div></li>';
					    _li += '	</div></li>';
					    _li += '</li>';
					$('#productsPreview ul li.none').remove();
					$('#productsPreview ul').append(_li);
					
					$('form').jqTransform({imgPath:'../images/forms'});

					$(".pics.preview.products ul li").hover(
						  function() { $(this).children(".actions").show("fade", 200); },
						  function() { $(this).children(".actions").hide("fade", 200); }
					 );
					$('.pics.preview.products .actions a.delete').click(function(){
						var elemThis = jQuery(this);
						var _ul = jQuery(this).closest('ul');
						jConfirm('Você quer realmente excluir este Produto?', 'Excluir Produto?', function(r) {
							if(r){
								elemThis.closest('li').fadeOut('slow',function(){
									$(this).remove();
									if( _ul.find('li').length === 0 ){
										_ul.append('<li class="none"><p style="padding:5px; text-align:center;font-size:11px;">Nenhuma imagem cadastrada.</p></li>');
									}
								})
							}
						});
					});
			
					//$('#div-jcrop').html( '<img src="' + img + '?' + Math.random() + '" width="'+$('#w').val()+'" height="'+$('#h').val()+'" />' );
					$('#FileInput').val('');
					$('#div-jcrop').html('<p class="nSuccess" style="text-align:center; margin-top:10px; ">Imagem cadastrada com sucesso! <br><em style="font-size:11px;"><font style="font-style:normal;">Importante:</font> A imagem só será armazenada no banco após clicar no botão "Salvar Dados"</em></p>');
					$('#debug').remove();
					jQuery('html, body').animate({
					    scrollTop: jQuery("#productsPreview").first().offset().top-80
					},500);
				});
				return false;
			});
			jQuery('html, body').animate({
			    scrollTop: jQuery("#output").first().offset().top-70
			},500);
		});
		
		function exibePreview(c){
			var rx = 150 / c.w;
			var ry = 150 / c.h;
		
			$('#preview').css({
				width: Math.round(rx * $("#output #jcrop").attr('width') ) + 'px',
				height: Math.round(ry * $("#output #jcrop").attr('height') ) + 'px',
				marginLeft: '-' + Math.round(rx * c.x) + 'px',
				marginTop: '-' + Math.round(ry * c.y) + 'px'
			});
			
			$('#x').val(c.x);
			$('#y').val(c.y);
			$('#x2').val(c.x2);
			$('#y2').val(c.y2);
			$('#w').val(c.w);
			$('#h').val(c.h);
		};
	}