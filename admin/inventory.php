<!-- inventory system -->
<?php $iQuery=$db->query("SELECT * FROM products WHERE deleted=0");
       $lowItems=array();
       while($product=mysqli_fetch_assoc($iQuery)){
         $item=array();
         $sizes=sizesToArray($product['sizes']);
         foreach($sizes as $size){
            if($size['quantity'] <= $size['threshold']){
            $cat=get_category($product['categories']);
            $item=array(
               'title'=>$product['title'],
               'size'=>$size['size'],
               'quantity'=>$size['quantity'],
               'threshold'=>$size['threshold'],
               'category'=>$cat['parent'].'~'.$cat['child'],

               );
            $lowItems[]=$item;
            }
         }
       }

        ?>
       <div class="col-md-8">
          <legend>Low Inventory</legend>
          <table class="table table-bordered table-condensed table-striped">
              <thead>
             <th>Products</th>
             <th>Category</th>
             <th>Size</th>
             <th>Quantity</th>
             <th>Threshold</th>
          </thead>
          <tbody>
          <?php foreach($lowItems as $item): ?>
             <tr <?=($item['quantity']==0)?'class="danger"':'';?>>
                <td><?=$item['title'];?></td>
                <td><?=$item['category'];?></td>
                <td><?=$item['size'];?></td>
                <td><?=$item['quantity'];?></td>
                <td><?=$item['threshold'];?></td>
             </tr>
<?php endforeach;?>
          </tbody>
          </table>
         
       </div>