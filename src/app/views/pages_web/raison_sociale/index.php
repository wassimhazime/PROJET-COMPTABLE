



<?php






 echo "<h1><center>".$title."</center></h1>";
 

 echo  $info ;

  
?>






<div class ="container">
    <div class="row">
        <div id="wtable" class="col-md-7 cadre " >
             <form action="#">
		<fieldset>
			<input type="text" name="search" value="" id="id_search" />
                        <span class="loading" style="display: none"><img src="<?php echo ROOTWEB ?>app/views/templete/image/loading.gif" alt="loading" width="80" height="80"/></span>
		</fieldset>
	</form>
            <table id="table_finde" class="table table-hover table-bordered scroll" >

<?php  echo  $table ;?>     


            </table>
            
            <div class="row ">
                <div class="col-md-10 col-md-offset-2">
                    <form class="form-inline">

                        <button type="submit" class="btn btn-default"> invitation</button>
                        <button type="submit" class="btn btn-default"> invitation</button>
                        <button type="submit" class="btn btn-default"> invitation</button>
                        <button type="submit" class="btn btn-default"> invitation</button>
                        <button type="submit" class="btn btn-default"> invitation</button>

                    </form>
                </div>    
            </div>
        </div>
        <div id="wform" class="col-md-4 col-md-offset-1 cadre">

            <form  action="#"  method='POST'  enctype="multipart/form-data">

                <?php
             echo  $form ;
                ?>
                <div class="form-group"> <label for="ok"> AJOUTER </label>            <input type="submit" name="ajout_data" class="btn btn-primary btn-lg" >
                    <label for="reset"> VIDE </label>            <input type="reset" name="reset"  class="btn btn-success btn-lg"></div> 
            </form>

        </div>


    </div>
</div>






