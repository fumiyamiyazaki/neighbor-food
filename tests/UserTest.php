<?php declare(strict_types = 1);
use PHPUnit\Framework\TestCase;
// require_once("../model/User.php");

class UserTest extends TestCase {
  private $target = null;

  public function setUp() :void
  {
    $this->target = new User();
  }

  public function testIsUserTrue() {
    $this->assertEquals(true, $this->target->is_user($this->test_id, '1'));
  }

}

 ?>
