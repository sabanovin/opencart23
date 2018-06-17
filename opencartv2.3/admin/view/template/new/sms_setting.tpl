<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-customer" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo "ویرایش ماژول"; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-customer" class="form-horizontal">
         <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo "تب عمومی "; ?></a></li>
            <li><a href="#tab-simple" data-toggle="tab"><?php echo "تب وب سرویس نمونه"; ?></a></li>
            <li><a href="#tab-test" data-toggle="tab"><?php echo "تب تست"; ?></a></li>
          
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
<div class="table-responsive">
    <table class="table table-tbody">
      <tr>
        
</tr>
<tr>
         <td align="right"><?php echo $entry_status; ?></td>
       <td align="right"><select name="sms_status">
            <?php if ($sms_status) { ?>
            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
            <option value="0"><?php echo $text_disabled; ?></option>
            <?php } else { ?>
            <option value="1"><?php echo $text_enabled; ?></option>
            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
            <?php } ?>
          </select></td>
      </tr>
         <tr  style="display: none">

         <td align="right"><?php echo $entry_samane_sms; ?></td>
       <td align="right"><select name="sms_samane_sms">
                          
                  
				<option value="sabanovin" selected="selected"><?php echo "سامانه پیامکی"; ?></option>
                                
           
          </select></td>
      </tr>

<p class="help"><b><?php echo $text_information; ?></b></p>
 

      <tr>
        <td width="25%"><?php echo $text_number; ?></td>
        <td><input type="text" name="sms_from" value="<?php echo $sms_from; ?>" size="20" /></td>
      </tr>
      <tr>
        <td width="25%"><?php echo "api code"; ?></td>
        <td><input type="text" name="sms_api" value="<?php echo $sms_api; ?>" size="20" /></td>

      </tr>
      
    </table>
 
<p class="help"><b><?php echo $text_moshtari; ?></b></p>

<div style="border: 1px; gray solid; background: white; padding: 5px;">
<span class="help"><?php echo $text_tozih_kar; ?><br />
<?php echo $text_shop; ?><br />
<?php echo $text_url; ?><br />
<?php echo $text_email; ?><br />
<?php echo $text_name; ?><br />
<?php echo "#customer_tel# = شماره تماس کاربر"; ?><br />
<?php echo $text_orderid; ?><br />
<?php echo $text_ip; ?><br />
<?php echo "#order_pro# = که شامل نام کالا تعداد و قیمت کالاست"; ?><br />

<?php echo "#order_total# = قیمت کل خرید"; ?><br />
<?php echo "#order_rah# = شماره پیگیری (این کد میتواند شامل کد رهگیری پستی در در خرید پستی یا کد تراکنش در خرید آنلاین بانکی باشد)"; ?><br />
<?php echo $text_status_order; ?><br /><br />





<div>خط جدید = #nl#
</div>

