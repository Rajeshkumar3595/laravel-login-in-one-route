<html>
<body>
    <form name="f1" id="register"  onsubmit="return validate()">
    @csrf
    <input type="hidden" name="action" value="adduserreg">  
<table>
<tr><td>Name:</td><td><input type="text" name="name"/>  
<span id="namelocation" style="color:red"></span></td></tr> 
<tr><td>Password:</td><td><input type="password" name="password"/>  
<span id="passwordlocation" style="color:red"></span></td></tr>
<tr><td colspan="2"><input type="submit" value="register"/ onclick="userregister('register')">  </td></tr>
</table>
</form>


 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
function validate(){  
var name=document.f1.name.value;  
var passwordlength=document.f1.password.value.length;  
var status=false;  
if(name==""){  
document.getElementById("namelocation").innerHTML=  
"  Please enter your name";  
status=false;
}else{  
status=true;
}  
  
if(passwordlength<6){  
document.getElementById("passwordlocation").innerHTML=  
"  Password must be greater than 6";  
status=false; 
}else{  
document.getElementById("passwordlocation").innerHTML="";  
}  
  
return status;  
}  
    function userregister(formId)
    {
        var myForm =document.getElementById(formId);
        var formdata = new FormData(myForm);
        $.ajax({
            type:'POST',
            url:'{{url("usre-register")}}',
            data:formdata,
            cache:false,
            contentType:false,
            processData:false,
            success:function(data)
            {
                if(data['status']==200)
                {
                    $('#message').html(data.message);
                    // $('#alldata').html('');
                    // var alldata = '';
                    // var sn = 0;
                    // $.each(data.alldata,function(key, value){
                    //     sn++;
                    // alldata+='<tr><td scope="row">'+ sn +'</td><td>'+value.first_name+'</td><td>'+ value.last_name +'</td><td><button type="button" class="btn btn-info btn-sm mt-2 waves-effect waves-light" data-toggle="modal" data-target="#basicModal" onclick="getregForm('+ value.id +')"><i class="fa fa-edit"></i> </button><button type="button" class="btn btn-danger btn-sm mt-2 waves-effect waves-light" onclick="deleteuseDet('+ value.id +')"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>';
                    // });
                    // $('#alldata').html(alldata);
                    // $('#staticBackdrop').modal('hide');
                    // setTimeout(function(){
                    //       window.location.reload();
                    //     }, 1500);

                }
                else
                {
                    $('#message').html(data.message);
                }
            }
        });
    }
</script>  
</body>
</html>
