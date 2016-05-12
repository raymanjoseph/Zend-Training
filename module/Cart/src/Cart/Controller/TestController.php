<?php 

namespace Cart\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
 	
/*
* TEST FOR THE SHIPPING RATE
*
*/

class TestController extends AbstractActionController
{
	
	public function rateAction()
	{	
		$this->testAction('expedited',100);
		$this->testAction('ground',100);
		/*
		$this->testAction('ground',60);
		$this->testAction('ground',10);
		$this->testAction('ground',20);
		$this->testAction('expedited',30);
		$this->testAction('expedited',40);
		$this->testAction('ground',50);
		$this->testAction('ground',60);
		$this->testAction('expedited',100);
		$this->testAction('ground',-1);
		$this->testAction('expedited','string');
		*/
		return new ViewModel();
	}
	public function testAction($method, $input)
	{
		$num = ceil($input);
		echo '<div class="container test">';
		$total_rate = 0;
		$rate = 0;
		if (is_numeric($input)) {

			if ($input < 0) {
				echo '<div style="color:red";>The integer is negative</div>';
			} else {
				
				if ($method == 'Ground' || $method == 'ground') {
			
					for ($x=0;$x<=$num; $x++) {
						echo '<div style="background:#F6F7D6">'.' <br>'.$num.'</div>';
						if ($num >= 0 && $num <= 5) {
							
							$rate += 8;
							echo '<div style="background:#ECBFBF">'.' range 0-5 for <b>'.$num.'</b></div>';
							break;
							
						} elseif ($num >= 6 && $num <= 10) {
							
							$rate += 12;
							echo '<div style="background:#80D440">'.' range 6-10 for <b>'.$num.'</b></div>';
							break;
						
						} elseif ($num >= 11 && $num <= 20) {
							
							$rate += 18;
							echo '<div style="background:#A5ACE0">'.' range 11-20 for <b>'.$num.'</b></div>';
							break;
						} elseif ($num >= 21 && $num <= 40) {
							
							$rate += 25;
							echo '<div style="background:#E4A8D7">'.' range 21-40 for <b>'.$num.'</b></div>';
							break;
							
						} elseif($num > 40) {

							$rate += 25;
							$num = $num-40;
							$x--;
							echo '<div style="background:#D2E7F9">From above 40'.' <br>'.$num.'</div>';
						}
						$total_rate+=$rate;

						
						echo '<hr>';
					}
					echo '<h1>the total_rate is '.$rate.'<h1>';
				} elseif ($method == 'Expedited' || $method == 'expedited') {
					
					for ($x=0;$x<=$num; $x++) {
						echo '<div style="background:#F6F7D6">'.' <br>'.$num.'</div>';
						if ($num >= 0 && $num <= 5) {
							
							$rate += 12;
							echo '<div style="background:#ECBFBF">'.' range 0-5 for <b>'.$num.'</b></div>';
							break;
							
						} elseif ($num >= 6 && $num <= 10) {
							
							$rate += 15;
							echo '<div style="background:#80D440">'.' range 6-10 for <b>'.$num.'</b></div>';
							break;
						
						} elseif ($num >= 11 && $num <= 20) {
							
							$rate += 22;
							echo '<div style="background:#A5ACE0">'.' range 11-20 for <b>'.$num.'</b></div>';
							break;
						} elseif ($num >= 21 && $num <= 40) {
							
							$rate += 30;
							echo '<div style="background:#E4A8D7">'.' range 21-40 for <b>'.$num.'</b></div>';
							break;
							
						} elseif($num > 40) {

							$rate += 30;
							$num = $num-40;
							$x--;
							echo '<div style="background:#D2E7F9">From above 40'.' <br>'.$num.'</div>';
						}
						echo '<hr>';
					}
					echo '<h1>the total_rate is '.$rate.'<h1>';
				} else {
					// INVALID 
				}
			}
		} else {
			echo '<div style="color:red";>Input is not Integer</div>';
		}
		echo '</div>';
		return new ViewModel();	
	}
}