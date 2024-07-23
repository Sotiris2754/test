let data;
let response;

async function fetchContent()
{
	response = await fetch("details.json"); // works - needs data = await response.json(); 
	data = await response.json();	
}


//Function is called onload in body tag in .php file !!!!

function loadExhibit()
{

	if (response == null)
	{
		console.log("Not ready yet!");
		setTimeout(loadExhibit, 1000);
	}
	else
	{
		console.log("Data loaded! ") 
		//console.log(data);
	}
}

	let base;
	let previousBase;
	let sameBase;
	let count=4;
	let text="";
	let page = 1;
	let shown = false;



// AFRAME.registerComponent("closebutton",{
// 	init:function(){
// 		var el = this.el;
// 		el.addEventListener('click',function(){
// 			var frame = el.parentNode;
// 			var panel = frame.parentNode;
// 			panel.setAttribute('visible','false');
// 			el.classList.remove('info');
// 		});
// 	}
// });

// AFRAME.registerComponent("show-panel",{
// 	init:function(){
// 		var el = this.el;
// 		el.addEventListener('click',function(){
// 			var parent = el.parentNode;
// 			var frame  = parent.childNodes[1];
// 			var exitButton = frame.querySelector('.grandChild');
// 			exitButton.setAttribute('class','grandChild info');
// 			frame.setAttribute('visible','true');


// 		})
// 	}
// })

// AFRAME.registerComponent("show-gui",{
// 	init:function(){
// 		var guiPanel = document.querySelector("#mypanel");
// 		var el = this.el;
// 		// console.log(el);
// 		var standPos = el.getAttribute("position");
// 		var standRot = el.getAttribute("rotation");
// 		 // console.log(standPos);
// 		// guiPanel.setAttribute("opacity",".5");
// 		el.addEventListener('click',function(el){

// 			var entity = el.srcElement;

// 			if(entity.classList.contains('stand')){
// 				base=this;

// 				displayDescriptionUpdated();
// 				checkBase();

// 				if(sameBase){

// 					isVisible = guiPanel.getAttribute("visible");

// 					if(isVisible){
// 						guiPanel.setAttribute("visible",false);
// 					}
// 					else{
// 						guiPanel.setAttribute("visible",true);
// 					}

// 				}
// 				else{
// 				guiPanel.setAttribute("position",{x:standPos.x, y:standPos.y + 2, z:standPos.z - 1.2});
// 				guiPanel.setAttribute("rotation",{x:standRot.x, y:standRot.y -180, z:standRot.z});
// 				guiPanel.setAttribute("visible",true);	
// 				}

// 				// console.log("patisa Kitrini vasi");

// 			}
// 			else{
// 				//Tha doume...
// 			}
// 		});

// 	},
// });


	// function nextPage(){
	// 	if(page==2)
	// 		return;
	// 	page=2;

	// 	for(i=0; i<5; i++){
	// 		button  = document.getElementById(i);
	// 		button.setAttribute("id",i+5);
	// 	}

	// 	displayDescriptionUpdated();

	// }
	// function previousPage(){
	// 		if(page==1)
	// 		return;
	// 	page=1;

	// 	for(i=5; i<10; i++){
	// 		button  = document.getElementById(i);
	// 		button.setAttribute("id",i-5);
	// 	}

	// 	displayDescriptionUpdated();

	// }

//Αυτή είναι η συνάρτηση για την απεικόνιση των τίτλων των έργων πάνω στα πλαίσια του GUI
	// function displayDescriptionUpdated(){
	// 	if(!data){
	// 		console.log("DEN EXW ARXEIO");
	// 	}
	// 	else{
	// 		if(page==1){
	// 			// console.log("page 1");
	// 			for (i=0; i<5; i++){
	// 				var text = document.getElementById(i);
	// 				text.setAttribute("value",data.exhibits[i].title);
	// 				// console.log(text);
	// 			}			
	// 		}
	// 		if(page==2){
	// 			// console.log("page 2");
	// 			for (i=5; i<10; i++){
	// 				var text = document.getElementById(i);
	// 				text.setAttribute("value",data.exhibits[i].title); // +5 sto i gia na parei to 5o ekthema prwta
	// 				// console.log(text);
	// 			}
	// 		}	
	// 	}

	// }



	function checkBase(){
		if (base==previousBase){		
			sameBase=true;
			//console.log("einai idies");
		}	
		if(base!=previousBase){	
			sameBase = false;
			//console.log("DEN einai idies");
		}
		previousBase = base;
	}

