<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '2')) 
  {
      header('Location: index2.php');
  }else
  {
?>
<section class="span8"><!--bloco form-->
<a href="index2.php?exe=posts/posts" title="Listar Produtos" class="pull-right btn btn-primary" >Listar Produtos</a>
<?php
    if (isset($_POST['sendForm'])) 
    {
        
        $f['categoria'] = htmlspecialchars(mysql_real_escape_string($_POST['categoria'])); 				
                     
        if (in_array('', $f)) 
        {
           echo '<span class="alert alert-info">Informe uma categoria!</span>';
        }else
        {
            header('Location: index2.php?exe=posts/carroussel&postid='.$f['categoria']);     
           
        }
     
    }
?>
<form name="formulario" action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
<fieldset>
<legend>Cadastrar Imagens:</legend>    
	<div class="control-group">
    <label class="control-label" for="categoria"><span>Select:</span></label> 
    	<div class="controls">
        <select id="categoria" class="input-xlarge span4" name="categoria">
            <option value="" >Selecione o Menu desejado</option>
            <?php $readCAtegoriaPai =read('cat', "WHERE id_pai IS NULL AND tipo = 'menu'");
                  if (!$readCAtegoriaPai){echo '<option value="">Menu N&atilde;o cadastrado &nbsp;&nbsp;</option>';}
				  else{foreach ($readCAtegoriaPai as $pai):								
							  echo ' <option value="'.$pai['id'].'"';
									  if ($pai['id'] == $f['categoria']){echo 'selected ="selected"';} 
									  echo '>'.$pai['nome'].'</option>';						 
                    endforeach;
                 }?>            
        </select>
        </div>
    </div>    
    <div class="control-group">	  
      <label class="control-label" for="sendForm"></label>
    <div class="controls" id="sendForm">  
     <input type="submit" value="CONTINUAR" name="sendForm" class="btn btn-danger" />
    </div>
    </div>     
</fieldset>    
</form>	
</section><!--sapn8-->
<?php }}else{header('Location: ../index2.php');}?>