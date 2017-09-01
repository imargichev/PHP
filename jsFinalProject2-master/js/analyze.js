var days = $("#days"), quests = $("#questions"), daysHolder = $("#daysHolder"), questsHolder = $("#questsHolder"), btn1 = $("#analyze"), btn2 = $("#goback"), results = $("#results");

var mainDatagram = $("#mainDatagram"), questsDatagram = $("#questsDatagram");
			
days.on("change", e=>{
	let count = daysHolder.children().length;
				
	//console.log(daysHolder.children());
				
	if(e.target.value > count){
		let elCount = e.target.value - count;
					
		for(let i = 0; i < elCount; i++){
			count++;
						
			let el = $("<input>");
						
			el.attr({type: "number", min: 0, name: "day" + count, 'class': "dayInput", placeholder: "Брой решени задачи за ден " + count});
			
			daysHolder.append(el);
		}
					
		let questsInput = questsHolder.children();
					
		if(questsInput.length > 0){
			$.each(questsInput, index =>{
				questsInput.eq(index).children("input:nth-of-type(1)").attr("max", e.target.value);
				questsInput.eq(index).children("input:nth-of-type(2)").attr("max", e.target.value);
			});
		}
	}else{
		let elCount = count - e.target.value;
					
		//console.log(elCount);
					
		let arr = daysHolder.children();
					
		//console.log(arr);
					
		for(let i = 0; i < elCount; i++){
			arr[count - i - 1].remove();
		}
					
		let questsInput = questsHolder.children();
					
		if(questsInput.length > 0){
			$.each(questsInput, index =>{
				questsInput.eq(index).children("input:nth-of-type(1)").attr("max", e.target.value);
				questsInput.eq(index).children("input:nth-of-type(2)").attr("max", e.target.value);
			});
		}
	}
});
			
quests.on("change", e=>{
	let count = questsHolder.children().length;	
				
	if(e.target.value > count){
		let elCount = e.target.value - count;
					
		for(let i = 0; i < elCount; i++){
			count++;
			let holder = $("<div>");
			let p = $("<p>");
			let el_1 = $("<input>"), el_2 = $("<input>");
						
			holder.attr("class", "inline");
						
			p.text("Въпрос № " + count);
						
			el_1.attr({type: "number", min: 1, max: daysHolder.children().length, name: "day" + count, 'class': "questInput", placeholder: "От"});
						
			el_2.attr({type: "number", min: 1, max: daysHolder.children().length, name: "day" + count, 'class': "questInput", placeholder: "До"});
			
			holder.append(p);
						
			holder.append(el_1);
						
			holder.append(el_2);
						
			questsHolder.append(holder);
		}
	}else{
		let elCount = count - e.target.value;
					
		//console.log(elCount);
					
		let arr = questsHolder.children();
					
		//console.log(arr);
					
		for(let i = 0; i < elCount; i++){
			arr[count - i - 1].remove();
		}
	}
});
			
btn1.on("click", ()=>{
	let dayInputs = daysHolder.children("input");
	
	let questInputs = questsHolder.children();
	
	if(days.val() > 0 && quests.val() > 0){
		days.css("border-color", "transparent");
		quests.css("border-color", "transparent");
		
		let err = false;
		
		//Check each days input for no value
		$.each(dayInputs, index =>{
			let input = dayInputs.eq(index);
						
			if(input.val() == ""){
				err = true;
				input.css("border-color", "#F44336");
			}else{
				input.css("border-color", "transparent");
			}
						
		});
		
		//Check each quests input for no value				
		$.each(questInputs, index=>{
			let input1 = questInputs.eq(index).children("input:nth-of-type(1)");
			let input2 = questInputs.eq(index).children("input:nth-of-type(2)");
							
			if(input1.val() == "" && input2.val() == ""){
				input1.css("border-color", "#F44336");
				input2.css("border-color", "#F44336");
				err = true;
			}else{
				input1.css("border-color", "transparent");
				input2.css("border-color", "transparent");
			}
		});
						
		if(!err){
			let daysArr = [];
			let questsArr = [];
					
			$.each(dayInputs, index =>{
				let input = dayInputs.eq(index);
								
				daysArr[index] = parseInt(input.val());
			});
							
			$.each(questInputs, index=>{
				let input1 = questInputs.eq(index).children("input:nth-of-type(1)");
				let input2 = questInputs.eq(index).children("input:nth-of-type(2)");
				
				input1 = parseInt(input1.val());
				input2 = parseInt(input2.val());
				
				questsArr[index] = [input1, input2];
				
				//createTrack(daysHolder.children().length, parseInt(input1.val()), parseInt(input2.val()), sum);
			});
			
			let createData = new Promise((res, rej)=>{
				if(createDatagram(daysArr)){
					res();
				}
			});
			
			createData.then(()=>{
				return new Promise((res, rej)=>{
					if(createAnswer(daysArr, questsArr)){
						res();
					}
				});
			}).then(()=>{
				rotateTo();
			})
			
			//console.log("daysArr: " + daysArr + " questsArr: " + questsArr);
			//Make rotation
			//rotateTo();
		}
	}else{
		days.css("border-color", "#F44336");
		quests.css("border-color", "#F44336");
	}
});

btn2.on("click", ()=>{
	days.val("");
	quests.val("");
	
	let dayInputs = daysHolder.children("input");
	
	let questInputs = questsHolder.children();
	
	$.each(dayInputs, index =>{
		let input = dayInputs.eq(index);
								
		input.remove();
	});
	
	$.each(questInputs, index =>{
		let el = questInputs.eq(index);
								
		el.remove();
	});
	
	mainDatagram.children().remove();
	
	$.each($("#questsDatagram").children(".datagram2"), index =>{
		let el = $("#questsDatagram").children(".datagram2").eq(index);
			
		el.remove();
	}).promise().done(()=>{rotateBack()});
	
});