// function for pagination
function pagination(totalpages, currentpage){
    var pagelist="";
    if(totalpages>1){
        currentpage=parseInt(currentpage);
        pagelist += `<ul class="pagination justify-content-center">`;
    const prevClass=currentpage==1?"disabled":"";
        pagelist+=`<li class="page-item ${prevClass}"><a class="page-link" 
        data-page="${currentpage-1}" href="#">Previous</a></li>`;
        for(let p=1;p<=totalpages;p++){
            const activeClass=currentpage==p?"active":"";
            pagelist+=`<li class="page-item ${activeClass}"><a class="page-link" 
            data-page="${p}" href="#">${p}</a></li>`;
        }        
    const nextClass=currentpage==totalpages?"disabled":"";
        pagelist+=`<li class="page-item ${nextClass}"><a class="page-link " 
        href="#" data-page="${currentpage+1}" id="next">Next</a></li>`;
        pagelist+=`</ul>`;
    }
    $("#pagination").html(pagelist);
    // const nextClassHolder = document.getElementById("next");
    // console.log(nextClassHolder);
}

// function to get tusers from database

function getUserRow(user){
    var userRow = "";
    if(user){
        userRow = `<tr>
        <td scope="row"><img src="uploads/${user.photo}"></td>
        <td>${user.username}</td>
        <td>${user.email}</td>
        <td>${user.mobile}</td>
        <td>
            <a href="#" data-id=${user.id} class="mr-3 text-info profile" title="View profile" data-toggle="modal" data-target="#userViewModal"><i class="fa fa-eye" aria-hidden="true"></i></a>
            <a href="#" data-id=${user.id} class="mr-3 text-success edituser" title="Edit" data-toggle="modal" data-target="#usermodal" ><i class="fa fa-edit" aria-hidden="true"></i></a>
            <a href="#" data-id=${user.id} class="mr-3 text-danger deleteuser" title="Delete"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
            <!-- <span>Edit</span>
            <span>Profile</span>
            <span>Delete</span> -->
        </td>

        </tr>`;
    }
    return userRow;
}

// function to get display user data
function displayUserData(user){
    var userDiv = "";
    if(user){
        userDiv = `<div class="card" style="width: 18rem;">
        <img class="card-img-top" src="uploads/${user.photo}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">${user.username}</h5>
          <p class="card-text">${user.email}</p>
          <p class="card-text">${user.mobile}</p>          
        </div>
      </div>`;
    }
    return userDiv;
}

//function to get Search results up here
// function search (){
//     var pageno = $("#currentpage").val();

//     $.ajax({
//         url:"/PHPadvance/ajax.php", 
//         type: "POST",
//         dataType: "json",
//         data:{page:pageno, action:'search'},
//         beforeSend: function(){
//             console.log("Waiting for search results");
//         },
//         success: function(rows){
//             console.log(rows);
//         },
//         error: function(request, error){
//             console.log("Error: " + error);
//         }
//     });
// }

// function to get users
function getUsers(){
    var pageno=$("#currentpage").val();
    //const newNextClassHolder = json_encode(nextClassHolder);
    $.ajax({
        url:"/PHPadvance/ajax.php", 
        type: "GET",
        dataType: "json",
        data:{page:pageno, action:'getallusers'},
        beforeSend: function(){
            console.log("Data is loading...");
        },
        success:function(rows){
           console.log(rows);
           if(rows.users){
            var userslist ="";
            $.each(rows.users, function(index, user){
                userslist+=getUserRow(user);
            });
            $("#usertable tbody").html(userslist);
            let totalUsers=rows.count;
            // console.log(nextClassHolder.classList());
            let totalpages = Math.ceil(parseInt(totalUsers)/4);
            const currentpage = $("#currentpage").val();
            pagination(totalpages, currentpage);
            console.log(currentpage);
           }
        },
        error:function(request, error){
            console.log("Error: "+ error);
        },
    });
};

// function to get search results
// function search(){};


