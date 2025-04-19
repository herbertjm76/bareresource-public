function projectslist()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('project-list').innerHTML=this.responseText;
            $("#example1").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,"pageLength": 100,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                scrollX:true,
                fixedColumns: {
                    leftColumns: 12
                },
          
                paging: false,
                scrollCollapse: true,
                fixedHeader: true,
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
              $('.DTFC_LeftBodyWrapper').css('margin-top',"-14px");
        }
    };
    xmlhttp.open("GET","../script/projectlist.php",true);
    xmlhttp.send();
}
projectslist();
function clearform()
{
    $("#code").removeClass("is-invalid");
    $("#name").removeClass("is-invalid");
    $("#profit").removeClass("is-invalid");
    $("#rate").removeClass("is-invalid");
}
function NewProject()
{
    clearform();
   // var a = $(".stcheck:checkbox").filter(":checked");
    var olist="";
    var checkboxes = document.getElementsByClassName("stcheck");
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked == true) {
               
                olist+=checkboxes[i].value+" ";
            }
        }
    var code=document.getElementById("code").value;
    var name=document.getElementById("name").value;
    var manager=document.getElementById("manager").value;
    var country=document.getElementById("country").value;
    var profit=document.getElementById("profit").value;
    var rate=document.getElementById("rate").value;
    var stage=olist;
    var status=document.getElementById("status").value;
    var office=document.getElementById("office").value;
    var deadline=document.getElementById("deadline").value;
   
	 if(code=="" )
     {
        $('#code').focus();
        toastr["error"]("Please enter project code.");
        
          $("#code").addClass("is-invalid");

     }
     else if(name==""){
        $('#name').focus();
        toastr["error"]("Please enter project name.");
        
          $("#name").addClass("is-invalid");
     }
     else if(manager==""){
      
        toastr["error"]("Please select project manager.");
          
     }
     else if(country==""){
        
        toastr["error"]("Please select project country.");
      
     }
     else if(profit==""){
        $('#profit').focus();
        toastr["error"]("Please enter project profit.");
          $("#profit").addClass("is-invalid");
     }
     else if(rate==""){
        $('#rate').focus();
        toastr["error"]("Please enter project AVG Rate.");
          $("#rate").addClass("is-invalid");
     }
     else if(stage==undefined){
        
        toastr["error"]("Please select project stage");
       
     }
     else if(status==""){
         
        toastr["error"]("Please select project status");
        
     }
     else if(office==""){
       
        toastr["error"]("Please select project office");
           
     }
     else
     
    {
        var data = {  Code:code,Name:name,Pm:manager,Country:country,Profit:profit,Rate:rate,Stage:stage,Status:status,Office:office,Deadline:deadline };
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("New project created.");
                              //projectslist();   
                              activty();
                              $("#code").val("");
                             $("#name").val("");
                             $("#rate").val("");
                             $("#profit").val("");
                             $('#add-project-close2').click();
                             window.location.href="project-list.php";
                         }
                         else
                         {
                            toastr["error"]("Failed to create new project.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/newproject.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function deleteProject(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this Project?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        
      }).then((isConfirmed) => {
        if (isConfirmed.value) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if(this.responseText==1)
                {
                    toastr["success"]("Project deleted.");
                    projectslist(); 
                   activty();
                }
                else
                {
                  
                   toastr["error"]("Failed to delete project.");
                }
                }
            };
            xmlhttp.open("GET","../script/deleteproject.php?id="+id,true);
            xmlhttp.send();
        }
      });
}

