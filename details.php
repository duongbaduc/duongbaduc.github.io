<?php 
   include "inc/header.php";
   // include "inc/slider.php";
 ?>
 <?php
    // if(isset($_GET['proid']) && $_GET['proid']!=NULL){
    //       $id=$_GET['proid'];
    //  }

     if(!isset($_GET['proid']) || $_GET['proid']==NULL){
     	 echo "<script>window.location='404.php'</script>";      
     }
     else{
     	 $id=$_GET['proid'];
     }

      if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
            
      		 $quantity=$_POST['quantity'];
             $AddtoCart=$ct->add_to_cart($quantity,$id);
     }
 		$customer_id=Session::get('customer_id');
     if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['compare'])){
            
      		 $productid=$_POST['productid'];
             $insertCompare=$product->insertCompare($productid,$customer_id);
     }

     if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['wishlist'])){
            
      		 $productid=$_POST['productid'];
             $insertWishlist=$product->insertWishlist($productid,$customer_id);
     }
 ?>
 <style>
 	
 	.mota{
    width: 1200px;
    /* height: 700px; */
    height: auto;
    /*border: 1px solid #e3d8d8;*/
    /* display: none; */
} 
.mt1{    
    padding: 10px 15px;
    color: gray;
    background-color: #efebeb87;
    
    display: inline-block;
    margin-left: 20px;
    border: 1px solid ;
    margin-top: 20px;
    cursor: pointer;

}   
.mt2{
    padding: 10px 15px;
    color: white;
    
    display: inline-block;
    margin-left: 20px;
    border: 1px solid;
    margin-top: 20px; 
    cursor: pointer;
    background-color: #c8c2c2;

 
}
._1mota{
    width: 1200px;
    /* height: 500px; */
    height: auto;
    /* border: 1px solid green; */
    display: flex;
    justify-content: space-between;
}
.motatrai{
    width: 300px;
    height: auto;
    /* border: 1px solid blue; */
    margin-left: 20px;
    margin-right: 10px;

}
.mt3{
    font-weight: bold;
    background-color: #efeff1;
    padding: 7px;
    /* display: inline-block; */
    display: block;
    /* margin-bottom: 7px; */
    /* padding-right: 132px; */
}
.mt4{
    font-weight: bold;
    /* background-color: #efeff1; */
    padding: 7px;
    display: inline-block;
    /* margin-bottom: 7px; */
    padding-right: 97px;
}
.mt5{
    width: 100%;
    height: 100%;
}
.tat{
    background: white;
}
.tat1{
    font-weight: normal;
    background: white;
}
.tat2{
    font-weight: normal;
}
.motagiua{
    width: 950px;
    height: auto;
    /* border: 1px solid orange; */
    margin-left: 10px;
    margin-right: 20px;

}
.motaphai{
    width: 450px;
    height: auto;
    /* border: 1px solid gray; */
    margin-right: 20px;

}
.baohanh{
    width: 600px;
    /* height: 700px; */
    height: auto;
    /*border: 1px solid #e3d8d8;*/
    display: none;
    
} 
._1phan{
    width: 800px;
     /*height: 500px; */
    height: auto;
    margin: auto;
    /* border: 1px solid red; */
    /* z-index: 4; */
    /* position: relative; */
}
.bh1{
    font-weight: bold;
    display: block;
    font-size: 18px;
    margin-top: 10px;
    /* margin-left: 20px; */
    margin-bottom: 10px;
}
.square{
    margin-left: 30px;
    line-height: 23px;
}


 </style>
 <div class="main">
    <div class="content">
    	<div class="section group">
	    		<?php 
	    			$get_product_details=$product->get_details($id);
	    			if($get_product_details){
	    				while ($result_details=$get_product_details->fetch_assoc()) {
	    					
	    			
	    		 ?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['image'] ?> " alt=""/>
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName'];?> </h2>
					<p><?php echo $fm->textShorten($result_details['product_desc'],500) ?> </p>		<!-- lay ra 300 ki tu	 -->		
					<div class="price">
						<p>Giá : <span><?php echo $fm->format_currency($result_details['price'])." "."VNĐ" ?></span></p>
						<p>Danh Mục: <span><?php echo $result_details['catName'];?></span></p>
						<p>Thương Hiệu:<span><?php echo $result_details['brandName'];?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Thêm Vào Giỏ"/>
					</form>		
					<?php
 						if(isset($AddtoCart)){

 							 echo "<span style='color:red;font-size:18px'>Sản phẩm này đã được thêm vào giỏ hàng rồi</span>";
 							// echo $AddtoCart;
 						}
 						

					?>		
				</div>
				<div class="add-cart">
					<!-- <form action="" method="post">
						<input type="hidden" class="buysubmit" name="productid" value="<?php echo $result_details['productId']?>"/>

						 <?php 
					   		$login_check=Session::get('customer_login');
				  					if($login_check){
				  						// echo '<input type="submit" class="buysubmit" name="compare" value="Compare Product"/>'.' ';
				  					} 
				  					else{
				  						echo '';
				  					}
					    ?>
					    <br>
						<?php 
							if(isset($insertCompare)){
								echo $insertCompare;
							}
						?>
					</form> -->
							<!-- Save to WishList -->
					<form action="" method="post">
						
						<input type="hidden" class="buysubmit" name="productid" value="<?php echo $result_details['productId']?>"/>
						 <?php 
					   		$login_check=Session::get('customer_login');
				  					if($login_check){
				  						
				  						echo '<input type="submit" class="buysubmit" name="wishlist" value="Yêu Thích"/>';
				  					} 
				  					else{
				  						echo '';
				  					}
					    ?>
					    <br>
						<?php 
							if(isset($insertWishlist)){
								echo $insertWishlist;
							}
						?>
					</form>
				</div>
			</div>
			
			<div class="clear"></div>
			<div class="product_desc">
				<!-- <h2>Thông Tin Sản Phẩm</h2> -->
				<!-- <p><?php echo $fm->textShorten($result_details['product_desc'],300) ?> </p> -->
				  <span class="mt1" id="moTa" onclick="onmota()">Mô tả</span>
                 <span class="mt2" id="BaoHanh" onclick="onbaohanh()">Chết độ bảo hành </span>
            <div class="mota" id="motanhe">
                  <div class="_1mota" >
                        <div class="motatrai ">
                            <span class="mt3 ">Thương Hiệu</span>  
                            <span class="mt3 tat">Số Hiệu Sản Phẩm</span>  
                            <span class="mt3">Xuất Xứ</span>   
                            <span class="mt3 tat">Giới Tính</span>   
                            <span class="mt3">Kính</span>   
                            <span class="mt3 tat">Máy</span>  
                            <span class="mt3 ">Bảo Hành Quốc Tế</span>  
                            <span class="mt3 tat">Bảo Hành Tại Hải Triều</span>  
                            <span class="mt3 ">Đường Kính Mặt Số</span>  
                            <span class="mt3 tat">Bề Dày Mặt Số</span>   
                            <span class="mt3 ">Niềng</span>   
                            <span class="mt3 tat">Dây Đeo</span>   
                            <span class="mt3 ">Màu Mặt Số</span>   
                            <span class="mt3 tat">Chống Nước</span>  
                            <span class="mt3 ">Chức Năng</span>   

                        </div>
                        <div class="motagiua ">
                            <span class="mt3 tat2">	<?php echo $result_details['brandName'];?></span>  
                                
                            <span class="mt3 tat1 tat2"><?php echo $result_details['sohieusanpham'];?></span>  
                            <span class="mt3  tat2">	<?php echo $result_details['xuatxu'];?></span>   
                            <span class="mt3 tat1">	<?php echo $result_details['gioitinh'];?></span>   
                            <span class="mt3  tat2">	<?php echo $result_details['kinh'];?></span>   
                            <span class="mt3 tat1">	<?php echo $result_details['may'];?></span>  
                            <span class="mt3  tat2">	<?php echo $result_details['baohanhquocte'];?></span>  
                            <span class="mt3 tat1">	<?php echo $result_details['baohanhcuahang'];?></span>  
                            <span class="mt3  tat2">	<?php echo $result_details['duongkinhmatso'];?></span>  
                            <span class="mt3 tat1">	<?php echo $result_details['bedaymatso'];?></span>   
                            <span class="mt3  tat2 ">	<?php echo $result_details['nieng'];?></span>   
                            <span class="mt3 tat1">	<?php echo $result_details['daydeo'];?></span>   
                            <span class="mt3  tat2">		<?php echo $result_details['maumatso'];?></span>  
                                
                            <span class="mt3 tat1">	 	<?php echo $result_details['chongnuoc'];?></span>  
                               
                            <span class="mt3 tat2">	<?php echo $result_details['chucnangkhac'];?></span> 
                      </div>
                      <div class="motaphai">
                        <!-- <img src="images./mota2-2.jpg" alt="ảnh nguyệt" class="mt5"><br> -->

                      </div>
                   </div>
                  
             </div>
             <div class="baohanh" id="baohanhnhe">
                <div class="_1phan ">

                    <span class="bh1">Chế Độ Bảo Hành Tất cả các đồng hồ khi bán 
                        ra đều kèm theo 2 phiếu bảo hành:</span>
                    <div class="square">
                         <ul type="square">
                        <li >1 Phiếu Bảo Hành (hoặc Thẻ Bảo Hành/Sổ Bảo Hành) của hãng có giá trị bảo hành Quốc tế(
                            Thời gian bảo hành tùy theo quy định của từng hãng).</li>
                        <li>1 Phiếu Bảo Hành của Hải Triều (Sử dụng để được thay pin miễn phí vĩnh viễn
                             & Hưởng chế độ bảo hành tăng thêm từ 1-4 năm của Hải Triều).</li>
                        </ul>
                    </div>
                    <span class="bh1">Ví dụ: Đồng Hồ Citizen có chế độ bảo hành chính hãng: máy = 12 tháng, Pin = 12 tháng.</span>
                    <div class="square">
                         <ul type="square">
                        <li >Khi mua tại Hải Triều, Khách hàng sẽ được tặng thêm thời gian bảo hành từ 4 năm về máy. Pin = Vĩnh Viễn.</li>
                        <li>Tổng cộng: Khi mua tại Hải Triều, đồng hồ Citizen sẽ được bảo hành máy = 05 năm, Pin = Vĩnh Viễn.</li>
                        </ul>
                    </div>
                    <span class="bh1">Lưu ý:</span>
                    <div class="square">
                         <ul type="square">
                        <li >Đối với sản phẩm còn trong thời gian bảo hành Quốc Tế: Quý khách 
                            có thể đem tới Hải Triều hoặc bất kỳ nhà trung tâm bảo hành nào của hãng được 
                            ghi trên phiếu để yêu cầu được kiểm tra đồng hồ.</li>
                        <li>Đối với sản phẩm hết thời gian bảo hành Quốc Tế nhưng vẫn trong 
                            thời gian bảo hành tại Hải Triều: Quý khách đem đồng hồ kèm Phiếu Bảo Hành 
                            của Hải Triều tới bất kỳ chi nhánh nào của 
                            Hải Triều để được hướng dẫn và kiểm tra đồng hồ.</li>
                        </ul>
                    </div>
                    <span class="bh1">Điều Kiện Được Bảo Hành</span>
                    <div class="square">
                         <ul type="square">
                        <li >Bảo hành chỉ có giá trị khi đồng hồ có Phiếu bảo hành của hãng
                             & Phiếu bảo hành của Hải Triều đi kèm, điền chính xác, đầy đủ các thông tin.</li>
                        <li>Phiếu bảo hành phải còn nguyên vẹn, không rách, chấp vá, hoen ố, mờ nhạt.</li>
                        <li>Còn trong thời gian bảo hành. Thời gian bảo hành được tính từ ngày mua có ghi trên Phiếu Bảo Hành.</li>
                        <li>Chỉ bảo hành thay thế mới cho những linh kiện, phụ tùng bị hỏng – không thay thế bằng một chiếc đồng hồ khác.</li>
                        </ul>
                    </div>
                    <span class="bh1">Điều Kiện Không Được Bảo Hành</span>
                    <div class="square">
                         <ul type="square">
                        <li >Đồng hồ không có Phiếu bảo hành của hãng và Phiếu bảo hành của Hải Triều đi kèm.</li>
                        <li>Các loại dây đeo, khoá, vỏ, màu xi, mặt số, mặt kiếng bị hỏng hóc, vỡ do sử dụng không đúng, tai nạn, lão hóa tự nhiên, va đập, … trong quá trình sử dụng.</li>
                        <li>Hỏng hóc do hậu quả gián tiếp của việc sử dụng sai hướng dẫn của hãng có kèm theo đồng hồ</li>
                        <li>Trầy xước về dây hoặc mặt kiếng bị trầy xước, vỡ do va chạm trong quá trình sử dụng. </li>
                        <li>Tự ý thay đổi máy móc bên trong, mở ra can thiệp sửa chữa trong thời gian còn bảo hành – Tại những nơi không phải là trung tâm của hãng   </li>
                     
                        </ul>
                    </div>
                    <span class="bh1">Chế Độ Bảo Hành RED GUARANTEE</span>
                    <div class="square">
                         <ul type="square">
                        <li >Tăng thêm 1-2 năm bảo hành tại Hải Triều ngoài chế độ bảo hành Quốc Tế của hãng để có tổng thời gian là 4 năm.</li>
                        <li>Ưu tiên bảo hành – Đồng hồ sẽ được xếp vào danh sách ưu tiên bảo hành để nhanh chóng quay lại với Quý khách.</li>
                        <li>Giao nhận đồng hồ bảo hành ngay tại nhà Quý khách.</li>
                        <li>Cập nhật tình trạng đồng hồ qua điện thoại tới Quý khách. Quý khách được tư vấn, cập nhật tình trạng đồng hồ trong quá trình đồng hồ được bảo hành. </li>
                        <li>4 năm đánh bóng đồng hồ miễn phí </li>
                     
                        </ul>
                    </div>
                    <span class="bh1">Chính Sách Đổi Hàng </span>
                    <div class="square">
                         <ul type="square">
                        <li >Trong vòng 7 ngày kể từ ngày mua hàng từ Đồng Hồ Hải Triều, Quý khách có thể yêu cầu đổi hàng hoàn toàn miễn phí. Thời hạn 7 ngày được tính theo dấu bưu điện khi Quý khách gửi sản phẩm về cho chúng tôi
                             hoặc thời gian chúng tôi tiếp nhận yêu cầu trực tiếp (tại cửa hàng) của Quý khách.</li>
                        <li>Yêu cầu đổi hàng cần được thực hiện trong vòng 7 ngày kể từ ngày Quý khách nhận được hàng..</li>
                        <li>Sản phẩm không có dấu hiệu đã qua sử dụng (còn đầy đủ keo dán bảo vệ chống trầy xước mặt đồng hồ, nắp đáy, dây..)</li>
                        <li>Sản phẩm không bị dây bẩn, trầy xước, hư hỏng, dính hoá chất hoặc có dấu hiệu cạy mở. </li>
                        <li>Các bộ phận, linh kiện, phụ kiện, tài liệu hướng dẫn sử dụng, tài liệu kỹ thuật, quà tặng kèm theo (nếu có), …   </li>
                        <li>Hộp đựng, bao bì đóng gói sản phẩm còn nguyên vẹn, không bị móp, rách, ố vàng, …  </li>
                        <li>Chỉ chấp nhận đổi 1 lần duy nhất tính từ ngày mua sản phẩm.  </li>
                     
                        </ul>
                    </div>

                </div>
            </div>
	        </div>
				
	    </div>
	            <?php 
	            		}

	    			}
	             ?>

				<div class="rightsidebar span_3_of_1">
					<h2>Danh Mục Sản Phẩm</h2>
					<ul>
						<?php 
							$getall_category=$cat->show_category_frontend(); // lấy lại cái hàm show_category() mà mình đã tạo trước đó
							if($getall_category){
								while ($result_allcat=$getall_category->fetch_assoc()) {
									# code...
							
						 ?>
				      <li><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName']?></a></li>
				      <?php 
				      	       }

							}
				       ?>
				      
    				</ul>

    	
 				</div>
 				<div class="rightsidebar span_3_of_1">
 					<h2>Thương Hiệu Sản Phẩm</h2>
 					<ul>
				<?php 
					$getall_brand=$brand->show_brand_frontend(); // lấy lại cái hàm show_category() mà mình đã tạo trước đó
					if($getall_brand){
						while ($result_allbrand=$getall_brand->fetch_assoc()) {
							# code...
					
				 ?>
		      			<li>
		      				<a href="productbybrand.php?brandid=<?php echo $result_allbrand['brandId'] ?>"><?php echo $result_allbrand['brandName']?></a>
		      			</li>
		         <?php 
		      	       }

					}
		         ?>
		      
			</ul>
 				</div>


 		</div>
 	</div>

	<?php 
   include "inc/footer.php";  
 ?>