function placeExhibit(entity){
		//console.log(exhibit);

		var id = entity.getAttribute('id');
		// console.log(id);		
		console.log(this.exhibit);
			if(this.exhibit){
					var exhibitId = this.exhibit.getAttribute('id');
					console.log(exhibitId);

				if(this.exhibit.parentNode==base){
					// console.log(this.exhibit.parentNode);


					if(exhibitId!= id + "." + id){
					removeChild(base);

	    			var exhibit = document.createElement('a-entity');
		
						exhibit.setAttribute('position',0 +" " + 1.7 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });
						if(id!=0)
						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);
						exhibit.setAttribute('class','clickable');
						exhibit.setAttribute("show-panel","");

						base.appendChild(exhibit);
						this.exhibit = exhibit;
						storeData();

						var frame = document.createElement('a-entity');
							frame.setAttribute("position","0 3 0.01");
							frame.setAttribute("rotation","0 -180 0");
							frame.setAttribute('visible','false');
							base.appendChild(frame);

						var panel = document.createElement('a-plane');
							panel.setAttribute('width',2);
							panel.setAttribute('height',1);
							frame.appendChild(panel);

						var exitButton = document.createElement('a-image');
							exitButton.setAttribute('src','#exitButton');
							exitButton.setAttribute('scale','0.2 0.2 0.2');
							exitButton.setAttribute('position','0.8 .35 0.01');
							exitButton.setAttribute('class','grandChild');
							exitButton.setAttribute('closebutton','');
							panel.appendChild(exitButton);

						var infoText = document.createElement('a-text');
							infoText.setAttribute('width',2);
							infoText.setAttribute('color','black');
							infoText.setAttribute('align','center');
							infoText.setAttribute('value',data.exhibits[id].description);
							panel.appendChild(infoText);
					}

				}
				if(this.exhibit.parentNode!=base){

					if(exhibitId!=id + "." + id){
						removeChild(base);						
						var exhibit = document.createElement('a-entity');
						exhibit.setAttribute('position',0 +" " + 1.7 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });
						if(id!=0)
						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);
						exhibit.setAttribute('class','clickable');
						exhibit.setAttribute("show-panel","");
						base.appendChild(exhibit);
						this.exhibit = exhibit;
						storeData();

						var frame = document.createElement('a-entity');
							frame.setAttribute("position","0 3 0.01");
							frame.setAttribute("rotation","0 -180 0");
							frame.setAttribute('visible','false');
							base.appendChild(frame);

						var panel = document.createElement('a-plane');
							panel.setAttribute('width',2);
							panel.setAttribute('height',1);
							frame.appendChild(panel);

						var exitButton = document.createElement('a-image');
							exitButton.setAttribute('src','#exitButton');
							exitButton.setAttribute('scale','0.2 0.2 0.2');
							exitButton.setAttribute('position','0.8 .35 0.01');
							exitButton.setAttribute('class','grandChild');
							exitButton.setAttribute('closebutton','');
							panel.appendChild(exitButton);

						var infoText = document.createElement('a-text');
							infoText.setAttribute('width',2);
							infoText.setAttribute('color','black');
							infoText.setAttribute('align','center');
							infoText.setAttribute('value',data.exhibits[id].description);
							panel.appendChild(infoText);

					}
					else{
						// this.exhibit.parentNode.removeChild(this.exhibit);
	    				// this.exhibit = null;
						removeChild(base);

	    				var exhibit = document.createElement('a-entity');
		
						exhibit.setAttribute('position',0 +" " + 1.7 +" " + 0); 
						// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });
						if(id!=0)
						exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
						exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
						exhibit.setAttribute('id',id+"."+id);
						exhibit.setAttribute('class','info');
						exhibit.setAttribute("show-panel","");

						base.appendChild(exhibit);
						this.exhibit = exhibit;
						storeData();
						
						var frame = document.createElement('a-entity');
							frame.setAttribute("position","0 3 0.01");
							frame.setAttribute("rotation","0 -180 0");
							frame.setAttribute('visible','false');
							base.appendChild(frame);

						var panel = document.createElement('a-plane');
							panel.setAttribute('width',2);
							panel.setAttribute('height',1);
							frame.appendChild(panel);

						var exitButton = document.createElement('a-image');
							exitButton.setAttribute('src','#exitButton');
							exitButton.setAttribute('scale','0.2 0.2 0.2');
							exitButton.setAttribute('position','0.8 .35 0.01');
							exitButton.setAttribute('class','grandChild');
							exitButton.setAttribute('closebutton','');
							panel.appendChild(exitButton);

						var infoText = document.createElement('a-text');
							infoText.setAttribute('width',2);
							infoText.setAttribute('color','black');
							infoText.setAttribute('align','center');
							infoText.setAttribute('value',data.exhibits[id].description);
							panel.appendChild(infoText);
					}
				}						
			}
			else{
					removeChild(base);				

					var exhibit = document.createElement('a-entity');
		
					exhibit.setAttribute('position',0 +" " + 1.7 +" " + 0); 
					// exhibit.setAttribute('position', { x: base.object3D.position.x, y: base.object3D.position.y + 1, z: base.object3D.position.z });
					if(id!=0)
					exhibit.setAttribute('gltf-model',`url(${data.exhibits[id].pathfile})`);
					exhibit.setAttribute('scale',data.exhibits[id].scale); // αλλαγή του scale διότι το 2ο έκθεμα ήταν τεράστιο.
					exhibit.setAttribute('id',id+"."+id);
					exhibit.setAttribute('class','clickable');
					exhibit.setAttribute("show-panel","");
					// console.log(exhibit);
					base.appendChild(exhibit);
					// console.log(exhibit);
					this.exhibit = exhibit;
					storeData();

						var frame = document.createElement('a-entity');
							frame.setAttribute("position","0 3 0.01");
							frame.setAttribute("rotation","0 -180 0");
							frame.setAttribute('visible','false');
							base.appendChild(frame);

						var panel = document.createElement('a-plane');
							panel.setAttribute('width',2);
							panel.setAttribute('height',1);
							frame.appendChild(panel);

						var exitButton = document.createElement('a-image');
							exitButton.setAttribute('src','#exitButton');
							exitButton.setAttribute('scale','0.2 0.2 0.2');
							exitButton.setAttribute('position','0.8 .35 0.01');
							exitButton.setAttribute('class','grandChild');
							exitButton.setAttribute('closebutton','');
							panel.appendChild(exitButton);

						var infoText = document.createElement('a-text');
							infoText.setAttribute('width',2);
							infoText.setAttribute('color','black');
							infoText.setAttribute('align','center');
							infoText.setAttribute('value',data.exhibits[id].description);
							panel.appendChild(infoText);
			}
		
	// function storeData(){
	//   $.ajax({
	//   url: "sql.php",
	//   method: "POST",
	//   data: { id:base.id, exhibit:data.exhibits[id].id, description:data.exhibits[id].description, action:"store"},
	//   success: function(response) {
	//     console.log("Selection stored successfully.");
	//    	//console.log(response);
	//   },
	//   		error: function(xhr, status, error) {
	//     	console.log("An error occurred: " + error);
	//   		}
	// 	});
	// }
}


	// function retrieveData(){
	// 	$.ajax({
	// 		url:"sql.php",
	// 		method:"POST",
	// 		data: {action:"view"},
	// 		success: function(res) {
				
	//     		console.log("Success Response");
	//     		var json = JSON.parse(res);
	//     		//console.log(json.length);
	// 			if (data == null)
	// 			{
	// 				console.log("2nd Not ready yet!");
	// 				setTimeout(retrieveData(),1);
	// 			}
	// 			else{
	// 	    		for (var i=0; i<json.length; i++){
	// 	    		count = json.length;

	// 				var stand = document.createElement('a-entity');
	// 				stand.setAttribute('id',data.stands[i].id);
	// 				// stand.setAttribute('show-list',"");
	// 				stand.setAttribute('show-gui',"");
	// 				stand.setAttribute('position',data.stands[i].position);
	// 				stand.setAttribute('gltf-model',`url(${data.stands[i].pathfile})`);
	// 				stand.setAttribute('rotation',data.stands[i].rotation);
	// 				// stand.setAttribute('scale',data.stands[i].scale);
	// 				stand.setAttribute('class','clickable stand');
	// 				scene.appendChild(stand);

	// 	    			// base = document.getElementById(i); THA XRISIMOPOIISW TIN METAVLITI "STAND"
	// 	    			removeChild();
	// 					//console.log(json);
	// 					if(json[i]!=null){
	// 	    				var exhibit = document.createElement('a-entity');
	// 						exhibit.setAttribute('position',0 +" " + 1.7 +" " + 0);
	// 						// console.log(data.stands[i].position);
	// 						if(json[i]!=0)
	// 						exhibit.setAttribute('gltf-model',`url(${data.exhibits[json[i]].pathfile})`);
	// 						exhibit.setAttribute('scale',data.exhibits[json[i]].scale);
	// 						exhibit.setAttribute('id',json[i]+"."+json[i]);
	// 						exhibit.setAttribute('class','clickable');
	// 						exhibit.setAttribute("show-panel","");
	// 						stand.appendChild(exhibit);

	// 						var frame = document.createElement('a-entity');
	// 							frame.setAttribute("position","0 3 0.01");
	// 							frame.setAttribute("rotation","0 -180 0");
	// 							frame.setAttribute('visible','false');
	// 							stand.appendChild(frame);

	// 						var panel = document.createElement('a-plane');
	// 							panel.setAttribute('width',2);
	// 							panel.setAttribute('height',1);
	// 							frame.appendChild(panel);

	// 						var exitButton = document.createElement('a-image');
	// 							exitButton.setAttribute('src','#exitButton');
	// 							exitButton.setAttribute('scale','0.2 0.2 0.2');
	// 							exitButton.setAttribute('position','0.8 .35 0.01');
	// 							exitButton.setAttribute('class','grandChild');
	// 							exitButton.setAttribute('closebutton','');
	// 							panel.appendChild(exitButton);

	// 						var infoText = document.createElement('a-text');
	// 							infoText.setAttribute('width',2);
	// 							infoText.setAttribute('color','black');
	// 							infoText.setAttribute('align','center');
	// 							infoText.setAttribute('value',data.exhibits[json[i]].description);
	// 							panel.appendChild(infoText);
	// 					}

	// 				}

	//     		}
	//   		},
		
	// 	});
	// }

// function removeChild(){
// 		if(base!=null){
// 		if(base.childNodes){
// 			for (var k = base.childNodes.length -1; k >= 0; k--) {
//    				if (base.childNodes[k].tagName === 'A-ENTITY') {
//       				base.removeChild(base.childNodes[k]);
//     			}	
// 			}
// 		}
// 	}
// }
	