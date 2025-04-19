function Reportinglist(value)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('pro-list').innerHTML=this.responseText;
            $(".pro-list").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,"pageLength": 100,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    };
    xmlhttp.open("GET","../script/reportlist.php?days="+value,true);
    xmlhttp.send();
}
 
function Report(id)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('project-updates').innerHTML=this.responseText;
            $(".review-list").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
                 
              }) ;
        }
    };
    xmlhttp.open("GET","../script/projectreport.php?id="+id,true);
    xmlhttp.send();
}
function Review(id)
{
    document.getElementById('pid').value=id;
}
function NewReview()
{
    var id=document.getElementById('pid').value;
    var rew=document.getElementById('pr').value;
    var cr=document.getElementById('cr').value;
    var cmnt=document.getElementById('cmnt').value;
    if(rew==0 && cmnt=="" && cr=="")
    {
        toastr["error"]("Please select Project Review, add cutome review or add Comments.");
    }
    else
    {
        var data = {ID:id,Rew:rew,Cmnt:cmnt,CR:cr};
        var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("Project review added.");
                            Reportinglist(7);
                            activty();
                            $('#project-close').click();
                         }
                         else
                         {
                            toastr["error"]("Failed to add project Review.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/addreview.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function SelectSFilter(id,value)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
                Reportinglist(7);
        }
    };
    xmlhttp.open("GET","../script/setsupportfilter.php?value="+value+"&id="+id,true);
    xmlhttp.send();
}
function FetchDeadline(id)
{
    var pro=id.split("-");
    document.getElementById("pid").value=pro[0];
}
function UpdateDeadline()
{
   
    var pid=document.getElementById("pid").value;
    var deadline=document.getElementById("deadline").value;
    var date1=deadline.split("-");
    const date = new Date();
    date.setMonth(date1[1] - 1);

    var m=date.toLocaleString('en-US', { month: 'short' });
    var d=date1[2]+'-'+m+'-'+date1[0]
    
    var data = {Pid:pid,Deadline:d};
    
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("Deadline Updated.");
                            $("#pid").val("");  
 
                              activty();

                              $("#close-deadline").click()
                              Reportinglist(7);
                         }
                         else
                         {
                            toastr["error"]("Failed to update project deadline.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/updatedeadline.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
}
function FilterDaysS3(value,id)
{
  $('.sb1').removeClass("btn-secondary");
  $('.sb1').removeClass("text-white")
  $('.sb1').addClass("btn-outline-secondary");
  $("#"+id).addClass("btn-secondary");  
  $("#"+id).addClass("text-white");
    Reportinglist(value);
}
 $("#s7day3").click();