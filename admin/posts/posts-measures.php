<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '2')) 
  {
    header('Location: index2.php');
  }else
  {
    $urledit = $_GET['editid'];
      $readEdit = read('posts', "WHERE id = '$urledit'");
     if (!$readEdit) 
      {
        header('Location: index2.php?exe=posts/posts');
      }else
      { 
	   $readMeasures = read('measures',"WHERE post_id = '$urledit'"); 
	   if($readMeasures)
	   { $message = "true";
	   	 header('Location: index2.php?exe=posts/posts-edit&editid='.$urledit.'&message='.$message);
		}    
        foreach ($readEdit as $postedit);
echo '<section class="span8">';
echo '<a href="index2.php?exe=posts/posts" title="Listar Produtos" class="pull-right btn btn-primary">Listar Produtos</a>';
echo '<a href="index2.php?exe=posts/posts-edit&editid='.$postedit['id'].'" title="Voltar" class="pull-right btn btn-danger">Voltar</a>';
    if (isset($_POST['sendForm'])) 
    {
        $f['measure']    = htmlspecialchars(mysql_real_escape_string($_POST['medidas']));        
                           
			if (in_array('', $f)) 
			{
			   echo '<span class="alert alert-info">Informe todos os Campos!</span>';
			}else
			{						
				$f['post_id'] = $urledit;
				if(!$readMeasures){			
				create('measures',$f);
				$_SESSION['return'] = '<span class="alert alert-success">Medida cadastrada com sucesso!</span>';
				header('Location: index2.php?exe=posts/posts-edit&editid='.$urledit);
				}
			 }     
			}elseif (!empty( $_SESSION['return'])) 
			{
			echo  $_SESSION['return'];
			unset( $_SESSION['return']);
			}
?>
    <form name="formulario" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
    <fieldset>
  	<legend>Cadastrar Medidas em :<strong class="alert alert-error"> <?php  echo $postedit['titulo']; ?></strong></legend> 
     <div class="control-group">    
    	<label class="control-label" for="medidas"><span>Medidas:</span></label>
    	<div class="controls">
        <textarea id="medidas" name="medidas" class="span4" rows="5"><?php if ($f['medidas']) {echo $f['medidas'];} ?></textarea>
        </div>
    </div>  
    <div class="control-group">
    <label class="control-label" for="sendForm"></label>
    <div class="controls">
    <input type="submit" value="Cadastrar" id="sendForm" name="sendForm" class="btn btn-success" />
    </div>
    </div>  
</fieldset>       
    </form>	
</section><!-- /bloco span8 -->
<?php }}}else{header('Location: ../index2.php');}?>