<?php
/*
  Suponha que você tenha uma string com um texto bastante longo. Você quer imprimir na tela todo o texto, mas garantir um limite máximo de N caracteres por linha.

  Crie uma função que receba dois parâmetros: uma string com o texto e o limite.
  Imprima o todo o texto, com o máximo de palavras por linha, mas sem nunca extrapolar o limite de caracteres.
  Se uma palavra não couber na linha e o comprimento dela for menor que o limite de caracteres, ela não deve ser cortada, e sim jogada para a próxima linha.
  Se a palavra for maior que o limite de caracteres por linha, corte a palavra e continue a imprimi-la na linha seguinte.
  Não utilize funções prontas, como p.ex. o wordWrap do PHP. O objetivo deste exercício é que você desenvolva o algoritmo indicado.
  Faça o exercício na linguagem de programação que preferir.
*/
function printLargeText($text, $limit){
	$newLine = "<br/>";
	//$newLine = "\n"; // Just for tests in the ubuntu console.

	if( empty($text) ){
		echo "Empty text;";
		echo $newLine;
		exit();
	}
	if (empty($limit) || $limit < 0){
		echo "Limit invalid;";
		echo $newLine;
		exit();
	}

	$words = explode(" ", $text);//Split by spaces
	$WordsPrintedSize = 0;
	$count = 0;
	foreach ($words as $word){
		$wordSize = strlen($word);//lets get the word size.
		$WordsPrintedSize += $wordSize;//lets know how much we will print.
		if ($wordSize > $limit){			
			if ($count != 0){
				echo $newLine;
			}
			echo substr($word, 0, $limit);
			//echo "-";
			echo $newLine;
			$wordRest = substr($word, $limit);
			if ( strlen($wordRest) > $limit ){
				//cut rest of the word, if it is more than the $limit.
				$wordCuted = str_split($wordRest, $limit);
				$iter = new CachingIterator(new ArrayIterator($wordCuted));//This is so I have the hasNext() function. 
				foreach ($iter as $wordCut){
					echo $wordCut;
	 				if ($iter->hasNext()){//if it's not the last we need to wrap again the word.
						//echo "-";
				    	echo $newLine;
				    }else{
				    	$WordsPrintedSize = strlen($wordCut);// in the last we count the last printed size.
				    }			    
				}
			}else{
				//just print the final cut.
				echo $wordRest;
				$WordsPrintedSize = strlen($wordRest);
			}	
		}else if ($WordsPrintedSize >= $limit) {
			if ($count != 0){
				echo $newLine;
			}
			echo $word;			
			$WordsPrintedSize = strlen($word); // Count the new line word size
		}else{
			echo $word;
		}
		echo " ";//Always print a space in the ed of the word printed.
		//$WordsPrintedSize++;//Add the space caracter to the count
		$count++;		
	}
	echo $newLine;
}


$text = "1234567890 1234 67890 1234567890 123456789012345 7890";
$limit = 10;

printLargeText($text, $limit);
?>
