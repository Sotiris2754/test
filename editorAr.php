<?php 
session_start();


if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){

?>



<!DOCTYPE html>
<html>
<head>
	<!-- ---------------- -->
	
	<!-- Versions of the building. Default version 1.0.4-->
	<script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>

	<!-- <script src="aframe-master.js"></script> -->
  <script src="js/aframe-gui.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

  <!-- <script src="https://cdn.jsdelivr.net/gh/AR-js-org/AR.js/aframe/build/aframe-ar.min.js"></script> -->


	<title>Exhibit Panel Changed</title>
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
	fetchContent(); // LOAD JSON FILE !!
	retrieveData();
	

	let thesi;
	const worldPosition = new THREE.Vector3();
	let tile;
	let counter=0;
	let transparent = 100;
	// insertTilesToDatabase();
	let displayPos;

// AFRAME.registerComponent('pop-up',{
// 	init:function(){
// 		let exhibit = this.el;
		
// 		exhibit.addEventListener('click', (event) => {

// 			if(exhibit.classList.contains('exhibit')) {
				
// 				const popup = document.querySelector('#popup');
// 				popup.setAttribute();

// 			}
// 		});
// 	}
// });

// Detect user platform and serve the corresponding web page
AFRAME.registerComponent('devicecheck', {
    init: function () {

        let el = this.el;
        let mobile = AFRAME.utils.device.isMobile();
        let vr = AFRAME.utils.device.isMobileVR();
        window.mobileCheck();

        if(window.mobileCheck() == true){

            // window.location = 'grid.php'
            console.log("mobile check. Redirect to FUSE function");
        } else if(vr){

            window.location = 'grid4.php'
            console.log("vr check. Redirect to ...?");
        }

        else {
            // window.location = 'grid5.php'
            console.log("Editor Desktop");
        		return;

        }

    }
});


window.mobileCheck = function() {
    let check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
};

AFRAME.registerComponent('image-hover', {
	init: function(){
		var kid = this.el;
		let image = document.querySelector('#imagePreview');
		var parent = kid.parentNode;
		let size = parent.children.length;
		let pos;
		let rot;
		// console.log(parent);

		let container = document.querySelectorAll("a-gui-flex-container");

		const kidArray1 = Array.from(container[0].children); // PROSOXI EDW ME POIO FLEX CONTAINER FTIAXNW TO ARRAY
		let index1 = kidArray1.indexOf(kid);

		const kidArray2 = Array.from(container[2].children);
		// console.log(kidArray2); // PROSOXI EDW ME POIO FLEX CONTAINER FTIAXNW TO ARRAY
		let index2 = kidArray2.indexOf(kid);



		kid.addEventListener('mouseenter', function(){
			// console.log(parent.children.length);
			// console.log(kidArray2);
		// console.log(parent.getAttribute('rotation'));
		pos = parent.getAttribute('position');
		rot = parent.getAttribute('rotation');
		// console.log(rot);
		// console.log(size);

			if(size==3){
				image.setAttribute('visible',true);
				// console.log(parent);
				// console.log(rot);

				image.setAttribute('position', pos.x + ' ' + (pos.y + 0.6) + ' ' + pos.z);
				image.setAttribute('rotation', rot.x + ' ' + rot.y + ' ' + rot.z);
				// console.log(image.getAttribute('rotation'));

				// console.log(index2);
				switch(index1) {
				  case 0:
				    image.setAttribute('src','#image0');

				    break;

				  case 1:
				    
				    image.setAttribute('src','#imagebase2');
				    
				    break;

				  case 2:
				  // Add more cases as needed
				  	image.setAttribute('src','#imagebase3');
				  	break;
				}				
			}
			if(size>4){
				// console.log(index2);

				image.setAttribute('visible',true);
				let grandParent = parent.parentNode;
				pos = grandParent.getAttribute('position');
				rot = grandParent.getAttribute('rotation');
				// console.log(grandParent.getAttribute('position'));
				// console.log(rot);

				// var value = kid.getAttribute('value');
				image.setAttribute('position', pos.x  + ' ' + (pos.y + 0.6) + ' ' + pos.z );
				image.setAttribute('rotation', rot.x + ' ' + rot.y + ' ' + rot.z);
				// console.log(image.getAttribute('rotation'));
				switch(index2) {
				  case 0:
				    if(page==1)
				  		image.setAttribute('src','#image0');
				  	else
				  		image.setAttribute('src','#image5');
				    break;

				  case 1:
				    
				    if(page==1)
				  		image.setAttribute('src','#image1');
				  	else
				  		image.setAttribute('src','#image6');
				    break;

				  case 2:
				  // Add more cases as needed
				    if(page==1)
				  		image.setAttribute('src','#image2');
				  	else
				  		image.setAttribute('src','#image7');
				  	break;

				  case 3:
				    if(page==1)
				  		image.setAttribute('src','#image3');
				  	else
				  		image.setAttribute('src','#image8');

				    break;

				  case 4:
				    if(page==1)
				  		image.setAttribute('src','#image4');
				  	else
				  		image.setAttribute('src','#image9');
				    break;

				}
			}


		});



		kid.addEventListener('mouseleave', function(){
			// console.log("Vgika apo to element");
			image.setAttribute('position','0 100 0');
			// parent.setAttribute('position','0 100 0');

		})
	}
});


AFRAME.registerComponent('grid-manager', {
        schema: {
          size: {type: 'number', default: 5}, // number of tiles on one side
          gap: {type: 'number', default: 1}, // gap between tiles
          walls: {type: 'array', default: []},
          depth: {type: 'number', default: 1},
          height: {type: 'number', default: 1},
          pleura: {type: 'string', default: "wall"}
          
        },
        init: function () {
          const data = this.data;
          const el = this.el;
          const size = data.size;
          const gap = data.gap;
          const depth = data.depth;
          const height = data.height;
          const pleura = data.pleura;
          

          this.tilesEnabled = true;
          this.tiles = [];


          // const rows = data.rows;
          // const columns = data.columns;

          const walls = [
            { position: { x: -2.65, y: 0.45, z: -7 }, rotation: { x: 90, y: 90, z: 0 }, depth:2, height:0.1, rows:1, columns:3, centerPos: { x:-0.9, y:1.6, z:-4.5 }, centerRot:{ x:0, y:90, z:0}, pleura: "wall" },

            { position: { x: -2.2, y: -0.5, z: -7 }, rotation: { x: 90, y:90, z: 0 }, depth:0.1, height:1, rows:1, columns:3, centerPos: { x:-0.9, y:1.6, z:-4.5 }, centerRot:{ x:0, y:90, z:0}, pleura: "floor" },


              // Front wall
            { position: { x: 1.8, y: 0.45, z: -11 }, rotation: { x: 90, y: 0, z: 90 }, depth:2, height:0.1, rows:1, columns:3, centerPos: { x:0.45, y:1.6, z:-4.5 }, centerRot:{ x:0, y:-90, z:0}, pleura: "wall" },

            { position: { x: 1.35, y: -0.5, z: -11 }, rotation: { x: 90, y:0, z: 90 }, depth:0.1, height:1, rows:1, columns:3, centerPos: { x:0.45, y:1.6, z:-4.5 }, centerRot:{ x:0, y:-90, z:0}, pleura: "floor" },


              // Back wall
            { position: { x: 7, y: 0.45, z: -4.86 }, rotation: { x: 90, y: 90, z: 90 }, depth:2, height:0.1, rows:1, columns:4, centerPos: { x:4.5, y:1.6, z:-2 }, centerRot:{ x:0, y:0, z:0}, pleura: "wall" },

            { position: { x: 7, y: -0.5, z: -4.4 }, rotation: { x: 90, y:90, z: 90 }, depth:0.1, height:1, rows:1, columns:4, centerPos: { x:4.5, y:1.6, z:-2 }, centerRot:{ x:0, y:0, z:0}, pleura: "floor" },


             // Left wall
            { position: { x: 14, y: 0.45, z: -0.45 }, rotation: { x: 90, y: 180, z: 0 }, depth:2, height:0.1, rows:1, columns:6, centerPos: { x:4.5, y:1.6, z:-0.5 }, centerRot:{ x:0, y:180, z:0}, pleura: "wall" },

            { position: { x: 14, y: -0.5, z: -0.9 }, rotation: { x: 90, y:180, z: 0 }, depth:0.1, height:1, rows:1, columns:6, centerPos: { x:4.5, y:1.6, z:-0.5 }, centerRot:{ x:0, y:180, z:0}, pleura: "floor" },


              
            { position: { x: -9.7, y: 0.45, z: -4.9 }, rotation: { x: 90, y: 0, z: 0 }, depth:2, height:0.1, rows:1, columns:2, centerPos: { x:-4.5, y:1.6, z:-2.25 }, centerRot:{ x:0, y:0, z:0}, pleura: "wall" },

            { position: { x: -9.7, y: -0.5, z: -4.45 }, rotation: { x: 90, y:0, z: 0 }, depth:0.1, height:1, rows:1, columns:2, centerPos: { x:-4.5, y:1.6, z:-2.25 }, centerRot:{ x:0, y:0, z:0}, pleura: "floor" },


             
            { position: { x: -4.5, y: 0.45, z: -0.45 }, rotation: { x:90, y: 180, z: 0 }, depth:2, height:0.1, rows:1, columns:6, centerPos: { x:-4.5, y:1.6, z:-0.5 }, centerRot:{ x:0, y:180, z:0}, pleura: "wall" },

            { position: { x: -4.5, y: -0.5, z: -0.9 }, rotation: { x: 90, y:180, z: 0 }, depth:0.1, height:1, rows:1, columns:6, centerPos: { x:-4.5, y:1.6, z:-0.5 }, centerRot:{ x:0, y:180, z:0}, pleura: "floor" },


            { position: { x: -16.55, y: 0.45, z: -2.65 }, rotation: { x: 90, y: 90, z: 0 }, depth:2, height:0.1, rows:1, columns:1, centerPos: { x:-7.75, y:1.6, z:-1.35 }, centerRot:{ x:0, y:90, z:0}, pleura: "wall" },

            { position: { x: -16.05, y: -0.5, z: -2.65 }, rotation: { x: 90, y:90, z: 0 }, depth:0.1, height:1, rows:1, columns:1, centerPos: { x:-7.75, y:1.6, z:-1.35 }, centerRot:{ x:0, y:90, z:0}, pleura: "floor" },




            { position: { x: 15.3, y: 0.45, z: -2.65 }, rotation: { x: 90, y: 0, z: 90 }, depth:2, height:0.1, rows:1, columns:1, centerPos: { x:7.15, y:1.6, z:-1.35 }, centerRot:{ x:0, y:-90, z:0}, pleura: "wall" },

            { position: { x: 14.9, y: -0.5, z: -2.65 }, rotation: { x: 90, y:0, z: 90 }, depth:0.1, height:1, rows:1, columns:1, centerPos: { x:7.15, y:1.6, z:-1.35 }, centerRot:{ x:0, y:-90, z:0}, pleura: "floor" },



            { position: { x: -0.5, y: 0.45, z: 1.5 }, rotation: { x: 90, y: 180, z: 0}, depth:2, height:0.1, rows:1, columns:1, centerPos: { x:-0.25, y:1.6, z:0 }, centerRot:{ x:0, y:180, z:0}, pleura: "wall" },

            { position: { x: -0.5, y: -0.5, z: 1 }, rotation: { x: 90, y:180, z: 0 }, depth:0.1, height:1, rows:1, columns:1, centerPos: { x:-0.25, y:1.6, z:0 }, centerRot:{ x:0, y:180, z:0}, pleura: "floor" }


          ];
          


          walls.forEach((wall, index) => {
            this.createGrid(wall.position, wall.rotation, size, wall.depth, wall.height, gap, wall.rows, wall.columns, index, wall.centerPos, wall.centerRot, wall.pleura);
          });


          window.addEventListener('keydown', (event) => {
            if (event.key === 't') { // Change 't' to any key you prefer
              this.toggleTiles();

            }
          });



          

        },
        createGrid: function (position, rotation, size, depth, height, gap, rows, columns, wallIndex, centerPos,centerRot, pleura) {
          const el = this.el;
          const gridContainer = document.createElement('a-entity');
          // gridContainer.setAttribute('scale','0.5 0.5 0.5');
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
              tile.setAttribute('id', counter);
              tile.setAttribute('position', `${x} 0 ${z}`);
              tile.setAttribute('width', size);
              tile.setAttribute('height', height); // Thin height for the tiles
              tile.setAttribute('depth', depth);              	
              tile.setAttribute('color', '#697565');
              // tile.setAttribute('material', {src:'#gradient'});
              if(pleura=='floor'){
              	// tile.setAttribute('material','color: #d203fc; opacity: 0.8');
              	// tile.setAttribute('material', {src:'#gradient'});
              	tile.setAttribute('color', '#ECDFCC');
              }
              tile.setAttribute('class', 'gridtile enable toggle-visibility ' + `${pleura}`);
              tile.setAttribute('data-x', j);
              tile.setAttribute('data-y', i);
              tile.setAttribute('datawall', wallIndex); // Store the wall index
              tile.setAttribute('show-gui',"");
              gridContainer.appendChild(tile);
              // insertTilesToDatabase();
              this.tiles.push(tile);
              counter++;
            }
          }

          el.appendChild(gridContainer);

					gridContainer.addEventListener('click', (event) => {

					  const x = event.target.getAttribute('data-x');
					  const y = event.target.getAttribute('data-y');
					  const wallIndex = event.target.getAttribute('datawall');

					  const panelExhibit = document.querySelector("#panelExhibit");
					  const panelBase = document.querySelector('#panelBase');
					  const spotLight = document.querySelector('#spotlight');


					//CLICK STA TILES --------> TOPOTHETISI PANEL GIA EISAGWGI EKTHEMATOS

					  if (event.target.classList.contains('gridtile')) {

              const previousSelectedTile = document.querySelector('.gridtile.selected');
              const popup = document.querySelector('#frame');

              


		          if (event.target.classList.contains('selected')) {

		          	if(event.target.classList.contains('floor')){
		          		previousSelectedTile.setAttribute('color', '#ECDFCC');
		          	}
		          	else
		          		previousSelectedTile.setAttribute('color', '#697565');

		            previousSelectedTile.classList.remove('selected');
		            panelExhibit.setAttribute('visible',false);
		            spotLight.setAttribute("visible", false);
		            panelExhibit.setAttribute('position','0 100 0');
		            panelBase.setAttribute('visible',false);
		            panelBase.setAttribute('position','0 100 0');


		            // console.log(`Tile selected at (${x}, ${y}) on wall ${wallIndex}`);
		          }
							else{

							    if(previousSelectedTile){
										console.log("2: ")
							    	console.log(previousSelectedTile)

							    	// previousSelectedTile.setAttribute('color','lightyellow');
		          		if(previousSelectedTile.classList.contains('floor')){
		          			previousSelectedTile.setAttribute('color', '#ECDFCC');
		          	}
		          	else if(previousSelectedTile.classList.contains('wall')) {
		          		previousSelectedTile.setAttribute('color', '#697565');
		          	}

							    previousSelectedTile.classList.remove('selected');

							    }
							    
							    event.target.setAttribute('color', 'green');
							    event.target.classList.add('selected');

							  	if(event.target.classList.contains('wall')){
							  		popup.setAttribute("visible",false);
							  		spotLight.setAttribute("visible", false);
							  		panelBase.setAttribute('visible',false);
							  		panelBase.setAttribute('position','0 100 0');
							  		panelExhibit.setAttribute('visible',true);
								    panelExhibit.setAttribute("position", centerPos.x + ' ' + centerPos.y + ' ' + centerPos.z);
								    panelExhibit.setAttribute("rotation", centerRot.x + ' ' + centerRot.y + ' ' + centerRot.z); 
							  	}

							  	else if(event.target.classList.contains('floor')){
							  		popup.setAttribute("visible",false);
							  		spotLight.setAttribute("visible", false);
							  		panelExhibit.setAttribute('visible',false);
							  		panelExhibit.setAttribute('position','0 100 0');
							  		panelBase.setAttribute('visible',true);
								    panelBase.setAttribute("position", centerPos.x + ' ' + centerPos.y + ' ' + centerPos.z);
								    panelBase.setAttribute("rotation", centerRot.x + ' ' + centerRot.y + ' ' + centerRot.z);
							  	}

							    tile = event.target;
							    // thesi = event.target.object3D;
							    // thesi.getWorldPosition(worldPosition);
							    // console.log(`Tile selected at (${x}, ${y}) on wall ${wallIndex}`);
							}
					  }
					  else if(event.target.classList.contains('exhibit')){
					  	
					  	let arg = event.target.id.split('.')[0]; //keeping the first digit of the exhibits id (1.1, 2.2 etc)
					  	// let value = data.exhibits[arg].description.length;
					  	let newPos = new THREE.Vector3();
					  	event.target.object3D.getWorldPosition(newPos);
					  	// console.log(newPos.z);
					  	spotLight.setAttribute("position", newPos.x +' '+ 3 +' '+ newPos.z );
					  	popUpValue2(arg,centerPos,centerRot);

					  }
					});
        },

        toggleTiles: function () {
          this.tilesEnabled = !this.tilesEnabled; // Toggle the state

            if(transparent===100)
            	transparent = 0;
            else
            	transparent = 100;
		          panelExhibit.setAttribute('visible',false);
		          panelExhibit.setAttribute('position','0 100 0');
							panelBase.setAttribute('visible',false);
		          panelBase.setAttribute('position','0 100 0');
		          if(tile){
		          	tile.classList.remove('selected');

		          		if(tile.classList.contains('floor')){
		          			tile.setAttribute('color', '#ECDFCC');
		          	}
		          	else if(tile.classList.contains('wall')) {
		          		tile.setAttribute('color', '#697565');
		          	}
		          	// tile.setAttribute('color', 'lightyellow');
		        	}
          this.tiles.forEach(tile => {
            tile.setAttribute('material', {opacity:transparent}); // Toggle visibility
            tile.classList.toggle('disable', !this.tilesEnabled); // Toggle disabled class
            tile.classList.toggle('enable',this.tilesEnabled);
            


          });
        }

      });




