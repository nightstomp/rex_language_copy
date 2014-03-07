<?php
    
  // Variablen
  $copy_language_content = trim(rex_post('copy_language_content', 'string', ''));
  $clang_a = rex_post('clang_a', 'int');
  $clang_b = rex_post('clang_b', 'int');

  $sync_fields = rex_post('meta_fields', 'array');

  if(isset($copy_language_content) && $copy_language_content != '')
  {
    if($clang_a !== $clang_b) {

      if(count($sync_fields) > 0) {


        $query = 'SELECT * FROM rex_article WHERE clang = ' . $clang_a . '';
        $db_conn = rex_sql::factory();
        $articles = $db_conn->getArray($query);
        //$db_conn->debugsql = 1;

        $field_count = count($sync_fields);
        foreach($articles as $a) {

          // Build where statement
          $where_statement = 'UPDATE rex_article SET ';

          $i = 1;
          foreach($sync_fields as $tfield){
            $where_statement .= $tfield . " = '" . $a[$tfield] . "'";

            if($field_count > 1 && $i < $field_count){
              $where_statement .= ", ";
            }

            $i++;
          }

          $where_statement .= ' WHERE clang = "'.$clang_b.'" AND id = "'.$a['id'].'" ';

          // run flush to clear memory
          $db_conn->flush();
          // set query
          $db_conn->setQuery($where_statement);

          // reset statement for next loop
          $where_statement = '';

          // clear cache
          rex_deleteCacheArticle($a['id'], $clang_b);
        }

        $message[] = rex_info($I18N_LC->msg('sync_finished_for') . " " . $REX['CLANG'][$clang_a] . " " .$I18N_LC->msg('to'). " " . $REX['CLANG'][$clang_b]);
        foreach($sync_fields as $tfield){
          // set successmessage
          $message[] = $I18N_LC->msg('field') . " <strong>" . $tfield . "</strong> " . $I18N_LC->msg('synced');
        }
        $message[] = "<br><strong>" . $I18N_LC->msg('cleared_cache') . "</strong>";

      } else {

        $message[] = rex_warning($I18N_LC->msg('no_fields_selected'));
      }

    } else {
      $message[] = rex_warning($I18N_LC->msg('error_double_language'));
    }

  }

?>