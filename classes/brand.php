<?php 
   
       $filepath=realpath(dirname(__FILE__));

     include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
 ?>
<?php 
   /**
    * 
    */
   class brand
   {
   	
   	    private $db;
   	    private $fm;
	   	public function __construct()
	   	{
	   		$this->db= new Database();
	   		$this->fm= new Format(); // nó chính là class Format trong thư mục helpers
	   	}
	   	public function insert_brand($brandName)
	   	{
	   		$brandName=$this->fm->validation($brandName);// trong tbl_category : mình chỉ lấy catName thôi .Do catId nó tự tăng rồi
	   		$brandName=mysqli_real_escape_string($this->db->link,$brandName);

	   		if(empty($brandName)){
	   			 $alert="<span class='error'>Thương hiệu không được bỏ trống</span>";
	   			 return $alert;

	   		}
	   		else{

	   			$query="INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
	   			$result=$this->db->insert($query);
	   			if($result){
	   				// $alert="<span class='success'>Thêm thương hiệu thành công</span>";
	   				// return $alert;
	   				echo "<script type='text/javascript'>window.location.href = 'brandlist.php'</script>"; 

	   			}
	   			else{
	   				$alert="<span class='error'>Thêm thương hiệu thất bại</span> ";
	   				return $alert;
	   			}

	   			
	   			
	   		}

	   	}
	   	public function show_brand()
	   	{
	   		$query="SELECT * FROM tbl_brand order by brandID desc";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function getbrandbyId($id)
	   	{
	   		$query="SELECT * FROM tbl_brand WHERE brandId='$id'";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function update_brand($brandName,$id)
	   	{
	   		$brandName=$this->fm->validation($brandName);// trong tbl_category : mình chỉ lấy catName thôi .Do catId nó tự tăng rồi
	   		$brandName=mysqli_real_escape_string($this->db->link,$brandName);
	   		$id=mysqli_real_escape_string($this->db->link,$id);

	   		if(empty($brandName)){
	   			 $alert="<span class='error'>Thương hiệu không được bỏ trống</span>";
	   			 return $alert;

	   		}
	   		else{

	   			$query="UPDATE tbl_brand SET brandName='$brandName' WHERE brandId='$id'";
	   			$result=$this->db->update($query);
	   			if($result){
	   				// $alert="<span class='success'>Sửa thương hiệu thành công</span>";
	   				// return $alert;
	   				echo "<script type='text/javascript'>window.location.href = 'brandlist.php'</script>";

	   			}
	   			else{
	   				$alert="<span class='error'>Sửa thương hiệu thất bại</span> ";
	   				return $alert;
	   			}
	
	   		}
	   	}
	   	public function del_brand($id)
	   	{
	   		$query="DELETE  FROM tbl_brand WHERE brandId='$id'";
	   		$result=$this->db->delete($query);
	   		if($result){
	   				// $alert="<span class='success'>Xóa thương hiệu thành công</span>";
	   				// return $alert;
	   			echo "<script type='text/javascript'>window.location.href = 'brandlist.php'</script>";

	   			}
	   			else{
	   				$alert="<span class='error'>Xóa thương hiệu thất bại</span> ";
	   				return $alert;
	   			}
	   	}
       // front-end
	   	public function show_brand_frontend()
	   	{
	   		$query="SELECT * FROM tbl_brand order by brandId desc";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function get_product_by_brand($id)
	   	{
	   		$query="SELECT * FROM tbl_product WHERE brandId='$id' AND type='1' order by brandId desc";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}

	   	public function get_name_by_brand($id)
	   	{
	   		$query="SELECT tbl_product.*,tbl_brand.brandName,tbl_brand.brandId FROM tbl_brand,tbl_product  WHERE tbl_product.brandId=tbl_brand.brandId AND tbl_brand.brandId ='$id' LIMIT 1";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}

	   	// 	public function get_name_by_cart($id)
	   	// {
	   	// 	$query="SELECT tbl_product.*,tbl_category.catName,tbl_category.catId FROM tbl_category,tbl_product  WHERE tbl_product.catId=tbl_category.catId AND tbl_category.catId ='$id' LIMIT 1";
	   	// 	$result=$this->db->select($query);
	   	// 	return $result;
	   	// }
   }
 ?>