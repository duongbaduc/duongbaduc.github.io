<?php 
     
    $filepath=realpath(dirname(__FILE__));
     include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');

     // Đây là class người dùng
     // Cho đăng kí,đăng nhập,đặt hàng
 ?>
<?php 
   /**
    * 
    */
   class user
   {
   	
   	    private $db;
   	    private $fm;
	   	public function __construct()
	   	{
	   		$this->db= new Database();
	   		$this->fm= new Format(); // nó chính là class Format trong thư mục helpers
	   	}
	   
   }
 ?>