function importExhibit(entity){
	let exhibit = document.createElement('a-entity');
	let container = document.querySelectorAll("a-gui-flex-container");
	let kid = entity;
	const kidArray = Array.from(container[2].children); // PROSOXI EDW ME POIO FLEX CONTAINER FTIAXNW TO ARRAY
	let index = kidArray.indexOf(kid);

	console.log(index);

	removeChild();
						if(page==2)
						index+= 5;
					exhibit.setAttribute('position', data.exhibits[index].position);
					exhibit.setAttribute('rotation', "-90 0 0"); 


					// console.log(index);

					exhibit.setAttribute('scale',data.exhibits[index].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
					exhibit.setAttribute('id',index+"."+index);
					exhibit.setAttribute('class','clickable exhibit');
					// exhibit.setAttribute("show-panel","");
					exhibit.setAttribute("pop-up","");
					tile.appendChild(exhibit);
					if(index!=0)
					// exhibit.setAttribute('gltf-model',`url(${data.exhibits[index].pathfile})`);
					exhibit.setAttribute('geometry',{
						primitive: data.exhibits[index].shape,
						width:data.exhibits[index].width,
						height:data.exhibits[index].height,
						depth:data.exhibits[index].depth,
						radius: data.exhibits[index].radius,
						radiusBottom: data.exhibits[index].radiusBottom,
						radiusTop: data.exhibits[index].radiusTop,
						radiusTubular:data.exhibits[index].radiusTubular,
						detail: data.exhibits[index].detail
					});
					exhibit.setAttribute('material',{color: data.exhibits[index].color});
					console.log(exhibit);
					// else
					// 	exhibit.remove(); //Einai to idio me to "exhibit.remove();"
					storeData();



	function storeData(){

	  $.ajax({
	  url: "sql.php",
	  method: "POST",
	  data: { id:tile.id, exhibit:data.exhibits[index].id, action:"store"},
	  success: function(response) {
	    console.log("Selection stored successfully.");
	    // console.log(id);
	    // console.log(exhibit);
	   	//console.log(response);
	  },
	  		error: function(xhr, status, error) {
	    	console.log("An error occurred: " + error);
	  		}
		});
	}
}

	function retrieveData(){
		$.ajax({
			url:"sql.php",
			method:"POST",
			data: {action:"retrieve"},
			success: function(res) {
				
	    		console.log("Success Response");
	    		var json = JSON.parse(res);
	    		// console.log(json);
				if (data == null)
				{
					console.log("2nd Not ready yet!");
					setTimeout(retrieveData(),1);
				}
				else{
					console.log("Exhibits have been loaded successfully");
		    	for (var i=0; i<json.length; i++){
		    		let testId = document.getElementById(json[i].id);
		    		// console.log(testId);
		    	// // count = json.length;
		    	// console.log(data.exhibits[i].id +" " +data.exhibits[i].pathfile + "\n");


					
					if(json[i].exhibit!= null){
							var exhibit = document.createElement('a-entity');		
							exhibit.setAttribute('id',data.exhibits[json[i].exhibit].id+"."+data.exhibits[json[i].exhibit].id);
							exhibit.setAttribute('scale',data.exhibits[json[i].exhibit].scale);
							exhibit.setAttribute('position', data.exhibits[json[i].exhibit].position );
							exhibit.setAttribute('rotation', "-90 0 0"); 
							exhibit.setAttribute('class','clickable exhibit');
							exhibit.setAttribute("pop-up","");
							testId.appendChild(exhibit);
							if(json[i].exhibit!=0)
								// 
					exhibit.setAttribute('geometry',{
						primitive: data.exhibits[json[i].exhibit].shape,
						width:data.exhibits[json[i].exhibit].width,
						height:data.exhibits[json[i].exhibit].height,
						depth:data.exhibits[json[i].exhibit].depth,
						radius: data.exhibits[json[i].exhibit].radius,
						radiusBottom: data.exhibits[json[i].exhibit].radiusBottom,
						radiusTop: data.exhibits[json[i].exhibit].radiusTop,
						radiusTubular:data.exhibits[json[i].exhibit].radiusTubular,
						detail: data.exhibits[json[i].exhibit].detail
					});
				exhibit.setAttribute('material',{color: data.exhibits[json[i].exhibit].color});
							// else
							// 	exhibit.remove();	
					}
					if(json[i].base!=null){
							var base = document.createElement('a-entity');
							base.setAttribute('position', "0 0 0" );
							base.setAttribute('rotation', "-90 0 0");
							base.setAttribute('scale',data.stands[json[i].base].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
							base.setAttribute('id',"test");
							if(json[i].base!=0)
							base.setAttribute('gltf-model',`url(${data.stands[json[i].base].pathfile})`);
							testId.appendChild(base);
					}
	    		 }
	  		}
	  	}
		
		});
	}


function importBase(entity){
	let base = document.createElement('a-entity');

	let container = document.querySelectorAll("a-gui-flex-container");
	let kid = entity;
	const kidArray = Array.from(container[0].children); // PROSOXI EDW ME POIO FLEX CONTAINER FTIAXNW TO ARRAY
	let index = kidArray.indexOf(kid);
	// console.log(kid);
	// console.log(index);


	// console.log(kidArray);

	removeChild();

					base.setAttribute('position', "0 0 0" );
					base.setAttribute('rotation', "-90 0 0");

					base.setAttribute('scale',data.stands[index].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
					base.setAttribute('id',"test");
					// base.setAttribute('class','clickable');
					
					if(index!=0)
					base.setAttribute('gltf-model',`url(${data.stands[index].pathfile})`);

					tile.appendChild(base);


					storeDataBase();


	function storeDataBase(){
	  $.ajax({

	  url: "sql.php",
	  method: "POST",
	  data: { id:tile.id, base:data.stands[index].id, action:"storebase"},
	  success: function(response) {
	    console.log("Selection stored successfully.");
	    // console.log(id);
	    // console.log(exhibit);
	   	//console.log(response);
	  },
	  		error: function(xhr, status, error) {
	    	console.log("An error occurred: " + error);
	  		}
		});
	}
}
function deleteDB(){
	  $.ajax({
	  url: "sql.php",
	  method: "POST",
	  data: {action:"delete"},
	  success: function(response) {
	    console.log("Database Deleted successfully.");
	  },
	  		error: function(xhr, status, error) {
	    	console.log("An error occurred: " + error);
	  		}
		});
}


AFRAME.registerComponent('spatial-occlusion', {
    schema: {
      wallClass: { type: 'string', default: 'invisible-wall' } // Class for wall objects
    },

    init: function () {
      // Find all walls in the scene
      this.walls = Array.from(document.querySelectorAll(`.${this.data.wallClass}`));
      this.raycaster = new THREE.Raycaster(); // Raycaster for line-of-sight checks
    },

    tick: function () {
      const camera = this.el.sceneEl.camera.el.object3D;
      const cameraPosition = new THREE.Vector3().setFromMatrixPosition(camera.matrixWorld);
      const entities = Array.from(document.querySelectorAll('.toggle-visibility'));

      entities.forEach(entity => {
        const entityPosition = new THREE.Vector3().setFromMatrixPosition(entity.object3D.matrixWorld);

        // Check if the entity is occluded by any walls
        const isOccluded = this.isOccluded(cameraPosition, entityPosition);

        // Update entity visibility
        entity.setAttribute('visible', !isOccluded);
      });
    },

    isOccluded: function (cameraPosition, entityPosition) {
      // Set up raycaster
      this.raycaster.set(cameraPosition, entityPosition.clone().sub(cameraPosition).normalize());

      // Test intersections with walls
      const intersections = this.raycaster.intersectObjects(
        this.walls.map(wall => wall.object3D),
        true
      );

      // If there are intersections, check if any are closer than the entity
      if (intersections.length > 0) {
        const closestIntersection = intersections[0].distance;
        const entityDistance = cameraPosition.distanceTo(entityPosition);

        // If a wall is closer than the entity, the entity is occluded
        return closestIntersection < entityDistance;
      }

      // No intersections, entity is visible
      return false;
    }
  });

</script>

<!-- <body onload="loadExhibit()"></body>  -->

	
	<div id="myDiv"></div> <!--ΑΝ ΜΕΤΑΚΙΝΗΣΩ ΤΟ DIV ΔΕΝ ΘΑ ΛΕΙΤΟΥΡΓΕΙ ΣΩΣΤΑ Η ΕΜΦΑΝΙΣΗ ΤΗΣ ΛΙΣΤΑΣ -->
	

 <a-scene devicecheck id="scene">


<a-entity light="color: #BBB; type: ambient"></a-entity>
<a-entity light="intensity: 0.6; castShadow: true" position="-0.5 1 1" ></a-entity>

<a-entity  id="spotlight" position="-0.2 4 -0.1" light="angle: 20; color: #fadda0; intensity: 2.0; penumbra: 1; type: spot;  shadowBias: -5; shadowCameraBottom: -6.9" rotation="-104.01 0 0" visible="false"></a-entity>

				<a-assets>
					<!-- Υπάρχουν διαφορετικές εκδόσεις του 3d κτιρίου. Τώρα χρησιμοποιείται το id="testo01"  -->
					<a-asset-items id="building" src="Building/building.gltf"></a-asset-items>

					<a-asset-items id="newbuilding" src="Building/newBuilding.gltf"></a-asset-items>
					
					<a-asset-items id="test01" src="Building/test01/test01.gltf"></a-asset-items>

					<!-- Δοκιμή με Obj & Mtl 3d files -->
					<a-asset-items id="test01-obj" src="Building/test01/test01.obj"></a-asset-items>
					<a-asset-items id="test01-mtl" src="Building/test01/test01.mtl"></a-asset-items>
					<!-- ...  -->


					<a-asset-items id="statue" src="StatueBases.obj"></a-asset-items>


<!-- 			<a-asset-items id="base1" src="models/3dbases/base3/base3.gltf"></a-asset-items>
					<a-asset-items id="base2" src="models/3dbases/base2/base2.gltf"></a-asset-items>
					<a-asset-items id="base3" src="models/3dbases/base3/base3.gltf"></a-asset-items> -->


					<!-- Παλιότερες εικόνες εκθεμάτων 
					<img id="c1" src="images/c1.png"></img>
					<img id="c2" src="images/c2.png"></img>
					<img id="c3" src="images/c3.png"></img>
					-->

					<img id="gradient" src="images/lightyellow.jpg"></img>
					<img id="imagebase2" src="images/base2.png"></img>
					<img id="imagebase3" src="images/base3.png"></img>
					
					<img id="image0" src="images/0.png"></img>
					<img id="image1" src="images/1.png"></img>
					<img id="image2" src="images/2.png"></img>
					<img id="image3" src="images/3.png"></img>
					<img id="image4" src="images/4.png"></img>
					<img id="image5" src="images/5.png"></img>
					<img id="image6" src="images/6.png"></img>
					<img id="image7" src="images/7.png"></img>
					<img id="image8" src="images/8.png"></img>
					<img id="image9" src="images/9.png"></img>

					<img id="close" src="images/exit.png"></img>


				</a-assets>


<a-sky color="lightblue"></a-sky>

<a-entity scale="0.5 0.5 0.5" position="0 .5 0">

<!-- <a-entity >
<a-entity gltf-model="#test01" scale="2 2 2" position="-.9 -0.5 -8.7" rotation="0 -90 0"></a-entity>
</a-entity> -->

  <a-entity geometry="primitive: box; height: 4; width: 0.1; depth: 10"
            material="opacity: 0; transparent: true; color:red"
            position="2 1.2 -10" class="invisible-wall"></a-entity>

<a-box class="toggle-visibility" position="0 0 -5" color="yellow"></a-box>
<a-box class="toggle-visibility" position="-8 0 -2.5" color="yellow"></a-box>
<a-box class="toggle-visibility" position="8 0 -2.5" color="yellow"></a-box>
<!-- <a-entity>
	<a-entity obj-model="obj: #test01-obj; mtl: #test01-mtl"></a-entity>
</a-entity> -->

<a-entity  grid-manager="size: 1; gap: 1;" position="0 0 0"></a-entity>

</a-entity>



<a-image id="imagePreview"  scale="0.5 0.5 0.5" position="0 1 -5" src="" visible="false" ></a-image>


<a-entity id="frame" position=" -0.2 1 -5" visible="false">

	<a-plane color="#ECDFCC" id="panel" width="1.5" height="0.75">

		<a-text  id="infoText" align="center" width="2"></a-text>
		<a-image id="exitbutton" closebutton class="clickable" src="#close" scale="0.2 0.2 0.2" position="0.6 .25 0.01"></a-image>
	
	</a-plane>	

</a-entity>


<script>
	function popUpValue2(id,centerPos, centerRot){
		const popup = document.querySelector('#frame');
		let infoText = document.querySelector('#infoText');
		const popupClose = document.querySelector('#exitbutton');
		const panel = document.querySelector('#panel');
		const spotLight = document.querySelector('#spotlight');

		infoText.setAttribute("value",data.exhibits[id].description);
		infoText.setAttribute('color','black');
		

		if(panelBase.getAttribute("visible")||panelExhibit.getAttribute("visible")){
		 	panelExhibit.setAttribute('visible',false);
		  panelExhibit.setAttribute('position','0 100 0');
		  panelBase.setAttribute('visible',false);
		  panelBase.setAttribute('position','0 100 0');
		 }

		if(!popup.getAttribute("visible")){
			popup.setAttribute("visible",true);
			popup.setAttribute("position", centerPos.x + ' ' + (centerPos.y + 0.2 ) + ' ' + centerPos.z);
			popup.setAttribute("rotation", centerRot.x + ' ' + centerRot.y + ' ' + centerRot.z);

			spotLight.setAttribute("visible", true);



		  const previousSelectedTile = document.querySelector('.gridtile.selected');
		  
		  if(previousSelectedTile){

		    if(previousSelectedTile.classList.contains('floor')){
		    	previousSelectedTile.setAttribute('color', '#ECDFCC');
		    }
		    else if(previousSelectedTile.classList.contains('wall')) {
		    	previousSelectedTile.setAttribute('color', '#697565');
		    }

				previousSelectedTile.classList.remove('selected');

			}
		}
		else{
			popup.setAttribute("visible",false);
			spotLight.setAttribute("visible",false);
		}
	}

</script>



<a-box id="box" class="clickable" onclick="deleteDB()" position="-0.25 .75 -11" color="" material="src:#gradient"></a-box>
<!-- <a-sphere id="sphere" color="red" position="0 0 -5"></a-sphere> -->


<a-gui-label
	id="popup"
	position="0 1 -4"
	font-size="0.1"
	width="0.75"
	height="1"
	line-Height="1"
	visible="false"

>
	
</a-gui-label>

<a-gui-flex-container id="panelBase" width="5.5" height="2" position="0 100 0" rotation="0 90 0" panel-color="#072B73" opacity="0.8" flex-direction="row" justify-content="center" align-items="center" scale=".25 .25 0.5" visible="false">

	<a-gui-button 
						onclick="importBase(this)"
						class=""
						margin="0 0.3 0 0"
						width="1.5" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Empty"
						image-hover
						bevel="true"
						bevel-size="0.08"
						bevel-thickness="0.02"
	>
			</a-gui-button>

	<a-gui-button 
						bevel="true"
						onclick="importBase(this)"
						class=""
						margin="0 0 0 0"
						width="1.5" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Base2"
						image-hover
						bevel-size="0.08"
						bevel-thickness="0.02"
	>
			</a-gui-button>

	<a-gui-button 
						bevel="true"
						onclick="importBase(this)"
						class=""
						margin="0 0 0 0.3"
						width="1.5" 
						height=".75"
						font-family="assets/fonts/Plaster-Regular.ttf"
						font-size="0.2"
						value="Base3"
						image-hover
						bevel-size="0.08"
						bevel-thickness="0.02"
	>
			</a-gui-button>
	
</a-gui-flex-container>


<a-gui-flex-container id="panelExhibit" scale=" 0.25 0.25 .5" flex-direction="column" width="9" height="2" position="0 100 0" panel-color="#072B73" opacity="0.8" justify-content="center" align-items="center" visible="false" >

		<a-gui-flex-container flex-direction="row" position="0 0 0" rotation="0 0 0" justify-content="center"  panel-color="#072B73" opacity="0.8" visible="true">


					<a-gui-button 
								onclick="importExhibit(this)" 
								id="0"
								margin="-0.3 0 0 0"
								class="rename"
								width="1.5" 
								height="1"
								font-family="assets/fonts/Plaster-Regular.ttf"
								font-size="0.2"
								value="Empty base"
								image-hover
								bevel="true"
								bevel-size="0.07"
								bevel-thickness="0.02"
								

					>
					</a-gui-button>

					<a-gui-button 
								onclick="importExhibit(this)"
								class="rename"
								margin="-0.3 0 0 0.2"					
								id="1"
								width="1.5" 
								height="1"
								font-family="assets/fonts/Plaster-Regular.ttf"
								font-size="0.2"
								value="A box"
								image-hover
								bevel="true"
								bevel-size="0.07"
								bevel-thickness="0.02"
								
					>
					</a-gui-button>

					<a-gui-button
								onclick="importExhibit(this)"
								class="rename"
								margin="-0.3 0 0 0.2"	
								id="2"
								width="1.5" 
								height="1"
								font-family="assets/fonts/Plaster-Regular.ttf"
								font-size="0.2"
								value="A sphere"
								image-hover
								bevel="true"
								bevel-size="0.07"
								bevel-thickness="0.02"
								
					>
					</a-gui-button>

					<a-gui-button
								onclick="importExhibit(this)"
								class="rename"
								id="3"
								margin="-0.3 0 0 0.2"	
								width="1.5"  
								height="1"
								font-family="assets/fonts/Plaster-Regular.ttf"
								font-size="0.2"
								value="A cylinder"
								image-hover
								bevel="true"
								bevel-size="0.07"
								bevel-thickness="0.02"
								
					>
					</a-gui-button>

					<a-gui-button
								onclick="importExhibit(this)"
								class="rename"
								id="4"
								margin="-0.3 0 0 0.2"	
								width="1.5"  
								height="1"
								font-family="assets/fonts/Plaster-Regular.ttf"
								font-size="0.2"
								value="A plane"
								image-hover
								bevel="true"
								bevel-size="0.07"
								bevel-thickness="0.02"
					>
					</a-gui-button>

				</a-gui-flex-container>

						<a-gui-flex-container flex-direction="row" justify-content="center" align-items="center" component-padding="0" width="2.20" height="1" position="0 0 0" rotation="0 0 0" panel-color="#072B73" opacity="0.8" margin="-.2 0 -.20 0">  
							<!-- #072B73 -->

									<a-gui-icon-label-button
										width=".5" height="0.5"
										onclick="previousPage()"
										icon="F2F5"
										icon-font="assets/fonts/fa-solid-900.ttf"
										font-family="assets/fonts/PressStart2P-Regular.ttf"
										font-size="0.3"
										margin="0 0 0 0"
										rotation="0 0 180"
									>
									</a-gui-icon-label-button>

									<a-gui-icon-label-button
										width=".5" height="0.5"
										onclick="nextPage()"
										icon="F2F5"
										icon-font="assets/fonts/fa-solid-900.ttf"
										font-family="assets/fonts/PressStart2P-Regular.ttf"
										font-size="0.3"
										margin="0 0 0 0"
										rotation="0 0 0"
									>
									</a-gui-icon-label-button>

						</a-gui-flex-container>

</a-gui-flex-container>
<a-entity spatial-occlusion="wallClass: invisible-wall" rotation="0 180 0" position="-0.3 0 -8">
	<a-camera  look-controls wasd-controls="acceleration:30" id="camera">

		
			<a-entity  id="cursor" raycaster="objects:.clickable, [gui-interactable], .info, .enable" cursor="fuse:false; fuseTimeout:2000;" geometry="primitive:sphere;radius:0.008" material="color:orange;" position="0 0 -.5;"  animation__color=" property:material.color; from:#FFA500 ; to: #00FF00; dur: 100; startEvents:mouseenter;" animation__coloreset=" property:material.color; from:#00FF00 ; to: #FFA500; dur: 100; startEvents:mouseleave;" animation__fusing=" property:scale; from: 1 1 1; to: .5 .5 .5; dur: 500; startEvents:mouseenter;" animation__reset="property:scale; to: 1 1 1; startEvents:mouseleave;">		
			</a-entity>
	</a-camera>
</a-entity>
</a-scene> 



<script>



</script>
</body>
</html>

<?php

}else{
	header("Location: index.php");
	exit();
}

?>



