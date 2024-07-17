<!DOCTYPE html>
<html>
<head>
	<!-- ---------------- -->
	
	<!-- Versions of the building. Default version 1.0.4-->
	<script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>

	<!-- <script src="aframe-master.js"></script> -->
  <script src="js/aframe-gui.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


	<title>3V Grid</title>
	<script src="OptBehavior.js"></script>



</head>

<style>
	#myDiv{

  position: absolute;
/*  background-color: black;*/
  top:50px;
  z-index: 5;
  color: black;
/*  text-align: center;*/
	}
	ul {
  list-style: none;
  padding: 0;
  margin: 0;
	}
	h4{
	display:table;
	padding: 5px;
  margin: 5px 0;
  background-color: #FA6B4F;
  border-radius: 5px;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, .7);
	}
	li{
	display:list-item;
	padding: 2px;
  margin: 5px 0;
  background-color: #F3C5BC60;
  border-radius: 5px;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, .7);
	}
</style>

<script>
	// fetchContent(); // LOAD JSON FILE !!
	// retrieveData();

AFRAME.registerComponent('grid-manager', {
        schema: {
          size: {type: 'number', default: 5}, // number of tiles on one side
          gap: {type: 'number', default: 1}, // gap between tiles
          // rows: {type: 'number', default: 5}, // number of rows
          // columns: {type: 'number', default: 5}, // number of columns
          walls: { type: 'array', default: []}
          
        },
        init: function () {
          const data = this.data;
          const el = this.el;
          const size = data.size;
          const gap = data.gap;

          this.tilesEnabled = true;
          this.tiles = [];
          // const rows = data.rows;
          // const columns = data.columns;

          const walls = [
            { position: { x: -2.65, y: 4, z: -7 }, rotation: { x: 90, y: 90, z: 0 }, rows:3, columns:4 },  // Front wall
            { position: { x: 1.8, y: 4, z: -7 }, rotation: { x: 90, y: 90, z: 0 }, rows:3, columns:4 },  // Back wall
            { position: { x: 7, y: 4, z: -4.86 }, rotation: { x: 90, y: 90, z: 90 }, rows:3, columns:4 },  // Left wall
            { position: { x: 14, y: 4, z: -0.45 }, rotation: { x: 90, y: 180, z: 0 }, rows:3, columns:8 },  // Right wall
            { position: { x: -9.7, y: 4, z: -4.9 }, rotation: { x: 90, y: 0, z: 0 }, rows:3, columns:2 },  // Top wall
            { position: { x: -4.5, y: 4, z: -0.45 }, rotation: { x:90, y: 180, z: 0 }, rows:3, columns:8 },
            { position: { x: -16.55, y: 4, z: -2 }, rotation: { x: 90, y: 90, z: 0 }, rows:3, columns:2 },
            { position: { x: 15.3, y: 4, z: -3.5 }, rotation: { x: 90, y: 0, z: 90 }, rows:3, columns:2 },
            { position: { x: -0.5, y: 4, z: 1 }, rotation: { x: 90, y: 180, z: 0}, rows:3, columns:1 }  // Bottom wall
          ];
          


          walls.forEach((wall, index) => {
            this.createGrid(wall.position, wall.rotation, size, gap, wall.rows, wall.columns, index);
          });


          window.addEventListener('keydown', (event) => {
            if (event.key === 't') { // Change 't' to any key you prefer
              this.toggleTiles();
            }
          });


        },
        createGrid: function (position, rotation, size, gap, rows, columns, wallIndex) {
          const el = this.el;
          const gridContainer = document.createElement('a-entity');
          gridContainer.setAttribute('position', position.x + ' ' + position.y + ' ' + position.z);
          gridContainer.setAttribute('rotation', rotation.x + ' ' + rotation.y + ' ' + rotation.z);

          // gridContainer.setAttribute('position', `${position.x} ${position.y} ${position.z}`);
      		// gridContainer.setAttribute('rotation', `${rotation.x} ${rotation.y} ${rotation.z}`);
          gridContainer.setAttribute('class', 'wallgrid');


          for (let i = 0; i < rows; i++) {
            for (let j = 0; j < columns; j++) {
              const x = j * (size + gap);
              const z = i * (size + gap);
              const tile = document.createElement('a-box');
              tile.setAttribute('position', `${x} 0 ${z}`);
              tile.setAttribute('width', size);
              tile.setAttribute('height', 0.1); // Thin height for the tiles
              tile.setAttribute('depth', size);
              tile.setAttribute('color', 'lightyellow');
              tile.setAttribute('class', 'gridtile enable');
              tile.setAttribute('data-x', j);
              tile.setAttribute('data-y', i);
              tile.setAttribute('datawall', wallIndex);  // Store the wall index
              gridContainer.appendChild(tile);

              this.tiles.push(tile);
            }
          }

          el.appendChild(gridContainer);

					gridContainer.addEventListener('click', (event) => {
					  if (event.target.classList.contains('gridtile')) {
					    const x = event.target.getAttribute('data-x');
					    const y = event.target.getAttribute('data-y');
					    const wallIndex = event.target.getAttribute('datawall');

					    // Remove highlight from previously selected tile
					    const previousSelectedTile = document.querySelector('.gridtile.selected');
					    if (previousSelectedTile) {
					      previousSelectedTile.setAttribute('color', 'lightyellow');
					      previousSelectedTile.classList.remove('selected');
					    }

					    // Highlight the new selected tile
					    event.target.setAttribute('color', 'green');
					    event.target.classList.add('selected');

					    console.log(`Tile selected at (${x}, ${y}) on wall ${wallIndex}`);
					  }
					});
        },
        toggleTiles: function () {
          this.tilesEnabled = !this.tilesEnabled; // Toggle the state
          this.tiles.forEach(tile => {
            tile.setAttribute('visible', this.tilesEnabled); // Toggle visibility
            tile.classList.toggle('disable', !this.tilesEnabled); // Toggle disabled class
            tile.classList.toggle('enable',this.tilesEnabled);
          });
        }
      });



