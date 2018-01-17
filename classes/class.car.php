<?php

	/** CAR **/
	class Car {
		//cnstrc
		public function __construct( $brand, $buildYear, $predominantColor, $motorType, $fuelType ){ //Biofuel - Ethanol fuel - Diesel fuel
			$this->brand = $brand;
			$this->buildYear = $buildYear;
			$this->predominantColor = $predominantColor;
			$this->motorType = $motorType;
			$this->fuelType = $fuelType;
		}

		public function description(){
			return "Follow descriptions to ". $this->brand . " | " . $this->buildYear;
		}
	}

	$xsaraPicasso = new Car('Citrën Xsara Picasso',2001,'Cinza','2.0','Gasolina');
	echo $xsaraPicasso->description();
?>