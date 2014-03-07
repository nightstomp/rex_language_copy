<?php

  // need rex_copyContent
  include_once('include/functions/function_rex_content.inc.php');

  if(isset($_POST['copy_language_content']) && trim($_POST['copy_language_content'])!='')
  {
    $clang_a = intval(trim($_POST['clang_a']));
    $clang_b = intval(trim($_POST['clang_b']));
    
    if($clang_a!=$clang_b)
    {
      if($clang_a >= 0 && $clang_a < count($REX['CLANG']) && 
         $clang_b >= 0 && $clang_b < count($REX['CLANG']) )
      {
        $clang_a = strval($clang_a);
        $clang_b = strval($clang_b);
        
        $sql = new sql;
      
        $delete_old_content = trim($_POST['delete_old_content']);
        if($delete_old_content=='true')
          $delete_old_content = true;
        else
          $delete_old_content = false;
          
        if($delete_old_content)
        {
          // Delete old article slices
          $qry = "DELETE FROM `".$REX['TABLE_PREFIX']."article_slice` WHERE `clang`='".$clang_b."'";
          $sql->setQuery($qry);
          $message[] = $I18N_LC->msg('slices_deleted').'<br />';
        }
        
        // should the copying be made stepwise?
        
        if(isset($_POST['articles_per_step']))
          $articles_per_step = intval(trim($_POST['articles_per_step']));
        else
          $articles_per_step = 0;
          
        if($articles_per_step>0)
        {
          if(isset($_POST['start_steps_at']))
            $start_steps_at = intval(trim($_POST['start_steps_at']));
          else
            $start_steps_at = 0;
            
          $limit = ' LIMIT '.strval($start_steps_at).','.strval($articles_per_step);
        }
        else
          $limit = '';
        
        // Get the number of articles
        $qry = "SELECT COUNT(*) FROM `".$REX['TABLE_PREFIX']."article` WHERE `clang`='".$clang_a."'";
        $sql->setQuery($qry);
        $number_of_articles = $sql->get_array();
        $number_of_articles = $number_of_articles[0]['COUNT(*)'];

        // Get the ids of all articles of language clang_a
        $qry = "SELECT `id`, `clang`, `name` FROM `".$REX['TABLE_PREFIX']."article` WHERE `clang`='".$clang_a."'".$limit;
        $sql->setQuery($qry);

        $articles = $sql->get_array();
    
        // now copy the content of each article one by one
        if(count($articles)>0)
        {
          foreach($articles as $article)
          {
            rex_copyContent($article['id'],$article['id'],$clang_a,$clang_b);
            $message[] = $I18N_LC->msg('content_copied',$article['name'],$article['id'],$REX['CLANG'][$clang_a],$REX['CLANG'][$clang_b]);
          }
          
          $steps_to_do = $number_of_articles - ($start_steps_at+$articles_per_step);
          
          // if the number of articles is lower than the number of steps, this is the last step
          if(count($articles)<$articles_per_step || $articles_per_step==0 || $steps_to_do<=0)
          {
            $start_steps_at=-1;
            $message[] = '<br />'.$I18N_LC->msg('all_steps_finished').'<br />';
          }
          else
          {
            if($articles_per_step>1)
            {
              $message[] = '<br />'.$I18N_LC->msg('steps_finished',strval($start_steps_at+1),strval($start_steps_at+$articles_per_step));
            
            }

            $message[] = $I18N_LC->msg('steps_to_do',strval(strval($steps_to_do))).'<br />';
            $start_steps_at+=$articles_per_step; // otherwise set the start_steps_at-Variable
          }

        }
        else
          $start_steps_at=-1;

      }
      else
        $message[] = $I18N_LC->msg('error_wrong_languages').'<br />';
    }
    else
      $message[] = $I18N_LC->msg('error_double_language').'<br />';
  }
?>