</script>

<!-- <body onload="loadExhibit()"></body>  -->

	
	<div id="myDiv"></div> <!--ΑΝ ΜΕΤΑΚΙΝΗΣΩ ΤΟ DIV ΔΕΝ ΘΑ ΛΕΙΤΟΥΡΓΕΙ ΣΩΣΤΑ Η ΕΜΦΑΝΙΣΗ ΤΗΣ ΛΙΣΤΑΣ -->
	

 <a-scene id="scene">

				<a-assets>

					<a-asset-items id="building" src="Building/building.gltf"></a-asset-items>

				</a-assets>


<a-sky color="lightblue"></a-sky>

<a-entity >
<a-entity gltf-model="#building" scale="2 2 2" position="-15 -0.5 17" rotation="0 90 0"></a-entity>
</a-entity>


<a-entity grid-manager="size: 1; gap: 0.5;" position="0 0 0"></a-entity>


	<a-camera wasd-controls="acceleration:100" id="camera">
		
			<a-entity  id="cursor" raycaster="objects:.clickable, [gui-interactable], .info, .enable" cursor="fuse:false; fuseTimeout:2000;" geometry="primitive:sphere;radius:0.03" material="color:orange;" position="0 0 -2.5;"  animation__color=" property:material.color; from:#FFA500 ; to: #00FF00; dur: 100; startEvents:mouseenter;" animation__coloreset=" property:material.color; from:#00FF00 ; to: #FFA500; dur: 100; startEvents:mouseleave;" animation__fusing=" property:scale; from: 1 1 1; to: .5 .5 .5; dur: 500; startEvents:mouseenter;" animation__reset="property:scale; to: 1 1 1; startEvents:mouseleave;">		
			</a-entity>
	</a-camera>

</a-scene> 



<script>

	// function testVarFunction() {
	// 	var elements = document.querySelectorAll(".rename");

	// 	var labelValue ="";

	// 	elements.forEach(function(element) {
  //   	element.setAttribute("value", labelValue);
  // 		});
		
	// }	
		window.test = function(label) {
			label.setAttribute("value", label.id);
			var panel = label.parentNode;

		}


</script>
</body>
</html>





