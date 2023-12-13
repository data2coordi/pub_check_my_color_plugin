<?php
/**
 * Class SampleTest
 *
 * @package Check_my_color
 */

/**
 * Sample test case.
 */


require_once("override.php");

class Simple_color_class_sub  extends check_my_color\Simple_color_class{
	public function __construct() {
	}
}
class SampleTest extends WP_UnitTestCase {

	private $testa; 		
	private $dummy; 		
	public function setUp() {

		$_POST['result'] = 'BBBBA';
		$_POST['page_no'] = '2';
		$_GET['id'] = 'A';
		$this->dummy = new check_my_color\Simple_color_class();
//		$this->go_to('http://192.168.0.62:8080/diagnosis/');
//		    global $post;
//		  var_dump($post->post_name);
		//$this->go_to('diagnosis');
	//	var_dump(is_page('diagnosis'));
//		$this->assertSame( true, is_home() );
	}

	/**
	 * A single example test.
	 */
	public function test_sample2() {
		$dummy = new check_my_color\Simple_color_class();
		$ret = $this->dummy->simple_check_my_color('XXXX name="page_no" value="2" > xxx', 'diagnosis');
		$this->assertSame('XXXX name="page_no" value="3" > xxx', $ret );
	}

	public function test_sample3() {
		$dummy = new check_my_color\Simple_color_class();
		$ret = $this->dummy->simple_check_my_color('XXXX name="page_no" value="2" > xxx', 'diagnosis');
		$this->assertSame('XXXX name="page_no" value="3" > xxx', $ret );
	}

	public function set($p1, $p2){
		$this->testa = '24';
		var_dump('test7');
	}

	public function test_simple_check_displayRet() {
//		$observer = $this->getMockBuilder(check_my_color\ColorCheckerClass::class)
//				 ->setMethods(['SetCheckFile'])
//				 ->getMock();

//		$observer->expects($this->once())
//			 ->method('update')
//			 ->with($this->equalTo('something'));

		$sub = new Simple_color_class_sub();
		$ret = $sub->simple_check_displayRet($this);
		$this->assertSame('24', $this->testa );
	}



}





/*
	public function testObserversAreUpdated()
	{
		// Observer クラスのモックを作成します。
		// update() メソッドのみのモックです。
		$observer = $this->getMockBuilder(Observer::class)
				 ->setMethods(['update'])
				 ->getMock();

		// update() メソッドが一度だけコールされ、その際の
		// パラメータは文字列 'something' となる、
		// ということを期待しています。
		$observer->expects($this->once())
			 ->method('update')
			 ->with($this->equalTo('something'));

		// Subject オブジェクトを作成し、Observer オブジェクトの
		// モックをアタッチします。
		$subject = new Subject('My subject');
		$subject->attach($observer);

		// $subject オブジェクトの doSomething() メソッドをコールします。
		// これは、Observer オブジェクトのモックの update() メソッドを、
		// 文字列 'something' を引数としてコールすることを期待されています。
		$subject->doSomething();
	}
*/
