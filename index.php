<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Smart Slate</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="fa/css/font-awesome.min.css"> 
        <link rel="stylesheet" href="css/style.css"> 
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
        <script type="text/javascript" src="https://sdk.clarifai.com/js/clarifai-latest.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
    </head>
    <body>
            <div style="text-align:center">
              <span style="font-size: 40px; font-family: 'Pacifico', cursive;">Smart Slate</span>
            </div>
            <div id="slate" style="display:none">
                  <div style="text-align:center">
                      <span style="margin: 10px;">
                          
                          <a id="getQuestion" class="ibtn" href="javascript:void(0)" style="margin: 10px 15px 10px 10px;color: #FFF;"><i class="fa fa-play fa-2x" aria-hidden="true"></i></a> 
                          <a id="submitAnswer" class="ibtn" href="javascript:void(0)" style="margin: 10px 25px 10px 19px;color: #FFF;"><i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i></a>
                          <a id="clearCanvas" class="ibtn"  href="javascript:void(0)" style="margin: 10px;color: #FFF;"><i class="fa fa-eraser fa-2x" aria-hidden="true"></i></a> 
                          <a id="showInstruction" class="ibtn"  href="javascript:void(0)" style="margin: 10px;color: #FFF;"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a> 
                          <a id="loader" style="display:none;margin: 10px;color: #FFF;" href="javascript:void(0)"><i  class="fa fa-refresh fa-spin fa-3x fa-fw"></i></a>
                      </span>
                  </div>
         
                 <div class="image">
                  <canvas id="canvasInAPerfectWorld" style="text-align: center;margin: auto;display: block;border: 5px solid white;border-radius: 5px;margin-top: 20px;background: #212121;cursor: pointer;box-shadow: 0px 0px 20px #616161;" width="350px" height="450px"></canvas>     
                 </div>
                 <div class="result">
                 </div>
           </div>
           <div id="instruction">
             1. Press <i class="fa fa-play fa-2x" aria-hidden="true"></i> to get the instruction.<br>
             2. Draw the instructed number on the slate.To clear the slate click <i class="fa fa-eraser fa-2x" aria-hidden="true"></i>.<br>
             3. Send your answer by clicking <i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i>.<br>
              <a id="play" href="javascript:void(0)"><h1 style="font-family: 'Cabin Sketch', cursive;">Lets Play!</h1></a>
           </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>
            
             
              $(document).ready(function(){
                $("#clearCanvas").click(function(){
                  clearCanvas();
                });
                $("#getQuestion").click(function(){
                   getQuestion();
                });

                $("#submitAnswer").click(function(){
                   submitAnswer();
                });



              });

              $("#play").on("click",function(){
                $("#instruction").slideUp();
                $("#slate").slideDown();
              });

              $("#showInstruction").on("click",function(){
                $("#instruction").slideDown();
                $("#slate").slideUp();
              });
            
              canva = document.getElementById('canvasInAPerfectWorld');
              context = canva.getContext("2d");
              context.font = "30px Comic Sans MS";
              context.fillStyle = "white"; 
              context.textAlign = "center";
              context.strokeText("Draw Here!",canva.width/2, canva.height/2);


              $('#canvasInAPerfectWorld').mousedown(function(e){
                  event.preventDefault();
                  var mouseX = e.pageX - this.offsetLeft;
                  var mouseY = e.pageY - this.offsetTop;
                  paint = true;
                  addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
                  redraw();
               });
 
                $('#canvasInAPerfectWorld').mousemove(function(e){
                  if(paint){
                    addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
                    redraw();
                  }
                });

                $('#canvasInAPerfectWorld').mouseup(function(e){
                  paint = false;
                });

                var clickX = new Array();
                var clickY = new Array();
                var clickDrag = new Array();
                var paint;

                function addClick(x, y, dragging)
                {
                  clickX.push(x);
                  clickY.push(y);
                  clickDrag.push(dragging);
                }


                function redraw(){ 
                  context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
                  
                  context.strokeStyle = "#ffffff";
                  context.lineJoin = "round";
                  context.lineWidth = 5;
                            
                  for(var i=0; i < clickX.length; i++) {        
                    context.beginPath();
                    if(clickDrag[i] && i){
                      context.moveTo(clickX[i-1], clickY[i-1]);
                     }else{
                       context.moveTo(clickX[i]-1, clickY[i]);
                     }
                     context.lineTo(clickX[i], clickY[i]);
                     context.closePath();
                     context.stroke();
                  }
                }

                function clearCanvas(){
                  context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
                  clickX = new Array();
                  clickY = new Array();
                  clickDrag = new Array();  
                }

                function numberToChar(numb){
                  switch(numb) {
                      case 1:
                          return "One";
                          break;
                      case 2:
                          return "Two";
                          break;
                      case 3:
                          return "Three";
                          break;
                      case 4:
                          return "Four";
                          break;
                      case 5:
                          return "Five";
                          break;
                      case 6:
                          return "Six";
                          break;
                      case 7:
                          return "Seven";
                          break;
                      case 8:
                          return "Eight";
                      case 9:
                          return "Nine";
                      case 0:
                          return "Zero";
                      default:
                          return "Error";
                  }
                }

                var answer = undefined;

                function getQuestion(){
                  

                  if(answer==undefined){
                    var numb = Math.floor(Math.random()*10);
                    answer = numb;
                    var numbChar = numberToChar(numb);
                  }
                  else{
                    var numbChar = numberToChar(answer);
                  }
                  responsiveVoice.speak("Draw "+ numbChar);
                 
                }

                var app = new Clarifai.App({apiKey: 'e73cbb00f5e448008f470e9cf0b90b33'});

                function submitAnswer(){
                  var img = new Image();
                  img.src = canva.toDataURL();
                  var imageBase64 = img.src.replace("data:image/png;base64,", "");
                  $("#loader").show();
                  $(".ibtn").hide();
                  $('#canvasInAPerfectWorld').slideUp();
                  if(clickX.length > 1){
                    app.models.predict("ss", {base64: imageBase64}).then(
                    function(response) {
                      console.log(response);
                      var prediction = response.outputs[0].data.concepts[0].name;
                      console.log(prediction+"=========="+response.outputs[0].data.concepts[0].value);
                      console.log(answer);
                      $("#loader").hide();
                      if(prediction==answer){
                        $('.result').text("Good Job!!!");
                        responsiveVoice.speak("Good Job!!!");
                        $('.result').slideDown();
                        answer = undefined;
                        clearCanvas();
                      }
                      else{
                        $('.result').text("Try Again!");
                        responsiveVoice.speak("Try Again!!!");
                        $('.result').slideDown();
                        clearCanvas();
                      }
                      setTimeout(function(){
                          $('.result').hide();
                          $(".ibtn").show();
                          $('#canvasInAPerfectWorld').slideDown();
                        },2000);
                    },
                    function(err) {
                      console.log(err);
                    }
                  ); 
                  }
                  else{
                      $('.result').text("Draw then press plane!");
                      responsiveVoice.speak("Draw then press plane!!!");
                      $('.result').slideDown();
                      clearCanvas();
                      $("#loader").hide();
                      setTimeout(function(){
                          $('.result').hide();
                          $(".ibtn").show();
                          $('#canvasInAPerfectWorld').slideDown();
                        },2000);
                  }
                   
                }
        </script>
    </body>
</html>
