<?php
  $message = array();
  include_once($REX['INCLUDE_PATH'].'/addons/rex_language_copy/functions/copy_meta.inc.php');
?>

  <div class="rex-addon">
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
      <?php
        }
      ?>

      <?php
        if(count($REX['CLANG'])>0)
        {
      ?>
        <form action="?page=rex_language_copy&amp;subpage=meta_copy&amp;clang=<?php echo $REX['CUR_CLANG']; ?>" method="post">
          <tr>
            <td style="width: 20%" valign="middle" align="left"><?php echo $I18N_LC->msg('meta_from_language'); ?></td>
            <td style="width: 15%" valign="middle" align="left">
              <select name="clang_a" size="1"  style="width:100px;" id="clang_a">
      <?php
        foreach($REX['CLANG'] as $k => $v)
        {
          echo '      
                      <option value="'.$k.'"';
          if(isset($clang_a) && $clang_a==$k)
            echo ' selected="selected"';

          echo '>'.$v.'</option>';
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
        foreach($REX['CLANG'] as $k => $v)
        {
          echo '      
                      <option value="'.$k.'"';
          if(isset($clang_b) && $clang_b==$k)
            echo ' selected="selected"';

          echo '>'.$v.'</option>';
        }
      ?>
              </select>
            </td>
            <td valign="middle" align="left">
              <?php echo $I18N_LC->msg('copy'); ?>
            </td>
          </tr>
    
          <tr>
            <td style="width: 20%" valign="middle" align="right">
              <?php echo $I18N_LC->msg('choose_meta'); ?>
            </td>
            <td colspan="5" valign="middle" align="left">
              <?php

                $qry_1 = 'SELECT * FROM `rex_62_params` WHERE name LIKE "%art_%"';
                $qry_2 = 'SELECT * FROM `rex_62_params` WHERE name LIKE "%cat_%"';

                $sql1 = rex_sql::factory();
                $fields_art = $sql1->getArray($qry_1);

                $sql2 = rex_sql::factory();
                $fields_cat = $sql2->getArray($qry_2);

                $count_size = (9 + count($fields_art) + count($fields_cat));

                $html_out = '';
                $html_out .= '<select name="meta_fields[]" size="'.$count_size.'" multiple="multiple" style="width: 100%">';
                $html_out .= '<optgroup label="'.$I18N_LC->msg('structure').'">';
                $html_out .= '  <option value="name">'.$I18N_LC->msg('art_name').'</option>';
                $html_out .= '  <option value="catname">'.$I18N_LC->msg('cat_name').'</option>';
                $html_out .= '  <option value="status">'.$I18N_LC->msg('status').'</option>';
                $html_out .= '  <option value="catprior">'.$I18N_LC->msg('catprior').'</option>';
                $html_out .= '  <option value="prior">'.$I18N_LC->msg('prior').'</option>';
                $html_out .= '  <option value="template_id">'.$I18N_LC->msg('template').'</option>';
                $html_out .= '</optgroup>';

                if($sql1->getRows()) {
                  $html_out .= '<optgroup label="'.$I18N_LC->msg('metadatas_art').'">';
                  foreach($fields_art as $field) {
                    $html_out .= '  <option value="'.$field['name'].'">'.$field['name'].'</option>';
                  }
                  $html_out .= '</optgroup>';
                }
                
                if($sql2->getRows()) {
                  $html_out .= '<optgroup label="'.$I18N_LC->msg('metadatas_cat').'">';
                  foreach($fields_cat as $field) {
                    $html_out .= '  <option value="'.$field['name'].'">'.$field['name'].'</option>';
                  }
                  $html_out .= '</optgroup>';
                }

                $html_out .= '</select>';
                echo $html_out;
              ?>
            </td>
          </tr>


          <tr>
            <td style="width: 20%" valign="top" align="right">
            </td>
            <td colspan="5" valign="top" align="left">
              <input type="submit" value="<?php echo $I18N_LC->msg('start'); ?>" name="copy_language_content" style="width:100px;" onclick="return confirmSubmit('<?php echo str_replace("'","\\'",$I18N_LC->msg('confirm_copy')); ?>',this);" />
         
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
