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
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
        <style type="text/css">
        * {
          font-family: 'Pacifico', cursive;
        }
        html, body {
          overflow: hidden;
          color: #ffffff !important;
          background: #1d1d1d;
          text-shadow: 2px 2px #b5b5b5;
          background-image: url(data:image/png;base64,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);
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
                    <a id="getQuestion" href="javascript:void(0)" style="margin: 10px 15px 10px 10px;color: #FFF;"><i class="fa fa-play fa-2x" aria-hidden="true"></i></a> 
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
        var clickX = new Array();
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
                  responsiveVoice.speak("Draw "+ numbChar);
                }

                var app = new Clarifai.App({apiKey: 'e73cbb00f5e448008f470e9cf0b90b33'});
                function submitAnswer(){
                  var img = new Image();
                  img.src = canva.toDataURL();
                  var imageBase64 = img.src.replace("data:image/png;base64,", "");  
                  if(clickX.length > 1){
                  app.models.predict("ss", {base64: imageBase64}).then(
                    function(response) {
                      console.log(response);
                      var prediction = response.outputs[0].data.concepts[0].name;
                      console.log(prediction+"=========="+response.outputs[0].data.concepts[0].value);
                      console.log(answer);
                      if(prediction==answer){
                        responsiveVoice.speak("Great Job!!!");
                        answer = undefined;
                        clearCanvas();
                      }
                      else{
                        responsiveVoice.speak("Oh no, Try Again!");
                        clearCanvas();
                      }

                    },
                    function(err) {
                      console.log(err);
                    }
                  ); 
                }
                else{
                  responsiveVoice.speak("Follow the instruction!");
                }

                }
        });
        </script>
    </body>
</html>
