<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Select Stage</label>
            <select class="form-control select2" id="prstage" style="width: 100%;" >
            <option value="">Select Stage</option>
                <?php
                        include '../Inc/DBcon.php';
                        include '../script/functions.php';
                        $stage='';
                        $rswid='';
                        $stg=$_GET['stage'];
                         
                        $sql2="select * from project_phase;";
                        $result=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result) > 0 )
                        {
                            
                            while($row = mysqli_fetch_array($result))
                            {
                                if($stg==$row['ID'])
                                {
                                    echo '<option value="'.$row['ID'].'" selected>'.$row['short_name'].'</option>';

                                }
                                else
                                {
                                    echo '<option value="'.$row['ID'].'" >'.$row['short_name'].'</option>';
                                }
                                
                            }
                        }
                        mysqli_close($conn);

                    ?>
            </select>
            <input type="hidden" id="sproject" value="<?=$_GET['id'];?>">
            <input type="hidden" id="stage" value="<?=$_GET['stage'];?>">
        </div>
    </div>
  

    
</div>