function getproject(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('project-update-form').innerHTML=this.responseText;
         
        }
    };
    xmlhttp.open("GET","../script/projectedit.php?id="+id,true);
    xmlhttp.send();
}
function UpdateProject()
{
    clearform();
    //var a = $(".stcheck:checkbox").filter(":checked");
    var olist="";
    var checkboxes = document.getElementsByClassName("stcheck1");
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked == true) {
               
                olist+=checkboxes[i].value+" ";
            }
        }
    var code=document.getElementById("code1").value;
    var name=document.getElementById("name1").value;
    var manager=document.getElementById("manager1").value;
    var country=document.getElementById("country1").value;
    var profit=document.getElementById("profit1").value;
    var rate=document.getElementById("rate1").value;
    var stage=olist;
    var status=document.getElementById("status1").value;
    var office=document.getElementById("office1").value;
    var id=document.getElementById("id").value;
    var deadline=document.getElementById("deadline2").value;
	 if(code=="" )
     {
        $('#code').focus();
        toastr["error"]("Please enter project code.");
        
          $("#code").addClass("is-invalid");

     }
     else if(name==""){
        $('#name').focus();
        toastr["error"]("Please enter project name.");
        
          $("#name").addClass("is-invalid");
     }
     else if(manager==""){
      
        toastr["error"]("Please select project manager.");
          
     }
     else if(country==""){
        
        toastr["error"]("Please select project country.");
      
     }
     else if(profit==""){
        $('#profit').focus();
        toastr["error"]("Please enter project profit.");
          $("#profit").addClass("is-invalid");
     }
     else if(rate==""){
        $('#rate').focus();
        toastr["error"]("Please enter project AVG Rate.");
          $("#rate").addClass("is-invalid");
     }
     else if(stage==undefined){
        
        toastr["error"]("Please select project stage");
       
     }
     else if(status==""){
         
        toastr["error"]("Please select project status");
        
     }
     else if(office==""){
       
        toastr["error"]("Please select project office");
           
     }
     else
     
    {
        var data = {ID:id,  Code:code,Name:name,Pm:manager,Country:country,Profit:profit,Rate:rate,Stage:stage,Status:status,Office:office,Deadline:deadline };
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                  {
                    toastr["success"]("project updated.");
                      projectslist();   
                      activty();
                    $('#add-project-close').click();
                     window.location.href="project-list.php";
                  }
                  else
                  {
                    toastr["error"]("Failed to update project.");
                  }
                }
            };
 
            xmlhttp.open("POST","../script/updateproject.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function calcHours(stage)
{
    var profit=document.getElementById("profit1").value;
    var rate=document.getElementById("rate1").value;
    var budget=document.getElementById(stage+"budget").value;
    var hours=budget/rate*(100-profit);
  
     document.getElementById(stage+"hours").value=Math.round(hours/100);
}
function UpdateStage(stid,pid)
{
    var title=document.getElementById(stid+"title").innerHTML;
    var budget=document.getElementById(stid+"budget").value;
    var hours=document.getElementById(stid+"hours").value;
    var bmonth=document.getElementById(stid+"billing-month").value;
    var instatus=document.getElementById(stid+"invoice-status").value
    var inissued=document.getElementById(stid+"invoice-issued").value
    
    if(budget=="")
    {
        $('#'+stid+"budget").focus();
        toastr["error"]("Please enter project "+title+" Budget.");
          $("#"+stid+"budget").addClass("is-invalid");
    }
     else
     {
        var data = {Pid:pid,  Sid:stid,Budget:budget,Hours:hours,Phase:title,Bmonth:bmonth,Istatus:instatus,Iissued:inissued};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](title+" Fee, Hours, Invoice details Updated.");
                              projectslist();   
                              activty();
                            
                         }
                         else
                         {
                            toastr["error"]("Failed to update phase details.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/updatephase.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
     }
    
}
function SetFilter(id,value)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
             projectslist();
        }
    };
    xmlhttp.open("GET","../script/setfilter.php?value="+value+"&id="+id,true);
    xmlhttp.send();
}
function ClearFilter()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        $('#foffice').val("all").trigger('change.select2');
        $('#fregion').val("all").trigger('change.select2');
        $('#fmanager').val("all").trigger('change.select2');
        $('#fstatus').val("all").trigger('change.select2');
        $('#fstage').val("all").trigger('change.select2');
      
             projectslist();
        }
    };
    xmlhttp.open("GET","../script/clearfilter.php",true);
    xmlhttp.send();
}
function CalculateAVG()
{
  var value=0;
  var staff=0;
  $("#avg-calculator input").each(function(){
    var input = $(this);
    if(input.val()!="")
    {
      staff=staff+Number(input.val());
      value+=input.attr('rate')*input.val();
    }
    });
     var avg=value/staff;
     $('#avgrate').val(avg.toFixed(2));
}
function ClearAVG()
{
  $("#avg-calculator input").each(function(){
    var input = $(this);
    input.val('');

    });
    $('#avgrate').val('');
}
function StageBoxes(id)
{
  //$('.stcheck').not('#'+id).prop('checked', false);
}
function StageForm(str)
{
    var pro=str.split("_");
    //document.getElementById('sweek').value=pro[1];
    //document.getElementById('sproject').value=pro[0];
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('stage-form').innerHTML=this.responseText;
            
        }
    };
    xmlhttp.open("GET","../script/projectStage.php?id="+pro[0]+"&stage="+pro[1],true);
    xmlhttp.send();
}
function UpdateStage2()
{
    var stage=document.getElementById("prstage").value
    var pid=document.getElementById("sproject").value
 
    if(stage=="")
    {

        toastr["error"]("Please enter Select Stage.");
    }
     else
     {
        var data = {Pid:pid,Stage:stage};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("Project Stage updated.");
                            $('#prstage').val("").trigger('change.select2');
                              activty();
                              //$("#close-stage").click();
                              projectslist();
                         }
                         else
                         {
                            toastr["error"]("Failed to update project stage.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/updatePstage.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
     }
}
function DaysCal(value,id)
{
    var instatus=document.getElementById(id+"invoice-status").value;
  if(instatus=="Billed")
  {
    const date1 = new Date();
    const date2 = new Date(value);
    if(date2<date1)
    {
      const diffTime = Math.abs(date2 - date1);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
      document.getElementById(id+"invoice-age").value=diffDays;
    }
    else{
      document.getElementById(id+"invoice-age").value=0;
    }
    
  }
   else{
    document.getElementById(id+"invoice-age").value=0;
  }
}
function ImportFile()
{
  var fileimp=document.getElementById("exampleInputFile").value;
  if(fileimp=="")
  {

      toastr["error"]("Please select file to import.");
  }
  else{
    document.getElementById('loading').style.display='block';
    var from=$('#csvform');
				  	   var formData = new FormData(from[0]);
				      
				      $.ajax({
				          url: '../script/ImportProjects.php',
				          type: 'POST',
				          data: formData,
				          contentType: false,
				          enctype: 'multipart/form-data',
				          processData: false,
				           
				          success: function (response) {
                    if(response.text!=0)
                    {
                      toastr["success"]("Projects Imported.");
                        setTimeout(function(){
                          window.location.reload();
                       }, 2000);
                    }
                   
				          }
				       });
  }
}
 
function AddProjectDetails()
{
  
  let formData = new FormData(document.getElementById('projectdetails'));
  let formobj= Object.fromEntries(formData);
  var valid = document.getElementById('projectdetails').checkValidity(); 
  $("#valid").html(valid);
  if (!valid) {
     
    toastr["error"]("Please fill all fields.");
  }
  else{
    $.ajax({
      url: '../script/AddProjectDetails.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        activty();
        toastr["success"]("Project Details Updated.");
      }
   });
  }
  
}