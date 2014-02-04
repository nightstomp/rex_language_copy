<?php
  $message = array();

  include_once($REX['INCLUDE_PATH'].'/addons/language_copy/functions/copy.inc.php');

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
  <div class="rex-addon">
    <div id="rex-title">
      <div class="rex-title-row"><h1><?php echo $REX['ADDON']['name']['language_copy']; ?></h1></div>
      <div class="rex-title-row">
      </div>
    </div>

    <br />

    <table class="rex-table">
      <thead>
        <tr>
          <th class="rex-icon">&nbsp;</th>
          <th colspan="6"><?php echo $I18N_LC->msg('language_select'); ?></th>
        </tr>
      </thead>
      <tbody>
<?php
  if(count($message)>0)
  {
?>
        <tr>
          <td colspan="6" valign="top" align="left">
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
        <form action="?page=language_copy&amp;clang=<?php echo $REX['CUR_CLANG']; ?>" method="post">
<?php
  if(!isset($start_steps_at) || $start_steps_at<0)
  {
?>
          <tr>
            <td style="width: 20%" valign="middle" align="left"><?php echo $I18N_LC->msg('content_from_language'); ?></td>
            <td style="width: 15%" valign="middle" align="left">
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
            <td style="width: 15%" valign="middle" align="left">
              <?php echo $I18N_LC->msg('to_language'); ?>
            </td>
            <td style="width: 15%" valign="middle" align="left">
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
            <td style="width: 15%" valign="middle" align="left">
              <?php echo $I18N_LC->msg('copy'); ?>
            </td>
            <td style="width: 20%" valign="middle" align="left">
            </td>
          </tr>
    
          <tr>
            <td style="width: 20%" valign="middle" align="right">
              <input type="checkbox" name="delete_old_content" <?php if(isset($delete_old_content) && $delete_old_content==true) echo ' checked="checked"'; ?> value="true" />
            </td>
            <td colspan="5" valign="middle" align="left">
              <?php echo $I18N_LC->msg('delete_old_content'); ?>
            </td>
          </tr>

          <tr>
            <td style="width: 20%" valign="middle" align="left">
              <select name="articles_per_step" size="1"  style="width:100%;" id="clang_b">
                <option value="0"<?php echo isset($articles_per_step) && $articles_per_step=='0' ? ' selected="selected"' : '' ?>><?php echo $I18N_LC->msg('all_at_once'); ?></option>
                <option value="1"<?php echo isset($articles_per_step) && $articles_per_step=='1' ? ' selected="selected"' : '' ?>>1</option>
                <option value="5"<?php echo isset($articles_per_step) && $articles_per_step=='5' ? ' selected="selected"' : '' ?>>5</option>
                <option value="10"<?php echo isset($articles_per_step) && $articles_per_step=='10' ? ' selected="selected"' : '' ?>>10</option>
                <option value="20"<?php echo isset($articles_per_step) && $articles_per_step=='20' ? ' selected="selected"' : '' ?>>20</option>
                <option value="50"<?php echo isset($articles_per_step) && $articles_per_step=='50' ? ' selected="selected"' : '' ?>>50</option>
              </select>
            </td>
            <td colspan="5" valign="middle" align="left">
              <?php echo $I18N_LC->msg('articles_per_step'); ?>
            </td>
          </tr>
          <tr>
            <td style="width: 20%" valign="top" align="right">
            </td>
            <td colspan="5" valign="top" align="left">
              <input type="submit" value=" <?php echo $I18N_LC->msg('start'); ?>" name="copy_language_content" style="width:100px;" onclick="return confirmSubmit('<?php echo str_replace("'","\\'",$I18N_LC->msg('confirm_copy')); ?>',this);" />

<?php
  }
?>
<?php
  if(isset($start_steps_at) && $start_steps_at>0)
  {
?>
          <tr>
            <td style="width: 20%" valign="top" align="right">
            </td>
            <td colspan="5" valign="top" align="left">
              <input type="hidden" value="<?php echo strval($clang_a); ?>" name="clang_a" />
              <input type="hidden" value="<?php echo strval($clang_b); ?>" name="clang_b" />
              <input type="hidden" value="false" name="delete_old_content" />
              <input type="hidden" value="copy" name="copy_language_content" />
              <input type="hidden" value="<?php echo strval($articles_per_step); ?>" name="articles_per_step" />
              <input type="hidden" value="<?php echo strval($start_steps_at); ?>" name="start_steps_at" />
              <input type="submit" value=" <?php echo $I18N_LC->msg('continue'); ?>" name="continue_copy_language_content" style="width:100px;" />
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
            <?php echo $I18N_LC->msg('no_languages'); ?>
          </td>
        </tr>
<?php
  }
?>
      </tbody>
    </table>
  </div>
<?php
  include $REX['INCLUDE_PATH']."/layout/bottom.php";
?>
