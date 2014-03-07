<?php
  $message = array();
  
  include_once($REX['INCLUDE_PATH'].'/addons/rex_language_copy/functions/copy.inc.php');

  include $REX['INCLUDE_PATH']."/layout/top.php";
?>
<script type="text/javascript">
<!--
  function confirmSubmit(text,form) {
    if(text!=undefined && form!=undefined)
    {
      check = confirm(text);
      if(check)
      {
        form.submit();
      }
      else
        return false;
    }
  }
//-->
</script>



  <br />
  <table style="width: 770px" cellpadding="0" cellspacing="0">
    <tr style="height: 30px">
       <td class="grey">&nbsp;&nbsp;<b class="head"><?= $REX['ADDON']['name']['rex_language_copy']; ?></b></td>
       <td rowspan="3" style="width: 153px"><img src="pics/logo.gif" alt="Das REDAXO Logo" title="REDAXO" style="width: 153px; height: 61px;"/></td>
    </tr>
      
    <tr style="height: 1px">
      <td></td>
    </tr>

    <tr style="height: 30px">
      <td class="grey" >
      </td>
    </tr>
  </table>

  <br />

  <table border=0 cellpadding=5 cellspacing=1 width=770>
  	<tr>
    	<th align="left" valign="top" colspan="6"><?= $I18N_LC->msg('language_select'); ?></th>
    </tr>
<?php
  if(count($message)>0)
  {
?>
    <tr>
      <td class="lgrey" colspan="6" valign="top" align="left">
<?php
    foreach($message as $m)
      echo '
        '.$m.'<br />';
?>
      </td>
    </tr>
    <tr style="height: 5px">
      <td colspan="6" style="height: 5px">&nbsp;</td>
    </tr>
<?php
  }
?>



<?php
  if(count($REX['CLANG'])>0)
  {
?>
    <form action="?page=rex_language_copy&amp;clang=<?= $REX['CUR_CLANG']; ?>" method="post">
<?php
  if(!isset($start_steps_at) || $start_steps_at<0)
  {
?>
      <tr>
        <td class="lgrey" style="width: 20%" valign="middle" align="left"><?= $I18N_LC->msg('content_from_language'); ?></td>
        <td class="lgrey" style="width: 15%" valign="middle" align="left">
          <select name="clang_a" size="1"  style="width:100px;" id="clang_a">
<?php
  foreach($REX['CLANG'] as $l)
  {
    echo '      
            <option value="'.key($REX['CLANG']).'"';
    if(isset($clang_a) && $clang_a==key($REX['CLANG']))
      echo ' selected="selected"';

    echo '>'.current($REX['CLANG']).'</option>';
    next($REX['CLANG']);
  }
?>
          </select>
        </td>
        <td class="lgrey" style="width: 15%" valign="middle" align="left">
          <?= $I18N_LC->msg('to_language'); ?>
        </td>
        <td class="lgrey" style="width: 15%" valign="middle" align="left">
          <select name="clang_b" size="1"  style="width:100px;" id="clang_b">
<?php
  foreach($REX['CLANG'] as $l)
  {
    echo '      
            <option value="'.key($REX['CLANG']).'"';
    if(isset($clang_b) && $clang_b==key($REX['CLANG']))
      echo ' selected="selected"';

    echo '>'.current($REX['CLANG']).'</option>';
    next($REX['CLANG']);
  }
?>
          </select>
        </td>
        <td class="lgrey" style="width: 15%" valign="middle" align="left">
          <?= $I18N_LC->msg('copy'); ?>
        </td>
        <td class="lgrey" style="width: 20%" valign="middle" align="left">
        </td>
      </tr>

      <tr>
        <td class="lgrey" style="width: 20%" valign="middle" align="right">
          <input type="checkbox" name="delete_old_content" <?php if(isset($delete_old_content) && $delete_old_content==true) echo ' checked="checked"'; ?> value="true" />
        </td>
        <td class="lgrey" colspan="5" valign="middle" align="left">
          <?= $I18N_LC->msg('delete_old_content'); ?>
        </td>
      </tr>

      <tr>
        <td class="lgrey" style="width: 20%" valign="middle" align="left">
          <select name="articles_per_step" size="1"  style="width:100%;" id="clang_b">
            <option value="0"<?= isset($articles_per_step) && $articles_per_step=='0' ? ' selected="selected"' : '' ?>><?= $I18N_LC->msg('all_at_once'); ?></option>
            <option value="1"<?= isset($articles_per_step) && $articles_per_step=='1' ? ' selected="selected"' : '' ?>>1</option>
            <option value="5"<?= isset($articles_per_step) && $articles_per_step=='5' ? ' selected="selected"' : '' ?>>5</option>
            <option value="10"<?= isset($articles_per_step) && $articles_per_step=='10' ? ' selected="selected"' : '' ?>>10</option>
            <option value="20"<?= isset($articles_per_step) && $articles_per_step=='20' ? ' selected="selected"' : '' ?>>20</option>
            <option value="50"<?= isset($articles_per_step) && $articles_per_step=='50' ? ' selected="selected"' : '' ?>>50</option>
          </select>
        </td>
        <td class="lgrey" colspan="5" valign="middle" align="left">
          <?= $I18N_LC->msg('articles_per_step'); ?>
        </td>
      </tr>
      <tr>
        <td class="lgrey" style="width: 20%" valign="top" align="right">
        </td>
        <td class="lgrey" colspan="5" valign="top" align="left">
          <input type="submit" value=" <?= $I18N_LC->msg('start'); ?>" name="copy_language_content" style="width:100px;" onclick="return confirmSubmit('<?= str_replace("'","\\'",$I18N_LC->msg('confirm_copy')); ?>',this);" />

<?php
  }
?>
<?php
  if(isset($start_steps_at) && $start_steps_at>0)
  {
?>
      <tr>
        <td class="lgrey" style="width: 20%" valign="top" align="right">
        </td>
        <td class="lgrey" colspan="5" valign="top" align="left">
          <input type="hidden" value="<?= strval($clang_a); ?>" name="clang_a" />
          <input type="hidden" value="<?= strval($clang_b); ?>" name="clang_b" />
          <input type="hidden" value="false" name="delete_old_content" />
          <input type="hidden" value="copy" name="copy_language_content" />
          <input type="hidden" value="<?= strval($articles_per_step); ?>" name="articles_per_step" />
          <input type="hidden" value="<?= strval($start_steps_at); ?>" name="start_steps_at" />
          <input type="submit" value=" <?= $I18N_LC->msg('continue'); ?>" name="continue_copy_language_content" style="width:100px;" />
<?php
  }
?>          
        </td>
      </tr>
    </form>
<?php
  }
  else
  {
?>
    <tr>
      <td class="lgrey" colspan="6" valign="top" align="left">
        <?= $I18N_LC->msg('no_languages'); ?>
      </td>
    </tr>
<?php
  }
?>
  </table>  

<?php
  include $REX['INCLUDE_PATH']."/layout/bottom.php";
?>
