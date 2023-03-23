<!DOCTYPE html>
<html>
<head>
	<script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
	<title>test json</title>
	<script src="behavior.js"></script>
</head>

<style>
	#myDiv{
  position: relative;
/*  background-color: black;*/
  top:100px;
  z-index: 5;
  color: black;
/*  text-align: center;*/
	}
</style>

<script>
	fetchContent(); // LOAD JSON FILE !!

</script>

<body onload="loadExhibit()" ></body>

	
		  <div id="myDiv" style="visibility: hidden;" >

		  </div> 
	
<a-scene id="scene">

				<a-assets>

					<a-asset-items id="building" src="Building/building.gltf"></a-asset-items>

				</a-assets>


<a-sky color="lightblue"></a-sky>



		 <a-box id="Κόκκινη βάση" show-list class="clickable" color="red" position="-2 0 -5"></a-box> <!--Έχω βάλει ελληνικά id και με κενό!!! -->

		 <a-box id="Πράσινη βάση" show-list class="clickable" color="green" position="1.5 0 -5"></a-box>

		 <a-box id="Κίτρινη βάση" show-list class="clickable" color="yellow" position="-6 0 -5"></a-box> 

		 <a-box id="Μπλε βάση" show-list class="clickable" color="blue" position="5 0 -5"></a-box>

			<a-camera id="camera">
		
			<a-entity  raycaster="objects:.clickable" cursor="fuse:true; fuseTimeout:2000;" geometry="primitive:sphere; radius-inner:0.01; radius-outer:0.03; radius:0.03" material="color:orange;" position="0 0 -2.5;"  animation__color=" property:material.color; from:#FFA500 ; to: #00FF00; dur: 100; startEvents:mouseenter;" animation__coloreset=" property:material.color; from:#00FF00 ; to: #FFA500; dur: 100; startEvents:mouseleave;" animation__fusing=" property:scale; from: 1 1 1; to: .5 .5 .5; dur: 500; startEvents:mouseenter;" animation__reset="property:scale; to: 1 1 1; startEvents:mouseleave;">		
			</a-entity>
		
	</a-camera>

</a-scene>
</body>
</html>





