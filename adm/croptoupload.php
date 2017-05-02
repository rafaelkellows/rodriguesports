<?php

	// memory limit (nem todo server aceita)
	ini_set("memory_limit","50M");
	set_time_limit(0);
	
	// processa arquivo
	$imagem		= isset( $_FILES['FileInput'] ) ? $_FILES['FileInput'] : NULL;
	$tem_crop	= false;
	$img		= '';
	if( $imagem['tmp_name'] )
	{
		$imagesize = getimagesize( $imagem['tmp_name'] );
		if( $imagesize !== false ){

			$File_Name          = strtolower($imagem['name']);
			$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
			$Random_Number      = rand(0, 9999999999); //Random number to be added to name.

		    $now = new DateTime();
		    $dateSR = str_replace('-','_',$now->format('d-m-Y H:i:s'));
		    $dateSR = str_replace(' ','_',$dateSR);
		    $dateSR = str_replace(':','_',$dateSR);

			$NewFileName = $Random_Number.'_'.$dateSR.$File_Ext; //new file name
		


			if( move_uploaded_file( $imagem['tmp_name'], '../images/produtos/produto_'.$NewFileName ) )
			{
				include( 'm2brimagem.class.php' );
				$oImg = new m2brimagem( '../images/produtos/produto_'.$NewFileName );
				if( $oImg->valida() == 'OK' )
				{
					$curr_imagesize 	= getimagesize( '../images/produtos/produto_'.$NewFileName );
					if ( $curr_imagesize[0] > 540 ){
						$oImg->redimensiona( '540', '', '' );
					}

					$oImg->grava( '../images/produtos/produto_'.$NewFileName );
					
					$imagesize 	= getimagesize( '../images/produtos/produto_'.$NewFileName );
					$img		= '<img src="../images/produtos/produto_'.$NewFileName.'" '.$imagesize[3].' />'; // id="jcrop" 
					$preview	= '<img src="../images/produtos/produto_'.$NewFileName.'" id="preview" '.$imagesize[3].' />';
					$tem_crop 	= true;
					print $img;
				}
			}
		}
	}
?>
