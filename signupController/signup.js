
// $(document).ready(function(){
//         $('#gmail').keyup(function(){
//             var gmail = $("#gmail").val();
//             if(gmail != ''){
//                 $.ajax({
//                     url : "signupController/checkEmail.php",
//                     method : "POST",
//                     data  : {
//                         email : gmail
//                     },
//                     success  : function(response){
//                         $("#emailMessage").val(response);
//                         $("#emailMessage").css('display','block');
//                     }
//                 })
//             }else{
//                 $("#emailMessage").val('');
//                 $("#emailMessage").css('display','none');
//             }
//             // $("#registerBtn").attr("disable",true);
//         })
//         $("#userInput").keyup(function(){
//             // username
//             var username = $("#userInput").val()
//             if(username != ''){
//                 $.ajax({
//                     url : "signupController/checkUsername.php",
//                     method : "POST",
//                     data  : {
//                         username : username
//                     },
//                     success  : function(response){
//                         $("#userMessage").val(response);
//                         $("#userMessage").css("display","block");
//                     }
//                 })
//             }else{
//                 $("#userMessage").val('');
//                 $("#userMessage").css("display","none");
//             }
//         })
//         $("#pwdInput").keyup(function(){
//             // password
//             var pwd = $(this).val()
//             if(pwd != ''){
//                 $.ajax({
//                     url : "signupController/pwdCheck.php",
//                     method : "POST",
//                     data  : {
//                         pwd : pwd
//                     },
//                     success  : function(response){
//                         $("#pwdMessage").val(response);
//                         $("#pwdMessage").css("display","block");
//                     }
//                 })
//             }else{
//                 $("#pwdMessage").val('');
//                 $("#pwdMessage").css("display","none");
//             }
//         })
//         $("#pwdRepeat").keyup(function(){
//             // password
//             var pwdR = $(this).val()
//             var pwd = $("#pwdInput").val()
//             if(pwdR != ''){
//                 $.ajax({
//                     url : "signupController/repeatPwd.php",
//                     method : "POST",
//                     data  : {
//                         pwdR : pwdR,
//                         pwd : pwd
//                     },
//                     success  : function(response){
//                         $("#pwdMessage").val(response);
//                         $("#pwdMessage").css("display","block");
//                     }
//                 })
//             }else{
//                 $("#pwdMessage").val('');
//                 $("#pwdMessage").css("display","none");
//             }
//         })
//         // Button
//         $("#registerBtn").click(function(){
//             var email = $("#gmail").val();
//             var username = $("#userInput").val();
//             var pwd = $('#pwdInput').val();
//             var pwdRepeat = $("#pwdRepeat").val();
//             if(email != "" && username != '' && pwd != '' && pwdRepeat != ''){
//                 $.ajax({
//                     url : "signupController/register.php",
//                     method : "POST",
//                     data  : {
//                         email : email,
//                         username : username,
//                         pwd : pwd,
//                         pwdRepeat : pwdRepeat,
//                     },
//                     success : function(response){
//                        alert(response);
//                        window.location.href = "../login.php";
//                     }
//                 })
//             }else{
//                 $("#pwdMessage").css("display","none");
//             }
//         })
// })