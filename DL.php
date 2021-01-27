<?php
class DL
{
	private function cost($char_query,$char_term)
	{
		$cost = ($char_query == $char_term) ? 0 : 1 ;
		return $cost;
	}
	private function max_lenght($query,$term)
	{
		$len1 = strlen($query);	
		$len2 = strlen($term);	

		$len_max =($len1 >= $len2) ? $len1 : $len2;

		return $len_max;
	}
	private function set_error($query=null,$term=null)
	{
		$distance 	= $this->distance($query,$term) ;
		$max_lenght	= $this->max_lenght($query,$term) ;

		return $distance / $max_lenght;
	}	
	private function set_distance($str1=null,$str2=null)
	{
		$panjang_str1 = strlen($str1);
		$panjang_str2 = strlen($str2);

		for ($i=0; $i < $panjang_str1 ; $i++) { 
			$pisah_str1[] = substr($str1,$i,1);
			for ($j=0; $j < $panjang_str2 ; $j++) { 
				$pisah_str2[] = substr($str2,$j,1);

				$cost = $this->cost($pisah_str1[$i],$pisah_str2[$j]);

				$matriks_distance[$i][$j] 	= 0;

				if ($i==0 && $j==0) {
					$minimum = $cost;
					$matriks_distance[$i][$j] = $minimum;
				}elseif ($i==0 && $j>=1) {
					$insertion	= ($matriks_distance[$i][$j-1])+1;
					$minimum 	= min($cost,$insertion); 
					$matriks_distance[$i][$j] = ($matriks_distance[$i][$j-1])+ $minimum;

				}elseif ($i>=1 && $j==0) {
					$deletion	= ($matriks_distance[$i-1][$j])+1;
					$minimum 	= min($cost,$deletion); 
					
					$matriks_distance[$i][$j] =($matriks_distance[$i-1][$j])+ $minimum;

				}else if ($i>=1 && $j>=1) {
					$deletion	 	= $matriks_distance[$i-1][$j]+1;
					$insertion		= $matriks_distance[$i][$j-1]+1;
					$subtitution 	= $matriks_distance[$i-1][$j-1]+$cost;
					$transposition	= $matriks_distance[$i-1][$j-1];

					$minimum = min($deletion,$insertion,$subtitution);


					if ($pisah_str1[$i]==$pisah_str2[$j-1] && $pisah_str1[$i-1]==$pisah_str2[$j] ) {
						$minimum = $transposition;
					}
					
					$matriks_distance[$i][$j] = $matriks_distance[$i][$j] + $minimum;
				}

			}
		}
		return $matriks_distance[$i-1][$j-1];
	}

	public function get_error($query,$term)
	{
		return $this->set_error($query,$term);
	}

	public function get_distance($str1, $str2)
	{
		return $this->set_distance($str1, $str2);
	}
}

$dl = new DL();
