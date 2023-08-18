<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
	<!-- <link rel="stylesheet" type="text/css" href=""> -->
</head>
<body>
	<div style="text-align: end; margin-right: 10px;margin-top: 10px">
		<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="getregForm(0)">Registration</button>
	</div>
	<div style="margin-top: 20px;margin-left: 20px;">
	<table class="table" >
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">First</th>
	      <th scope="col">Last</th>
	      <th scope="col">Action</th>
	    </tr>
	  </thead>
	  <tbody id="alldata">
		@php $sn=0; @endphp
		@foreach($alluserList as $key => $userlist)
		@php $sn++; @endphp
	    <tr>
	      <td scope="row">{{$sn}}</td>
	      <td>{{$userlist->first_name}}</td>
	      <td>{{$userlist->last_name}}</td>
	     <td>
	      	<button type="button" class="btn btn-info btn-sm mt-2 waves-effect waves-light" data-toggle="modal" data-target="#basicModal" onclick="getregForm({{$userlist->id}})"><i class="fa fa-edit"></i> </button>
            <button type="button" class="btn btn-danger btn-sm mt-2 waves-effect waves-light" onclick="deleteuseDet({{$userlist->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>
	      </td>
	    </tr>
	    @endforeach
	   
	  </tbody>
	</table>
	</div>
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form  id="register" action="javascript:void(0)" class="create-user" >
        @csrf
        <div id="modify_field">
			<input type="hidden" name="action" value="adduserreg">
		</div>
		<div id="errorme">
	      	<div class="modal-body" >
         		<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-12">
		                <div class="form-group">
		                    First Name
		                    <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name" required>
		                </div>
		            </div>
		            <div class="col-xs-6 col-sm-6 col-md-12">
		                <div class="form-group">
		                    <label>Last Name</label>
		                    <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" required>
		                </div>
		            </div>
		           <div class="col-xs-6 col-sm-6 col-md-12">
		                <div class="form-group">
		                	<label>Gender</label><br>
			            	<input type="radio" id="male" name="gender" value="male">Male
							<input type="radio" id="female" name="gender" value="female">female
		            	</div>
		        	</div>
	            </div>
				<div class="form-group">
	                <label>Email</label>
	                <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required>
	            </div>
				<div class="row">
	                <div class="col-xs-6 col-sm-6 col-md-12">
	                    <div class="form-group">
	                        <label>Password</label>
	                        <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required> 
	                    </div>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-xs-6 col-sm-6 col-md-12">
	                    <div class="form-group">
	                        <label>Profile Image</label>
	                        <input type="file" name="profile_image" id="profile_image" class="form-control input-sm" required>
	                        <img src="" id="prfileId" style="height: 50px;width: 50px; margin-top:5px" onerror="this.src='assets/noimage.jpg'">
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-12" style="margin-bottom: 16px;margin-top: 5px; text-align: end;">
	                <button type="button" action="javascript:void(0)" class="btn btn-info mb-2 " onclick="addOrders()"> Add Image</button>
	            </div>
	            <div class="form-group" style="padding-top: 10px;">
	                <div class="row mt-4" style="display:none;" id="labeldata">
	                    <div class="col-md-4"><label>Title</label></div>
	                    <div class="col-md-6"><label>Image</label></div>
	                    <div class="col-md-2"><label>Remove</label></div>
	                </div>
	            <div id="galleryDet" ></div>
	            </div>
	      	</div>
      	</div>
	      	<div  id="message"></div> 
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary addcl" onclick="userregister('register')">Submit</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<style>
    .preview-area{ 
        display: flex;
        flex-wrap: wrap;
    }
    .preview-area img{
        width: 24%;
        margin: 0 0 10px;
        object-fit: contain;
    }
    .preview-area img:not(:nth-child(4n)){
        margin-right: 1.333%;
    }
</style>

<input type="file" onchange="preview(this)" multiple>
<div class="preview-area"></div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
    function preview(elem, output = '') {
        Array.from(elem.files).map((file) => {
            const blobUrl = window.URL.createObjectURL(file)
            output+=`<img src=${blobUrl}>`
        })   
        elem.nextElementSibling.innerHTML = output
    }
