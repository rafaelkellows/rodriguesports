<?php

	/** CAR **/
	class Product {
		//cnstrc
		public function __construct( $id, $cid, $sid, $cover, $title, $resume, $min_price, $max_price, $size, $color, $weight ){ 
			$this->id = $id;
			$this->cid = $cid;
			$this->sid = $sid;
			$this->cover = $cover;
			$this->title = $title;
			$this->resume = $resume;
			$this->max_price = $max_price;
			$this->min_price = $min_price;
			$this->size = $size;
			$this->color = $color;
			$this->weight = $weight;
		}

		public function highlight(){
			echo '<dl class="prod-item">';
			echo '	<dt id="'.$this->id.'"><strong>Cód. '.$this->id.'</strong><a href="./produto.php?id_prod='.$this->id.'&cat='.$this->cid.'&sub='.$this->sid.'">'.$this->title.'</a></dt>';
			echo '	<dd>';
			echo '		<span class="label"><i class="fa fa-check-circle" aria-hidden="true"></i>Item Adicionado</span>';
			echo '		<img src="'.$this->cover.'" title="'.$this->title.'" />';
			echo '		<span class="resume">'.$this->resume.'</span>';
			echo '		<p class="lbl"><strong>R$'.$this->max_price.'</strong><em> unidade</em></p> ';
			
			// SIZE
			$array = explode(',', $this->size);
			echo "		<ul class='size'>";
			echo "			<em>" . ( ( stripos($this->size, 'ml') === false) ? "Tamanho" : "Capacidade") . " disponível</em>";
			foreach($array as $s){
				echo "		<li class='". (($s=='') ? "unico" : null ) ."'>". (($s!='') ? $s : "único")  . '</li>';
			}
			echo "		</ul>";

			// COLOR
			echo "		<ul class='color'>";
			echo "			<em>Cor disponível</em>";
			if ($this->color->rowCount() > 0) {
				while ( $row_colors = $this->color->fetch(PDO::FETCH_ASSOC) ) {
					if($row_colors['color']!=''){
						echo "	<li style='background-color:#".$row_colors['color']."; ". (( $row_colors['color'] == 'ffffff') ? 'border:1px solid #f4f4f4;' : '' )."' title='".$row_colors['label']."'>".$row_colors['color']."</li>";
					}
				}
			}else{
				echo "			<li class='diverso'>diverso</li>";
			}
			echo "		</ul>";

			// BUTTONS
			echo '		<a class="btn-default btn-color-E btn-checkout" href="checkout.php?id_row='.$this->id.'&min='.$this->min_price.'&max='.$this->max_price.'&weight='.$this->weight.'" title="Adicionar ao Carrinho"><i class="fa fa-shopping-cart"></i> Adicionar ao Carrinho</a>';
			echo '		<a class="btn-default btn-color-B" href="orcamento.php?id_prod='.$this->id.'&cat='.$this->cid.'&sub='.$this->sid.'&capa='.$this->cover.'" title="Solicitar Orçamento"><i class="fa fa-edit"></i> Solicitar Orçamento</a>';
			echo '		<a class="btn-short" href="./produto.php?id_prod='.$this->id.'&cat='.$this->cid.'&sub='.$this->sid.'" title="Ver mais detalhes"><i class="fa fa-plus"></i> ver mais detalhes</a>';
			echo "	</dd>";
			echo "</dl>";
		}
	}

	//$xsaraPicasso = new Car('Citrën Xsara Picasso',2001,'Cinza','2.0','Gasolina');
	//echo $xsaraPicasso->highlight();
?>