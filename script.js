AFRAME.registerComponent('color-toggle', {
	init: function(){
		let el = this.el;
		this.toggleColor = function(){
			// alert('clicked');
			el.setAttribute('color','green');
		}
		this.el.addEventListener('click',this.toggleColor);
	},
	remove: function(){
		this.el.removeEventListener('click',this.toggleColor);
	}
})


AFRAME.registerComponent('target-marker', {
	init: function(){

		let el = this.el;
		this.addMarker = function(e){
			let p = e.detail.intersection.point;
			let scene = document.querySelector('a-scene');

			let newMark = document.createElement('a-entity');
			newMark.setAttribute('geometry',{
				primitive: 'sphere'
			});
			newMark.setAttribute('material', 'color:red');
			newMark.setAttribute('scale', '.2 .2 .2');
			newMark.setAttribute('position',p);
			scene.appendChild(newMark);
		}
		this.el.addEventListener('click',this.addMarker);
	},

	remove: function(){
		this.el.removeEventListener('click',this.addMarker);
	}

})


AFRAME.registerComponent('place-item', {
	init: function(){
		let el = this.el;
		this.itemSelect = function(e){

			let box = document.querySelector('a-box');
			let scene = document.querySelector('a-scene');
			let newObject = document.createElement('a-entity');
			

			newObject.setAttribute('geometry',{
				primitive: 'sphere'
			});
			newObject.setAttribute('material', 'color:red');
			
			newObject.setAttribute('position','0 0 2');
			box.appendChild(newObject);
			
		}
		this.el.addEventListener('click',this.itemSelect);
	},
	remove: function(){
		this.el.removeEventListener('click',this.itemSelect);
	}
})