<h2><?php echo $text_send; ?></h2>
	
    <table class="table table-tbody">
      <tr>

        <td><input type="checkbox" name="sms_smssignup" <?php if($sms_smssignup=='1') echo "checked"; ?> value="1"/> <?php echo $text_send_ok; ?>
         
          
	<br />
	<textarea style="width: 320px; height: 80px; font-size: 10px;" id="t1" name="sms_smssignup_txt"><?php echo $sms_smssignup_txt; ?></textarea>
	<br /><span class="help" style="clear:both;  "><a href='#' onclick="document.getElementById('t1').value=document.getElementById('t1v').innerHTML; return false;"><?php echo $text_copy; ?></a><br /><div id="t1v"><?php echo $text_sample_reg; ?></div></span>

	<br />
	</td>
      </tr>
      <tr>
       
        <td><input type="checkbox" name="sms_smslogin"   <?php if($sms_smslogin=='1') echo "checked"; ?> value="1" /><?php echo $text_login_ok; ?>
           
 
	<br />
	<textarea id="t2" style="width: 320px; height: 80px; font-size: 10px;" name="sms_smslogin_txt"><?php echo $sms_smslogin_txt; ?></textarea>
	<br /><span class="help" style="clear:both;  "><a href='#' onclick="document.getElementById('t2').value=document.getElementById('t2v').innerHTML; return false;"><?php echo $text_copy; ?></a><br /><div id="t2v"><?php echo $text_wellcom; ?></div>&nbsp;</span>

	<br />
	</td>
      </tr>
      <tr>
        <td><input name="sms_smslogout" type="checkbox"   <?php if($sms_smslogout=='1') echo "checked"; ?> value="1" /> <?php echo $text_logout_ok; ?>
        
	<br />
	<textarea id="t3" style="width: 320px; height: 80px; font-size: 10px;"  name="sms_smslogout_txt"><?php echo $sms_smslogout_txt; ?></textarea>
	<br /><span class="help" style="clear:both;  "><a href='#' onclick="document.getElementById('t3').value=document.getElementById('t3v').innerHTML; return false;"><?php echo $text_copy; ?></a><br /><div id="t3v"><?php echo $text_sample_logout; ?></div>&nbsp;</span>

	<br />
	</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="sms_smsplaced"  <?php if($sms_smsplaced=='1') echo "checked"; ?> value="1" /> ارسال SMS ثبت شدن سفارش مشتری:
        
	<br />
	<textarea id="t4" style="width: 320px; height: 80px; font-size: 10px;"  name="sms_smsplaced_txt"><?php echo $sms_smsplaced_txt; ?></textarea>
	<br /><span class="help" style="clear:both;  "><a href='#' onclick="document.getElementById('t4').value=document.getElementById('t4v').innerHTML; return false;"><?php echo $text_copy; ?></a><br /><div id="t4v"><?php echo "سفارش شما ثبت شد و بزودی پردازش می شود. شماره سفارش: #orderid# .سفارش شما شامل #order_pro# 
قیمت نهایی #order_total#"; ?></div>&nbsp;</span>

	<br />
	</td>
      </tr>
    
          <tr>
        <td><input type="checkbox" name="sms_smsproccessed"   <?php if($sms_smsproccessed=='1') echo "checked"; ?> value="1"/> <?php echo $text_order_complate; ?>
	<br />
	<textarea id="t5" style="width: 320px; height: 80px; font-size: 10px;"  name="sms_smsproccessed_txt"><?php echo $sms_smsproccessed_txt; ?></textarea>
	<br /><span class="help" style="clear:both;  "><a href='#' onclick="document.getElementById('t5').value=document.getElementById('t5v').innerHTML; return false;"><?php echo $text_copy; ?></a><br /><div id="t5v"><?php echo $text_sample_sms_smsproccessed; ?></div>&nbsp;</span>

	<br />
	</td>
      </tr>
    </table>

<p class="help"><b><?php echo $text_admin_sms; ?></b></p>
    <table class="form">
      <tr>
        <td><input type="checkbox" name="sms_smsnewsignup"   <?php if($sms_smsnewsignup=='1') echo "checked"; ?> value="1" /> <?php echo $text_user_reg; ?>
	<br />

	<textarea id="t6" style="width: 320px; height: 80px; font-size: 10px;"  name="sms_smsnewsignup_txt"><?php echo $sms_smsnewsignup_txt; ?></textarea>
	<br /><span class="help" style="clear:both;  "><a href='#' onclick="document.getElementById('t6').value=document.getElementById('t6v').innerHTML; return false;"><?php echo $text_copy; ?></a><br /><div id="t6v"><?php echo $text_sample_user_reg; ?></div>&nbsp;</span>
	</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="sms_smsneworder"  <?php if($sms_smsneworder=='1') echo "checked"; ?> value="1" /> <?php echo $text_user_order ; ?>
	<br />

	<textarea id="t7" style="width: 320px; height: 80px; font-size: 10px;"  name="sms_smsneworder_txt"><?php echo $sms_smsneworder_txt; ?></textarea>
	<br /><span class="help" style="clear:both; "><a href='#' onclick="document.getElementById('t7').value=document.getElementById('t7v').innerHTML; return false;"><?php echo $text_copy; ?></a><br /><div id="t7v"><?php echo "کاربری با نام #name# و شماره تماس #customer_tel#  سفارشی با محصولات زیر ثبت کرده است #nl#