</script>
<script type="text/javascript">


	// $(".create-user").validate({
    //     rules: {
    //         first_name: {
    //             required: true,
    //             maxlength: 20,
    //         },
    //         last_name: {
    //         	required: true,
    //             maxlength: 20,
               
    //         },
    //         email: {
    //         	 required: true,
    //             email: true,
    //             maxlength: 50
                
    //         },
    //         password: {
    //             required: true,
    //             minlength: 5
    //         },
    //         profile_image: {
            	
	//         },

	//         "image[]": {
    //              required: true,
    //              extension: "jpg|jpeg|png",
    //           },
    //           "title[]":{
    //           	required: true,
    //             maxlength: 100,
    //           }
	        
	//     },

	    
    //     messages: {
    //         first_name: {
    //             required: "First Name is required",
    //             maxlength: "Name cannot be more than 20 characters"
    //         },
    //         last_name: {
    //             required: "Last Name is required",
    //             maxlength: "Name cannot be more than 20 characters"
    //         },
    //         email: {
    //         	required: "Email is required",
    //             email: "Email must be a valid email address",
    //             maxlength: "Email cannot be more than 30 characters",
                
    //         },
    //         password: {
    //             required: "Password is required",
    //             minlength: "Password must be at least 5 characters",
    //         },
    //         profile_image: {
	//             required: "Please upload file.",
	//             extension: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."
	//         },

	//         "image[]":{
	//             required: "Please upload file.",
	//             extension: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."
	//         },
	//         "title[]":{
	//         	required: "Title is required",
    //             maxlength: "Title cannot be more than 100 characters"
	//         },
    //     },
    //     errorElement: 'span',
    //     errorPlacement: function (error, element) {
    //         error.addClass('invalid-feedback');
    //         element.closest('.form-group').append(error);
    //     },
    //     highlight: function (element, errorClass, validClass) {
    //         $(element).addClass('is-invalid');
    //     },
    //     unhighlight: function (element, errorClass, validClass) {
    //         $(element).removeClass('is-invalid');
    //     }
        
	// });
	if(profile_image = !null)
	{
		required: false;
	}
	else
	{
        required: true;
    }
	var sn = 1;
    function addOrders()
    {
        sn++;
        $('#labeldata').css('display','flex');
        $('#galleryDet').append('<div id="product_id_list' + sn + '" class="row mt-3" style="margin-bottom: 8px"><div class="col-md-4"><input type="text"  class="form-control"  placeholder="Enter Title"   name="title[]" id="title' + sn + '"></div><div class="col-md-6" ><input type="file"  class="form-control" name="image[]" id="image'+ sn +'" onchange="showPreview(event, '+sn+');" ><div class="preview"><img src="" id="imageId"></div></div><div class="col-md-2"><a href="javascript:void(0)"class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true" style="padding: 5px !important;" onclick="removeProductlist(' + sn + ')"></i></a></div></div>');
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
                	var $userform = $('.create-user');
			        $userform.validate().resetForm();
			        $(this).find('form').trigger('reset');

			        $userform.find('.error').removeClass('error');
			        $userform.find('.is-invalid').removeClass('is-invalid');
                    $('#message').html(data.message);
                    $('#alldata').html('');
                    var alldata = '';
                    var sn = 0;
                    $.each(data.alldata,function(key, value){
                    	sn++;
                    alldata+='<tr><td scope="row">'+ sn +'</td><td>'+value.first_name+'</td><td>'+ value.last_name +'</td><td><button type="button" class="btn btn-info btn-sm mt-2 waves-effect waves-light" data-toggle="modal" data-target="#basicModal" onclick="getregForm('+ value.id +')"><i class="fa fa-edit"></i> </button><button type="button" class="btn btn-danger btn-sm mt-2 waves-effect waves-light" onclick="deleteuseDet('+ value.id +')"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>';
					});
                    $('#alldata').html(alldata);
                    $('#staticBackdrop').modal('hide');
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
    	
    function removeProductlist(sn)
    {
        if(sn >0)
        {
            $('#product_id_list'+sn).remove();
            $('#labeldata').css('display','flex');
        }
        else if(sn < 1)
        {
            $('#labeldata').css('display','none');
        }
    }
    function getregForm(userId)
    {
    	if(userId ==0)
    	{
			$('#message').html('');
    		$("input#profile_image").prop('required',true);
    		$('#register').trigger("reset");
    		$("#prfileId").attr('src','assets/noimage.jpg');
    		$('#galleryDet').html('');
    		$('#labeldata').css('display','none');
    		$("#modify_field" ).html('<input type="hidden" name="action" value="adduserreg">');
	        $("#modaltitle" ).text('Add Registration');
	        // $('#staticBackdrop').modal('show');
	        // return false;
    	}
    	else
    	{
    		
    		$.ajax({
		        type:'POST',
		        url:'{{url("usre-register")}}',
		        data:{
		        	'_token':'{{csrf_token()}}',
		        	'action':'getuserdet',
		        	'userId':userId,
		        },
				success: function (data) 
		        {
		        if (data['status'] == 200) 
		          {
		          	var $userform = $('.create-user');
			        $userform.validate().resetForm();
			        $(this).find('form').trigger('reset');

			        $userform.find('.error').removeClass('error');
			        $userform.find('.is-invalid').removeClass('is-invalid');
		          	$('#message').html('');
    				$("input#profile_image").prop('required',false);
		          	$("#first_name" ).val(data.message.first_name);
		    		$("#last_name" ).val(data.message.last_name);
		    		$("#email" ).val(data.message.email);
		    		$("#password" ).val(data.message.password);
		    		if(data.message.gender == 'male')
		    		{
		    			$('#male').prop('checked',true);
		    		}
		    		else
		    		{
		    			$('#female').prop('checked',true);
		    		}
		          	$("#prfileId" ).attr('src','assets/uploads/profile/'+data['message']['profile_image']);
		            var details = '';
		                 $('#galleryDet').html('');
		                 $.each(data.imagede,function(key,value){
		                 	var image = '<img style="height:50;width:50px;margin-top:10px" src="assets/uploads/profile/'+value.image+'">';
		                 	details+='<div id="galdet_id_list_e' + value['id'] + '" class="row mt-3"><input type="hidden" name="deatilEditId[]" value="'+value['id']+'"><div class="col-md-4"><input type="text"  class="form-control" value=" ' + value['title']+ '" name="title_e[]" id="title_e'+ value.id+' "></div><div class="col-md-6"><input type="file"  class="form-control" value=" ' + value['title']+ '" name="image_e[]" id="image_e'+ value.id+' "> '+ image +' </div> <div class="col-md-2"><a href="javascript:void(0)"class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true" style="padding: 5px !important;" onclick="removeGalldet_e(' + value['id'] + ')"></i></a></div></div>';
		                 });


		            $("#modify_field" ).html('<input type="hidden" value="updateuser" name="action"><input type="hidden" value="'+data['message']['id']+'" name="userId">');
		            
		            $('#galleryDet').html(details);
		            $("#modaltitle" ).text('Edit Registration');
		            $('#staticBackdrop').modal('show');
		            // $('#message').html(data.message);
                    // $('#alldata').html('');
                    // var alldata = '';
                    // var sn = 0;
                    // $.each(data.alldata,function(key, value){
                    // 	sn++;
                    // alldata+='<tr><td scope="row">'+ sn +'</td><td>'+value.first_name+'</td><td>'+ value.last_name +'</td><td><button type="button" class="btn btn-info btn-sm mt-2 waves-effect waves-light" data-toggle="modal" data-target="#basicModal" onclick="getregForm('+ value.id +')"><i class="fa fa-edit"></i> </button><button type="button" class="btn btn-danger btn-sm mt-2 waves-effect waves-light" onclick="deleteuseDet('+ value.id +')"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>';
					// });
                    // $('#alldata').html(alldata);
                    // $('#staticBackdrop').modal('hide');

		          }
		          else
		          {
		            console.log(data.message);
		          }
		        }
	      });
    	}
    	

    }
    
    function deleteuseDet(userId)
    {
	
		if(confirm("you want delete this record") )
		{
			$.ajax({
            type: 'POST',
            url:'{{url("usre-register")}}',
            data:{
                '_token':'{{csrf_token()}}',
                'action':'deleteuser',
                'userId':userId,
            } ,
            success: function(data) {
                if (data['status'] == 200) {
                    	// $('#alldata').html('');
                    var alldata = '';
                    var sn = 0;
                    $.each(data.alldata,function(key, value){
                    	sn++;
                    alldata+='<tr><td scope="row">'+ sn +'</td><td>'+value.first_name+'</td><td>'+ value.last_name +'</td><td><button type="button" class="btn btn-info btn-sm mt-2 waves-effect waves-light" data-toggle="modal" data-target="#basicModal" onclick="getregForm('+ value.id +')"><i class="fa fa-edit"></i> </button><button type="button" class="btn btn-danger btn-sm mt-2 waves-effect waves-light" onclick="deleteuseDet('+ value.id +')"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>';
					});
                    $('#alldata').html(alldata);
						// setTimeout(function(){
	                    //   window.location.reload();
	                    // }, 1500);
                    
                } else {
                   alert(data.message);
                }
            }
        })
		}
		else
		{
			alert('your are sure not delete this record');
		}
	    
    }
    function removeGalldet_e(gId)
    {
		if(confirm("you want delete this record") ){
            $.ajax({
	            type: 'POST',
	            url:'{{url("usre-register")}}',
	            data:{
	                '_token':'{{csrf_token()}}',
	                'action':'delgaldet',
	                'gId':gId,
	            } ,
	            success: function(data) {
	                if (data['status'] == 200) {
	                    	
						$('#galdet_id_list_e'+gId).remove();	
	                    
	                }
	                else
	                {
	                   alert(data.message);
	                }
	            }
	        });
          
	      }
      	else
      	{
	           
	        alert('your are sure not delete this record');  
	    }
		
	    
    }
    // profile_image.onchange = evt => {
    //   const [file] = profile_image.files
    //   if (file) {
    //     dimesinImagId.src = URL.createObjectURL(file)
    //   }
    // }

    // function showPreview(event){
    //   if(event.target.files.length > 0){
    //     var src = URL.createObjectURL(event.target.files[0]);
    //     var preview = document.getElementById("file-ip-1-preview");
    //     preview.src = src;
    //     preview.style.display = "block";
    //   }
    // }
    // var $userform = $('.create-user');
        	// $userform.validate().resetForm();
    		// $(this).find('form').trigger('reset');
	        // $userform.find('.error').removeClass('error');
	        // $userform.find('.is-invalid').removeClass('is-invalid');
	    // function validate(){  


	
    </script>
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5f03f0d2760b2b560e6fddca/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
</body>
</html>