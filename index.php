<!DOCTYPE html>
<html>
	<head>
		<script src="https://aframe.io/releases/1.1.0/aframe.min.js"></script>

		<script src="//cdn.rawgit.com/donmccurdy/aframe-physics-system/v4.0.1/dist/aframe-physics-system.min.js"></script>

		<!--ENVIROMENT LIBRARY
		 <script src="https://unpkg.com/aframe-environment-component/dist/aframe-environment-component.min.js"></script> -->

		<!-- ANIMATION LIBRARY
			<script src="https://unpkg.com/aframe-animation-component@^4.1.2/dist/aframe-animation-component.min.js"></script> -->


		<title>XR Exhibitions</title>
		<!-- <script src="script.js"></script> -->
		<script src="behavior.js"></script>
	</head>


	<body>



		<a-scene id="scene" physics="debug:true">

			<a-assets>
				<a-asset-items id="building" src="Building/building.gltf"></a-asset-items>
				<!-- <img id="elden" src="elden.jpg">
				<img id="sky360" src="sky360.jpg">
				<img id="floor" src="floor.jpg"> -->
				<img id="cube1" src="Cube1.png">
				<img id="cube2" src="Cube2.png">
			</a-assets>
		<a-sky color="lightblue"></a-sky>

ΕΔΩ ΕΙΝΑΙ ΤΟ DIV ΜΕ ΤΗΝ ΦΟΡΜΑ ΑΠΟ ΤΟ ΕΓΓΡΑΦΟ ΠΟΥ ΜΟΥ ΣΤΕΙΛΑΤΕ

		<div id="myDiv" style="display:none; width:400px ;height:600px; position:absolute; top:10%; left:10%; z-index:10; border-style:solid;">
			Upload Form
			<button style="position:absolute; right:0%;" onclick="">X</button>


<!-- Δοκιμή με τα ταγκς για το αν διαβάζει το json file. Ύστερα δημιουργία των ταγκ και λούπ μέσω js  -->
			<p></p>
			<img>

		
		</div>


<!-- <a-plane static-body width="20" height="20" rotation="-90 0 0" color="gray"></a-plane> -->
<!-- <a-box test class="clickable" color="pink"></a-box> -->
 

 <!-- 	ΕΜΦΑΝΙΖΕΙ ΤΗΝ ΛΙΣΤΑ ΜΕ ΚΛΙΚ  -->
<a-box east class="clickable" color="green
	" position="14.5 -.5 -2.75" scale="0.75 2.5 1.4 " >
</a-box>

 <!-- 	ΕΜΦΑΝΙΖΕΙ ΤΟ PLANE, ΜΕ ΤΙΣ ΕΙΚΟΝΕΣ ΚΑΝΟΝΤΑΣ ΚΛΙΚ  -->
<a-box showlist north class="clickable" color="yellow
	" position="10 -.5 -4.5" rotation="0 90 0" scale="0.75 2.5 1.4 " >
	
</a-box>
	<a-plane  id="modelbase" color="blue" rotation="0 0 0" position="10 .5 -4.5" width=".3" height=".3"></a-plane>


<a-box id="1st" showlist south class="clickable" color="red
	" position="10 -.5 -.8" rotation="0 90 0" scale="0.75 2.5 1.4 " >
</a-box>


<a-box showlist west class="clickable" color="blue
	" position="-15 -.5 -2.50" scale="0.75 2.5 1.4 " >
</a-box>

<a-box showlist north class="clickable" color="yellow
	" position="-10 -.5 -4.5" rotation="0 90 0" scale="0.75 2.5 1.4 " >
</a-box>

<a-box showlist south class="clickable" color="red
	" position="-10 -.5 -.8" rotation="0 90 0" scale="0.75 2.5 1.4 ">
</a-box>

 <!-- Dynamic box 
  <a-sphere dynamic-body color="blue" position="5 5 0" radius="0.5"></a-sphere> -->

	<a-camera id="camera">
		
			<a-entity  raycaster="objects:.clickable" cursor="fuse:false; fuseTimeout:2000;" geometry="primitive:sphere; radius-inner:0.01; radius-outer:0.03; radius:0.03" material="color:orange;" position="0 0 -2.5;"  animation__color=" property:material.color; from:##FFA500 ; to: #00FF00; dur: 100; startEvents:mouseenter;" animation__coloreset=" property:material.color; from:#00FF00 ; to: #FFA500; dur: 100; startEvents:mouseleave;" animation__fusing=" property:scale; from: 1 1 1; to: .5 .5 .5; dur: 500; startEvents:mouseenter;" animation__reset="property:scale; to: 1 1 1; startEvents:mouseleave;">		
			</a-entity>
		
	</a-camera>

	<a-plane id="list" visible="false" width="2.5" height="3.5" color="white">
		<a-box class="clickable" hidelist width=".2" height=".2" depth=".2" color="red" position="1.1 1.6 0"></a-box>
		<a-image id="cube1" test class="clickable" src="#cube1" width="1" height="1" position="-.7 .9 0.05"></a-image>
		<a-image id="cube2" test class="clickable" src="#cube2" width="1" height="1" position=".5 .9 0.05"></a-image>
	</a-plane>

		
	<a-entity gltf-model="#building" scale="2 2 2" position="-15 -1 17" rotation="0 90 0"></a-entity>


</a-scene>
</body>
</html>

<!-- animation="property: object3D.position.y; to: 2.7; dir: alternate; dur: 1000; loop: true" scaleOnEnter -->




<!--ANIMATED BOX
 <a-box class="clickable" position="0 0 -8" color="blue" animation="property: rotation; from: 0 0 0; to: 0 360 0; dur: 2000; startEvents:click;"></a-box>
 -->



 