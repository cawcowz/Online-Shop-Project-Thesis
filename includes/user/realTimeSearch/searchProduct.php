<?php 

if(isset($_POST['search'])){
    $search = $_POST['search'];
    
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system", 'root','');
    $query = "SELECT * FROM inventory_table WHERE product_name LIKE ? or brand like ? or discount like ? or category like ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array("%".$search."%","%".$search."%","%".$search."%","%".$search."%"));
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} ;?>
            <!-- Product container -->
            <div class="container mx-auto md:mt-36 mt-20 ">
                <h1 class='text-2xl mb-6 font-bold '>Search</h1>
                <div class='md:pl-10  '>
                    <div class="item-container text-left flex flex-wrap gap-2 justify-center md:justify-normal cursor-pointer ">
                <?php foreach( $datas as $data){?>
                <!-- Box 1 -->
                <div class="box shadow-lg w-[180px] md:w-[200px] border md:hover:border-red-500 md:hover:-translate-y-1 ease-in-out duration-300 flex flex-col justify-between">
                    <a href="ProductDes.php?id=<?php echo $data['Id'] ?>&uid=<?php echo $data['uniqid'] ?>&err-message=?">
                    <div>
                        <img name='image' src="../admin/admin.includes/uploads/<?php echo $data['image']; ?>" alt="" class='w-[200px] h-[230px] mx-auto'>
                    </div>
                    <div class="px-1 flex">
                        <h1 class="text-[13px] md:text-sm  " id="p_name"> <?php echo substr($data['product_name'],0,43);?>...</h1>  
                    </div>
                    <!-- Price and Cart -->
                    <div>
                        <?php $pdiscounted = intval($data['price']) - intval($data['discount']) ;?>
                            <?php if(intval($data['discount'] > 0)){?>
                                <span>
                                    <p  class='border border-red-500 bg-red-100 w-[100px]  text-center text-red-700 cursor-pointer text-[12px]'>₱<?php echo $data['discount'];?> off</p>
                                    <span class='line-through text-gray-500 text-md'>₱<?php echo $data['price'] ?></span> 
                                    <span class='text-red-500'>₱<?php echo $pdiscounted ?></span>
                                </span>
                            <?php }else{?>
                                <span>₱ <?php echo $data['price'] ?></span>
                            <?php }?>
                            <span><?php echo $data['sold']?> sold</span>
                        <div  class=" mt-2 rounded w-full bg-[#2e2e2e] p-3 text-center text-white hover:bg-[#d0011b] ease-in-out duration-300">
                            <a href="AddCart.php?pname=<?php echo $data['product_name']?>&p=<?php echo $data['price'];?>&img=<?php echo $data['image'];?>&uid=<?php echo $data['uniqid']?>&dis=<?php echo $data['discount'] ?>&cat=<?php echo $data['category']?>&stocks=<?php echo $data['stocks']?>">Add to cart</a>
                        </div>
                    </div>
                    </a>
                </div>
                <!-- Box End -->
                <?php };?>
            </div>
        </div>  
    </div>     
