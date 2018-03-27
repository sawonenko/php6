<?php
/*
Абстрактный класс плоской фигуры
*/

abstract class FlatFigure {
  abstract function perimeter();

  function __toString(){
    return 'Object class: ' . get_class($this) . PHP_EOL .
    "Perimeter is equal to " . $this->perimeter() . PHP_EOL;
  }
}

/*
Класс элипс и его периметр
*/

class Elipse extends FlatFigure {
	
	public $sizes;

	function __construct($sizes = []){
		$this->sizes = $sizes;
	}

	function perimeter() {
		if ($this->sizes[0] > $this->sizes[1]){
			return 4 * ((M_PI * $this->sizes[0] * $this->sizes[1] + ($this->sizes[0] - $this->sizes[1])) / ($this->sizes[0] + $this->sizes[1]));
		}
		else return 4 * ((M_PI * $this->sizes[1] * $this->sizes[0] + ($this->sizes[1] - $this->sizes[0])) / ($this->sizes[1] + $this->sizes[0]));
	}

}

/*
Класс круг и его периметр
*/

class Round extends Elipse {
  
  public $radius;

  function __construct($radius = 0){
    $this->radius = $radius[0];
  }

  function perimeter(){
    return $this->radius * 2 * M_PI;
  }
}

/*
Класс многоугольник и его периметр
*/

class Polygon extends FlatFigure {

  public $size;

  function __construct($sizes = []){
    $this->sizes = $sizes;
  }

  function perimeter(){
    return array_sum($this->sizes);
  }
}

/*
Класс прямоугольник и его периметр
*/

class Rectangle extends Polygon {

  function perimeter(){
    return 2*($this->sizes[0] + $this->sizes[1]);
  }
}

/*
Класс квадрат и его периметр
*/

class Square extends Rectangle {

  function perimeter(){
    return 4*($this->sizes[0]);
  }
}

/*
Класс треугольник и его периметр
*/

class Triangle extends FlatFigure {

	public $sizes;

	function __construct($sizes = []){
    	$this->sizes = $sizes;
  	}

	function perimeter(){
		return array_sum($this->sizes);
	}
}

function createFigure($sizes) {
  $ob1 = '';
  if((count($sizes) == 1) || ((count($sizes) == 2) && ($sizes[0] == $sizes[1]))) {
    $ob1 =  new Round($sizes);
  } elseif((count($sizes) == 2) && ($sizes[0] != $sizes[1])) {
  	$ob1 = new Elipse($sizes);
  } elseif((count($sizes) == 4) && (count(array_count_values($sizes)) == 1)) {
    $ob1 =  new Square($sizes);
  } elseif((count($sizes) == 4) && (count(array_count_values($sizes)) == 2)) {
  	$ob1 =  new Rectangle($sizes);
  } elseif(count($sizes) == 3) {
  	$ob1 = new Triangle($sizes);
  } else $ob1 =  new Polygon($sizes);
  echo $ob1->__toString();
}

$figures = [[2],
 			[2,2,4,4],
 			[2,2,2,2],
 			[2,2,2],
 			[2,3,4,5,6,7],
 			[2,3],
 			[2,2],];

foreach ($figures as $figure) {
	print_r($figure) . "\n";
	createFigure($figure);
	echo "================================ \n";}