#order_pro# 
قیمت نهایی #order_total#"; ?></div>&nbsp;</span>
	</td>
      </tr>
      
          <tr>
        <td><input type="checkbox" name="sms_smsnewfish" <?php if($sms_smsnewfish=='1') echo "checked";   ?> value="1" /> <?php echo $text_user_fish; ?>
	<br />

	<textarea id="t9" style="width: 320px; height: 80px; font-size: 10px;"  name="sms_smsnewfish_txt"><?php echo $sms_smsnewfish_txt; ?></textarea>
	<br /><span class="help" style="clear:both; "><a href='#' onclick="document.getElementById('t9').value=document.getElementById('t9v').innerHTML; return false;"><?php echo $text_copy; ?></a><br /><div id="t9v"><?php echo $text_sample_user_fish; ?></div>&nbsp;</span>
	</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="sms_smsadminlogin" <?php if($sms_smsadminlogin=='1') echo "checked";   ?>  value="1" /><?php echo $text_admin_login; ?>
	<br />

	<textarea id="t8" style="width: 320px; height: 80px; font-size: 10px;"  name="sms_smsadminlogin_txt"><?php echo $sms_smsadminlogin_txt; ?></textarea>
	<br /><span class="help" style="clear:both; "><a href='#' onclick="document.getElementById('t8').value=document.getElementById('t8v').innerHTML; return false;"><?php echo $text_copy; ?></a><br /><div id="t8v"><?php echo $text_sample_admin_login; ?></div>&nbsp;</span>
	</td>
      </tr>
    </table>

<p class="help"><b><?php echo $text_oder_setting; ?></b></p>
    <table class="form">

      <tr>
        <td>
	<?php echo $text_admin_num; ?> <input style="text-align: left; direction: ltr;" type="text" name="sms_shopnum" value="<?php echo $sms_shopnum; ?>" size="25" />
	</td>
    </tr>
    <tr>
     <td>	<?php echo $text_admin_pul; ?> <b><?php echo $sms_credit; ?></b>

	</td>
      </tr>
    </table>
    </div>
     </div>
     </div>
 <div class="tab-pane" id="tab-simple">
  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description"><?php echo "نمونه کد اتصال به وب سرویس"; ?></label>
                    <div class="col-sm-10">
                      <textarea cols="100" rows="12"  name="sms_sample" placeholder="" id="input-description" style="text-align:left"><?php echo isset($sms_sample) ? $sms_sample : ''; ?></textarea>
                    </div>
                  </div>

</div>
 <div class="tab-pane" id="tab-test">
 <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description"><?php echo "شماره تلفن جهت تست"; ?></label>
                    <div class="col-sm-3">
                     <input name="teltest" value="" />
                    </div>
                    <label class="col-sm-2 control-label" for="input-description"><?php echo "متن پیام"; ?></label>
                    <div class="col-sm-3">
                     <input name="message" value="" />
                    </div>
                      <div class="col-sm-2">
                    <button type="button" onclick="testwebservice()" id="btn" data-toggle="tooltip" title="تست وب سرویس" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
                    </div>
                  </div>

</div>
      
   </div>    
</form>
    </div>
    </div>
  </div>
<script type="text/javascript"><!--
 function testwebservice() {
   
   $.ajax({
          type: 'post',
		dataType: 'json',
		url: 'index.php?route=new/sms_setting/testsms&token=<?php echo $token; ?>',
		data: $('#tab-test :input'),
		beforeSend: function() {
			
			$('#btn').before('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" />&nbsp;&nbsp;<?php echo "صبر کنید"; ?></div>');
		},
				
		success: function(json) {
			if (json['alert']) {
				alert(json['alert']);
		
			}
			
		
			}
		});
 
 }
//--></script> 
  <script type="text/javascript"><!--

$('#input-description').summernote({height: 300});

//--></script>
<?php echo $footer; ?>