<?php
$Months = array("January", "February", "March","April","May","June","July","August","September","October","November","December");

///Staff Functions
function getUserStaff($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from staff where uid='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
function getManager($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from staff where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}

function countResource($pid)
{
    include '../Inc/DBcon.php';
    $sql2="select * from project_resource where pid='".$pid."' ;";
    $result2=mysqli_query($conn,$sql2);
    return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getduplicateResource($pid,$sid)
{
    include '../Inc/DBcon.php';
    $sql2="select * from project_resource where pid='".$pid."' AND staff_id='".$sid."' ;";
    $result2=mysqli_query($conn,$sql2);
    return mysqli_num_rows($result2);
    mysqli_close($conn);
}

/// Country Functions
function getCountry($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from country where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
/// Office Functions
function getOffice($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from office where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}

/// phase details

function gethours($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours FROM phase_details where project_id='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return 0;
    }
    mysqli_close($conn);
}
function getPhase($pid,$phase_id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from phase_details where project_id='".$pid."' AND phase_id='".$phase_id."'";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return 0;
    }
    mysqli_close($conn);
}
function getStage($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from project_phase where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
/// project details
function getProject($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from projects where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
function getProjectStageOfWeek($pid,$week)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from resource_stage where pid='".$pid."' And week='".$week."';";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
///Role
function getRole($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from role where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
///Job
function getJob($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from job where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
///Skill
function getSkill($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from skill where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
/// project Status
function getStatus($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from project_status where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}


function getWeeksNumbers($month, $year){
    $num_of_days = date("t", mktime(0,0,0,$month,1,$year)); 
    $lastday = date("t", mktime(0, 0, 0, $month, 1, $year)); 
    $no_of_weeks = 0; 
    $count_weeks = 0; 
    while($no_of_weeks < $lastday){ 
        $no_of_weeks += 7; 
        $count_weeks++; 
    } 
return $count_weeks;
} 

function getWeeks($year)
{
    $weeks=array();

$d=date("d-M-Y", strtotime("first Monday of ".$year."-01"));
  for($i=1; $i<=12;$i++)
  {
      $number = cal_days_in_month(CAL_GREGORIAN, $i, 2023);
      $j=1;
      for($j=1; $j<=$number;$j++)
          {
              $timestamp = strtotime($d);
              $a=date("D", $timestamp);
          if($a=="Mon" )
          {
           array_push($weeks,$d);

           }
            $d=date("d-M-Y",strtotime("+1 day", strtotime($d)));

       }
  }
  return $weeks;
}
function getWeeks2()
{
    $weeks=array();
    $d = date('d-M-Y', strtotime('first Monday of -1 month-01'));
//$d=date("d-M", strtotime("first Monday of ".$year."-01"));
  for($i=1; $i<=12;$i++)
  {
      $number = cal_days_in_month(CAL_GREGORIAN, $i, 2023);
      $j=1;
      for($j=1; $j<=$number;$j++)
          {
              $timestamp = strtotime($d);
              $a=date("D", $timestamp);
          if($a=="Mon" )
          {
           array_push($weeks,$d);

           }
            $d=date("d-M-Y",strtotime("+1 day", strtotime($d)));

       }
  }
  return $weeks;
}

/// project Rescourcing weeks
function getResourceWeekAll($pid,$staff_id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where pid='".$pid."' AND staff_id='".$staff_id."' ";
    $result2=mysqli_query($conn,$sql2);
    $hours=0;
    if(mysqli_num_rows($result2) > 0 )
    {
       while( $row2 = mysqli_fetch_array($result2))
       {
        $hours=$hours+$row2['hours'];
       }
        return $hours;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getResourceWeek($pid,$staff_id,$week)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where pid='".$pid."' AND staff_id='".$staff_id."' AND week='".$week."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getbudgetHours($pid)
{ 
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours from resource_weeks where pid='".$pid."' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getStaffHours($pid,$sid)
{ 
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours from resource_weeks where pid='".$pid."' AND staff_id='".$sid."' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getStaffProjectsCount($sid)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where staff_id='".$sid."' AND hours>'0' group by pid ; ";
    $result2=mysqli_query($conn,$sql2);
    return mysqli_num_rows($result2);
    mysqli_close($conn);
}
/// get project resource date
function getResourceStageWeek($pid,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_stage where pid='".$pid."'  AND week='".$week."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['stage_id'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getWeekStage($pid,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_stage where pid='".$pid."'  AND week='".$week."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getWeekFullStage($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_stage where ID='".$id."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getOfficeStaff($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff where office='".$id."' ";
    $result2=mysqli_query($conn,$sql2);
    return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getStaffSkills($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_skill where ID='".$id."'; ";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
function getCountSkillStaff($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_skill where skill_id='".$id."'; ";
    $result2=mysqli_query($conn,$sql2);
    return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getStaffJob($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_job where ID='".$id."'; ";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
function getOfficeHoliday($office,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from office_holidays where office_id='".$office."'  AND week='".$week."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getTotalOfficeHoliday($office)
{
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours from office_holidays where office_id='".$office."' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getOfficeHolidays($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from office_holidays where ID='".$id."' ";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    
    mysqli_close($conn);
}
function getStaffHoliday($staff,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_holiday where staff_id='".$staff."'  AND week='".$week."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getTotalStaffHoliday($staff)
{
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours from staff_holiday where staff_id='".$staff."' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getStaffWeeklyHoliday($staff,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_holiday where staff_id='".$staff."' AND week='".$week."' ; ";
    $result2=mysqli_query($conn,$sql2);
    $hours=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
        {
            $hours= $hours+$row2['hours'];
        }
        return $hours;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getStaffMonthlyHoliday($staff,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_holiday where staff_id='".$staff."' AND week like '%".$week."%' ; ";
    $result2=mysqli_query($conn,$sql2);
    $hours=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
        {
            $hours= $hours+$row2['hours'];
        }
        return $hours;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getOfficeWeeklyHoliday($office,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from office_holidays where office_id='".$office."' AND week='".$week."' ; ";
    $result2=mysqli_query($conn,$sql2);
    $hours=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
        {
            $hours= $hours+$row2['hours'];
        }
        return $hours;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getOfficeMonthlyHoliday($office,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from office_holidays where office_id='".$office."' AND week like '%".$week."%' ; ";
    $result2=mysqli_query($conn,$sql2);
    $hours=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
        {
            $hours= $hours+$row2['hours'];
        }
        return $hours;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getCurrentMonthLeavesOfStaff($sid,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select IFNULL(SUM(VACATION),0) as VACATION, IFNULL(SUM(GENERAL),0) AS GENERAL, IFNULL(SUM(MARKETING),0) AS MARKETING, IFNULL(SUM(TRAINING),0) AS TRAINING, IFNULL(SUM(OFFICE),0) AS OFFICE, IFNULL(SUM(MEDICAL),0) AS MEDICAL  from other_leave where week like '%".$week."%' AND staff_id='".$sid."'; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getStaffWeeklyWork($staff,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where staff_id='".$staff."' AND week='".$week."' and hours>'0' ; ";
    $result2=mysqli_query($conn,$sql2);
    $hours=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
        {
            $hours= $hours+$row2['hours'];
        }
        return $hours;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getProjectResource($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where ID='".$id."' ; ";
    $result2=mysqli_query($conn,$sql2);
    
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    mysqli_close($conn);
}
function getCurrentWeekProjectsOfStaff($sid,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where week='".$week."' AND staff_id='".$sid."' And hours>'0'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_num_rows($result2);
     return $row2;
    mysqli_close($conn);
}
function getCurrentWeekHoursOfStaff($sid,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours from resource_weeks where week='".$week."' AND staff_id='".$sid."'; ";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2['hours'];
    mysqli_close($conn);
}
function getCurrentmonthHoursOfStaff($sid,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select IFNULL(SUM(hours),0) AS hours from resource_weeks where week like '%".$week."%' AND staff_id='".$sid."'; ";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2['hours'];
    mysqli_close($conn);
}
function getCurrentWeekLeavesOfStaff($sid,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from other_leave where week='".$week."' AND staff_id='".$sid."'; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getBaliResourceProject($pid)
{
    include '../Inc/DBcon.php';
    $sql2="select * from project_resource where pid='".$pid."' AND staff_id in ( select ID from staff where office='4')  ; ";
    $result2=mysqli_query($conn,$sql2);
     return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getBaliAndHResourceProject($pid,$office)
{
    include '../Inc/DBcon.php';
    $sql2="select * from project_resource where pid='".$pid."' AND staff_id in ( select ID from staff where ".$office.")  ; ";
    $result2=mysqli_query($conn,$sql2);
     return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getProjectReview($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from project_review where ID='".$id."'; ";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
function getProjectLatestReview($pid)
{
    include '../Inc/DBcon.php';
    $sql2="select * from projects_update where pid='".$pid."' order by ID DESC; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getBaliProjects($pmid,$office)
{
    include '../Inc/DBcon.php';
    $sql2="select * from projects where manager_id='".$pmid."'; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
            $i=0;
        while($row2 = mysqli_fetch_array($result2))
        {
            $sql2="select * from project_resource where pid='".$row2['ID']."' AND staff_id in ( select ID from staff where ".$office."); ";
            $result3=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result3))
            {
                $i=$i+1;
            }
        }
       
    }
   
     return $i;
    mysqli_close($conn);
}
function getBaliProjectsByStage($sid,$manager,$office)
{
    include '../Inc/DBcon.php';
    $sql2="select * from projects where stage='".$sid."' AND ".$manager."; ";
    $result2=mysqli_query($conn,$sql2);
    $i=0;
    if(mysqli_num_rows($result2) > 0 )
    {
            
        while($row2 = mysqli_fetch_array($result2))
        {
            $sql2="select * from project_resource where pid='".$row2['ID']."' AND staff_id in ( select ID from staff where ".$office."); ";
            $result3=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result3))
            {
                $i=$i+1;
            }
        }
       
    }
     return $i;
    mysqli_close($conn);
}
function getProjectsByCountry($cid,$manger,$office)
{
    include '../Inc/DBcon.php';
    $sql2="select * from projects where country_id='".$cid."' AND ".$manger." ";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
           
        while($row2 = mysqli_fetch_array($result2))
        {
             if(getBaliAndHResourceProject($row2['ID'],$office))
             {
                $pro++;
             }
        }
       
    }
    return $pro;
    mysqli_close($conn);
}
function getLiveProjects($office)
{
    include '../Inc/DBcon.php';
    $sql2="select * from projects where status='1' AND ".$office."; ";
    $result2=mysqli_query($conn,$sql2);
     return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getResources($office)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff where status='1' AND ".$office."; ";
    $result2=mysqli_query($conn,$sql2);
     return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getAuthUser($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from users where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
function getProjectWeekHoursOfStaff($pid,$week,$staff)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where week='".$week."' AND staff_id='".$staff."' and pid='".$pid."' And hours>'0';";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return 0;
    }
    
    mysqli_close($conn);
}
function getWeekOfficeHoliday($office,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from office_holidays where office_id='".$office."'  AND week='".$week."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getMonthOfficeHoliday($office,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from office_holidays where office_id='".$office."'  AND week like '%".$week."%' ;";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
       {
        $pro+=$row2['hours'];
       }
    }
     
        return $pro;
    
    mysqli_close($conn);
}
function getProjectWeekHoursOfStaffOfficeOfWeek($week,$office)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where week='".$week."' AND staff_id in (select ID from staff where office= '".$office."') And hours>'0';";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
       while($row2 = mysqli_fetch_array($result2))
       {
        $pro+=$row2['hours'];
       }
        
    }
    return $pro;
    
    mysqli_close($conn);
}
function getProjectWeekHoursOfStaffOfficeOfMonth($week,$office)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where week like '%".$week."%' AND staff_id in (select ID from staff where office= '".$office."') And hours>'0';";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
       while($row2 = mysqli_fetch_array($result2))
       {
        $pro+=$row2['hours'];
       }
        
    }
    return $pro;
    
    mysqli_close($conn);
}
function getCurrentWeekHoursOfProject($pid,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours from resource_weeks where week='".$week."' AND pid='".$pid."'; ";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2['hours'];
    mysqli_close($conn);
}
function CheckYear($year)
{
    include '../Inc/DBcon.php';
    $sql2="select * from year where year='".$year."' ;";
    $result2=mysqli_query($conn,$sql2);
  
    return mysqli_num_rows($result2);
    
    mysqli_close($conn);
}
function InsertNewYear($year)
{
    include '../Inc/DBcon.php';
    $sql2="insert into year (year,status) values ('".$year."','1') ;";
    mysqli_query($conn,$sql2);
    mysqli_close($conn);
}
function getStaffAnulLeave($sid,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_holiday where week='".$week."' AND staff_id='".$sid."'; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
         return $row2['description'];
        }
    else{
        return '';
    }
    mysqli_close($conn);
}
function getResourceList($pid,$days,$office)
{
    include '../Inc/DBcon.php';
    $name='';
    $week='1=1';
    if($days==7)
    {
        $week=" week='".date('d-M-Y',strtotime('monday this week'))."'";
    }
    else if($days==30)
    {
        $week=" week like '%".date('M-Y')."'";
    }
    else{
       // $week="week like '%". date('M-Y', strtotime('+1 month'))."' AND week like '%". date('M-Y', strtotime('+2 month'))."' AND week like '%". date('M-Y', strtotime('+3 month'))."'";
        $week="week REGEXP '". date('M-Y')."|". date('M-Y', strtotime('+1 month'))."|". date('M-Y', strtotime('+2 month'))."' ";
    }
    $sql1="select * from staff where ".$office."; ";
    $result3=mysqli_query($conn,$sql1);
    if(mysqli_num_rows($result3) > 0 )
    {
       while($row3 = mysqli_fetch_array($result3))
       {
            $sql2="select * from resource_weeks where pid='".$pid."' AND staff_id='".$row3['ID']."' AND  ".$week."  group by staff_id; ";
            $result2=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result2) > 0 )
            {
                while($row2 = mysqli_fetch_array($result2))
                {
                    
                    if(strpos($name, getManager($row3['ID'])['nick_name']) == false)
                    {
                        $name.= getManager($row3['ID'])['nick_name'] ." , ";
                    }
                    
                }
            }
       }
          
    }
    
   return $name;
    mysqli_close($conn);
}
function getHolidays($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from holiday where ID='".$id."' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
         return $row2 ;
    }
    else{
        return '';
    }
    mysqli_close($conn);
}
function getAllResourceList($pid)
{
    include '../Inc/DBcon.php';
    $name='';
    $sql2="select * from project_resource where   pid='".$pid."'; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
       while($row2 = mysqli_fetch_array($result2))
       {
        $name.= getManager($row2['staff_id'])['nick_name'] .", ";
       }
          
    }
   return $name;
    mysqli_close($conn);
}

function CheckStage($pid,$sid)
{
    include '../Inc/DBcon.php';
    $sql2="select * from project_all_phase where pid='".$pid."' AND stage_id='".$sid."'; ";
    $result2=mysqli_query($conn,$sql2);
    return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getCurrentMonthOutstandingInvoices($date)
{
    include '../Inc/DBcon.php';
    $sql2="select * from phase_details where  status!='Paid' AND invoice_issued!=''    ";
    $result2=mysqli_query($conn,$sql2);
     return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getCurrentMonthInvoices($date)
{
    include '../Inc/DBcon.php';
    $sql2="select * from phase_details where billing_month='".$date."'   ";
    $result2=mysqli_query($conn,$sql2);
     return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getCurrentYearFee($id) 
{
    include '../Inc/DBcon.php';
    $sql2="select * from phase_details where project_id='".$id."'  ;";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
       {
        $pro+=$row2['budget'];
       }
    }
     
        return $pro;
    
    mysqli_close($conn);
}
function getBillingMonthFee($date,$id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from phase_details where project_id='".$id."' AND billing_month='".$date."'  ;";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
       {
        $pro=$row2['budget'];
       }
       return $pro;
    }
    else{
    return '';
    }
      
    
    mysqli_close($conn);
}
function getBillingMonthDetails($date,$id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from phase_details where project_id='".$id."' AND billing_month='".$date."'  ;";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        
       return $row2;
    }
    else{
    return '0';
    }
      
    
    mysqli_close($conn);
}
function Existproject($code)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from projects where code='".$code."'";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['ID'];
    }
    else
    {
        return '0';
    }
     
    mysqli_close($conn);
}
function getProjectDetails($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from project_details where pid='".$id."'  ;";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
         $row2 = mysqli_fetch_array($result2);
       return  $row2;
    }
    else{
    return '';
    }
      
    
    mysqli_close($conn);
}
function getBilling30Days($id)
{
    include '../Inc/DBcon.php';
    $sql2="SELECT * FROM phase_details
        WHERE 
    invoice_issued >=NOW() AND  invoice_issued  <= DATE_ADD(NOW(), INTERVAL 1 MONTH) AND project_id='".$id."' AND status!='Paid'  ;";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
       {
        $pro=$row2['budget'];
       }
       return $pro;
    }
    else{
    return '';
    }
      
    
    mysqli_close($conn);
}
function getBilling60Days($id)
{
    include '../Inc/DBcon.php';
    $sql2="SELECT * FROM phase_details
        WHERE 
        invoice_issued >=DATE_ADD(NOW(), INTERVAL 1 MONTH) AND invoice_issued <= DATE_ADD(NOW(), INTERVAL 2 MONTH) AND project_id='".$id."'   AND status!='Paid' ;";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
       {
        $pro=$row2['budget'];
       }
       return $pro;
    }
    else{
    return '';
    }
      
    
    mysqli_close($conn);
}
function getBilling90Days($id)
{
    include '../Inc/DBcon.php';
    $sql2="SELECT * FROM phase_details
        WHERE 
        invoice_issued >=DATE_ADD(NOW(), INTERVAL 2 MONTH) AND invoice_issued <= DATE_ADD(NOW(), INTERVAL 3 MONTH) AND project_id='".$id."'  AND status!='Paid'  ;";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
       {
        $pro=$row2['budget'];
       }
       return $pro;
    }
    else{
    return '';
    }
      
    
    mysqli_close($conn);
}
function getBilling120Days($id)
{
    include '../Inc/DBcon.php';
    $sql2="SELECT * FROM phase_details
        WHERE 
        invoice_issued >=DATE_ADD(NOW(), INTERVAL 3 MONTH)  AND project_id='".$id."'   AND status!='Paid' ;";
    $result2=mysqli_query($conn,$sql2);
    $pro=0;
    if(mysqli_num_rows($result2) > 0 )
    {
        while($row2 = mysqli_fetch_array($result2))
       {
        $pro=$row2['budget'];
       }
       return $pro;
    }
    else{
    return '';
    }
      
    
    mysqli_close($conn);
}
?>