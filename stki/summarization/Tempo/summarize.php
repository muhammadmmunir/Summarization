<?php

	summarize('mesir.txt');

	function summarize($filename){

		// buka dokumen dan pisahkan perkalimat
		$load_file  = file_get_contents("./corpus/".$filename);
		$document = $load_file;
		$sentence 	= preg_split("/[.]+/", $load_file);
		$separate_sentence = $sentence;

		// buang array terakhir (kosong)
		$sentence = array_slice($sentence, 0, sizeof($sentence)-1);

		// menghitung frekuensi kata unik tiap kalimat
		for ($i=0; $i < count($sentence); $i++) { 
			$sentence[$i] = preg_split("/[\s]+/", $sentence[$i]);
			$sentence[$i] = array_count_values($sentence[$i]);
		}

		// mengitung jumlah kalimat
		$total_sentence = count($sentence);

		// buka daftar stopword dan pisahkan perkata
		$stopwords	= file_get_contents("./resources/stopwords.txt");
		$stopwords	= preg_split("/[\s]+/", $stopwords);

		// membuat kalimat unik
		// case folding dan tokenisasi
		$token = preg_split("/[\d\W\s]+/", strtolower($document));

		// buang array terakhir (kosong)
		$token = array_slice($token, 0, sizeof($token)-1);

		// membuang stopwords (filtering)
		$token = array_diff($token, $stopwords);		

		// perbaiki indeks
		$token = array_values($token); 

		// menyimpan nilai df tiap token
		// hilangkan redudansi token
		$token = array_count_values($token); 

		// menghitung jumlah token
		$total_token = count($token);

		// mengurutkan token berdasarkan key
		ksort($token);
	
		// membuat vector space model dan
		// menghitung frekuensi kemunculan kata
		$vsm_tf = array();
		$i = 0;
		foreach ($token as $key => $value) { 
			for ($j=0; $j < $total_sentence; $j++) { 
				for ($k=0; $k < $total_token; $k++) { 
					if(array_key_exists($key, $sentence[$j])){
						$vsm_tf[$i][$j] = $sentence[$j][$key];
					}else{
						$vsm_tf[$i][$j] = 0;
					}
				}
			}
			$i++;
		}

		// echo "frekuensi tiap kata dalam kalimat<br>";
		// foreach ($vsm_tf as $key => $value) {
		// 	print_r($value);
		// 	echo "<br/>";
		// }

		// menghitung tf weight
		$vsm_wtf = array();
		for ($i=0; $i < $total_token; $i++) { 
			for ($j=0; $j < $total_sentence; $j++) { 
				if($vsm_tf[$i][$j] !== 0){
					$vsm_wtf[$i][$j] = 1 + log10($vsm_tf[$i][$j]);
				}else{
					$vsm_wtf[$i][$j] = 0;
				}
			}
		}

		// echo "tf weight <br>";
		// foreach ($vsm_wtf as $key => $value) {
		// 	print_r($value);
		// 	echo "<br/>";
		// }

		// menghitung dft
		$dft = array();
		foreach ($token as $key => $value) {
			$dft[$key] = $value;
		}

		// menghitung idft
		$idft = array();
		foreach ($dft as $key => $value) {
			$idft[$key] = log10($total_sentence/$dft[$key]);
		}	

		// menghitung wt,d
		$vsm_wtd = array();
		$i = 0;
		foreach ($idft as $key => $value) {
			for ($j=0; $j < $total_sentence; $j++) { 
				$vsm_wtd[$i][$j] = $vsm_wtf[$i][$j] * $value;
			}
			$i++;
		}

		// echo "wt,d <br>";
		// foreach ($vsm_wtd as $key => $value) {
		// 	print_r($value);
		// 	echo "<br/>";
		// }

		// menghitung Ws
		$ws = array();
		$i = 0;
		for ($i=0; $i < $total_token; $i++) { 
			for ($j=0; $j < $total_sentence; $j++) {
				if(empty($ws[$j])){
					$ws[$j] = 0;
					$ws[$j] += $vsm_wtd[$i][$j];
				}else{
					$ws[$j] += $vsm_wtd[$i][$j];
				}
			}
		}

		// echo "Ws <br>";
		// foreach ($ws as $key => $value) {
		// 	print_r($key." ".$value);
		// 	echo "<br/>";
		// }	

		// mengurutkan hasil Ws
		arsort($ws);

		// memotong 50%
		$sorted = array_slice($ws, 0, count($ws)/2, true);

		// mengurutkan berdasarkan urutan kalimat
		ksort($sorted);

		// menggabungkan kalimat terpilih menjadi ringkasan
		$summary = "";
		foreach ($sorted as $key => $value) {
			$summary = $summary.$separate_sentence[$key].". ";
		}

		// menyimpan dokumen asli dan hasil ringkasan
		$final_result = array();
		$final_result['asli'] = $document;
		$final_result['ringkasan'] = $summary;

		// mengembalikan dokumen asli dan hasil ringkasan
		return $final_result;
	}

?>