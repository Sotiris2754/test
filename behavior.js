//Εμφάνιση db στο console, ασύγχρονα. Δεν λειτουργεί!!

// fetch('test.php')
//   .then(response => response.json())
//   .then(data => console.log(data));


//import data from '/WebCatalog/content.json' assert { type: 'JSON' };
//const exhibits = require("./WebCatalog/content.json");


let data;
let response;

async function fetchContent()
{
	//response = await fetch("http://localhost:8000/WebCatalog/content.json"); // works - needs data = await response.json(); 
	response = await fetch("details.json"); // works - needs data = await response.json(); 
	data = await response.json();


	
	//const response = await fetch("http://localhost:8000/WebCatalog/content.json").then( response =>{console.log(response);}); // works and gets response
	//const response = await fetch("http://localhost:8000/WebCatalog/content.json").then(response => {data = response.json(); loadExhibit();});
	
}

function loadExhibit()
{
	//console.log(response);
	//console.log(data);
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



// function displayInfo(obj){

// 	console.log(obj);
// 	var standPos = obj.parentNode.getAttribute("position");
// 	var standRot = obj.parentNode.getAttribute("rotation");

// 	var infoText = document.getElementById("info");
// 	 var id = obj.getAttribute("id");
// 	 var roundDown = Math.floor(id);
// 	 infoText.setAttribute("value",data.exhibits[roundDown].description);
// 	 // console.log(id);
	
// 	// console.log(roundDown);
	
// 	// var value = infoText.getAttribute("value");
// 	// console.log(value);
				

// }
AFRAME.registerComponent("closebutton",{
	init:function(){
		var el = this.el;
		el.addEventListener('click',function(){
			var frame = el.parentNode;
			var panel = frame.parentNode;
			panel.setAttribute('visible','false');
			el.classList.remove('info');
		});
	}
});

AFRAME.registerComponent("show-panel",{
	init:function(){
		var el = this.el;
		el.addEventListener('click',function(){
			var parent = el.parentNode;
			var frame  = parent.childNodes[1];
			var exitButton = frame.querySelector('.grandChild');
			exitButton.setAttribute('class','grandChild info');
			frame.setAttribute('visible','true');


		})
	}
})

AFRAME.registerComponent("show-gui",{
	init:function(){
		var guiPanel = document.querySelector("#mypanel");
		var el = this.el;
		// console.log(el);
		var standPos = el.getAttribute("position");
		var standRot = el.getAttribute("rotation");
		 // console.log(standPos);
		// guiPanel.setAttribute("opacity",".5");
		el.addEventListener('click',function(el){
			var entity = el.srcElement;
			// console.log(entity);
			// var currentClass = entity.getAttribute('class');
			// console.log(currentClass);

			// var infoText = document.getElementById("info");
			// var id = entity.getAttribute("id");
			// console.log(id);
			// var roundDown = Math.floor(id);
			// infoText.setAttribute("value",data.exhibits[roundDown].description);
			// console.log(currentClass);

			if(entity.classList.contains('stand')){
				base=this;
				// // guiPanel.setAttribute("visible",false);
				
				// var infoPanel = document.getElementById("infoPanel");
				// if(shown==false){
				// 	infoPanel.setAttribute("visible","true");
				// 	infoPanel.setAttribute("position",{x:standPos.x, y:standPos.y + 3, z:standPos.z});
				// 	infoPanel.setAttribute("rotation",{x:standRot.x, y:standRot.y -180, z:standRot.z});
				// 	shown=!shown;
				// }
				// else if(shown==true){
				// 	infoPanel.setAttribute("visible","false");
				// 	shown=!shown;
				// }

				// console.log("Stand Class");

				displayDescriptionUpdated();
				checkBase();
				if(sameBase){

					isVisible = guiPanel.getAttribute("visible");

					if(isVisible){
						guiPanel.setAttribute("visible",false);

					}
					else{
						guiPanel.setAttribute("visible",true);
					}

				}
				else{
				guiPanel.setAttribute("position",{x:standPos.x, y:standPos.y + 2, z:standPos.z - 1.2});
				guiPanel.setAttribute("rotation",{x:standRot.x, y:standRot.y -180, z:standRot.z});
				guiPanel.setAttribute("visible",true);	
				}

				// console.log("patisa Kitrini vasi");

			}
			else{
				//Tha doume...
			}
		});

	},
});


	AFRAME.registerComponent("show-list", { // Edw einai i palia  function gia HTML elements. Koita to "show-gui" component!!

	init: function(){
	var myDiv = document.querySelector("#myDiv");
		 this.el.addEventListener('click',function(){
		 		base=this; // Αποθήκευση βάσης που επιλέχθηκε από τον χρήστη
		 		
				//<!-- ...............  -->

				// Εδώ θα τρέχει μια function για να τσεκάρει αν υπάρχει αυτή η βάση στην βάση δεδομένων. Αν όχι, τότε θα κάνει INSERT!

				//<!-- ...............  -->
				// myDiv.style.visibility = "visible"
				myDiv.innerHTML = displayDescription();

				checkBase();
			 	console.log(base.id); 
			 	// if(sameBase==true){
			 	// 	if(myDiv.style.visibility==="hidden"){
			 	// 		myDiv.style.visibility = "visible";
			 	// 	}
			 	// 	else{
			 	// 		myDiv.style.visibility= "hidden";
			 	// 	}
				//  }
			 	// if(sameBase==false){
			 	// 	myDiv.style.visibility = "visible";
			 	// }
		 })
	},
});

	function nextPage(){
		if(page==2)
			return;
		page=2;

		for(i=0; i<5; i++){
			button  = document.getElementById(i);
			button.setAttribute("id",i+5);
		}

		displayDescriptionUpdated();

	}
	function previousPage(){
			if(page==1)
			return;
		page=1;

		for(i=5; i<10; i++){
			button  = document.getElementById(i);
			button.setAttribute("id",i-5);
		}

		displayDescriptionUpdated();

	}


	function displayDescriptionUpdated(){
		if(!data){
			console.log("DEN EXW ARXEIO");
		}
		else{
			if(page==1){
				// console.log("page 1");
				for (i=0; i<5; i++){
					var text = document.getElementById(i);
					text.setAttribute("value",data.exhibits[i].title);
					// console.log(text);
				}			
			}
			if(page==2){
				// console.log("page 2");
				for (i=5; i<10; i++){
					var text = document.getElementById(i);
					text.setAttribute("value",data.exhibits[i].title); // +5 sto i gia na parei to 5o ekthema prwta
					// console.log(text);
				}
			}	
		}

	}


	function displayDescription(){
		if(text==="")
		{		
				text+= "<ul>";
				text+= "<h4><i>Διάλεξε ποιο έκθεμα θέλεις να τοποθετηθεί στην βάση</i>: (" + base.id + ")</h4>";
				for(var i=0; i<data.exhibits.length; i++){			
					text+= "<li id="+data.exhibits[i].id+" onclick='placeExhibit(this)'> <b>"+data.exhibits[i].title+ "</b>" + ": "; //Με το "this" παίρνω τα στοιχεία του κειμένου που επιλέχθηκε από τον χρήστη, συνεπώς και το έκθεμα που επέλεξε.
					text+= data.exhibits[i].description+ " <br></li>";
				}
				text+= "</ul>";
				//console.log(text);
				return text;
			}
			else{
				text="";
				return text;
				// console.log(myDiv.innerHTML);
			}
	}


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
	function storeData(){
	  $.ajax({
	  url: "sql.php",
	  method: "POST",
	  data: { id:base.id, exhibit:data.exhibits[id].id, description:data.exhibits[id].description, action:"store"},
	  success: function(response) {
	    console.log("Selection stored successfully.");
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
			data: {action:"view"},
			success: function(res) {
				
	    		console.log("Success Response");
	    		var json = JSON.parse(res);
	    		//console.log(json.length);
				if (data == null)
				{
					console.log("2nd Not ready yet!");
					setTimeout(retrieveData(),1);
				}
				else{
		    		for (var i=0; i<json.length; i++){
		    		count = json.length;

					var stand = document.createElement('a-entity');
					stand.setAttribute('id',data.stands[i].id);
					// stand.setAttribute('show-list',"");
					stand.setAttribute('show-gui',"");
					stand.setAttribute('position',data.stands[i].position);
					stand.setAttribute('gltf-model',`url(${data.stands[i].pathfile})`);
					stand.setAttribute('rotation',data.stands[i].rotation);
					// stand.setAttribute('scale',data.stands[i].scale);
					stand.setAttribute('class','clickable stand');
					scene.appendChild(stand);

		    			// base = document.getElementById(i); THA XRISIMOPOIISW TIN METAVLITI "STAND"
		    			removeChild();
						//console.log(json);
						if(json[i]!=null){
		    				var exhibit = document.createElement('a-entity');
							exhibit.setAttribute('position',0 +" " + 1.7 +" " + 0);
							// console.log(data.stands[i].position);
							if(json[i]!=0)
							exhibit.setAttribute('gltf-model',`url(${data.exhibits[json[i]].pathfile})`);
							exhibit.setAttribute('scale',data.exhibits[json[i]].scale);
							exhibit.setAttribute('id',json[i]+"."+json[i]);
							exhibit.setAttribute('class','clickable');
							exhibit.setAttribute("show-panel","");
							stand.appendChild(exhibit);

							var frame = document.createElement('a-entity');
								frame.setAttribute("position","0 3 0.01");
								frame.setAttribute("rotation","0 -180 0");
								frame.setAttribute('visible','false');
								stand.appendChild(frame);

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
								infoText.setAttribute('value',data.exhibits[json[i]].description);
								panel.appendChild(infoText);
						}

					}

	    		}
	  		},
		
		});
	}

function removeChild(){
		if(base!=null){
		if(base.childNodes){
			for (var k = base.childNodes.length -1; k >= 0; k--) {
   				if (base.childNodes[k].tagName === 'A-ENTITY') {
      				base.removeChild(base.childNodes[k]);
    			}	
			}
		}
	}
}

function addBases(){
	if(data.stands.length>count){ // Max number of stands == 6 (Apo to JSON file)
		var stand = document.createElement('a-entity');
		stand.setAttribute('id',data.stands[count].id); // Stand's id starts from 1 not 0 !!
		stand.setAttribute('show-gui',"");
		stand.setAttribute('position',data.stands[count].position);
		stand.setAttribute('gltf-model',`url(${data.stands[count].pathfile})`);
		stand.setAttribute('rotation',data.stands[count].rotation);
		stand.setAttribute('class','clickable stand');
		scene.appendChild(stand);
		count++;
		base = stand;
		addBaseToServer();
		//console.log(base);
	}
	else
		return;
}

function removeBases(){
	if(count>4){
		removeBaseFromServer();
		
		var stand = document.getElementById(count);
		console.log(stand);
		scene.removeChild(stand);
		count--;
	}

	
}

	function addBaseToServer(){
		console.log('Prosthese vasi');
		$.ajax({
			url: "sql.php",
			method:"POST",
			data: {id:base.id, action:"add"},
			success: function(response) {
		    console.log("Base added successfully.");
		  	}
		});
	}

	function removeBaseFromServer(){
		$.ajax({
			url: "sql.php",
			method:"POST",
			data: {action:"remove"},
			success: function(response) {
		    console.log("Base removed successfully.");
		  	}
		});
	}	