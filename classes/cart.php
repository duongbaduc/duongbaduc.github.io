<?php 
    $filepath=realpath(dirname(__FILE__));
     include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
 ?>
<?php 
   /**
    * 
    */
   class cart
   { 
   	
   	    private $db;
   	    private $fm;
	   	public function __construct()
	   	{
	   		$this->db= new Database();
	   		$this->fm= new Format(); // nó chính là class Format trong thư mục helpers
	   	}
      public function add_to_cart($quantity,$id){

        $quantity=$this->fm->validation($quantity);
        $quantity=mysqli_real_escape_string($this->db->link,$quantity);
        $id=mysqli_real_escape_string($this->db->link,$id);
        $sId=session_id();

        $query="SELECT * FROM tbl_product WHERE productId='$id'";
        $result=$this->db->select($query)->fetch_assoc();

        $image=$result['image'];
        $price=$result['price'];
        $productName=$result['productName'];


        // kiểm tra trùng lặp sau khi thêm sản phẩm vào giỏ hàng
        $checkcart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId' ";
        $check_cart = $this->db->select($checkcart);
        if(mysqli_num_rows($check_cart)>0){
          $alert = "<span>Sản phẩm này đã được thêm vào giỏ hàng rồi</span>";
          return $alert;
        }
         else{
          // nếu mà sản phẩm chưa được thêm (id nó không bằng và sId cũng chưa có )
             $query_insert="INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES('$id','$quantity','$sId','$image','$price','$productName')";
          $insert_cart=$this->db->insert($query_insert);
          if($result){
            // header('Location:cart.php');
              echo "<script type='text/javascript'>window.location.href = 'cart.php'</script>";  
              // $alert="<span class='success'>Thêm vào giỏ hàng thành công</span>";
              //  return $alert;

          }
          else{
           header('Location:404.php');
          }
        }
       
      }
      public function get_product_cart()
      {

         $sId=session_id();

          $query="SELECT * FROM tbl_cart WHERE sId='$sId' "; // điều kiện bằng cái session hiện tại mình đang thực hiện trên session đó mà mình chưa hủy
          $result=$this->db->select($query);
          return $result;
      }
      public function update_quantity_cart($quantity,$cartId)
      {
         $quantity=mysqli_real_escape_string($this->db->link,$quantity);
         $cartId=mysqli_real_escape_string($this->db->link,$cartId);

         $query="UPDATE tbl_cart 
            SET quantity='$quantity'  
            WHERE cartId='$cartId'";
            $result=$this->db->update($query); 
             // return $result;
            if($result){
              // $alert="<span class='success'>Sửa số lượng thành công</span>";
              // return $alert;
               echo "<script type='text/javascript'>window.location.href = 'cart.php'</script>";  

            }
            // else{
            //   $alert="<span class='error'>Sửa số lượng thất bại</span> ";
            //   return $alert;
            // }
      }
      public function del_product_cart($cartid)
      {
         $cartid=mysqli_real_escape_string($this->db->link,$cartid);

         $query="DELETE  FROM tbl_cart WHERE cartId='$cartid'";
          $result=$this->db->delete($query);
         // return $result;
        if($result){
              echo "<script type='text/javascript'>window.location.href = 'cart.php'</script>";  

          }
          else{ 
            // header('Location:404.php');
          }
      }

      public function check_cart()
      {
        // Cái session của cái giỏ hàng nó có tồn tại .nêu ra cái trang header nó hiển thị lên giá của giỏ hàng lên 
          $sId=session_id();

          $query="SELECT * FROM tbl_cart WHERE sId='$sId' "; // điều kiện bằng cái session hiện tại mình đang thực hiện trên session đó mà mình chưa hủy
          $result=$this->db->select($query);
          return $result;
      }
      public function del_all_data_cart()
      {
           $sId=session_id();

          $query="DELETE  FROM tbl_cart WHERE sId='$sId' "; 
          $result=$this->db->delete($query);
          return $result;
      }
      public function insertOrder($customer_id)
      {
        $sId=session_id();
        $query="SELECT * FROM tbl_cart WHERE sId='$sId' "; // so sánh với cái session trong giỏ hàng để lấy ra các sản phẩm trong giỏ hang

          $get_product=$this->db->select($query);
          if($get_product){
            while ($result=$get_product->fetch_assoc()) {
              $productid=$result['productId'];
              $productName=$result['productName'];
              $quantity=$result['quantity'];
              $price=$result['price']*$quantity;
              $image=$result['image']; //như vậy coi như tất cả các trường trong bảng "tbl_cart" ta đã lấy ra được
              $customer_id=$customer_id;  

              $query_order="INSERT INTO tbl_order(productId,productName,quantity,price,image,customer_id) VALUES('$productid','$productName','$quantity','$price','$image','$customer_id')";
              $insert_order=$this->db->insert($query_order);
              // if($result){
              //   header('Location:cart.php');
              //    // echo "<script type='text/javascript'>window.location.href = 'cart.php'</script>"; 

              // }
              // else{
              //  header('Location:404.php');
              // }           

              
            }

          }
      }
      public function getAmountPrice($customer_id)
      {
         
        $query="SELECT price FROM tbl_order WHERE customer_id='$customer_id'";
                                     // date_order=now():bằng thời gian hiện hữu
         $get_price=$this->db->select($query);
         return $get_price;
      }
      public function get_cart_ordered($customer_id)
      {
         $query="SELECT * FROM tbl_order WHERE customer_id='$customer_id' ORDER BY date_order desc ";
                                     // date_order=now():bằng thời gian hiện hữu
         $get_cart_ordered=$this->db->select($query);
         return $get_cart_ordered;
      }

      public function check_order($customer_id)
      {
        
          $sId=session_id();

          $query="SELECT * FROM tbl_order WHERE customer_id='$customer_id' "; 
          $result=$this->db->select($query);
          return $result;
      }
      public function get_inbox_cart()
      {
         $query="SELECT * FROM tbl_order ORDER BY date_order desc";
                                     
         $get_inbox_cart=$this->db->select($query);
         return $get_inbox_cart;
      }
      public function shifted($id,$time,$price)
      {
        $id=mysqli_real_escape_string($this->db->link,$id);
        $time=mysqli_real_escape_string($this->db->link,$time);
        $price=mysqli_real_escape_string($this->db->link,$price);
          $query="UPDATE tbl_order 
            SET status='1'  
            WHERE customer_id='$id' AND date_order='$time' AND price='$price'";
          $result=$this->db->update($query);
             // return $result;
          if($result){
            
             echo "<script type='text/javascript'>window.location.href = 'inbox.php'</script>";  

          }
          else{
            $alert="<span class='error'>Xử lý đơn hàng thất bại</span>";
            return $alert;
          }
      }
      public function del_shifted($id,$time,$price)
      {
        $id=mysqli_real_escape_string($this->db->link,$id);
        $time=mysqli_real_escape_string($this->db->link,$time);
        $price=mysqli_real_escape_string($this->db->link,$price);
          $query="DELETE FROM tbl_order WHERE id='$id' AND date_order='$time' AND price='$price'";
          $result=$this->db->delete($query);
             // return $result;
          if($result){
            // $alert="<span class='success'>Xóa đơn hàng thành công</span>";
            // return $alert;
              echo "<script type='text/javascript'>window.location.href = 'inbox.php'</script>";  

          }
          else{
            $alert="<span class='error'>Xóa đơn hàng thất bại</span>";
            return $alert;
          }
      }
      public function shifted_confirm($id,$time,$price)
      {
         $id=mysqli_real_escape_string($this->db->link,$id);
         $time=mysqli_real_escape_string($this->db->link,$time);
         $price=mysqli_real_escape_string($this->db->link,$price);
          $query="UPDATE tbl_order 
            SET status='2'  
            WHERE customer_id='$id' AND date_order='$time' AND price='$price'";
          $result=$this->db->update($query);
              // return $result;
          if($result){
            
             echo "<script type='text/javascript'>window.location.href = 'orderdetails.php'</script>";  

          }
      }
      public function del_compare($customer_id)
      {
           $sId=session_id();

          $query="DELETE  FROM tbl_compare WHERE customer_id='$customer_id' "; 
          $result=$this->db->delete($query);
          return $result;
      }


	   
   }
 ?>