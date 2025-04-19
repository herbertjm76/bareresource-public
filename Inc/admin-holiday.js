function HolidayList()
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('holiday-list').innerHTML=this.responseText;
            
        }
    };
    xmlhttp.open("GET","../script/holidaylist.php",true);
    xmlhttp.send();
}
function HolidayForm1(str)
{
    var pro=str.split("_");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('holiday-form').innerHTML=this.responseText;
            
        }
    };
    xmlhttp.open("GET","../script/holidayform.php?id="+pro[0]+"&week="+pro[1],true);
    xmlhttp.send();
}
function UpdateHoliday()
{
    var des=document.getElementById("des").value;
    var hours=document.getElementById("hours").value;
    var office=document.getElementById("office").value;
    var week=document.getElementById("week").value;
    var type=document.getElementById("type").value;
    if(des=="")
    {
        $("#des").focus();
        toastr["error"]("Please enter Holiday Description.");
          $("#des").addClass("is-invalid");
    }
    else if(hours=="")
    {
        $("#hours").focus();
        toastr["error"]("Please enter Holiday hours.");
          $("#hours").addClass("is-invalid");
    }
    else
    {
        var data = {Type:type,Des:des,Week:week,Office:office,Hours:hours};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](week+" Holidays Added.");
                            $("#des").removeClass("is-invalid");
                            $("#des").val("");
                            $("#hours").removeClass("is-invalid");
                            $("#hours").val("");    
                              activty();
                              $("#close-holiday").click()
                              HolidayList();
                         }
                         else
                         {
                            toastr["error"]("Failed to update Holidays.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/saveholiday.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function ClearHoliday(id)
{
    var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if(this.responseText==1)
                {
                    toastr["success"]("Holiday Removed.");
                    $("#close-holiday").click()
                   activty();
                   HolidayList();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove Holiday.");
                }
                }
            };
            xmlhttp.open("GET","../script/removeholiday.php?id="+id,true);
            xmlhttp.send();
}
function AddHoliday()
{
    var date=document.getElementById("reservation").value;
    var desc=document.getElementById("adesc").value;
    var olist="";
    var checkboxes = document.getElementsByClassName("stcheck");
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked == true) {
               
                olist+=checkboxes[i].value+" ";
            }
        }
        
    if(desc=="")
    {
        $("#adesc").focus();
        toastr["error"]("Please enter Holiday Description.");
          $("#adesc").addClass("is-invalid");
    }
 
    else if(date=="")
    {
        $("#reservation").focus();
        toastr["error"]("Please select date.");
          $("#reservation").addClass("is-invalid");
    }
    else if(olist=="")
    {
        
        toastr["error"]("Please select office.");
    }
    else
    {
        var data = {Date:date,Des:desc,Office:olist};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("New Holidays Added.");
                            $("#adesc").removeClass("is-invalid");
                            $("#adesc").val("");  
                              activty();
                              $("#close-holiday").click()
                              window.location.href="admin-holiday.php";
                         }
                         else
                         {
                            toastr["error"]("Failed to add Holidays.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/Newholiday.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function holidayform(id,date)
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('update-form').innerHTML=this.responseText;
            
            var pro=date.split(" - ");
        $('.up-date').daterangepicker({
        
            //   minDate:moment().startOf('isoWeek') ,
            //   maxDate:  moment().clone().weekday(5), 
                startDate: moment(pro[0]) ,
                endDate:  moment(pro[1]) ,
            }) ;
            }
    };
    xmlhttp.open("GET","../script/updateholidayform.php?id="+id,true);
    xmlhttp.send();
}
function UpdateHolidays()
{
    var date=document.getElementById("reservation1").value;
    var desc=document.getElementById("adesc1").value;
    var id=document.getElementById("id").value;
    var olist=document.getElementById("1office").value;
    
    if(desc=="")
    {
        $("#adesc").focus();
        toastr["error"]("Please enter Holiday Description.");
          $("#adesc").addClass("is-invalid");
    }
 
    else if(date=="")
    {
        $("#reservation").focus();
        toastr["error"]("Please select date.");
          $("#reservation").addClass("is-invalid");
    }
    else if(olist=="")
    {
        
        toastr["error"]("Please select office.");
    }
    else
    {
        var data = {ID:id,Date:date,Des:desc,Office:olist};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("Holidays Updated.");
                            $("#adesc").removeClass("is-invalid");
                            $("#adesc").val("");  
                              activty();
                              $("#close-holiday").click()
                              window.location.href="admin-holiday.php";
                         }
                         else
                         {
                            toastr["error"]("Failed to update Holidays.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/Updateholiday.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function Deleteholiday(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this Holiday?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Remove it!',
        
      }).then((isConfirmed) => {
        if (isConfirmed.value) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if(this.responseText==1)
                {
                    toastr["success"]("Holiday Removed.");
                   activty();
                   window.location.href="admin-holiday.php";
                }
                else
                {
                   toastr["error"]("Failed to remove holiday.");
                }
                }
            };
            xmlhttp.open("GET","../script/removeholidays.php?id="+id,true);
            xmlhttp.send();
        }
      });
}