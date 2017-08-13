<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="fa/css/font-awesome.min.css"> 
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <style>
        * {
          font-family: 'Pacifico', cursive;
        }
        .TrainConcept{
          font-size: 35px; 
        }
        </style>
        <script type="text/javascript" src="https://sdk.clarifai.com/js/clarifai-latest.js"></script>
    </head>
    <body style="background:#353535;color: #ffffff;">
            <div style="text-align:center">
              <span style="font-size: 40px;">Smart Slate Training</span>
            </div>
            <div style="text-align:center">
                <span style="margin: 10px;">
                    <a class="TrainConcept" href="javascript:void(0)" style="margin: 10px;color: #FFF;" alt="0">0</a>
                    <a class="TrainConcept" href="javascript:void(0)" style="margin: 10px;color: #FFF;" alt="1">1</a>
                    <a class="TrainConcept" href="javascript:void(0)" style="margin: 10px;color: #FFF;" alt="2">2</a>
                    <a class="TrainConcept" href="javascript:void(0)" style="margin: 10px;color: #FFF;" alt="3">3</a>
                    <a class="TrainConcept" href="javascript:void(0)" style="margin: 10px;color: #FFF;" alt="4">4</a>
                    <a class="TrainConcept" href="javascript:void(0)" style="margin: 10px;color: #FFF;" alt="5">5</a>
                    <a class="TrainConcept" href="javascript:void(0)" style="margin: 10px;color: #FFF;" alt="6">6</a>
                    <a class="TrainConcept" href="javascript:void(0)" style="margin: 10px;color: #FFF;" alt="7">7</a>
                    <a class="TrainConcept" href="javascript:void(0)" style="margin: 10px;color: #FFF;" alt="8">8</a>
                    <a class="TrainConcept" href="javascript:void(0)" style="margin: 10px;color: #FFF;" alt="9">9</a>
                    <a class="TrainModel" href="javascript:void(0)" style="margin: 10px 15px 10px 10px;color: #FFF;"><i class="fa fa-wrench fa-2x" aria-hidden="true"></i></a> 
                    <a id="clearCanvas" href="javascript:void(0)" style="margin: 10px;color: #FFF;"><i class="fa fa-eraser fa-2x" aria-hidden="true"></i></a> 
                    
                </span>
            </div>
   
         
           <canvas id="canvasInAPerfectWorld" style="text-align: center;margin: auto;display: block;border: 5px solid white;border-radius: 5px;margin-top: 20px;background: #212121;" width="400px" height="500px"></canvas>     
      
      


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>
            
             
              $(document).ready(function(){
                $("#clearCanvas").click(function(){
                  clearCanvas();
                });
                $("#TrainModel").click(function(){
                   TrainModel();
                });

                $(".TrainConcept").click(function(){
                    var Tdigit = $(this).attr("alt");  
                    var img = new Image();
                    img.src = canva.toDataURL();
                    var imageBase64 = img.src.replace("data:image/png;base64,", "");  
                    feedImage(imageBase64,Tdigit);
                });
              }); 
            
              canva = context = document.getElementById('canvasInAPerfectWorld');
              context = canva.getContext("2d");

              $('#canvasInAPerfectWorld').mousedown(function(e){
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

                var app = new Clarifai.App({apiKey: 'e73cbb00f5e448008f470e9cf0b90b33'});

                

                function feedImage(base64img,digit){
                  app.inputs.create({
                    base64: base64img,
                    concepts: [
                      {
                        id: digit,
                        value: true
                      }
                    ]
                  }); 
                }

                function CreateModel(){
                    app.models.create(
                      "smartSlateIndiaHack",
                      [
                        { "id": "0" },
                        { "id": "1" },
                        { "id": "2" },
                        { "id": "3" },
                        { "id": "4" },
                        { "id": "5" },
                        { "id": "6" },
                        { "id": "7" },
                        { "id": "8" },
                        { "id": "9" }
                      ],
                      [{"conceptsMutuallyExclusive": true}]
                    ).then(
                      function(response) {
                        // do something with response
                      },
                      function(err) {
                        // there was an error
                      }
                    );
                }

                function TrainModel(){
                  app.models.train("smartSlateIndiaHack");
                } 

                function DelModel(){
                  app.models.delete("smartSlateIndiaHack");
                }

                function listModel(){
                  app.models.list();
                }

        </script>
    </body>
</html>
