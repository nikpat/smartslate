<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Smart Slate</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/example.css">
        <link rel="stylesheet" href="fa/css/font-awesome.min.css"> 
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <style type="text/css">
        * {
          font-family: 'Indie Flower', cursive;
        }
            html, body {
                background: #212121;
            }
        </style>
    </head>
    <body>
        <div id="container"></div>
        <header class="info">
            <hgroup class="about" style="text-align:center">
                <h1 style="font-size: 28px;">Smart Slate</h1>
                <div>
                <span style="margin: 10px;">
                    <a id="getQuestion" href="javascript:void(0)" style="margin: 10px 15px 10px 10px;color: #FFF;"><i class="fa fa-question-circle fa-2x" aria-hidden="true"></i></a> 
                    <a id="clearCanvas" href="javascript:void(0)" style="margin: 10px;color: #FFF;"><i class="fa fa-eraser fa-2x" aria-hidden="true"></i></a> 
                    <a id="submitAnswer" href="javascript:void(0)" style="margin: 10px;color: #FFF;"><i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i></a>
                </span>
                </div>
            </hgroup>
            
        </header>
        <script src="js/sketch.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>

        var COLOURS = [ '#E3EB64', '#A7EBCA', '#FFFFFF', '#D8EBA7', '#868E80' ];
        var radius = 0;
        var paint = false;
        Sketch.create({

            container: document.getElementById( 'container' ),
            autoclear: false,
            retina: 'auto',

            setup: function() {
                console.log( 'setup' );
            },

            update: function() {
                radius = 2 ;
            },

            // Event handlers
            keydown: function() {
                if ( this.keys.C ) this.clear();
            },
            touchstart:function(){
                paint = true;
            },
            touchstop: function(){
                paint = false;
            },
            // Mouse & touch events are merged, so handling touch events by default
            // and powering sketches using the touches array is recommended for easy
            // scalability. If you only need to handle the mouse / desktop browsers,
            // use the 0th touch element and you get wider device support for free.
            touchmove: function() {
                if(paint){
                    for ( var i = this.touches.length - 1, touch; i >= 0; i-- ) {

                        touch = this.touches[i];

                        this.lineCap = 'round';
                        this.lineJoin = 'round';
                        this.fillStyle = this.strokeStyle = "#FFFFFF";
                        this.lineWidth = radius;

                        this.beginPath();
                        this.moveTo( touch.ox, touch.oy );
                        this.lineTo( touch.x, touch.y );
                        this.stroke();
                    }
                }
                
            }
            });
        </script>
        <script type="text/javascript" src="https://sdk.clarifai.com/js/clarifai-latest.js"></script>
        <script>
        $(document).ready(function(){
            canva = $("canvas")[0];
            context = canva.getContext("2d");

            $("#clearCanvas").click(function(){
              clearCanvas();
            });
            $("#getQuestion").click(function(){
               getQuestion();
            });

            $("#submitAnswer").click(function(){
               submitAnswer();
            });

            function clearCanvas(){
                  context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
                  clickX = new Array();
                  clickY = new Array();
                  clickDrag = new Array();  
            }

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
                    alert("No Exactly, Try Again!")
                  }

                },
                function(err) {
                  console.log(err);
                }
              );
              
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
                        alert("No Exactly, Try Again!")
                      }

                    },
                    function(err) {
                      console.log(err);
                    }
                  );
                }
        });
        </script>
    </body>
</html>
