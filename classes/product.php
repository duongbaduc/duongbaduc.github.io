<?php 
     $filepath=realpath(dirname(__FILE__));
     include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
 ?>
<?php 
   /**
    * 
    */
   class product
   {
   	
   	    private $db;
   	    private $fm;
	   	public function __construct()
	   	{
	   		$this->db= new Database();
	   		$this->fm= new Format(); // nó chính là class Format trong thư mục helpers
	   	}
	   	public function insert_product($data,$files)
	   	{
	   		// $catName=$this->fm->validation($catName);// trong tbl_category : mình chỉ lấy catName thôi .Do catId nó tự tăng rồi
	   		$productName=mysqli_real_escape_string($this->db->link,$data['productName']);
	   		$category=mysqli_real_escape_string($this->db->link,$data['category']);
	   		$brand=mysqli_real_escape_string($this->db->link,$data['brand']);
	   		$product_desc=mysqli_real_escape_string($this->db->link,$data['product_desc']);
	   		$price=mysqli_real_escape_string($this->db->link,$data['price']);
	  
	   		$type=mysqli_real_escape_string($this->db->link,$data['type']);

	   		$sohieu=mysqli_real_escape_string($this->db->link,$data['sohieu']);
	   		$xuatxu=mysqli_real_escape_string($this->db->link,$data['xuatxu']);
	   		$gioitinh=mysqli_real_escape_string($this->db->link,$data['gioitinh']);
	   		$kinh=mysqli_real_escape_string($this->db->link,$data['kinh']);
	   		$may=mysqli_real_escape_string($this->db->link,$data['may']);
	   		$bhquocte=mysqli_real_escape_string($this->db->link,$data['bhquocte']);
	   		$bhcuahang=mysqli_real_escape_string($this->db->link,$data['bhcuahang']);

	   		$duongkinhmatso=mysqli_real_escape_string($this->db->link,$data['duongkinhmatso']);
	   		$bedaymatso=mysqli_real_escape_string($this->db->link,$data['bedaymatso']);
	   		$nieng=mysqli_real_escape_string($this->db->link,$data['nieng']);
	   		$daydeo=mysqli_real_escape_string($this->db->link,$data['daydeo']);
	   		$maumatso=mysqli_real_escape_string($this->db->link,$data['maumatso']);
	   		$chongnuoc=mysqli_real_escape_string($this->db->link,$data['chongnuoc']);
	   		$khac=mysqli_real_escape_string($this->db->link,$data['khac']);
	   		// $bhcuahang=mysqli_real_escape_string($this->db->link,$data['price']);

	   		// Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
	   		$permited= array('jpg','jpeg','png','gif' );
	   		   $file_name=$_FILES['image']['name'];
	   		   $file_size=$_FILES['image']['size'];
	   		   $file_temp=$_FILES['image']['tmp_name'];

	   		   $div=explode('.', $file_name);
	   		   $file_ext=strtolower(end($div));
	   		   $unipue_image=substr(md5(time()), 0,10).'.'.$file_ext;
	   		   $uploaded_image="uploads/".$unipue_image;


	   		if($productName=="" || $category=="" || $brand=="" || $product_desc=="" || $price=="" || $type=="" ||$file_name==""){
	   			 $alert="<span class='error'>Các trường dữ liệu không được bỏ trống</span>";
	   			 return $alert;

	   		}
	   		else{
	   			move_uploaded_file($file_temp, $uploaded_image);
	   			$query="INSERT INTO tbl_product(productName,catId,brandId,product_desc,type,price,image,sohieusanpham,xuatxu,gioitinh,kinh,may,baohanhquocte,baohanhcuahang,duongkinhmatso,bedaymatso,nieng,daydeo,maumatso,chongnuoc,chucnangkhac) VALUES('$productName','$category','$brand','$product_desc','$type','$price','$unipue_image','$sohieu','$xuatxu','$gioitinh','$kinh','$may','$bhquocte','$bhcuahang','$duongkinhmatso','$bedaymatso','$nieng','$daydeo','$maumatso','$chongnuoc','$khac')";
	   			$result=$this->db->insert($query);
	   			if($result){
	   				// $alert="<span class='success'>Thêm sản phẩm thành công</span>";
	   				// return $alert;
	   				 echo "<script type='text/javascript'>window.location.href = 'productlist.php'</script>";  

	   			}
	   			else{
	   				$alert="<span class='error'>Thêm sản phẩm thất bại</span> ";
	   				return $alert;
	   			}

	   			
	   			
	   		}

	   	}
	  
	   	public function getproductbyId($id)
	   	{
	   		$query="SELECT * FROM tbl_product WHERE productId='$id'";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function update_product($data,$files,$id)
	   	{
	   		// $catName=$this->fm->validation($catName);// trong tbl_category : mình chỉ lấy catName thôi .Do catId nó tự tăng rồi
	   		$productName=mysqli_real_escape_string($this->db->link,$data['productName']);
	   		$category=mysqli_real_escape_string($this->db->link,$data['category']);
	   		$brand=mysqli_real_escape_string($this->db->link,$data['brand']);
	   		$product_desc=mysqli_real_escape_string($this->db->link,$data['product_desc']);
	   		$price=mysqli_real_escape_string($this->db->link,$data['price']);
	  
	   		$type=mysqli_real_escape_string($this->db->link,$data['type']);

	   		$sohieu=mysqli_real_escape_string($this->db->link,$data['sohieu']);
	   		$xuatxu=mysqli_real_escape_string($this->db->link,$data['xuatxu']);
	   		$gioitinh=mysqli_real_escape_string($this->db->link,$data['gioitinh']);
	   		$kinh=mysqli_real_escape_string($this->db->link,$data['kinh']);
	   		$may=mysqli_real_escape_string($this->db->link,$data['may']);
	   		$bhquocte=mysqli_real_escape_string($this->db->link,$data['bhquocte']);
	   		$bhcuahang=mysqli_real_escape_string($this->db->link,$data['bhcuahang']);

	   		$duongkinhmatso=mysqli_real_escape_string($this->db->link,$data['duongkinhmatso']);
	   		$bedaymatso=mysqli_real_escape_string($this->db->link,$data['bedaymatso']);
	   		$nieng=mysqli_real_escape_string($this->db->link,$data['nieng']);
	   		$daydeo=mysqli_real_escape_string($this->db->link,$data['daydeo']);
	   		$maumatso=mysqli_real_escape_string($this->db->link,$data['maumatso']);
	   		$chongnuoc=mysqli_real_escape_string($this->db->link,$data['chongnuoc']);
	   		$khac=mysqli_real_escape_string($this->db->link,$data['khac']);

	   		// Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
	   		$permited= array('jpg','jpeg','png','gif' );
	   		   $file_name=$_FILES['image']['name'];
	   		   $file_size=$_FILES['image']['size'];
	   		   $file_temp=$_FILES['image']['tmp_name'];

	   		   $div=explode('.', $file_name);
	   		   $file_ext=strtolower(end($div));
	   		   $unipue_image=substr(md5(time()), 0,10).'.'.$file_ext;
	   		   $uploaded_image="uploads/".$unipue_image;

	   		if($productName=="" || $category=="" || $brand=="" || $product_desc=="" || $price=="" || $type==""){
	   			 $alert="<span class='error'>Các trường dữ liệu không được bỏ trống</span>";
	   			 return $alert;

	   		}else{
	   			if(!empty($file_name)){
	   				// Nếu người dùng chọn ảnh
	   				if($file_size>204800){
	   					$alert="<span class='success'>Kích thước ảnh nên nhỏ hơn 20MB</span>";
	   					return $alert;
	   				}
	   				elseif(in_array($file_ext, $permited)===false){
	   					$alert="<span class='success'>Bạn chỉ có thể upload được những file sau:-".implode(',',$permited)."</span>";
	   					return $alert;
	   				}
	   				move_uploaded_file($file_temp, $uploaded_image);
	   				$query="UPDATE tbl_product 
	   				SET productName='$productName',catId='$category', brandId='$brand', product_desc='$product_desc',price='$price',type='$type',image='$unipue_image',sohieusanpham='$sohieu',xuatxu='$xuatxu',gioitinh='$gioitinh',kinh='$kinh',may='$may',baohanhquocte='$bhquocte',baohanhcuahang='$bhcuahang',duongkinhmatso='$duongkinhmatso',bedaymatso='$bedaymatso',nieng='$nieng',daydeo='$daydeo',maumatso='$maumatso',chongnuoc='$chongnuoc',chucnangkhac='$khac'     
	   				WHERE productId='$id'";
	   				$result=$this->db->update($query);
		   			if($result){
		   				// $alert="<span class='success'>Sửa sản phẩm thành công</span>";
		   				// return $alert;
		   				echo "<script type='text/javascript'>window.location.href = 'productlist.php'</script>";  

		   			}
		   			else{
		   				$alert="<span class='error'>Sửa sản phẩm thất bại</span> ";
		   				return $alert;
		   			}	

	   			}
	   			else{
	   				// Nếu người dùng không chọn ảnh
	   				$query="UPDATE tbl_product 
	   				SET productName='$productName',catId='$category', brandId='$brand', product_desc='$product_desc',price='$price',type='$type',sohieusanpham='$sohieu',xuatxu='$xuatxu',gioitinh='$gioitinh',kinh='$kinh',may='$may',baohanhquocte='$bhquocte',baohanhcuahang='$bhcuahang',duongkinhmatso='$duongkinhmatso',bedaymatso='$bedaymatso',nieng='$nieng',daydeo='$daydeo',maumatso='$maumatso',chongnuoc='$chongnuoc',chucnangkhac='$khac'   
	   				WHERE productId='$id'";
	   				// $query="UPDATE tbl_category SET catName='$catName' WHERE catId='$id'";
		   			$result=$this->db->update($query);
		   			if($result){
		   				// $alert="<span class='success'>Sửa sản phẩm thành công</span>";
		   				// return $alert;
		   				echo "<script type='text/javascript'>window.location.href = 'productlist.php'</script>";  

		   			}
		   			else{
		   				$alert="<span class='error'>Sửa sản phẩm thất bại</span> ";
		   				return $alert;
		   			}	

	   			}
	   			
	   		}
			
	   	}
	   	public function del_product($id)
	   	{
	   		$query="DELETE  FROM tbl_product WHERE productId='$id'";
	   		$result=$this->db->delete($query);
	   		if($result){
	   				// $alert="<span class='success'>Xóa sản phẩm thành công</span>";
	   				// return $alert;
	   			echo "<script type='text/javascript'>window.location.href = 'productlist.php'</script>";  

	   			}
	   			else{
	   				$alert="<span class='error'>Xóa sản phẩm thất bại</span> ";
	   				return $alert;
	   			}
	   	}
	                                                   	// End backend



	   	public function getproduct_feathered(){
	   		// $query="SELECT * FROM tbl_product WHERE type='1'  order by productId desc LIMIT 8 ";  // lấy những sản phẩm type=1(nổi bật)
	   		$query="SELECT * FROM tbl_product WHERE type='1' AND price > 10000000 LIMIT 8 ";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   

	   	public function get_details($id){
	   		$query="SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
	   		FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId=tbl_category.catId
	   		INNER JOIN tbl_brand ON tbl_product.brandId=tbl_brand.brandId
	   		WHERE tbl_product.productId='$id' ";

	   		$result=$this->db->select($query); // chú ý chỗ tbl_category.catName, tbl_brand.brandName(vì sản phẩm thuộc danh mục nào và thương hiệu nào)
	   		return $result;
	   	}
	   	public function getlastestDell()
	   	{
	   		$query="SELECT * FROM tbl_product WHERE brandId='5' AND type='1' order by productId desc LIMIT 1";  // chi lay ra 1 san pham moi nhat
	   		$result=$this->db->select($query); // casio
	   		return $result;
	   	}
	   	public function getlastestOppo()
	   	{
	   		$query="SELECT * FROM tbl_product WHERE brandId='3'  AND type='1' order by productId desc LIMIT 1";  // chi lay ra 1 san pham moi nhat
	   		$result=$this->db->select($query);// seiko
	   		return $result;
	   	}
	   	public function getlastestSamSung() // citizen
	   	{
	   		$query="SELECT * FROM tbl_product WHERE brandId='12'  AND type='1' order by productId desc LIMIT 1";  // chi lay ra 1 san pham moi nhat
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function getlastestApple() // bulova
	   	{
	   		$query="SELECT * FROM tbl_product WHERE brandId='2'  AND type='1' order by productId desc LIMIT 1";  // chi lay ra 1 san pham moi nhat
	   		$result=$this->db->select($query);
	   		return $result;
	   	}

	   	public function insertCompare($productid,$customer_id)
	   	{
	   		 
	        $productid=mysqli_real_escape_string($this->db->link,$productid);
	        $customer_id=mysqli_real_escape_string($this->db->link,$customer_id);
	        // $sId=session_id();

	         	$check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id = '$customer_id' ";
		        $result_check_compare = $this->db->select($check_compare);
		        if($result_check_compare){
		          $alert = "<span class='error'>Sản phẩm này đã được thêm vào để so sánh rồi</span>";
		          return $alert;
		        }else{

		       
				        $query="SELECT * FROM tbl_product WHERE productId='$productid'";
				        $result=$this->db->select($query)->fetch_assoc();
			 
				        $productName=$result['productName'];
				        $image=$result['image'];
				        $price=$result['price'];
				       
				          
				         $query_insert="INSERT INTO tbl_compare(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
				          $insert_compare=$this->db->insert($query_insert);
				          if($insert_compare){
				   				$alert="<span class='success'>Added Compare thành công</span>";
				   				return $alert;

				   			}
				   			else{
				   				$alert="<span class='error'>Added Compare thất bại</span> ";
				   				return $alert;
				   			}
	   		          }
	        
	   	}
	   	public function get_compare($customer_id)
	   	{
	   		$query="SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' order by id desc";  // chi lay ra 1 san pham moi nhat
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function insertWishlist($productid,$customer_id)
	   	{
	   		 $productid=mysqli_real_escape_string($this->db->link,$productid);
	        $customer_id=mysqli_real_escape_string($this->db->link,$customer_id);
	        // $sId=session_id();

	         	$check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id = '$customer_id' ";
		        $result_check_wlist = $this->db->select($check_wlist);
		        if($result_check_wlist){
		          $alert = "<span class='error'>Sản phẩm này đã được thêm vào yêu thích rồi</span>";
		          return $alert;
		        }else{

		       
				        $query="SELECT * FROM tbl_product WHERE productId='$productid'";
				        $result=$this->db->select($query)->fetch_assoc();
			 
				        $productName=$result['productName'];
				        $image=$result['image'];
				        $price=$result['price'];
				       
				          
				         $query_insert="INSERT INTO tbl_wishlist(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
				          $insert_wlist=$this->db->insert($query_insert);
				          if($insert_wlist){
				   				$alert="<span class='success'>Thêm vào danh sách yêu thích</span>";
				   				return $alert;

				   			}
				   			else{
				   				$alert="<span class='error'>Thêm thất bại</span> ";
				   				return $alert;
				   			}
	   		          }
	   	}
	   	public function get_wishlist($customer_id)
	   	{
	   		$query="SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' order by id desc";  // chi lay ra 1 san pham moi nhat
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function del_wishlist($proid,$customer_id)
	   	{
	   		$query="DELETE  FROM tbl_wishlist WHERE productId='$proid' AND customer_id = '$customer_id'";
	   		$result=$this->db->delete($query);
	   		return $result;
	   	}
	   	public function insert_slider($data,$files)
	   	{
	   		  
	   		$sliderName=mysqli_real_escape_string($this->db->link,$data['sliderName']);
	   		$type=mysqli_real_escape_string($this->db->link,$data['type']);
	   		
	   		

	   		// Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
	   		$permited= array('jpg','jpeg','png','gif' );
	   		   $file_name=$_FILES['image']['name'];
	   		   $file_size=$_FILES['image']['size'];
	   		   $file_temp=$_FILES['image']['tmp_name'];

	   		   $div=explode('.', $file_name);
	   		   $file_ext=strtolower(end($div));
	   		   $unipue_image=substr(md5(time()), 0,10).'.'.$file_ext;
	   		   $uploaded_image="uploads/".$unipue_image;

	   		if($sliderName=="" || $type=="" ){
	   			 $alert="<span class='error'>Các trường dữ liệu không được bỏ trống</span>";
	   			 return $alert;

	   		}else{
	   			if(!empty($file_name)){
	   				// Nếu người dùng chọn ảnh
	   				if($file_size>2048000){
	   					$alert="<span class='success'>Kích thước ảnh nên nhỏ hơn 20MB</span>";
	   					return $alert;
	   				}
	   				elseif(in_array($file_ext, $permited)===false){
	   					$alert="<span class='success'>Bạn chỉ có thể upload được những file sau:-".implode(',',$permited)."</span>";
	   					return $alert;
	   				}
	   				move_uploaded_file($file_temp, $uploaded_image);
	   				$query="INSERT INTO tbl_slider(sliderName,type,slider_image) VALUES('$sliderName','$type','$unipue_image')";
		   			$result=$this->db->insert($query);
		   			if($result){
		   				// $alert="<span class='success'>Thêm slider thành công</span>";
		   				// return $alert;
		   				echo "<script type='text/javascript'>window.location.href = 'sliderlist.php'</script>";  

		   			}
		   			else{
		   				$alert="<span class='error'>Thêm slider thất bại</span> ";
		   				return $alert;
		   			}

	   			}
	   			// else{
	   			// 	// Nếu người dùng không chọn ảnh
	   			// 	$query="UPDATE tbl_product 
	   			// 	SET productName='$productName',catId='$category', brandId='$brand', product_desc='$product_desc',price='$price',type='$type'   
	   			// 	WHERE productId='$id'";
	   			// 	// $query="UPDATE tbl_category SET catName='$catName' WHERE catId='$id'";
		   		// 	$result=$this->db->update($query);
		   		// 	if($result){
		   		// 		$alert="<span class='success'>Sửa sản phẩm thành công</span>";
		   		// 		return $alert;

		   		// 	}
		   		// 	else{
		   		// 		$alert="<span class='error'>Sửa sản phẩm thất bại</span> ";
		   		// 		return $alert;
		   		// 	}	

	   			// }
	   			
	   		}
			

	   	}
	   	public function show_slider()
	   	{
	   		$query="SELECT * FROM tbl_slider WHERE type='1' order by sliderId desc"; // giảm dần <=> mới thêm thì hiện ra trước
	   		
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function update_type_slider($id,$type)
	   	{
	   		$type=mysqli_real_escape_string($this->db->link,$type);
	   		$query="UPDATE tbl_slider SET type='$type' WHERE sliderId='$id'"; // giảm dần <=> mới thêm thì hiện ra trước
	   		
	   		$result=$this->db->update($query);
	   		return $result;
	   	}

	   	// cho admin
	   	public function show_slider_list()
	   	{
	   		$query="SELECT * FROM tbl_slider order by sliderId desc"; // giảm dần <=> mới thêm thì hiện ra trước
	   		
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function del_slider($id)
	   	{
	   		$query="DELETE  FROM tbl_slider WHERE sliderId='$id'";
	   		$result=$this->db->delete($query);
	   		if($result){
	   				$alert="<span class='success'>Xóa slider thành công</span>";
	   				return $alert;

	   			}
	   			else{
	   				$alert="<span class='error'>Xóa slider thất bại</span> ";
	   				return $alert;
	   			}
	   	}

	   	public function search_product($tukhoa)
	   	{
	   		$tukhoa=$this->fm->validation($tukhoa); //kiểm tra cái biến từ khóa xem đã có chưa 

	   		// Sau khi đã có từ khóa gửi từ bên search.php->product.php(classes) rồi
	   		$query="SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%' AND type='1'";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function getproduct_new(){
	   		$query="SELECT * FROM tbl_product WHERE type='1' order by productId desc LIMIT 8";  // lấy những sản phẩm mới (LIMIT 4): giới hạn sản phẩm
	   		$result=$this->db->select($query);
	   		return $result;
	   	}

	   	
	   	 public function show_product()
	   	{
	   		
	   		// $query="SELECT * FROM tbl_product order by productId desc";
	   		$query="SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
	   		FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId=tbl_category.catId
	   		INNER JOIN tbl_brand ON tbl_product.brandId=tbl_brand.brandId
	   		order by tbl_product.productId desc";

	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	  



   }
 ?>