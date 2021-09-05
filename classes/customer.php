<?php 
    $filepath=realpath(dirname(__FILE__));
     include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
 ?>
<?php 
   /**
    * 
    */
   class customer
   {
   	
   	    private $db;
   	    private $fm;
	   	public function __construct()
	   	{
	   		$this->db= new Database();
	   		$this->fm= new Format(); // nó chính là class Format trong thư mục helpers
	   	}
      public function insert_customer($data)
      {
        $name=mysqli_real_escape_string($this->db->link,$data['name']);
        $city=mysqli_real_escape_string($this->db->link,$data['city']);
        $zipcode=mysqli_real_escape_string($this->db->link,$data['zipcode']);
        $email=mysqli_real_escape_string($this->db->link,$data['email']);
        $address=mysqli_real_escape_string($this->db->link,$data['address']);
        $country=mysqli_real_escape_string($this->db->link,$data['country']);
        $phone=mysqli_real_escape_string($this->db->link,$data['phone']);
        $password=mysqli_real_escape_string($this->db->link,md5($data['password']));


        if($name=="" || $city=="" || $zipcode=="" || $email=="" || $address=="" || $country=="" ||$phone=="" ||$password==""){
           $alert="<span class='error'>Các trường dữ liệu không được bỏ trống</span>";
           return $alert;

        }
        else{
             // Neu nhap day du cac truong du lieu
            // Kiem tra email.Neu email đó tồn tại rồi thì mình ko cho thêm
            $check_email="SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
            $result_check=$this->db->select($check_email); //đây là câu lệnh thực thi
            if($result_check){
              $alert="<span class='error'>Email đã tồn tại trong hệ thống</span>";
              return $alert;

            }else{
                  $query="INSERT INTO tbl_customer(name,city,zipcode,email,address,country,phone,password) VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
                  $result=$this->db->insert($query);
                  if($result){
                    $alert="<span class='success'>Tạo tài khoản thành công</span>";
                    return $alert;

                  }
                  else{
                    $alert="<span class='error'>Tạo tài khoản thất bại</span> ";
                    return $alert;
                  }
            }

        }
      }
      public function login_customer($data)
      {
         $email=mysqli_real_escape_string($this->db->link,$data['email']);
         $password=mysqli_real_escape_string($this->db->link,md5($data['password']));

        if($email=="" || $password=="" ){
           $alert="<span class='error'>Email hoặc Password không được bỏ trống</span>";
           return $alert;

        }
        else{
             
            $check="SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' LIMIT 1";
            $result_check=$this->db->select($check); //đây là câu lệnh thực thi
            if($result_check!=false){
              $value=$result_check->fetch_assoc();
                 // nếu mà đúng ta khởi tạo 1 cái session
              Session::set('customer_login',true);
               Session::set('customer_id',$value['id']);
                Session::set('customer_login',$value['name']);
                // header('Location:order.php');
                // header('Location:index.php');
                echo "<script type='text/javascript'>window.location.href = 'index.php'</script>";  



            }else{
               $alert="<span class='error'>Email hoặc Password không trùng khớp</span>";
               return $alert;              
            }
        }
      }
      public function show_customer($id)
      {
           $query="SELECT * FROM tbl_customer WHERE id='$id'";
            $result=$this->db->select($query); //đây là câu lệnh thực thi
            return $result;
         
      }
      public function update_customer($data,$id)
      {
          $name=mysqli_real_escape_string($this->db->link,$data['name']);
        $city=mysqli_real_escape_string($this->db->link,$data['city']);
        $zipcode=mysqli_real_escape_string($this->db->link,$data['zipcode']);
        $email=mysqli_real_escape_string($this->db->link,$data['email']);
        $address=mysqli_real_escape_string($this->db->link,$data['address']);
        $country=mysqli_real_escape_string($this->db->link,$data['country']);
        $phone=mysqli_real_escape_string($this->db->link,$data['phone']);
        // $password=mysqli_real_escape_string($this->db->link,md5($data['password']));


        if($name=="" || $city=="" || $zipcode=="" || $email=="" || $address=="" || $country=="" ||$phone=="" )
        {
           $alert="<span class='error'>Các trường dữ liệu không được bỏ trống </span>";
           return $alert;
           // if(){
           //    $alert="<span class='error'>Toi ko cho bạn dang ki </span>";
           //       return $alert;
           // }


        }
        else{
            
          $query="UPDATE tbl_customer SET name='$name',city='$city',zipcode='$zipcode',email='$email',address='$address',country='$country',phone='$phone' WHERE id='$id'";
          $result=$this->db->update($query);
          if($result){
            // $alert="<span class='success'>Cập nhật tài khoản thành công</span>";
            // return $alert;

            echo "<script type='text/javascript'>window.location.href = 'profile.php'</script>";  

          }
          else{
            $alert="<span class='error'>Cập nhật tài khoản thất bại</span> ";
            return $alert;
          }
        }
      }

	   
   }
 ?>
