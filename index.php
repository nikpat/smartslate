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
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <style>
        * {
          font-family: 'Indie Flower', cursive;
        }
        body,
        html{
            overflow: hidden;
            margin: 0;
            padding: 0;
        } 
        .image{
              text-align: center;
        }
        </style>
        <script type="text/javascript" src="https://sdk.clarifai.com/js/clarifai-latest.js"></script>
    </head>
    <body style="background:#353535;color: #ffffff;">
            <div style="text-align:center">
              <span style="font-size: 40px;">Smart Slate</span>
            </div>
            <div style="text-align:center">
                <span style="margin: 10px;">
                    <a id="getQuestion" href="javascript:void(0)" style="margin: 10px 15px 10px 10px;color: #FFF;"><i class="fa fa-question-circle fa-2x" aria-hidden="true"></i></a> 
                    <a id="clearCanvas" href="javascript:void(0)" style="margin: 10px;color: #FFF;"><i class="fa fa-eraser fa-2x" aria-hidden="true"></i></a> 
                    <a id="submitAnswer" href="javascript:void(0)" style="margin: 10px;color: #FFF;"><i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i></a>
                </span>
            </div>
   
           <div class="image">
            <canvas id="canvasInAPerfectWorld" style="text-align: center;margin: auto;display: block;border: 5px solid white;border-radius: 5px;margin-top: 20px;background: #212121;cursor: pointer;" width="350px" height="380px"></canvas>     
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
                // Disable scrolling.
                document.ontouchmove = function (e) {
                  e.preventDefault();
                }

                // Enable scrolling.
                document.ontouchmove = function (e) {
                  return true;
                }
              }); 
            
              canva = context = document.getElementById('canvasInAPerfectWorld');
              context = canva.getContext("2d");
              context.font = "30px Comic Sans MS";
              context.fillStyle = "white"; 
              context.textAlign = "center";
              context.strokeText("Draw Here!",canva.width/2, canva.height/2);


              $('#canvasInAPerfectWorld').mousedown(function(e){
                  e.preventDefault();
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
                  alert("Draw "+ numbChar);
                }

                var app = new Clarifai.App({apiKey: 'e73cbb00f5e448008f470e9cf0b90b33'});

                function submitAnswer(){
                  var img = new Image();
                  img.src = canva.toDataURL();
                  var imageBase64 = img.src.replace("data:image/png;base64,", "");  
                  app.models.predict("ss", {base64: imageBase64}).then(
                    function(response) {
                      console.log(response);
                      var prediction = response.outputs[0].data.concepts[0].name;
                      console.log(prediction+"=========="+response.outputs[0].data.concepts[0].value);
                      console.log(answer);
                      if(prediction==answer){
                        alert("Great Job!!!");
                        answer = undefined;
                        clearCanvas();
                      }
                      else{
                        alert("Incorrect, Try Again!");
                        clearCanvas();
                      }

                    },
                    function(err) {
                      console.log(err);
                    }
                  );
                  
                }
        </script>
    </body>
</html>
