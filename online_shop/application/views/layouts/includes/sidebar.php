  <div class="cart-block">
     <form class="role" action="<?php echo base_url();?>users/register" method="post">
       <table  cellpadding='6'cellspacing='1' style="width:100%" border="0">
           <tr>
             <th>QTY</th>
             <th>Item Description</th>
             <th>Item Price</th>
           </tr>
             <?php $i = 1; ?>
             <?php foreach ($this->cart->contents() as $item): ?>
                <input type="hidden" name="<?php echo $i.'[rowid]';?>" value="<?php echo $item['rowid'];?>">
              <tr>
                <td class="right">
                  <input style="color:black" type="text" name="<?php echo $i.'[qty]';?>" value="<?php echo $item['qty'];?>" maxlength="3" size="1">
                </td>
                <td class="right"><?php echo $item['name'] ?></td>
                <td class="right"><strong>$ <?php echo $this->cart->format_number($item['price']); ?></strong></td>
              </tr>
               <?php $i++; ?>
             <?php endforeach; ?>
             <tr>
               <td></td>
               <td class="right"><strong>Total</strong></td>
               <td class="right"><strong>$ <?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
             </tr>
       </table>
       <br>
       <p>
         <button type="submit" name="button" class="btn btn-default">Update Cart</button>
         <a class="btn btn-default" href="<?php echo base_url();?>cart/emptyCart">Empty Cart</a>
         <a class="btn btn-default" href="<?php echo base_url();?>cart/">Go To Cart</a>
       </p>
     </form>
  </div>
  <div class="panel panel-default panel-list">
   <div class="panel-heading panel-heading-dark">
     <h3 class="panel-title">
       Categories
     </h3>
   </div>
   <ul class="list-group">
     <li class="list-group-item"><a href="<?php echo base_url()?>">All Products</a></li>
     <?php foreach (get_categories_h() as $categories): ?>
       <li class="list-group-item"><a href="<?php echo base_url()?>products/category/<?php echo$categories->id?>"><?php echo  $categories->name ?></a></li>
     <?php endforeach; ?>
   </ul>
</div>
<div class="panel panel-default panel-list">
   <div class="panel-heading panel-heading-dark">
     <h3 class="panel-title">
       Most Popular
     </h3>
   </div>
   <ul class="list-group">
     <?php foreach (get_popular_h() as $popular): ?>
       <li class="list-group-item"><a href="<?php echo base_url()?>products/details/<?php echo$popular->id?>"><?php echo $popular->title ?></a></li>
     <?php endforeach; ?>
   </ul>
</div>
