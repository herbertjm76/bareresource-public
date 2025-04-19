<?php 
include 'functions.php';
$holiday=getHolidays($_GET['id']);
?>
<div class="form-group">
    <label class="required">Date range:</label>
    <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-calendar-alt"></i>
        </span>
        </div>
        <input type="text" class="form-control float-right up-date" id="reservation1">
    </div>
</div>
<div class="form-group">
    <label for="exampleInputEmail1" class="required">Description</label>
    <input type="text" class="form-control" id="adesc1" placeholder="Enter Description" value="<?=$holiday['description']?>" >
    <input type="hidden" class="form-control" id="id"  value="<?=$holiday['ID']?>" >
</div>
<label for="exampleInputEmail1" class="required">Office</label>
    <div class="row">
    <?php
        include '../Inc/DBcon.php';
        $sql2="select * from office;";
        $result=mysqli_query($conn,$sql2);
        if(mysqli_num_rows($result) > 0 )
        {   $i=0;
            while($row = mysqli_fetch_array($result))
            {
                    if($holiday['office_id']==$row['ID'])
                    {
                        echo '<div class="col-md-2"  >
                        <div class="form-check">
                            <input class="form-check-input stcheck" type="checkbox" value="'.$row['ID'].'" id="1office"  checked>
                            <label class="form-check-label">'.$row['code'].'</label>
                        </div>
                    </div> ';
                    }
                  
                    
                $i++;
            }
        }
        mysqli_close($conn);
    ?>
        <input type="hidden" id="aoffice" value="<?=$i;?>" >
    </div> 