$(document).ready(function(){
    // adding users
    $(document).on("submit","#addform", function(e){
        var msg = $("#userId").val().length>0? "User has been updated successfully":"New user has been added usccessfully";
        e.preventDefault();
        // console.log("Went past e.preventDefault()");
        //ajax 
        $.ajax({
            url:"/PHPadvance/ajax.php", 
            type: "POST",
            dataType: "json",
            data:new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function(){
                console.log("Wait...Data is loading");
            },
            success:function(response){
                console.log(response);
                if(response){
                    $("#usermodal").modal("hide");
                    $("#addform")[0].reset();
                    $(".displaymessage").html(msg).fadeIn().delay(1500).fadeOut();
                    getUsers();
                }
            },
            error:function(request, error){
                console.log(arguments);
                console.log("Error: "+ error);
            },
        });
    });

    $(document).on("keyup", function(){
        
        const searchTerm =$("#searchForm").val();
        console.log("Went past search term: ", searchTerm);
        if (searchTerm.length>1){
            $.ajax({
                url: "/PHPadvance/ajax.php",
                type: "GET",
                dataType: "json",
                data: {searchQuery: searchTerm, action:"search"},
                beforeSend: function(){
                    console.log("Waiting for search Results");
                },
                success:function(users){
                    console.log(users);
                    if(users.length>0){
                        var userslist = "";
                        $.each(users, function(index, user){
                            userslist+=getUserRow(user);
                        });
                        $("#usertable tbody").html(userslist);
                        $("#pagination").hide();
                    } else {
                        console.log("The length of returned users is: ", users.length)
                        getUsers();
                        $("#pagination").show();

                    }
                    
                },
                error:function(request, error){
                    console.log(arguments);
                    console.log("Error: "+ error);
                },
            });
        } else {
            getUsers();
            $("#pagination").show();
        }
    });

    // onclick event for pagination
    $(document).on("click", "ul.pagination li a", function(event){
        event.preventDefault();

        const pagenum=$(this).data("page");

        $("#currentpage").val(pagenum);
        getUsers();
        $(this).parent().siblings().removeClass("active");
        $(this).parent().addClass("active");
    });

    // onclick event for editing or updating rows/data
    $(document).on("click", "a.edituser",function(){
        var uid = $(this).data("id");
        $.ajax({
            url:"/PHPadvance/ajax.php", 
            type: "GET",
            dataType: "json",
            data:{id:uid, action:'editusersdata'},
            beforeSend: function(){
                console.log("Waiting");
            },
            success:function(row){
               console.log($(this));
                if(row){
                    $("#username").val(row.username);
                    $("#email").val(row.email);
                    $("#mobile").val(row.mobile);
                    $("#userId").val(row.id);
                    // $("#userphoto").val(row.photo);

                }

               
            },
            error:function(request, error){
                console.log("Error: "+ error);
            },
        });
    });

    // onclick event for viewing users row/data
    $(document).on("click", "a.profile", function(){
        var uid = $(this).data("id");
        $.ajax({
            url:"/PHPadvance/ajax.php", 
            type: "GET",
            dataType: "json",
            // data:{id:uid, action:'viewuserdata'},
            data: {id:uid, action:"editusersdata"},
            beforeSend: function(){
                console.log("Waiting");
            },
            success:function(row){
               console.log(row);
                if(row){
                    const profile =`<div class="row">
                    <div class="col-sm-6 col-md-4">
                      <img src="uploads/${row.photo}" alt="Image" class="rounded">
                    </div>
                    <div class="col-sm-6 col-md-8">
                      <h4 class="text-primary">${row.username}</h4>
                      <p>
                        <i class="fa fa-envelope-open text-dark"></i> ${row.email}
                      </p>
                      <p>
                        <i class="fa fa-phone text-dark"></i> ${row.mobile}
                      </p>
                    </div>
                  </div>`;
                    $("#profileModalBody").html(profile);

                }

               
            },
            error:function(request, error){
                console.log("Error: "+ error);
            },
        });
    });

    $(document).on("click", "a.deleteuser", function(e){
        e.preventDefault();
        var uid = $(this).data("id");
        var pagenum = $("#currentpage").val();
        if(confirm("Are you sure you want to delete this user?"));

        $.ajax({
            url:"/PHPadvance/ajax.php", 
            type: "GET",
            dataType: "json",
            data:{id:uid, page:pagenum, action:'deleteuserdata'},
            beforeSend: function(){
                console.log("Deletion of data is loading...");
            },  
            success:function(response){
                if(response.deleted==1){
                    $(".displaymessage")
                    .html("User deleted successfully")
                    .fadeIn()
                    .delay(1000)
                    .fadeOut();
                    $("#currentpage").val(pagenum);
                    getUsers();
                    console.log("done");
                }
            },          
            error:function(request, error){
                console.log("Error: "+ error);
            },
        });
    });

    $("#adduserbtn").on("click", function(){
        alert("This alert should display before form opens. FOrm shoudl be cleared of values");
        $("#addform")[0].reset();
        $("#userId").val("");
    });

// get users function



// calling getusers function
    getUsers();
});