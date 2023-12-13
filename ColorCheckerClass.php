<?php
namespace check_my_color;


class ColorCheckerClass {

    //private $CheckTableSrc ;
    static $CheckTableSrc;

    public function __construct()
    {
    }

    public function SetCheckFile($filePath) {
	//$CheckTableSrc = new SplFileObject($filePath);
	$test2 = substr('test', 1, 1);
	ColorCheckerClass::$CheckTableSrc = new \SplFileObject($filePath);
    }

    public function Check($result) {
	$result_scores = array (
			 array("summer_soft"  ,"夏ソフトタイプ"  ,0)
			,array("summer_blue"  ,"夏ブルータイプ"  ,0)
			,array("autumn_hard"  ,"秋イエロータイプ"  ,0)
			,array("autumn_yellow","秋ハードタイプ",0)
			,array("spring_soft"  ,"春ソフトタイプ"  ,0)
			,array("spring_yellow","春イエロータイプ",0)
			,array("winter_blue"  ,"冬ブルータイプ"  ,0)
			,array("winter_hard"  ,"冬ハードタイプ"  ,0)
			);

	//回答結果を配列に取得
	for ($i = 0; $i <= 4; $i++) {
		$user_ansers[$i] = substr($result, $i, 1);
	}

	//$CheckTableSrc->setFlags( SplFileObject::READ_CSV );
	ColorCheckerClass::$CheckTableSrc->setFlags( \SplFileObject::READ_CSV );
	foreach (ColorCheckerClass::$CheckTableSrc as $f) {
		if (!$f[0]==""){
			$pcolor_check_tbl[$f[0].$f[1]] = array_slice($f, 0, 7);
		}
	}

	//全てのパーソナルカラーで繰り返し
	$ret_score_ix=0;
	foreach ($result_scores as $result_score) {


		//回答の点数を加算
		for ($i = 0; $i <= 4; $i++) {
			$result_scores[$ret_score_ix][2] = 
				$result_scores[$ret_score_ix][2] + 
				$pcolor_check_tbl[$result_score[0].$user_ansers[$i]][$i+2];
		}

		$ret_score_ix++;
	}

	foreach( $result_scores as $value) {$score[] = $value[2];}
	array_multisort( $score, SORT_DESC, SORT_NUMERIC, $result_scores);
	
//	var_dump('anser:'.$result);
//	var_dump('sheetNo:'.$result_scores[0][0]);
//	var_dump('score:'.$result_scores[0][2]);
	return $result_scores[0][1]; 
    }


    public function DisplayRet($result, $yes_no) {
	
//	結果の判定	
	$result = $result . $yes_no;
        return $this->Check($result);
    }


    public function Replace($target, $result, $page_no, $yes_no) {

	if ($page_no == 4){
		$target = str_replace('diagnosis/?id=A', 'dia-result/?id=A',$target);
		$target = str_replace('diagnosis/?id=B', 'dia-result/?id=B',$target);
	}

	$before_str = "diagnosis_01" ;
	$next_page_no = (int)$page_no + 1;
	$after_str  = "diagnosis_0" . (string)$next_page_no;
	$target = str_replace($before_str, $after_str, $target);


	//name="result" value="0">	
	//name="result" value="01">	
	$search  = '/name="page_no".*?>/';
	$replace =  'name="page_no" value="' . (string)((int)$page_no + 1) . '" >';
	$target = preg_replace($search, $replace, $target);
	
	$val = $result . $yes_no;
	$search  = '/name="result".*?>/';
	$replace =  'name="result" value="' . $val . '" >';
	$target = preg_replace($search, $replace, $target);

	return $target;
    }



}

?>
