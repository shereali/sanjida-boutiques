
   <div class="col-md-12">
      <?php 
      $thisYr=date('Y');
      $lastYr=$thisYr - 1;
      $thisYrQ=$db->query("SELECT grand_total, txn_date FROM transactions WHERE YEAR(txn_date) ='{$thisYr}'");
      $lastYrQ=$db->query("SELECT grand_total, txn_date FROM transactions WHERE YEAR(txn_date) ='{$lastYr}'");
      $current=array();
      $last=array();
      $currentTotal=0;
      $lastTotal=0;
      while($x=mysqli_fetch_assoc($thisYrQ)){
         $month=date("m",strtotime($x['txn_date']));
         if (!array_key_exists($month,$current)) {
            $current[(int)$month]=$x['grand_total'];
         }
         else{
            $current[(int)$month] +=$x['grand_total'];
         }

         $currentTotal +=$x['grand_total'];
      }

      while($y=mysqli_fetch_assoc($lastYrQ)){
         $month=date("m",strtotime($y['txn_date']));
         if (!array_key_exists($month,$current)) {
            $last[(int)$month]=$y['grand_total'];

         }
         else{
            $last[(int)$month] +=$y['grand_total'];
         }

         $lastTotal +=$y['grand_total'];
      }


       ?>

       

       
   </div>

   <div class="col-md-4">
         <legend>Sales By Month</legend>
         <?=date("m-d-Y m:i:s");?>
         <table class="table table-bordered table-condensed table-striped">
            <thead>
               <tr>
                  <th></th>
                  <th><?=$lastYr;?></th>
                  <th><?=$thisYr;?></th>
               </tr>
            </thead>
            <tbody>
            <?php for($i=0; $i<=12; $i++):
            $dt=DateTime::createFromFormat('!m',$i);?>
               <tr <?=(date("m")==$i)?'class="info"':'';?>>
                  <td><?=$dt->format("F");?></td>
                  <td><?=(array_key_exists($i, $last))?money($last[$i]):money(0);?></td>
                  <td><?=(array_key_exists($i, $current))?money($current[$i]):money(0);?></td>
               </tr>
            <?php endfor; ?>
            <tr>
               <td>Total</td>
               <td><?=money($lastTotal);?></td>
               <td><?=money($currentTotal);?></td>
            </tr>
            </tbody>
         </table>
       </div>