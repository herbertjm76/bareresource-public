<div class="table-responsive">
    <table id="example1" class="table table-bordered text-center ">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
            include '../Inc/DBcon.php';
            $sql2="select * from skill;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                $i=1;
                while($row = mysqli_fetch_array($result))
                {
                    echo '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['name'].'</td>
                    <td> 
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" '.($row['status']==1?'checked':'').' id="customSwitchS'.$row['ID'].'" onclick="SkillStatus(this.id,'.$row['ID'].')">
                            <label class="custom-control-label" id="customSwitchC'.$row['ID'].'l" for="customSwitchS'.$row['ID'].'"></label>
                        </div>
                    </td>
                    <td> 
                    <a href="javascript:void(0)"  onclick="LoadSkillForm('.$row['ID'].')" data-toggle="modal" data-target="#modal-skill"> <i class="nav-icon fas fa-edit text-secondary"></i></a> &nbsp;
                    <a href="javascript:void(0)"   onclick="deleteSkill('.$row['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i> </a> 
                
                    </td>
                </tr>';
                $i++;
                    
                }
            }
            mysqli_close($conn);
        ?>
        
        
    
        </tbody>
        
    </table>
</div>