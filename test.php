<!DOCTYPE html>
<html>
<head>
	<script src="https://aframe.io/releases/1.3.0/aframe.min.js"></script>
	<title>test json</title>
	<script src="behavior.js"></script>
</head>

<style>
	#myDiv{
  position: relative;
  background-color: black;
  top:100px;
  z-index: 5;
  color: white;
  text-align: center;
	}

</style>
<script>
	fetchContent(); // LOAD JSON FILE !!


	AFRAME.registerComponent("a", {

	init: function(){
	var myVideo = document.querySelector("#video01");
	var videoController = document.querySelector("#videoController");
		 this.el.addEventListener('click',function(){
 	
		 	if(myVideo.paused){
		 		myVideo.play();
		 		videoController.setAttribute("color","red");
		 		}
		 	else{
				myVideo.pause();
				videoController.setAttribute("color","green");
		 		}
		 })
	},
});

	AFRAME.registerComponent("b", {

	init: function(){
	var myDiv = document.querySelector("#myDiv");

		 this.el.addEventListener('click',function(){
		 	myDiv.innerHTML = displayData();

		 })
	},
});

	function displayData(){
		
		var text="";

		for(var i=0; i<data.exhibits.length; i++){
			text+= data.exhibits[i].description+ " ";
		}
		return text;

	}



</script>

<body onload="loadExhibit()"></body>

	
		  <div id="myDiv">


		  </div> 
	
<a-scene id="scene">


				<a-assets>

					<a-asset-items id="building" src="Building/building.gltf"></a-asset-items>
					<!-- <video id="video01" src="videos/MarAlone.mp4" loop="true" ></video> -->

				</a-assets>



<a-sky color="lightblue"></a-sky>

<!-- <a-video a class="clickable" loop src="#video01" position="0 0 -5" width="8" height="4.5">
	<a-box id="videoController" position="0 -3 0" ></a-box>


</a-video>-->

		 <a-box b class="clickable" color="red" position="0 0 -5"></a-box> 

			<a-camera id="camera">
		
			<a-entity  raycaster="objects:.clickable" cursor="fuse:false; fuseTimeout:2000;" geometry="primitive:sphere; radius-inner:0.01; radius-outer:0.03; radius:0.03" material="color:orange;" position="0 0 -2.5;"  animation__color=" property:material.color; from:##FFA500 ; to: #00FF00; dur: 100; startEvents:mouseenter;" animation__coloreset=" property:material.color; from:#00FF00 ; to: #FFA500; dur: 100; startEvents:mouseleave;" animation__fusing=" property:scale; from: 1 1 1; to: .5 .5 .5; dur: 500; startEvents:mouseenter;" animation__reset="property:scale; to: 1 1 1; startEvents:mouseleave;">		
			</a-entity>
		
	</a-camera>

</a-scene>
</body>
</html>





