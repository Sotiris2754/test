AFRAME.registerComponent("showlist", {

	init: function(){
		let list = document.querySelector('#list');


		 this.el.addEventListener('click',function(obj){ //obj == To clickable object
			let p = obj.srcElement.object3D.position; // p I thesi tou antikeimenou pou egine clicked
			list.setAttribute('visible','true'); // Emfanisi listas
		 })
	},
});

AFRAME.registerComponent("hidelist", {

	init: function(){
		let list = document.querySelector('#list');

		this.el.addEventListener('click',function(obj) {

			list.setAttribute('position','0 200 0'); // Allazw position giati me to "visible=flase" sinexizei na allilepidra o cursor 
			console.log('asdasd');
		})

	},

});


AFRAME.registerComponent("south", {

	init: function(){
		let list = document.querySelector('#list');

		this.el.addEventListener('click',function(obj) {
			let p = obj.srcElement.object3D.position;

			list.setAttribute('rotation','0 180 0');

			let newpX = p.x -2.5;
			let newpY = p.y + 1;
			let newpz = p.z;
			list.setAttribute('position',newpX + " " + newpY + " "+ p.z );
		})

	},

});

AFRAME.registerComponent("north", {

	init: function(){
		let list = document.querySelector('#list');

		this.el.addEventListener('click',function(obj) {
			let p = obj.srcElement.object3D.position;

			list.setAttribute('rotation','0 0 0');

			let newpX = p.x -2.5;
			let newpY = p.y + 1;
			let newpz = p.z;
			list.setAttribute('position',newpX + " " + newpY + " "+ p.z );
		})

	},

});

AFRAME.registerComponent("east", {

	init: function(){
		let list = document.querySelector('#list');

		this.el.addEventListener('click',function(obj) {
			let p = obj.srcElement.object3D.position;

			list.setAttribute('rotation','0 -90 0');

			let newpX = p.x -1;
			let newpY = p.y + 1;
			let newpz = p.z;
			list.setAttribute('position',newpX + " " + newpY + " "+ p.z );
		})

	},

});

AFRAME.registerComponent("west", {

	init: function(){
		let list = document.querySelector('#list');

		this.el.addEventListener('click',function(obj) {
			let p = obj.srcElement.object3D.position;

			list.setAttribute('rotation','0 90 0');

			let newpX = p.x +2.5;
			let newpY = p.y + 1;
			let newpz = p.z;
			list.setAttribute('position',newpX + " " + newpY + " "+ p.z );
		})

	},

});

AFRAME.registerComponent("test", {

	init: function(){
	let base = document.querySelector('#modelbase');
	let p = base.getAttribute('position');
	let scene = document.querySelector('a-scene');


	this.el.addEventListener('mouseenter',function(obj){
		
		//let id = obj.path[0].id;
		 let id =obj.srcElement.id;

		if(id=='cube1'){
			//console.log(p);
			let cube = document.createElement('a-entity');
			cube.setAttribute('geometry',{
				primitive: 'box'
			});
			cube.setAttribute('material', 'color:red');
			cube.setAttribute('scale', '0.5 0.5 0.5');	
			cube.setAttribute('position','0 0.6 0');
			//cube.setAttribute('preview');  Thelw na dosei component gia na kanei rotation
			base.appendChild(cube);
			//console.log(cube);
		}


			if(id=='cube2'){
			//console.log(p);
			let cube = document.createElement('a-entity');
			cube.setAttribute('geometry',{
				primitive: 'box'
			});
			cube.setAttribute('material', 'color:green');
			cube.setAttribute('scale', '0.5 0.5 0.5');			
			cube.setAttribute('position','0 0.6 0');
			base.appendChild(cube);
			//console.log(cube);
		}


		});
	// Θελω να καταστρέφει τα αντικείμενα μόλις κάνω hover-out/mouseleave

		// this.el.addEventListener('mouseleave',function(obj){
		// 		console.log("Katastrophi kokkinoy");

		// 		let id = obj.path[0].id;

		// 		if(id=='cube1'){

		// 			base.parentNode.removeChild(item);

		// 			destroy('#cube1');
		// 		}
		// 		if(id=='cube2'){

		// 			base.parentNode.removeChild();
		// 		}
				

		// 	});

	},


});


// AFRAME.registerComponent("preview", {

// 	tick: function(){

// 		this.el.getObject3D("mesh").rotation.y += 0.01;
// 	}

// });