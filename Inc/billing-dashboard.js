function projectBillingList()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('project-list').innerHTML=this.responseText;
             
        }
    };
    xmlhttp.open("GET","../script/projectbillinglist.php",true);
    xmlhttp.send();
}
projectBillingList();
function SetFilter(id,value)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        projectBillingList();
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
        $('#boffice').val("all").trigger('change.select2');
        $('#bregion').val("all").trigger('change.select2');
        $('#bmanager').val("all").trigger('change.select2');
        projectBillingList();
        }
    };
    xmlhttp.open("GET","../script/clearfilter.php",true);
    xmlhttp.send();
}