<div class="container-fluid  padding-top-nav"></div>
    <div class="col-md-4">
      <div class="cart-block">
         <form class="role" action="<?php echo base_url();?>cart/update" method="post">
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
                    <td class="right"><strong>GH¢ <?php echo $this->cart->format_number($item['price']); ?></strong></td>
                  </tr>
                   <?php $i++; ?>
                 <?php endforeach; ?>
                 <tr>
                   <td></td>
                   <td class="right"><strong>Total</strong></td>
                   <td class="right"><strong>GHS<?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
                 </tr>
           </table>
           <br>
           <p>
             <button type="submit" name="button" class="btn btn-default">Update Cart</button>
             <a class="btn btn-default" href="<?php echo base_url();?>cart/emptyCart">Empty Cart</a>
           </p>
         </form>
      </div>

    </div>
<div class="col-md-8 col-xs-12">
 <div class="panel panel-default">
   <div class="panel-heading panel-heading-green">
     <h3 class="panel-title">
       Items in Your Cart
     </h3>
</div>
<div class="panel-body">
<?php if ($this->session->flashdata('error_with_mpower')): ?>
  <div class="alert alert-danger">
      <?php echo $this->session->flashdata('error_with_mpower');?>
  </div>
<?php endif; ?>
  <?php if ($this->cart->contents()): ?>
    <form role="form" id="form">
      <div class="form-group">
        <label for="">Mode of Payment</label>
        <select id="payment">
          <option value="0">Select Option</option>
          <option value="1">Pay on Delivery</option>
          <option value="2">Mobile Money</option>
        </select>
      </div>
    </form>
    <div class="pay_on_delivery">
      <form role="form" action="<?php echo base_url()?>cart/sendOnlyEmail" method="post">
        <table class="table table-striped">
          <tr>
            <td>Quantity</td>
            <td>Item Name</td>
            <td>Item Price</td>
          </tr>
          <?php $i= 0; ?>
          <?php foreach ($this->cart->contents() as $items): ?>
          <tr>
            <td><?php echo $items['qty']; ?></td>
            <td><?php echo $items['name']; ?></td>
            <td>GHS<?php echo $this->cart->format_number($items['price']); ?></td>
          </tr>
          <?php echo '<input type="hidden" name="items_name['.$i.']" value="'.$items['name'].'" />' ?>
          <?php echo '<input type="hidden" name="items_code['.$i.']" value="'.$items['id'].'" />' ?>
          <?php echo '<input type="hidden" name="items_qty['.$i.']" value="'.$items['qty'].'" />' ?>
          <?php $i++; ?>
          <?php endforeach; ?>
          <tr>
            <td></td>
            <td class="right"><strong>Shipping</strong></td>
            <td class="right">GHS<?php echo $this->config->item('shipping'); ?></td>
          </tr>
          <tr>
            <td></td>
            <td class="right"><strong>Total</strong></td>
            <td class="right">
              <strong>GHS
              <?php
              $total = $this->cart->format_number($this->cart->total()) + $this->config->item('shipping');
              echo $total ;
              ?>
            </strong></td>
          </tr>
        </table>
        <br>
        <?php if (!$this->session->userdata('logged_in')): ?>
           <p><em>You must log in to make purchase or join this platform if you have not registered</em></p>
          <?php else: ?>
            <p><button type="submit" name="submit" class="btn btn-primary">CheckOut</button></p>
        <?php endif; ?>
      </form>
      </div>
      <div class="mobile_money">
        <form role="form" action="<?php echo base_url()?>cart/process" method="post">
          <table class="table table-striped">
            <tr>
              <td>Quantity</td>
              <td>Item Name</td>
              <td>Item Price</td>
            </tr>
            <?php $i= 0; ?>
            <?php foreach ($this->cart->contents() as $items): ?>
            <tr>
              <td><?php echo $items['qty']; ?></td>
              <td><?php echo $items['name']; ?></td>
              <td>GHS<?php echo $this->cart->format_number($items['price']); ?></td>
            </tr>
            <?php echo '<input type="hidden" name="item_name['.$i.']" value="'.$items['name'].'" />' ?>
            <?php echo '<input type="hidden" name="item_code['.$i.']" value="'.$items['id'].'" />' ?>
            <?php echo '<input type="hidden" name="item_qty['.$i.']" value="'.$items['qty'].'" />' ?>
            <?php $i++; ?>
            <?php endforeach; ?>
            <tr>
              <td></td>
              <td class="right"><strong>Shipping</strong></td>
              <td class="right">GHS<?php echo $this->config->item('shipping'); ?></td>
            </tr>
            <tr>
              <td></td>
              <td class="right"><strong>Total</strong></td>
              <td class="right">
                <strong>GHS
                  <?php
                  $total = $this->cart->format_number($this->cart->total()) + $this->config->item('shipping');
                  echo $total ;
                  ?>
                </strong>
              </td>
            </tr>
          </table>
          <br>
          <?php if (!$this->session->userdata('logged_in')): ?>
             <p><em>You must log in to make purchase or join this platform if you have not registered</em></p>
            <?php else: ?>
              <h3>Shipping Info</h3>
              <div class="form-group">
              <label>Address 1</label>
              <input type="text" name="addresss" class="form-control">
              </div>
              <div class="form-group">
              <label>Address 2</label>
              <input type="text" name="address2" class="form-control">
              </div>
              <div class="form-group">
              <label>City1</label>
              <input type="text" name="city" class="form-control">
              </div>
              <div class="form-group">
              <label>State</label>
              <input type="text" name="state" class="form-control">
              </div>
              <div class="form-group">
              <label>ZipCode</label>
              <input type="text" name="zipcode" class="form-control">
              </div>
              <p><button type="submit" name="submit" class="btn btn-primary">CheckOut</button></p>
            <?php endif; ?>
        </form>
      </div>

  <?php else: ?>
    <p>You have not added any Item to the cart. Kindly shop for items</p>
<?php endif; ?>
</div>
</div>
</div>
</div>
</div><!-- /.container -->
<script type="text/javascript">
$(document).ready( function() {
      $('.alert').delay(4000).fadeOut();
      $('.pay_on_delivery').hide();
      $('.mobile_money').hide();
      $('#payment').change(function(){
      if($(this).val()==1){
              $('.pay_on_delivery').show();
              $('#form').hide();
      }
      if($(this).val()==2){
        $('.mobile_money').show();
        $('#form').hide();
      }
    });
  });
</script>
