<?php 

	   $filepath=realpath(dirname(__FILE__));

     include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
 ?>
<?php 
   /**
    * 
    */
   class category
   {
   	
   	    private $db;
   	    private $fm;
	   	public function __construct()
	   	{
	   		$this->db= new Database();
	   		$this->fm= new Format(); // nó chính là class Format trong thư mục helpers
	   	}
	   	public function insert_category($catName)
	   	{
	   		$catName=$this->fm->validation($catName);// trong tbl_category : mình chỉ lấy catName thôi .Do catId nó tự tăng rồi
	   		$catName=mysqli_real_escape_string($this->db->link,$catName);

	   		if(empty($catName)){
	   			 $alert="<span class='error'>Danh mục không được bỏ trống</span>";
	   			 return $alert;

	   		}
	   		else{

	   			$query="INSERT INTO tbl_category(catName) VALUES('$catName')";
	   			$result=$this->db->insert($query);
	   			if($result){
	   				// $alert="<span class='success'>Thêm danh mục thành công</span>";
	   				// return $alert;
	   				echo "<script type='text/javascript'>window.location.href = 'catlist.php'</script>";

	   			}
	   			else{
	   				$alert="<span class='error'>Thêm danh mục thất bại</span> ";
	   				return $alert;
	   			}

	   			
	   			
	   		}

	   	}
	   	public function show_category()
	   	{
	   		$query="SELECT * FROM tbl_category order by catId desc";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function getcatbyId($id)
	   	{
	   		$query="SELECT * FROM tbl_category WHERE catId='$id'";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function update_category($catName,$id)
	   	{
	   		$catName=$this->fm->validation($catName);// trong tbl_category : mình chỉ lấy catName thôi .Do catId nó tự tăng rồi
	   		$catName=mysqli_real_escape_string($this->db->link,$catName);
	   		$id=mysqli_real_escape_string($this->db->link,$id);

	   		if(empty($catName)){
	   			 $alert="<span class='error'>Danh mục không được bỏ trống</span>";
	   			 return $alert;

	   		}
	   		else{

	   			$query="UPDATE tbl_category SET catName='$catName' WHERE catId='$id'";
	   			$result=$this->db->update($query);
	   			if($result){
	   				// $alert="<span class='success'>Sửa danh mục thành công</span>";
	   				// return $alert;
	   				echo "<script type='text/javascript'>window.location.href = 'catlist.php'</script>";

	   			}
	   			else{
	   				$alert="<span class='error'>Sửa danh mục thất bại</span> ";
	   				return $alert;
	   			}
	
	   		}
	   	}
	   	public function del_category($id)
	   	{
	   		$query="DELETE  FROM tbl_category WHERE catId='$id'";
	   		$result=$this->db->delete($query);
	   		if($result){
	   				// $alert="<span class='success'>Xóa danh mục thành công</span>";
	   				// return $alert;
	   			echo "<script type='text/javascript'>window.location.href = 'catlist.php'</script>";

	   			}
	   			else{
	   				$alert="<span class='error'>Xóa danh mục thất bại</span> ";
	   				return $alert;
	   			}
	   	}

	   	// front-end
	   	public function show_category_frontend()
	   	{
	   		$query="SELECT * FROM tbl_category order by catId desc";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
	   	public function get_product_by_cart($id)
	   	{
	   		$query="SELECT * FROM tbl_product WHERE catId='$id' AND type='1' order by catId desc ";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}

	   	public function get_name_by_cart($id)
	   	{
	   		$query="SELECT tbl_product.*,tbl_category.catName,tbl_category.catId FROM tbl_category,tbl_product  WHERE tbl_product.catId=tbl_category.catId AND tbl_category.catId ='$id' LIMIT 1";
	   		$result=$this->db->select($query);
	   		return $result;
	   	}
   }
 ?>