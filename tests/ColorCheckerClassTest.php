<?php
/**
 * Class SampleTest
 *
 * @package Check_my_color
 */

/**
 * Sample test case.
 */
// use PHPUnit\Framework\TestCase;

//require_once("../check_my_color.php");
require_once("../ColorCheckerClass.php");


//夏	B	B	B	B	A
//秋	B	B	A	B	B
//春	A	B	A	A	B
//冬	A	A	B	A	A

//"夏ソフトタイプ"	:BBBBA
//"夏ブルータイプ"	: 
//"秋イエロータイプ"	: 
//"秋ハードタイプ"	:
//"春ソフトタイプ" 	: 
//"春イエロータイプ"	:ABAAB
//"冬ブルータイプ"	:  
//"冬ハードタイプ"	:  







class StackTest extends PHPUnit\Framework\TestCase
{

    public function setUp(){
    	//var_dump('test1');
    }
    public function tearDown(){
    	//var_dump('test2');
    }


    public function testCheck()
    {

	$ColorChecker = new check_my_color\ColorCheckerClass();
	$ColorChecker->SetCheckFile('/var/www/html/wp-content/uploads/p_color_check_sheet.csv');

	$ret = $ColorChecker->Check('BBBBA');
        $this->assertSame('夏ソフトタイプ', $ret ); 

	$ret = $ColorChecker->Check('ABAAB');
        $this->assertSame('春イエロータイプ', $ret ); 
/*
	$ret = $ColorChecker->Check('ABAAB');
        $this->assertSame('16', $ret ); 

	$ret = $ColorChecker->Check('AABAA');
        $this->assertSame('17', $ret ); 

	$ret = $ColorChecker->Check('BBABB');
        $this->assertSame('18', $ret ); 
*/
    }


    public function testDisplayRet1()
    {
	$ColorChecker = new check_my_color\ColorCheckerClass();

	$ret = $ColorChecker->DisplayRet('BBBB','A');
        $this->assertSame('夏ソフトタイプ', $ret ); 

    }

    //public function Replace($target, $result, $page_no, $yes_no) {
    public function testReplace()
    {
	//name="result" value="0">	
	//name="result" value="01">	
	$ColorChecker = new check_my_color\ColorCheckerClass();
	$ret = $ColorChecker->Replace('XXXX name="result" value="0"> xxx' , '0101', '2', '1');
        $this->assertSame('XXXX name="result" value="01011" > xxx', $ret ); 


	// '/name="page_no"
	// 'name="page_no" value=" 
	$ret = $ColorChecker->Replace('XXXX name="page_no" value="0"> xxx' , '0101', '1', '1');
        $this->assertSame('XXXX name="page_no" value="2" > xxx', $ret ); 

	$ret = $ColorChecker->Replace('XXXX diagnosis/?id=A xxx' , '0101', '4', '1');
        $this->assertSame('XXXX dia-result/?id=A xxx', $ret ); 

	$ret = $ColorChecker->Replace('XXXX diagnosis/?id=B xxx' , '0101', '4', '1');
        $this->assertSame('XXXX dia-result/?id=B xxx', $ret ); 

	$ret = $ColorChecker->Replace('XXXX diagnosis_01 xxx' , '0101', '2', '1');
        $this->assertSame('XXXX diagnosis_03 xxx', $ret ); 



    }

}


